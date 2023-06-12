<div>
    <h1>Create new Account</h1><br><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="background-color:#e3f2fd; padding: 20px">
            <?php $form = \App\core\form\form::begin('', "post") ?>
                <div class="row">
                    <div class="col-md-6"><?php echo $form->field($model, 'firstname') ?></div>
                    <div class="col-md-6"><?php echo $form->field($model, 'lastname') ?></div>
                </div>
                <?php echo $form->field($model, 'email') ?>
                <?php echo $form->field($model, 'password')->passwordField() ?>
                <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
                <div class="row" style="padding: 0 18px;">
                    <button type="submit" class="btn btn-primary" style="margin-right: 18px;">Submit</button>
                    <a href="/login">Login</a>
                </div>
            <?php \App\core\form\form::end() ?>
            <!-- <form action="" method="post">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input type="text" name="firstname" value="<?php echo $model->firstname ?>"
                            class="form-control <?php echo $model->hasError('firstname') ? 'is-invalid' : '' ?>" 
                            placeholder="Your first name"
                            
                        >
                        <div class="invalid-feedback">
                            <?php echo $model->getFirstError('firstname') ?>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input type="text" name="lastname" class="form-control" placeholder="Your last name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Your email address">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Your Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control" placeholder="Your Password">
                </div>
                <div class="row" style="padding: 0 18px;">
                    <button type="submit" class="btn btn-primary" style="margin-right: 18px;">Submit</button>
                    <a href="/login">Login</a>
                </div>
            </form> -->
        </div>
        <div class="col-md-3"></div>
    </div>
</div>