<?php

namespace App\Controllers\Pays;

use App\Controllers\BaseController;
use App\Models\PaysModel;
use App\Models\StudetsModel;
use App\Libraries\Datatable;


class Pays extends BaseController
{
    public $db;

    public function __construct()
    {

        $this->db = \Config\Database::connect();
    }

    public function listStudent()
    {
        return view('list-student');
    }

    public function create()
    {
        return view('add_user');
    }


    public function get_plan()
    {
        $PaysModel = new PaysModel();

        $data = [
            'id' => $this->request->getPost('id')
        ];

        

        if ($data = $PaysModel->find($data['id'])) {
            $consulta['resp'] = '1';
            $consulta['data'] = $data;
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }
    }


    public function status_up()
    {
        $PaysModel = new PaysModel();
        $id = $this->request->getVar('id');

       
        $data = $PaysModel->find($id);
        if($data['status']=='true')
        {
            $data = [
                'status' => 'false'
            ];

            if ($PaysModel->update($id, $data)) {

                $consulta['resp'] = '1';
                echo json_encode($consulta);
            } else {
    
                $consulta['resp'] = '0';
                echo json_encode($consulta);
            }
        }
        else
        {
            $data = [
                'status' => 'true'
            ];

            if ($PaysModel->update($id, $data)) {

                $consulta['resp'] = '1';
                echo json_encode($consulta);
            } else {
    
                $consulta['resp'] = '0';
                echo json_encode($consulta);
            }
        }
     
    }

    

   public function delete()
   {
       $payModel = new PaysModel();
       $studentModel = new StudetsModel();

       $id = $this->request->getPost('payid');
       $id_member = $this->request->getPost('id');

       
       
       $payModel->where('id_pay', $id);
       if ($payModel->delete()) {

           $data = [
               'status' => 'false'
           ];

           if($studentModel->update($id_member, $data))
           {
               $consulta['resp'] = '1';
               echo json_encode($consulta);
           }else
           {$consulta['resp'] = '0';
               echo json_encode($consulta);
           }
       } else {

           $consulta['resp'] = '0';
           echo json_encode($consulta);
       }
   }

    public function delete1()
    {
        $PaysModel = new PaysModel();

        $id = $this->request->getPost('id');
        $PaysModel->where('id', $id);
        if ($PaysModel->delete()) {

            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }
    }

    

    public function store()
    {
        $PaysModel = new PaysModel();
        $data = [
            'month' => $this->request->getPost('month'),
            'discount' => $this->request->getPost('desc'),
            'status' => $this->request->getPost('status')
        ];
        
  
  
        if ($PaysModel->save($data)) {

            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }

        /*
        $PaysModel = new PaysModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $PaysModel->insert($data);
        return $this->response->redirect(site_url('/users-list'));*/
    }

    public function update()
    {
        $PaysModel = new PaysModel();
        $id = $this->request->getVar('id');
        $data = [
            'month' => $this->request->getVar('month'),
            'discount'  => $this->request->getVar('discount'),
            'status'  => $this->request->getVar('status')
        ];

        if ($PaysModel->update($id, $data)) {

            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }
        
    }


    public function ajaxLoadData()
    {
        $PaysModel = new PaysModel();
        $params['draw'] = $_REQUEST['draw'];
        $columns = $_REQUEST['columns'];
        
        $id = $columns[0]['search']['value'];
        $name = $columns[1]['search']['value'];
        $email = $columns[2]['search']['value'];
        $mobile = $columns[3]['search']['value'];

        $like = array(
            'id_plan' => $columns[0]['search']['value'],
            'month' => $columns[1]['search']['value'],
            'discount' => $columns[2]['search']['value'],
            'status' => $columns[3]['search']['value']
        );

        $search_value = $_REQUEST['search']['value'];

        
        if (!empty($search_value)) {

            $PaysModel->like('month', $search_value);
            $PaysModel->orLike('discount', $search_value);
            $PaysModel->orLike('status', $search_value);
            $query = $PaysModel->get();
            $data = $query->getResult('array');
            $total_count = $data;

        } else if (!empty($id)) {
            $PaysModel->like($like);
            $query = $PaysModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        }else if (!empty($name)) {
            $PaysModel->like($like);
            $query = $PaysModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($email)) {
            $PaysModel->like($like);
            $query = $PaysModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($mobile)) {
            $PaysModel->like($like);
            $query = $PaysModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else {
            $data=$PaysModel->findAll();
            $total_count = $data;
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
