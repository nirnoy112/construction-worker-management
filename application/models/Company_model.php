<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get company by id
     */
    function get_company($id)
    {
        return $this->db->get_where('companies',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all companies count
     */
    function get_all_companies_count($query_rules)
    {
        $where = array();

        if($query_rules['cName'] != null && $query_rules['cName'] != '') {

            $where['companyName like '] = '%' . $query_rules['cName'] . '%';

        }

        if($query_rules['pContact'] != null && $query_rules['pContact'] != '') {

            $where['primaryContact like '] = '%' . $query_rules['pContact'] . '%';

        }

        if($query_rules['city'] != null && $query_rules['city'] != '') {

            $where['city like '] = '%' . $query_rules['city'] . '%';

        }

        if(!empty($where)) {
            $this->db->where($where);
        }

        $count = $this->db->count_all_results('companies');

        return $count;
    }
     /*
     * Get all companies
     */
    function get_all_subcontructors()
    {
        //$this->db->order_by('id', 'desc');
        $this->db->order_by('companyName', 'asc');

        return $this->db->get_where('companies', array('typeId'=>1))->result_array();
    }
    
    /*
     * Get companies by name
     */
    function get_companies_by_name($name)
    {
        return $this->db->get_where('companies', array('companyName like' => '%' . $name . '%'))->result_array();
    }
    
    /*
     * Get subcontractors by name
     */
    function get_subcontractors_by_name($name)
    {
        return $this->db->get_where('companies', array('typeId' => 1, 'companyName like' => '%' . $name . '%'))->result_array();
    } 

    /*
     * Get all companies
     */
    function get_all_companies($params = array())
    {
        //$this->db->order_by('id', 'desc');
        $this->db->order_by('companyName', 'asc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('companies')->result_array();
    }
    /*
     * Get filtered companies
     */
    function get_filtered_companies($query_rules, $params)
    {
        $where = array();

        if($query_rules['cName'] != null && $query_rules['cName'] != '') {

            $where['companyName like '] = '%' . $query_rules['cName'] . '%';

        }

        if($query_rules['pContact'] != null && $query_rules['pContact'] != '') {

            $where['primaryContact like '] = '%' . $query_rules['pContact'] . '%';

        }

        if($query_rules['city'] != null && $query_rules['city'] != '') {

            $where['city like '] = '%' . $query_rules['city'] . '%';

        }

        $this->db->select('*')
                 ->from('companies');

        if(!empty($where)) {
            $this->db->where($where);
        }

        //$this->db->order_by('id', 'desc');
        $this->db->order_by('companyName', 'asc');

        if(isset($params) && !empty($params))

        {
            $this->db->limit($params['limit'], $params['offset']);
        }

        $query = $this->db->get();

        $results = $query->result_array();

        return $results;
    }
        
    /*
     * function to add new company
     */
    function add_company($params)
    {
        $this->db->insert('companies',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update company
     */
    function update_company($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('companies',$params);
    }
    
    /*
     * function to delete company
     */
    function delete_company($id)
    {
        return $this->db->delete('companies',array('id'=>$id));
    }
}
