<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Dashboard extends CI_Model{
	
	function get_all_data_prab(){
		$otoritas = $this->session->userdata('prab-otoritas');
		$applicant_id = $this->session->userdata('prab-id');
		if ($otoritas == 'administrator' || $otoritas == 'finance' || $otoritas == 'approvetor'){
			return $this->db->get('prab');
		}else{
			$this->db->where('applicant_id', $applicant_id );
			return $this->db->get('prab');
		}
	}

	function search_prab($query){
		$otoritas = 'administrator';
		$applicant_id = $this->session->userdata('prab-id');
		if ($otoritas === 'administrator' || $otoritas = 'manager' || $otoritas == 'direksi'){
			return $this->db->query("SELECT * FROM prab WHERE topic LIKE '%$query%'");
		}else{
			return $this->db->query("SELECT * FROM prab WHERE applicant_id='$applicant_id' AND topic LIKE '%$query%'");
		}
		
	}

	function get_notification(){
		$user_id= $this->session->userdata('prab-id');
		return $this->db->get_where('notification', array( 'user_id' => $user_id));
	}

	function count_approved_prab(){
		return $this->db->get_where('prab', array( 'status' => 'Disetujui', 'applicant_id' => $this->session->userdata('prab-id')));
	}

	function get_pic_info($id){
		return $this->db->get_where('auth', array('id' => $id));
	}

	function count_rejected_prab(){
		return $this->db->get_where('prab', array( 'status' => 'Ditolak', 'applicant_id' => $this->session->userdata('prab-id')));
	}

	function count_finished_prab(){
		return $this->db->get_where('prab', array( 'status' => 'Selesai', 'applicant_id' => $this->session->userdata('prab-id')));
	}

	function count_all_prab(){
		return $this->db->get_where('prab', array('applicant_id' => $this->session->userdata('prab-id')));
	}

	function count_global_prab(){
		return $this->db->get('prab');
	}

	function get_data_prab($prab_id){
		return $this->db->get_where('prab', array( 'id' => $prab_id ));
	}
	
	function add_new_prab($data){
		$this->db->insert('prab', $data);
	}

	function submit_prab($id, $status_id, $status, $idPIC){
		$this->db->where('id', $id);
		$this->db->update('prab', array('status' => $status, 'status_id' => $status_id , 'isModify' => false, 'PICid' => $idPIC));
	}

	function change_prab($id, $data){
		$this->db->where('id', $id);
		$this->db->update('prab', $data);
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

	function get_value_item($id){
		return $this->db->query("SELECT sum(value_item) as value_total FROM items WHERE prab_id = '$id' GROUP BY prab_id");
	}

	function get_value_group_items($prab_id, $group_id){
		return $this->db->query("SELECT sum(value_item) as value_total FROM items WHERE prab_id = '$prab_id' AND group_id='$group_id' GROUP BY group_id");
	}

	function update_value_prab($id, $value_total){
		$this->db->where('id', $id);
		$this->db->update('prab', array('value' => $value_total));
	}

	function update_value_group_item($prab_id,$group_id, $value_total){
		$this->db->where('id', $group_id);
		$this->db->update('group_of_items', array('value' => $value_total));
	}

	function get_prab_data($id){
		return $this->db->get_where('prab', array('id' => $id));
	}

	function add_new_group_items($data){
		$this->db->insert('group_of_items', $data);
	}

	function get_groups_prab($id){
		return $this->db->get_where('group_of_items', array('prab_id' => $id));
	}

	function get_items_prab($id){
		return $this->db->get_where('items', array('prab_id' => $id));
	}

	function add_new_item($data){
		$this->db->insert('items', $data);
	}

	function delete_item($item_id){
		$this->db->where('id', $item_id);
		$this->db->delete('items');
	}

	function delete_group_items($id){
		$this->db->where('group_id', $id);
		$this->db->delete('items');
		$this->db->where('id', $id);
		$this->db->delete('group_of_items');
	}

	function get_detail_prab($id){
        return $this->db->get_where('prab', array('id' => $id));
	}

	function count_items($id){
		return $this->db->get_where('items', array('prab_id' => $id));
	}

	function get_principle(){
		return $this->db->get_where('principle', array('status' => 'Aktif'));
	}

	function get_financing_support($id){
		return $this->db->get_where('accounts_receivable', array('status_id' => 1, 'prab_id' => $id));
	}

	function delete_financing_support($id){
		$this->db->where('id', $id);
		$this->db->delete('accounts_receivable');
	}

	function add_financing_support($data){
		$this->db->insert('accounts_receivable', $data);
	}
}