<?php

	/*****
	*
	* @Author: Nasid Kamal.
	* @Project Keyword: OHS.
	*
	*****/

	defined('BASEPATH') OR exit('No direct script access allowed');

	class DevTools extends NDP_Controller {

		public function __construct() {

			parent::__construct();

			$this->loadAppData(false);

			$this->load->model('Company_model');

			$this->load->model('Worker_model');

            $this->load->model('Drug_screening_model');

			$this->load->model('Site_model');

			$this->load->model('User_model');
        
        	$this->load->model('Synergy_log_model');
        
            $this->load->model('Synergy_log_model');

            $this->load->model('Non_dot_test_panel_model');

		}

        public function index() {

            echo json_encode($this->data);
        	//die();

        }

        public function updateDS() {

            $this->load->dbforge();

            $fields = array(
                'dsSiteId' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => FALSE,
                    'default' => 0
                )
            );

            $this->dbforge->add_column('drug_screenings', $fields);

            echo 'SSUCCESSFUL!';

        }

        public function tableNDOTTP() {

            $this->load->dbforge();

            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'panel' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                )
            );

            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('non_dot_test_panels', TRUE);

        }

        public function insertNDOTTP() {

            $params1 = array(
                'id' => 7,
                'panel' => '7'
            );
            
            $this->Non_dot_test_panel_model->add_non_dot_test_panel($params1);

            $params2 = array(
                'id' => 8,
                'panel' => '8'
            );
            
            $this->Non_dot_test_panel_model->add_non_dot_test_panel($params2);

            $params3 = array(
                'id' => 12,
                'panel' => '12'
            );
            
            $this->Non_dot_test_panel_model->add_non_dot_test_panel($params3);

            $params4 = array(
                'id' => 17,
                'panel' => '7 Expanded'
            );
            
            $this->Non_dot_test_panel_model->add_non_dot_test_panel($params4);

            $inserted_panels = $this->Non_dot_test_panel_model->get_all_non_dot_test_panels();

            var_dump($inserted_panels);

            die();

        }

        public function updateST() {

            $this->load->dbforge();

            $fields = array(
                'ndttPanelId' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => FALSE,
                    'default' => 0
                ),
                'ndttLotId' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                ),
                'ndttExpDate' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                )
            );

            $this->dbforge->add_column('sites', $fields);

            echo 'SSUCCESSFUL!';

        }

        public function mergeCompanies() {

            if ($this->db->simple_query('UPDATE `alcohol_tests` SET `subcontractorId`=13 WHERE `subcontractorId`=374')) {

                echo "Alcohol_tests Table Modification Successful<br/><br/>";

            } else {

                echo "Alcohol_tests Table Modification Failed<br/><br/>";
                
            }

            if ($this->db->simple_query('UPDATE `companies` SET `parentCompanyId`=13 WHERE `parentCompanyId`=374')) {

                echo "Companies Table Modification Successful<br/><br/>";

            } else {

                echo "Companies Table Modification Failed<br/><br/>";
                
            }

            if ($this->db->simple_query('UPDATE `drug_test_log` SET `companyId`=13 WHERE `companyId`=374')) {

                echo "Drug_test_log Table Modification Successful<br/><br/>";

            } else {

                echo "Drug_test_log Table Modification Failed<br/><br/>";
                
            }

            if ($this->db->simple_query('UPDATE `drug_screenings` SET `subcontractorId`=13 WHERE `subcontractorId`=374')) {

                echo "Drug_screenings Table Modification Successful<br/><br/>";

            } else {

                echo "Drug_screenings Table Modification Failed<br/><br/>";
                
            }

            if ($this->db->simple_query('UPDATE `sites` SET `assignedCompanyId`=13 WHERE `assignedCompanyId`=374')) {

                echo "Sites Table Modification Successful<br/><br/>";

            } else {

                echo "Sites Table Modification Failed<br/><br/>";
                
            }

            if ($this->db->simple_query('UPDATE `time_clock` SET `companyId`=13 WHERE `companyId`=374')) {

                echo "Time_clock Table Modification Successful<br/><br/>";

            } else {

                echo "Time_clock Table Modification Failed<br/><br/>";

            }

            if ($this->db->simple_query('UPDATE `workers` SET `companyId`=13 WHERE `companyId`=374')) {

                echo "Workers Table Modification Successful<br/><br/>";

            } else {

                echo "Workers Table Modification Failed<br/><br/>";

            }

            if ($this->db->simple_query('DELETE FROM `companies` WHERE `id`=374')) {

                echo "Company (ID - 374) Deletion Successful<br/><br/>";

            } else {

                echo "Company (ID - 374) Deletion Failed<br/><br/>";

            }

            if ($this->db->simple_query('UPDATE `companies` SET `companyName`="Turner Construction Company" WHERE `id`=13')) {

                echo "Companies Table Modification Successful<br/><br/>";

            } else {

                echo "Companies Table Modification Failed<br/><br/>";

            }

            if ($this->db->simple_query('UPDATE `companies` SET `typeId`=1 WHERE `typeId`=0')) {

                echo "Companies Table Type Modification Successful<br/><br/>";

            } else {

                echo "Companies Table Type Modification Failed<br/><br/>";

            }

            if ($this->db->simple_query('UPDATE `companies` SET `statusId`=1 WHERE `statusId`=0')) {

                echo "Companies Table Status Modification Successful<br/><br/>";

            } else {

                echo "Companies Table Status Modification Failed<br/><br/>";

            }


        }

        public function ust() {

            $this->load->dbforge();

            $fields = array(
                'isSubsite' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => FALSE,
                    'default' => 'NO'
                ),
                'parentSiteId' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => FALSE,
                    'default' => 0
                )
            );

            $this->dbforge->add_column('sites', $fields);

            echo 'SSUCCESSFUL!';

        }

        public function udst() {

            $this->load->dbforge();

            $fields = array(
                'isPrevious' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                ),
                'cardNumber' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                )
            );

            $this->dbforge->add_column('drug_screenings', $fields);

            echo 'SSUCCESSFUL!';

        }

        public function updateTimeClockTable() {

            $this->load->dbforge();

            $fields = array(

                'siteId' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
                'companyId' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
                'dueTime' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'default' => 0
                ),
                'lateInTime' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
                'earlyInTime' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                )
                
            );

            $this->dbforge->add_column('time_clock', $fields);

        }


        public function UUT() {

            $this->load->dbforge();

            $fields = array(

                'clocked_in' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => -1
                ),
                'breaked_in' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
                'tc_site_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
                'tc_company_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0
                ),
                'tc_site' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => TRUE
                ),
                'tc_company' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => TRUE
                )
                
            );

            $this->dbforge->add_column('users', $fields);

        }

		public function updateSitesTable() {

			$this->load->dbforge();

			$fields = array(
                'startTime' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '30',
                    'null' => TRUE
                ),
                'endTime' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '30',
                    'null' => TRUE
                ),
            );

			$this->dbforge->add_column('sites', $fields);

		}

        public function addSLTable() {

            $this->load->dbforge();

            $fields = array(

                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'entity' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '30',
                    'null' => TRUE
                ),
                'uid' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '30',
                    'null' => TRUE
                ),
                'time' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'event' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '30',
                    'null' => TRUE
                ),
                'performedBy' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                ),
                'reqData' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'resData' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'success' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '30',
                    'null' => TRUE
                ),
                'errMsg' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                )

            );

            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('synergy_log', TRUE);

        }

        public function addTimeClockTable() {

            $this->load->dbforge();

            $fields = array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'userId' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => TRUE
                ),
                'time' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'activity' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '30',
                    'null' => TRUE
                ),
                'note' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                )
            );

            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('time_clock', TRUE);

        }

        public function addDrugTestLogTable() {

            $this->load->dbforge();

            $fields = array(
                'id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'collectorId' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => TRUE
                ),
                'date' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'siteId' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => TRUE
                ),
                'companyId' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => TRUE
                ),
                'testCount' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => TRUE
                )
            );

            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('drug_test_log', TRUE);

        }

        public function updateUsersTable() {

            $this->load->dbforge();

            $fields = array(
                'drugTestCollector' => array(
                    'type' => 'boolean',
                    'default' => FALSE
                )
            );

            $this->dbforge->add_column('users', $fields);

        }

		public function updateCompanies() {

			$companies = $this->Company_model->get_all_companies();

			//var_dump($companies);

			foreach ($companies as $com) {
				
				if($com['uid'] == null) {

					$params = array(

						'uid' => $this->generateUID()

					);

					if($com['fein'] == null) {

						$params['fein'] = $this->generateFEIN();

					}

					$this->Company_model->update_company((int) $com['id'], $params);

				}

			}

			echo 'Companies are updated successfully';


		}

		private function getFEINs () {

			$this->load->library("excel");

            $object = PHPExcel_IOFactory::createReader('Excel2007');

            $xlsxObj = $object->load('C:\\FEINs.xlsx');

            $objWorksheet = $xlsxObj->getActiveSheet();

			$highestRow = $objWorksheet->getHighestRow();
			$highestColumn = $objWorksheet->getHighestColumn();
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

			$rows = array();

			for ($row = 2; $row <= $highestRow; ++$row) {
			  for ($col = 0; $col <= $highestColumnIndex; ++$col) {
			    $rows[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
			  }
			  
			  if($rows[$highestColumnIndex - 1]) {

			  	echo '$this->Company_model->update_company(' . $rows[0] . ', ' . 'array(\'fein\' => \'' . $rows[$highestColumnIndex - 1] . '\'));<br>';

			  }

			}

		}

		public function updateFEINs() {

			$this->Company_model->update_company(13, array('fein' => '13-1401980'));
			$this->Company_model->update_company(15, array('fein' => '04-1967105'));
			$this->Company_model->update_company(19, array('fein' => '04-2111361'));
			$this->Company_model->update_company(21, array('fein' => '20-4663051'));
			$this->Company_model->update_company(22, array('fein' => '04-2906101'));
			$this->Company_model->update_company(24, array('fein' => '82-2451806'));
			$this->Company_model->update_company(26, array('fein' => '05-0358936'));
			$this->Company_model->update_company(30, array('fein' => '04-2890252'));
			$this->Company_model->update_company(33, array('fein' => '02-0455854'));
			$this->Company_model->update_company(34, array('fein' => '04-3110255'));
			$this->Company_model->update_company(36, array('fein' => '20-8492816'));
			$this->Company_model->update_company(37, array('fein' => '46-1373798'));
			$this->Company_model->update_company(38, array('fein' => '04-3305891'));
			$this->Company_model->update_company(39, array('fein' => '23-3035978'));
			$this->Company_model->update_company(43, array('fein' => '46-0907913'));
			$this->Company_model->update_company(44, array('fein' => '04-2312916'));
			$this->Company_model->update_company(46, array('fein' => '04-29377769'));
			$this->Company_model->update_company(47, array('fein' => '04-2821043'));
			$this->Company_model->update_company(49, array('fein' => '04-2431586'));
			$this->Company_model->update_company(50, array('fein' => '27-2918670'));
			$this->Company_model->update_company(53, array('fein' => '04-2842193'));
			$this->Company_model->update_company(58, array('fein' => '27-2918670'));
			$this->Company_model->update_company(66, array('fein' => '04-3354908'));
			$this->Company_model->update_company(71, array('fein' => '27-1100663'));
			$this->Company_model->update_company(76, array('fein' => '04-2302236'));
			$this->Company_model->update_company(77, array('fein' => '04-3507297'));
			$this->Company_model->update_company(88, array('fein' => '04-1193310'));
			$this->Company_model->update_company(117, array('fein' => '04-2830520'));
			$this->Company_model->update_company(127, array('fein' => '42-432734'));
			$this->Company_model->update_company(130, array('fein' => '33-1059762'));
			$this->Company_model->update_company(131, array('fein' => '04-2639573'));
			$this->Company_model->update_company(135, array('fein' => '38-3956587'));
			$this->Company_model->update_company(136, array('fein' => '04-2198006'));
			$this->Company_model->update_company(142, array('fein' => '04-2524341'));
			$this->Company_model->update_company(158, array('fein' => '05-0505013'));
			$this->Company_model->update_company(160, array('fein' => '04-2979081'));
			$this->Company_model->update_company(161, array('fein' => '04-3165907'));
			$this->Company_model->update_company(162, array('fein' => '04-2650465'));
			$this->Company_model->update_company(168, array('fein' => '04-2269767'));
			$this->Company_model->update_company(170, array('fein' => '04-2034565'));
			$this->Company_model->update_company(182, array('fein' => '46-2711502'));
			$this->Company_model->update_company(183, array('fein' => '04-2538458'));
			$this->Company_model->update_company(196, array('fein' => '04-2313282'));
			$this->Company_model->update_company(230, array('fein' => '06-0619109'));
			$this->Company_model->update_company(233, array('fein' => '04-1584300'));
			$this->Company_model->update_company(234, array('fein' => '04-20124747'));
			$this->Company_model->update_company(241, array('fein' => '04-3111642'));
			$this->Company_model->update_company(242, array('fein' => '04-3462237'));
			$this->Company_model->update_company(271, array('fein' => '91-0782138'));
			$this->Company_model->update_company(273, array('fein' => '16-1643297'));
			$this->Company_model->update_company(275, array('fein' => '20-8137185'));
			$this->Company_model->update_company(279, array('fein' => '20-8671697'));
			$this->Company_model->update_company(281, array('fein' => '27-3828038'));
			$this->Company_model->update_company(282, array('fein' => '04-3155172'));
			$this->Company_model->update_company(290, array('fein' => '04-3293344'));
			$this->Company_model->update_company(292, array('fein' => '01-0279685'));
			$this->Company_model->update_company(300, array('fein' => '04-3131744'));
			$this->Company_model->update_company(307, array('fein' => '06-0631940'));
			$this->Company_model->update_company(328, array('fein' => '41-1927111'));
			$this->Company_model->update_company(329, array('fein' => '04-3310955'));
			$this->Company_model->update_company(338, array('fein' => '04-2049088'));
			$this->Company_model->update_company(342, array('fein' => '04-2630303'));
			$this->Company_model->update_company(359, array('fein' => '04-3027050'));
			$this->Company_model->update_company(363, array('fein' => '04-2997565'));
			$this->Company_model->update_company(369, array('fein' => '38-1797318'));
			$this->Company_model->update_company(370, array('fein' => '87-0262989'));
			$this->Company_model->update_company(372, array('fein' => '04-2922377'));

			echo 'FEINs are updated successfully';


		}

		public function sendSubcontractors() {

			//$companies = $this->Company_model->get_all_companies(array('offset'=>60, 'limit'=> 60));

			$companies = array();

			for($i=339; $i<376; $i++) {

				$com = $this->Company_model->get_company($i);

				array_push($companies, $com);


			}

			//var_dump($companies); die();

			foreach ($companies as $com) {
				
				if((int)$com['typeId'] == 1) {

					$scData = array(

                        'ContractorID' => $com['uid'],
                        'Sub_Name' => $com['companyName'],
                        'Sub_Contact' => $com['primaryContact'],
                        'Sub_Address' => $com['address1'],
                        'Sub_city' => $com['city'],
                        'Sub_State' => $com['state'],
                        'Sub_Zip' => $com['zipCode'],
                        'Sub_Phone' => $com['phoneNumber'],
                        'FEIN' => $com['fein']

                    );

                    $obj = (object) $scData;

                    $sc = $this->formatData($obj);

                    $reqData = array(

                        'EventID' => '20180330-01',
                        'EventType' => 'New_SubContractor',
                        'APIKey' => API_KEY,
                        'RecordCreated' => date('m/d/Y h:i:s A'),
                        'SubContractor' => array($sc)
                    );

                    $resData = $this->performSynergyEvent($reqData);

                    $df = DateTime::createFromFormat('m/d/Y h:i:s A', $reqData['RecordCreated']);

                    $slParams = array(

                        'entity' => 'SubContractor',
                        'uid' => $com['uid'],
                        'time' => strtotime($df->format('Y-m-d h:i:s A')),
                        'event' => $reqData['EventID'] . '-Add SubContractor',
                        'performedBy' => '',
                        'reqData' => json_encode($reqData),
                        'resData' => json_encode($resData),
                        'success' => $resData->ReturnCode,
                        'errMsg' => ($resData->ReturnCode == -1) ? $resData->ExtendedMessage : ''

                    );

                    $sl_id = $this->Synergy_log_model->add_synergy_log($slParams);

                    echo $sl_id . ' / ' . $com['id'] . ' => ' . $resData->ReturnCode . ' / ' . $resData->Message . ' / ' . $resData->ExtendedMessage . '.<br><br>';

				}

			}


		}

        public function sndWrkrs() {

            $workers = array();

            $w1 = $this->Worker_model->get_worker(172);
            /*$w2 = $this->Worker_model->get_worker(169);
            $w3 = $this->Worker_model->get_worker(35);
            $w4 = $this->Worker_model->get_worker(33);
            $w5 = $this->Worker_model->get_worker(32);*/

            array_push($workers, $w1);
            /*array_push($workers, $w2);
            array_push($workers, $w3);
            array_push($workers, $w4);
            array_push($workers, $w5);*/

            foreach ($workers as $worker) {

                $this->Worker_model->update_worker((int) $worker['id'], array('companyId' => 374));

                $com = $this->Company_model->get_company(374);

                $workerData = array(

                    'BarCode' => $worker['uid'],
                    'WorkerFirst' => $worker['firstName'],
                    'WorkerLast' => $worker['lastName'],
                    'Gender' => $worker['sex'],
                    'Minority' => $worker['minority'],
                    'Minority_Type' => $worker['minorityType'],
                    'SubContractor' => $com['uid'],
                    'Worker_Address' => $worker['address1'],
                    'Worker_City' => $worker['city'],
                    'Worker_State' => $worker['state'],
                    'Worker_Zip' => $worker['zipCode'],
                    'Job_Role' => $worker['jobRole'],
                    'Trade' => $worker['jobTitle'],
                    'Worker_Phone' => $worker['primaryPhone'],
                    'Worker_Email' => $worker['email'],
                    'Emergency_Contact' => $worker['ecName'],
                    'Emergency_Contact_Phone' => $worker['ecPhone'],
                    'Emergency_Contact_Type' => $worker['ecType']

                );

                $obj = (object) $workerData;

                $wrkr = $this->formatData($obj);

                $reqData = array(

                    'EventID' => '20180330-02',
                    'EventType' => 'Registered Worker',
                    'APIKey' => API_KEY,
                    'RecordCreated' => date('m/d/Y h:i:s A'),
                    'Worker' => array($wrkr)
                );

                $resData = $this->performSynergyEvent($reqData);

                $df = DateTime::createFromFormat('m/d/Y h:i:s A', $reqData['RecordCreated']);

                $slParams = array(

                    'entity' => 'Worker',
                    'uid' => $worker['uid'],
                    'time' => strtotime($df->format('Y-m-d h:i:s A')),
                    'event' => $reqData['EventID'] . ' [Register Worker]',
                    'performedBy' => '',
                    'reqData' => json_encode($reqData),
                    'resData' => json_encode($resData),
                    'success' => $resData->ReturnCode,
                    'errMsg' => ($resData->ReturnCode == -1) ? $resData->ExtendedMessage : ''

                );

                $sl_id = $this->Synergy_log_model->add_synergy_log($slParams);

                echo $sl_id . '/' . $worker['id'] . ' => ' . $resData->ReturnCode . ' / ' . $resData->Message . ' / ' . $resData->ExtendedMessage . '.<br><br>';

            }
        }

		public function sendWorkers() {

			$wrkrs = $this->Worker_model->get_all_workers();

            //var_dump(count($ws));die();

			//$wrkrs = array();

			foreach ($wrkrs as $worker) {
				
				if((int)$worker['companyId'] > 0) {

					

				} else {

					//$this->Worker_model->update_worker((int) $worker['id'], array('siteIdW' => 12));


                    $dss = $this->Drug_screening_model->get_worker_drug_screenings((int) $worker['id']);

                    $ds_com_id = 0;

                    if(!empty($dss)) {


                        $ds_com_id = $dss[0]['subcontractorId'];

                        //echo $worker['lastName'] . ' ' . $worker['firstName'] . ' [UID: ' . $worker['uid'] . ']<br><br>';

                        //echo $worker['lastName'] . ' ' . $worker['firstName'] . ' [UID: ' . $worker['uid'] . '] Company Id: ' . $ds_com_id . ' Site Id: ' . $worker['siteIdW'] . '<br><br>';


                    }

                    if($ds_com_id > 0) {

                        $com = $this->Company_model->get_company($ds_com_id);

                        $this->Worker_model->update_worker((int) $worker['id'], array('companyId' => $ds_com_id));

                        $workerData = array(

                            'BarCode' => $worker['uid'],
                            'WorkerFirst' => $worker['firstName'],
                            'WorkerLast' => $worker['lastName'],
                            'Gender' => $worker['sex'],
                            'Minority' => $worker['minority'],
                            'Minority_Type' => $worker['minorityType'],
                            'SubContractor' => $com['uid'],
                            'Worker_Address' => $worker['address1'],
                            'Worker_City' => $worker['city'],
                            'Worker_State' => $worker['state'],
                            'Worker_Zip' => $worker['zipCode'],
                            'Job_Role' => $worker['jobRole'],
                            'Trade' => $worker['jobTitle'],
                            'Worker_Phone' => $worker['primaryPhone'],
                            'Worker_Email' => $worker['email'],
                            'Emergency_Contact' => $worker['ecName'],
                            'Emergency_Contact_Phone' => $worker['ecPhone'],
                            'Emergency_Contact_Type' => $worker['ecType']

                        );

                        $obj = (object) $workerData;

                        $wrkr = $this->formatData($obj);

                        $reqData = array(

                            'EventID' => '20180330-02',
                            'EventType' => 'Registered Worker',
                            'APIKey' => API_KEY,
                            'RecordCreated' => date('m/d/Y h:i:s A'),
                            'Worker' => array($wrkr)
                        );

                        $resData = $this->performSynergyEvent($reqData);

                        $df = DateTime::createFromFormat('m/d/Y h:i:s A', $reqData['RecordCreated']);

                        $slParams = array(

                            'entity' => 'Worker',
                            'uid' => $worker['uid'],
                            'time' => strtotime($df->format('Y-m-d h:i:s A')),
                            'event' => $reqData['EventID'] . ' [Register Worker]',
                            'performedBy' => '',
                            'reqData' => json_encode($reqData),
                            'resData' => json_encode($resData),
                            'success' => $resData->ReturnCode,
                            'errMsg' => ($resData->ReturnCode == -1) ? $resData->ExtendedMessage : ''

                        );

                        $sl_id = $this->Synergy_log_model->add_synergy_log($slParams);

                        echo $sl_id . '/' . $worker['id'] . ' => ' . $resData->ReturnCode . ' / ' . $resData->Message . ' / ' . $resData->ExtendedMessage . '.<br><br>';

                    	//echo $worker['lastName'] . ' ' . $worker['firstName'] . ' [UID: ' . $worker['uid'] . ']<br><br>';

                    	

                    }

				}

			}

			die();

			$workers = array();

			/*for($i=301; $i<339; $i++) {

				array_push($workers, $wrkrs[$i]);


			}*/

			//var_dump($workers2); die();



			foreach ($workers as $worker) {

	                $subcon = '';

	                if($worker['companyId'] != null && (int)$worker['companyId'] > 0) {

	                    $com = $this->Company_model->get_company((int)$worker['companyId']);

	                    $subcon = $com['uid'];

	                }

                    $workerData = array(

                        'BarCode' => $worker['uid'],
                        'WorkerFirst' => $worker['firstName'],
                        'WorkerLast' => $worker['lastName'],
                        'Gender' => $worker['sex'],
                        'Minority' => $worker['minority'],
                        'Minority_Type' => $worker['minorityType'],
                        'SubContractor' => $subcon,
                        'Worker_Address' => $worker['address1'],
                        'Worker_City' => $worker['city'],
                        'Worker_State' => $worker['state'],
                        'Worker_Zip' => $worker['zipCode'],
                        'Job_Role' => $worker['jobRole'],
                        'Trade' => $worker['jobTitle'],
                        'Worker_Phone' => $worker['primaryPhone'],
                        'Worker_Email' => $worker['email'],
                        'Emergency_Contact' => $worker['ecName'],
                        'Emergency_Contact_Phone' => $worker['ecPhone'],
                        'Emergency_Contact_Type' => $worker['ecType']

                    );

                    $obj = (object) $workerData;

                    $wrkr = $this->formatData($obj);

                    $reqData = array(

                        'EventID' => '20180330-02',
                        'EventType' => 'Registered Worker',
                        'APIKey' => API_KEY,
                        'RecordCreated' => date('m/d/Y h:i:s A'),
                        'Worker' => array($wrkr)
                    );

                   	$resData = $this->performSynergyEvent($reqData);

                    $df = DateTime::createFromFormat('m/d/Y h:i:s A', $reqData['RecordCreated']);

                    $slParams = array(

                        'entity' => 'Worker',
                        'uid' => $worker['uid'],
                        'time' => strtotime($df->format('Y-m-d h:i:s A')),
                        'event' => $reqData['EventID'] . ' [Register Worker]',
                        'performedBy' => '',
                        'reqData' => json_encode($reqData),
                        'resData' => json_encode($resData),
                        'success' => $resData->ReturnCode,
                        'errMsg' => ($resData->ReturnCode == -1) ? $resData->ExtendedMessage : ''

                    );

                    $sl_id = $this->Synergy_log_model->add_synergy_log($slParams);

                   	echo $sl_id . '/' . $worker['id'] . ' => ' . $resData->ReturnCode . ' / ' . $resData->Message . ' / ' . $resData->ExtendedMessage . '.<br><br>';


			}



		}

		private function generateUID() {

			$currentTime = time();
			$hexTime = dechex($currentTime);

			$cryptoStrong = true; // can be false
			$length = 8; // Any length you want
			$bytes = openssl_random_pseudo_bytes($length, $cryptoStrong);
			$randomString = bin2hex($bytes);

			return $randomString;

		}

		private function generateFEIN() {

			$string='';

			for($i=0; $i<2; $i++) {

			    $string .= rand(0,9);
			    
			}

			$string .= '-';

			for($i=0; $i<7; $i++) {

			    $string .= rand(0,9);

			}

			return $string;

		}

	}

?>
