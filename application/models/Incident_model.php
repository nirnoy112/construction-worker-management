<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Incident_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get incident by id
     */
    function get_incident($id)
    {
        return $this->db->get_where('incidents',array('id'=>$id))->row_array();
    }

    /*
     * Get site's incidents by site id
     */
    function get_site_incidents($id)
    {
        return $this->db->get_where('incidents',array('siteId'=>$id))->result_array();
    }

    /*
     * Get worker's incidents by worker id
     */
    function get_worker_incidents($id)
    {
        return $this->db->get_where('incidents',array('workerId'=>$id))->result_array();
    }
        
    /*
     * Get all incidents
     */
    function get_all_incidents()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('incidents')->result_array();
    }
        
    /*
     * function to add new incident
     */
    function add_incident($params)
    {
        $this->db->insert('incidents',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update incident
     */
    function update_incident($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('incidents',$params);
    }
    
    /*
     * function to delete incident
     */
    function delete_incident($id)
    {
        return $this->db->delete('incidents',array('id'=>$id));
    }

    /*
     * Get all orders count
     */
    function get_all_incidents_count()
    {

        $count = $this->db->count_all_results('incidents');

        return $count;
    }

    /*
     * Get all orders count
     */
    function get_filtered_orders_count($query_rules)
    {

        $where = array();

        if($query_rules['ohsStaffId'] != 0 && $query_rules['ohsStaffId'] != '0') {

            $where['ohsStaffId'] = $query_rules['ohsStaffId'];

        }

        if($query_rules['siteId'] != 0 && $query_rules['siteId'] != '0') {

            $where['siteId'] = $query_rules['siteId'];

        }

        if($query_rules['dateFrom'] != null || $query_rules['dateFrom'] != '') {

            $where['date >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null || $query_rules['dateTo'] != '') {

            $where['date <= '] = $query_rules['dateTo'];

        }

        if(!empty($where)) {
            $this->db->where($where);
        }


        $count = $this->db->count_all_results('incidents');

        return $count;
    }

    /*
     * Get all orders
     */
    function get_filtered_orders($query_rules, $params)
    {
        if($query_rules['ohsStaffId'] != 0 && $query_rules['ohsStaffId'] != '0') {

            $where['ohsStaffId'] = $query_rules['ohsStaffId'];

        }

        if($query_rules['siteId'] != 0 && $query_rules['siteId'] != '0') {

            $where['siteId'] = $query_rules['siteId'];

        }

        if($query_rules['dateFrom'] != null || $query_rules['dateFrom'] != '') {

            $where['date >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null || $query_rules['dateTo'] != '') {

            $where['date <= '] = $query_rules['dateTo'];

        }

        $this->db->select('*')
                 ->from('incidents');

        if(!empty($where)) {
            $this->db->where($where);
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
