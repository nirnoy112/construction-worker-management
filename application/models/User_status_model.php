<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class User_status_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get user_status by id
     */
    function get_user_status($id)
    {
        return $this->db->get_where('user_statuses',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all user_statuses
     */
    function get_all_user_statuses()
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get('user_statuses')->result_array();
    }
        
    /*
     * function to add new user_status
     */
    function add_user_status($params)
    {
        $this->db->insert('user_statuses',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update user_status
     */
    function update_user_status($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('user_statuses',$params);
    }
    
    /*
     * function to delete user_status
     */
    function delete_user_status($id)
    {
        return $this->db->delete('user_statuses',array('id'=>$id));
    }
}
