<html>

<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
</head>

<body>

    <div class="container">
        <div class="col-4 offset-4">
            <br><br>
            <div class="form-group">
               

                <?= form_open(base_url() . 'signup') ?>
                <h2 class="text-center">Signup</h2>
                <br>
                <?= validation_list_errors() ?>
                <br>
                <h5>Username</h5>
                <input type="text" name="username" value="<?= set_value('username') ?>" size="50" class="form-control">
            </div>
            <div class="form-group">
                <h5>Email Address</h5>
                <input type="text" name="email" value="<?= set_value('email') ?>" size="50" class="form-control">
            </div>
            <div class="form-group">
                <h5>Password</h5>
                <input type="password" name="password" value="<?= set_value('password') ?>" size="50" class="form-control">
            </div>
            <div class="form-group">
                <h5>Confirm Password</h5>
                <input type="password" name="passconf" value="<?= set_value('passconf') ?>" size="50" class="form-control">
            </div>
            <div class="form-group">
                
                <div><input type="submit" value="Submit" class="btn btn-primary btn-block"></div>
            </div>
            <div class="form-group">
                <br>
                <p> Already a user? <a href='login'> Login </a> </p>
            </div>
            <?= form_close() ?>

</body>

</html>