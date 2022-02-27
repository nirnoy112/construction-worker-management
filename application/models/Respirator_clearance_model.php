<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Respirator_clearance_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get respirator clearance by id
     */
    function get_respirator_clearance($id)
    {
        $respirator_clearance = $this->db->query("
            SELECT
                *

            FROM
                `respirator_clearances`

            WHERE
                `id` = ?
        ",array($id))->row_array();

        return $respirator_clearance;
    }
        
    /*
     * Get all respirator clearances
     */
    function get_all_respirator_clearances()
    {
        $respirator_clearances = $this->db->query("
            SELECT
                *

            FROM
                `respirator_clearances`

            WHERE
                1 = 1

            ORDER BY `id` ASC
        ")->result_array();

        return $respirator_clearances;
    }
        
    /*
     * function to add new respirator clearance
     */
    function add_respirator_clearance($params)
    {
        $this->db->insert('respirator_clearances',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update respirator clearance
     */
    function update_respirator_clearance($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('respirator_clearances',$params);
    }
    
    /*
     * function to delete respirator clearance
     */
    function delete_respirator_clearance($id)
    {
        return $this->db->delete('respirator_clearances',array('id'=>$id));
    }

    /*
     * Get workers respirator clearances by workers id
     */
    function get_worker_respirator_clearances($id)
    {
        return $this->db->get_where('respirator_clearances',array('worker_id'=>$id))->result_array();
    }
}
