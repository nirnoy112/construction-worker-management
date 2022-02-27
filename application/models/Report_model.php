<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get report by id
     */
    function get_report($id)
    {
        return $this->db->get_where('reports',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all reports count
     */
    function get_all_reports_count($query_rules)
    {

        $count = $this->db->count_all_results('reports');

        return $count;
    }
        
    /*
     * Get all reports
     */
    function get_all_reports($params = array())
    {
        $this->db->order_by('id', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('reports')->result_array();
    }

    /*
     * Get worker reports for employer
     */
    function get_worker_reports_for_employer($id) {

    	return $this->db->get_where('reports',array('workerId'=> $id, 'for' => 'Employer'))->result_array();

    }

    /*
     * Get worker reports for employee
     */
    function get_worker_reports_for_employee($id) {

    	return $this->db->get_where('reports',array('workerId'=> $id, 'for' => 'Employee'))->result_array();

    }
        
    /*
     * function to add new report
     */
    function add_report($params)
    {
        $this->db->insert('reports',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update report
     */
    function update_report($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('reports',$params);
    }
    
    /*
     * function to delete report
     */
    function delete_report($id)
    {
        return $this->db->delete('reports',array('id'=>$id));
    }
}
