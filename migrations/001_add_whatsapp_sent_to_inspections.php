<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_whatsapp_sent_to_inspections extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_column('inspections', [
            'whatsapp_sent' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
                'after' => 'techremarks'
            ],
            'whatsapp_sent_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'after' => 'whatsapp_sent'
            ]
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_column('inspections', 'whatsapp_sent');
        $this->dbforge->drop_column('inspections', 'whatsapp_sent_at');
    }
}
