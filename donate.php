<?php
include 'includes/header.php';
include 'includes/dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['donate'])) {
    $name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $message = $_POST['message'] ?? '';

    if ($name && $email && $amount) {
        try {
            $sql = "INSERT INTO donations (name, email, amount, message, donated_at) 
                    VALUES (:name, :email, :amount, :message, NOW())";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':message', $message);
            $stmt->execute();
            echo "<script>alert('Thank you for your donation!');</script>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<!-- Hero Section -->
<section class="text-white text-center py-5" style="background: linear-gradient(to right, #0f2027, #2c5364);">
  <div class="container">
    <h1 class="display-4 fw-bold">Support EduConnect</h1>
    <p class="lead fs-5 mt-2">Empower education, one donation at a time. Help bridge learning gaps for underprivileged children.</p>
  </div>
</section>

<!-- Why Donate -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-primary mb-4">Why Donate?</h2>
    <p class="fs-5">Your contribution directly impacts the lives of children who lack access to quality education. By donating to EduConnect, you're helping to:</p>
    <ul class="fs-5">
      <li>✔️ Provide learning materials and technology</li>
      <li>✔️ Support community learning centers</li>
      <li>✔️ Train volunteer educators</li>
      <li>✔️ Develop innovative educational programs</li>
      <li>✔️ Expand our reach to more communities</li>
    </ul>
  </div>
</section>

<!-- Fund Split -->
<section class="py-5">
  <div class="container">
    <h2 class="text-primary mb-4">Where Your Donation Goes</h2>
    <div class="row text-center">
      <div class="col-md-4">
        <h4 class="text-success">📚 40%</h4>
        <p>Educational Materials & Tech</p>
      </div>
      <div class="col-md-4">
        <h4 class="text-success">🏫 35%</h4>
        <p>Running Community Learning Centers</p>
      </div>
      <div class="col-md-4">
        <h4 class="text-success">👩‍🏫 25%</h4>
        <p>Volunteer Training & Coordination</p>
      </div>
    </div>
    <p class="mt-4 text-muted fs-6">*EduConnect maintains full transparency. Every rupee you donate is used to build a brighter, educated future.</p>
  </div>
</section>

<!-- Donation Form -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-primary mb-4">Make a Donation</h2>
    <form method="POST" action="">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Email Address</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Amount (₹)</label>
          <input type="number" name="amount" class="form-control" required>
        </div>
        <div class="col-md-12 mb-3">
          <label class="form-label">Message (Optional)</label>
          <textarea name="message" rows="4" class="form-control"></textarea>
        </div>
        <div class="col-md-12">
          <button type="submit" name="donate" class="btn btn-primary px-4">Donate Now</button>
        </div>
      </div>
    </form>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
