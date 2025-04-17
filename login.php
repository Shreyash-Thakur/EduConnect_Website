<?php include 'includes/header.php'; ?>

<section class="py-5 bg-light text-center">
  <div class="container" style="max-width: 400px;">
    <h2 class="mb-4 text-primary">Login</h2>
    <form action="authenticate.php" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <hr>
    <div>
      <a href="google-login.php" class="btn btn-outline-danger w-100">
        <img src="images/google-icon.svg" alt="Google Icon" style="width:20px; margin-right: 8px;"> Login with Google
      </a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>