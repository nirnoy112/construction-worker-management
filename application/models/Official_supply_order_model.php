<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Official_supply_order_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get official_supply_order by id
     */
    function get_official_supply_order($id)
    {
        return $this->db->get_where('official_supply_orders',array('id'=>$id))->row_array();
    }

    /*
     * Get site's official_supply_orders by site id
     */
    function get_site_official_supply_orders($id)
    {
        return $this->db->get_where('official_supply_orders',array('siteId'=>$id))->result_array();
    }
        
    /*
     * Get all official_supply_orders
     */
    function get_all_official_supply_orders()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('official_supply_orders')->result_array();
    }
        
    /*
     * function to add new official_supply_order
     */
    function add_official_supply_order($params)
    {
        $this->db->insert('official_supply_orders',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update official_supply_order
     */
    function update_official_supply_order($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('official_supply_orders',$params);
    }
    
    /*
     * function to delete official_supply_order
     */
    function delete_official_supply_order($id)
    {
        return $this->db->delete('official_supply_orders',array('id'=>$id));
    }
}
