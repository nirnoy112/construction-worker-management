<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(false);

        $this->load->library('zend');
        $this->load->library('ciqrcode');
    } 

    /*
     * Generating barcode
     */
    function getBarcode($text)
    {

    	$this->zend->load('Zend/Barcode');

        $rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');
        Zend_Barcode::render('code128', 'image', array('text'=>$text), $rendererOptions);

    }


     /*
     * Generating QR code
     */
    function getQRcode($data)
    {

        header("Content-Type: image/png");
        $params['data'] = $data;
        $this->ciqrcode->generate($params);

    }

}
