<h1>Sign Up</h1>

<?php

use app\core\form\Form;

$form = Form::begin('post'); 
 
 ?>
<?php $form = \app\core\form\Form::begin('post') ?>

    <?php echo $form->field($model, 'firstname') ?>
    <?php echo $form->field($model, 'lastname') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password') ?>
    <?php echo $form->field($model, 'passwordConfirm') ?>

    <button type="submit" class="btn btn-primary">Submit</button>

<?php $form = \app\core\form\Form::end() ?>

<!--
<form action="" method="post">
  <div class="row">
    <div class="col">
      <div class="mb-3">
        <label>First Name</label>
        <input type="text" name="firstname" class="form-control">
      </div>
    </div>
    <div class="col">
      <div class="mb-3">
        <label>Last Name</label>
        <input type="text" name="lastname" class="form-control">
      </div>
    </div>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control">
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control">
  </div>
  <div class="mb-3">
    <label>Confirm Password</label>
    <input type="password" name="passwordConfirm" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
-->