<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_user_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get site_user by id
     */
    function get_site_user($id)
    {
        $site_user = $this->db->query("
            SELECT
                *

            FROM
                `site_users`

            WHERE
                `id` = ?
        ",array($id))->row_array();

        return $site_user;
    }

    /*
     * Get site_user by user_id
     */
    function get_sites_by_user($id)
    {
        $site_user = $this->db->query("
            SELECT
                *

            FROM
                `site_users`

            WHERE
                `user_id` = ?
        ",array($id))->row_array();

        return $site_user;
        
    }

    /*
     * Get site_user by user_id
     */
    function get_sids_by_user($id)
    {
        $site_user = $this->db->query("
            SELECT
                *

            FROM
                `site_users`

            WHERE
                `user_id` = ?
        ",array($id))->row_array();

        //$sid_str = substr($site_user['site_id'], 1);

        //$ids = explode('/', $sid_str);

        return $site_user['site_id'];
        
    }

    
    /*
     * Get all site_users count
     */
    function get_all_site_users_count()
    {
        $site_users = $this->db->query("
            SELECT
                count(*) as count

            FROM
                `site_users`
        ")->row_array();

        return $site_users['count'];
    }
        
    /*
     * Get all site_users
     */
    function get_all_site_users($params = array())
    {
        $limit_condition = "";
        if(isset($params) && !empty($params))
            $limit_condition = " LIMIT " . $params['offset'] . "," . $params['limit'];
        
        $site_users = $this->db->query("
            SELECT
                *

            FROM
                `site_users`

            WHERE
                1 = 1

            ORDER BY `id` ASC

            " . $limit_condition . "
        ")->result_array();

        return $site_users;
    }
        
    /*
     * function to add new site_user
     */
    function add_site_user($params)
    {
        $this->db->insert('site_users',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update site_user
     */
    function update_site_user($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('site_users',$params);
    }
    
    /*
     * function to update site_user
     */
    function update_user_site($id,$params)
    {
        $this->db->where('user_id',$id);
        return $this->db->update('site_users',$params);
    }
    
    /*
     * function to delete site_user
     */
    function delete_site_user($id)
    {
        return $this->db->delete('site_users',array('id'=>$id));
    }
}
