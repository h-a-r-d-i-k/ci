<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('login_session') == '') {
		// $session = $this->session->userdata('login_session');
			redirect('User/index', 'refresh');
		}else{
			$this->product_insert();
		}
	}
	public function product_insert()
	{
		$this->load->view('product_insert');
	}
	public function list()
	{
		if($this->session->userdata('login_session') == '') {
			redirect('User/index', 'refresh');
		}else{
			if ($this->input->post()) {
				$data = $this->input->post();
				$id = $data['id'];
				// print_r($id);exit;
				$total = $data['product_qty'] * $data['price'];
				$id = $this->session->set_userdata('userlogged_in');
	        	$insert = array(
	        		'user_id'=>$_SESSION['login_session'][0]['id'],
			        'product_qty'=>$data['product_qty'],
			        'price'=> $data['price'],
			        'total'=>$total,
			        'status' => 1,
			    );
				$this->db->where('id', $id);
		    	$this->db->update('product',$insert);
				redirect('dashboard/list', 'refresh');

			}else{
				$this->load->view('product_list');
			}
		}
	}

	public function dashboard_list(){
		if($this->session->userdata('login_session') == '') {
			redirect('User/index', 'refresh');
		}else{
			$this->load->view('dashboard_list');
		}
	}

	public function product()
	{
        $uid='10'; //creare seperate folder for each user 
        $upPath= "/var/www/html/ci/assets/".$uid;
        if(!file_exists($upPath)) 
        {
                   mkdir($upPath, 0777, true);
        }
        $config = array(
	        'upload_path' => $upPath,
	        'allowed_types' => "gif|jpg|png|jpeg|svg",
	        'overwrite' => TRUE
        );
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('image'))
        { 
            $data['imageError'] =  $this->upload->display_errors();

            print_r($data);

        }
        else
        {
            $imageDetailArray = $this->upload->data();
            $data = $this->input->post();

            // $imageurl = "ci/assets/10/".$imageDetailArray['file_name'];  
            $imageurl = $imageDetailArray['file_name'];  
        	$insert = array(
		        'title'=>$data['title'],
		        'description'=> $data['description'],
		        'image'=>$imageurl,
		        'status'=>0,
		    );

			$id = $this->user_model->insert($insert, 'product');
			redirect('dashborad/list', 'refresh');
			// redirect('dashboard/index', 'refresh');

        }
	}
	
}

