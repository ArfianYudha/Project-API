<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Tasks extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('tasks_model');
    }

    public function index_post()
    {
        $data = $this->post();
        $success = $this->tasks_model->simpan($data);

        if ($success) {
            $this->response([
                'status' => $success,
                'message' => "Data berhasil ditambahkan.",
                'data' => $data
            ], 200);
        } else {
            $this->response([
                'status' => $success,
                'message' => "Data gagal ditambahkan."
            ], 400);
        }
    }

    public function index_delete()
    {
        $id_tasks = $this->get('id_tasks');

        if ($id_tasks) {
            $success = $this->tasks_model->hapus($id_tasks);

            if ($success) {
                $this->response([
                    'status' => true,
                    'message' => 'Data dengan ID=' . $id_tasks . ' telah dihapus.'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data dengan ID=' . $id_tasks . ' gagal dihapus.'
                ], 400);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'ID tidak terdefinisi.'
            ], 400);
        }
    }

    public function update_post()
    {
        $id_tasks = $this->get('id_tasks');
        $data = $this->post();

        $success = $this->tasks_model->ubah($id_tasks, $data);


        if ($success) {
            $dataBaru = $this->tasks_model->detail($id_tasks);
            $this->response([
                'status' => false,
                'message' => 'Data dengan ID= ' . $id_tasks . ' berhasil di ubah.',
                'data' => $dataBaru
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal di ubah.'
            ], 400);
        }
    }

    public function index_get()
    {
        $id_tasks = $this->get('id_tasks');

        if ($id_tasks) {
            $success = $this->tasks_model->detail($id_tasks);

            if ($success) {
                $this->response([
                    'status' => true,
                    'message' => 'Data dengan ID=' . $id_tasks . ' berhasil didapatkan.',
                    'data' => $success
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data dengan ID=' . $id_tasks . ' gagal didapatkan.'
                ], 400);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'ID tidak terdefinisi.'
            ], 400);
        }
    }

    public function list_get()
    {
        $page = $this->get('page');
        $per_page = $this->get('per-page');

        $data = $this->tasks_model->list_data($page, $per_page);

        $this->response([
            'status' => false,
            'message' => 'Sukses',
            'data' => $data,
            'meta' => ['page' => $page, 'per-page' => $per_page]
        ], 200);
    }
}
