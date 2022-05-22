<?php


namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\StudetsModel;
use App\Models\PlansModel;
use App\Models\PaysModel;
use App\Entities\Student_ent;
use App\Libraries\Datatable;
use App\Libraries\PHPMailer_lib;




class Student extends BaseController
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




        if ($data = $studetsModel->find($data['id'])) {

            $paysModel->select();
            $paysModel->where('id_member', $data['id']);
            $paysModel->where('pay_status', 'true');
            $query = $paysModel->get();
            $pay_data = $query->getResult('array');


            //$pay_data = $paysModel->where('id_member', $data['id'])->findAll();





            if ($pay_data == null) {
                $consulta['resp'] = '1';
                $consulta['data'] = $data;
                $consulta['pay'] = null;
                echo json_encode($consulta);
            } else if ($pay_data[0]['pay_status'] == 'false') {
                $consulta['resp'] = '1';
                $consulta['data'] = $data;
                $consulta['pay'] = null;
                echo json_encode($consulta);
            } else {

                $consulta['resp'] = '1';
                $consulta['data'] = $data;
                $consulta['pay'] = $pay_data;


                echo json_encode($consulta);
            }
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

        $paysModel->select('*');
        $paysModel->where('id_member', $this->request->getPost('id'));
        $paysModel->where('pay_status', 'true');
        $query = $paysModel->get();
        $data_validation = $query->getResult('array');

        if (!empty($data_validation)) {

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



    public function log()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password')
        ];
        $email = trim($data['username']);
        //$password = trim($this->request->getVar('password'));

        $password = md5($data['password']);
        $model = model('StudetsModel');

        if (!$user = $model->getUserBy('name', $email)) {

            /* return redirect()->back()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'Este usuario no se encuentra registrado en el sistema'
                ]);
                */
            $consulta['data'] = '0';
            $consulta['msj'] = 'Este usuario no se encuentra registrado en el sistema';

            echo json_encode($consulta);
        } else {


            if ($user['name'] == 'admin') {
                if ($password != $user['password']) {

                    $consulta['data'] = '1';
                    $consulta['msj'] = 'Contraseña Incorrecta';
                    echo json_encode($consulta);
                } else {
                    $consulta['data'] = '5';
                    $consulta['msj'] = 'Admin';
                    echo json_encode($consulta);
                }
            } else {
                if ($password != $user['password']) {
                    // if (!password_verify($password, $user->username)) {
                    $consulta['data'] = '1';
                    $consulta['msj'] = 'Contraseña Incorrecta';

                    echo json_encode($consulta);
                } else if ($user['status'] != 'true') {
                    $consulta['data'] = '2';
                    $consulta['msj'] = 'Usuario se agoto su membresia';
                    echo json_encode($consulta);
                } else {

                    $consulta['data'] = '3';
                    $consulta['msj'] = 'Usuario Activo';
                    echo json_encode($consulta);
                }
            }
        }
    }

    public function store()
    {


        $mail = new PHPMailer_lib();

      





        $year = date("Y");
        $studetsModel = new StudetsModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'mobile' => $this->request->getPost('mobile'),
            'password' => md5($this->request->getPost('password'))
        ];

        $studetsModel->select('*');
        $studetsModel->where('name', $this->request->getPost('name'));
        $studetsModel->orWhere('email', $this->request->getPost('email'));
        $query = $studetsModel->get();
        $data_validation = $query->getResult('array');


        if (empty($data_validation)) {

          

            if ($studetsModel->save($data)) {
                $correo = $mail->load();
                $correo->isSMTP();
                $correo->Host = 'smtp.hostinger.com';
                $correo->Port = 465;
                $correo->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
             
                $correo->SMTPAuth = true;
                $correo->Username  = 'gym_service@gym-system.ecommerce343.com';
                $correo->Password = 'Hergut27!';
                $correo->SMTPSecure = 'ssl';
                
                $correo->setFrom('gym_service@gym-system.ecommerce343.com', 'CodexWorld');
                $correo->addReplyTo($this->request->getPost('email'), 'Codexworld');
                $correo->addAddress($this->request->getPost('email'));
                $correo->Subject = 'Registro de Usuario Exitoso';
                $correo->isHTML(true);
                $mailcontent = "<h1>Bienvenido, Ya eres miembro!!</h1>
                 <p>Tu contraseña para Ingresar es : </p>".$this->request->getPost('password');
        
                $correo->Body = $mailcontent;
                
                if($correo->send())
                {
                    $consulta['id'] = $studetsModel->insertID();
                    $data = [
                        'matricula' =>  $year . $consulta['id']
                    ];
                    $studetsModel->update($consulta['id'], $data);
                    $consulta['resp'] = '1';
    
                   
                    echo json_encode($consulta);
                }
                else
                {
                    $consulta['resp'] = '2';
    
                   
                    echo json_encode($consulta);
                }
              
            } else {

                $consulta['resp'] = '0';
                echo json_encode($consulta);
            }
        } else {

            $consulta['resp'] = '3';
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



        // $params['draw'] = $_REQUEST['draw'];

        /*
        $id = $columns[0]['search']['value'];
        $name = $columns[1]['search']['value'];
        $email = $columns[2]['search']['value'];
        $mobile = $columns[3]['search']['value'];
*/

        /*
        $search_value = $_REQUEST['search']['value'];


        if (!empty($search_value)) {

            $studetsModel->like('name', $search_value);
            $studetsModel->orLike('email', $search_value);
            $studetsModel->orLike('mobile', $search_value);
            $query = $studetsModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($id)) {
            $studetsModel->like($like);
            $query = $studetsModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($name)) {
            $studetsModel->like($like);
            $query = $studetsModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($email)) {
            $studetsModel->like($like);
            $query = $studetsModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else if (!empty($mobile)) {
            $studetsModel->like($like);
            $query = $studetsModel->get();
            $data = $query->getResult('array');
            $total_count = $data;
        } else {
            $data = $studetsModel->findAll();
            $total_count = $data;
        }
*/

        $studetsModel = new StudetsModel();
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



        $data = $studetsModel->findAll();
        $total_count = $data;

        $lib = new Datatable($studetsModel, 'gp1', ['id', 'matricula', 'name', 'email', 'mobile', 'status', 'password', 'created_at', 'updated_at', 'deleted_at']);
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

    public function test()
    {
       $data=[100, 100, 100, 100, 100, 100, 40];
       $consulta['datos']=$data;
       $consulta['resp'] = '1';

       echo json_encode($consulta);
    }


    public function get_plan()
    {
        $planModel = new PlansModel();

        $planModel->select('*');
        $planModel->where('status', 'true');
        $query = $planModel->get();

        if ($data = $query->getResult('array')) {

            //var_dump($data);
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
            'cost' => $this->request->getPost('cost'),
            'pay_status' => 'true'
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
