<p>Verification key matches. Update your password below: </p>
<?php echo form_open(base_url().'forgot_password/update_password'); ?>
<p>Your username is:</p>
<input type="text" name="username" value=<?php echo $username; ?> readonly>

<h5>Enter a new password</h5>
<input type="password" name="password" value="<?= set_value('password') ?>" size="50" required="required">

<h5>Confirm password</h5>
<input type="password" name="passconf" value="<?= set_value('passconf') ?>" size="50" required="required">
<br>
<button type="submit" name="submit_button">Submit</button>
<?php echo form_close(); ?>