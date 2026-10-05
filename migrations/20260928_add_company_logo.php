<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_company_logo extends CI_Migration
{
    public function up()
    {
        if (!$this->db->field_exists('company_logo', 'company_master')) {
            $this->dbforge->add_column('company_master', [
                'company_logo' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->field_exists('company_logo', 'company_master')) {
            $this->dbforge->drop_column('company_master', 'company_logo');
        }
    }
}