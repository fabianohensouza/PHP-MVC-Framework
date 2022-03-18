<?php
/** @var $model \app\models\User */
?>

<h1>Sign In</h1>

<?php $form = app\core\form\Form::begin('post') ?>
    <?php echo $form->field($model, 'email')->typeField('TYPE_EMAIL') ?>
    <?php echo $form->field($model, 'password')->typeField('TYPE_PASSWORD') ?>
<?php echo '<button type="submit" class="btn btn-primary">Submit</button>' ?>

<?php app\core\form\Form::end() ?>