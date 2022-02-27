<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Official_supply_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get official_supply by id
     */
    function get_official_supply($id)
    {
        return $this->db->get_where('official_supplies',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all official_supplies
     */
    function get_all_official_supplies()
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get('official_supplies')->result_array();
    }
        
    /*
     * function to add new official_supply
     */
    function add_official_supply($params)
    {
        $this->db->insert('official_supplies',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update official_supply
     */
    function update_official_supply($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('official_supplies',$params);
    }
    
    /*
     * function to delete official_supply
     */
    function delete_official_supply($id)
    {
        return $this->db->delete('official_supplies',array('id'=>$id));
    }
}
