<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_konsultasi()
    {
        $this->db->select('*');
        $this->db->where('status', NULL);
        $res = $this->db->get('konsultasi');
        return $res->result_array();
    }

    public function get_chat_name()
    {
        $sql = "SELECT DISTINCT c.id_user, u .name 
        FROM chat c
        JOIN user u
        ON c.id_user = u.id_user
        WHERE (c.id_user = 1 OR c.id_target = 1) AND u.name != 'admin' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_all_pengguna()
    {
        $sql = "SELECT l.*, p.nama_prodi as keterangan from tb_login l
               LEFT JOIN tb_prodi p
                ON l.keterangan = p.id_prodi";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_all_matakuliah($prodi, $smt)
    {
        $sql = "SELECT mk.*, p.nama_prodi from tb_matakuliah mk
                LEFT JOIN tb_prodi p
                ON mk.prodi_id=p.id_prodi
                WHERE mk.prodi_id=" . $prodi . " AND mk.semester =" . $smt;
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_all_jadwal($tahun, $prodi, $smt)
    {
        $sql = "SELECT j.*, p.nama_prodi, mk.nama_mk, d.name as nama_dosen, mk.sks 
                FROM tb_jadwal j
                LEFT JOIN tb_prodi p
                ON j.prodi_id=p.id_prodi
                LEFT JOIN tb_matakuliah mk
                ON j.id_mk = mk.id_mk
                LEFT JOIN tb_dosen d
                ON j.nip_dosen = d.username
                WHERE j.prodi_id=" . $prodi . " AND j.semester =" . $smt . " AND j.tahun= " . $tahun;
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_bulan_konsultasi($bln, $thn)
    {
        $sql = "SELECT * from konsultasi k 
                JOIN user u
                ON k.id_user = u.id_user
                where status != '' AND month(tanggal_permohonan) = " . $bln . " AND year(tanggal_permohonan) =" . $thn;
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function update_konfirmasi($data)
    {
        $this->db->set('status', $data['status']);
        $this->db->where('no_konsul', $data['no_konsul']);
        $this->db->update('konsultasi');
    }

    public function delete_user($data)
    {
        $this->db->where('username', $data);
        $this->db->delete('tb_login');
    }

    public function delete_mk($data)
    {
        $this->db->where('id_mk', $data);
        $this->db->delete('tb_matakuliah');
    }

    public function delete_jadwal($data)
    {
        $this->db->where('id_jadwal', $data);
        $this->db->delete('tb_jadwal');
    }

    public function get_all_khs($prodi, $smt)
    {
        $sql = "SELECT k.*,m.name as nama_mhs,j.hari,j.jam_mulai,jam_selesai, p.nama_prodi, mk.nama_mk, d.name as nama_dosen, mk.sks 
                FROM tb_kartustudi k
                LEFT JOIN tb_jadwal j
                ON k.id_jadwal = j.id_jadwal
                LEFT JOIN tb_matakuliah mk
                ON j.id_mk = mk.id_mk
                LEFT JOIN tb_dosen d
                ON j.nip_dosen = d.username
                LEFT JOIN tb_prodi p
                ON j.prodi_id = p.id_prodi
                LEFT JOIN tb_mahasiswa m
                ON k.nim = m.username
                WHERE j.prodi_id= '" . $prodi . "' AND k.semester = " . $smt;
        $res = $this->db->query($sql);
        return $res->result_array();
    }
}
