<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Report extends CI_Model{
	
	function get_all_prab(){
        $otoritas       = $this->session->userdata('prab-otoritas');
        $applicant_id   = $this->session->userdata('prab-id');
        $outlet         = $this->session->userdata('prab-outlet');
        if( $otoritas == "User"){
            return $this->db->query("SELECT *  FROM prab 
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS paid_value FROM payment WHERE is_paid=1 GROUP BY prab_id) payment
            ON prab.id=payment.prab_id
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
            ON prab.id=settlement.prab_id 
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS unpaid_value FROM payment WHERE is_paid=0 GROUP BY prab_id) unpaid
            ON prab.id=unpaid.prab_id
            WHERE status_id !=0 AND applicant_id=$applicant_id LIMIT 100");
        }elseif($otoritas == "Supervisor" || $otoritas == "Manager"){
            return $this->db->query("SELECT *  FROM prab 
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS paid_value FROM payment WHERE is_paid=1 GROUP BY prab_id) payment
            ON prab.id=payment.prab_id
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
            ON prab.id=settlement.prab_id 
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS unpaid_value FROM payment WHERE is_paid=0 GROUP BY prab_id) unpaid
            ON prab.id=unpaid.prab_id
            WHERE status_id !=0 AND PICid='$applicant_id' OR applicant_id=$applicant_id  LIMIT 100");
        }else{
            return $this->db->query("SELECT *  FROM prab 
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS paid_value FROM payment WHERE is_paid=1 GROUP BY prab_id) payment
            ON prab.id=payment.prab_id
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
            ON prab.id=settlement.prab_id 
            LEFT JOIN (SELECT prab_id, SUM(VALUE) AS unpaid_value FROM payment WHERE is_paid=0 GROUP BY prab_id) unpaid
            ON prab.id=unpaid.prab_id
            WHERE status_id !=0 LIMIT 100");
        }
	}

	function get_notification(){
		$user_id= $this->session->userdata('prab-id');
		return $this->db->get_where('notification', array( 'user_id' => $user_id));
    }
    
    function get_filter_prab($start_date, $end_date, $status){
        $otoritas       = $this->session->userdata('prab-otoritas');
        $applicant_id   = $this->session->userdata('prab-id');

        if( $otoritas == "User"){
            if($status != "All"){
                return $this->db->query("SELECT *  FROM prab 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS paid_value FROM payment WHERE is_paid=1 GROUP BY prab_id) payment
                ON prab.id=payment.prab_id
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
                ON prab.id=settlement.prab_id 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS unpaid_value FROM payment WHERE is_paid=0 GROUP BY prab_id) unpaid
                ON prab.id=unpaid.prab_id
                WHERE applicant_id=$applicant_id AND date BETWEEN '$start_date' AND '$end_date' AND status_id ='$status'");
            }else{
                return $this->db->query("SELECT *  FROM prab 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS paid_value FROM payment WHERE is_paid=1 GROUP BY prab_id) payment
                ON prab.id=payment.prab_id
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
                ON prab.id=settlement.prab_id 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS unpaid_value FROM payment WHERE is_paid=0 GROUP BY prab_id) unpaid
                ON prab.id=unpaid.prab_id
                WHERE applicant_id='$applicant_id' AND date BETWEEN '$start_date' AND '$end_date'");
            }
        }elseif($otoritas == "Supervisor" || $otoritas == "Manager"){
            if($status != "All"){
                return $this->db->query("SELECT *  FROM prab 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS paid_value FROM payment WHERE is_paid=1 GROUP BY prab_id) payment
                ON prab.id=payment.prab_id
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
                ON prab.id=settlement.prab_id 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS unpaid_value FROM payment WHERE is_paid=0 GROUP BY prab_id) unpaid
                ON prab.id=unpaid.prab_id
                WHERE date BETWEEN '$start_date' AND '$end_date' AND status_id='$status' AND ( PICid='$applicant_id' OR applicant_id=$applicant_id )");
            }else{
                return $this->db->query("SELECT *  FROM prab 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS paid_value FROM payment WHERE is_paid=1 GROUP BY prab_id) payment
                ON prab.id=payment.prab_id
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
                ON prab.id=settlement.prab_id 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS unpaid_value FROM payment WHERE is_paid=0 GROUP BY prab_id) unpaid
                ON prab.id=unpaid.prab_id
                WHERE date BETWEEN '$start_date' AND '$end_date' AND (PICid='$applicant_id' OR applicant_id=$applicant_id) ");
            }
        }else{
            if($status != "All"){
                return $this->db->query("SELECT *  FROM prab 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS paid_value FROM payment WHERE is_paid=1 GROUP BY prab_id) payment
                ON prab.id=payment.prab_id
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
                ON prab.id=settlement.prab_id 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS unpaid_value FROM payment WHERE is_paid=0 GROUP BY prab_id) unpaid
                ON prab.id=unpaid.prab_id 
                WHERE status_id !=0 AND date BETWEEN '$start_date' AND '$end_date' AND status_id='$status'");
            }else{
                return $this->db->query("SELECT *  FROM prab 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS paid_value FROM payment WHERE is_paid=1 GROUP BY prab_id) payment
                ON prab.id=payment.prab_id
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS settlement_value FROM settlement GROUP BY prab_id) settlement
                ON prab.id=settlement.prab_id 
                LEFT JOIN (SELECT prab_id, SUM(VALUE) AS unpaid_value FROM payment WHERE is_paid=0 GROUP BY prab_id) unpaid
                ON prab.id=unpaid.prab_id
                WHERE date BETWEEN '$start_date' AND '$end_date'");
            }
        }
    }
}