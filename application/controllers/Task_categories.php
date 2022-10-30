<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Task_categories extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('taskcategories_model');
    }

    public function index_post()
    {
        $data = $this->post();
        $success = $this->taskcategories_model->simpan($data);

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
        $id_categories = $this->get('id_categories');

        if ($id_categories) {
            $success = $this->taskcategories_model->hapus($id_categories);

            if ($success) {
                $this->response([
                    'status' => true,
                    'message' => 'Data dengan ID=' . $id_categories . ' telah dihapus.'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data dengan ID=' . $id_categories . ' gagal dihapus.'
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
        $id_categories = $this->get('id_categories');
        $data = $this->post();

        $success = $this->taskcategories_model->ubah($id_categories, $data);


        if ($success) {
            $dataBaru = $this->taskcategories_model->detail($id_categories);
            $this->response([
                'status' => false,
                'message' => 'Data dengan ID= ' . $id_categories . ' berhasil di ubah.',
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
        $id_categories = $this->get('id_categories');

        if ($id_categories) {
            $success = $this->taskcategories_model->detail($id_categories);

            if ($success) {
                $this->response([
                    'status' => true,
                    'message' => 'Data dengan ID=' . $id_categories . ' berhasil didapatkan.',
                    'data' => $success
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data dengan ID=' . $id_categories . ' gagal didapatkan.'
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

        $data = $this->taskcategories_model->list_data($page, $per_page);

        $this->response([
            'status' => false,
            'message' => 'Sukses',
            'data' => $data,
            'meta' => ['page' => $page, 'per-page' => $per_page]
        ], 200);
    }
}
