<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$this->checklogin();
		$this->load->view('user');
	}
	public function auth()
	{
		if($this->session->userdata('login_session') == '') {
			$post_data = $this->input->post();

			$data = array(
		        'email'=>$post_data['email'],
		        'password'=> md5($post_data['password']),
		    );

			$id = $this->user_model->retrive($data);
			$this->session->set_userdata('login_session', $id);
		}
			redirect('dashboard/index', 'refresh');

	}
	public function activate($id)
	{
		$id = $this->user_model->activate($id);
			redirect('User/index', 'refresh');
	}
	public function signup()
	{
		if ($this->input->post()) {
			$data = $this->input->post();

        	$insert = array(
		        'email'=>$data['email'],
		        'password'=> md5($data['password']),
		        'active'=>0,
		        'role'=>$data['role'],
		    );

			$id = $this->user_model->signup($insert);
			$url = base_url(). '/user/activate/'.$id; 
			$message = "Activate your account by clicking on this link";
			$message .= '<br/><a href="'.$url.'">Click here</a>';
			print_r($message);
			$this->send_email($data['email'], $subject = 'Activate Account', $message);






		} else {
			$this->load->view('signup');
		}

	}


	function send_email($to, $subject, $message,$from = 'hardik@dazzlebirds.com' )
	{
		$this->email->from($from, 'hardik mehta');
		$this->email->to($to);

		$this->email->subject($subject);
		$this->email->message($message);

		$email = $this->email->send();
		print_r($email);
	}
	function checklogin()
	{
		
		if($this->session->userdata('login_session') != '') {
			redirect('dashboard/index', 'refresh');
		}
	}
}
