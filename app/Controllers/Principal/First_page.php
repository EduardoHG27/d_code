<?php

namespace App\Controllers\Principal;

use App\Controllers\BaseController;

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

        if ($session->get('usuario')) {
            return view('Principal/view_dash');
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
