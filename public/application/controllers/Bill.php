<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class BIll extends CI_Controller{

	function __construct(){
		parent::__construct();	
        $this->load->model('M_Bill');
        $this->load->model('M_Auth');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper('url');
        if($this->session->userdata('prab-status') == ""){
            redirect(base_url('auth'));
        }
    }
    

    function index(){
        $data['count_notification']   = $this->M_Bill->get_notification()->num_rows();
        $data['get_notification']     = $this->M_Bill->get_notification()->result();   
        $data['priciple_bill']        = $this->M_Bill->get_principle_bill()->result();
        $this->load->view('v_PrincipleBIll', $data);
    }

    function get_principle_bill(){
        $data['count_notification']   = $this->M_Bill->get_notification()->num_rows();
        $data['get_notification']     = $this->M_Bill->get_notification()->result();   
        $data['priciple_bill']        = $this->M_Bill->get_principle_bill()->result();
        $this->load->view('v_PrincipleBIll', $data);
    }

    function filter(){
        $status = $this->input->post('status');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        // echo $status;

        $data['count_notification']   = $this->M_Bill->get_notification()->num_rows();
        $data['get_notification']     = $this->M_Bill->get_notification()->result();   
        $data['priciple_bill']        = $this->M_Bill->filter_principle_bill($status, $start_date, $end_date)->result();
        $this->load->view('v_PrincipleBIll', $data);
    }

    function principle_paid_checked(){
        $this->M_Bill->principle_paid_checked($this->input->post('id'));
        redirect('Bill/get_principle_bill');
    }

}