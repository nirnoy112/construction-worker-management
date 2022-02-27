<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Alcohol_test_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get alcohol_test by id
     */
    function get_alcohol_test($id)
    {
        return $this->db->get_where('alcohol_tests',array('id'=>$id))->row_array();
    }

    /*
     * Get workers alcohol_tests by workers id
     */
    function get_worker_alcohol_tests($id)
    {
        return $this->db->get_where('alcohol_tests',array('workerId'=>$id))->result_array();
    }

    /*
     * Get sites alcohol_tests by sites id
     */
    function get_site_alcohol_tests($id)
    {
        return $this->db->get_where('alcohol_tests',array('workerId'=>$id))->result_array();
    }
        
    /*
     * Get all alcohol_tests
     */
    function get_all_alcohol_tests()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('alcohol_tests')->result_array();
    }
        
    /*
     * function to add new alcohol_test
     */
    function add_alcohol_test($params)
    {
        $this->db->insert('alcohol_tests',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update alcohol_test
     */
    function update_alcohol_test($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('alcohol_tests',$params);
    }
    
    /*
     * function to delete alcohol_test
     */
    function delete_alcohol_test($id)
    {
        return $this->db->delete('alcohol_tests',array('id'=>$id));
    }
    /*
     * Get filtered alcohol_tests count
     */
    function get_filtered_alcohol_tests_count($query_rules)
    {
        $where = array();

        if($query_rules['dateFrom'] != null || $query_rules['dateFrom'] != '') {

            $where['creatingTime >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null || $query_rules['dateTo'] != '') {

            $where['creatingTime <= '] = $query_rules['dateTo'];

        }

        $this->db->select('ds.*, w.firstName, w.lastName')
                 ->from('alcohol_tests ds');

        $this->db->join('workers w', 'ds.workerId = w.id');

        /*$this->db->join('sites s', 'ds.siteId = s.id');

        $this->db->join('companies c', 'ds.subcontractorId = c.id');*/

        if(!empty($where)) {
            $this->db->where($where);
        }

        if(!empty($query_rules['siteIds'])) {
            $this->db->where_in('ds.siteId', $query_rules['siteIds']);
        }

        $count = $this->db->count_all_results('alcohol_tests');

        return $count;
    }

    /*
     * Get filtered alcohol_tests
     */
    function get_filtered_alcohol_tests($query_rules, $params)
    {
        $where = array();

        if($query_rules['dateFrom'] != null || $query_rules['dateFrom'] != '') {

            $where['ds.creatingTime >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null || $query_rules['dateTo'] != '') {

            $where['ds.creatingTime <= '] = $query_rules['dateTo'];

        }

        $this->db->select('ds.*, w.firstName, w.lastName, w.otherCompanyName')
                 ->from('alcohol_tests ds');

        $this->db->join('workers w', 'ds.workerId = w.id');

        /*$this->db->join('sites s', 'ds.siteId = s.id');*/

        //$this->db->join('companies c', 'ds.contractorId = c.id');

        if(!empty($where)) {
            $this->db->where($where);
        }

        if(!empty($query_rules['siteIds'])) {

            $this->db->where_in('ds.siteId', $query_rules['siteIds']);
            //$this->db->where_in('w.siteIdW', $query_rules['siteIds']);

        }

        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }

        $query = $this->db->get();

        $results = $query->result_array();

        return $results;
    }
    /*
     * Get filtered alcohol_tests count
     */
    function alcohol_tests_count($query_rules)
    {
        $where = array();

        if($query_rules['dateFrom'] != null && $query_rules['dateFrom'] != '') {

            $where['creatingTime >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null && $query_rules['dateTo'] != '') {

            $where['creatingTime <= '] = $query_rules['dateTo'];

        }

        if($query_rules['testResult'] != null && $query_rules['testResult'] != 'ALL') {

                $where['testResult'] = $query_rules['testResult'];

        }

        if(!empty($where)) {
            $this->db->where($where);
        }

        $count = $this->db->count_all_results('alcohol_tests');

        return $count;
    }

    /*
     * Get filtered alcohol_tests
     */
    function alcohol_tests($query_rules, $params)
    {
        $where = array();

        if($query_rules['dateFrom'] != null && $query_rules['dateFrom'] != '') {

            $where['creatingTime >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null && $query_rules['dateTo'] != '') {

            $where['creatingTime <= '] = $query_rules['dateTo'];

        }

        if($query_rules['testResult'] != null && $query_rules['testResult'] != 'ALL') {

                $where['testResult'] = $query_rules['testResult'];

        }

        $this->db->select('ds.*, w.firstName, w.lastName, w.otherCompanyName')
                 ->from('alcohol_tests ds');

        $this->db->join('workers w', 'ds.workerId = w.id');

        /*$this->db->join('sites s', 'ds.siteId = s.id');

        $this->db->join('companies c', 'ds.contractorId = c.id');*/

        if(!empty($where)) {
            $this->db->where($where);
        }

        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }

        $query = $this->db->get();

        $results = $query->result_array();

        return $results;
    }

}
