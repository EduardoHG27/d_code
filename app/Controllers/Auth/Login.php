<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\PaysModel;
use App\Models\StudetsModel;
use DateTime;


class Login extends BaseController
{
    public function index()
    {
        return view('Auth/login');
    }

    public function signin()
    {
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required'
        ])) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $email = trim($this->request->getVar('username'));
        //$password = trim($this->request->getVar('password'));

        $password = md5($this->request->getVar('password'));
        //$model = model('UsersModel');

        $model = model('StaffModel');

        if (!$user = $model->getUserBy('name', $email)) {
            return redirect()->back()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'Este usuario no se encuentra registrado en el sistema'
                ]);
        } else {
            if ($password != $user['password']) {
                // if (!password_verify($password, $user->username)) {
                return redirect()->back()
                    ->with('msg', [
                        'type' => 'danger',
                        'body' => 'Credenciales invalidas'
                    ]);
            } else if ($user['status'] != 'true') {
                return redirect()->back()
                    ->with('msg', [
                        'type' => 'danger',
                        'body' => 'Usuario no permitido'
                    ]);
            } else {

                //use App\Models\StudetsModel;
                $paysModel = new PaysModel();
                $membersModel = new StudetsModel();
                $data = $paysModel->where('pay_status', 'true');
                $query   = $data->get();
                $data = $query->getResultArray();

                foreach ($data as $key => $value) {
                    date_default_timezone_set('America/Mexico_City');

                    $dStart = new DateTime($value['date_out']);
                    $dEnd  = new DateTime(date("Y-m-d"));

                    $dDiff = $dEnd->diff($dStart);
                    if($dDiff->format('%r%a')<0)
                    {
                       
                        $id = $value['id_pay'];
                        $data = [
                            'pay_status' => 'false'
                        ];
                        if ($paysModel->update($id, $data)) {
                
                            $data = [
                                'status' => 'false'
                            ];            
                            $membersModel->update($value['id_member'], $data);
                          //  var_dump('update_si');
                            
                        } else {
                
                          //  var_dump('update_no');
                        }

                    }
                    else
                    {
                     
                    }
                    
                }


                $data = [
                    "usuario" => $user['name'],
                    "email" => $user['email'],
                    "login" => TRUE
                ];

                   $session = \Config\Services::session();
                  $session->set($data);
                 return redirect()->route('principal/dashboard');
            }
        }
    }

    public function signin_in()
    {
        
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required'
        ])) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $email = trim($this->request->getVar('username'));
        //$password = trim($this->request->getVar('password'));

        $password = md5($this->request->getVar('password'));
        //$model = model('UsersModel');

        var_dump($email);
        $model = model('StudetsModel');

        if (!$user = $model->getUserBy('name', $email)) {
            return redirect()->back()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'Este usuario no se encuentra registrado en el sistema'
                ]);
        } else {
            if ($password != $user['password']) {
                // if (!password_verify($password, $user->username)) {
                return redirect()->back()
                    ->with('msg', [
                        'type' => 'danger',
                        'body' => 'Credenciales invalidas'
                    ]);
            } else if ($user['status'] != 'true') {
                return redirect()->back()
                    ->with('msg', [
                        'type' => 'danger',
                        'body' => 'Usuario no permitido'
                    ]);
            } else {

                var_dump($user);
                echo json_encode($user);
                return redirect()->route('principal/boot');
              //  return redirect()->back()
               // ->with('msg', [
                //    'type' => 'danger',
                 //   'body' => 'Usuario Permitido'
               // ]);
                /*
                $data = [
                    "usuario" => $user['name'],
                    "email" => $user['email'],
                    "login" => TRUE
                ];
                */
                //$session = \Config\Services::session();
               // $session->set($data);
                //return redirect()->route('principal/inicio');
            }
        }

        
    }


    
}
