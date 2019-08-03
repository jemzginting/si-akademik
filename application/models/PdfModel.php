    <?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class PdfModel extends CI_Model
    {


        public function getContent($data)
        {
            $this->db->select(array('*'));
            $this->db->join('user u', 'b.id_user = u.id_user');
            $this->db->from('konsultasi b');
            $this->db->where('no_konsul', $data);
            $query = $this->db->get();
            return $query->row_array();
        }

        public function get_jadwal_pribadi($username, $smt)
        {
            $sql = "SELECT mk.kode_huruf,mk.kode_angka, mk.nama_mk, mk.sks, k.grade 
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

        public function get_all_jadwal_pribadi($username)
        {
            $sql = "SELECT mk.kode_huruf,mk.kode_angka, mk.nama_mk, mk.sks, k.grade 
                FROM tb_kartustudi k
                LEFT JOIN tb_jadwal j
                    ON k.id_jadwal = j.id_jadwal
                LEFT JOIN tb_matakuliah mk
                    ON j.id_mk = mk.id_mk
                LEFT JOIN tb_dosen d
                    ON j.nip_dosen = d.username
                LEFT JOIN tb_prodi p
                    ON j.prodi_id = p.id_prodi
                WHERE k.nim= '" . $username . "'";
            $res = $this->db->query($sql);
            return $res->result_array();
        }

        public function get_jlh_sks2($username, $smt)
        {
            $sql = "SELECT count(sks) as jlh_sks
                    FROM tb_kartustudi
                    WHERE nim= '" . $username . "' AND semester = " . $smt;
            $res = $this->db->query($sql);
            return $res->result_array();
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

        public function get_jlh_all_sks($username)
        {
            $this->db->select(array('SUM(sks) as jlh_sks'));
            $this->db->from('tb_kartustudi');
            $this->db->where('nim', $username);
            $this->db->where('grade is NOT NULL');
            $query = $this->db->get();
            return $query->row_array();
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
    ?>