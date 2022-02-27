<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Non_dot_test_panel_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get non_dot_test_panel by id
     */
    function get_non_dot_test_panel($id)
    {
        $non_dot_test_panel = $this->db->query("
            SELECT
                *

            FROM
                `non_dot_test_panels`

            WHERE
                `id` = ?
        ",array($id))->row_array();

        return $non_dot_test_panel;
    }
        
    /*
     * Get all non_dot_test_panels
     */
    function get_all_non_dot_test_panels()
    {
        $non_dot_test_panels = $this->db->query("
            SELECT
                *

            FROM
                `non_dot_test_panels`

            WHERE
                1 = 1

            ORDER BY `id` ASC
        ")->result_array();

        return $non_dot_test_panels;
    }
        
    /*
     * function to add new non_dot_test_panel
     */
    function add_non_dot_test_panel($params)
    {
        $this->db->insert('non_dot_test_panels',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update non_dot_test_panel
     */
    function update_non_dot_test_panel($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('non_dot_test_panels',$params);
    }
    
    /*
     * function to delete non_dot_test_panel
     */
    function delete_non_dot_test_panel($id)
    {
        return $this->db->delete('non_dot_test_panels',array('id'=>$id));
    }
}
