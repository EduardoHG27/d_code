<?php

namespace App\Libraries;

include RUTA_APP. '/ThirdParty/phpqrcode/qrlib.php';
use QRcode;

class qr
{
    public function construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function create_qr($pass,$location)
    {
       
       
        if(QRcode::png($pass, $location))
        {
            return true;
        }
        else
        {
            return false;
        }

       
    }

}
