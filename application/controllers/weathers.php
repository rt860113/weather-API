<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weathers extends CI_Controller 
{
	public function index()
	{
		$this->load->view("weather_view");
	}
}

?>