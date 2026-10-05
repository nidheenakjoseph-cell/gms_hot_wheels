<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_service_reminder_tables extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'setting_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'reminder_period_months' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 3,
                'null' => FALSE,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => 'CURRENT_TIMESTAMP',
            ],
        ]);
        $this->dbforge->add_key('setting_id', TRUE);
        $this->dbforge->create_table('service_reminder_settings', TRUE);
        $this->db->insert('service_reminder_settings', ['reminder_period_months' => 3]);

        $this->dbforge->add_field([
            'reminder_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'jobcard_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'vehicle_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'customer_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'last_service_date' => [
                'type' => 'DATE',
                'null' => FALSE,
            ],
            'next_service_date' => [
                'type' => 'DATE',
                'null' => FALSE,
            ],
            'reminder_period_months' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Pending', 'Closed'],
                'default' => 'Pending',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'closed_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('reminder_id', TRUE);
        $this->dbforge->add_key('jobcard_id');
        $this->dbforge->add_key('vehicle_id');
        $this->dbforge->add_key('customer_id');
        $this->dbforge->create_table('service_reminders', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('service_reminders', TRUE);
        $this->dbforge->drop_table('service_reminder_settings', TRUE);
    }
}
