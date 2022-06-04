<?php

namespace App\Controllers\Staff;


use App\Controllers\BaseController;
use App\Models\StudetsModel;
use App\Models\PlansModel;
use App\Models\PaysModel;
use App\Models\StaffModel;
use App\Models\StaffscheduleModel;
use App\Entities\Student_ent;
use App\Libraries\Datatable;
use App\Libraries\PHPMailer_lib;

class Staff extends BaseController
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
        $staffModel = new StaffModel();

        $id = $this->request->getPost('id');
        $staffModel->where('id_staff', $id);


        if ($staffModel->delete()) {
            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }
    }

    public function store()
    {
        $mail = new PHPMailer_lib();
        $year = date("Y");
        $staffModel = new StaffModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'mobile' => $this->request->getPost('mobile'),
            'position' => $this->request->getPost('charge'),
            'password' => md5($this->request->getPost('password'))
        ];


        $staffModel->select('*');
        $staffModel->where('name', $this->request->getPost('name'));
        $staffModel->orWhere('email', $this->request->getPost('email'));
        $query = $staffModel->get();
        $data_validation = $query->getResult('array');

        if (empty($data_validation)) {

            $correo = $mail->load();
            $correo->isSMTP();
            $correo->Host = 'smtp.gmail.com';
            $correo->Port = 465;
            $correo->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $correo->SMTPAuth = true;
            //$correo->Username  = 'gym_service@gym-system.ecommerce343.com';
            $correo->Username  = 'desarrollo.hergut@gmail.com';
            //$correo->Password = 'Hergut27!';
            $correo->Password = 'hergut27';
            $correo->SMTPSecure = 'ssl';

            $correo->setFrom('desarrollo.hergut@gmail.com', 'CodexWorld');
            $correo->addReplyTo($this->request->getPost('email'), 'Codexworld');
            $correo->addAddress($this->request->getPost('email'));
            $correo->Subject = 'Registro de Usuario Exitoso';
            $correo->isHTML(true);
            $mailcontent = "<h1>Bienvenido, Ya eres miembro!!</h1>
             <p>Tu contraseña para Ingresar es : </p>" . $this->request->getPost('password');

            $correo->Body = $mailcontent;

            if(!$correo->send()) {
           

                $consulta['resp'] = '2';
                $consulta['msj_error'] = $correo->ErrorInfo;
                echo json_encode($consulta);

            } else {

                $staffModel->save($data);
                $consulta['id'] = $staffModel->insertID();
              
                $data = [
                    'matricula_staff' =>  $year . $consulta['id']
                ];
                $staffModel->update($consulta['id'], $data);
                $consulta['resp'] = '1';
                echo json_encode($consulta);
            }

        } else {

            $consulta['resp'] = '3';
            echo json_encode($consulta);
        }



       
        /*



         if ($staffModel->save($data)) {
            $consulta['id'] = $staffModel->insertID();
            $data = [
                'matricula' =>  $year . $consulta['id']
            ];
            $staffModel->update($consulta['id'], $data);
            $consulta['resp'] = '1';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '0';
            echo json_encode($consulta);
        }


        $studetsModel = new StudetsModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $studetsModel->insert($data);
        return $this->response->redirect(site_url('/users-list'));*/
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

    public function schedule()
    {

        $staffModel = new StaffscheduleModel();
        var_dump("data");
    }

    public function ajaxLoadDataStaff()
    {
        $staffModel = new StaffModel();
        $order = $_REQUEST['order'];
        $order = array_shift($_REQUEST['order']);


        $columns = $_REQUEST['columns'];


        if ($columns[4]['search']['value'] == '2') {
            $columns[4]['search']['value'] = 'false';
        } else if ($columns[4]['search']['value'] == '1') {
            $columns[4]['search']['value'] = 'true';
        } else {
            $columns[4]['search']['value'] = '';
        }
        $like = array(
            'matricula' => $columns[0]['search']['value'],
            'name' => $columns[1]['search']['value'],
            'email' => $columns[2]['search']['value'],
            'mobile' => $columns[3]['search']['value'],
            'status' => $columns[4]['search']['value']
        );

        $data = $staffModel->findAll();
        $total_count = $data;

        $lib = new Datatable($staffModel, 'gp1', ['id_staff', 'matricula_staff', 'name', 'email', 'mobile', 'status', 'position', 'password', 'created_at', 'updated_at', 'deleted_at']);
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
        /*


       
        $json_data = array(
            "draw" => intval($params['draw']),
            "length" => $_REQUEST['length'],
            "start" => $_REQUEST['start'],
            "recordsTotal" => count($total_count),
            "recordsFiltered" => count($total_count),
            "data" => $data   // total data array
        );


   /*
        $json_data = array(
            "draw" => intval($params['draw']),
            "recordsTotal" => count($total_count),
            "recordsFiltered" => count($total_count),
            "data" => $data   // total data array
        );
 */

        echo json_encode($json_data);
    }




    public function get_staff()
    {
        $staffModel = new StaffModel();
        $data = [
            'id' => $this->request->getPost('id')
        ];
        if($data = $staffModel->find($data['id']))
        {
            $consulta['resp'] = '1';
            $consulta['data'] = $data;
            echo json_encode($consulta);
        }
        else
        {
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


            $studetsModel->update($this->request->getPost('id'), $data);

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
