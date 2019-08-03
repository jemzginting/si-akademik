<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MemberModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    public function get_nomor_urut()
    {
        $sql = "SELECT max(no_konsul) as no_konsul FROM konsultasi";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_semester($data)
    {
        $sql = "SELECT j.semester, mk.sks
        FROM tb_jadwal j
        LEFT JOIN tb_matakuliah mk
        ON j.id_mk = mk.id_mk
        WHERE id_jadwal = " . $data;
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function tambah_konsul($data)
    {
        $this->db->set('no_konsul', $data['no_konsul']);
        $this->db->set('nama_permohon', $data['nama_permohon']);
        $this->db->set('tanggal_permohonan', $data['tanggal_permohonan']);
        $this->db->set('waktu_permohonan', $data['waktu_permohonan']);
        $this->db->set('no_telepon', $data['no_telepon']);
        $this->db->set('jenis_informasi', $data['jenis_informasi']);
        $this->db->set('tujuan_informasi', $data['tujuan_informasi']);
        $this->db->set('ktp', $data['ktp']);
        $this->db->set('id_user', $data['id_user']);
        $this->db->insert('konsultasi');
        $this->db->insert_id();
    }


    public function input_nilai($data, $id_user, $date)
    {
        $this->db->set('nilai', $data);
        $this->db->set('id_user', $id_user);
        $this->db->set('tanggal', $date);
        $this->db->insert('penilaian');
        $this->db->insert_id();
    }

    public function get_konsultasi_userid($userid)
    {
        $sql = 'SELECT * from konsultasi where status != ""  AND id_user=' . $userid;
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_profil($username)
    {
        $this->db->select(array('m.*', 'p.nama_prodi'));
        $this->db->from('tb_mahasiswa m');
        $this->db->join('tb_prodi p', 'm.prodi_id = p.id_prodi', 'Left');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_all_jadwal($prodi, $username)
    {
        $sql = "SELECT j.*, p.nama_prodi, mk.nama_mk, d.name as nama_dosen, mk.sks 
                FROM tb_jadwal j
                LEFT JOIN tb_prodi p
                ON j.prodi_id=p.id_prodi
                LEFT JOIN tb_matakuliah mk
                ON j.id_mk = mk.id_mk
                LEFT JOIN tb_dosen d
                ON j.nip_dosen = d.username
                WHERE j.prodi_id=" . $prodi . " AND j.id_jadwal NOT IN (SELECT id_jadwal FROM tb_kartustudi WHERE nim='" . $username . "' )";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_jadwal_pribadi($username, $smt)
    {
        $sql = "SELECT k.id_ks,k.grade,j.*, p.nama_prodi, mk.nama_mk, d.name as nama_dosen, mk.sks 
                FROM tb_kartustudi k
                LEFT JOIN tb_jadwal j
                ON k.id_jadwal = j.id_jadwal
                LEFT JOIN tb_matakuliah mk
                ON j.id_mk = mk.id_mk
                LEFT JOIN tb_dosen d
                ON j.nip_dosen = d.username
                LEFT JOIN tb_prodi p
                ON j.prodi_id = p.id_prodi
                WHERE k.nim= '" . $username . "' AND k.semester = " . $smt;
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_khs_pribadi($username, $smt)
    {
        $sql = "SELECT k.grade,k.semester,mk.kode_huruf,mk.kode_angka, mk.nama_mk, mk.sks 
                FROM tb_kartustudi k
                LEFT JOIN tb_jadwal j
                    ON k.id_jadwal = j.id_jadwal
                LEFT JOIN tb_matakuliah mk
                    ON j.id_mk = mk.id_mk
                WHERE k.nim= '" . $username . "' AND k.semester = " . $smt;
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_transkrip_pribadi($username)
    {
        $sql = "SELECT k.grade,k.semester,mk.kode_huruf,mk.kode_angka, mk.nama_mk, mk.sks 
                FROM tb_kartustudi k
                LEFT JOIN tb_jadwal j
                    ON k.id_jadwal = j.id_jadwal
                LEFT JOIN tb_matakuliah mk
                    ON j.id_mk = mk.id_mk
                WHERE k.nim= '" . $username . "'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }


    public function inputAll($ids)
    {
        $this->db->where_in('badgenumber', explode(",", $ids));
        $this->db->insert('jam_shift');
    }

    public function delete_krs($data)
    {
        $this->db->where('id_ks', $data);
        $this->db->delete('tb_kartustudi');
    }

    public function get_jlh_sks($username, $smt)
    {
        $this->db->select(array('SUM(sks) as jlh_sks'));
        $this->db->from('tb_kartustudi');
        $this->db->where('nim', $username);
        $this->db->where('semester', $smt);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_ipk($username)
    {
        $this->db->select(array('(SUM(sks*grade))/SUM(sks) as ipk', 'SUM(sks) as sks'));
        $this->db->from('tb_kartustudi');
        $this->db->where('nim', $username);
        $this->db->where('grade is NOT NULL');
        $query = $this->db->get();
        return $query->row_array();
    }
}
