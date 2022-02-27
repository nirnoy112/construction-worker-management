<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_status_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get company_status by id
     */
    function get_company_status($id)
    {
        return $this->db->get_where('company_statuses',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all company_statuses
     */
    function get_all_company_statuses()
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get('company_statuses')->result_array();
    }
        
    /*
     * function to add new company_status
     */
    function add_company_status($params)
    {
        $this->db->insert('company_statuses',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update company_status
     */
    function update_company_status($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('company_statuses',$params);
    }
    
    /*
     * function to delete company_status
     */
    function delete_company_status($id)
    {
        return $this->db->delete('company_statuses',array('id'=>$id));
    }
}
