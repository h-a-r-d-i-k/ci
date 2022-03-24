<?php 

class User_model extends CI_Model {

    public function signup($data)
    {
	    $this->db->where('email', $data['email']);
	    $getdata = $this->db->get('user');
	    $getdata = $getdata->result_array();
	    if (empty($getdata)) {
		    $this->db->insert('user',$data);
		    return $this->db->insert_id();
	    } else {
		    return $getdata[0]['id'];
	    }
	 
    }
    public function insert($data,$table)
    {
	    $this->db->insert($table,$data);
	    return $this->db->insert_id();
    }
    public function retrive($data)
    {
	    $this->db->where('email', $data['email']);
	    $this->db->where('password', $data['password']);
	    $getdata = $this->db->get('user');
	    return $getdata->result_array();
    }
    public function activate($id)
    {
	    $this->db->where('id', $id);
	    $this->db->update('user',array('active' => 1));
	    return 1;
    }

}