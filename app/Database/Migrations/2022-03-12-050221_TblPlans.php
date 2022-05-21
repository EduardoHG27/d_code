<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblPlans extends Migration
{
    public function up()
    {
        //

        $this->forge->addField([
            'id_plan'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'id_planshow'          => [
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
            'month'       => [
                'type'       => 'INT',
                'null' => false,
            ],
            'discount'       => [
                'type'       => 'INT',
                'null' => false,
            ],
            'status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
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
        $this->forge->addKey('id_plan', true);
        $this->forge->createTable('tbl_plans');
    }

    public function down()
    {
        //

        $this->forge->dropTable('tbl_plans'); 
    }
}
