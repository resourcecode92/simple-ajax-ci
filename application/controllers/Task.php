<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('task_model');
    }

    public function index()
    {
        $data['tasks'] = $this->task_model->view();
        $this->load->view('tasks', $data);
    }

    public function simpan() {
        $task = $this->input->post('task');
        $data = array(
            'task' => $task,
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
        );
        $table = 'tbl_syahriga';
        $id = $this->task_model->simpan($table, $data);

        $data = array($this->task_model->detail($id));

        echo json_encode($data);
    }

    public function detail(){
        // param ($id)
        $id = $this->input->post("id");
        $data = array($this->task_model->detail($id));
        
        echo json_encode($data);
    }

    public function ubah($id)
    {
        # code...
        $data['task'] = $this->task_model->detail($id);
        $this->load->view('edit_task', $data);
    }

    public function ubahSimpan()
    {
        // param ($id)
        $table = 'tbl_syahriga';
        
        $id = $this->input->post("id");
        $task = $this->input->post('task');
        $data = array(
            'task' => $task,
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
        );
        
        $this->task_model->ubah($table, $data, $id);

        $data = array($this->task_model->detail($id));
        
        echo json_encode($data);
    }

    public function hapus()
    {
        # code... 
        // param ($id)
        $id = $this->input->post("id");
        $table = 'tbl_syahriga';
        
        $this->task_model->hapus($table, $id);
        echo "{}";
    }

}
