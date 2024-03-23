<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Language extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Language_model');
    }

    public function index()
    {
        $data['pageTitle']     = 'Safecity Webapp';
        //$data['statusesCount'] = $this->chat_model->getStatusesCount($this->client_id);
        //$this->load->view('chat', $data);
    }

    public function importLanguages($lang_id)
    {
        // Load required liabrary
        require_once APPPATH . "third_party/PHPExcel-1.8.1/Classes/PHPExcel.php";
        require_once APPPATH . "third_party/PHPExcel-1.8.1/Classes/PHPExcel/Writer/Excel2007.php";

        // Set import path
        $path = FCPATH . 'assets/uploads/';
        
        /* // if file upload option given to user
        $config['upload_path']   = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('uploadLanguage')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        if(empty($error)){
          if (!empty($data['upload_data']['file_name'])) {
            $import_xls_file = $data['upload_data']['file_name'];
        } else {
            $import_xls_file = 0;
        }*/

        $import_xls_file = 'form_translation.xlsx'; // Comment this line if we are using upload method
        $inputFileName   = $path . $import_xls_file;
        
        try {
            $inputFileType  = PHPExcel_IOFactory::identify($inputFileName);
            $objReader      = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel    = $objReader->load($inputFileName);

            // Get all sheets name array
            $worksheets = $objPHPExcel->getSheetNames();

            for ($sheet = 0; $sheet<count($worksheets); $sheet++)
            {
                // Set sheet name as DB table name
                $table_name   = $worksheets[$sheet];
                // Apply changes to following tables
                $tables_list = array('categories_translation','question_translation','option_translation');

                if(!in_array($table_name, $tables_list))
                    continue;
                
                // Get the worksheet of your choice by its name
                $active_sheet = $objPHPExcel->getSheetByName($table_name);
                $lastRow      = $active_sheet->getHighestDataRow();
                $lastCol      = $active_sheet->getHighestDataColumn();

                // Get active sheet headings
                $row = 1;
                $active_sheet_heading = $active_sheet->rangeToArray('A'.$row.':'.$lastCol.$row, NULL, TRUE, FALSE);
                $active_sheet_heading = $active_sheet_heading[0];
                
                // Get active sheet data
                $row++;
                $active_sheet_data = $active_sheet->rangeToArray('A'.$row.':'.$lastCol.$lastRow, NULL, TRUE, FALSE);

                // Create data array to insert records
                $inserdata = array();
                foreach ($active_sheet_data as $key => $value) {
                    if($lang_id == $active_sheet->getCellByColumnAndRow(1, $row)->getValue()) {
                        foreach ($active_sheet_heading as $col => $name) {
                            if(!empty($active_sheet->getCellByColumnAndRow($col, $row)->getValue())) {
                                $inserdata[$key][$name] = (String) $active_sheet->getCellByColumnAndRow($col, $row)->getValue();
                            }
                            else {
                                $inserdata[$key][$name] = NULL;
                            }
                        }
                    }
                    $row++;
                }

                // Check data is exists of selected language id or not
                $data_exists = $this->Language_model->getData($table_name, $lang_id);
                // echo "<br>Table Name: ". $table_name . "<br>";
                // echo "<pre>";
                // print_r($data_exists);continue;
                // print_r($inserdata);continue;

                if($data_exists) {
                    // Delete bulk data records of active sheet
                    $deleted_records = $this->Language_model->deleteBulkData($table_name, $lang_id);
                }
                
                // Insert bulk data records of active sheet
                $result = $this->Language_model->importBulkData($table_name, $inserdata);
                
                if($result) {
                    echo count($inserdata).' Records inserted in '.$table_name.' table for language id ' . $lang_id . ' successfully.<br>';
                    log_message('info', count($inserdata).' Records inserted in '.$table_name.' table for language id ' . $lang_id . ' successfully.');
                } else {
                    echo "ERROR !";
                }

            }
            
        }
        catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        // Update query in database to set new language (this is for Malay)
        // INSERT INTO `client_languages` (`client_id`, `language_id`) VALUES ('1', '77');
        // ALTER TABLE `categories_translation` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);
        // ALTER TABLE `option_translation` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);
        // UPDATE `languages` SET `native_name` = 'Malay' WHERE `languages`.`id` = 77;
        //UPDATE `question_translation` SET `properties` = '{\"type\": \"estimate-time-or-rangepicker\", \"validations\": [{\"timediff\": \"Sila masukkan julat waktu dalam hari yang sama.\", \"startendtime\": \"Sila pilih Waktu Mula dan Waktu Akhir Kedua-duanya. \"}]}' WHERE `question_translation`.`id` = 347;
        //UPDATE `question_translation` SET `properties` = '{\"type\": \"incident-address-form\", \"validations\": [{\"required\": \"benar\", \"message\": \"Medan ini diperlukan\"}]}' WHERE `question_translation`.`id` = 447;

    }

    public function exportLanguages($lang_id)
    {
        // Load required liabrary
        require_once APPPATH . "/third_party/PHPExcel-1.8.1/Classes/PHPExcel.php";
        require_once APPPATH . "/third_party/PHPExcel-1.8.1/Classes/PHPExcel/Writer/Excel2007.php";

        try {

            $extension = '.xlsx';
            $version   = 'Excel2007';
            $filename  = 'Form_translation_' . time() . $extension;
            $filename  = str_replace(' ', '_', $filename);

            //Tables array
            $worksheets = array('categories_translation', 'question_translation', 'option_translation');

            //Workbook Object
            $objPHPExcel    = new PHPExcel();

            // Set document properties
            $objPHPExcel->getProperties()->setCreator("Safecity")
                                         ->setLastModifiedBy("Safecity")
                                         ->setTitle("Safecity Language Document")
                                         ->setSubject("Safecity Language Document")
                                         ->setDescription("Language document of Safecity, generated using PHP classes.")
                                         ->setKeywords("Export")
                                         ->setCategory("Languages");

            for ($sheet = 0; $sheet<count($worksheets); $sheet++)
            {
                // Get fields list from DB
                $fields = $this->Language_model->getTableColumns($worksheets[$sheet]);
                // Check data is exists of selected language id or not
                $result = $this->Language_model->getData($worksheets[$sheet], 1);

                // Add new sheet
                $objWorkSheet = $objPHPExcel->createSheet($sheet);
                
                // echo "<pre>";
                // print_r($result);
                // continue;

                $row = 1;

                // Add some data
                /*$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);*/

                $fontBold = array( "font" => array("bold" => true));
                //$fillMark = array( "font" => array("color" => array("rgb" => "FF0000"))); // Font Style
                $fillMark = array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'FFFF00'))); // Fill Style

                // Fill Headings
                for ($col = 0; $col<count($fields); $col++)
                {
                    $objWorkSheet->setCellValueByColumnAndRow($col, $row, $fields[$col]);
                    $objWorkSheet->getCellByColumnAndRow($col, $row)->getStyle()->applyFromArray($fontBold);
                }

                $row++; // Next Row

                // Fill Records
                for ($res = 0; $res < count($result); $res++) {

                    // Enter records of default lanugage id 1
                    for ($cols = 0; $cols<count($fields); $cols++) {
                        $objWorkSheet->setCellValueByColumnAndRow($cols, $row, $result[$res][$fields[$cols]]);
                    }
                    
                    $row++; // Next Row
                    
                    // New row for new language id
                    for ($newcols = 0; $newcols<count($fields); $newcols++) {

                        if($fields[$newcols] == 'lang_id') { // lang_id column get lang_id from URL
                            $objWorkSheet->setCellValueByColumnAndRow($newcols, $row, $lang_id);
                        }
                        else if($fields[$newcols] == 'title' && $result[$res][$fields[$newcols]] != '') {
                            $objWorkSheet->setCellValueByColumnAndRow($newcols, $row, '');
                            $objWorkSheet->getCellByColumnAndRow($newcols, $row)->getStyle()->applyFromArray($fillMark);
                        }
                        else if(($fields[$newcols] == 'question' || $fields[$newcols] == 'subtext') && $result[$res][$fields[$newcols]] != '') {
                            $objWorkSheet->setCellValueByColumnAndRow($newcols, $row, '');
                            $objWorkSheet->getCellByColumnAndRow($newcols, $row)->getStyle()->applyFromArray($fillMark);
                        }
                        else if(($fields[$newcols] == 'properties' || $fields[$newcols] == 'textbox_placeholder') && $result[$res][$fields[$newcols]] != '') {
                            $objWorkSheet->setCellValueByColumnAndRow($newcols, $row, $result[$res][$fields[$newcols]]);
                            $objWorkSheet->getCellByColumnAndRow($newcols, $row)->getStyle()->applyFromArray($fillMark);
                        }
                        else if($fields[$newcols] == 'is_default') { // is_default column static value
                            $objWorkSheet->setCellValueByColumnAndRow($newcols, $row, '0');
                        }
                        else {
                            $objWorkSheet->setCellValueByColumnAndRow($newcols, $row, $result[$res][$fields[$newcols]]);
                        }
                    }

                    $row++;
                }
                //continue;

                // Rename worksheet
                $objWorkSheet->setTitle($worksheets[$sheet]);
                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);
            }

            // Redirect output to a client’s web browser (Excel2007)
            // application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
            header("Content-Type:application/vnd.ms-excel;charset=UTF-8"); //mime type
            header("Content-Disposition:attachment;filename=$filename"); //tell browser what's the file name
            header('Cache-Control:max-age=0'); //no cache

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $version);
            $objWriter->save('php://output');
        }
        catch (Exception $e) {
            die('Error creating file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }
    }

}