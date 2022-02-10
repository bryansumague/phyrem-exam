<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Type</th>
  </thead>
  <tbody>
    <?php foreach ($attendances as $attendance) : ?>
      <tr>
        <td><?= $attendance->name ?></td>
        <td><?= $attendance->date ?></td>
        <td><?= $attendance->time ?></td>
        <td><?= strtoupper($attendance->type) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>