<?php
/** @var $model \app\models\User */
?>

<h1>Sign Up</h1>

<?php $form = app\core\form\Form::begin('post') ?>

<div class="row">
    <div class="col">
        <?php echo $form->field($model, 'firstname') ?>
    </div>
    <div class="col">
        <?php echo $form->field($model, 'lastname') ?>
    </div>
</div>
<?php echo $form->field($model, 'email')->typeField('TYPE_EMAIL') ?>
<?php echo $form->field($model, 'password')->typeField('TYPE_PASSWORD') ?>
<?php echo $form->field($model, 'passwordConfirm')->typeField('TYPE_PASSWORD') ?>
<?php echo '<button type="submit" class="btn btn-primary">Submit</button>' ?>

<?php app\core\form\Form::end() ?>