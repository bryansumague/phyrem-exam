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
  <div class="container">
    <?php if (isset($page_title) && $page_title != "") : ?>
      <div class="mt-5 border-bottom border-2 mb-5">
        <h3 class="page-title"><?= $page_title ?></h3>
      </div>
    <?php endif; ?>
    <div class="d-flex flex-column align-items-center">
      <div id="clock" class="clock" onload="showTime()"></div>
      <div>
        <div id="qr-reader" style="width:500px"></div>
        <div id="qr-reader-results"></div>
      </div>
      <div>
        <div id="message-box"></div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script src="<?php echo base_url(); ?>/public/scripts/clock.js"></script>
  <script src="<?php echo base_url(); ?>/public/scripts/html5-qrcode.min.js"></script>
  <script src="<?php echo base_url(); ?>/public/scripts/main.js"></script>
</body>

</html>