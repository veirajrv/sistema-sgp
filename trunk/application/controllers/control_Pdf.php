<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Control_Pdf extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('fpdf');
		$this->load->helper('form');
		$this->load->helper('pdf_helper');
		$this->load->model('modelCombox');
		$this->load->library('cezpdf');
		$this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
	}
	
	// Funcion que nos lleva a la pantalla en donde encontraremos
	// todos los manuales del sistema en pdf en donde podran ser 
	// descargados
	public function index() 
	{	
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['error'] = " ";	
		
		$this->load->view('ArchivoPDF', $usuario);
	}
	
	public function index2() 
	{	
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['error'] = " ";	
		
		$usuario['Lista'] = $this->modelCombox->ConsultarDirectorio();
		
		$this->load->view('Administrador/AArchivoPdf', $usuario);
	}
	
	public function Prueb() 
	{	
		$objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setTitle("title")
                        ->setDescription("description");

            // Assign cell values
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setCellValue("A1", "cell value here 111");

            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(1);
            $objPHPExcel->getActiveSheet()->setCellValue("A1", "cell value here 222");
            // Save it as an excel 2003 file
            $objWriter = IOFactory::createWriter($objPHPExcel, "Excel5");
            $objWriter->save("nameoffile.xls");
	}
	
	public function genera_pdf(){
            /*load library cezpdf*/
            
            prep_pdf();ob_start(); // al inicio

			$hola = "Hola mundo";
			$imagen = base_url()."file/images/logo.jpg";
			
			$this->cezpdf->addJpegFromFile($imagen,0,0,595); //coloca la imagen
			ob_end_flush(); // al final
            $this->cezpdf->ezText('<b>Cliente No.:</b> '.$hola.'');
            $this->cezpdf->ezText('<b>Cliente:</b> Abraham Zenteno Sanchez');
            $this->cezpdf->ezText('<b>Tienda:</b>  Plaza Dorada');
            $this->cezpdf->ezText('<b>Fecha y hora de impresion:</b> '.date('Y-m-d').', '.date('H:i').' hrs.');
            $this->cezpdf->ezText('');
            $db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
            $db_data[] = array('eye' => 'O.I.','ESF' => '+9.20','CIL' => '-1.00','EJE' => '3','ADD' => '+4.50','REF' => 'D.I. 3 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
            $db_data[] = array('eye' => 'O.I.','ESF' => '+9.20','CIL' => '-1.00','EJE' => '3','ADD' => '+4.50','REF' => 'D.I. 3 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
            $db_data[] = array('eye' => 'O.I.','ESF' => '+9.20','CIL' => '-1.00','EJE' => '3','ADD' => '+4.50','REF' => 'D.I. 3 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
            $db_data[] = array('eye' => 'O.I.','ESF' => '+9.20','CIL' => '-1.00','EJE' => '3','ADD' => '+4.50','REF' => 'D.I. 3 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
            $db_data[] = array('eye' => 'O.I.','ESF' => '+9.20','CIL' => '-1.00','EJE' => '3','ADD' => '+4.50','REF' => 'D.I. 3 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
            $db_data[] = array('eye' => 'O.I.','ESF' => '+9.20','CIL' => '-1.00','EJE' => '3','ADD' => '+4.50','REF' => 'D.I. 3 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
            $db_data[] = array('eye' => 'O.I.','ESF' => '+9.20','CIL' => '-1.00','EJE' => '3','ADD' => '+4.50','REF' => 'D.I. 3 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			$db_data[] = array('eye' => 'O.D.','ESF' => '+9.75','CIL' => '-1.25','EJE' => '3','ADD' => '+2.50','REF' => 'D.I. 4 mm');
			
   
            $col_names = array(
                'eye' => '',
                'ESF' => 'ESF.',
                'CIL' => 'CIL.',
                'EJE' => 'EJE',
                'ADD' => 'ADD',
                'REF' => ''           
            );
   
            $this->cezpdf->ezTable($db_data, $col_names, 'Graduacion registrada el 3 de Diciembre del 2009', array('width'=>550));
           
            $this->cezpdf->ezStream(array('Content-Disposition'=>'nama_file.pdf'));

}
}

