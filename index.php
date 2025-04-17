<?php
session_start();
include 'includes/header.php';
?>

<!-- HERO SECTION -->
<section class="bg-gradient-primary text-white text-center py-5">
  <div class="container">
    <h1 class="display-4 fw-bold">Bridging the Gap in Education</h1>
    <p class="lead">Help underprivileged children learn and grow with the support of volunteers from across India.</p>
    
    <?php if (!isset($_SESSION['user_id'])): ?>
      <a href="register.php" class="btn btn-light me-2">Become a Volunteer</a>
      <a href="donate.php" class="btn btn-outline-light">Make a Donation</a>
    <?php endif; ?>
  </div>
</section>

<!-- WHO WE ARE -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center text-primary mb-4">Who We Are</h2>
    <p class="text-center mb-5">EduConnect is a volunteer-powered initiative to educate and uplift children from underserved communities across India. With a strong network of students, mentors, and community leaders, we deliver learning where it's needed most.</p>
    <div class="row text-center">
      <div class="col-md-3">
        <h3 class="text-success">12,000+</h3>
        <p>Students Reached</p>
      </div>
      <div class="col-md-3">
        <h3 class="text-success">900+</h3>
        <p>Volunteers Nationwide</p>
      </div>
      <div class="col-md-3">
        <h3 class="text-success">50+</h3>
        <p>Learning Centers</p>
      </div>
      <div class="col-md-3">
        <h3 class="text-success">20 States</h3>
        <p>Pan-India Presence</p>
      </div>
    </div>
  </div>
</section>

<!-- PROGRAM HIGHLIGHTS -->
<section class="py-5 text-white" style="background: linear-gradient(to right, #0f2027, #2c5364);">
  <div class="container">
    <h2 class="text-center mb-4">📚 Our Key Programs</h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="p-4 bg-dark rounded shadow-sm h-100">
          <h5 class="text-info">Live Online Tutoring</h5>
          <p>Students receive individual or small-group sessions with trained volunteer educators using digital tools.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="p-4 bg-dark rounded shadow-sm h-100">
          <h5 class="text-info">Community Learning Centers</h5>
          <p>Our offline hubs provide devices, WiFi, books, and guided support for local learners.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="p-4 bg-dark rounded shadow-sm h-100">
          <h5 class="text-info">Skill Development Tracks</h5>
          <p>From digital literacy to soft skills, we offer career-readiness training tailored to future opportunities.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center text-primary mb-4">Voices of Change</h2>
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="bg-white border rounded p-3 shadow-sm">
          <p>"Thanks to EduConnect, I got selected into college with a scholarship. I couldn’t have done it without my mentor."</p>
          <h6 class="mb-0"><strong>Ritika, 17</strong> – Jharkhand</h6>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="bg-white border rounded p-3 shadow-sm">
          <p>"Volunteering here helped me grow as a leader. Teaching kids from remote areas was incredibly rewarding."</p>
          <h6 class="mb-0"><strong>Aditya, 21</strong> – Volunteer from Mumbai</h6>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CALL TO ACTION -->
<?php if (!isset($_SESSION['user_id'])): ?>
<section class="py-5 text-center bg-dark text-white">
  <div class="container">
    <h2 class="mb-3">You Can Be the Reason a Child Smiles Today.</h2>
    <p class="mb-4">Whether you donate, teach, or spread the word — you're changing lives with EduConnect.</p>
    <a href="register.php" class="btn btn-outline-light me-2">Join Us</a>
    <a href="donate.php" class="btn btn-light text-dark">Donate Now</a>
  </div>
</section>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
