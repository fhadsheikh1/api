<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getUser($uid)
    {
        $query = $this->db->get_where('users',array('helpdesk_id'=>$uid));
        return $query->row();
    }
    
    public function createUser($helpdesk_id, $firstname, $lastname, $title, $sid, $email)
    {
        $data = array(
            'helpdesk_id' => $helpdesk_id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'jobtitle' => $title,
            'sid' => $sid,
            'email' => $email
        );
        
        $this->db->insert('users',$data);
        
        $query = $this->db->get_where('users', array('helpdesk_id' => $helpdesk_id));
        $user = $query->row();
        
        $permissions = array(
            'pid' => $user->id
        );
        
        $this->db->insert('permissions',$permissions);
        
        
    }
    
    public function getPermissions($pid)
    {
        $this->db->select('admin,client');
        $query = $this->db->get_where('permissions',array('pid'=>$pid));
        return $query->row();
    }
    
}