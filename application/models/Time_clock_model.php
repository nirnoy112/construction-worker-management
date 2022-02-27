<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Time_clock_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get time_clock by id
     */
    function get_time_clock($id)
    {
        return $this->db->get_where('time_clock',array('id'=>$id))->row_array();
    }

    /*
     * Get workers time_clock by user id
     */
    function get_staff_time_clock($id)
    {
        return $this->db->get_where('time_clock',array('userId'=>$id))->result_array();
    }

    /*
     * Count all time_clock
     */
    function count_all_time_clock()
    {
        $count = $this->db->count_all_results('time_clock');

        return $count;
    }
        
    /*
     * Get all time_clock
     */
    function get_all_time_clock()
    {
        $this->db->order_by('time', 'desc');
        return $this->db->get('time_clock')->result_array();
    }

    /*
     * Get all time_clock records count
     */
    function get_tc_count($query_rules) {

        $where = array();

        if($query_rules['user_id'] > 0) {

                $where['userId'] = $query_rules['user_id'];

        }

        if($query_rules['activity'] != 'ALL') {

            $where['activity'] = $query_rules['activity'];

        }

        if($query_rules['dateFrom'] != null && $query_rules['dateFrom'] != '') {

            $where['time >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null && $query_rules['dateTo'] != '') {

            $where['time <= '] = $query_rules['dateTo'];

        }

        $where['siteId > '] = 0;
        $where['companyId > '] = 0;

        if(!empty($where)) {
            $this->db->where($where);
        }

        $count = $this->db->count_all_results('time_clock');

        return $count;

    }

    /*
     * Get all time_clock records
     */
    function get_tc_records($query_rules, $params) {

        $where = array();

        if($query_rules['user_id'] > 0) {

                $where['userId'] = $query_rules['user_id'];

        }
        
        if($query_rules['activity'] != 'ALL') {

                $where['activity'] = $query_rules['activity'];

        }

        if($query_rules['dateFrom'] != null && $query_rules['dateFrom'] != '') {

            $where['time >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null && $query_rules['dateTo'] != '') {

            $where['time <= '] = $query_rules['dateTo'];

        }

        $where['siteId > '] = 0;
        $where['companyId > '] = 0;

        $this->db->select('time_clock.*, users.username, users.fullName, users.drugTestCollector, sites.startTime, sites.endTime, sites.siteName, companies.companyName')
                 ->from('time_clock')
                 ->join('users', 'users.id = time_clock.userId')
                 ->join('sites', 'sites.id = time_clock.siteId')
                 ->join('companies', 'companies.id = time_clock.companyId');

        if(!empty($where)) {
            $this->db->where($where);
        }
        if(isset($params) && !empty($params)) {
            $this->db->limit($params['limit'], $params['offset']);
        }
        
        $this->db->order_by($query_rules['sortBy'], $query_rules['sortingOrder']);

        $query = $this->db->get();

        $results = $query->result_array();

        return $results;

    }
        
    /*
     * function to add new time_clock
     */
    function add_time_clock($params)
    {
        $this->db->insert('time_clock',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update time_clock
     */
    function update_time_clock($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('time_clock',$params);
    }
    
    /*
     * function to delete time_clock
     */
    function delete_time_clock($id)
    {
        return $this->db->delete('time_clock',array('id'=>$id));
    }
}
