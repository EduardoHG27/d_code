<?php

namespace App\Controllers\Plans;

use App\Controllers\BaseController;
use App\Models\PlansModel;
use App\Models\StudetsModel;
use App\Libraries\Datatable;

class Plans extends BaseController
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
        $plansModel = new PlansModel();

        $data = [
            'id' => $this->request->getPost('id')
        ];

        

        if ($data = $plansModel->find($data['id'])) {
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
        $plansModel = new PlansModel();
        $id = $this->request->getVar('id');

       
        $data = $plansModel->find($id);
        if($data['status']=='true')
        {
            $data = [
                'status' => 'false'
            ];

            if ($plansModel->update($id, $data)) {

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

            if ($plansModel->update($id, $data)) {

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
        $plansModel = new PlansModel();
        $studentModel = new StudetsModel();

        $id = $this->request->getPost('planid');
        $id_member = $this->request->getPost('id');

        
        $plansModel->where('id', $id);
        if ($plansModel->delete()) {

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

    public function store()
    {
        $plansModel = new PlansModel();
        $data = [
            'month' => $this->request->getPost('month'),
            'discount' => $this->request->getPost('desc'),
            'status' => $this->request->getPost('status')
        ];
        
  
  
        if ($plansModel->save($data)) {

            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }

        /*
        $plansModel = new plansModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $plansModel->insert($data);
        return $this->response->redirect(site_url('/users-list'));*/
    }

    public function update()
    {
        $plansModel = new PlansModel();
        $id = $this->request->getVar('id');
        $data = [
            'month' => $this->request->getVar('month'),
            'discount'  => $this->request->getVar('discount'),
            'status'  => $this->request->getVar('status')
        ];

        if ($plansModel->update($id, $data)) {

            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }
        
    }


    public function ajaxLoadData()
    {
        /*
        $plansModel = new PlansModel();
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

            $plansModel->like('month', $search_value);
            $plansModel->orLike('discount', $search_value);
            $plansModel->orLike('status', $search_value);
            $query = $plansModel->get();
            $data = $query->getResult('array');
            $total_count = $data;

        } else if (!empty($id)) {
            $plansModel->like($like);
            $query = $plansModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        }else if (!empty($name)) {
            $plansModel->like($like);
            $query = $plansModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($email)) {
            $plansModel->like($like);
            $query = $plansModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($mobile)) {
            $plansModel->like($like);
            $query = $plansModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else {
            $data=$plansModel->findAll();
            $total_count = $data;
        }
        $json_data = array(
            "draw" => intval($params['draw']),
            "recordsTotal" => count($total_count),
            "recordsFiltered" => count($total_count),
            "data" => $data   // total data array
        );
        */


        $plansModel = new PlansModel();
        $order = $_REQUEST['order'];
        $order = array_shift($_REQUEST['order']);
        $columns = $_REQUEST['columns'];
        $like = array(
            'id_plan' => $columns[0]['search']['value'],
            'month' => $columns[1]['search']['value'],
            'discount' => $columns[2]['search']['value'],
            'status' => $columns[3]['search']['value']
        );

        $data = $plansModel->findAll();
        $total_count = $data;

        $lib = new Datatable($plansModel, 'gp1', ['id_plan', 'id_planshow', 'name', 'month', 'discount', 'status', 'created_at', 'updated_at', 'deleted_at']);
        $json_data = $lib->getResponse([
            'draw' => $_REQUEST['draw'],
            'length' => $_REQUEST['length'],
            'start' => $_REQUEST['start'],
            'total_count' => $total_count,
            'order' => $order['column'],
            'direction' => $order['dir'],
            'search' => $_REQUEST['search']['value'],
            'like' => $like
        ]);


        echo json_encode($json_data);
    }
}
