<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get site by id
     */
    function get_site($id)
    {
        //return $this->db->get_where('sites',array('id'=>$id))->row_array();

        return $this->db->select('st.*, cm.companyName AS assigningCompanyName')->from('sites st')->join('companies cm', 'st.assignedCompanyId = cm.id')->where('st.id', $id)->get()->row_array();
    }
    
    /*
     * Get sites by name
     */
    function get_sites_by_name($name)
    {
        return $this->db->get_where('sites',array('siteName like'=>'%' . $name . '%'))->result_array();
    }
    
    /*
     * Get all sites count
     */
    function get_all_sites_count($query_rules)
    {
        $where = array();

        if($query_rules['sName'] != null && $query_rules['sName'] != '') {

            $where['siteName like '] = '%' . $query_rules['sName'] . '%';

        }

        if($query_rules['pContact'] != null && $query_rules['pContact'] != '') {

            $where['primaryContact like '] = '%' . $query_rules['pContact'] . '%';

        }

        if($query_rules['city'] != null && $query_rules['city'] != '') {

            $where['city like '] = '%' . $query_rules['city'] . '%';

        }

        if((int)$query_rules['aCompanyId'] > 0) {

            $cId = (int) $query_rules['aCompanyId'];

            $where['assignedCompanyId'] = $cId;

        }

        if(!empty($where)) {
            $this->db->where($where);
        }

        $count = $this->db->count_all_results('sites');

        return $count;
    }
        
    /*
     * Get main sites
     */
    function get_main_sites($params = array())
    {
        $where = array();

        $where['isSubsite'] = 'NO';

        $this->db->select('*')
                 ->from('sites');

        if(!empty($where)) {
            $this->db->where($where);
        }

        //$this->db->order_by('id', 'desc');
        $this->db->order_by('siteName', 'asc');

        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }

        $query = $this->db->get();

        $results = $query->result_array();

        return $results;
    }
        
    /*
     * Get all sites
     */
    function get_all_sites($params = array())
    {
        $this->db->select('st.*, cm.companyName AS assigningCompanyName')->from('sites st')->join('companies cm', 'st.assignedCompanyId = cm.id');

        $this->db->order_by('siteName', 'asc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get()->result_array();
    }

    /*
     * Get filtered sites
     */
    function get_filtered_sites($query_rules, $params)
    {
        $where = array();

        if($query_rules['sName'] != null && $query_rules['sName'] != '') {

            $where['siteName like '] = '%' . $query_rules['sName'] . '%';

        }

        if($query_rules['pContact'] != null && $query_rules['pContact'] != '') {

            $where['primaryContact like '] = '%' . $query_rules['pContact'] . '%';

        }

        if($query_rules['city'] != null && $query_rules['city'] != '') {

            $where['city like '] = '%' . $query_rules['city'] . '%';

        }

        if((int)$query_rules['aCompanyId'] > 0) {

            $cId = (int) $query_rules['aCompanyId'];

            $where['assignedCompanyId'] = $cId;

        }


        $this->db->select('*')
                 ->from('sites');

        if(!empty($where)) {
            $this->db->where($where);
        }

        //$this->db->order_by('id', 'desc');
        
        $this->db->order_by('siteName', 'asc');

        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }

        $query = $this->db->get();

        $results = $query->result_array();

        return $results;
    }
        
    /*
     * function to add new site
     */
    function add_site($params)
    {
        $this->db->insert('sites',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update site
     */
    function update_site($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('sites',$params);
    }
    
    /*
     * function to delete site
     */
    function delete_site($id)
    {
        return $this->db->delete('sites',array('id'=>$id));
    }
}
