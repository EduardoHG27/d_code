<?php


namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\StudetsModel;
use App\Models\PlansModel;
use App\Models\PaysModel;
use App\Entities\Student_ent;
use App\Libraries\Datatable;
use App\Libraries\PHPMailer_lib;
use App\Libraries\qr;

use function PHPUnit\Framework\isNull;

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
        $nombre = trim($data['username']);
        //$password = trim($this->request->getVar('password'));

        $password = md5($data['password']);
        $model = model('StudetsModel');

        if (!$user = $model->getUserBy('name', $nombre)) {

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
        $qr = new qr();
        $mail = new PHPMailer_lib();
        $year = date("Y");
        $studetsModel = new StudetsModel();


        $studetsModel->select('*');
        $studetsModel->where('name', $this->request->getPost('name'));
        $studetsModel->orWhere('email', $this->request->getPost('email'));
        $query = $studetsModel->get();
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
            $correo->Username  = 'desarrollo.hergut@gmail.com';
            // $correo->Password = 'Hergut27!';
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

            if (!$correo->send()) {


                $consulta['resp'] = '2';
                $consulta['msj_error'] = $correo->ErrorInfo;
                echo json_encode($consulta);
            } else {


                $number = rand();



                $loc = "qr/{$number}.png";
                $location = FCPATH . $loc;


                $resp = $qr->create_qr(md5($this->request->getPost('password')) . $number, $location);


                $data = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'mobile' => $this->request->getPost('mobile'),
                    'password' => md5($this->request->getPost('password')),
                    'qr_location' => $loc,
                    'password_qr' => md5($this->request->getPost('password')) . $number
                ];

                $studetsModel->save($data);
                $consulta['id'] = $studetsModel->insertID();
                $data = [
                    'matricula' =>  $year . $consulta['id']
                ];
                $studetsModel->update($consulta['id'], $data);
                $consulta['resp'] = '1';


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

    public function qr()
    {
        $studetsModel = new StudetsModel();
        $data = [
            'id' => $this->request->getPost('id')
        ];

        $studetsModel->select('name,matricula');
        $studetsModel->where('password_qr', $this->request->getPost('id'));
        $query = $studetsModel->get();
        $data_validation = $query->getResult('array');

        $dat=count($data_validation);
        if ($dat=='0') {
            $consulta['resp'] = '0';
            $consulta['data'] = 'Código QR no reconocido';
            echo json_encode($consulta);
        } else {
            
            $consulta['resp'] = '1';
            $consulta['data'] = $data_validation;
            echo json_encode($consulta);
        }
    }

    public function get_qr()
    {
        $studetsModel = new StudetsModel();
        $data = [
            'id' => $this->request->getPost('id')
        ];


        $data = $studetsModel->find($data['id']);


        if ($data['qr_location'] == '') {
            $consulta['resp'] = '0';
            echo json_encode($consulta);
        } else {

            $consulta['resp'] = '1';
            $consulta['data'] = $data['qr_location'];
            echo json_encode($consulta);
        }
    }

    public function update()
    {
        $studetsModel = new StudetsModel();
        $mail = new PHPMailer_lib();
        $id = $this->request->getVar('id');

        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
            'mobile'  => $this->request->getVar('mobile')
        ];


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
         <p>Tu contraseña para Ingresar es : </p>" . $this->request->getPost('password');

        $correo->Body = $mailcontent;

        if (!$correo->send()) {

            $consulta['resp'] = '2';
            $consulta['msj_error'] = $correo->ErrorInfo;
            echo json_encode($consulta);
        } else {

            $studetsModel->update($id, $data);

            $consulta['resp'] = '1';
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

    public function dash()
    {
        $paysModel = new PaysModel();
        $paysModel->select('cost,date_in');
        $paysModel->orderBy('date_in', 'ASC');
        $query = $paysModel->get();
        $get_total = $query->getResult('array');
        $i = 0;
        $j = 0;
        $arr = [];
        $suma = 0;
        $data = count($get_total);


        foreach ($get_total as $key => $value) {
            if ($i == $data - 1) {
                $arr[$j] = $suma + $value['cost'];
                $suma = 0;
            } else {
                $fecha = $value['date_in'];
                $pieces = explode("-", $fecha);
                $pieces[1];
                $fecha = $get_total[$i + 1]['date_in'];
                $pieces_1 = explode("-", $fecha);
                $pieces_1[1];
                if ($pieces[1] == $pieces_1[1]) {
                    $suma = $value['cost'] + $suma;
                } else {
                    $arr[$j] = $suma + $value['cost'];
                    $suma = 0;
                    $j++;
                }
                $i++;
            }
        }




        $arr_dat = array();
        foreach ($arr as $key => $value) {
            $arr_dat[] = $value;
        }

        $mes = [];
        $j = -1;
        foreach ($get_total as $key => $value) {
            $fecha = $value['date_in'];
            $pieces = explode("-", $fecha);
            $pieces[1];


            if ($pieces[1] == '01') {
                $mes[$j + 1] = 'Ene';
            } else if ($pieces[1] == '02') {
                foreach ($mes as $key => $value) {
                    if ($value == '02') {
                    } else {
                        $mes[$j + 2] = 'Feb';
                    }
                }
            } else if ($pieces[1] == '03') {
                foreach ($mes as $key => $value) {
                    if ($value == '03') {
                    } else {
                        $mes[$j + 3] = 'Mar';
                    }
                }
            } else if ($pieces[1] == '04') {
                foreach ($mes as $key => $value) {
                    if ($value == '04') {
                    } else {
                        $mes[$j + 4] = 'Abr';
                    }
                }
            } else if ($pieces[1] == '05') {
                foreach ($mes as $key => $value) {
                    if ($value == '05') {
                    } else {
                        $mes[$j + 5] = 'May';
                    }
                }
            } else if ($pieces[1] == '06') {
                foreach ($mes as $key => $value) {
                    if ($value == '06') {
                    } else {
                        $mes[$j + 6] = 'Jun';
                    }
                }
            } else if ($pieces[1] == '07') {
                foreach ($mes as $key => $value) {
                    if ($value == '07') {
                    } else {
                        $mes[$j + 7] = 'Jul';
                    }
                }
            } else if ($pieces[1] == '08') {
                foreach ($mes as $key => $value) {
                    if ($value == '08') {
                    } else {
                        $mes[$j + 8] = 'Ago';
                    }
                }
            } else if ($pieces[1] == '09') {
                foreach ($mes as $key => $value) {
                    if ($value == '09') {
                    } else {
                        $mes[$j + 9] = 'Sep';
                    }
                }
            } else if ($pieces[1] == '10') {
                foreach ($mes as $key => $value) {
                    if ($value == '10') {
                    } else {
                        $mes[$j + 10] = 'Oct';
                    }
                }
            } else if ($pieces[1] == '11') {
                foreach ($mes as $key => $value) {
                    if ($value == '11') {
                    } else {
                        $mes[$j + 11] = 'Nov';
                    }
                }
            } else if ($pieces[1] == '12') {
                foreach ($mes as $key => $value) {
                    if ($value == '12') {
                    } else {
                        $mes[$j + 12] = 'Dic';
                    }
                }
            }
        }

        $data = [100, 100, 100, 100, 100, 100, 40];
        $consulta['datos_entrada'] = $data;
        $consulta['datos_ingresos'] = $arr_dat;
        $consulta['mes'] = $mes;
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
