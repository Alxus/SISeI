<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authentication{

    public $CI;

    public function __construct(){
        $this->CI=& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->model('Usuario_model');
    }

    public function check_user(){
        if(isset($_SESSION['SISeI_User'])){
          return true;
      }
      return false;
    }

    public function login($data){
        $usuario=$this->CI->Usuario_model->find_usuario($data);
        if($usuario!=null){
            unset($usuario['password']);
            $_SESSION['SISeI_User']=$usuario;
            return true;
        }
        return false;
    }

    public function logout(){
      unset($_SESSION['SISeI_User']);
    }
}
