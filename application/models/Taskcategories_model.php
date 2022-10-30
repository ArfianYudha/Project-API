<?php
class Taskcategories_model extends CI_Model
{
    public $name;

    public function simpan($data)
    {
        $this->db->insert('task_categories', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah($id_categories, $data)
    {
        $this->db->where('id_categories', $id_categories);
        $this->db->update('task_categories', $data);
        return $this->db->affected_rows() ? true : false;
    }

    public function hapus($id_categories)
    {
        $this->db->delete('task_categories', ['id_categories' => $id_categories]);
        return $this->db->affected_rows() ? true : false;
    }

    public function detail($id_categories)
    {
        $this->db->select('*');
        $this->db->from('task_categories');
        $this->db->where('id_categories', $id_categories);

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
        $this->db->from('task_categories');
        $this->db->limit($per_page, $page);

        $get = $this->db->get();
        if ($get->num_rows() != 0) {
            return $get->result();
        } else {
            return [];
        }
    }
}
