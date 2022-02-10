<?php

class User extends CI_Model
{
  public function insert($data)
  {
    $this->db->insert('users', $data);
    return $this->db->insert_id();
  }

  public function getAllUsers()
  {
    return $this->db->get('users')->result();
  }

  public function authenticate($email)
  {
    $res = $this->db->get_where('users', ['email' => $email])->row();

    if ($res && $res->status) {
      return $res;
    }
    return false;
  }
}
