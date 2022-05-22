<?php

namespace App\Controllers\Principal;

use App\Controllers\BaseController;
use App\Models\StudetsModel;
use App\Models\PaysModel;
use DateTime;
use DateTimeZone;

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

        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('America/Mexico_City'));
        $todays = $now->format('Y-m-d');
        $date_in = $now->format('Y-m-01');
        $date = strtotime($date_in);
        // Last date of current month.
        $lastdate = strtotime(date("Y-m-t", $date));
        // Day of the last date 
        $date_last = date("Y-m-t", $lastdate);
    
        $studetsModel = new StudetsModel();
        $paysModel = new PaysModel();
        $studetsModel->select();
        $studetsModel->where('status', 'true');
        $query = $studetsModel->get();
        $miembros_activos = $query->getResult('array');
        $miembros_activos = count($miembros_activos);
        $studetsModel->select();
        $studetsModel->where('status', 'false');
        $query = $studetsModel->get();
        $miembros_inactivos = $query->getResult('array');
        $miembros_inactivos = count($miembros_inactivos);
        $paysModel->select('cost,date_in');
        $paysModel->where('date_in >=', $date_in);
        $paysModel->where('date_in <=', $date_last);
        $query = $paysModel->get();
        $cost = $query->getResult('array');
        $ingresos_mensual=0;
        foreach ($cost as $key => $value) {
            $ingresos_mensual=$value['cost']+$ingresos_mensual;
        }
     
        $ingresos_diario=0;
        $paysModel->select('cost,date_in');
        $paysModel->where('date_in =', $todays);
        $query = $paysModel->get();
        $cost = $query->getResult('array');
        foreach ($cost as $key => $value) {
            $ingresos_diario=$value['cost']+$ingresos_diario;
        }
   
        $data = [
            'miembros_activos' => $miembros_activos,
            'miembros_inactivos' => $miembros_inactivos,
            'ingresos_diario' => $ingresos_diario,
            'ingresos_mensual' => $ingresos_mensual

        ];

        if ($session->get('usuario')) {
            return view('Principal/view_dash', $data);
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
