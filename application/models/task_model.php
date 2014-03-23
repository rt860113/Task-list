<?php
	/**
	*  Model
	*/
	class task_model extends CI_Model
	{
		public function add_task($value)
		{
			$query="INSERT INTO tasks (name,created_at)Values (?,?)";
			$array=array($value,date("Y-m-d,H:i:s"));
			$this->db->query($query,$array);
			return $this->db->insert_id;
		}
		public function edit_task($value)
		{
			$query="UPDATE tasks SET name=? updated_at=? WHERE id=?";
			$array=array($value['name'],date("Y-m-d,H:i:s"),$value['id']);
			$this->db->query($query,$array);
		}
		public function display_task()
		{
			$query="SELECT name FROM tasks";
			return $this->db->query($query)->result_row();
		}
	}
?>