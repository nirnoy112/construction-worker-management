<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class First_aid_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get first_aid by id
     */
    function get_first_aid($id)
    {
        return $this->db->get_where('first_aids',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all first_aids
     */
    function get_all_first_aids()
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get('first_aids')->result_array();
    }
        
    /*
     * function to add new first_aid
     */
    function add_first_aid($params)
    {
        $this->db->insert('first_aids',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update first_aid
     */
    function update_first_aid($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('first_aids',$params);
    }
    
    /*
     * function to delete first_aid
     */
    function delete_first_aid($id)
    {
        return $this->db->delete('first_aids',array('id'=>$id));
    }
}
