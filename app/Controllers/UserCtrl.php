<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserCtrl extends BaseController
{
    public function index()
    {
        return view('user/user');
    }

    public function create(){
        $permission = true;
        if($permission){
            
        }else{
            return view('acessonegado');
        }
    }
}
