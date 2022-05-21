<?php

namespace App\Controllers\Informativo;

use App\Controllers\BaseController;
use App\Models\StudetsModel;
use App\Models\PlansModel;
use App\Models\PaysModel;
use App\Models\InformativoModel;


class Informativo extends BaseController
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


    public function get_student()
    {
        $studetsModel = new StudetsModel();
        $paysModel = new PaysModel();


        $data = [
            'id' => $this->request->getPost('id')
        ];


        $pay_data = $paysModel->where('id_member', $data['id'])->first();;


        if ($data = $studetsModel->find($data['id'])) {

            $consulta['resp'] = '1';
            $consulta['data'] = $data;
            $consulta['pay'] = $pay_data;
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }
    }

    public function get_plan_data()
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


    public function chek_delete()
    {
        $paysModel = new PaysModel();

        $id = $this->request->getPost('id');

        if ($pay_data = $paysModel->where('id_member', $id)->first()) {

            $consulta['data'] = $pay_data;
            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }
    }

    public function delete()
    {
        $studetsModel = new StudetsModel();
        

        $id = $this->request->getPost('id');
        $studetsModel->where('id', $id);


        if ($studetsModel->delete()) {
            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }
    }


    public function update()
    {
        $studetsModel = new StudetsModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
            'mobile'  => $this->request->getVar('mobile')
        ];


        if ($studetsModel->update($id, $data)) {

            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }
    }


    public function ajaxLoadData()
    {
        $infoModel = new InformativoModel();
        $studentModel = new StudetsModel();
        $params['draw'] = $_REQUEST['draw'];
        $columns = $_REQUEST['columns'];

        $id = $columns[0]['search']['value'];
        $id_member = $columns[1]['search']['value'];
        $usuario = $columns[2]['search']['value'];
        $fecha_inicio = $columns[3]['search']['value'];
        $fecha_final = $columns[4]['search']['value'];
        $pago = $columns[5]['search']['value'];


        $like = array(
            'id_pay' => $columns[0]['search']['value'],
            'id_member' => $columns[1]['search']['value'],
            'name' => $columns[2]['search']['value'],
            'date_in' => $columns[3]['search']['value'],
            'date_out' => $columns[4]['search']['value'],
            'cost' => $columns[5]['search']['value'],

        );

        $search_value = $_REQUEST['search']['value'];


        if (!empty($search_value)) {
            $infoModel->join('tbl_students', 'tbl_students.id = tbl_members_pay.id_member');
            $infoModel->like('date_in', $search_value);
            $infoModel->orLike('date_out', $search_value);
            $infoModel->orLike('cost', $search_value);
            $infoModel->orLike('id_member', $search_value);
            $infoModel->orLike('id_pay', $search_value); 
            $query = $infoModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($id)) {
            $infoModel->join('tbl_students', 'tbl_students.id = tbl_members_pay.id_member');
            $infoModel->like($like);
            $query = $infoModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($id_member)) {
            $infoModel->join('tbl_students', 'tbl_students.id = tbl_members_pay.id_member');
            $infoModel->like($like);
            $query = $infoModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($usuario)) {
            $infoModel->join('tbl_students', 'tbl_students.id = tbl_members_pay.id_member');
            $infoModel->like($like);
            $query = $infoModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($fecha_final)) {
            $infoModel->like($like);
            $query = $infoModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else {
            $infoModel->join('tbl_students', 'tbl_students.id = tbl_members_pay.id_member');
            $data = $infoModel->findAll();
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



    public function get_plan()
    {
        $planModel = new PlansModel();

        $planModel->select('*');
        $planModel->where('status', 'true');
        $query = $planModel->get();


        if ($data = $query->getResult('array')) {

            $consulta['data'] = $data;
            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }
    }


    public function store_planmember()
    {
        $paysModel = new PaysModel();
        $data = [
            'discount' => $this->request->getPost('discount'),
            'month' => $this->request->getPost('month'),
            'cost' => $this->request->getPost('cost'),
            'id' => $this->request->getPost('id')
        ];



        $date = date('Y-m-d');

        $newDate = date('Y-m-d', strtotime($date . ' + ' . $data['month'] . ' months'));


        $data_plan = [
            'discount' => $this->request->getPost('discount'),
            'date_in' => $date,
            'date_out' => $newDate,
            'id_member' => $this->request->getPost('id'),
            'cost' => $this->request->getPost('cost')
        ];


        if ($paysModel->save($data_plan)) {

            $studetsModel = new StudetsModel();
       
            $data = [
                'status' => 'true'
            ];
            
         
            $studetsModel->update($this->request->getPost('id'),$data);

            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }

        /*
        $studetsModel = new StudetsModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $studetsModel->insert($data);
        return $this->response->redirect(site_url('/users-list'));*/
    }
}
