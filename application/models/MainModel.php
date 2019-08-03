<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function update_password($username, $data)
    {
        //id apa yang mau di update, lalu DATA apa yang mau dikirim ke tabel di database
        $this->db->set('password', $data);
        $this->db->where('username', $username);
        $this->db->update('tb_login');
    }
}
