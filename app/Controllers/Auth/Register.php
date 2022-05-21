<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\StudetsModel;
use App\Models\StaffModel;

class Register extends BaseController
{
    protected $configs;
    public function _construct()
    {
        $this->configs = config('Blog');
    }
    public function index()
    {
        $staffModel = new StaffModel();
        $data_staff = [
            'matricula_staff' => '10',
            'name' => 'admin',
            'email' =>'Admin@gmail.com',
            'mobile' =>'7717003488',
            'status' =>'true',
            'position' =>'manager',
            'password' => md5('admin'),
           
        ];

        $staffModel->save($data_staff);

        $studetsModel = new StudetsModel();
        $data = [
            'name' => 'admin',
            'email' =>'Admin@gmail.com',
            'mobile' =>'7717003488',
            'password' => md5('admin'),
            'status' => 'true'
        ];

        $studetsModel->save($data);
      /*

        $model = model('UsersModel');

        $data = [
            'username' => 'edu@gmail.com',
            'password' => '1',
            'type'=> '3'
        ];


        $user = new User($data);
        $model->save($user);
        */
        d($studetsModel);
        return view('Auth/view_register');
    }

    public function store()
    {
        return view('welcome_message');
    }

    public function ajaxLoadData()
    {

        
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];

        if(!empty($search_value)){
            // If we have value in search, searching by id, name, email, mobile

            // count all data
            $total_count = $this->db->query("SELECT * from tbl_students WHERE id like '%".$search_value."%' OR name like '%".$search_value."%' OR email like '%".$search_value."%' OR mobile like '%".$search_value."%'")->getResult();

            $data = $this->db->query("SELECT * from tbl_students WHERE id like '%".$search_value."%' OR name like '%".$search_value."%' OR email like '%".$search_value."%' OR mobile like '%".$search_value."%' limit $start, $length")->getResult();
        }else{
            // count all data
            $total_count = $this->db->query("SELECT * from tbl_students")->getResult();

            // get per page data
            $data = $this->db->query("SELECT * from tbl_students limit $start, $length")->getResult();
        }
        
        $json_data = array(
            "draw" => intval($params['draw']),
            "recordsTotal" => count($total_count),
            "recordsFiltered" => count($total_count),
            "data" => $data   // total data array
        );

        echo json_encode($json_data);
        
        }
}
