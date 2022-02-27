<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_type_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get company_type by id
     */
    function get_company_type($id)
    {
        return $this->db->get_where('company_types',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all company_types
     */
    function get_all_company_types()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('company_types')->result_array();
    }
        
    /*
     * function to add new company_type
     */
    function add_company_type($params)
    {
        $this->db->insert('company_types',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update company_type
     */
    function update_company_type($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('company_types',$params);
    }
    
    /*
     * function to delete company_type
     */
    function delete_company_type($id)
    {
        return $this->db->delete('company_types',array('id'=>$id));
    }
}
