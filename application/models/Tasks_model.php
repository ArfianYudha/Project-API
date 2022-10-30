<?php
class Tasks_model extends CI_Model
{
    public $category_id;
    public $tittle;
    public $description;
    public $start_date;
    public $finish_date;
    public $status;
    public $doc_url;

    public function simpan($data)
    {
        $this->db->insert('tasks', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah($id_tasks, $data)
    {
        $this->db->where('id_tasks', $id_tasks);
        $this->db->update('tasks', $data);
        return $this->db->affected_rows() ? true : false;
    }

    public function hapus($id_tasks)
    {
        $this->db->delete('tasks', ['id_tasks' => $id_tasks]);
        return $this->db->affected_rows() ? true : false;
    }

    public function detail($id_tasks)
    {
        $this->db->select('*');
        $this->db->from('tasks');
        $this->db->where('id_tasks', $id_tasks);

        $get = $this->db->get();
        if ($get->num_rows() != 0) {
            return $get->row_object();
        } else {
            return [];
        }
    }

    public function list_data($page, $per_page)
    {
        $this->db->select('*');
        $this->db->from('tasks');
        $this->db->limit($per_page, $page);

        $get = $this->db->get();
        if ($get->num_rows() != 0) {
            return $get->result();
        } else {
            return [];
        }
    }
}
