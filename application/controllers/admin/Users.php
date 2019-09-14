<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
    }

    public function index()
    {
        $data = array(
            'users' => $this->User_model->getAllUsers(),
            'renters'  => $this->User_model->getAllRenters(),
            'Flexs'  => $this->User_model->getAllFlexs(),
            'Virtuals'  => $this->User_model->getAllVirtuals(),            
        );
        $this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/users/list',$data);
		$this->load->view('layouts/rightsidebar');
		$this->load->view('layouts/footer');
        
    }

    public function add()
    {
        $data = array(
            'roles' => $this->User_model->getAllRoles(),   
            'genders' => $this->User_model->getAllGenders(),                 
        );
        $this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/users/add', $data );
		$this->load->view('layouts/rightsidebar');
		$this->load->view('layouts/footer');   
    }

    public function store()
    {
        $FullName = $this->input->post("FullName");
        $CompanyName = $this->input->post("CompanyName");
        $UserTypeId= $this->input->post("UserTypeId");
        $IsAdmin = $this->input->post("IsAdmin");
        $RoleId = $this->input->post("RoleId");
        $Username = $this->input->post("username");
        $Email = $this->input->post("Email");
        $Password = $this->input->post("Password");
        $Image = $this->input->post("Image");
        $Status = $this->input->post("Status");
        $MessageCheckedAt = $this->input->post("MessageCheckedAt");
        $ClientId = $this->input->post("ClientId");
        $NotificationCheckedAt = $this->input->post("NotificationCheckedAt");
        $isPrimaryContact = $this->input->post("isPrimaryContact");
        $JobTitle = $this->input->post("JobTitle");
        $DisableLogin = $this->input->post("DisableLogin");
        $Note = $this->input->post("Note");
        $Address = $this->input->post("Address");
        $AlternativeAddress = $this->input->post("AlternativeAddress");
        $Phone = $this->input->post("Phone");
        $AlternativePhone = $this->input->post("AlternativePhone");
        $RTN = $this->input->post("RTN");
        $GenderId = $this->input->post("GenderId");
        $StickyNote = $this->input->post("StickyNote");
        $skype = $this->input->post("skype");
        $EnableWebNotification = $this->input->post("EnableWebNotification");
        $EnableEmailNotification = $this->input->post("EnableEmailNotification");
        $AccountId = $this->input->post("AccountId");
        $City = $this->input->post("City");
        $WifiCode = $this->input->post("WifiCode");
        $PrinterCode = $this->input->post("PrinterCode");

        
        $this->form_validation->set_rules("Username", "Username","required|min_length[5]|max_length[24]|is_unique[users.Username]");
        $this->form_validation->set_rules("FullName", "Nombre de Usuario", "required");        
        $this->form_validation->set_rules("Email", "Email", "required|is_unique[users.Email]");
        $this->form_validation->set_rules("RoleId", "RoleId", "required|integer");
        

        if ($this->form_validation->run()) 
        {
            $data = array(                       
                'FullName' => $FullName,
                'CompanyName' => $CompanyName,
                'UserTypeId' => $UserTypeId,
                'IsAdmin'=> $IsAdmin,
                'RoleId'=> $RoleId,
                'Username'=> $Username,
                'Email'=> $Email,
                'Password'=> $Password,
                'Image'=> $Image,
                'Status'=> $Status,
                'MessageCheckedAt'=> $MessageCheckedAt,
                'ClientId'=> $ClientId,
                'NotificationCheckedAt'=> $NotificationCheckedAt,
                'isPrimaryContact'=> $isPrimaryContact,
                'JobTitle'=> $JobTitle,
                'DisableLogin'=> $DisableLogin,
                'Note'=> $Note,
                'Address'=> $Address,
                'AlternativeAddress'=> $AlternativeAddress,
                'Phone'=> $Phone,
                'AlternativePhone'=> $AlternativePhone,
                'RTN'=> $RTN,
                'GenderId'=> $GenderId,
                'StickyNote'=> $StickyNote,
                'skype'=> $skype,
                'EnableWebNotification'=> $EnableWebNotification,
                'EnableEmailNotification'=> $EnableEmailNotification,
                'AccountId'=> $AccountId, 
                'City'=> $City,
                'WifiCode'=> $WifiCode,
                'PrinterCode'=> $PrinterCode
            ); 
            
            if ($this->User_model->save($data))
            {
                redirect(base_url().'admin/users');
            }
            else
            {            
                $this->session->set_flashdata("error", "No se pudo guardar la información");            
                redirect(base_url().'admin/users/add');
            }
        
        }
        else
        {
            $this->add();
        }
    }
}