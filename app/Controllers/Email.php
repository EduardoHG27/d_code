<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Libraries\PHPMailer_lib;
use App\Models\StudetsModel;

class Email extends BaseController
{
    protected $lib;

    public function __construct()
    {

        $this->db = \Config\Database::connect();
    }

    public function send()
    {
        $this->lib = new PHPMailer_lib();

       
    }
}
