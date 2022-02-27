<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Non_ohs_drug_screening_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get non_ohs_drug_screening by id
     */
    function get_non_ohs_drug_screening($id)
    {
        return $this->db->get_where('non_ohs_drug_screenings',array('id'=>$id))->row_array();
    }

    /*
     * Get workers non_ohs_drug_screenings by workers id
     */
    function get_worker_non_ohs_drug_screenings($id)
    {
        return $this->db->get_where('non_ohs_drug_screenings',array('workerId'=>$id))->result_array();
    }
        
    /*
     * Get all non_ohs_drug_screenings
     */
    function get_all_non_ohs_drug_screenings()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('non_ohs_drug_screenings')->result_array();
    }
        
    /*
     * function to add new non_ohs_drug_screening
     */
    function add_non_ohs_drug_screening($params)
    {
        $this->db->insert('non_ohs_drug_screenings',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update non_ohs_drug_screening
     */
    function update_non_ohs_drug_screening($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('non_ohs_drug_screenings',$params);
    }
    
    /*
     * function to delete non_ohs_drug_screening
     */
    function delete_non_ohs_drug_screening($id)
    {
        return $this->db->delete('non_ohs_drug_screenings',array('id'=>$id));
    }
}
