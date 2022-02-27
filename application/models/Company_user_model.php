<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_user_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get company_user by id
     */
    function get_company_user($id)
    {
        $company_user = $this->db->query("
            SELECT
                *

            FROM
                `company_users`

            WHERE
                `id` = ?
        ",array($id))->row_array();

        return $company_user;
    }

    /*
     * Get company_user by user_id
     */
    function get_companies_by_user($id)
    {
        $company_user = $this->db->query("
            SELECT
                *

            FROM
                `company_users`

            WHERE
                `user_id` = ?
        ",array($id))->row_array();

        return $company_user;
        
    }

    /*
     * Get company_user by user_id
     */
    function get_cids_by_user($id)
    {
        $company_user = $this->db->query("
            SELECT
                *

            FROM
                `company_users`

            WHERE
                `user_id` = ?
        ",array($id))->row_array();

        /*if($company_user['company_id']) {

            $cid_str = substr($company_user['company_id'], 1);

            $ids = explode('/', $cid_str);

            return $ids;

        } else {

            return null;
        }*/

        return $company_user['company_id'];
        
    }

    
    /*
     * Get all company_users count
     */
    function get_all_company_users_count()
    {
        $company_users = $this->db->query("
            SELECT
                count(*) as count

            FROM
                `company_users`
        ")->row_array();

        return $company_users['count'];
    }
        
    /*
     * Get all company_users
     */
    function get_all_company_users($params = array())
    {
        $limit_condition = "";
        if(isset($params) && !empty($params))
            $limit_condition = " LIMIT " . $params['offset'] . "," . $params['limit'];
        
        $company_users = $this->db->query("
            SELECT
                *

            FROM
                `company_users`

            WHERE
                1 = 1

            ORDER BY `id` ASC

            " . $limit_condition . "
        ")->result_array();

        return $company_users;
    }
        
    /*
     * function to add new company_user
     */
    function add_company_user($params)
    {
        $this->db->insert('company_users',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update company_user
     */
    function update_company_user($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('company_users',$params);
    }
    
    /*
     * function to update company_user
     */
    function update_user_company($id,$params)
    {
        $this->db->where('user_id',$id);
        return $this->db->update('company_users',$params);
    }
    
    /*
     * function to delete company_user
     */
    function delete_company_user($id)
    {
        return $this->db->delete('company_users',array('id'=>$id));
    }
}
