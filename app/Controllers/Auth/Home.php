<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class Home extends BaseController
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

    public function hola()
    {
        $to = "email@prueba.com";
        $subject = "Prueba";
        $message = "Un cron para enviar un email cada 5 minutos";
         
        mail($to, $subject, $message);
        
    }



}
