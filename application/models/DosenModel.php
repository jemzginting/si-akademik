<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DosenModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_profil($username)
    {
        $this->db->select(array('d.*', 'p.nama_prodi'));
        $this->db->from('tb_dosen d');
        $this->db->join('tb_prodi p', 'd.prodi_id = p.id_prodi', 'Left');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_jadwal_pribadi($username)
    {
        $sql = "SELECT j.*,mk.kode_huruf,mk.kode_angka,mk.nama_mk,mk.sks
                FROM tb_jadwal j
                LEFT JOIN tb_matakuliah mk
                ON j.prodi_id = mk.prodi_id
                WHERE nip_dosen =  '" . $username . "'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
}
