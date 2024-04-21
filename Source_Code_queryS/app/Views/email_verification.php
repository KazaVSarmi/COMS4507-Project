<h2>Verify your email</h2>
<p> A verification code has been sent to <?php echo $email; ?></p>

<?php echo form_open(base_url().'signup/verify_email');?>

<input type="text" name="email" value=<?php echo $email;?> readonly>
<p>Please enter the 6 digit code that you received</p>
<input type="text" name="verification_key" required="required">
<button type="submit" name="submit_button">Submit</button>
<?php echo form_close();?>