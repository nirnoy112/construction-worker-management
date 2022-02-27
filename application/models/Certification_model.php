<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Certification_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get certification by id
     */
    function get_certification($id)
    {
        return $this->db->get_where('certifications',array('id'=>$id))->row_array();
    }

    /*
     * Get workers certifications by workers id
     */
    function get_worker_certifications($id)
    {
        return $this->db->get_where('certifications',array('workerId'=>$id))->result_array();
    }
        
    /*
     * Get all certifications
     */
    function get_all_certifications()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('certifications')->result_array();
    }
        
    /*
     * function to add new certification
     */
    function add_certification($params)
    {
        $this->db->insert('certifications',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update certification
     */
    function update_certification($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('certifications',$params);
    }
    
    /*
     * function to delete certification
     */
    function delete_certification($id)
    {
        return $this->db->delete('certifications',array('id'=>$id));
    }
}
