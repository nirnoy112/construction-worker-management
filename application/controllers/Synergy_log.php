<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Synergy_log extends NDP_Controller {

    function __construct() {

        parent::__construct();

        $this->loadAppData(true);

        $this->load->model('Time_clock_model');
        $this->load->model('Worker_model');
        $this->load->model('User_status_model');
        $this->load->model('Company_model');
        $this->load->model('Certification_model');
        $this->load->model('Site_model');
        $this->load->model('User_model');
        $this->load->model('EST_model');
        $this->load->model('Certification_model');
        $this->load->model('Respirator_clearance_model');
        $this->load->model('Report_model');
        $this->load->model('Drug_screening_model');
        $this->load->model('Non_ohs_drug_screening_model');
        
        $this->load->model('Medical_supply_model');
        
        $this->load->model('First_aid_model');
        
        $this->load->model('Vaccination_model');
        
        $this->load->model('Incident_model');
        
        $this->load->model('Synergy_log_model');

    }

    /*
     * Index for Synergy Log
     */
    public function index()
    {

        $data['user_session'] = $this->data;
        $data['staff'] = $this->User_model->get_all_staff();
        
        $data['all_companies'] = $this->Company_model->get_all_companies();
        $data['all_sites'] = $this->Site_model->get_all_sites();
        
        $query_rules = $this->data['sl_rules'];
        $data['slRules'] = $query_rules;

        if(isset($_POST['run_sl_filter'])) {

            $sl_rules = $this->input->post('slRules');

            if(isset($_POST['workerRegister'])) {

                $sl_rules['workerRegister'] = 1;

            } else {

                $sl_rules['workerRegister'] = 0;

            }

            if(isset($_POST['workerUpdate'])) {

                $sl_rules['workerUpdate'] = 1;
                
            } else {

                $sl_rules['workerUpdate'] = 0;

            }

            if(isset($_POST['subcontractorRegister'])) {

                $sl_rules['subcontractorRegister'] = 1;
                
            } else {

                $sl_rules['subcontractorRegister'] = 0;

            }

            if(isset($_POST['subcontractorUpdate'])) {

                $sl_rules['subcontractorUpdate'] = 1;
                
            } else {

                $sl_rules['subcontractorUpdate'] = 0;

            }

            $this->updateUserSession('sl_rules', $sl_rules);
            redirect('synergy_log/index');

        }

        if($query_rules['dateFrom'] && $query_rules['dateTo']) {

            $dfs = $query_rules['dateFrom'] . ' 00:00:00';
            $dts = $query_rules['dateTo'] . ' 23:59:59';

            $df = DateTime::createFromFormat('m-d-Y H:i:s', $dfs);
            $dt = DateTime::createFromFormat('m-d-Y H:i:s', $dts);

            $query_rules['dateFrom'] = strtotime($df->format('Y-m-d H:i:s'));
            $query_rules['dateTo'] = strtotime($dt->format('Y-m-d H:i:s'));

        }

        $events = array();

        if($query_rules['workerRegister'] == 1) {

            array_push($events, '20180330-02 [Register Worker]');

        }

        if($query_rules['workerUpdate'] == 1) {

            array_push($events, '20180330-04 [Update Worker]');
            
        }

        if($query_rules['subcontractorRegister'] == 1) {

            array_push($events, '20180330-01-Add SubContractor');
            
        }

        if($query_rules['subcontractorUpdate'] == 1) {

            array_push($events, '20180330-03-Edit SubContractor');
            
        }

        $query_rules['events'] = $events;

        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('synergy_log/index?');
        
        $config['total_rows'] = $this->Synergy_log_model->get_sl_count($query_rules);

        $this->pagination->initialize($config);

        $data['sl_records'] = $this->Synergy_log_model->get_sl_records($query_rules, $params);
        
        $data['_view'] = 'synergy_log/index';

        //var_dump($config['total_rows']);die();

        $this->load->view('layouts/main', $data);

        if(isset($_POST['export_log'])) {

            $sls = $this->Synergy_log_model->get_sl_records($query_rules, array());

            $this->load->library("excel");



                $object = new PHPExcel();

                $object->setActiveSheetIndex(0);

                $table_columns = array("Sending Time", "Sent By", "Event", "Requested JSON", "Response JSON", "Status", "Error Message");

                $column = 0;

                foreach($table_columns as $field) {

                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                    $column++;

                }

                $excel_row = 2;

                foreach($sls as $row)
                {


                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, date('m-d-Y h:i:s A', $row['time']));
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['performedBy']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['event']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['reqData']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['resData']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, ($row['success'] == 0) ? 'SUCCESSFUL' : 'FAILED');
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['errMsg']);

                    $excel_row++;
                }

                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="SynergyEventsLog.xls"');
                $object_writer->save('php://output');


        } else {

        

        }


            

    }

    /*
     * export Synergy Log
     */
    public function exportSynergyLog() {

    }
    
}
