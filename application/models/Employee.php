<?php

class Employee extends CI_Model
{
  public function insert($data)
  {
    $this->db->insert('employees', $data);
    $id = $this->db->insert_id();
    $this->generateQrKey($data, $id);
    return $id;
  }

  private function generateQrKey($data, $id)
  {
    $string = $id . "-" . md5($data['first_name'] . $data['last_name'] . $data['first_name']);
    $this->update(['qr_code' => $string], $id);
  }

  public function getQrCode($id)
  {
    if ($id == "") return false;

    $res = $this->getEmployee($id, ['qr_code']);
    if (!empty($res)) return $res->qr_code;
    return false;
  }

  public function validateQrCode($qrCode)
  {
    if ($qrCode == "") return false;

    return $this->db->get_where('employees', ['qr_code' => $qrCode])->row();
  }


  public function update($data, $id)
  {
    $this->db->where('id', $id);
    $res = $this->db->update('employees', $data);
    return $res;
  }

  public function delete($id)
  {
    if ($id != "" && $this->getEmployee($id))
      return $this->db->delete('employees', array('id' => $id));
  }

  public function getEmployee($id, $fields = [])
  {
    if ($id == "") return false;

    if (!empty($fields)) {
      $this->db->select(implode(', ', $fields));
    }

    return $this->db->get_where('employees', ['id' => $id])->row();
  }

  public function getAllEmployees()
  {
    return $this->db->get('employees')->result();
  }
}
