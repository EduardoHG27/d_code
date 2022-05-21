<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblMembersPay extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_pay'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'id_member'       => [
                'type'       => 'VARCHAR',
                'constraint' => '4',
                'null' => false,
            ], 
            'id_payshow'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null' => false,
            ],
            'date_in'       => [
                'type'       => 'date',
                'null' => false,
            ],
            'date_out'       => [
                'type'       => 'date',
                'null' => false,
            ],
            'cost'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null' => false,
            ],
            'pay_status'       => [
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
        $this->forge->addKey('id_pay', true);
        $this->forge->createTable('tbl_members_pay');
    }

    public function down()
    {
        //
    }
}
