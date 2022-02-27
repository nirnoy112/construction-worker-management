<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_status_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get order_status by id
     */
    function get_order_status($id)
    {
        $order_status = $this->db->query("
            SELECT
                *

            FROM
                `order_statuses`

            WHERE
                `id` = ?
        ",array($id))->row_array();

        return $order_status;
    }
        
    /*
     * Get all order_statuss
     */
    function get_all_order_statuses()
    {
        $order_statuss = $this->db->query("
            SELECT
                *

            FROM
                `order_statuses`

            WHERE
                1 = 1

            ORDER BY `id` ASC
        ")->result_array();

        return $order_statuss;
    }
        
    /*
     * function to add new order_status
     */
    function add_order_status($params)
    {
        $this->db->insert('order_statuses',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update order_status
     */
    function update_order_status($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('order_statuses',$params);
    }
    
    /*
     * function to delete order_status
     */
    function delete_order_status($id)
    {
        return $this->db->delete('order_statuses',array('id'=>$id));
    }
}
