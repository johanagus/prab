<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Profile extends CI_Controller{

	function __construct(){
		parent::__construct();	
        $this->load->model('M_Profile');
		$this->load->library('session');
        $this->load->helper('url');
        if($this->session->userdata('prab-status') == ""){
            redirect(base_url('auth'));
        }
		
	}

	function index(){
        $data['count_notification']    = $this->M_Profile->get_notification()->num_rows();
        $data['get_notification']      = $this->M_Profile->get_notification()->result();
        $data['get_profile']           = $this->M_Profile->get_user_profile()->result();
        $data['get_outlet']            = $this->M_Profile->get_outlet()->result();
        $data['get_departement']       = $this->M_Profile->get_departement()->result();
		$this->load->view('v_profile', $data);
    }

    function change_profile(){
        $id = $this->session->userdata('prab-id');
        $data = array(
            'first_name' 	=> $this->input->post('first_name'),
            'last_name' 	=> $this->input->post('last_name'),
            'email'			=> $this->input->post('email'),
            'departement' 	=> $this->input->post('departement'),
            'outlet' 		=> $this->input->post('outlet'),
        );

        $this->M_Profile->change_profile($id, $data);
        $this->session->set_flashdata('msg', 'Profile anda berhasil dirubah !');
        redirect(base_url('profile'));
    }

    function change_password(){
        $id             = $this->session->userdata('prab-id');
        $pass           = md5($this->input->post('current_password'));
        $new_pass       = md5($this->input->post('new_password'));
        $retype_pass    = md5($this->input->post('retype_password'));
        $data['password']   = $this->M_Profile->password_cek($id)->result_array();
        
        if($data['password'][0]['password'] ==  $pass){
            if($new_pass ==  $retype_pass ){
                $this->M_Profile->change_password($id, $new_pass);
                $this->session->set_flashdata('msg', 'Kata sandi berhasil di ubah');
                redirect(base_url('profile'));
            }else{
                $this->session->set_flashdata('error_msg', 'Kata sandi baru dan konfirmasi sandi tidak cocok !');
                redirect(base_url('profile'));
            }
        }else{
            $this->session->set_flashdata('error_msg', 'Kata sandi saat ini salah !');
            redirect(base_url('profile'));
        }
    }

    

    
}