<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tasks extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}
	public function index()
	{
		$this->load->model('task_model');
		$result=array("result"=>$this->task_model->display_task());
		$this->load->view('task_view',$result);
	}
	public function add_task()
	{
		$temp['name']=$this->input->post('name');
		if (!empty($temp['name'])) {
			$this->load->model('task_model');
			$temp['id']=$this->task_model->add_task($temp['name']);
			echo json_encode($temp);
		}
	}
	public function edit_task()
	{
		$temp['id']=$this->input->post('id');
		$temp['name']=$this->input->post('name');
		// var_dump($temp);
		if (empty($temp['name'])) 
		{
			
		}else
		{
			$this->load->model('task_model');
			$this->task_model->edit_task($this->input->post());
			echo json_encode($temp);
		}
	}
	public function delete()
	{
		$temp=$this->input->post('id');
		if (!empty($temp)) 
		{
			$this->load->model('task_model');
			$this->task_model->delete($temp);
		}
	}
}