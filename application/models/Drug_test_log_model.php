<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Drug_test_log_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get drug_test_log by id
     */
    function get_drug_test_log($id)
    {
        return $this->db->get_where('drug_test_log',array('id'=>$id))->row_array();
    }

    /*
     * Get workers drug_test_log by user id
     */
    function get_staff_drug_test_log($id)
    {
        return $this->db->get_where('drug_test_log',array('userId'=>$id))->result_array();
    }

    /*
     * Count all drug_test_log
     */
    function count_all_drug_test_log()
    {
        $count = $this->db->count_all_results('drug_test_log');

        return $count;
    }
        
    /*
     * Get all drug_test_log
     */
    function get_all_drug_test_log()
    {
        $this->db->order_by('date', 'desc');
        return $this->db->get('drug_test_log')->result_array();
    }

    /*
     * Get all drug_test_log records count
     */
    function get_dtc_count($query_rules) {

        $where = array();

        if($query_rules['collectorId'] > 0) {

                $where['collectorId'] = $query_rules['collectorId'];

        }

        if($query_rules['siteId'] > 0) {

                $where['siteId'] = $query_rules['siteId'];

        }

        if($query_rules['companyId'] > 0) {

                $where['companyId'] = $query_rules['companyId'];

        }

        if($query_rules['dateFrom'] != null && $query_rules['dateFrom'] != '') {

            $where['date >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null && $query_rules['dateTo'] != '') {

            $where['date <= '] = $query_rules['dateTo'];

        }

        if(!empty($where)) {
            $this->db->where($where);
        }

        $count = $this->db->count_all_results('drug_test_log');

        return $count;

    }

    /*
     * Get all drug_test_log records count
     */
    function get_dtc_records($query_rules, $params) {

        $where = array();

        if($query_rules['collectorId'] > 0) {

                $where['collectorId'] = $query_rules['collectorId'];

        }

        if($query_rules['siteId'] > 0) {

                $where['siteId'] = $query_rules['siteId'];

        }

        if($query_rules['companyId'] > 0) {

                $where['companyId'] = $query_rules['companyId'];

        }

        if($query_rules['dateFrom'] != null && $query_rules['dateFrom'] != '') {

            $where['date >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null && $query_rules['dateTo'] != '') {

            $where['date <= '] = $query_rules['dateTo'];

        }

        $this->db->select('drug_test_log.*, users.username, users.fullName, sites.siteName, companies.companyName')
                 ->from('drug_test_log')
                 ->join('users', 'users.id = drug_test_log.collectorId')
                 ->join('sites', 'sites.id = drug_test_log.siteId')
                 ->join('companies', 'companies.id = drug_test_log.companyId');

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
     * function to add new drug_test_log
     */
    function add_drug_test_log($params)
    {
        $this->db->insert('drug_test_log',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update drug_test_log
     */
    function update_drug_test_log($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('drug_test_log',$params);
    }
    
    /*
     * function to delete drug_test_log
     */
    function delete_drug_test_log($id)
    {
        return $this->db->delete('drug_test_log',array('id'=>$id));
    }
}
