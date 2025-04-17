<?php include 'includes/header.php'; ?>
<?php include 'includes/dbconnection.php'; ?>

<!-- Hero Section -->
<section class="text-white text-center py-5" style="background: linear-gradient(to right, #0f2027, #2c5364);">
  <div class="container">
    <h1 class="display-4 fw-bold">About EduConnect</h1>
    <p class="lead mt-3 fs-5">Connecting hearts and minds to educate every child, everywhere.</p>
  </div>
</section>

<!-- Our Story -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center text-primary mb-5">📖 Our Story</h2>
    <div class="row align-items-center">
      <div class="col-md-6 mb-4">
        <p class="fs-5">
          We were just a bunch of college students looking to add something meaningful to our resumes in our first year. 
          What started off as a casual search for social work turned into a mission we’re deeply passionate about. 
          While volunteering in nearby communities, we noticed a stark lack of access to education and digital resources. 
          That’s when EduConnect was born — not just as a project, but as a purpose.
        </p>
        <p class="fs-5">
          Our goal is to build a platform that connects dedicated volunteers to eager learners, using simple tools to make a massive difference. 
          We hope to someday bring equitable, inclusive education to kids who’ve been left out of the system for far too long.
        </p>
      </div>
      <div class="col-md-6 text-center">
        <img src="images/about/ghibli-us-group.png" class="img-fluid rounded shadow-sm" alt="Founders" style="max-width: 450px; height: auto;">
      </div>
    </div>
  </div>
</section>

<!-- Our Way to Teach -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center text-primary mb-5">💡 A New Way to Learn</h2>
    <div class="row align-items-center">
      <div class="col-md-6 text-center">
        <img src="images/about/volunteer-teaching.png" class="img-fluid rounded shadow-sm" alt="Volunteer Teaching" style="max-width: 450px; height: auto;">
      </div>
      <div class="col-md-6">
        <p class="fs-5">
          Our volunteers aim to teach math, science, art, and life skills to students in remote and rural areas — 
          all using just basic tools, compassion, and commitment. Each session we envision is built to be inclusive, 
          interactive, and designed to make learning fun — especially for kids who never had access to it before.
        </p>
        <p class="fs-5">
          From hand-drawn worksheets to mobile video classes, our creativity meets their curiosity. 
          We’re not just teaching subjects — we’re inspiring confidence and growth.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Why Education Matters -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center text-primary mb-5">📚 Why Education Matters</h2>
    <p class="fs-5 mb-3">
      🌍 According to UNESCO, <strong>over 244 million children and youth are out of school</strong> globally. 
      In India alone, millions of children in rural and underserved areas face a lack of teachers, infrastructure, and access to learning resources.
    </p>
    <p class="fs-5 mb-3">
      🎓 Education isn’t just about academics — it’s a <strong>fundamental right</strong> and the foundation for long-term well-being, 
      employability, and even better health outcomes. A child who receives just one more year of schooling sees a 
      <strong>10% increase in income</strong> later in life.
    </p>
    <p class="fs-5">
      💡 That’s the scale of the problem we’re working to solve — one program, one child, one community at a time.
    </p>
  </div>
</section>

<!-- Meet Our Volunteers -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center text-primary mb-5">🤝 Meet Our Volunteers</h2>
    <div class="row">
      <?php
      $query = "SELECT u.name, v.qualification, v.experience 
                FROM users u 
                INNER JOIN volunteer_profiles v ON u.id = v.user_id
                WHERE u.role = 'volunteer'
                ORDER BY u.created_at DESC 
                LIMIT 8";
      $stmt = $dbh->prepare($query);
      $stmt->execute();
      $volunteers = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if ($volunteers):
        foreach ($volunteers as $volunteer):
      ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title text-success"><?= htmlspecialchars($volunteer['name']) ?></h5>
              <p class="mb-2"><strong>Qualification:</strong> <?= htmlspecialchars($volunteer['qualification']) ?></p>
              <p class="mb-0"><strong>Experience:</strong> <?= htmlspecialchars($volunteer['experience']) ?> years</p>
            </div>
          </div>
        </div>
      <?php endforeach; else: ?>
        <p class="text-muted text-center">No volunteers found.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Impact Stats -->
<section class="py-5 text-center">
  <div class="container">
    <h2 class="text-primary mb-4">📊 Our Impact So Far</h2>
    <div class="row">
      <div class="col-md-3 mb-3">
        <h3 class="text-success">12,000+</h3>
        <p>Children Educated</p>
      </div>
      <div class="col-md-3 mb-3">
        <h3 class="text-success">900+</h3>
        <p>Active Volunteers</p>
      </div>
      <div class="col-md-3 mb-3">
        <h3 class="text-success">30+</h3>
        <p>Digital Centers</p>
      </div>
      <div class="col-md-3 mb-3">
        <h3 class="text-success">20 States</h3>
        <p>Across India</p>
      </div>
    </div>
  </div>
</section>

<!-- Join Us CTA -->
<section class="py-5 bg-dark text-white text-center">
  <div class="container">
    <h2 class="mb-4">Become a Part of Our Journey</h2>
    <p class="mb-4 fs-5">
      Whether you teach, donate, or just spread the word — you’re already part of the change. Let’s build something beautiful together.
    </p>
    <a href="register.php" class="btn btn-outline-light">Join the Movement</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
