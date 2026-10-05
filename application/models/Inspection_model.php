<?php defined('BASEPATH') or exit('No direct script access allowed');

class Inspection_model extends CI_Model
{
	private $table = 'inspection_items';
	private $table1 = 'inspection_packages';
	// Get all inspection items
	public function get_all_items()
	{
		return $this->db
			->where('is_active', 1)
			->order_by('category')
			->order_by('item_id', 'ASC')
			->get($this->table)
			->result();
	}

	public function get_categories()
	{
		return $this->db
			->distinct()
			->select('category')
			->where('category IS NOT NULL', null, false)
			->where('category !=', '')
			->order_by('category', 'ASC')
			->get($this->table)
			->result();
	}

	// Insert new inspection item
	public function insert_item($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function item_exists_in_category($item_name, $category, $exclude_id = null)
	{
		$this->db
			->where('item_name', trim($item_name))
			->where('category', trim($category));

		if ($exclude_id !== null) {
			$this->db->where('item_id !=', $exclude_id);
		}

		return $this->db->count_all_results($this->table) > 0;
	}

	// Get item by ID
	public function get_item($id)
	{
		return $this->db
			->where('item_id', $id)
			->get($this->table)
			->row();
	}

	// Update inspection item
	public function update_item($id, $data)
	{
		return $this->db
			->where('item_id', $id)
			->update($this->table, $data);
	}

	// Soft delete
	public function delete_item($id)
	{
		return $this->db
			->where('item_id', $id)
			->update($this->table, ['is_active' => 0]);
	}

 
	/* ---------------- MAIN INSPECTION ---------------- */

	public function update_inspection($inspection_id, $data)
	{
		return $this->db
			->where('inspection_id', $inspection_id)
			->update('inspections', $data);
	}

	/* ---------------- INSPECTION ITEMS (A/C/S) ---------------- */

	public function save_item_result($inspection_id, $item_id, $status)
	{
		$this->db->replace('inspection_item_results', [
			'inspection_id' => $inspection_id,
			'item_id'       => $item_id,
			'status'        => $status
		]);
	}

	/* ---------------- SERVICES / DESCRIPTION ---------------- */

	public function save_inspection_services($inspection_id, $service_ids, $custom_services)
	{
		// Clear old services
		// $this->db->where('inspection_id', $inspection_id)
		// 	->delete('inspection_services');

		foreach ($service_ids as $index => $service_id) {

			$data = [
				'inspection_id' => $inspection_id,
				'service_id'    => ($service_id !== 'custom') ? $service_id : null,
				'custom_text'   => ($service_id === 'custom')
					? ($custom_services[$index] ?? '')
					: null
			];

			$this->db->insert('inspection_services', $data);
		}
	}

	/* ---------------- WORKS REQUESTED ---------------- */

	public function save_works_requested($inspection_id, $works)
	{
		$this->db->where('inspection_id', $inspection_id)
			->delete('inspection_works_requested');

		foreach ($works as $work_id) {
			$this->db->insert('inspection_works_requested', [
				'inspection_id' => $inspection_id,
				'work_id'       => $work_id
			]);
		}
	}

	/* ---------------- INVENTORY STATUS ---------------- */

	public function save_inventory_status($inspection_id, $items)
	{
		$this->db->where('inspection_id', $inspection_id)
			->delete('inspection_inventory_status');

		foreach ($items as $inv_id) {
			$this->db->insert('inspection_inventory_status', [
				'inspection_id'       => $inspection_id,
				'inventory_status_id' => $inv_id
			]);
		}
	}

	public function get_damage_marks($inspection_id)
	{
		return $this->db
			->where('inspection_id', $inspection_id)
			->get('inspection_damage_marks')
			->result();
	}
	public function get_by_id($inspection_id)
	{
		return $this->db
			->where('inspection_id', $inspection_id)
			->get('inspections')
			->row();
	}

	public function get_item_results($inspection_id)
	{
		$results = [];

		$query = $this->db
			->where('inspection_id', $inspection_id)
			->get('inspection_item_results')
			->result();

		foreach ($query as $row) {
			$results[$row->item_id] = $row->status;
		}

		return $results;
	}


	public function get_selected_works($inspection_id)
	{
		return array_column(
			$this->db
				->select('work_id')
				->where('inspection_id', $inspection_id)
				->get('inspection_works_requested')
				->result_array(),
			'work_id'
		);
	}
	public function get_selected_inventory($inspection_id)
	{
		return array_column(
			$this->db
				->select('inventory_status_id')
				->where('inspection_id', $inspection_id)
				->get('inspection_inventory_status')
				->result_array(),
			'inventory_status_id'
		);
	}


	public function get_saved_services($inspection_id)
	{
		return $this->db
			->where('inspection_id', $inspection_id)
			->get('inspection_services')
			->result();
	}

	/**
	 * Get all inspections with customer & vehicle details
	 */
	public function get_all_inspections()
	{
		 $this->db
			->select('
                i.inspection_id,
                i.inspection_date,
                i.inspection_time,
				i.appointment_id,
                i.status,
                i.km_reading,
                i.fuel_level,
				i.revision_no,
				i.whatsapp_sent,
				i.whatsapp_sent_at,
                c.name AS customer_name,
                c.phone AS customer_phone,

                v.registration_no,
                v.brand,
                v.model
            ')
			->from('inspections i')
			->join('customers c', 'c.customer_id = i.customer_id')
			->join('vehicles v', 'v.vehicle_id = i.vehicle_id')
			->order_by('i.created_at', 'DESC');
			 apply_branch_filter('i');
			 return $this->db
			->get()
			->result();
	}

	/**
	 * Delete inspection (hard delete for now)
	 */
	public function delete_inspection($inspection_id)
	{
		$this->db->trans_start();

		// 1. Damage marks
		$this->db->where('inspection_id', $inspection_id)
			->delete('inspection_damage_marks');

		// 2. Inventory status
		$this->db->where('inspection_id', $inspection_id)
			->delete('inspection_inventory_status');

		// 3. Item results
		$this->db->where('inspection_id', $inspection_id)
			->delete('inspection_item_results');

		// 4. Photos
		$this->db->where('inspection_id', $inspection_id)
			->delete('inspection_photos');

		// 5. Services
		$this->db->where('inspection_id', $inspection_id)
			->delete('inspection_services');

		// 6. Works requested
		$this->db->where('inspection_id', $inspection_id)
			->delete('inspection_works_requested');

		// 7. MAIN inspection record (LAST)
		$this->db->where('inspection_id', $inspection_id)
			->delete('inspections');

		$this->db->trans_complete();

		return $this->db->trans_status();
	}
	public function delete_damage_marks($inspection_id)
	{
		return $this->db
			->where('inspection_id', $inspection_id)
			->delete('inspection_damage_marks');
	}
	public function delete_inventory_status($inspection_id)
	{
		return $this->db
			->where('inspection_id', $inspection_id)
			->delete('inspection_inventory_status');
	}
	public function delete_item_results($inspection_id)
	{
		return $this->db
			->where('inspection_id', $inspection_id)
			->delete('inspection_item_results');
	}
	public function delete_photos($inspection_id)
	{
		return $this->db
			->where('inspection_id', $inspection_id)
			->delete('inspection_photos');
	}
	public function delete_services($inspection_id)
	{
		return $this->db
			->where('inspection_id', $inspection_id)
			->delete('inspection_services');
	}
	public function delete_works_requested($inspection_id)
	{
		return $this->db
			->where('inspection_id', $inspection_id)
			->delete('inspection_works_requested');
	}
	public function delete_inspection_main($inspection_id)
	{
		return $this->db
			->where('inspection_id', $inspection_id)
			->delete('inspections');
	}

	// public function save_inspection_photos($inspection_id, $files)
	// {
	// 	// 1. Delete existing DB records (files already handled separately if needed)
	// 	// $this->db->where('inspection_id', $inspection_id)
	// 	// 	->delete('inspection_photos');

	// 	// 2. No new files → stop here
	// 	if (empty($files['name'][0])) {
	// 		return;
	// 	}

	// 	$this->load->library('upload');

	// 	foreach ($files['name'] as $key => $name) {

	// 		$_FILES['photo']['name']     = $files['name'][$key];
	// 		$_FILES['photo']['type']     = $files['type'][$key];
	// 		$_FILES['photo']['tmp_name'] = $files['tmp_name'][$key];
	// 		$_FILES['photo']['error']    = $files['error'][$key];
	// 		$_FILES['photo']['size']     = $files['size'][$key];

	// 		$config = [
	// 			'upload_path'   => './uploads/inspection/',
	// 			'allowed_types' => 'jpg|jpeg|png|webp',
	// 			'encrypt_name'  => TRUE,
	// 			'overwrite'     => TRUE
	// 		];

	// 		$this->upload->initialize($config);

	// 		if ($this->upload->do_upload('photo')) {

	// 			$img = $this->upload->data();

	// 			$this->db->insert('inspection_photos', [
	// 				'inspection_id' => $inspection_id,
	// 				'image_path'    => 'uploads/inspection/' . $img['file_name']
	// 			]);
	// 		}
	// 	}
	// }
	public function save_inspection_photos($inspection_id, $files)
	{
		if (empty($files) || empty($files['name'])) {
			return;
		}

		$this->load->library('upload');

		$upload_path = FCPATH . 'uploads/inspection/';

		// Create folder if it does not exist
		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0777, true);
		}

		foreach ($files['name'] as $key => $name) {

			if (empty($name)) {
				continue;
			}

			$_FILES['photo']['name']     = $files['name'][$key];
			$_FILES['photo']['type']     = $files['type'][$key];
			$_FILES['photo']['tmp_name'] = $files['tmp_name'][$key];
			$_FILES['photo']['error']    = $files['error'][$key];
			$_FILES['photo']['size']     = $files['size'][$key];

			$config = [
				'upload_path'      => $upload_path,
				'allowed_types'    => 'jpg|jpeg|png|webp',
				'max_size'         => 5120,
				'encrypt_name'     => TRUE,
				'overwrite'        => FALSE,
				'remove_spaces'    => TRUE,
				'file_ext_tolower' => TRUE
			];

			$this->upload->initialize($config);

			if ($this->upload->do_upload('photo')) {

				$img = $this->upload->data();

				$this->db->insert('inspection_photos', [
					'inspection_id' => $inspection_id,
					'image_path'    => 'uploads/inspection/' . $img['file_name']
				]);
			} else {

				log_message(
					'error',
					'Inspection photo upload failed: ' .
						$this->upload->display_errors('', '')
				);

				// Do not echo HTML from model
				// Just log the actual CodeIgniter error
			}
		}
	}
	public function save_report_photos($inspection_id, $files)
	{
		$this->load->library('upload');

		$basePath = FCPATH . 'uploads/inspection_reports/' . $inspection_id . '/';

		if (!is_dir($basePath)) {
			mkdir($basePath, 0777, true);
		}

		foreach ($files['name'] as $photo_type => $images) {
			$uploadPath = $basePath . $photo_type . '/';

			if (!is_dir($uploadPath)) {
				mkdir($uploadPath, 0777, true);
			}

			foreach ($images as $index => $imageName) {
				if (empty($imageName)) {
					continue;
				}

				$_FILES['temp_file']['name']
					= $files['name'][$photo_type][$index];

				$_FILES['temp_file']['type']
					= $files['type'][$photo_type][$index];

				$_FILES['temp_file']['tmp_name']
					= $files['tmp_name'][$photo_type][$index];

				$_FILES['temp_file']['error']
					= $files['error'][$photo_type][$index];

				$_FILES['temp_file']['size']
					= $files['size'][$photo_type][$index];

				$config = [];

				$config['upload_path']      = $uploadPath;
				$config['allowed_types']    = 'jpg|jpeg|png|webp';
				$config['max_size']         = 5120;
				$config['encrypt_name']     = TRUE;
				$config['overwrite']        = FALSE;
				$config['remove_spaces']    = TRUE;
				$config['file_ext_tolower'] = TRUE;

				$this->upload->initialize($config);

				if ($this->upload->do_upload('temp_file')) {
					$uploadData = $this->upload->data();

					$relativePath =
						'uploads/inspection_reports/' .
						$inspection_id . '/' .
						$photo_type . '/' .
						$uploadData['file_name'];

					$this->db->insert(
						'inspection_report_photos',
						[
							'inspection_id' => $inspection_id,
							'photo_type'    => $photo_type,
							'image_path'    => $relativePath,
							'created_at'    => date('Y-m-d H:i:s')
						]
					);
				} else {
					echo $this->upload->display_errors();
					exit;
				}
			}
		}
	}
	// 	public function save_report_photos($inspection_id,$files)
	// {
	//     // $upload_path = './uploads/inspection_report/';
	// 	$upload_path = FCPATH . 'uploads/inspection_report/' . $inspection_id . '/';

	//     if (!is_dir($upload_path))
	// 	{
	// 		mkdir($upload_path, 0777, true);
	// 	}

	//     foreach($files['name'] as $photo_type => $fileName)
	//     {
	//         if(empty($fileName))
	//         {
	//             continue;
	//         }

	//         $_FILES['temp_file']['name']
	//             = $files['name'][$photo_type];

	//         $_FILES['temp_file']['type']
	//             = $files['type'][$photo_type];

	//         $_FILES['temp_file']['tmp_name']
	//             = $files['tmp_name'][$photo_type];

	//         $_FILES['temp_file']['error']
	//             = $files['error'][$photo_type];

	//         $_FILES['temp_file']['size']
	//             = $files['size'][$photo_type];

	//         $config['upload_path']
	//             = $upload_path;

	//         $config['allowed_types']
	//             = 'jpg|jpeg|png|webp';

	//         $config['encrypt_name']
	//             = TRUE;

	//         $this->load->library('upload');

	//         $this->upload->initialize($config);

	//         if(!$this->upload->do_upload('temp_file'))
	// 		{
	// 			echo $photo_type . ' => ';
	// 			echo $this->upload->display_errors();
	// 			echo '<br>';
	// 			continue;
	// 		}
	// 		else{
	//             $uploadData = $this->upload->data();

	//             $path =
	//                 'uploads/inspection_report/' .$inspection_id . '/' .$uploadData['file_name'];

	//             $existing = $this->db
	//                 ->where('inspection_id',$inspection_id)
	//                 ->where('photo_type',$photo_type)
	//                 ->get('inspection_report_photos')
	//                 ->row();

	//             if($existing)
	//             {
	//                 if(file_exists(FCPATH.$existing->image_path))
	//                 {
	//                     unlink(FCPATH.$existing->image_path);
	//                 }

	//                 $this->db
	//                     ->where(
	//                         'report_photo_id',
	//                         $existing->report_photo_id
	//                     )
	//                     ->update(
	//                         'inspection_report_photos',
	//                         [
	//                             'image_path'=>$path
	//                         ]
	//                     );
	//             }
	//             else
	//             {
	//                 $this->db->insert(
	//                     'inspection_report_photos',
	//                     [
	//                         'inspection_id'=>$inspection_id,
	//                         'photo_type'=>$photo_type,
	//                         'image_path'=>$path
	//                     ]
	//                 );
	//             }
	//         }
	//     }
	// }


	// ================================================

	public function get_all_packageitems()
	{
		return $this->db

			->order_by('id', 'ASC')
			->get($this->table1)
			->result();
	}

	public function insert_packageitem($data)
	{
		return $this->db->insert($this->table1, $data);
	}

	public function update_packageitem($id, $data)
	{
		return $this->db
			->where('id', $id)
			->update($this->table1, $data);
	}
	public function delete_packageitem($id)
	{
		return $this->db
			->where('id', $id)
			->delete('inspection_packages');
	}

	public function get_packageitem($id)
	{
		return $this->db
			->where('id', $id)
			->get($this->table1)
			->row();
	}

	public function create($data)
	{
		$this->db->insert('inspections', $data);
		return $this->db->insert_id();
	}
}
