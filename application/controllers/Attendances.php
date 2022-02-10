<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendances extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('employee');
    $this->load->model('attendance');
  }

  public function index()
  {
    $this->load->view('attendances/index');
  }

  public function logs()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('users/login');
    }
    $data['attendances'] = $this->attendance->getAttendance();
    $this->load->view('layouts/header', ['page_title' => 'Attendance Log']);
    $this->load->view('attendances/logs', $data);
    $this->load->view('layouts/footer');
  }

  public function scan()
  {
    if (!$this->input->is_ajax_request()) {
      die('Invalid request');
    }
    $qrCode = $_POST['qrcode'];
    if ($qrCode == "") die('Invalid QR Code');

    $employee = $this->employee->validateQrCode($qrCode);

    if ($employee) {
      $date = date('Y-m-d');
      $time = date('H:i:s');
      $status = $this->attendance->checkStatus($employee->id, $date);

      if (!$status) {
        $type = 'in';
      } else {
        if ($status  == 'out') {
          echo json_encode([
            'status' => 'error',
            'message' => 'Already logout for today.'
          ]);
          exit();
        }

        $type = 'out';
      }
      $data = [
        'user_id' => $employee->id,
        'date' => $date,
        'time' => $time,
        'type' => $type
      ];
      $this->attendance->insert($data);
      echo json_encode([
        'status' => 'success',
        'message' => ($type == 'in' ? 'Time-in!' : 'Time-out!')
      ]);
      exit();
    } else {
      echo json_encode([
        'status' => 'error',
        'message' => 'Invalid QR Code, please try to scan again.'
      ]);
      exit();
    }

    return false;
  }
}
