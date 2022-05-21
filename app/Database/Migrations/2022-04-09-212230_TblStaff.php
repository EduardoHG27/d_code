<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblStaff extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_staff'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ], 'matricula_staff'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null' => false,
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'mobile'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'default'=>'false'
            ],
            'position'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'password'       => [
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
        $this->forge->addKey('id_staff', true);
        $this->forge->createTable('tab_staff');
    }

    public function down()
    {
        //

        $this->forge->dropTable('tab_staff'); 
    }
}
