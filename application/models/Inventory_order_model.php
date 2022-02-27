<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_order_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get inventory_order by id
     */
    function get_inventory_order($id)
    {
        return $this->db->get_where('inventory_orders',array('id'=>$id))->row_array();
    }

    /*
     * Get site's inventory_orders by site id
     */
    function get_site_inventory_orders($id)
    {
        return $this->db->get_where('inventory_orders',array('siteId'=>$id))->result_array();
    }
        
    /*
     * Get all inventory_orders
     */
    function get_all_inventory_orders()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('inventory_orders')->result_array();
    }
        
    /*
     * function to add new inventory_order
     */
    function add_inventory_order($params)
    {
        $this->db->insert('inventory_orders',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update inventory_order
     */
    function update_inventory_order($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('inventory_orders',$params);
    }
    
    /*
     * function to delete inventory_order
     */
    function delete_inventory_order($id)
    {
        return $this->db->delete('inventory_orders',array('id'=>$id));
    }

    /*
     * Get all orders count
     */
    function get_all_inventory_orders_count()
    {

        $count = $this->db->count_all_results('inventory_orders');

        return $count;
    }

    /*
     * Get filtered orders count
     */
    function get_filtered_orders_count($query_rules)
    {

        $where = array();

        if($query_rules['statusId'] != 0 && $query_rules['statusId'] != '0') {

            $where['statusId'] = $query_rules['statusId'];

        }

        if($query_rules['dateFrom'] != null || $query_rules['dateFrom'] != '') {

            $where['creatingTime >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null || $query_rules['dateTo'] != '') {

            $where['creatingTime <= '] = $query_rules['dateTo'];

        }

        if($query_rules['CreatingUserId'] != 0) {

            $where['CreatingUserId'] = $query_rules['CreatingUserId'];

        }

        if(!empty($where)) {
            $this->db->where($where);
        }

        if(!empty($query_rules['siteIds'])) {
            $this->db->where_in('siteId', $query_rules['siteIds']);
        }

        $count = $this->db->count_all_results('inventory_orders');

        return $count;
    }

    /*
     * Get filtered orders
     */
    function get_filtered_orders($query_rules, $params)
    {
        $where = array();
        
        if($query_rules['statusId'] != 0 && $query_rules['statusId'] != '0') {

            $where['statusId'] = $query_rules['statusId'];

        }

        if($query_rules['dateFrom'] != null || $query_rules['dateFrom'] != '') {

            $where['creatingTime >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null || $query_rules['dateTo'] != '') {

            $where['creatingTime <= '] = $query_rules['dateTo'];

        }

        if($query_rules['CreatingUserId'] != 0) {

            $where['CreatingUserId'] = $query_rules['CreatingUserId'];

        }

        $this->db->select('*')
                 ->from('inventory_orders');

        if(!empty($where)) {
            $this->db->where($where);
        }

        if(!empty($query_rules['siteIds'])) {

            $this->db->where_in('siteId', $query_rules['siteIds']);

        }

        $this->db->order_by('osStatusId', 'asc');

        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }

        $query = $this->db->get();

        $results = $query->result_array();

        return $results;
    }
    
}
