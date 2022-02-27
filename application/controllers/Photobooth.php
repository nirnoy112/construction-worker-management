<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Photobooth extends NDP_Controller {

    function __construct()
    {
        parent::__construct();

        $this->loadAppData(false);

    } 

    /*
     * Index
     */
    function index()
    {
        
        $this->load->view('layouts/photobooth');

    }

    
}
