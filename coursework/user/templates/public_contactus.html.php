<div class="container mb-5" style="max-width: 600px;">
  <h2 class="mb-4">Contact Us</h2>

  <form method="POST" action="contactus.php">
    <div class="mb-3">
      <label for="name" class="form-label">Your Name</label>
      <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Your Email</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="message" class="form-label">Message</label>
      <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
    </div>

  <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Your message has been sent successfully!</div>
  <?php elseif (isset($_GET['error'])): ?>
    <div class="alert alert-danger">Something went wrong. Please try again.</div>
  <?php endif; ?>

    <button type="submit" class="btn btn-primary">Send Message</button>
  </form>
</div>

