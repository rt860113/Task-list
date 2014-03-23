<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}
	public function index()
	{
		$this->load->model('note_model');
		$result=array("result"=>$this->note_model->display_note());
		$this->load->view('note_view',$result);
	}
	public function edit_note()
	{
		$this->load->model('note_model');
		var_dump($this->input->post());
		$array=array('description'=>$this->input->post('description'),
					'id'=>$this->input->post('id'));
		// var_dump($array);
		$this->note_model->edit_note($array);
		// redirect('/');
	}
	public function add_title()
	{
		if ($this->form_validation->run('note')==false) 
		{
			$this->session->set_flashdata('error',validation_errors());
			$data['error']=validation_errors();
			// redirect('/');
		}else
		{
			$this->load->model('note_model');
			$data['title']=$this->input->post('title');
			$data['id']=$this->note_model->add_title($this->input->post('title'));
			// $data['note']=$this->note_model->display_note();
			$data['error']='No error';
			
			// redirect('/');
		}
		echo json_encode($data);
	}
	public function delete_note($id)
	{
		$this->load->model('note_model');
		$this->note_model->delete_note($id);
		redirect('/');
	}

}