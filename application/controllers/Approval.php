<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Approval extends CI_Controller{

	function __construct(){
		parent::__construct();	
        $this->load->model('M_Approval');
        $this->load->model('M_Auth');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper('url');
        if($this->session->userdata('prab-status') == ""){
            redirect(base_url('auth'));
        }elseif($this->session->userdata('prab-otoritas') == "User" || $this->session->userdata('prab-otoritas') == "Finance"){
            $this->session->set_flashdata('access_denied', 'Anda tidak diijinkan mengakses halaman persetujuan');
            redirect(base_url('dashboard'));
        }
	}

	function index(){
        $data['count_notification']              = $this->M_Approval->get_notification()->num_rows();
        $data['get_notification']                = $this->M_Approval->get_notification()->result();
        $data['get_all_data_submitted_prab']     = $this->M_Approval->get_all_data_submitted_prab()->result();
        $this->load->view('v_approval', $data);
        
    }

    function search_prab(){
        $query = $this->input->post('search');
        if(isset($query)){
            $data['count_notification']             = $this->M_Approval->get_notification()->num_rows();
            $data['get_notification']               = $this->M_Approval->get_notification()->result();
            $data['get_all_data_submitted_prab']    = $this->M_Approval->search_prab($query)->result();
            $this->load->view('v_approval', $data);
        }else{
            redirect(base_url('approval'));
        }
    }

    function detail($id){
        $data['count_notification']  = $this->M_Approval->get_notification()->num_rows();
        $data['get_notification']    = $this->M_Approval->get_notification()->result();
        $data['detail_prab']         = $this->M_Approval->get_detail_prab($id)->result();
        $data['groups_prab']         = $this->M_Approval->get_groups_prab($id)->result();
        $data['items_prab']          = $this->M_Approval->get_items_prab($id)->result();
        $data['principle']           = $this->M_Approval->get_principle()->result();
        $data['financing_support']   = $this->M_Approval->get_financing_support($id)->result();
		$this->load->view('v_detailApprovalPrab', $data);
    }

    function reject(){
        $id           = $this->input->post('prab_id');
        $modify       = $this->input->post('modify');
        $note         = $this->input->post('note');

        $this->M_Approval->reject($id, $modify, $note);
        $this->M_Approval->user_log('Menolak PRAB No '.$id);
		redirect(base_url('approval'));
    }

    function approve(){
        $id         = $this->input->post('prab_id');
        $note       = $this->input->post('approve_note');
        $authority  = $this->session->userdata('prab-otoritas');

        if($authority == "Administrator" || $authority == "Direktur Keuangan"){
            $this->M_Approval->approve($id, 5 ,'Disetujui', $note);
            $this->M_Approval->user_log('Mensetujui PRAB No '.$id);
            redirect(base_url('approval'));
        }elseif($authority == "Manager" || $authority == "Direktur" || $authority == "Supervisor"){
            $this->M_Approval->approve($id, 2 ,'Disetujui', $note);
            $this->M_Approval->user_log('Mensetujui PRAB No '.$id);

            $data['DiFi_info']      = $this->M_Approval->get_DiFi()->result_array();
            $data['detail_prab']    = $this->M_Approval->get_detail_prab($id)->result_array();
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from('prab.topsellgroup@gmail.com', 'PRAB'); 
            $this->email->to($data['DiFi_info'][0]['email']);
            $this->email->subject('Permohonan persetujuan PRAB');
            $this->email->message('
            <table width="600">
            <tbody><tr>
                <td colspan="3">
                <strong>Dear,</strong>
                <br>
                <strong>'.strtoupper($data['DiFi_info'][0]['first_name']).' '.strtoupper($data['DiFi_info'][0]['last_name']).'</strong>
                <br>
                <br>
                Email ini merupakan pemberitahuan persetujuan PRAB. Berikut informasi singkat prab yang diajukan:
                </td>
            </tr>
            <tr>
                <td colspan="3">
                </td>
            </tr>
            <tr>	
                <td width="30%">Tanggal</td>
                <td>	: </td>
                <td>'.date('d-m-Y', strtotime($data['detail_prab'][0]['date'])).'</td>        
            </tr>
            <tr>
                <td>Tema</td>
                <td>	: </td>
                <td>'.strtoupper($data['detail_prab'][0]['topic']).'</td>   
            </tr>
            <tr>
                <td>Nama Pemohon</td>
                <td>	: </td>
                <td>'.strtoupper($data['detail_prab'][0]['applicant']).'</td>
            </tr>
            <tr>
                <td>Departemen</td>
                <td>   : </td>
                <td>'.strtoupper($data['detail_prab'][0]['departement']).'</td>
            </tr>
            <tr>
                <td>Cabang</td>
                <td>: </td>
                <td>'.strtoupper($data['detail_prab'][0]['outlet']).'</td>
            </tr>
            <tr>
                <td>Total Anggaran</td>
                <td>	: </td>
                <td>IDR '.number_format($data['detail_prab'][0]['value'],0,',','.').'</td>
            </tr>
            <tr>
                <td colspan="3">
                    <br>
                    Untuk informasi lengkap dan persetujuan silahkan buka aplikasi e-prab, dengan klik tombol dibawah ini.
                    <br><br>	
                    <a style="display:inline-block; background-color:#2183FF; padding: 10px 30px 10px 30px; text-decoration:none; border-radius: 5px; color: white;" href="http://152312211694.ip-dynamic.com:1730/prab/public/approval">Buka Aplikasi</a>
                    <br><br>
                </td>
                </tr>
            </tbody></table>'
            );
            $this->email->send();
            redirect(base_url('approval'));
        }else{
            redirect(base_url('approval'));
        }
    }

    
}