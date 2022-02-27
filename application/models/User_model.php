<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get user by id
     */
    function get_user($id)
    {
        $user = $this->db->query("
            SELECT
                *

            FROM
                `users`

            WHERE
                `id` = ?
        ",array($id))->row_array();

        return $user;
    }
    
    /*
     * Get user by email
     */
    function get_user_by_email($email)
    {
        $user = $this->db->query("
            SELECT
                *

            FROM
                `users`

            WHERE
                `email` = ?
        ",array($email))->row_array();

        return $user;
    }

    /*
     * Authenticate user
     */
    function authenticate_user($username, $password)
    {

        return $this->db->get_where('users',array('username'=>$username, 'password'=>$password))->row_array();
        
    }
    
    /*
     * Get all users count
     */
    function get_all_users_count()
    {
        $users = $this->db->query("
            SELECT
                count(*) as count

            FROM
                `users`
        ")->row_array();

        return $users['count'];
    }
        
    /*
     * Get all users
     */
    function get_all_users($params = array())
    {
        $limit_condition = "";
        if(isset($params) && !empty($params))
            $limit_condition = " LIMIT " . $params['offset'] . "," . $params['limit'];
        
        $users = $this->db->query("
            SELECT
                *

            FROM
                `users`

            WHERE
                1 = 1

            ORDER BY `id` ASC

            " . $limit_condition . "
        ")->result_array();

        return $users;
    }
    
    /*
     * Get all staff count
     */
    function get_all_staff_count()
    {
        $users = $this->db->query("
            SELECT
                count(*) as count

            FROM
                `users`
            WHERE
                `roleId` = ?
        ",array(2))->row_array();

        return $users['count'];
    }
        
    /*
     * Get all staff
     */
    function get_all_staff($params = array())
    {
        $limit_condition = "";
        if(isset($params) && !empty($params))
            $limit_condition = " LIMIT " . $params['offset'] . "," . $params['limit'];
        
        $users = $this->db->query("
            SELECT
                *

            FROM
                `users`

            WHERE
                `roleId` = ?

            ORDER BY `id` ASC

            " . $limit_condition . "
        ",array(2))->result_array();

        return $users;
    }

    /*
     * Get all drug test collector
     */
    function get_all_drug_test_collectors($params = array())
    {
        $limit_condition = "";
        if(isset($params) && !empty($params))
            $limit_condition = " LIMIT " . $params['offset'] . "," . $params['limit'];
        
        $users = $this->db->query("
            SELECT
                *

            FROM
                `users`

            WHERE
                `roleId` = ? AND `drugTestCollector` = ?

            ORDER BY `id` ASC

            " . $limit_condition . "
        ",array(2, 1))->result_array();

        return $users;
    }
        
    /*
     * function to add new user
     */
    function add_user($params)
    {
        $this->db->insert('users',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update user
     */
    function update_user($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('users',$params);
    }
    
    /*
     * function to delete user
     */
    function delete_user($id)
    {
        return $this->db->delete('users',array('id'=>$id));
    }

    /*
     * Get all company users count
     */
    function get_all_company_users_count()
    {
        $users = $this->db->query("
            SELECT
                count(*) as count

            FROM
                `users`
            WHERE
                `roleId` = ?
        ",array(3))->row_array();

        return $users['count'];
    }
        
    /*
     * Get all company users
     */
    function get_all_company_users($params = array())
    {
        $limit_condition = "";
        if(isset($params) && !empty($params))
            $limit_condition = " LIMIT " . $params['offset'] . "," . $params['limit'];
        
        $users = $this->db->query("
            SELECT
                *

            FROM
                `users`

            WHERE
                `roleId` = ?

            ORDER BY `id` ASC

            " . $limit_condition . "
        ",array(3))->result_array();

        return $users;
    }

    /*
     * Get all users count
     */
    function get_filtered_users_count($query_rules)
    {

        $where = array();

        if($query_rules['fullName'] != null && $query_rules['fullName'] != '') {

            $where['fullName like '] = '%' . $query_rules['fullName'] . '%';

        }

        if($query_rules['username'] != null && $query_rules['username'] != '') {

            $where['username like '] = '%' . $query_rules['username'] . '%';

        }

        if($query_rules['statusId'] != 0 && $query_rules['statusId'] != '0') {

            $where['statusId'] = $query_rules['statusId'];

        }

        if($query_rules['roleId'] != 0 && $query_rules['roleId'] != '0') {

            $where['roleId'] = $query_rules['roleId'];

        }

        if($query_rules['uid'] != null && $query_rules['uid'] != '') {

            $where['uid like '] = '%' . $query_rules['uid'] . '%';

        }

        if(!empty($where)) {
            $this->db->where($where);
        }


        $count = $this->db->count_all_results('users');

        return $count;
    }

    /*
     * Get all users
     */
    function get_filtered_users($query_rules, $params)
    {
        if($query_rules['fullName'] != null && $query_rules['fullName'] != '') {

            $where['fullName like '] = '%' . $query_rules['fullName'] . '%';

        }

        if($query_rules['username'] != null && $query_rules['username'] != '') {

            $where['username like '] = '%' . $query_rules['username'] . '%';

        }

        if($query_rules['statusId'] != 0 && $query_rules['statusId'] != '0') {

            $where['statusId'] = $query_rules['statusId'];

        }

        if($query_rules['roleId'] != 0 && $query_rules['roleId'] != '0') {

            $where['roleId'] = $query_rules['roleId'];

        }

        if($query_rules['uid'] != null && $query_rules['uid'] != '') {

            $where['uid like '] = '%' . $query_rules['uid'] . '%';

        }

        $this->db->select('*')
                 ->from('users');

        if(!empty($where)) {
            $this->db->where($where);
        }

        $this->db->order_by('id', 'desc');

        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }

        $query = $this->db->get();

        $results = $query->result_array();

        return $results;
    }


}
