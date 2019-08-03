<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MemberControl extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('sess_member')) {
            redirect("AuthLogin");
        }
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation', 'session');
        $this->load->model('MemberModel');
        $this->load->model('MainModel');
        //  $this->load->library('form_validation', 'session');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->load->library('form_validation');
        $session_data = $this->session->userdata('sess_member');
        $datacontent['session'] = $session_data;
        $data['title'] = 'Welcome to Website Pelayanan Pengadilan Tinggi Agama Kota Palembang';
        $this->load->view('template/header', $datacontent, $data);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent, $data);
        $this->load->view('template/member/dashboard', 2, $datacontent, $data);
        $this->load->view('template/footer');
    }

    public function dashboard()
    {
        $session_data = $this->session->userdata('sess_member');
        $datacontent['session'] = $session_data;
        $data['title'] = 'Dashboard';
        $this->load->view('template/header', $datacontent, $data);
        $this->load->view('template/sidebar', 2, $datacontent);
        $this->load->view('template/topbar', $datacontent, $data);
        $this->load->view('template/member/dashboard', 2, $datacontent, $data);
        $this->load->view('template/footer');
    }

    public function myprofile()
    {
        $session_data = $this->session->userdata('sess_member');
        $datacontent['session'] = $session_data;
        $username = $session_data['username'];
        $all = $this->MemberModel->get_profil($username);
        $datacontent['getInfo'] = $all;
        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/member/myprofile', 2, $datacontent);
        $this->load->view('template/footer');
    }

    public function khs()
    {
        $session_data = $this->session->userdata('sess_member');
        $datacontent['session'] = $session_data;
        $username = $session_data['username'];
        $all = $this->MemberModel->get_ipk($username);
        $datacontent['getInfo'] = $all;
        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/member/khs', 2, $datacontent);
        $this->load->view('template/footer');
    }



    public function transkrip()
    {
        $session_data = $this->session->userdata('sess_member');
        $datacontent['session'] = $session_data;
        $username = $session_data['username'];
        $all = $this->MemberModel->get_ipk($username);
        $datacontent['getInfo'] = $all;
        $data['title'] = 'Tanggapan Permohonan Konsultasi';
        $this->load->view('template/header', $datacontent, $data);
        $this->load->view('template/sidebar', $datacontent, $data);
        $this->load->view('template/topbar', $datacontent, $data);
        $this->load->view('template/member/transkrip', 2, $datacontent, $data);
        $this->load->view('template/footer');
    }


    public function krs()
    {
        $session_data = $this->session->userdata('sess_member');
        $datacontent['session'] = $session_data;
        $data['title'] = 'Form Pelayanan Kepuasan Layanan';
        $this->load->view('template/header', $datacontent, $data);
        $this->load->view('template/sidebar', $datacontent, $data);
        $this->load->view('template/topbar', $datacontent, $data);
        $this->load->view('template/member/krs', 2, $datacontent, $data);
        $this->load->view('template/footer');
    }



    public function edit_profile()
    {
        $session_data = $this->session->userdata('sess_member');
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
        $this->db->update('tb_mahasiswa', $data);
    }



    public function get_all_jadwal()
    {
        $session_data = $this->session->userdata('sess_member');
        $prodi = $session_data['keterangan'];
        $username = $session_data['username'];
        $result = $this->MemberModel->get_all_jadwal($prodi, $username);
        echo json_encode($result);
    }

    public function get_jadwal_pribadi()
    {
        $session_data = $this->session->userdata('sess_member');
        $smt = $this->input->GET('semester');
        // $prodi = $session_data['keterangan'];
        $username = $session_data['username'];
        $result = $this->MemberModel->get_jadwal_pribadi($username, $smt);
        echo json_encode($result);
    }

    public function get_khs_pribadi()
    {
        $session_data = $this->session->userdata('sess_member');
        $smt = $this->input->GET('semester');
        // $prodi = $session_data['keterangan'];
        $username = $session_data['username'];
        $result = $this->MemberModel->get_khs_pribadi($username, $smt);
        echo json_encode($result);
    }

    public function get_transkrip_pribadi()
    {
        $session_data = $this->session->userdata('sess_member');
        $username = $session_data['username'];
        $result = $this->MemberModel->get_transkrip_pribadi($username);
        echo json_encode($result);
    }



    public function ambil_mk_pilih()
    {
        //Insert second stage details for employer into database.
        $session_data = $this->session->userdata('sess_member');
        $nim = $session_data['username'];
        //$smt = 2019;

        $jadwal = $this->input->post('checkbox[]');
        //  echo "aku =" . $jadwal;

        for ($i = 0; $i < count($jadwal); $i++) {

            $smt = $this->MemberModel->get_semester($jadwal[$i]);
            $data = array('nim' => $nim, 'id_jadwal' => $jadwal[$i], 'semester' => $smt[0]['semester'], 'sks' => $smt[0]['sks']);
            $this->db->insert('tb_kartustudi', $data);
        }
    }

    public function hapus_krs()
    {
        $id = $this->input->post('id');
        echo "lala" . $id;
        $res = $this->MemberModel->delete_krs($id);
        echo json_encode($res);
    }


    public function setting()
    {
        $session_data = $this->session->userdata('sess_member');
        $datacontent['session'] = $session_data;
        $username = $session_data['username'];
        $all = $this->MemberModel->get_profil($username);
        $datacontent['getInfo'] = $all;
        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/member/setting', 2, $datacontent);
        $this->load->view('template/footer');
    }

    public function ganti_password()
    {
        $session_data = $this->session->userdata('sess_member');
        $username = $session_data['username'];
        $pass = md5($this->input->post('password1'));
        $res = $this->MainModel->update_password($username, $pass);
        echo json_encode($res);
    }
}
