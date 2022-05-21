<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudetsModel;

class Task extends BaseController
{
    public function index()
    {
        log_message('debug', 'Hostras'); 

        $msg="Hi! Thanks for watching this video. Comments if you want this code.";
        mail("eduardoenrique.hernandez@gmail.com", "Codeignator cron job by Shinexweb", $msg);
        
    }
}
