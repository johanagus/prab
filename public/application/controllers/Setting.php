<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Setting extends CI_Controller{

	function __construct(){
		parent::__construct();	
        $this->load->model('M_Setting');
		$this->load->library('session');
        $this->load->helper('url');
        
        if($this->session->userdata('prab-status') == ""){
            redirect(base_url('auth'));
        }elseif($this->session->userdata('prab-otoritas') == "User" || $this->session->userdata('prab-otoritas') == "Approvetor" ){
            $this->session->set_flashdata('access_denied', 'Anda tidak diijinkan mengakses halaman pengaturan');
            redirect(base_url('dashboard'));
        }
		
	}

	function index(){
        $data['outlet'] 		    = $this->M_Setting->get_outlet()->result();   
        $data['get_departement']    = $this->M_Setting->get_departement()->result();
        $data['get_list_group']     = $this->M_Setting->get_list_group()->result();  
        $data['count_notification'] = $this->M_Setting->get_notification()->num_rows();
        $data['get_notification']   = $this->M_Setting->get_notification()->result();
        $data['users_list']         = $this->M_Setting->get_users()->result();
        $data['get_PIC']            = $this->M_Setting->get_PIC()->result();
        $data['get_principle']      = $this->M_Setting->get_principle()->result();
		$this->load->view('v_setting', $data);
    }

    function activate($id){
        $this->M_Setting->change_isActive($id, 1);
        $this->session->set_flashdata('msg', 'Pengguna berhasil di aktifkan');
        redirect(base_url('setting'));
     

    }

    function diactivate($id){
        $this->M_Setting->change_isActive($id, 0);
        $this->session->set_flashdata('msg', 'Pengguna berhasil di non aktifkan');
        redirect(base_url('setting'));
        
    }

    function search_user(){
        $query = $this->input->post('query');
        $data['outlet'] 		    = $this->M_Setting->get_outlet()->result();   
        $data['get_departement']    = $this->M_Setting->get_departement()->result();
        $data['count_notification'] = $this->M_Setting->get_notification()->num_rows();
        $data['get_notification']   = $this->M_Setting->get_notification()->result();
        $data['users_list']         = $this->M_Setting->search_user($query)->result();
        $data['get_list_group']     = $this->M_Setting->get_list_group()->result();
        $data['get_PIC']            = $this->M_Setting->get_PIC()->result(); 
        $this->load->view('v_setting', $data);
    }

    function add_user(){
        $data = array(
            'first_name' 	=> $this->input->post('first_name'),
            'last_name' 	=> $this->input->post('last_name'),
            'username' 		=> $this->input->post('username'),
            'password' 		=> md5($this->input->post('password')),
            'email'			=> $this->input->post('email'),
            'departement' 	=> $this->input->post('departement'),
            'outlet' 		=> $this->input->post('outlet'),
            'authority'		=> $this->input->post('authority'),
            'PICid'         => $this->input->post('PICid'),    
            'isActive'      => 1
        );

        $this->M_Setting->add_user($data);
        $this->session->set_flashdata('msg', 'Akun telah berhasil di daftarkan !');
        redirect(base_url('setting'));
    }

    function delete($id){
        $this->M_Setting->delete_user($id);
        $this->M_Setting->user_log('Menghapus pengguna');
        $this->session->set_flashdata('msg', 'Pengguna berhasil di hapus');
        redirect(base_url('setting'));
    }

    function add_outlet(){
        if($this->session->userdata('prab-otoritas') == "Administrator"){
            $data = array(
                'kode' => $this->input->post('outlet_code'),
                'nama' => $this->input->post('outlet_name')
            );

            $this->M_Setting->add_outlet($data);
            $this->M_Setting->user_log('Menambahkan cabang baru');
            $this->session->set_flashdata('msg', 'Cabang baru berhasil di tambahkan');
            redirect(base_url('setting'));
        }else{
            $this->session->set_flashdata('error_msg', 'anda tidak diijinkan menambah outlet');
            redirect(base_url('setting'));
        }
    }

    function add_dept(){
        if($this->session->userdata('prab-otoritas') == "Administrator"){
            $this->M_Setting->add_dept($this->input->post('dept_name'));
            $this->M_Setting->user_log('Menambahkan departement baru');
            $this->session->set_flashdata('msg', 'Departemen baru berhasil di tambahkan');
            redirect(base_url('setting'));
        }else{
            $this->session->set_flashdata('error_msg', 'anda tidak diijinkan menambah departemen');
            redirect(base_url('setting'));
        }
    }

    function add_group_item(){
        if($this->session->userdata('prab-otoritas') == "Administrator" || $this->session->userdata('prab-otoritas') == "Finance"){
            $this->M_Setting->add_group($this->input->post('group_name'));
            $this->M_Setting->user_log('Menambahkan kelompok item baru');
            $this->session->set_flashdata('msg', 'Kelompok item baru berhasil di tambahkan');
            redirect(base_url('setting'));
        }else{
            $this->session->set_flashdata('error_msg', 'anda tidak diijinkan menambah kelompok item');
            redirect(base_url('setting'));
        }
    }

    function delete_outlet($id){
        $this->M_Setting->delete_outlet($id);
        $this->M_Setting->user_log('Menghapus cabang');
        $this->session->set_flashdata('msg', '1 cabang berhasil di hapus');
        redirect(base_url('setting'));
    }

    function delete_dept($id){
        $this->M_Setting->delete_dept($id);
        $this->M_Setting->user_log('Menghapus departemen');
        $this->session->set_flashdata('msg', '1 departemen berhasil di hapus');
        redirect(base_url('setting'));
    }

    function delete_group($id){
        $this->M_Setting->delete_group($id);
        $this->M_Setting->user_log('Menghapus kelompok item');
        $this->session->set_flashdata('msg', '1 kelompok item berhasil di hapus');
        redirect(base_url('setting'));
    }

    function add_principle(){
        $data = array(
            'name'      => $this->input->post('name'),
            'phone'     => $this->input->post('phone'),
            'address'   => $this->input->post('address'),
            'status'    => 'Aktif'
        );

        $this->M_Setting->add_principle($data);
        $this->M_Setting->user_log('Menambah principle '.$this->input->post('name'));
        $this->session->set_flashdata('msg', 'principle '.$this->input->post('name').' berhasil di tambahkan');
        redirect('setting');
    }

    function delete_principle($id){
        $this->M_Setting->delete_principle($id);
        $this->M_Setting->user_log('menghapus 1 data principle');
        $this->session->set_flashdata('msg', '1 principle telah di hapus');
        redirect('setting');
    }

    
}