<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Ageing_report extends NDP_Controller {

    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);

        $this->load->model('Site_model');
        $this->load->model('Company_model');
        $this->load->model('Worker_model');
        $this->load->model('Drug_screening_model');

    } 

    /*
     * Reports for Drug Screenings
     */
    function index()
    {
        $data['user_session'] = $this->data;

        $data['all_sites'] = $this->Site_model->get_all_sites();

        if(isset($_POST) && count($_POST) > 0) {

            if(isset($_POST['create_ageing_report'])) {

                $workers = null;

                $options = array(
                    'uid' => '',
                    'lName' => '',
                    'fName' => '',
                    'jobTitle' => 'ALL',
                    'city' => '',
                    'dob' => '',
                    'comId' => 0,
                    'companyIds' => array(),
                    'companies' => array(),
                    'siteIds' => array()
                );

                if($this->input->post('selectionOption') == 'PARTIAL') {

                    $siteOpts = $this->input->post('siteOpts');

                    $siteIds = array();

                    if($siteOpts != null) {

                        foreach ($siteOpts as $id) {
                            
                            array_push($siteIds, $id);

                        }

                    }

                    $options['siteIds'] = $siteIds;

                    $params['limit'] = 10000; 
                    $params['offset'] = 0;

                    $workers = $this->Worker_model->get_ageing_report_workers($options, $params);

                    /*$siteOpts = $this->input->post('siteOpts');

                    $workers = array();

                    if($siteOpts != null) {

                        foreach ($siteOpts as $id) {
                            
                            $siteIds = array();
                            array_push($siteIds, $id);
                            $options['siteIds'] = $siteIds;

                            $params['limit'] = 10000; 
                            $params['offset'] = 0;

                            $site_workers = $this->Worker_model->get_filtered_workers($options, $params);
                            //var_dump($site_workers);

                            array_push($workers, $site_workers);

                        }

                    }*/

                } else {

                    $params = array();

                    $workers = $this->Worker_model->get_ageing_report_workers($options, $params);

                }

                $this->load->library("excel");

                $object = new PHPExcel();

                $object->setActiveSheetIndex(0);

                $table_columns = array("Site Name", "Worker Name", "Date Of Birth", "Age", "Trade");

                $column = 0;

                foreach($table_columns as $field) {

                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                    $column++;

                }

                $excel_row = 2;
                //var_dump($workers);die();
                foreach($workers as $row)
                {
                    //var_dump($row['firstName']);die();
                    $row['siteName'] = '';

                    if($row['siteIdW'] != null && $row['siteIdW'] != '' && $row['siteIdW'] != 0) {
                        
                        $site = $this->Site_model->get_site( (int) $row['siteIdW']);
                        //var_dump($site);die();

                        $row['siteName'] = $site['siteName'];

                    }

                    if($row['siteName'] == '' || $row['siteName'] == null) {

                        $row['siteName'] = $row['otherSiteName'];

                    }

                    $row['age'] = '';

                    if($row['dob'] != null && $row['dob'] != '') {
                        if(count(explode('-', $row['dob'])) == 3) {
                            $row['age'] = date('Y', time()) - explode('-', $row['dob'])[2];
                        }   
                    }

                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['siteName']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['lastName'] . ' ' . $row['firstName']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['dob']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['age']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['jobTitle']);
                    $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="AgeingReport.xls"');
                $object_writer->save('php://output');

            }
            
            $data['_view'] = 'report/ageing-report';
            $this->load->view('layouts/main',$data);

        } else {
            
            $data['_view'] = 'report/ageing-report';
            $this->load->view('layouts/main',$data);

        }
        

    }

    
}
