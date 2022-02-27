<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Vaccination_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get vaccination by id
     */
    function get_vaccination($id)
    {
        return $this->db->get_where('vaccinations',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all vaccinations
     */
    function get_all_vaccinations()
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get('vaccinations')->result_array();
    }
        
    /*
     * function to add new vaccination
     */
    function add_vaccination($params)
    {
        $this->db->insert('vaccinations',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update vaccination
     */
    function update_vaccination($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('vaccinations',$params);
    }
    
    /*
     * function to delete vaccination
     */
    function delete_vaccination($id)
    {
        return $this->db->delete('vaccinations',array('id'=>$id));
    }
}
