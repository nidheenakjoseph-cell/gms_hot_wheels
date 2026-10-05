<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_company_demo_access extends CI_Migration
{
    public function up()
    {
        if (!$this->db->field_exists('demo_enabled', 'company_master')) {
            $this->dbforge->add_column('company_master', [
                'demo_enabled' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 0,
                    'null' => false,
                ],
                'demo_start_date' => [
                    'type' => 'DATE',
                    'null' => true,
                ],
                'demo_expiry_date' => [
                    'type' => 'DATE',
                    'null' => true,
                ],
                'demo_duration_days' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0,
                    'null' => false,
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->field_exists('demo_enabled', 'company_master')) {
            $this->dbforge->drop_column('company_master', 'demo_enabled');
        }
        if ($this->db->field_exists('demo_start_date', 'company_master')) {
            $this->dbforge->drop_column('company_master', 'demo_start_date');
        }
        if ($this->db->field_exists('demo_expiry_date', 'company_master')) {
            $this->dbforge->drop_column('company_master', 'demo_expiry_date');
        }
        if ($this->db->field_exists('demo_duration_days', 'company_master')) {
            $this->dbforge->drop_column('company_master', 'demo_duration_days');
        }
    }
}
