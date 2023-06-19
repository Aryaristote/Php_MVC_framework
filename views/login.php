<?php 

/** @var $model \App\models\User */

?>

<div>
    <h1 class="text-center">Login</h1><br><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="background-color:#e3f2fd; padding: 20px">
            <?php $form = \App\core\form\form::begin('', "post") ?>
                <?php echo $form->field($model, 'email') ?>
                <?php echo $form->field($model, 'password')->passwordField() ?>
                <div class="row" style="padding: 0 18px;">
                    <button type="submit" class="btn btn-primary" style="margin-right: 18px;">Submit</button>
                    <a href="/login">Login</a>
                </div>
            <?php \App\core\form\form::end() ?>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>