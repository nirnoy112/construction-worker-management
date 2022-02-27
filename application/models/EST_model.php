<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class EST_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get est by id
     */
    function get_est($id)
    {
        $est = $this->db->query("
            SELECT
                *

            FROM
                `ests`

            WHERE
                `id` = ?
        ",array($id))->row_array();

        return $est;
    }
        
    /*
     * Get all ests
     */
    function get_all_ests()
    {
        $ests = $this->db->query("
            SELECT
                *

            FROM
                `ests`

            WHERE
                1 = 1

            ORDER BY `id` ASC
        ")->result_array();

        return $ests;
    }
        
    /*
     * function to add new est
     */
    function add_est($params)
    {
        $this->db->insert('ests',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update est
     */
    function update_est($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('ests',$params);
    }
    
    /*
     * function to delete est
     */
    function delete_est($id)
    {
        return $this->db->delete('ests',array('id'=>$id));
    }
}
