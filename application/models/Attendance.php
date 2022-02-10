<?php

class Attendance extends CI_Model
{
  public function checkStatus($id, $date)
  {
    $this->db->order_by('id', 'DESC');
    $res = $this->db->get_where('attendances', ['user_id' => $id, 'date' => $date])->row();
    if ($res) {
      return $res->type;
    }
    return false;
  }

  public function insert($data)
  {
    $this->db->insert('attendances', $data);
    $id = $this->db->insert_id();
    return $id;
  }

  public function getAttendance()
  {
    $this->db->select('CONCAT(employees.first_name, " ", employees.last_name) name, attendances.*');
    $this->db->from('attendances');
    $this->db->join('employees', 'employees.id = attendances.user_id');
    return $this->db->get()->result();
  }
}
