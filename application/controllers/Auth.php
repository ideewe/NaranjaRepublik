<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
        $this->output->enable_profiler(TRUE);
    }

	public function index()
	{
		if ($this->session->userdata("login")) {
			redirect(base_url()."dashboard");
		}
		else{
			$this->load->view("admin/login");
		}
    }

    public function login()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $resultado = $this->User_model->login($username,sha1($password));
        if(!$resultado)
        {
            $this->session->set_flashdata("Error", "El Usuario  y/o contraseña son incorrectos");
            redirect(base_url());
        }
        else {
            $data  = array(
                'id' => $resultado->UserId,
                'FullName' => $resultado->FullName, 
                'CompanyName' => $resultado->CompanyName,
                'Username' => $resultado->Username, 
                'Email' => $resultado->Email,
                'Email' => $resultado->Email,                
                'rol' => $resultado->Role,
                'status' => $resultado->status,
                'login' => TRUE
                );
			$this->session->set_userdata($data);
            redirect(base_url()."dashboard");
                           
        } 
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }

}
