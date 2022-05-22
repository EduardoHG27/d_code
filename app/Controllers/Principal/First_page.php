<?php

namespace App\Controllers\Principal;

use App\Controllers\BaseController;
use App\Models\StudetsModel;

class First_page extends BaseController
{
    public function index()
    {
        $session = session();

      
        if ($session->get('usuario')) {
            return view('Principal/view_first');
        } else {
            return view('Auth/Home');
        }
    }

    public function member()
    {
        $session = session();

        if ($session->get('usuario')) {
            return view('Principal/view_members');
        } else {
            return view('Auth/Home');
        }
    }

    public function dash()
    {
        $session = session();

        $studetsModel = new StudetsModel();
        $studetsModel->select();
        $studetsModel->where('status', 'true');
        $query = $studetsModel->get();
        $miembros_activos = $query->getResult('array');
        $miembros_activos=count($miembros_activos);
        $studetsModel->select();
        $studetsModel->where('status', 'false');
        $query = $studetsModel->get();
        $miembros_inactivos = $query->getResult('array');
        $miembros_inactivos=count($miembros_inactivos);
     
   
   
      



        $data = [
            'miembros_activos' => $miembros_activos,
            'miembros_inactivos' => $miembros_inactivos,
            'ingresos_diario' => '3,500',
            'ingresos_mensual' => '750'
            
        ];

        if ($session->get('usuario')) {
            return view('Principal/view_dash',$data);
        } else {
            return view('Auth/Home');
        }
    }


    public function student()
    {
        $session = session();

        if ($session->get('usuario')) {
            return view('Student/view_student');
        } else {
            return view('Auth/Home');
        }
    }

    public function plans()
    {
        $session = session();
        if ($session->get('usuario')) {
            return view('Plans/view_plans');
        } else {
            return view('Auth/Home');
        }
    }

    public function boot()
    {
        $session = session();
        if ($session->get('usuario')) {
            return view('Auth/Home_in');
        } else {
            return view('Auth/Home');
        }
    }


    public function data()
    {
        $session = session();
        if ($session->get('usuario')) {
            return view('Data/view_informative');
        } else {
            return view('Auth/Home');
        }
    }

    public function staff()
    {
        $session = session();
        if ($session->get('usuario')) {
            return view('Staff/view_staff');
        } else {
            return view('Auth/Home');
        }
    }

    public function get_out()
    {
        $session = session();
        $session->destroy();
        return view('Auth/Home');
    }
}
