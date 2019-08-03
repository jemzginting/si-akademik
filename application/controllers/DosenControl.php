<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DosenControl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('sess_dosen')) {
            //  redirect("login", 'refresh');
            redirect("AuthLogin");
        }
        $this->load->model('MainModel');
        $this->load->model('DosenModel');
        //  $this->load->library('form_validation', 'session');
    }

    public function index()
    {

        $session_data = $this->session->userdata('sess_dosen');
        $datacontent['session'] = $session_data;
        $data['title'] = 'Welcome to Website Pelayanan Pengadilan Agama Kota Palembang';
        // $this->template->view('template/dosen/main_content', 1, $datacontent);
        //$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('template/header', $datacontent, $data);
        $this->load->view('template/sidebar', $datacontent, $data);
        $this->load->view('template/topbar', $datacontent, $data);
        $this->load->view('template/dosen/index', 1, $datacontent, $data);
        $this->load->view('template/footer');
    }

    public function dashboard()
    {
        $session_data = $this->session->userdata('sess_dosen');
        $datacontent['session'] = $session_data;

        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/dosen/index', 1, $datacontent);
        $this->load->view('template/footer');
    }


    public function jadwal_mengajar()
    {
        $session_data = $this->session->userdata('sess_dosen');
        $datacontent['session'] = $session_data;
        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/dosen/jadwal_mengajar', 1, $datacontent);
        $this->load->view('template/footer', $datacontent);
    }

    public function profile()
    {
        $session_data = $this->session->userdata('sess_dosen');
        $datacontent['session'] = $session_data;
        $username = $session_data['username'];
        $all = $this->DosenModel->get_profil($username);
        $datacontent['getInfo'] = $all;
        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/dosen/myprofile', 1, $datacontent);
        $this->load->view('template/footer', $datacontent);
    }

    public function edit_profile()
    {
        $session_data = $this->session->userdata('sess_dosen');
        $username = $session_data['username'];
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
            'agama' => htmlspecialchars($this->input->post('agama', true)),
            'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
            'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),

        ];
        $this->db->where('username', $username);
        $this->db->update('tb_dosen', $data);
    }

    public function get_jadwal_pribadi()
    {
        $session_data = $this->session->userdata('sess_dosen');
        $username = $session_data['username'];
        $result = $this->DosenModel->get_jadwal_pribadi($username);
        echo json_encode($result);
    }

    public function setting()
    {
        $session_data = $this->session->userdata('sess_dosen');
        $datacontent['session'] = $session_data;
        $username = $session_data['username'];
        $all = $this->DosenModel->get_profil($username);
        $datacontent['getInfo'] = $all;
        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/dosen/setting', 2, $datacontent);
        $this->load->view('template/footer');
    }

    public function ganti_password()
    {
        $session_data = $this->session->userdata('sess_dosen');
        $username = $session_data['username'];
        $pass = md5($this->input->post('password1'));
        $res = $this->MainModel->update_password($username, $pass);
        echo json_encode($res);
    }
}
