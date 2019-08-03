<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function login($username, $password, $role_id)
    {
        $this->db->select('*');
        $this->db->from('tb_login');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('role_id', $role_id);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}
