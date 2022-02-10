<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Endroid\QrCode\QrCode;

class Employees extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('user_id')) {
      redirect('users/login');
    }
    $this->load->library('form_validation');
    $this->load->library('encryption');
    $this->load->library('qrcode');
    $this->load->model('employee');
  }

  public function index()
  {
    $data['employees'] = $this->employee->getAllEmployees();
    $this->load->view('layouts/header', ['page_title' => 'Employees']);
    $this->load->view('employees/index', $data);
    $this->load->view('layouts/footer');
  }

  public function qrcode($id)
  {
    $employeeQrCode = $this->employee->getQRCode($id);
    $result = $this->qrcode->generate($employeeQrCode);
    header('Content-Type: ' . $result->getMimeType());
    echo $result->getString();
    exit;
  }

  public function add()
  {
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
      $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
      $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
      $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email|is_unique[employees.email]');

      if ($this->form_validation->run()) {
        $data = array(
          'first_name'  => $this->input->post('first_name'),
          'last_name'  => $this->input->post('last_name'),
          'email'  => $this->input->post('email'),
          'phone'  => $this->input->post('phone'),
        );
        $id = $this->employee->insert($data);
        if ($id > 0) {
          $this->session->set_flashdata('message', 'Successfully added new employee.');
          redirect('employees/index');
        }
      }
    }

    $this->load->view('layouts/header', ['page_title' => 'Add Employees']);
    $this->load->view('employees/add');
    $this->load->view('layouts/footer');
  }

  public function edit($id)
  {
    if ($id == "") redirect('employees/index');


    if ($this->input->server('REQUEST_METHOD') === 'POST') {
      $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
      $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
      $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');

      if ($this->form_validation->run()) {
        $data = array(
          'first_name'  => $this->input->post('first_name'),
          'last_name'  => $this->input->post('last_name'),
          'email'  => $this->input->post('email'),
          'phone'  => $this->input->post('phone'),
          'date_updated' => date('Y-m-d H:i:s')
        );
        $id = $this->employee->update($data, $id);
        if ($id > 0) {
          $this->session->set_flashdata('message', 'Successfully updated the employee.');
          redirect('employees/index');
        }
      }
    }
    $data['id'] = $id;
    $data['employee'] = $this->employee->getEmployee($id);
    $this->load->view('layouts/header', ['page_title' => 'Edit Employees']);
    $this->load->view('employees/edit', $data);
    $this->load->view('layouts/footer');
  }

  public function delete($id)
  {
    $res = $this->employee->delete($id);
    if ($res) {
      $this->session->set_flashdata('message', 'Successfully deleted employee.');
      redirect('employees/index');
    }
  }
}
