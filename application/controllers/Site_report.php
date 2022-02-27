<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_report extends NDP_Controller {

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

            if(isset($_POST['create_ds_report'])) {

                $dss = null;

                //var_dump($this->input->post('selectionOption')); die();

                if($this->input->post('selectionOption') == 'PARTIAL') {

                    $options = $this->input->post('dsr');

                    $siteOpts = $this->input->post('siteOpts');

                    $siteIds = array();

                    if($siteOpts != null) {

                        foreach ($siteOpts as $id) {
                            
                            array_push($siteIds, $id);

                        }

                    }

                    $options['siteIds'] = $siteIds;

                    if($options['dateFrom'] && $options['dateTo']) {

                        $dfs = $options['dateFrom'] . ' 00:00:00';
                        $dts = $options['dateTo'] . ' 23:59:59';

                        $df = DateTime::createFromFormat('m-d-Y H:i:s', $dfs);
                        $dt = DateTime::createFromFormat('m-d-Y H:i:s', $dts);

                        $options['dateFrom'] = strtotime($df->format('Y-m-d H:i:s'));
                        $options['dateTo'] = strtotime($dt->format('Y-m-d H:i:s'));

                    }

                    $params['limit'] = 10000; 
                    $params['offset'] = 0;

                    $dss = $this->Drug_screening_model->get_filtered_drug_screenings($options, $params);

                    //var_dump($dss); var_dump($options); die();

                } else {

                    $options = array(
                        'dateFrom' => '',
                        'dateTo' => '',
                        'siteIds' => array()
                    );

                    $params = array();

                    $dss = $this->Drug_screening_model->get_filtered_drug_screenings($options, $params);

                }

                //var_dump($dss);die();

                $this->load->library("excel");

                $object = new PHPExcel();

                $object->setActiveSheetIndex(0);

                $table_columns = array("Date Of Collection", "Last Name", "First Name", "Company", "Contractor", "Site", 'Date Of Test', 'Test Result', 'Refusal Of Test', 'ID Card #', 'Notes', 'Collector', 'Reason');

                $column = 0;

                foreach($table_columns as $field) {

                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                    $column++;

                }

                $excel_row = 2;

                foreach($dss as $row)
                {

                    /*$row['companyName'] = '';
                    $row['contractorName'] = '';

                    $company = $this->Company_model->get_company( (int) $row['contractorId']);

                    $contractor = $this->Company_model->get_company( (int) $row['subcontractorId']);

                    $row['companyName'] = $contractor['companyName'];
                    $row['contractorName'] = $contractor['companyName'];*/

                    if($row['company'] == null) {
                        
                        $company = $this->Company_model->get_company( (int) $row['contractorId']);

                        $row['company'] = $company['companyName'];

                    }

                    if($row['employer'] == null) {

                        $contractor = $this->Company_model->get_company( (int) $row['subcontractorId']);

                        $row['employer'] = $contractor['companyName'];

                    }

                    if($row['company'] == '' || $row['company'] == null) {

                        $row['company'] = $row['otherCompanyName'];

                    }

                    if($row['employer'] == '' || $row['employer'] == null) {

                        $row['employer'] = $row['otherCompanyName'];

                    }


                    /*if($row['companies']) {

                        $comArr = explode('/', $row['companies']);

                        $comId = (int) $comArr[0];

                        $com = $this->Company_model->get_company($comId);

                        $row['comName'] = $com['companyName'];

                    }*/

                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['collectionDate']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['lastName']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['firstName']);
                    /*$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['companyName']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['contractorName']);*/
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['company']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['employer']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['collectionSite']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['date']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['testResult']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['refusalOfTest']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['donorId']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, '');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row['collector']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row['reason']);
                    $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="DrugScreeningsReport.xls"');
                $object_writer->save('php://output');

            }

            $data['dsr'] = array(

                'dateFrom' => '',
                'dateTo' => '',
                'siteIds' => null

            );
            
            $data['_view'] = 'report/site-report';
            $this->load->view('layouts/main',$data);

        } else {

            $data['dsr'] = array(

                'dateFrom' => '',
                'dateTo' => '',
                'siteIds' => null

            );
            
            $data['_view'] = 'report/site-report';
            $this->load->view('layouts/main',$data);

        }
        

    }

    
}
