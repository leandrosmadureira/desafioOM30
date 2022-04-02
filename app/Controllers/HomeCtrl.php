<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeCtrl extends BaseController
{
    public function index()
    {
        return $this->setPage('default/home');
    }
}
