<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use stdClass;

class LoginCtrl extends BaseController
{
    public function index()
    {
        $data['msg'] = password_hash('123',PASSWORD_DEFAULT);
        return view('login/login', $data);
    }

    public function signIn(){
        $filtros = new stdClass();
        $filtros->email = $this->request->getPost('email');
        $filtros->password = $this->request->getPost('password');

        $userModel = model(User::class);
        $user = $userModel->getByEmail($filtros->email);
        if(count($user)>0) {
            $hashUser = $user['password'];
            if(password_verify($filtros->password,$hashUser)){
                session()->set('isLoggedIn',true);
                session()->set('cd_usuario', $user['users_id']);
                session()->set('nm_usuario', $user['nm_user']);
                session()->set('email', $user['email']);
                //session()->set('pphoto', $user['photo']);
                session()->set('ultimo_acesso', date('Y-m-d H:i:s'));
                return redirect()->to(route_to('home'));
            }else{
                session()->setFlashData('msg','Usuário ou senha inválidos!');
                return redirect()->to('loginctrl');
            }
        }else{
            session()->setFlashData('msg','Usuário ou senha inválidos!');
            return redirect()->to('loginctrl');
        }
    }

    public function signOut(){
        session()->destroy();
        return redirect()->to('loginctrl');
    }
}
