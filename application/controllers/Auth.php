<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model','user');
        if($this->session->userdata('logged')){
            redirect('welcome');
        }
    }

    public function login(){
    	$this->load->view('auth/login');
    }

    public function valid(){
    	$user = $this->user->auth($this->input->post('username'),md5($this->input->post('password')));
    	if($user){
            $sess = array(
                'logged' => TRUE,
                'id' => $user->id,
                'username' => $user->username,
            );
            $this->session->set_userdata($sess);
    		redirect('welcome');
    	}else{
    		$this->session->set_flashdata('message', 'Your credential are wrong, please try again.');
    		redirect('auth/login');
    	}
    }

    public function logout(){
    	$this->session->sess_destroy();
    	redirect('auth/login');
    }

}
