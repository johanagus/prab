<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Settlement extends CI_Model{
	
	function get_all_paid_prab(){
        $otoritas = $this->session->userdata('prab-otoritas');
        $applicant_id = $this->session->userdata('prab-id');
		$otoritas = $this->session->userdata('prab-otoritas');
		if ($otoritas == 'Finance' || $otoritas == 'Administrator' ){
			return $this->db->query("SELECT prab.id AS id, topic, date, prab.applicant, prab.departement, prab.outlet, prab.status, prab.value, payment_value, settlement_value FROM prab 
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS payment_value FROM payment GROUP BY prab_id) payment
			ON prab.id=payment.prab_id
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
			ON prab.id=settlement.prab_id
		 	WHERE status_id ='5' OR status_id ='4' ORDER BY date DESC LIMIT 50");
		}elseif($otoritas == 'Manager' || $otoritas == 'Supervisor' ){
			return $this->db->query("SELECT prab.id AS id, topic, date, prab.applicant, prab.departement, prab.outlet, prab.status, prab.value, payment_value, settlement_value FROM prab 
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS payment_value FROM payment GROUP BY prab_id) payment
			ON prab.id=payment.prab_id
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
			ON prab.id=settlement.prab_id
			WHERE PICid='$applicant_id' OR applicant_id='$applicant_id' AND status_id=5 ORDER BY date DESC LIMIT 50");
		}else{
			return $this->db->query("SELECT prab.id AS id, topic, date, prab.applicant, prab.departement, prab.outlet, prab.status, prab.value, payment_value, settlement_value FROM prab 
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS payment_value FROM payment GROUP BY prab_id) payment
			ON prab.id=payment.prab_id
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
			ON prab.id=settlement.prab_id
		 	WHERE status_id = 5 AND applicant_id= '$applicant_id' ORDER BY date DESC LIMIT 50");
		}
	}

 

	function get_groups_prab($id){
		return $this->db->get_where('group_of_items', array('prab_id' => $id));
	}

	function get_items_prab($id){
		return $this->db->get_where('items', array('prab_id' => $id));
	}

	

	function get_settlement_list($id){
		return $this->db->query("SELECT * FROM settlement WHERE prab_id='$id'");
	}


	function get_total_value($id){
		return $this->db->query("SELECT sum(value) as total_value FROM payment WHERE prab_id='$id' GROUP BY prab_id");
	}

	function get_total_settlement_value($id){
		 return $this->db->query("SELECT sum(value) as total_value FROM settlement WHERE prab_id='$id' GROUP BY prab_id");
		 
	}
	function get_total_overpayment_value($id){
		return $this->db->query("SELECT sum(value) as total_value FROM settlement WHERE prab_id='$id' AND isOverpayment=1");
	}

	function add_settlement($data){
		$this->db->insert('settlement', $data);
	}

	function search_prab($query){
		$otoritas = $this->session->userdata('prab-otoritas');
		$applicant_id = $this->session->userdata('prab-id');
		if ($otoritas == 'Administrator' || $otoritas == 'Finance' || $otoritas == 'Direktur Keuangan' || $otoritas == 'Direktur'){
			return $this->db->query("SELECT prab.id AS id, topic, date, prab.applicant, prab.departement, prab.outlet, prab.status, prab.value, payment_value, settlement_value FROM prab 
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS payment_value FROM payment GROUP BY prab_id) payment
			ON prab.id=payment.prab_id
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
			ON prab.id=settlement.prab_id
			WHERE topic LIKE '%$query%' AND status_id=5 OR status_id=4");
		}elseif($otoritas == 'Manager' || $otoritas == 'Supervisor' ){
			return $this->db->query("SELECT prab.id AS id, topic, date, prab.applicant, prab.departement, prab.outlet, prab.status, prab.value, payment_value, settlement_value FROM prab 
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS payment_value FROM payment GROUP BY prab_id) payment
			ON prab.id=payment.prab_id
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
			ON prab.id=settlement.prab_id
			WHERE (PICid='$applicant_id' OR applicant_id='$applicant_id') AND topic LIKE '%$query%' AND status_id=5");
		}else{
			return $this->db->query("SELECT prab.id AS id, topic, date, prab.applicant, prab.departement, prab.outlet, prab.status, prab.value, payment_value, settlement_value FROM prab 
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS payment_value FROM payment GROUP BY prab_id) payment
			ON prab.id=payment.prab_id
			LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
			ON prab.id=settlement.prab_id
			WHERE applicant_id='$applicant_id' AND topic LIKE '%$query%' AND status_id=5");
		}
    }

	function user_log($activity){
		$this->db->insert('user_log', array(
			'activity' 	=> $activity, 
			'time' 		=> date('H:i:s'),
			'date'		=> date('Y-m-d'),
			'user'		=> $this->session->userdata('prab-username')
		));
	}

	function cancel_settlement($id){
		$this->db->where('id', $id);
		$this->db->delete('settlement');
	}

	function get_notification(){
		$user_id= $this->session->userdata('prab-id');
		return $this->db->get_where('notification', array( 'user_id' => $user_id));
	}

	function validation($id){
		$this->db->where('id', $id);
        $this->db->update('settlement', array('isChecked' => 1));
	}

	function get_total_value_settlement($id){
		return $this->db->query("SELECT sum(value) as total_value FROM settlement WHERE prab_id='$id' GROUP BY prab_id");
	}

	function count_validate($id){
		return $this->db->get_where('settlement', array('prab_id' => $id, 'isChecked' => 0));
	}

	function finish_prab($id){
		$this->db->where('id', $id);
		$this->db->update('prab', array('status_id'=> 4, 'status' => 'Selesai'));
	}

}