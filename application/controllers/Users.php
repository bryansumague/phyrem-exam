<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('encryption');
    $this->load->model('user');
  }

  public function index()
  {
    $data['users'] = $this->user->getAllUsers();
    $this->load->view('layouts/header', ['page_title' => 'Users']);
    $this->load->view('users/index', $data);
    $this->load->view('layouts/footer');
  }

  public function register()
  {
    $this->load->view('layouts/header', ['page_title' => 'User Registration']);
    $this->load->view('users/register');
    $this->load->view('layouts/footer');
  }

  public function proccess_registration()
  {
    $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    $this->form_validation->set_rules('confirm_password', 'Password', 'required|matches[password]');

    if ($this->form_validation->run()) {
      $encrypted_password = $this->encryption->encrypt($this->input->post('password'));
      $data = array(
        'first_name'  => $this->input->post('first_name'),
        'last_name'  => $this->input->post('last_name'),
        'email'  => $this->input->post('email'),
        'password' => $encrypted_password,
      );
      $id = $this->user->insert($data);
      if ($id > 0) {
        $this->session->set_flashdata('message', 'Successfully registerd please try logging in.');
        redirect('users/login');
      }
    } else {
      $this->register();
    }
  }

  public function login()
  {
    if ($this->session->userdata('user_id')) {
      redirect('users/index');
    }
    $this->load->view('layouts/header', ['page_title' => 'Login']);
    $this->load->view('users/login');
    $this->load->view('layouts/footer');
  }

  public function authenticate()
  {
    $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

    if ($this->form_validation->run()) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $user = $this->user->authenticate($email, $password);

      if ($user && $password == $this->encryption->decrypt($user->password)) {
        $this->session->set_userdata(['user_id' => $user->id, 'name' => $user->first_name . ' ' . $user->last_name]);
        redirect('employees/index');
      }

      $this->session->set_flashdata('invalid-login', 'Invalid Email / Password');
      redirect('users/login');
    } else {
      $this->login();
    }
  }

  public function logout()
  {
    $user_data = $this->session->all_userdata();
    foreach ($user_data as $key => $value) {
      if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
        $this->session->unset_userdata($key);
      }
    }
    $this->session->sess_destroy();
    redirect('users/login');
  }
}
