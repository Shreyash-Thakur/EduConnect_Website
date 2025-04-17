<?php
$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");
$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
$programs = $pdo->query("SELECT * FROM programs")->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>

<div class="container py-5">
  <h2 class="mb-4 text-primary">📋 User List</h2>
  <table class="table table-bordered">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr></thead>
    <tbody>
      <?php foreach ($users as $u): ?>
      <tr>
        <td><?= $u['id'] ?></td>
        <td><?= $u['name'] ?></td>
        <td><?= $u['email'] ?></td>
        <td><?= ucfirst($u['role']) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h2 class="mt-5 mb-4 text-success">📚 Programs</h2>
  <table class="table table-bordered">
    <thead><tr><th>ID</th><th>Title</th><th>Mode</th><th>Location</th></tr></thead>
    <tbody>
      <?php foreach ($programs as $p): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['title'] ?></td>
        <td><?= ucfirst($p['mode']) ?></td>
        <td><?= $p['location'] ?? 'Online' ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
