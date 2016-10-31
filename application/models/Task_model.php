<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function simpan($table,$data){
		$this->db->insert($table,$data);
        $insert_id = $this->db->insert_id();
        // var_dump($insert_id);
        return $insert_id;
	}

    public function hapus($table,$id){
		$this->db->where('id',$id);
		$this->db->delete($table);
	}

	public function view(){
		$query = $this->db->query("SELECT * FROM tbl_syahriga ORDER BY id DESC");
		return $query->result_array();
	}

    public function detail($id){
		$query = $this->db->query("SELECT * FROM tbl_syahriga WHERE id =" . $id);
		return $query->result_array();
	}

    public function ubah($table,$data, $id){
		  $this->db->where('id', $id);
            $this->db->update($table, $data);
	}

}