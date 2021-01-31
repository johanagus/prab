<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

class Payment extends CI_Controller{

	function __construct(){
		parent::__construct();	
        $this->load->model('M_Payment');
		$this->load->library('session');
        $this->load->helper('url');
        if($this->session->userdata('prab-status') == ""){
            redirect(base_url('auth'));
        }elseif($this->session->userdata('prab-otoritas') == "User" || $this->session->userdata('prab-otoritas') == "Direktur" || $this->session->userdata('prab-otoritas') == "Manager" || $this->session->userdata('prab-otoritas') == "Supervisor"){
            $this->session->set_flashdata('access_denied', 'Anda tidak diijinkan mengakses halaman pencairan');
            redirect(base_url('dashboard'));
        }
		
    }
    

	function index(){
        $data['count_notification']    = $this->M_Payment->get_notification()->num_rows();
        $data['get_notification']      = $this->M_Payment->get_notification()->result();
        $data['get_approved_prab']     = $this->M_Payment->get_approved_prab()->result();
		$this->load->view('v_payment', $data);
    }

    function search_prab(){
        $query = $this->input->post('search');
        if(isset($query)){
            $data['count_notification']    = $this->M_Payment->get_notification()->num_rows();
            $data['get_notification']      = $this->M_Payment->get_notification()->result();
            $data['get_approved_prab']     = $this->M_Payment->search_prab($query)->result();
            $this->load->view('v_payment', $data);
        }else{
            redirect(base_url('payment'));
        }
    }

    function detail($id){
        $data['count_notification']   = $this->M_Payment->get_notification()->num_rows();
        $data['get_notification']     = $this->M_Payment->get_notification()->result();
        $data['detail_prab']          = $this->M_Payment->get_detail_prab($id)->result();
        $data['groups_prab']          = $this->M_Payment->get_groups_prab($id)->result();
        $data['items_prab']           = $this->M_Payment->get_items_prab($id)->result();
        $data['payment_list']         = $this->M_Payment->get_payment_list($id)->result();
        $data['get_total_value']      = $this->M_Payment->get_total_value($id)->result();
		$this->load->view('v_detailPayment', $data);
    }

    function add_payment(){
        $id = $this->input->post('prab_id');
        $data = array(
            'prab_id'           => $id,
            'description'       => $this->input->post('description'),
            'date'              => date('Y-m-d'),
            'payment_methode'   => $this->input->post('payment_methode'),
            'account_number'    => $this->input->post('account_number'),
            'value'             => $this->input->post('value'),
            'is_paid'           => 1
            
        );

        $this->M_Payment->add_payment($data);
        $this->M_Payment->user_log('Melakukan pembayaran PRAB id : '.$id);
        $this->session->set_flashdata('msg', 'Penambahan data pencairan berhasil');
        redirect(base_url('payment/detail/'.$id));
    }

    function cancel_payment(){
        $id      = $this->uri->segment(3);
        $prab_id = $this->uri->segment(4);

        $this->M_Payment->cancel_payment($id);
        $this->M_Payment->user_log('Membatalkan 1 daftar pembayaran PRAB id : '.$prab_id);
        redirect(base_url('payment/detail/'.$prab_id));
    }

    function print($id){
        $prab_id = $this->uri->segment(3);
        $payment_id = $this->uri->segment(4);
        $data['get_prab'] = $this->M_Payment->get_prab($prab_id)->result();
        $data['get_payment']= $this->M_Payment->get_payment($payment_id)->result();
        $dompdf = new Dompdf();
        $html = $this->load->view('invoice',$data, true);
        
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A5', 'landscape');
        $dompdf->render();
        $dompdf->stream('Pencairan PRAB-'.$prab_id.'-'.$payment_id.'.pdf',array("Attachment"=>1), 1);
    }


    function add_not_paid(){
        $id = $this->input->post('prab_id');
        $data = array(
            'prab_id'           => $id,
            'description'       => 'Tidak dicairkan - '.$this->input->post('description'),
            'date'              => date('Y-m-d'),
            'payment_methode'   => '-',
            'account_number'    => '-',
            'value'             => $this->input->post('value'),
            'is_paid'           => 0
            
        );
        $this->M_Payment->add_payment($data);
        $this->M_Payment->user_log('Tidak mencairkan pembayaran : '.$id);
        $this->session->set_flashdata('msg', 'Penambahan data tidak cairkan berhasil');
        redirect(base_url('payment/detail/'.$id));
    }
}