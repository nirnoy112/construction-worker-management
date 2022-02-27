<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_status_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get site_status by id
     */
    function get_site_status($id)
    {
        return $this->db->get_where('site_statuses',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all site_statuses
     */
    function get_all_site_statuses()
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get('site_statuses')->result_array();
    }
        
    /*
     * function to add new site_status
     */
    function add_site_status($params)
    {
        $this->db->insert('site_statuses',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update site_status
     */
    function update_site_status($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('site_statuses',$params);
    }
    
    /*
     * function to delete site_status
     */
    function delete_site_status($id)
    {
        return $this->db->delete('site_statuses',array('id'=>$id));
    }
}
