<html>

<head>
    <title>QueryS</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
</head>

<body>
    <script>
        // Show select image using file input.
        function readURL(input) {
            $('#default_img').show();
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#select')
                        .attr('src', e.target.result)
                        .width(300)
                        .height(200);

                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    <div class="container">
        <div class="col-4 offset-4">
             
            <br><br><br><br>
            <?php echo form_open(base_url() . 'login/verify_login'); ?>
            
            <h2 class="text-center">Login</h2>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" required="required" name="username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" required="required" name="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </div>
            <div class="form-group">
                <label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
                <?php echo form_close(); ?>
            </div>
            <div class="form-group">
            <label class="float-right form-check-label"><p>Not a user? <a href='signup'> Register </a> </p>
            </div>
           <div>
            <a href="https://infs3202-60a6cb75.uqcloud.net/queryS/forgot_password" class=float-left>Forgot Password?</a>
           </div>
        </div>



</html>