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
        $table = 'tbl_todolist_riga';
        $id = $this->task_model->simpan($table, $data);
        // var_dump($a);
        // header('Access-Control-Allow-Origin: *');
        // header("Content-Type: application/json");

        $data = array($this->task_model->detail($id));
        ///var_dump($data);
        echo json_encode($data);
        
        // redirect(base_url('index.php/task/index'));
        // redirect(base_url('index.php/task/detail/' . $id));
    }

    public function detail(){
        // param ($id)
        $id = $this->input->post("id");
        $data = array($this->task_model->detail($id));
        // var_dump($data['task']);
        
        echo json_encode($data);
        // return json_encode($data);
    }

    public function ubah($id)
    {
        # code...
        $data['task'] = $this->task_model->detail($id);
        $this->load->view('edit_task', $data);
    }

    public function ubahSimpan()
    {
        # code...
        // param ($id)
        $table = 'tbl_todolist_riga';
        
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
        // echo "{}";
        // redirect(base_url('index.php/task/index'));
    }

    public function hapus()
    {
        # code... 
        // param ($id)
        $id = $this->input->post("id");
        $table = 'tbl_todolist_riga';
        
        $this->task_model->hapus($table, $id);
        echo "{}";
        // redirect(base_url('index.php/task/index'));
    }

}
