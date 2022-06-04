<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblStaffSchedule extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_schedule'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ], 'id_staff'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null' => false,
            ],
            'day'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'status_day'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'TEXT',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id_schedule', true);
        $this->forge->createTable('tab_staff_schedule');
    }

    public function down()
    {
        //
    }
}
