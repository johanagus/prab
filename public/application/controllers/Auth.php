<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller{

	function __construct(){
		parent::__construct();	
        $this->load->model('M_Auth');
		$this->load->library('session');
		$this->load->helper('url');
		
	}

	function index(){
		$this->load->view('v_login');
	}

	function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
 			'password' => md5($password)
			);
		$cek = $this->M_Auth->login_cek($where)->num_rows();
		if($cek > 0){
			$data['user_data'] = $this->M_Auth->get_user_data($where)->result();
			foreach($data['user_data'] as $user_data){
				$outlet 	 = $user_data->outlet;
				$departement = $user_data->departement;
				$level 		 = $user_data->level;
				$authority   = $user_data->authority;
				$id    		 = $user_data->id;
				$isActive	 = $user_data->isActive;
				$name		 = $user_data->first_name;
				$last_name	 = $user_data->last_name;
				$PICid		 = $user_data->PICid;
			}

			if($isActive == 1){
				$data_session = array(
					'prab-id' 			=> $id,
					'prab-name' 		=> strtoupper($name),
					'prab-last_name' 	=> strtoupper($last_name),
					'prab-username' 	=> strtoupper($username),
					'prab-status' 		=> "login",
					'prab-outlet'  		=> strtoupper($outlet),
					'prab-department'  	=> strtoupper($departement),
					'prab-level'  		=> $level,
					'prab-otoritas'  	=> $authority,
					'prab-PICid'		=> $PICid,
					'prab-version'		=> "1.4.8"
				);
	
				$this->session->set_userdata($data_session);
				redirect(base_url("dashboard"));
			}else{
				$this->session->set_flashdata('error_msg', 'Akun anda tidak aktif, Silahkan hubungi administrator !');
				redirect(base_url("auth"));
			}

		}else{
			$this->session->set_flashdata('error_msg', 'Nama Akun atau kata sandi tidak cocok !');
			redirect(base_url("auth"));
			
		}
	}
    
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}


	function register(){
		$data['outlet'] 		= $this->M_Auth->get_outlet()->result();
		$data['departement'] 	= $this->M_Auth->get_departement()->result();
		$this->load->view('v_register', $data);
	}

	function add_user(){
		$cek_userId = $this->M_Auth->userId_check($this->input->post('username'))->num_rows();
		if($cek_userId > 0){
			$this->session->set_flashdata('error_msg', 'Nama Akun sudah terdaftar, silahkan login');
			redirect(base_url('auth'));
		}else{
			$data = array(
				'first_name' 	=> $this->input->post('first_name'),
				'last_name' 	=> $this->input->post('last_name'),
				'username' 		=> $this->input->post('username'),
				'password' 		=> md5($this->input->post('password')),
				'email'			=> $this->input->post('email'),
				'departement' 	=> $this->input->post('departement'),
				'outlet' 		=> $this->input->post('outlet'),
				'authority'		=> 'User'
			);
	
			$this->M_Auth->add_user($data);
			$this->session->set_flashdata('msg', 'Nama Akun berhasil di daftarkan. Silahkan hubungi administrator untuk pengaktifan akun');
			redirect(base_url('auth'));
		}

	}

}