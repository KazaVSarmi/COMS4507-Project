<html>

<head>
    <title>My Profile</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
</head>


<body>
<div class="container">
<div class="col-4 offset-2">
    <br>
    <a href='user_home'><b>Home</b></a>
</div>
<div class="container">
        <div class="col-4 offset-4">
            <br><br><br><br>
            
            <div class="form-group">
<h3>Profile details</h3>
</div>
<div class="form-group">
    <table>
        <tr>
            <td>
                <b>Username: </b>
            </td>
            <td><?php echo $username ?></td>
        </tr>
</div>
        <div class="form-group">
        <tr>
            <td>
                <b>Email: </b>
            </td>
            <td><?php echo $email ?></td>
        </tr>
    </table>
    </div>
    <div class="form-group">
    <?php echo form_open(base_url().'edit_profile'); ?>
    <button type="submit" class="btn btn-primary btn-block">Edit my profile</button>
    <?php echo form_close(); ?>
    </div>
    
    
</body>

</html>