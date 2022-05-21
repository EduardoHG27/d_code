<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Students extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ], 'matricula'          => [
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_students');
    }

    public function down()
    {
        //
        $this->forge->dropTable('user'); 
    }
}
