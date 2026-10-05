<?php
class Customer_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	// Insert new customer
	public function insert_customer($data)
	{
		if (!isset($data['branch_id'])) {
			$data['branch_id'] = get_primary_branch_id();
		}

		$this->db->insert('customers', $data);
		$customer_id = $this->db->insert_id();
		$insert_id = $this->db->insert_id();

		$prifix = 'CUST';

		$digit = sprintf("%1$04d", $insert_id);
		$Code = $prifix . $digit;

		$grp_no = 30;
		$data1 = array(
			'account_name' => $this->input->post('name') . ' ' . $Code,
			'group_no' => $grp_no,
			'customer_id' => $insert_id,
			'opening_bal_type' => 'Dr',
			'branch_id' => $data['branch_id'],
		);
		$this->db->insert('general_ledger', $data1);
		// return $this->db->insert_id(); // return customer_id
		return $customer_id;
	}


	// Update existing customer
	public function update_customer($customer_id, $data)
	{
		$prifix = 'CUST';
		$digit = sprintf("%1$04d", $customer_id);
		$Code = $prifix . $digit;
		$data1 = array(
			'account_name' => $this->input->post('name') . ' ' . $Code,
		);
		if (isset($data['branch_id'])) {
			$data1['branch_id'] = $data['branch_id'];
		}
		$this->db->where('customer_id', $customer_id);
		$this->db->update('general_ledger', $data1);
        
		$this->db->where('customer_id', $customer_id);
		return $this->db->update('customers', $data);

	}

	// Get single customer
	public function get_customer($customer_id)
	{
		return $this->db->where('customer_id', $customer_id)
			->get('customers')
			->row();
	}

	// Get all customers
	public function get_all_customers($search = null)
	{
		if (!empty($search)) {
			$this->db->like('name', $search);
		}

		apply_branch_filter();
		return $this->db->order_by('customer_id', 'DESC')
			->get('customers')
			->result();
	}

	public function get_all()
	{
		apply_branch_filter();
		return $this->db->order_by('name')->get('customers')->result();
	}



	// Delete customer
	public function delete_customer($customer_id)
	{
		$this->db->delete('general_ledger', ['customer_id' => $customer_id]);
		return $this->db->delete('customers', ['customer_id' => $customer_id]);
	}


	// =================================13-1-2026=================

	public function getCustomerByMobile($mobile)
	{
		return $this->db
			->select('
            c.customer_id,
            c.name,
            c.phone,
            c.email
          
        ')
			->from('customers c')
			->where('c.phone', $mobile)
			// ->where('c.status', 1)           // active customers only
			// ->limit(1)
			->get()
			->row();
	}

	public function create_customer($data)
	{
		$this->db->insert('customers', $data);

		$insert_id = $this->db->insert_id();

		$prifix = 'CUST';

		$digit = sprintf("%1$04d", $insert_id);
		$Code = $prifix . $digit;

		$grp_no = 30;
		$data1 = array(
			'account_name' => $this->input->post('name') . ' ' . $Code,
			'group_no' => $grp_no,
			'customer_id' => $insert_id,
			'opening_bal_type' => 'Dr',
		);
		$this->db->insert('general_ledger', $data1);
		return $this->db->insert_id(); // return customer_id

	}

	public function create($data)
	{
		$this->db->insert('customers', $data);

		$insert_id = $this->db->insert_id();

		$prifix = 'CUST';

		$digit = sprintf("%1$04d", $insert_id);
		$Code = $prifix . $digit;

		$grp_no = 30;
		$data1 = array(
			'account_name' => $this->input->post('name') . ' ' . $Code,
			'group_no' => $grp_no,
			'customer_id' => $insert_id,
			'opening_bal_type' => 'Dr',
		);
		$this->db->insert('general_ledger', $data1);
		return $this->db->insert_id(); // return customer_id
	}
/**
	 * Create customer and corresponding ledger using provided data array.
	 * Uses $data['name'] for the account name (does not rely on POST).
	 * Returns the new customer id.
	 */
	public function create_with_ledger(array $data)
	{
        $customerData = [
            'name'      => $data['name'] ?? null,
            'phone'     => $data['phone'] ?? null,
            'email'     => $data['email'] ?? null,
            'address'   => $data['address'] ?? null,
            'trn'       => $data['trn'] ?? null,
            'emirates'  => $data['emirates'] ?? null,
        ];

        $this->db->insert('customers', $customerData);
        $insert_id = $this->db->insert_id();

        $prifix = 'CUST';
        $digit = sprintf("%04d", $insert_id);
        $Code = $prifix . $digit;

        $grp_no = 30;
        $account_name = ($customerData['name'] ?? '') . ' ' . $Code;

        $data1 = [
            'account_name'      => $account_name,
            'group_no'          => $grp_no,
            'customer_id'       => $insert_id,
            'opening_balance'   => 0.00,
            'opening_bal_type'  => 'Dr',
            'isdeleteable'      => 'N'
        ];

        $this->db->insert('general_ledger', $data1);

        return $insert_id;
    }
	public function filter_customers($filters = [])
	{
		$this->db->select('c.*');
		$this->db->from('customers c');
		$this->db->where('c.customer_type', 'individual');
		apply_branch_filter('c');

		// Customer filters
		if (!empty($filters['name'])) {
			$this->db->like('c.name', $filters['name']);
		}

		if (!empty($filters['phone'])) {
			$this->db->like('c.phone', $filters['phone']);
		}

		// Vehicle filters (multiple vehicles safe)
		if (!empty($filters['plate']) || !empty($filters['vin'])) {

			$plate = $filters['plate'] ?? '';
			$vin   = $filters['vin'] ?? '';

			$this->db->where("
				EXISTS (
					SELECT 1 FROM vehicles v
					WHERE v.customer_id = c.customer_id
					" . ($plate ? "AND v.registration_no LIKE '%$plate%'" : "") . "
					" . ($vin ? "AND v.chassis_no LIKE '%$vin%'" : "") . "
				)
			", null, false);
		}

		return $this->db
			->order_by('c.customer_id', 'DESC')
			->get()
			->result();
	}
 
	public function sync_customers_to_ledger()
	{
		$customers = $this->db->get('customers')->result();
		$count = 0;

		foreach ($customers as $cust) {

			// 🔒 Prevent duplicate ledger creation
			$exists = $this->db->where('customer_id', $cust->customer_id)
				->get('general_ledger')
				->row();

			if ($exists) {
				continue;
			}

			// Generate Code like CUST0001
			$digit = sprintf("%04d", $cust->customer_id);
			$code  = 'CUST' . $digit;

			$data = [
				'account_name'      => $cust->name . ' ' . $code,
				'group_no'          => 30,
				'customer_id'       => $cust->customer_id,
				'opening_balance'   => 0.00,
				'opening_bal_type'  => 'Dr',
				'isdeleteable'      => 'N'
			];

			$this->db->insert('general_ledger', $data);
			$count++;
		}

		return $count;
	}

	// ======================function to list customers who is not having ledger account ===
	public function get_customers_without_ledger()
	{
		$this->db->select('c.customer_id, c.name, c.phone, c.email, c.trn');
		$this->db->from('customers c');

		// Join with general_ledger
		$this->db->join('general_ledger gl', 'gl.customer_id = c.customer_id', 'left');

		// Only customers without ledger account
		$this->db->where('gl.customer_id IS NULL', null, false);

		return $this->db->get()->result();
	}

	public function create_missing_customer_ledgers()
	{
		$this->db->trans_start();

		// Step 1: Get customers without ledger
		$this->db->select('c.customer_id, c.name');
		$this->db->from('customers c');
		$this->db->join('general_ledger gl', 'gl.customer_id = c.customer_id', 'left');
		$this->db->where('gl.customer_id IS NULL', null, false);

		$customers = $this->db->get()->result();

		if (empty($customers)) {
			$this->db->trans_complete();
			return 0; // No customers missing ledger
		}

		// Step 2: Insert ledger accounts
		foreach ($customers as $cust) {

			// 🔒 Prevent duplicate ledger creation
			$exists = $this->db->where('customer_id', $cust->customer_id)
				->get('general_ledger')
				->row();

			if ($exists) {
				continue;
			}

			// Generate Code like CUST0001
			$digit = sprintf("%04d", $cust->customer_id);
			$code  = 'CUST' . $digit;

			$data = [
				'account_name'      => $cust->name . ' ' . $code,
				'group_no'          => 30,
				'customer_id'       => $cust->customer_id,
				'opening_balance'   => 0.00,
				'opening_bal_type'  => 'Dr',
				'isdeleteable'      => 'N'
			];

			$this->db->insert('general_ledger', $data);
		}
		$this->db->trans_complete();

		return count($customers);
	}
// scrap


	public function search_customers($term = '', $limit = 50)
	{
		$this->db->select('c.customer_id as id, c.name as text, gl.account_id as ledger_id');
		$this->db->from('customers c');
		$this->db->join('general_ledger gl', 'gl.customer_id = c.customer_id', 'left');
		if (!empty($term)) {
			$this->db->like('c.name', $term);
		}
		$this->db->order_by('c.name');
		$this->db->limit($limit);
		return $this->db->get()->result();
	}

	public function get_customer_by_name($name)
	{
		return $this->db->where('name', $name)
			->get('customers')
			->row();
	}

	public function get_customer_ledger($customer_id)
	{
		return $this->db->where('customer_id', $customer_id)
			->get('general_ledger')
			->row();
	}

	// ======================== Fleet Customers Logic =====================
	
	public function filter_fleet_customers($filters = [])
	{
		$this->db->select('c.*');
		$this->db->from('customers c');
		$this->db->where('c.customer_type', 'fleet');
		apply_branch_filter('c');
	
		if (!empty($filters['name'])) {
			$this->db->like('c.name', $filters['name']);
		}
	
		if (!empty($filters['phone'])) {
			$this->db->like('c.phone', $filters['phone']);
		}
	
		if (!empty($filters['plate']) || !empty($filters['vin'])) {
	
			$plate = $filters['plate'] ?? '';
			$vin   = $filters['vin']   ?? '';
	
			$this->db->where("
				EXISTS (
					SELECT 1 FROM vehicles v
					WHERE v.customer_id = c.customer_id
					" . ($plate ? "AND v.registration_no LIKE '%$plate%'" : "") . "
					" . ($vin   ? "AND v.chassis_no LIKE '%$vin%'"       : "") . "
				)
			", null, false);
		}
	
		return $this->db
			->order_by('c.customer_id', 'DESC')
			->get()
			->result();
	}
	
	// Get all fleet customers simple list 
	public function get_all_fleet_customers()
	{
		return $this->db
			->where('customer_type', 'fleet')
			->order_by('name')
			->get('customers')
			->result();
	}

	public function delete_vehicles_by_customer($customer_id)
	{
		return $this->db->delete('vehicles', ['customer_id' => $customer_id]);
	}


	


	




























































}
