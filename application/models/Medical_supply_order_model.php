<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Medical_supply_order_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get medical_supply_order by id
     */
    function get_medical_supply_order($id)
    {
        return $this->db->get_where('medical_supply_orders',array('id'=>$id))->row_array();
    }

    /*
     * Get site's medical_supply_orders by site id
     */
    function get_site_medical_supply_orders($id)
    {
        return $this->db->get_where('medical_supply_orders',array('siteId'=>$id))->result_array();
    }
        
    /*
     * Get all medical_supply_orders
     */
    function get_all_medical_supply_orders()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('medical_supply_orders')->result_array();
    }
        
    /*
     * function to add new medical_supply_order
     */
    function add_medical_supply_order($params)
    {
        $this->db->insert('medical_supply_orders',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update medical_supply_order
     */
    function update_medical_supply_order($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('medical_supply_orders',$params);
    }
    
    /*
     * function to delete medical_supply_order
     */
    function delete_medical_supply_order($id)
    {
        return $this->db->delete('medical_supply_orders',array('id'=>$id));
    }
}
