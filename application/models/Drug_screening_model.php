<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Drug_screening_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get drug_screening by id
     */
    function get_drug_screening($id)
    {
        return $this->db->get_where('drug_screenings',array('id'=>$id))->row_array();
    }

    /*
     * Get workers drug_screenings by workers id
     */
    function get_worker_drug_screenings($id)
    {
        return $this->db->get_where('drug_screenings',array('workerId'=>$id))->result_array();
    }

    /*
     * Get sites drug_screenings by sites id
     */
    function get_site_drug_screenings($id)
    {
        return $this->db->get_where('drug_screenings',array('workerId'=>$id))->result_array();
    }
        
    /*
     * Get all drug_screenings
     */
    function get_all_drug_screenings()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('drug_screenings')->result_array();
    }
        
    /*
     * function to add new drug_screening
     */
    function add_drug_screening($params)
    {
        $this->db->insert('drug_screenings',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update drug_screening
     */
    function update_drug_screening($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('drug_screenings',$params);
    }
    
    /*
     * function to delete drug_screening
     */
    function delete_drug_screening($id)
    {
        return $this->db->delete('drug_screenings',array('id'=>$id));
    }
    /*
     * Get filtered drug_screenings count
     */
    function get_filtered_drug_screenings_count($query_rules)
    {
        $where = array();

        if($query_rules['dateFrom'] != null || $query_rules['dateFrom'] != '') {

            $where['creatingTime >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null || $query_rules['dateTo'] != '') {

            $where['creatingTime <= '] = $query_rules['dateTo'];

        }

        $this->db->select('ds.*, w.firstName, w.lastName')
                 ->from('drug_screenings ds');

        $this->db->join('workers w', 'ds.workerId = w.id');

        /*$this->db->join('sites s', 'ds.siteId = s.id');

        $this->db->join('companies c', 'ds.subcontractorId = c.id');*/

        if(!empty($where)) {
            $this->db->where($where);
        }

        if(!empty($query_rules['siteIds'])) {
            $this->db->where_in('ds.siteId', $query_rules['siteIds']);
        }

        $count = $this->db->count_all_results('drug_screenings');

        return $count;
    }

    /*
     * Get filtered drug_screenings
     */
    function get_filtered_drug_screenings($query_rules, $params)
    {
        $where = array();

        if($query_rules['dateFrom'] != null || $query_rules['dateFrom'] != '') {

            $where['ds.creatingTime >= '] = $query_rules['dateFrom'];

        }

        if($query_rules['dateTo'] != null || $query_rules['dateTo'] != '') {

            $where['ds.creatingTime <= '] = $query_rules['dateTo'];

        }

        $this->db->select('ds.*, w.firstName, w.lastName, w.otherCompanyName')
                 ->from('drug_screenings ds');

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
     * Get filtered drug_screenings count
     */
    function drug_screenings_count($query_rules)
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

        $count = $this->db->count_all_results('drug_screenings');

        return $count;
    }

    /*
     * Get filtered drug_screenings
     */
    function drug_screenings($query_rules, $params)
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
                 ->from('drug_screenings ds');

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
