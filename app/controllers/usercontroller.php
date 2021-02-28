<?php 

namespace MVC\controllers;

use MVC\core\controller; 
use MVC\models\user;
use GUMP;
use MVC\core\helpers;
use MVC\core\Session;

class usercontroller extends controller{

    public function __construct()
    {
        Session::start();
    }

    public function index(){
        echo 'user';
    }

    public function login(){
        $this->view('home/login',['title'=>'login']);
    } 

    public function postlogin(){
        $is_valid = GUMP::is_valid($_POST,[
            'email'=>'required'
        ]);

            if($is_valid == 1){
                $user = new user(); 
                $data = $user->GetUser($_POST['email'],$_POST['password']);

                Session::Set('user',$data); 
                helpers::redirect('adminpost/index');
        }
    }

    public function logout(){
        Session::Stop();
    }
}