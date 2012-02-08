<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acceso
{
	public function expiracion() 
	{
		$this->CI = &get_instance();
		if ($this->CI->session->userdata('Usuario') == NULL)
		{
			
		}
		if ($this->CI->session->userdata('Usuario') != NULL)
		{
			$Usuario = $this->CI->session->userdata('Usuario');
		}	
	}
}

?>