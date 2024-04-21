<!DOCTYPE html>
<html lang="en">

<head>
    <title>Upload Form</title>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>
<div class="container">
<div class="col-4 offset-2">
    <br>
    <a href='https://infs3202-60a6cb75.uqcloud.net/queryS/user_home'><b>Home</b></a>
</div>
<br>
<body>

    <?= form_open_multipart(base_url() . 'upload/upload_form') ?>
    <label for="title">File Name</label>
    <input type="text" name="title" size="20">
    <br><br>
    <input type="file" name="userfile[]" multiple="multiple" size="20">
    <br><br>
    <input type="submit" value="Upload">
    <?= form_close(); ?>

    <form action="<?=base_url() . 'upload/drag_drop_upload'?>",class='dropzone'></form>

</body>

</html>