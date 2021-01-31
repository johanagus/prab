<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct();	
        $this->load->model('M_Dashboard');
        $this->load->model('M_Auth');
        $this->load->model('M_Approval');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper('url');
        if($this->session->userdata('prab-status') == ""){
            redirect(base_url('auth'));
        }
		
	}

	function index(){
        $data['count_notification']              = $this->M_Dashboard->get_notification()->num_rows();
        $data['get_notification']                = $this->M_Dashboard->get_notification()->result();
        $data['get_all_data_prab']               = $this->M_Dashboard->get_all_data_prab()->result();
        $data['count_approved_prab']             = $this->M_Dashboard->count_approved_prab()->num_rows();
        $data['count_rejected_prab']             = $this->M_Dashboard->count_rejected_prab()->num_rows();
        $data['count_finished_prab']             = $this->M_Dashboard->count_finished_prab()->num_rows();
        $data['count_all_prab']                  = $this->M_Dashboard->count_all_prab()->num_rows();
        $data['count_global_prab']               = $this->M_Dashboard->count_global_prab()->num_rows();
        $data['get_all_data_submitted_prab']     = $this->M_Approval->get_all_data_submitted_prab()->result();
		$this->load->view('v_dashboard', $data);
    }

    function search_prab(){
        $query = $this->input->post('search');
        if(isset($query)){
            $data['count_notification']    = $this->M_Dashboard->get_notification()->num_rows();
            $data['get_notification']      = $this->M_Dashboard->get_notification()->result();
            $data['get_all_data_prab']     = $this->M_Dashboard->search_prab($query)->result();
            $data['count_approved_prab']   = $this->M_Dashboard->count_approved_prab()->num_rows();
            $data['count_rejected_prab']   = $this->M_Dashboard->count_rejected_prab()->num_rows();
            $data['count_finished_prab']   = $this->M_Dashboard->count_finished_prab()->num_rows();
            $data['count_all_prab']        = $this->M_Dashboard->count_all_prab()->num_rows();
            $data['count_global_prab']     = $this->M_Dashboard->count_global_prab()->num_rows();
            $this->load->view('v_dashboard', $data);
        }else{
            redirect(base_url('dashboard'));
        }
    }

    function detail($id){
        $data['count_notification']     = $this->M_Dashboard->get_notification()->num_rows();
        $data['get_notification']       = $this->M_Dashboard->get_notification()->result();
        $data['detail_prab']            = $this->M_Dashboard->get_detail_prab($id)->result();
        $data['groups_prab']            = $this->M_Dashboard->get_groups_prab($id)->result();
        $data['items_prab']             = $this->M_Dashboard->get_items_prab($id)->result();
        $data['priciple']               = $this->M_Dashboard->get_principle()->result();
        $data['financing_support']      = $this->M_Dashboard->get_financing_support($id)->result();
		$this->load->view('v_detailPrab', $data);
    }

    function add_new_prab(){
        $data['count_notification']    = $this->M_Dashboard->get_notification()->num_rows();
        $data['get_notification']      = $this->M_Dashboard->get_notification()->result();
        $this->load->view('v_formPrab', $data);
    }

    function add_prab_action(){
        $id =  date('YmdHis');
        $data = array(
            'id'                    => $id,
            'topic'                 => $this->input->post('topic'),
            'applicant_id'          => $this->session->userdata('prab-id'),
            'applicant'             => $this->session->userdata('prab-username'),
            'departement'           => $this->session->userdata('prab-department'),
            'outlet'                => $this->session->userdata('prab-outlet'),
            'pic'                   => $this->input->post('pic'),
            'date'                  => date('Y-m-d'),
            'background'            => $this->input->post('background'),
            'goal'                  => $this->input->post('goal'),
            'location'              => $this->input->post('location'),
            'event_date'            => $this->input->post('event_date'),
            'supporting_facilities' => $this->input->post('supporting_facilities'),
            'description'           => $this->input->post('description'),
            'status'                => 'Dibuat',
            'isModify'              => true
        );

        $this->M_Dashboard->add_new_prab($data);
        $this->M_Dashboard->user_log('Menambahkan PRAB baru');
        redirect(base_url('dashboard/add_group_item/'.$id));
    }

    function submit_prab($id){
        $count_item =  $this->M_Dashboard->count_items($id)->num_rows();

        if($count_item > 0 ){
            $this->M_Dashboard->submit_prab($id, 1 , 'Diajukan', $this->session->userdata('prab-PICid'));
            $this->session->set_flashdata('msg', 'PRAB berhasil diajukan');
            $this->M_Dashboard->user_log('Mengajukan PRAB id : '.$id);
            $data['PIC_info']      = $this->M_Dashboard->get_pic_info($this->session->userdata('prab-PICid'))->result_array();
            $data['detail_prab']    = $this->M_Dashboard->get_detail_prab($id)->result_array();

            $this->load->library('email');
            $this->email->set_newline("\r\n");   

            $this->email->from('prab.topsellgroup@gmail.com', 'PRAB'); 
            $this->email->to($data['PIC_info'][0]['email']);
            $this->email->subject('Permohonan persetujuan PRAB');
            $this->email->message('
            <table width="600">
            <tbody><tr>
                <td colspan="3">
                <strong>Dear,</strong>
                <br>
                <strong>'.strtoupper($data['PIC_info'][0]['first_name']).' '.strtoupper($data['PIC_info'][0]['last_name']).'</strong>
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
                    Untuk informasi detail dan melakukan persetujuan silahkan buka aplikasi e-prab, dengan klik tombol dibawah ini.
                    <br><br>	
                    <a style="display:inline-block; background-color:#2183FF; padding: 10px 30px 10px 30px; text-decoration:none; border-radius: 5px; color: white;" href="http://152312211694.ip-dynamic.com:1730/prab/public/approval">Buka Aplikasi</a>
                    <br><br>
                </td>
                </tr>
            </tbody></table>'
            );
            $this->email->send();
            redirect(base_url('dashboard'));
        }else{
            $this->session->set_flashdata('error_msg', 'Item tidak ditemukan');
            redirect(base_url('dashboard'));
        }


        
    }

    function change_prab($prab_id){
        
        $data['get_data_prab']  = $this->M_Dashboard->get_data_prab($prab_id)->row_array();
        if($data['get_data_prab']['isModify'] == 0){
            $this->session->set_flashdata('access_denied', 'Anda tidak diijinkan untuk ubah data');
            redirect(base_url('dashboard'));
        }else{
            $data['count_notification']    = $this->M_Dashboard->get_notification()->num_rows();
            $data['get_notification']      = $this->M_Dashboard->get_notification()->result();
            $data['get_list_group']        = $this->M_Dashboard->get_list_group()->result();
            $data['get_data_prab']         = $this->M_Dashboard->get_data_prab($prab_id)->result();
            $data['groups_prab']           = $this->M_Dashboard->get_groups_prab($prab_id)->result();
            $data['principle']               = $this->M_Dashboard->get_principle()->result();
            $data['financing_support']      = $this->M_Dashboard->get_financing_support($prab_id)->result();
            $this->load->view('v_changePrab', $data);
        }

    }

    function change_prab_action(){
        $id = $this->input->post('id');
        $data = array(
            'topic'                 => $this->input->post('topic'),
            'pic'                   => $this->input->post('pic'),
            'date'                  => date('Y-m-d'),
            'background'            => $this->input->post('background'),
            'goal'                  => $this->input->post('goal'),
            'location'              => $this->input->post('location'),
            'event_date'            => $this->input->post('event_date'),
            'supporting_facilities' => $this->input->post('supporting_facilities'),
            'description'           => $this->input->post('description'),
            'status'                => 'Dibuat'
        );

        $this->M_Dashboard->change_prab($id, $data);
        $this->M_Dashboard->user_log('Memodifikasi PRAB id : '.$id);
        redirect(base_url('dashboard/change_prab/'.$id));
    }

    function add_group_item($id){
        $data['count_notification'] = $this->M_Dashboard->get_notification()->num_rows();
        $data['get_notification']   = $this->M_Dashboard->get_notification()->result();
        $data['prab_data']          = $this->M_Dashboard->get_prab_data($id)->result();
        $data['groups_prab']        = $this->M_Dashboard->get_groups_prab($id)->result();
        $data['items_prab']         = $this->M_Dashboard->get_items_prab($id)->result();
        $data['get_list_group']     = $this->M_Dashboard->get_list_group()->result();
        $data['principle']               = $this->M_Dashboard->get_principle()->result();
        $data['financing_support']  = $this->M_Dashboard->get_financing_support($id)->result();
        $this->load->view('v_addGroupItem', $data);

    }

    function add_new_group_item(){
        $prab_id = $this->input->post('prab_id');
        $redirect = $this->input->post('redirect');
        $data = array(
            'prab_id' => $prab_id,
            'group_name' => strtoupper($this->input->post('group_name')),
        );

        $this->M_Dashboard->add_new_group_items($data);
        $this->M_Dashboard->user_log('Menambahkan Kelompok Item baru');
        redirect(base_url('dashboard/'.$redirect.'/'.$prab_id));

    }

    function delete_group_items(){
        $id      = $this->uri->segment(3);
        $prab_id = $this->uri->segment(4);
        $redirect = $this->input->get('redirect');
        $this->M_Dashboard->delete_group_items($id);
        $total_value = $this->M_Dashboard->get_value_item($prab_id)->row();
        $this->M_Dashboard->update_value_prab($prab_id, $total_value->value_total);
        $this->M_Dashboard->user_log('Menghapus Kelompok Item '.$prab_id);
        redirect(base_url('dashboard/'.$redirect.'/'.$prab_id));

    }

    function add_new_item(){
        $prab_id = $this->input->post('prab_id');
        $group_id = $this->input->post('group_id');
        $redirect = $this->input->post('redirect');
        $data = array(
            'prab_id'           => $prab_id,
            'group_id'          => $group_id,
            'item_description'  => $this->input->post('item_description'),
            'item_detail'       => $this->input->post('item_detail'),
            'qty'               => $this->input->post('qty'),
            'value_item'        => ($this->input->post('value')*$this->input->post('qty')),
            'explanation'       => $this->input->post('explanation')
        );

        $this->M_Dashboard->add_new_item($data);
        $total_value             = $this->M_Dashboard->get_value_item($prab_id)->row();
        $total_value_group_items = $this->M_Dashboard->get_value_group_items($prab_id, $group_id)->row();
        $this->M_Dashboard->update_value_prab($prab_id, $total_value->value_total);
        $this->M_Dashboard->update_value_group_item($prab_id,$group_id,  $total_value_group_items->value_total);
        $this->M_Dashboard->user_log('Menambahkan Item baru id PRAB : '.$prab_id);
        redirect(base_url($redirect));

    }

    function search_approved_prab(){
        $query = $this->input->post('search');
        if(isset($query)){
            $data['count_notification']             = $this->M_Dashboard->get_notification()->num_rows();
            $data['get_notification']               = $this->M_Dashboard->get_notification()->result();
            $data['get_all_data_prab']              = $this->M_Dashboard->get_all_data_prab()->result();
            $data['count_approved_prab']            = $this->M_Dashboard->count_approved_prab()->num_rows();
            $data['count_rejected_prab']            = $this->M_Dashboard->count_rejected_prab()->num_rows();
            $data['count_finished_prab']            = $this->M_Dashboard->count_finished_prab()->num_rows();
            $data['count_all_prab']                 = $this->M_Dashboard->count_all_prab()->num_rows();
            $data['count_global_prab']              = $this->M_Dashboard->count_global_prab()->num_rows();
            $data['get_all_data_submitted_prab']    = $this->M_Approval->search_prab($query)->result();
            $this->load->view('v_dashboard', $data);
        }else{
            redirect(base_url('dashboard'));
        }
    }

    function delete_item(){
        $item_id = $this->uri->segment(3);
        $prab_id = $this->uri->segment(4);
        $group_id = $this->uri->segment(5);
        $redirect = $this->input->get('redirect');
        $this->M_Dashboard->delete_item($item_id);
        $total_value = $this->M_Dashboard->get_value_item($prab_id)->row();
        $total_value_group_items = $this->M_Dashboard->get_value_group_items($prab_id, $group_id)->row();
        $this->M_Dashboard->update_value_prab($prab_id, $total_value->value_total);
        $this->M_Dashboard->update_value_group_item($prab_id,$group_id,  $total_value_group_items->value_total);
        $this->M_Dashboard->user_log('Menghapus 1 Item PRAB : '.$prab_id);
        redirect(base_url('dashboard/'.$redirect.'/'.$prab_id));
    }

    function add_financing_support(){
        $prab_id = $this->input->post('prab_id');
        $redirect = $this->input->post('redirect');
        $data = array(
            'prab_id'           => $prab_id,
            'principle_name'    => $this->input->post('name'),
            'date'              => date('Y-m-d'),
            'date_experied'     => $this->input->post('date_experied'),
            'description'       => $this->input->post('description'),
            'value'             => $this->input->post('value'),
            'status'            => 'Belum lunas',
            'status_id'         => 1
        );
        $this->M_Dashboard->add_financing_support($data);
        redirect(base_url('dashboard/'.$redirect.'/'.$prab_id));
    }

    function delete_financing_support(){
        $id      = $this->uri->segment(3);
        $prab_id = $this->uri->segment(4);
        $redirect = $this->input->get('redirect');
        $this->M_Dashboard->delete_financing_support($id);
        $this->M_Dashboard->user_log('Menghapus support pembiayaan '.$prab_id);
        redirect(base_url('dashboard/'.$redirect.'/'.$prab_id));
    }


}