<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Settlement extends CI_Controller{

	function __construct(){
		parent::__construct();	
        $this->load->model('M_Settlement');
        $this->load->model('M_Payment');
        $this->load->model('M_Auth');
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
        $data['count_notification']   = $this->M_Settlement->get_notification()->num_rows();
        $data['get_notification']     = $this->M_Settlement->get_notification()->result();   
        $data['get_all_paid_prab']    = $this->M_Settlement->get_all_paid_prab()->result();
		$this->load->view('v_settlement', $data);
    }

    function search_prab(){
        $query = $this->input->post('search');
        if(isset($query)){
            $data['count_notification']    = $this->M_Settlement->get_notification()->num_rows();
            $data['get_notification']      = $this->M_Settlement->get_notification()->result();   
            $data['get_all_paid_prab']     = $this->M_Settlement->search_prab($query)->result();
            $this->load->view('v_settlement', $data);
        }else{
            redirect(base_url('dashboard'));
        }
    }

    function detail($id){
        $data['count_notification']             = $this->M_Settlement->get_notification()->num_rows();
        $data['get_notification']               = $this->M_Settlement->get_notification()->result();   
        $data['detail_prab']                    = $this->M_Payment->get_detail_prab($id)->result();
        $data['groups_prab']                    = $this->M_Payment->get_groups_prab($id)->result();
        $data['items_prab']                     = $this->M_Payment->get_items_prab($id)->result();
        $data['payment_list']                   = $this->M_Payment->get_payment_list($id)->result();
        $data['get_total_value']                = $this->M_Payment->get_total_value($id)->result();
        $data['get_total_settlement_value']     = $this->M_Settlement->get_total_settlement_value($id)->result();
        $data['settlement_list']                = $this->M_Settlement->get_settlement_list($id)->result();
        $data['total_paid_payment']             = $this->M_Payment->get_total_paid_value($id)->result_array();
        $data['total_unpaid_payment']           = $this->M_Payment->get_total_unpaid_value($id)->result_array();
        $data['get_total_overpayment_value']    = $this->M_Settlement->get_total_overpayment_value($id)->result_array();
		$this->load->view('v_settlementDetail', $data);
    }

    function add_settlement(){
        $id         = $this->input->post('prab_id');
        $data['total_paid_payment']             = $this->M_Payment->get_total_paid_value($id)->result_array();
        $data['get_total_settlement_value']     = $this->M_Settlement->get_total_settlement_value($id)->result_array();
        if(($data['total_paid_payment'][0]['total_value']-$data['get_total_settlement_value'][0]['total_value'])  >= $this->input->post('value')){
            $file_ext   = pathinfo($_FILES["attachment"]['name'],PATHINFO_EXTENSION);
            $attachment = $id.'-NT'.date('His').'.'.$file_ext;
    
            $config['upload_path']          = './uploads';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $config['file_name']            = $attachment;
            $config['overwrite']            = true;
    
            $this->load->library('upload', $config);
            if($this->upload->do_upload('attachment')){
                    $data = array(
                    'date'          => date('Y-m-d'),
                    'prab_id'       => $id,
                    'value'         => $this->input->post('value'),
                    'description'   => $this->input->post('description'),
                    'attachment'    => $attachment,
                    'isOverpayment' => 0
                    );
        
                    $this->M_Settlement->add_settlement($data);
                    $this->M_Settlement->user_log('Melakukan penyelesain PRAB no : '.$id);
                    $this->session->set_flashdata('msg', 'Penyelesain berhasil ditambahkan');
                    redirect(base_url('settlement/detail/'.$id));
            
            }else{
                if($_FILES['attachment']['size'] > 2000){
                    $this->session->set_flashdata('error_msg', 'Ukuran foto nota lebih dari 2 MB');
                    redirect(base_url('settlement/detail/'.$id));
                }else{
                    $this->session->set_flashdata('error_msg', 'Penyelesain gagal ditambahkan');
                    redirect(base_url('settlement/detail/'.$id));
                }
            }

        }else{
            $this->session->set_flashdata('error_msg', 'Penyelesain gagal ditambahkan, pastikan jumlah penyelesaian tidak lebih dari pencairan!');
            redirect(base_url('settlement/detail/'.$id));
        }
        

        
    }

    function cancel_settlement(){
        $id      = $this->uri->segment(3);
        $prab_id = $this->uri->segment(4);

        $this->M_Settlement->cancel_settlement($id);
        $this->M_Settlement->user_log('Membatalkan 1 daftar penyelesaian PRAB id : '.$prab_id);
        redirect(base_url('settlement/detail/'.$prab_id));
    }

    function validation(){
        $id      = $this->input->post('id');
        $prab_id = $this->input->post('prab_id');

        if($this->session->userdata('prab-otoritas') == "Finance"){
            $this->M_Settlement->validation($id);
            redirect(base_url('settlement/detail/'.$prab_id));
        }else{
            $this->session->set_flashdata('access_denied', 'Anda tidak diijinkan untuk memvalidasi nota');
            redirect(base_url('settlement/detail/'.$prab_id));
        }
    }

    function finish_prab($id){
        $data['total_prab_value']   = $this->M_Payment->get_total_prab_value($id)->result_array();
        $data['total_paid_payment'] = $this->M_Payment->get_total_paid_value($id)->result_array();
        $data['total_payment']      = $this->M_Payment->get_total_value($id)->result_array();
        $data['total_settlement']   = $this->M_Settlement->get_total_value_settlement($id)->result_array();
        $validate =  $this->M_Settlement->count_validate($id)->num_rows();

        
        if($data['total_paid_payment'][0]['total_value'] !=  $data['total_settlement'][0]['total_value'] ){
            $this->session->set_flashdata('error_msg', 'Total pencairan dan penyelesain tidak sesuai !');
            redirect(base_url('settlement/detail/'.$id));
        }elseif( $validate > 0){
            $this->session->set_flashdata('error_msg', $validate.' penyelesaian belum tervalidasi !');
            redirect(base_url('settlement/detail/'.$id));
        }elseif( $data['total_prab_value'][0]['value'] != $data['total_payment'][0]['total_value']){
            $this->session->set_flashdata('error_msg',  'Pencairan belum selesai. Silahkan selesaikan pencairan terlebih dahulu');
            redirect(base_url('settlement/detail/'.$id));
        }else{
            $this->M_Settlement->finish_prab($id);
            $this->session->set_flashdata('msg', 'PRAB No'.$id.' telah diselesaikan');
            redirect(base_url('settlement'));
        }
    }


    function print($id){
        $data['get_prab']                       = $this->M_Payment->get_detail_prab($id)->result();
        $data['groups_prab']                    = $this->M_Payment->get_groups_prab($id)->result();
        $data['items_prab']                     = $this->M_Payment->get_items_prab($id)->result();
        $data['payment_list']                   = $this->M_Payment->get_payment_list($id)->result();
        $data['get_total_value']                = $this->M_Payment->get_total_value($id)->result_array();
        $data['get_total_settlement_value']     = $this->M_Settlement->get_total_settlement_value($id)->result();
        $data['settlement_list']                = $this->M_Settlement->get_settlement_list($id)->result();
// print_r($data['get_total_value'][0]['total_value'] );
        $this->load->view('v_printSettlement', $data);
    }

    function add_overpayment(){
        $id         = $this->input->post('prab_id');
        $data['total_paid_payment']             = $this->M_Payment->get_total_paid_value($id)->result_array();
        $data['get_total_settlement_value']     = $this->M_Settlement->get_total_settlement_value($id)->result_array();
        
        if(($data['total_paid_payment'][0]['total_value']-$data['get_total_settlement_value'][0]['total_value'])  >= $this->input->post('value')){
            $data = array(
                'date'          => date('Y-m-d'),
                'prab_id'       => $id,
                'value'         => $this->input->post('value'),
                'description'   => 'Kelebihan pencairan - '.$this->input->post('description'),
                'isOverpayment' => 1
                );
    
                $this->M_Settlement->add_settlement($data);
                $this->M_Settlement->user_log('Menambakan kelebihan pencairan penyelesain PRAB no : '.$id);
                $this->session->set_flashdata('msg', 'Penyelesain berhasil ditambahkan');
                redirect(base_url('settlement/detail/'.$id));
        }else{
            $this->session->set_flashdata('error_msg', 'Penyelesain gagal ditambahkan, pastikan jumlah tidak dicairkan tidak lebih dari pencairan!');
            redirect(base_url('settlement/detail/'.$id));
        }

    }

    
}