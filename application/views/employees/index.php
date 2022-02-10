<?php
if ($this->session->flashdata('message')) : ?>
  <div class="alert alert-success" role="alert">
    <?= $this->session->flashdata("message") ?>
  </div>
<?php endif; ?>

<div class="d-flex justify-content-end mb-3">
  <a href="/employees/add" class="btn btn-primary">Add Employee</a>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Date Added</th>
      <th scope="col">Date Updated</th>
      <th scope="col">QR Code</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($employees as $employee) : ?>
      <tr>
        <th scope="row"><?= $employee->id ?></th>
        <td><?= ucfirst($employee->first_name) ?></td>
        <td><?= ucfirst($employee->last_name) ?></td>
        <td><?= $employee->email ?></td>
        <td><?= $employee->phone ?></td>
        <td><?= $employee->date_added ?></td>
        <td><?= $employee->date_updated ?></td>
        <td>
          <a href="javascript:;" onclick="window.open('/employees/qrcode/<?= $employee->id ?>','name','width=600,height=400')" class="btn btn-success btn-sm">View QR Code</a>
        </td>

        <td>
          <a href="/employees/edit/<?= $employee->id ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="/employees/delete/<?= $employee->id ?>" onclick="return confirm('Are you sure want to delete this employee?');" class="btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>