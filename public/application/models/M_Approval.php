<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Approval extends CI_Model{
	
	function get_all_data_submitted_prab(){
        // $otoritas = ($this->session->userdata('prab-otoritas');
        $applicant_id = $this->session->userdata('prab-id');
		$otoritas = $this->session->userdata('prab-otoritas');
		if($otoritas == 'Administrator'){
			return $this->db->query("SELECT * FROM prab WHERE status_id = 1 OR status_id = 2");
		}elseif($otoritas == 'Direktur Keuangan'){
			return $this->db->get_where('prab', array('status_id' => 2));
		}elseif($otoritas == 'Manager' || $otoritas == 'Supervisor' || $otoritas='Direktur'){
			return $this->db->get_where('prab', array('status_id' => 1, 'PICid' => $this->session->userdata('prab-id')));
		}else{
			return $this->db->get_where('prab', array('status_id' => 1, 'applicant_id' => $applicant_id));
		}
	}

	function get_notification(){
		$user_id= $this->session->userdata('prab-id');
		return $this->db->get_where('notification', array( 'user_id' => $user_id));
	}

	function search_prab($query){
		$applicant_id = $this->session->userdata('prab-id');
		$otoritas = $this->session->userdata('prab-otoritas');
		if($otoritas == 'Administrator'){
			return $this->db->query("SELECT * FROM prab WHERE topic LIKE '%$query%' AND status_id = 1 OR status_id = 2");
		}elseif($otoritas == 'Direktur Keuangan'){
			return $this->db->query("SELECT * FROM prab WHERE topic LIKE '%$query%' AND status_id=2");
		}elseif($otoritas == 'Manager' || $otoritas == 'Supervisor' || $otoritas == 'Direktur' ){
			return $this->db->query("SELECT * FROM prab WHERE topic LIKE '%$query%' AND status_id=1");
		}else{
			return $this->db->query("SELECT * FROM prab WHERE applicant_id='$applicant_id' AND topic LIKE '%$query%' AND status_id=1 OR status_id=2 ");
		}
		
    }
    
    function reject($id, $modify, $note){
        $this->db->where('id', $id);
        $this->db->update('prab', array('status_id' => 3, 'status' => "Ditolak", 'isModify' => $modify, 'note' => $note));
    }

    function approve($id, $status_id, $status, $note){
        $this->db->where('id', $id);
        $this->db->update('prab', array('status_id' => $status_id, 'status' => $status, 'note' => $note));
    }

    function get_detail_prab($id){
        return $this->db->get_where('prab', array('id' => $id));
	}
	
	function get_groups_prab($id){
		return $this->db->get_where('group_of_items', array('prab_id' => $id));
	}

	function get_items_prab($id){
		return $this->db->get_where('items', array('prab_id' => $id));
	}

	function user_log($activity){
		$this->db->insert('user_log', array(
			'activity' 	=> $activity, 
			'time' 		=> date('H:i:s'),
			'date'		=> date('Y-m-d'),
			'user'		=> $this->session->userdata('prab-username')
		));
	}

	function get_DiFi(){
		return $this->db->get_where('auth', array('authority' => 'Direktur Keuangan'));
	}

	function get_principle(){
		return $this->db->get_where('principle', array('status' => 'Aktif'));
	}

	function get_financing_support($id){
		return $this->db->get_where('accounts_receivable', array('status_id' => 1, 'prab_id' => $id));
	}

	
}