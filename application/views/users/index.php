<div class="d-flex justify-content-end mb-3">
  <a href="/users/register" class="btn btn-primary">Register New User</a>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) : ?>
      <tr>
        <th scope="row"><?= $user->id ?></th>
        <td><?= ucfirst($user->first_name) ?></td>
        <td><?= ucfirst($user->last_name) ?></td>
        <td><?= $user->email ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>