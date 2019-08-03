<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminControl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('sess_admin')) {
            //  redirect("login", 'refresh');
            redirect("AuthLogin");
        }

        $this->load->model('AdminModel');
        //  $this->load->library('form_validation', 'session');
    }

    public function index()
    {

        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $data['title'] = 'Welcome to Website Pelayanan Pengadilan Agama Kota Palembang';
        // $this->template->view('template/admin/main_content', 1, $datacontent);
        //$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('template/header', $datacontent, $data);
        $this->load->view('template/sidebar', $datacontent, $data);
        $this->load->view('template/topbar', $datacontent, $data);
        $this->load->view('template/admin/index', 1, $datacontent, $data);
        $this->load->view('template/footer');
    }

    public function dashboard()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;

        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/admin/index', 1, $datacontent);
        $this->load->view('template/footer');
    }

    public function jadwal_kuliah()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/admin/jadwal_kuliah', 1, $datacontent);
        $this->load->view('template/footer');
    }



    public function matakuliah()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/admin/matakuliah', 1, $datacontent);
        $this->load->view('template/footer', $datacontent);
    }

    public function setting_user()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/admin/user', 1, $datacontent);
        $this->load->view('template/footer', $datacontent);
    }

    public function input_khs()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $this->load->view('template/header', $datacontent);
        $this->load->view('template/sidebar', $datacontent);
        $this->load->view('template/topbar', $datacontent);
        $this->load->view('template/admin/input_khs', 1, $datacontent);
        $this->load->view('template/footer');
    }





    public function get_all_pengguna()
    {
        $result = $this->AdminModel->get_all_pengguna();
        echo json_encode($result);
    }

    public function get_all_jadwal()
    {
        $tahun = $this->input->GET('tahun_akademik');
        $prodi = $this->input->GET('program_studi');
        $smt = $this->input->GET('smt');
        $result = $this->AdminModel->get_all_jadwal($tahun, $prodi, $smt);
        echo json_encode($result);
    }

    public function get_all_matakuliah()
    {
        $prodi = $this->input->GET('prodi');
        $smt = $this->input->GET('smt');
        $result = $this->AdminModel->get_all_matakuliah($prodi, $smt);
        echo json_encode($result);
    }


    public function get_all_khs()
    {
        $session_data = $this->session->userdata('sess_member');
        $prodi = $this->input->GET('prodi_id');
        $smt = $this->input->GET('semester');
        $result = $this->AdminModel->get_all_khs($prodi, $smt);
        echo json_encode($result);
    }





    public function hapus_user()
    {
        $username = $this->input->post('username');
        $res = $this->AdminModel->delete_user($username);
        echo json_encode($res);
    }

    public function hapus_mk()
    {
        $id = $this->input->post('id_mk');
        $res = $this->AdminModel->delete_mk($id);
        echo json_encode($res);
    }

    public function hapus_jadwal()
    {
        $id = $this->input->post('id');
        $res = $this->AdminModel->delete_jadwal($id);
        echo json_encode($res);
    }

    public function input_matakuliah()
    {
        $data = [
            'kode_huruf' => htmlspecialchars($this->input->post('kode_huruf', true)),
            'kode_angka' => htmlspecialchars($this->input->post('kode_angka', true)),
            'nama_mk' => htmlspecialchars($this->input->post('nama_mk', true)),
            'sks' => htmlspecialchars($this->input->post('sks', true)),
            'prodi_id' => htmlspecialchars($this->input->post('prodi_id', true)),
            'semester' => htmlspecialchars($this->input->post('semester', true))

        ];

        $res = $this->db->insert('tb_matakuliah', $data);
        echo json_encode($res);
    }

    public function input_jadwal()
    {
        $data = [
            'tahun' => htmlspecialchars($this->input->post('tahun', true)),
            'prodi_id' => htmlspecialchars($this->input->post('prodi_id', true)),
            'id_mk' => htmlspecialchars($this->input->post('id_mk', true)),
            'nip_dosen' => htmlspecialchars($this->input->post('nip_dosen', true)),
            'hari' => htmlspecialchars($this->input->post('hari', true)),
            'semester' => htmlspecialchars($this->input->post('semester', true)),
            'jam_mulai' => htmlspecialchars($this->input->post('jam_mulai', true)),
            'jam_selesai' => htmlspecialchars($this->input->post('jam_selesai', true))
        ];

        $res = $this->db->insert('tb_jadwal', $data);
        echo json_encode($res);
    }

    public function update_nilai()
    {

        $id_ks = $this->input->POST('id_ks');
        echo "aku " . $id_ks;
        $data = [
            'grade' => htmlspecialchars($this->input->post('grade', true)),
        ];
        $this->db->where('id_ks', $id_ks);
        $this->db->update('tb_kartustudi', $data);
    }



    function add_ajax_prodi($id_prodi)
    {
        $query = $this->db->get_where('tb_matakuliah', array('prodi_id' => $id_prodi));
        $data = "<option value=''>- Select Mata Kuliah -</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='" . $value->id_mk . "'>" . $value->nama_mk . "</option>";
        }
        echo $data;
    }

    function add_ajax_dosen($id_prodi)
    {
        $query = $this->db->get_where('tb_dosen', array('prodi_id' => $id_prodi));
        $data = "<option value=''>- Select Dosen -</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='" . $value->username . "'>" . $value->name . "</option>";
        }
        echo $data;
    }
}
