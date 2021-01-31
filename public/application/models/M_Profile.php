<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Profile extends CI_Model{
	
	function get_user_profile(){
        $user_id= $this->session->userdata('prab-id');
        return $this->db->get_where('auth', array('id' => $user_id ));
    }

    function change_profile($id, $data){
        $this->db->where('id', $id);
        $this->db->update('auth', $data);
    }
    
    function get_notification(){
		$user_id= $this->session->userdata('prab-id');
		return $this->db->get_where('notification', array( 'user_id' => $user_id));
    }
    
    function get_outlet(){
        return $this->db->get('outlet');
    }

    function get_departement(){
        return $this->db->get('departement');
    }

    function password_cek($id){
        return $this->db->get_where('auth', array('id' => $id));
    }

    function change_password($id, $pass){
        $this->db->where('id', $id);
        $this->db->update('auth', array('password' => $pass));
    }
	
}