<?php
class Notification_model extends CI_Model
{
    public function create_insurance_expiry_notifications($days = 30)
    {
        $this->load->helper('log');
        $today = date('Y-m-d');
        $until = date('Y-m-d', strtotime('+' . max(1, (int) $days) . ' days'));
        $policies = $this->db
            ->select('policy_id, expiry_date')
            ->where('expiry_date >=', $today)
            ->where('expiry_date <=', $until)
            ->get('insurance_policies')
            ->result();

        foreach ($policies as $policy) {
            $already_sent = $this->db
                ->where('event_key', 'insurance_expiring')
                ->where('ref_id', (int) $policy->policy_id)
                ->where('msg_date >=', $today . ' 00:00:00')
                ->count_all_results('notification');
            if ($already_sent > 0) {
                continue;
            }

            notify_event(
                'insurance_expiring',
                $policy->policy_id,
                'Insurance policy expires on ' . $policy->expiry_date,
                'insurancepolicy/view/' . $policy->policy_id,
                'InsurancePolicy',
                ['details' => 'Renewal should be arranged before the expiry date.']
            );
        }
    }

    public function get_user_notifications($user_id, $limit = 20)
    {
        $this->db->select('msg_id, ref_id, event_key, message, details, msg_date, redirect_url, read_flag, read_date, created_by');
        $this->db->from('notification');
        $this->db->where('user_id', (int) $user_id);
        $this->db->order_by('msg_date', 'DESC');
        $this->db->limit(min(50, max(1, (int) $limit)));
        return $this->db->get()->result_array();
    }

    public function count_unread($user_id)
    {
        $this->db->where('user_id', (int) $user_id);
        $this->db->where('read_flag', 0);
        return $this->db->count_all_results('notification');
    }

    public function mark_as_read($msg_id, $user_id)
    {
        return $this->db
            ->where('msg_id', (int) $msg_id)
            ->where('user_id', (int) $user_id)
            ->where('read_flag', 0)
            ->update('notification', [
            'read_flag' => 1,
            'read_date' => date('Y-m-d H:i:s')
        ]);
    }
}

?>
