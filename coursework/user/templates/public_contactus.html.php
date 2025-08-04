<div class="container mb-5" style="max-width: 600px;">
  <h2 class="mb-4">Contact Us</h2>

  <!-- Alert-->
  <div class="mt-3">
      <?php include '../system/include/alert.php'; ?>
  </div> 

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
    
    <button type="submit" class="btn btn-primary">Send Message</button>
  </form>
</div>

