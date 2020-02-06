<?php
require_once APPROOT.'/views/inc/header.php';
?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <!-- Log In Form -->
        <div class="card card-outline-secondary mt-5">
            <div class="card-header">
                <h3 class="mb-0">Log In</h3>
                <p class="mt-2">Please fill the fields below to Login</p>
            </div>
            <div class="card-body">
                <form class="form" role="form" method="post" action="<?php URLROOT.'/users/login';?>">
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email<sup>*</sup></label>
                        <input type="text" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" id="email" placeholder="Email" name="email" value="<?php echo (!empty($data['email'])) ? $data['email'] : '';?>">
                        <?php echo (!empty($data['email_err'])) ? '<span class="invalid-feedback">'.$data['email_err'].'</span>' : '';?>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="password">Password<sup>*</sup></label>
                        <input type="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" id="password" placeholder="Password" name="password">
                        <?php echo (!empty($data['password_err'])) ? '<span class="invalid-feedback">'.$data['password_err'].'</span>' : '';?>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg float-right">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Log In Form -->
    </div>
</div>
<?php
require_once APPROOT.'/views/inc/footer.php';
?>
