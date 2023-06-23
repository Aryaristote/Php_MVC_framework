<?php 

/** @var $this \App\core\view */
/** @var $model \App\models\ContactForm */
$this->title = 'Contact';

use App\core\form\TextareaField;

?>


<div>
    <h1>Contact Us</h1><br><br>

    <?php $form = \App\core\form\Form::begin('', 'post') ?>
        <?php echo $form->field($model, 'subject') ?>
        <?php echo $form->field($model, 'email') ?>
        <?php echo new TextareaField($model, 'body') ?>
        <button type="submit" class="btn btn-primary">Submit</button>
    <?php $form = \App\core\form\Form::end() ?>
</div>