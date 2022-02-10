<div class="row">
  <div class="col-6">
    <form method="post" action="<?php echo base_url(); ?>employees/add">
      <div class="mb-3">
        <label class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control">
        <span class="text-danger"><?php echo form_error('first_name'); ?></span>
      </div>
      <div class="mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control">
        <span class="text-danger"><?php echo form_error('last_name'); ?></span>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="text" name="email" class="form-control">
        <span class="text-danger"><?php echo form_error('email'); ?></span>
      </div>
      <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control">
        <span class="text-danger"><?php echo form_error('phone'); ?></span>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>