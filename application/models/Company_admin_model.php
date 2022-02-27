<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get company_admin by id
     */
    function get_company_admin($id)
    {
        $company_admin = $this->db->query("
            SELECT
                *

            FROM
                `company_admins`

            WHERE
                `id` = ?
        ",array($id))->row_array();

        return $company_admin;
    }
    
    /*
     * Get all company_admins count
     */
    function get_all_company_admins_count()
    {
        $company_admins = $this->db->query("
            SELECT
                count(*) as count

            FROM
                `company_admins`
        ")->row_array();

        return $company_admins['count'];
    }
        
    /*
     * Get all company_admins
     */
    function get_all_company_admins($params = array())
    {
        $limit_condition = "";
        if(isset($params) && !empty($params))
            $limit_condition = " LIMIT " . $params['offset'] . "," . $params['limit'];
        
        $company_admins = $this->db->query("
            SELECT
                *

            FROM
                `company_admins`

            WHERE
                1 = 1

            ORDER BY `id` ASC

            " . $limit_condition . "
        ")->result_array();

        return $company_admins;
    }
        
    /*
     * function to add new company_admin
     */
    function add_company_admin($params)
    {
        $this->db->insert('company_admins',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update company_admin
     */
    function update_company_admin($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('company_admins',$params);
    }
    
    /*
     * function to delete company_admin
     */
    function delete_company_admin($id)
    {
        return $this->db->delete('company_admins',array('id'=>$id));
    }
}
