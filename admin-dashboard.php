<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  die("Unauthorized access.");
}

$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");

// Fetch data
$users = $pdo->query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll();
$programs = $pdo->query("SELECT * FROM programs ORDER BY created_at DESC")->fetchAll();
$donations = $pdo->query("SELECT * FROM donations ORDER BY donated_at DESC")->fetchAll();
?>

<?php include 'includes/header.php'; ?>

<div class="container py-5">
  <h2 class="mb-4">🛠 Admin Control Panel</h2>

  <h4 class="mt-4 text-primary">👥 Users</h4>
  <table class="table table-bordered">
    <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Registered</th></tr></thead>
    <tbody>
      <?php foreach ($users as $u): ?>
        <tr>
          <td><?= $u['name'] ?></td>
          <td><?= $u['email'] ?></td>
          <td><?= ucfirst($u['role']) ?></td>
          <td><?= $u['created_at'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h4 class="mt-4 text-success">📚 Programs</h4>
  <table class="table table-bordered">
    <thead><tr><th>Title</th><th>Date</th><th>Created By</th><th>Capacity</th></tr></thead>
    <tbody>
      <?php foreach ($programs as $p): ?>
        <tr>
          <td><?= $p['title'] ?></td>
          <td><?= $p['date'] ?></td>
          <td><?= $p['created_by'] ?></td>
          <td><?= $p['capacity'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h4 class="mt-4 text-warning">💰 Donations</h4>
  <table class="table table-bordered">
    <thead><tr><th>Donor</th><th>Email</th><th>Amount</th><th>Date</th></tr></thead>
    <tbody>
      <?php foreach ($donations as $d): ?>
        <tr>
          <td><?= $d['name'] ?></td>
          <td><?= $d['email'] ?></td>
          <td>₹<?= $d['amount'] ?></td>
          <td><?= $d['donated_at'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
