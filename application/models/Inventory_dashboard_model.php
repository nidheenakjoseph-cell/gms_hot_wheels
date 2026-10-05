<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_dashboard_model extends CI_Model
{
    private $table = 'inventory_status_master';

    // public function get_active_branches()
    // {
    //     return $this->db
    //         ->select('branch_id, branch_code, branch_name')
    //         ->from('branches')
    //         ->where('is_active', 1)
    //         ->order_by('branch_name', 'ASC')
    //         ->get()
    //         ->result();
    // }

    public function get_branch($branch_id)
    {
        return $this->db
            ->select('branch_id, branch_code, branch_name')
            ->from('branches')
            ->where('branch_id', (int) $branch_id)
            ->where('is_active', 1)
            ->get()
            ->row();
    }

    public function get_inventory_summary($branch_id = null)
    {
        $this->db
            ->select('
                COUNT(*) AS part_count,

                COALESCE(
                    SUM(
                        COALESCE(ss.current_stock, 0) *
                        COALESCE(sp.unit_price, 0)
                    ),
                    0
                ) AS inventory_value,

                COALESCE(
                    SUM(
                        COALESCE(ss.current_stock, 0)
                    ),
                    0
                ) AS total_stock
            ', false)
            ->from('spare_parts sp')
            ->join(
                'stock_summary ss',
                'ss.part_id = sp.part_id',
                'left'
            );

        if (!empty($branch_id)) {
            $this->db->where(
                'sp.branch_id',
                (int) $branch_id
            );
        }

        return $this->db
            ->get()
            ->row_array();
    }

    public function get_stock_summary($branch_id = null)
    {
        $this->db
            ->select('
                COALESCE(
                    SUM(
                        COALESCE(ss.current_stock, 0)
                    ),
                    0
                ) AS total_stock,

                COUNT(
                    CASE
                        WHEN COALESCE(ss.current_stock, 0) > 0
                        THEN 1
                    END
                ) AS stocked_items
            ', false)
            ->from('spare_parts sp')
            ->join(
                'stock_summary ss',
                'ss.part_id = sp.part_id',
                'left'
            );

        if (!empty($branch_id)) {
            $this->db->where(
                'sp.branch_id',
                (int) $branch_id
            );
        }

        return $this->db
            ->get()
            ->row_array();
    }

    public function get_low_stock_summary($branch_id = null)
    {
        $this->db
            ->select(
                'COUNT(*) AS low_stock',
                false
            )
            ->from('spare_parts sp')
            ->join(
                'stock_summary ss',
                'ss.part_id = sp.part_id',
                'left'
            )
            ->where(
                'COALESCE(ss.current_stock, 0) >',
                0
            )
            ->where(
                'COALESCE(ss.current_stock, 0) <= sp.min_stock',
                null,
                false
            );

        if (!empty($branch_id)) {
            $this->db->where(
                'sp.branch_id',
                (int) $branch_id
            );
        }

        $result = $this->db
            ->get()
            ->row_array();

        return array(
            'low_stock' => isset($result['low_stock'])
                ? (int) $result['low_stock']
                : 0
        );
    }

    public function get_out_of_stock_summary($branch_id = null)
    {
        $this->db
            ->select(
                'COUNT(*) AS out_of_stock',
                false
            )
            ->from('spare_parts sp')
            ->join(
                'stock_summary ss',
                'ss.part_id = sp.part_id',
                'left'
            )
            ->where(
                'COALESCE(ss.current_stock, 0) <=',
                0
            );

        if (!empty($branch_id)) {
            $this->db->where(
                'sp.branch_id',
                (int) $branch_id
            );
        }

        $result = $this->db
            ->get()
            ->row_array();

        return array(
            'out_of_stock' => isset($result['out_of_stock'])
                ? (int) $result['out_of_stock']
                : 0
        );
    }

    public function get_part_type_summary($branch_id = null)
    {
        $types = array(
            'New Parts',
            'Aftermarket Parts',
            'Used Parts'
        );

        $result = array();

        foreach ($types as $type) {

            $this->db
                ->select('
                    COUNT(*) AS item_count,

                    COALESCE(
                        SUM(
                            COALESCE(ss.current_stock, 0)
                        ),
                        0
                    ) AS quantity,

                    COALESCE(
                        SUM(
                            COALESCE(ss.current_stock, 0) *
                            COALESCE(sp.unit_price, 0)
                        ),
                        0
                    ) AS stock_value
                ', false)
                ->from('spare_parts sp')
                ->join(
                    'stock_summary ss',
                    'ss.part_id = sp.part_id',
                    'left'
                )
                ->where(
                    'sp.part_type',
                    $type
                );

            if (!empty($branch_id)) {
                $this->db->where(
                    'sp.branch_id',
                    (int) $branch_id
                );
            }

            $row = $this->db
                ->get()
                ->row_array();

            $result[$type] = array(
                'item_count' => isset($row['item_count'])
                    ? (int) $row['item_count']
                    : 0,

                'quantity' => isset($row['quantity'])
                    ? (float) $row['quantity']
                    : 0,

                'stock_value' => isset($row['stock_value'])
                    ? (float) $row['stock_value']
                    : 0
            );
        }

        return $result;
    }

    public function get_brand_summary($branch_id = null)
    {
        $this->db
            ->select(
                'COUNT(DISTINCT sp.brand_id) AS active_brands',
                false
            )
            ->from('spare_parts sp')
            ->where(
                'sp.brand_id IS NOT NULL',
                null,
                false
            )
            ->where(
                'sp.brand_id >',
                0
            );

        if (!empty($branch_id)) {
            $this->db->where(
                'sp.branch_id',
                (int) $branch_id
            );
        }

        $result = $this->db
            ->get()
            ->row_array();

        return array(
            'active_brands' => isset($result['active_brands'])
                ? (int) $result['active_brands']
                : 0
        );
    }

    public function get_inventory_chart(
        $branch_id = null,
        $from_date = null,
        $to_date = null
    ) {
        if (empty($from_date)) {
            $from_date = date('Y-m-01');
        }

        if (empty($to_date)) {
            $to_date = date('Y-m-d');
        }

        $from_timestamp = strtotime($from_date);
        $to_timestamp   = strtotime($to_date);

        $days_difference = floor(
            ($to_timestamp - $from_timestamp) / 86400
        );

        if ($days_difference <= 31) {
            $group_type = 'daily';
        } elseif ($days_difference <= 90) {
            $group_type = 'weekly';
        } else {
            $group_type = 'monthly';
        }

        if ($group_type === 'daily') {

            $this->db
                ->select("
                    DATE_FORMAT(
                        s.date_in,
                        '%Y-%m-%d'
                    ) AS period,

                    COALESCE(
                        SUM(s.qty),
                        0
                    ) AS stock_in
                ", false)
                ->from('stock_in s')
                ->join(
                    'spare_parts p',
                    'p.part_id = s.part_id',
                    'left'
                );

            $this->db->where(
                's.date_in >=',
                $from_date . ' 00:00:00'
            );

            $this->db->where(
                's.date_in <=',
                $to_date . ' 23:59:59'
            );

            if (!empty($branch_id)) {
                $this->db->where(
                    'p.branch_id',
                    (int) $branch_id
                );
            }

            $this->db
                ->group_by(
                    "DATE_FORMAT(s.date_in, '%Y-%m-%d')"
                )
                ->order_by(
                    'period',
                    'ASC'
                );

            $result = $this->db
                ->get()
                ->result();

            $labels = array();
            $values = array();

            foreach ($result as $row) {

                $labels[] = date(
                    'j M',
                    strtotime($row->period)
                );

                $values[] = (float) $row->stock_in;
            }
        }

        elseif ($group_type === 'weekly') {

            $this->db
                ->select("
                    DATE_SUB(
                        DATE(s.date_in),
                        INTERVAL WEEKDAY(s.date_in) DAY
                    ) AS period,

                    COALESCE(
                        SUM(s.qty),
                        0
                    ) AS stock_in
                ", false)
                ->from('stock_in s')
                ->join(
                    'spare_parts p',
                    'p.part_id = s.part_id',
                    'left'
                );

            $this->db->where(
                's.date_in >=',
                $from_date . ' 00:00:00'
            );

            $this->db->where(
                's.date_in <=',
                $to_date . ' 23:59:59'
            );

            if (!empty($branch_id)) {
                $this->db->where(
                    'p.branch_id',
                    (int) $branch_id
                );
            }

            $this->db
                ->group_by("
                    DATE_SUB(
                        DATE(s.date_in),
                        INTERVAL WEEKDAY(s.date_in) DAY
                    )
                ")
                ->order_by(
                    'period',
                    'ASC'
                );

            $result = $this->db
                ->get()
                ->result();

            $labels = array();
            $values = array();

            foreach ($result as $row) {

                $labels[] = date(
                    'j M',
                    strtotime($row->period)
                );

                $values[] = (float) $row->stock_in;
            }
        }

        else {

            $this->db
                ->select("
                    DATE_FORMAT(
                        s.date_in,
                        '%Y-%m-01'
                    ) AS period,

                    COALESCE(
                        SUM(s.qty),
                        0
                    ) AS stock_in
                ", false)
                ->from('stock_in s')
                ->join(
                    'spare_parts p',
                    'p.part_id = s.part_id',
                    'left'
                );

            $this->db->where(
                's.date_in >=',
                $from_date . ' 00:00:00'
            );

            $this->db->where(
                's.date_in <=',
                $to_date . ' 23:59:59'
            );

            if (!empty($branch_id)) {
                $this->db->where(
                    'p.branch_id',
                    (int) $branch_id
                );
            }

            $this->db
                ->group_by(
                    "DATE_FORMAT(s.date_in, '%Y-%m')"
                )
                ->order_by(
                    'period',
                    'ASC'
                );

            $result = $this->db
                ->get()
                ->result();

            $labels = array();
            $values = array();

            foreach ($result as $row) {

                $labels[] = date(
                    'M Y',
                    strtotime($row->period)
                );

                $values[] = (float) $row->stock_in;
            }
        }

        return array(
            'labels'   => $labels,
            'stock_in' => $values
        );
    }

    public function get_stock_status_chart($branch_id = null)
    {
        $this->db
            ->select("
                SUM(
                    CASE
                        WHEN COALESCE(ss.current_stock, 0) <= 0
                        THEN 1
                        ELSE 0
                    END
                ) AS out_of_stock,

                SUM(
                    CASE
                        WHEN COALESCE(ss.current_stock, 0) > 0
                        AND COALESCE(ss.current_stock, 0) <= sp.min_stock
                        THEN 1
                        ELSE 0
                    END
                ) AS low_stock,

                SUM(
                    CASE
                        WHEN COALESCE(ss.current_stock, 0) > sp.min_stock
                        THEN 1
                        ELSE 0
                    END
                ) AS sufficient_stock
            ", false)
            ->from('spare_parts sp')
            ->join(
                'stock_summary ss',
                'ss.part_id = sp.part_id',
                'left'
            );

        if (!empty($branch_id)) {
            $this->db->where(
                'sp.branch_id',
                (int) $branch_id
            );
        }

        $row = $this->db
            ->get()
            ->row_array();

        return array(
            'out_of_stock' => isset($row['out_of_stock'])
                ? (int) $row['out_of_stock']
                : 0,

            'low_stock' => isset($row['low_stock'])
                ? (int) $row['low_stock']
                : 0,

            'sufficient_stock' => isset($row['sufficient_stock'])
                ? (int) $row['sufficient_stock']
                : 0
        );
    }

    public function get_low_stock_parts($branch_id = null)
    {
        $this->db
            ->select('
                sp.part_id,
                sp.part_name,
                sp.part_code,
                COALESCE(ss.current_stock, 0) AS current_stock,
                sp.min_stock,
                sp.unit_price
            ')
            ->from('spare_parts sp')
            ->join(
                'stock_summary ss',
                'ss.part_id = sp.part_id',
                'left'
            )
            ->where(
                'COALESCE(ss.current_stock, 0) >',
                0
            )
            ->where(
                'COALESCE(ss.current_stock, 0) <= sp.min_stock',
                null,
                false
            );

        if (!empty($branch_id)) {
            $this->db->where(
                'sp.branch_id',
                (int) $branch_id
            );
        }

        $this->db
            ->order_by(
                'current_stock',
                'ASC'
            )
            ->limit(10);

        return $this->db
            ->get()
            ->result();
    }

    public function get_top_inventory_items($branch_id = null)
    {
        $this->db
            ->select('
                sp.part_id,
                sp.part_name,
                sp.part_code,

                COALESCE(
                    ss.current_stock,
                    0
                ) AS current_stock,

                sp.unit_price,

                (
                    COALESCE(ss.current_stock, 0) *
                    COALESCE(sp.unit_price, 0)
                ) AS stock_value
            ', false)
            ->from('spare_parts sp')
            ->join(
                'stock_summary ss',
                'ss.part_id = sp.part_id',
                'left'
            )
            ->where(
                'COALESCE(ss.current_stock, 0) >',
                0
            );

        if (!empty($branch_id)) {
            $this->db->where(
                'sp.branch_id',
                (int) $branch_id
            );
        }

        $this->db
            ->order_by(
                'stock_value',
                'DESC'
            )
            ->limit(10);

        return $this->db
            ->get()
            ->result();
    }

    public function get_recent_stock_in(
        $branch_id = null,
        $from_date = null,
        $to_date = null
    ) {
        if (empty($from_date)) {
            $from_date = date('Y-m-01');
        }

        if (empty($to_date)) {
            $to_date = date('Y-m-d');
        }

        $this->db
            ->select('
                s.stock_in_id,
                s.part_id,
                s.qty,
                s.date_in,
                p.part_name,
                p.part_code
            ')
            ->from('stock_in s')
            ->join(
                'spare_parts p',
                'p.part_id = s.part_id',
                'left'
            );

        $this->db->where(
            's.date_in >=',
            $from_date . ' 00:00:00'
        );

        $this->db->where(
            's.date_in <=',
            $to_date . ' 23:59:59'
        );

        if (!empty($branch_id)) {
            $this->db->where(
                'p.branch_id',
                (int) $branch_id
            );
        }

        $this->db
            ->order_by(
                's.date_in',
                'DESC'
            )
            ->limit(10);

        return $this->db
            ->get()
            ->result();
    }
}