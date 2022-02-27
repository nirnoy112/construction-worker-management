<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Medical_supply_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get medical_supply by id
     */
    function get_medical_supply($id)
    {
        return $this->db->get_where('medical_supplies',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all medical_supplies
     */
    function get_all_medical_supplies()
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get('medical_supplies')->result_array();
    }
        
    /*
     * function to add new medical_supply
     */
    function add_medical_supply($params)
    {
        $this->db->insert('medical_supplies',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update medical_supply
     */
    function update_medical_supply($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('medical_supplies',$params);
    }
    
    /*
     * function to delete medical_supply
     */
    function delete_medical_supply($id)
    {
        return $this->db->delete('medical_supplies',array('id'=>$id));
    }
}
