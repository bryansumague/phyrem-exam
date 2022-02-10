<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Attendance Monitoring System</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/styles/main.css">
</head>

<body>
  <div id="header-wrapper">
    <div class="container">
      <div class="row justify-content-between ">
        <div class="col-4 align-self-center">
          <a href="/" class="text-logo">Attendance Monitoring System</a>
        </div>
        <div class="col-4">
          <?php if ($this->session->userdata('user_id')) : ?>
            <ul class="nav-menu d-flex">
              <li><a href="/employees">Employees</a></li>
              <li><a href="/users">Users</a></li>
              <li><a href="/attendances/logs">Logs</a></li>
              <li><a href="/users/logout" class="logout-btn">Logout</a></li>
              <li><a href="/attendances" class="attendance-link">Attendance</a></li>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <?php if (isset($page_title) && $page_title != "") : ?>
      <div class="mt-5 border-bottom border-2 mb-5">
        <h3 class="page-title"><?= $page_title ?></h3>
      </div>
    <?php endif; ?>