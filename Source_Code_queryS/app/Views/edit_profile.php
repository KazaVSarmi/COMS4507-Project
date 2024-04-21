<html>

<head>
    <title>Edit my profile details.</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
</head>

<div class="container">
<div class="col-4 offset-2">
    <br>
    <a href='user_home'><b>Home</b></a>
</div>
<div class="container">
    <div class="offset-3">
        <br><br>
        <div class="form-group">
            <h2 class="text-left">Edit my profile details.</h2>

            <?= validation_list_errors() ?>

            <?php echo form_open(base_url() . 'edit_profile/update'); ?>
        </div>
        <div class="form-group">

            <table>
                <br>

                <tr>
                    <td>
                        <b>Username: </b>
                    </td>
                    <td><?php echo $username ?></td>
                </tr>
                <tr>
                    <td>
                        <b>Email: </b>
                    </td>
                    <td><input type="text" name="email" value="<?php echo $email ?>"> </td>
                </tr>
                <!--  <tr>
                <td>
                    <b>Contact: </b>
                </td>
                <td><input type="tel" name="contact" value="" pattern="[0-9]{10}" maxlength="10"> </td>
            </tr>
            <tr> -->
                <td>
                    <br>
                    <h2 class="text-center">Reset Password</h2>
                    <br>
                </td>
                </tr>
                <tr>
                    <td>
                        <b>Old Password: </b>
                    </td>
                    <td><input type="password" name="oldpassword" value=""> </td>
                </tr>
                <tr>
                    <td>
                        <b>New Password: </b>
                    </td>
                    <td><input type="password" name="newpassword" value=""> </td>
                </tr>
                <tr>
                <tr>
                    <td>
                        <b>Confirm New Password: </b>
                    </td>
                    <td><input type="password" name="passconf" value=""> </td>
                </tr>
            </table>
        </div>
        <div class="container">
            <div class="offset-2">
                <div class="form-group">
                    <label class="float-centre form-check-label"> <input type="submit" value="Submit" class="btn btn-primary btn-block">
                </div>



                <?php echo form_close(); ?>
                
            </div>

</html>