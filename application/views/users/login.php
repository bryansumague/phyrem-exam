<div class="row">
  <div class="col-6">
    <?php
    if ($this->session->flashdata('invalid-login')) : ?>
      <div class="alert alert-danger" role="alert">
        <strong>Error!</strong>
        <?= $this->session->flashdata("invalid-login") ?>
      </div>
    <?php endif; ?>
    <form method="post" action="<?php echo base_url(); ?>users/authenticate">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="text" name="email" class="form-control">
        <span class="text-danger"><?php echo form_error('email'); ?></span>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
        <span class="text-danger"><?php echo form_error('password'); ?></span>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</div>