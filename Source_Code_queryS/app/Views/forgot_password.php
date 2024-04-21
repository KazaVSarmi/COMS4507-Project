<h2>Forgot password?</h2>
<p>Use this form to recover your account</p>
<?php echo form_open(base_url() . 'forgot_password/request_email'); ?>
<p>Enter the username of the account you want to recover</p>
<input type="text" name="username" value='' required="required">
<p>Enter the email that you used to register</p>
<input type="text" name="email" value='' required="required">
<button type="submit" name="submit_button">Submit</button>
<?php echo form_close(); ?>