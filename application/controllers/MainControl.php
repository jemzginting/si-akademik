<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainControl extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel');
    }
    public function index()
    {

        if ($this->session->userdata('sess_admin')) {
            redirect("AdminControl", 'refresh');
        } else if ($this->session->userdata('sess_member')) {
            redirect("MemberControl", 'refresh');
        } else if ($this->session->userdata('sess_dosen')) {
            redirect("DosenControl", 'refresh');
        } else {
            redirect("AuthLogin");
        }
    }

    public function logout()
    {
        // $id_user = "";
        if ($this->session->userdata('sess_member')) {
            //$session_data = $this->session->userdata('sess_member');
            //$id_user = $session_data['id_user'];
            $this->session->unset_userdata('sess_member');
        } else if ($this->session->userdata('sess_admin')) {
            //$session_data = $this->session->userdata('sess_admin');
            //$id_user = $session_data['id_user'];
            $this->session->unset_userdata('sess_admin');
        }

        redirect('AuthLogin', 'refresh');
    }
}
