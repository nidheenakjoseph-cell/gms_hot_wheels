<?php
class MaterialIssue_model extends CI_Model
{

	public function get_jobcard_parts_with_issued_qty($jobcard_id)
	{
		return $this->db
			->select('
            jp.part_id,
            sp.part_name,
            jp.qty,
            IFNULL(SUM(mii.issued_qty), 0) AS issued_qty
        ')
			->from('jobcard_parts jp')

			// Join spare parts master to get part name
			->join(
				'spare_parts sp',
				'sp.part_id = jp.part_id',
				'left'
			)

			// Join material issue items to calculate issued qty
			->join(
				'material_issue_items mii',
				'mii.part_id = jp.part_id 
             AND mii.jobcard_id = jp.jobcard_id',
				'left'
			)

			->where('jp.jobcard_id', $jobcard_id)
			->group_by('jp.part_id, sp.part_name, jp.qty')
			->get()
			->result();
	}

	public function get_issues_by_jobcard($jobcard_id)
	{
		return $this->db
			->select(" 
				mi.issue_id,
				mi.issue_no,
				mi.jobcard_id,
				mi.issue_date,
				mi.remarks,
				GROUP_CONCAT(
					CONCAT(
						COALESCE(sp.part_name, 'Unknown Part'),
						' - ',
						mii.issued_qty
					) ORDER BY mii.issue_item_id SEPARATOR '\n'
				) AS part_details
			", false)
			->from('material_issues mi')
			->join('material_issue_items mii', 'mii.issue_id = mi.issue_id', 'left')
			->join('jobcard_parts jp', 'jp.jobcard_id = mi.jobcard_id AND jp.part_id = mii.part_id', 'left')
			->join('spare_parts sp', 'sp.part_id = mii.part_id', 'left')
			->where('mi.jobcard_id', $jobcard_id)
			->group_by('mi.issue_id, mi.issue_no, mi.jobcard_id, mi.issue_date, mi.remarks')
			->order_by('mi.issue_date', 'DESC')
			->order_by('mi.issue_id', 'DESC')
			->get()
			->result();
	}


	/* ===============================
       CREATE MATERIAL ISSUE (MASTER)
    ================================ */
	public function create_issue($data)
	{
		$this->db->insert('material_issues', $data);
		return $this->db->insert_id();
	}

	/* ===============================
       UPDATE MATERIAL ISSUE
    ================================ */
	public function update_issue($issue_id, $data)
	{
		return $this->db
			->where('issue_id', $issue_id)
			->update('material_issues', $data);
	}

	/* ===============================
       CREATE MATERIAL ISSUE ITEM
    ================================ */
	public function create_issue_item($data)
	{
		if (empty($data['part_name']) && !empty($data['part_id'])) {
			$part = $this->db
				->select('part_name')
				->from('spare_parts')
				->where('part_id', $data['part_id'])
				->get()
				->row();

			$data['part_name'] = $part ? $part->part_name : '';
		}

		return $this->db->insert('material_issue_items', $data);
	}

	/* ===============================
       GET REMAINING JOB CARD PART QTY
    ================================ */
	public function get_remaining_jobcard_part_qty($jobcard_id, $part_id)
	{
		// Planned qty
		$planned = $this->db
			->select('qty')
			->from('jobcard_parts')
			->where('jobcard_id', $jobcard_id)
			->where('part_id', $part_id)
			->get()
			->row();

		if (!$planned) {
			return 0;
		}

		// Already issued qty
		$issued = $this->db
			->select('IFNULL(SUM(issued_qty),0) AS issued_qty', false)
			->from('material_issue_items')
			->where('jobcard_id', $jobcard_id)
			->where('part_id', $part_id)
			->get()
			->row();

		return $planned->qty - ($issued->issued_qty ?? 0);
	}
}
