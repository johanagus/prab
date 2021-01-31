<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Setting extends CI_Model{
	
	function get_users(){
        return $this->db->get('auth');
	}

	function get_notification(){
		$user_id= $this->session->userdata('prab-id');
		return $this->db->get_where('notification', array( 'user_id' => $user_id));
	}

	function change_isActive($id, $status){
		$this->db->where('id', $id);
		$this->db->update('auth', array('isActive' => $status ));
	}

	function search_user($query){
		return $this->db->query("SELECT * FROM auth WHERE username LIKE '%$query%'");
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

	function delete_user($id){
		$this->db->where('id', $id);
		$this->db->delete('auth');
	}

	function user_log($activity){
		$this->db->insert('user_log', array(
			'activity' 	=> $activity, 
			'time' 		=> date('H:i:s'),
			'date'		=> date('Y-m-d'),
			'user'		=> $this->session->userdata('prab-username')
		));
	}

	function get_list_group(){
		return $this->db->get('groupItems');
	}

	function get_PIC(){
		return $this->db->query("SELECT * FROM auth WHERE authority !='User'");
	}

	function add_outlet($data){
		$this->db->insert('outlet', $data);
	}

	function add_dept($name){
		$this->db->insert('departement', array('dept_name' => $name));
	}

	function add_group($name){
		$this->db->insert('groupitems', array('group_name' => $name));
	}

	function delete_outlet($id){
		$this->db->where('id', $id);
		$this->db->delete('outlet');
	}

	function delete_dept($id){
		$this->db->where('id', $id);
		$this->db->delete('departement');
	}

	function delete_group($id){
		$this->db->where('id', $id);
		$this->db->delete('groupitems');
	}

	function get_principle(){
		return $this->db->get('principle');
	}

	function add_principle($data){
		$this->db->insert('principle', $data);
	}

	function delete_principle($id){
		$this->db->where('id', $id);
		$this->db->delete('principle');
	}
}