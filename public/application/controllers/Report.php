<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Report extends CI_Controller{

	function __construct(){
		parent::__construct();	
        $this->load->model('M_Report');
        $this->load->model('M_Payment');
        $this->load->model('M_Settlement');
		$this->load->library('session');
        $this->load->helper('url');
        if($this->session->userdata('prab-status') == ""){
            redirect(base_url('auth'));
        }elseif($this->session->userdata('prab-otoritas') == "Approvetor"){
            $this->session->set_flashdata('access_denied', 'Anda tidak diijinkan mengakses halaman penyelesaian');
            redirect(base_url('dashboard'));
        }
		
	}

	function index(){
        $data['count_notification']  = $this->M_Report->get_notification()->num_rows();
        $data['get_notification']    = $this->M_Report->get_notification()->result();   
        $data['reports']             = $this->M_Report->get_all_prab()->result();
		$this->load->view('v_report', $data);
    }

    function detail($id){
        $data['count_notification']   = $this->M_Payment->get_notification()->num_rows();
        $data['get_notification']     = $this->M_Payment->get_notification()->result();
        $data['detail_prab']          = $this->M_Payment->get_detail_prab($id)->result();
        $data['groups_prab']          = $this->M_Payment->get_groups_prab($id)->result();
        $data['items_prab']           = $this->M_Payment->get_items_prab($id)->result();
        $data['payment_list']         = $this->M_Payment->get_payment_list($id)->result();
        $data['get_total_value']      = $this->M_Payment->get_total_value($id)->result();
        $data['get_total_settlement_value']     = $this->M_Settlement->get_total_settlement_value($id)->result();
        $data['settlement_list']      = $this->M_Settlement->get_settlement_list($id)->result();
		$this->load->view('v_detailReport', $data);
    }

    function filter(){
        $start_date = $this->input->post('start_date');
        $end_date   = $this->input->post('end_date');
        $status     = $this->input->post('status');
        $data['count_notification']  = $this->M_Report->get_notification()->num_rows();
        $data['get_notification']    = $this->M_Report->get_notification()->result();   
        $data['reports']        = $this->M_Report->get_filter_prab($start_date, $end_date, $status)->result();
		$this->load->view('v_report', $data);
    }
   
    
}