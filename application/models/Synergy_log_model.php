<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Synergy_log_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get synergy_log by id
     */
    function get_synergy_log($id)
    {
        return $this->db->get_where('synergy_log',array('id'=>$id))->row_array();
    }

    /*
     * Count all synergy_log
     */
    function count_all_synergy_log()
    {
        $count = $this->db->count_all_results('synergy_log');

        return $count;
    }
        
    /*
     * Get all synergy_log
     */
    function get_all_synergy_log()
    {
        $this->db->order_by('time', 'desc');
        return $this->db->get('synergy_log')->result_array();
    }

    /*
     * Get all synergy_log records count
     */
    function get_sl_count($query_rules) {

        $where = array();

        if($query_rules['dateFrom'] != null && $query_rules['dateFrom'] != '') {

            $where['time >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null && $query_rules['dateTo'] != '') {

            $where['time <= '] = $query_rules['dateTo'];

        }

        if($query_rules['success'] != 1) {

            $where['success'] = $query_rules['success'];

        }

        if(!empty($where)) {

            $this->db->where($where);

        }

        if(!empty($query_rules['events'])) {

            $this->db->where_in('event', $query_rules['events']);
            
        }

        $count = $this->db->count_all_results('synergy_log');

        return 0;

    }

    /*
     * Get all synergy_log records count
     */
    function get_sl_records($query_rules, $params) {

        $where = array();

        if($query_rules['dateFrom'] != null && $query_rules['dateFrom'] != '') {

            $where['time >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null && $query_rules['dateTo'] != '') {

            $where['time <= '] = $query_rules['dateTo'];

        }

        if($query_rules['success'] != 1) {

            $where['success'] = $query_rules['success'];

        }

        $this->db->select('*')
            ->from('synergy_log');

        if(!empty($where)) {

            $this->db->where($where);
            
        }

        if(!empty($query_rules['events'])) {

            $this->db->where_in('event', $query_rules['events']);

        }


        if(isset($params) && !empty($params)) {

            $this->db->limit($params['limit'], $params['offset']);

        }
        
        $this->db->order_by('time', 'desc');

        $query = $this->db->get();

        $results = $query->result_array();

        $r = array();
        return $r;

    }
        
    /*
     * function to add new synergy_log
     */
    function add_synergy_log($params)
    {
        $this->db->insert('synergy_log',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update synergy_log
     */
    function update_synergy_log($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('synergy_log',$params);
    }
    
    /*
     * function to delete synergy_log
     */
    function delete_synergy_log($id)
    {
        return $this->db->delete('synergy_log',array('id'=>$id));
    }
}
