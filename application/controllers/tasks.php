<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tasks extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);
	}
	public function index()
	{
		$this->load->model('task_model');
		$result=array("result"=>$this->task_model->display_task());
		$this->load->view('task_view',$result);
	}
	public function add_task()
	{
		$name=$this->input->post('name');
		$this->load->model('task_model');
		$id=$this->task_model->add_task($name);
	}
	public function edit_task($array)
	{
		$this->load->model('task_model');
		$this->task_model->edit_task($array);
	}
}