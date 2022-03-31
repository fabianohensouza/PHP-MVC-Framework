<?php
    /** @var $this \app\core\View */
    $this->title = 'Contact Us';    
?>

<h1>Contact Us!</h1>

<form action="" method="post">
  <div class="mb-3">
    <label>Subject</label>
    <input type="text" name="subject" class="form-control">
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control">
  </div>
  <div class="mb-3">
    <label>Message</label>
    <textarea type="message" name="message" class="form-control"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>