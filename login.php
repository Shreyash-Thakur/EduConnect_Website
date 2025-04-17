<?php include 'includes/header.php'; ?>

<div class="container py-5">
  <h2 class="text-center mb-4 fw-bold">Login</h2>

  <form action="authenticate.php" method="POST" class="mx-auto" style="max-width: 400px;">
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" id="email" class="form-control" required />
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" id="password" class="form-control" required />
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-dark">Login</button>
    </div>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
