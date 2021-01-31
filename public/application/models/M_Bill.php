<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Bill extends CI_Model{
	
	function get_principle_bill(){
        return $this->db->query("SELECT * FROM accounts_receivable LIMIT 50");
    }

    function get_notification(){
		$user_id= $this->session->userdata('prab-id');
		return $this->db->get_where('notification', array( 'user_id' => $user_id));
	}

	function filter_principle_bill($status, $start_date, $end_date){
		if($status == 2 ){
			return $this->db->query("SELECT * FROM accounts_receivable WHERE status_id=2 AND date_experied BETWEEN '$start_date' AND '$end_date' ORDER BY date_experied ASC");
		}elseif($status == 1 ){
			return $this->db->query("SELECT * FROM accounts_receivable WHERE status_id=1 AND date_experied BETWEEN '$start_date' AND '$end_date' ORDER BY date_experied ASC");
		}else{
			return $this->db->query("SELECT * FROM accounts_receivable WHERE date_experied BETWEEN '$start_date' AND '$end_date' ORDER BY date_experied ASC");
		}
	}

	function principle_paid_checked($id){
		$this->db->where('id', $id);
		$this->db->update('accounts_receivable', array('status_id' => 2, 'status' => 'Lunas' ));
	}

}