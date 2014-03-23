<?php
	/**
	*  model
	*/
	class Note_model extends CI_model
	{
		
		public function add_title($value)
		{
			$query="INSERT INTO notes (title,created_at) VALUES (?,?)";
			$array=array($value,date('Y-m-d,H:i:s'));
			$this->db->query($query,$array);
			return $this->db->insert_id();
		}
		public function display_note()
		{
			$query="SELECT id,title,description FROM notes";
			return $this->db->query($query)->result_array();
		}
		public function edit_note($value)
		{
			$query="UPDATE notes SET description=? WHERE id=?";
			$array=array($value['description'],$value['id']);
			$this->db->query($query,$array);

		}
		public function delete_note($id)
		{
			$query="DELETE FROM notes WHERE id=?";
			$this->db->query($query,$id);
		}
	}
?>