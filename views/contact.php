<?php
    /** @var $this \app\core\View */

use app\core\form\TextareaField;

    /** @var $model \app\core\form\ContactForm */
    $this->title = 'Contact Us';    
    $model = new \app\core\form\ContactForm();
?>

<h1>Contact Us!</h1>

<?php $form = \app\core\form\Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo new TextareaField($model, 'message') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>