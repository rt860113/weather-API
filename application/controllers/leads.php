<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leads extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}
	public function index()
	{
		$this->session->sess_destroy();
		$lead=new lead();
		$count=$lead->count();
		$total_pages=ceil($count/15);
		$lead1=new lead();
		$lead1->limit(15,0);
		$result=$lead1->get()->all_to_array();
		$this->load->view("lead_view",array("result"=>$result,"total_pages"=>$total_pages));
	}
	public function load_page($array)
	{
		$this->load->view("lead_view",$array);
	}
	public function display_page($page)
	{
		$temp1=$this->session->userdata('name');
		$temp2=$this->session->userdata('start_date');
		$temp3=$this->session->userdata('end_date');
		if ($temp1==false) 
		{
			$this->session->set_userdata('name','');
		}
		if ($temp2==false) 
		{
			$this->session->set_userdata('start_date','');
		}
		if ($temp3==false) 
		{
			$this->session->set_userdata('end_date','');
		}
		$array=array(
			"page"=>$page,
			"name"=>$this->session->userdata('name'),
			"start_date"=>$this->session->userdata('start_date'),
			"end_date"=>$this->session->userdata('end_date')
			);
		$array1=$this->get_filter($array);
		echo json_encode($array1);
		// $this->load_page($array1);
	}
	public function filter()
	{
		$this->session->set_userdata('start_date',$this->input->post('start_date'));
		$this->session->set_userdata('name',$this->input->post('name'));
		$this->session->set_userdata('end_date',$this->input->post('end_date'));
		$array=array(
			"page"=>1,
			"name"=>$this->session->userdata('name'),
			"start_date"=>$this->session->userdata('start_date'),
			"end_date"=>$this->session->userdata('end_date')
			);
		$array1=$this->get_filter($array);
		echo json_encode($array1);
		// $this->load_page($array1);
	}
	public function get_filter($array)
	{
		$lead=new lead();
		$lead1=new lead();
		if(!empty($array['start_date'])&&!empty($array['end_date']))
		{
			$start_date=date("Y-m-d",strtotime($array['start_date']));
			$end_date=date("Y-m-d",strtotime($array['end_date']));
			$where="date(registered_datetime) between '".$start_date."' AND '".$end_date."'";
			$lead->where($where);
			$lead1->where($where);
			if(strlen(trim($array['name']))>1)
			{	
				$array2=explode(" ", ucwords(strtolower(trim($array['name']))));
				$first_name=$array2[0];
				$last_name=$array2[1];
				$lead->where("first_name",$first_name);
				$lead->where("last_name",$last_name);
				$lead1->where("first_name",$first_name);
				$lead1->where("last_name",$last_name);
			};
			$count=$lead1->count();
			$total_pages=ceil($count/15);
			$lead->limit(15,($array['page']-1)*15);
			$result=$lead->get()->all_to_array();
		}elseif (strlen(trim($array['name']))>1) 
		{
			$array2=explode(" ", ucwords(strtolower(trim($array['name']))));
			$first_name=$array2[0];
			$last_name=$array2[1];
			$lead->where("first_name",$first_name);
			$lead->where("last_name",$last_name);
			$lead1->where("first_name",$first_name);
			$lead1->where("last_name",$last_name);
			$count=$lead->count();
			$total_pages=ceil($count/15);
			$lead1->limit(15,($array['page']-1)*15);
			$result=$lead1->get()->all_to_array();
		}else
		{
			$lead->limit(15,($array['page']-1)*15);
			$result=$lead->get()->all_to_array();
			$count=$lead->count();
			$total_pages=ceil($count/15);
		}
		$array1=array(
				"total_pages"=>$total_pages,
				"result"=>$result);
		return $array1;
	}
	
}