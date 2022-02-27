<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get role by id
     */
    function get_role($id)
    {
        $role = $this->db->query("
            SELECT
                *

            FROM
                `roles`

            WHERE
                `id` = ?
        ",array($id))->row_array();

        return $role;
    }
        
    /*
     * Get all roles
     */
    function get_all_roles()
    {
        $roles = $this->db->query("
            SELECT
                *

            FROM
                `roles`

            WHERE
                1 = 1

            ORDER BY `id` ASC
        ")->result_array();

        return $roles;
    }
        
    /*
     * function to add new role
     */
    function add_role($params)
    {
        $this->db->insert('roles',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update role
     */
    function update_role($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('roles',$params);
    }
    
    /*
     * function to delete role
     */
    function delete_role($id)
    {
        return $this->db->delete('roles',array('id'=>$id));
    }
}
