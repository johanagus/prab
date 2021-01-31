<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Auth extends CI_Model{
    function login_cek($where){		
		return $this->db->get_where('auth',$where);
	}

	function get_user_data($where){
		return $this->db->get_where('auth',$where);
	}

	function get_outlet(){
		return $this->db->get('outlet');
	}

	function get_departement(){
		return $this->db->get('departement');
	}

	function add_user($data){
		$this->db->insert('auth', $data);
	}

	function userId_check($username){
		return $this->db->get_where('auth', array('username' => $username));
	}
}