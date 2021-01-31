<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Payment extends CI_Model{
	
	function get_approved_prab(){
        // $otoritas = ($this->session->userdata('prab-otoritas');
        $applicant_id = $this->session->userdata('prab-id');
		$otoritas = $this->session->userdata('prab-otoritas');
		if ($otoritas === 'Administrator' || $otoritas == 'Finance'){
			return $this->db->query("SELECT id, topic,date,applicant, departement, outlet,pic, prab.value AS value, payment_value FROM prab 
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS payment_value FROM payment GROUP BY prab_id) payment
            ON prab.id=payment.prab_id WHERE status_id=5");
		}else{
			return $this->db->get_where('prab', array('status_id' => 5, 'applicant_id' => $applicant_id));
		}
	}

	function search_prab($query){
		$otoritas = $this->session->userdata('prab-otoritas');
		$applicant_id = $this->session->userdata('prab-id');
		if ($otoritas === 'Administrator' || $otoritas == 'Finance' || $otoritas == 'Direktur'){
			return $this->db->query("SELECT id, topic,date,applicant, departement, outlet,pic, prab.value AS value, payment_value FROM prab 
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS payment_value FROM payment GROUP BY prab_id) payment
            ON prab.id=payment.prab_id WHERE topic LIKE '%$query%' AND status_id=5");
		}else{
			return $this->db->query("SELECT id, topic,date,applicant, departement, outlet,pic, prab.value AS value, payment_value FROM prab 
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS payment_value FROM payment GROUP BY prab_id) payment
            ON prab.id=payment.prab_id WHERE topic LIKE '%$query%' status_id=5");
		}
    }

	function get_groups_prab($id){
		return $this->db->get_where('group_of_items', array('prab_id' => $id));
	}

	function get_items_prab($id){
		return $this->db->get_where('items', array('prab_id' => $id));
	}

	function get_detail_prab($id){
        return $this->db->get_where('prab', array('id' => $id));
	}

	function get_payment_list($id){
		return $this->db->query("SELECT * FROM payment WHERE prab_id='$id'");
	}

	function get_total_value($id){
		return $this->db->query("SELECT sum(value) as total_value FROM payment WHERE prab_id='$id' GROUP BY prab_id");
	}

	function get_total_paid_value($id){
		return $this->db->query("SELECT sum(value) as total_value FROM payment WHERE prab_id='$id' AND is_paid=1 GROUP BY prab_id");
	}

	function get_total_unpaid_value($id){
		return $this->db->query("SELECT sum(value) as total_value FROM payment WHERE prab_id='$id' AND is_paid=0 GROUP BY prab_id");
	}

	
	function get_total_prab_value($id){
		return $this->db->get_where('prab', array('id' => $id, 'status_id' => 5));
	}

	function add_payment($data){
		$this->db->insert('payment', $data);
	}

	function user_log($activity){
		$this->db->insert('user_log', array(
			'activity' 	=> $activity, 
			'time' 		=> date('H:i:s'),
			'date'		=> date('Y-m-d'),
			'user'		=> $this->session->userdata('prab-username')
		));
	}

	function cancel_payment($id){
		$this->db->where('id', $id);
		$this->db->delete('payment');
	}

	function get_notification(){
		$user_id= $this->session->userdata('prab-id');
		return $this->db->get_where('notification', array( 'user_id' => $user_id));
	}

	function get_prab($prab_id){
		return $this->db->get_where('prab', array('id' => $prab_id));
	}

	function get_payment($payment_id){
		return $this->db->get_where('payment', array('id' => $payment_id));
	}

	
}