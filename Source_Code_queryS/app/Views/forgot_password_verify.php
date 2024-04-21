<p>Enter the 6 digit verification code that you received. </p>
<?php echo form_open(base_url().'forgot_password/verify_code'); ?>
<p>You requested a code for the username:</p>
<input type="text" name="username" value=<?php echo $username; ?> readonly>
<input type="text" name="verification_key" value='' required="required">
<button type="submit" name="submit_button">Submit</button>
<?php echo form_close(); ?>