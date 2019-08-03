<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthLogin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation', 'session');
    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|callback_check_database');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('login', $data);
        } else {
            redirect('MainControl', 'refresh');
        }
    }

    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');
        $role_id = $this->input->post('role_id');

        //query the database
        $result = $this->AuthModel->login($username, md5($password), $role_id);
        $sess_name = array(1 => "sess_admin", 2 => "sess_member", 3 => "sess_dosen");
        if ($result) {

            $sess_array = array();
            foreach ($result as $row) {

                $sess_array = array(

                    'username' => $row->username,
                    'role_id' => $row->role_id,
                    'keterangan' => $row->keterangan,
                    'name' => $row->name,

                );

                $this->session->set_userdata($sess_name[$row->role_id], $sess_array);

                /*
                $data_log['id_user'] = $row->id_user;
                $data_log['id_staff'] = $row->id_staff;
                $data_log['aktivitas'] = "Login ke sistem";
                $res_log = $this->LogModel->insert($data_log); */
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }



    public function register()
    {

        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'password' => md5($this->input->post('password')),
            'role_id' => htmlspecialchars($this->input->post('level', true)),
            'keterangan' => htmlspecialchars($this->input->post('jurusan', true))

        ];

        $data2 = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'prodi_id' => htmlspecialchars($this->input->post('jurusan', true))

        ];

        $data3 = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'username' => htmlspecialchars($this->input->post('username', true))

        ];

        $this->db->insert('tb_login', $data);
        $role = $this->input->post('level');
        if ($role == 1) {
            $this->db->insert('tb_admin', $data3);
        } else if ($role == 2) {
            $this->db->insert('tb_mahasiswa', $data2);
        } else {
            $this->db->insert('tb_dosen', $data2);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You Have been Logout !</div>');
        redirect("AuthLogin");
    }
}
