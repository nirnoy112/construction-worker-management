<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');
 
class Worker_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get worker by id
     */
    function get_worker($id)
    {
        return $this->db->get_where('workers',array('id'=>$id))->row_array();
    }
    
    /*
     * Check if a worker's already in existence
     */
    function check_for_existing_worker($firstName, $lastName, $dob)
    {
        return $this->db->get_where('workers',array('firstName'=>$firstName, 'lastName' => $lastName, 'dob' => $dob))->row_array();
    }
    
    /*
     * Get all workers count
     */
    function get_all_workers_count()
    {
        $this->db->from('workers');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all workers
     */
    function get_all_workers($params = array())
    {
        $this->db->order_by('id', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('workers')->result_array();
    }
        
    /*
     * function to add new worker
     */
    function add_worker($params)
    {
        $this->db->insert('workers',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update worker
     */
    function update_worker($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('workers',$params);
    }

    /*
     * Get all workers count
     */
    function get_filtered_workers_count($query_rules)
    {

        $where = array();

        if($query_rules['fName'] != null && $query_rules['fName'] != '') {

            $where['firstName like '] = '%' . $query_rules['fName'] . '%';

        }

        if($query_rules['lName'] != null && $query_rules['lName'] != '') {

            $where['lastName like '] = '%' . $query_rules['lName'] . '%';

        }

        if($query_rules['uid'] != null && $query_rules['uid'] != '') {

            $where['uid like '] = '%' . $query_rules['uid'] . '%';

        }

        if($query_rules['jobTitle'] != 'ALL' && $query_rules['jobTitle'] != '') {

            $where['jobTitle like '] = '%' . $query_rules['jobTitle'] . '%';

        }

        if($query_rules['city'] != null && $query_rules['city'] != '') {

            $where['city like '] = '%' . $query_rules['city'] . '%';

        }

        if($query_rules['dob'] != null && $query_rules['dob'] != '') {

            $where['dob'] = $query_rules['dob'];

        }

        if($query_rules['comId'] != 0 && $query_rules['comId'] != '0') {

            $where['companyId'] = $query_rules['comId'];

        }

        if(!empty($where)) {
            $this->db->where($where);
        }

        if(!empty($query_rules['companyIds'])) {
            $this->db->where_in('companyId', $query_rules['companyIds']);
        }

        if(!empty($query_rules['siteIds'])) {
            $this->db->where_in('siteIdW', $query_rules['siteIds']);
        }


        $count = $this->db->count_all_results('workers');

        return $count;
    }
        
    /*
     * Get all workers
     */
    function get_filtered_workers($query_rules, $params)
    {
        $where = array();

        if($query_rules['fName'] != null && $query_rules['fName'] != '') {

            $where['firstName like '] = '%' . $query_rules['fName'] . '%';

        }

        if($query_rules['lName'] != null && $query_rules['lName'] != '') {

            $where['lastName like '] = '%' . $query_rules['lName'] . '%';

        }

        if($query_rules['uid'] != null && $query_rules['uid'] != '') {

            $where['uid like '] = '%' . $query_rules['uid'] . '%';

        }

        if($query_rules['jobTitle'] != 'ALL' && $query_rules['jobTitle'] != '') {

            $where['jobTitle like '] = '%' . $query_rules['jobTitle'] . '%';

        }

        if($query_rules['city'] != null && $query_rules['city'] != '') {

            $where['city like '] = '%' . $query_rules['city'] . '%';

        }

        if($query_rules['dob'] != null && $query_rules['dob'] != '') {

            $where['dob'] = $query_rules['dob'];

        }

        if($query_rules['comId'] != 0 && $query_rules['comId'] != '0') {

            $where['companyId'] = $query_rules['comId'];

        }

        $this->db->select('*')
                 ->from('workers');

        if(!empty($where)) {
            $this->db->where($where);
        }

        if(!empty($query_rules['companyIds'])) {
            $this->db->where_in('companyId', $query_rules['companyIds']);
        }

        if(!empty($query_rules['siteIds'])) {
            $this->db->where_in('siteIdW', $query_rules['siteIds']);

        }

        $this->db->order_by('id', 'desc');
        //$this->db->order_by('siteIdW', 'desc');

        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }

        //$this->db->group_by('siteIdW');

        $query = $this->db->get();

        $results = $query->result_array();

        /*if(count($results) > 0 && $query_rules['comId'] != 0 && $query_rules['comId'] != '0') {

            $workers = array();

            foreach ($results as $r) {
                
            }

            return $workers;

        } else {

            return $results;

        }*/


        return $results;
    }
        
    /*
     * Get ageing report workers
     */
    function get_ageing_report_workers($query_rules, $params)
    {
        $where = array();

        if($query_rules['fName'] != null && $query_rules['fName'] != '') {

            $where['firstName like '] = '%' . $query_rules['fName'] . '%';

        }

        if($query_rules['lName'] != null && $query_rules['lName'] != '') {

            $where['lastName like '] = '%' . $query_rules['lName'] . '%';

        }

        if($query_rules['uid'] != null && $query_rules['uid'] != '') {

            $where['uid like '] = '%' . $query_rules['uid'] . '%';

        }

        if($query_rules['jobTitle'] != 'ALL' && $query_rules['jobTitle'] != '') {

            $where['jobTitle like '] = '%' . $query_rules['jobTitle'] . '%';

        }

        if($query_rules['city'] != null && $query_rules['city'] != '') {

            $where['city like '] = '%' . $query_rules['city'] . '%';

        }

        if($query_rules['dob'] != null && $query_rules['dob'] != '') {

            $where['dob'] = $query_rules['dob'];

        }

        if($query_rules['comId'] != 0 && $query_rules['comId'] != '0') {

            $where['companyId'] = $query_rules['comId'];

        }

        $this->db->select('*')
                 ->from('workers');

        if(!empty($where)) {
            $this->db->where($where);
        }

        if(!empty($query_rules['companyIds'])) {
            $this->db->where_in('companyId', $query_rules['companyIds']);
        }

        if(!empty($query_rules['siteIds'])) {
            $this->db->where_in('siteIdW', $query_rules['siteIds']);

        }

        $this->db->order_by('siteIdW', 'desc');

        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }


        $query = $this->db->get();

        $results = $query->result_array();


        return $results;
    }
    
    /*
     * function to delete worker
     */
    function delete_worker($id)
    {
        return $this->db->delete('workers',array('id'=>$id));
    }
}
