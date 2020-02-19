<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Login</h2>
            <p>Please fill out your credentials</p>
            <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input name="email" type="email" class="form-control form-control-lg <?php echo (!empty($data['email_err']) ? 'border border-danger' : ''); ?>" value="<?php echo $data['email']; ?>">
                    <span class="text-danger"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input name="password" type="password" class="form-control form-control-lg <?php echo (!empty($data['password_err']) ? 'border border-danger' : ''); ?>" value="<?php echo $data['password']; ?>">
                    <span class="text-danger"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-block btn-success">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-block btn-light">No account? Register</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>