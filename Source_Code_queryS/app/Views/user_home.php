<html>

<head>
    <title>QueryS</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

    <!-- autocomplete -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() 
        {
            $("#Keyword").autocomplete({source: "user_home/autocomplete"});
        });
    </script>

    <!-- google translate functionality -->
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() 
        {
            new google.translate.TranslateElement({
            pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>
    <style>
        td {
            border: 1px solid black;
            border-radius: 50px;
        }
    </style>
</head>

<body>


    <div class="form-group">
        <!-- button to view profile -->
        <div>
            <?php echo form_open(base_url() . 'user_profile'); ?>
            <input type="submit" name="profile_button" value="View Profile" size="50" style="text-align:right">
            <?php echo form_close(); ?>
        </div>

        <!-- button to logout -->
        <div class="form-group">
            <?php echo form_open(base_url() . 'logout'); ?>
            <input type="submit" name="logout_button" value="Logout" size="50">
            <?php echo form_close(); ?>
        </div>

        <!-- link to upload files -->
        <div class="form-group">
            <a href='upload/upload_form'><b>Upload</b></a>
            <!--?php echo form_open(base_url() . 'upload/upload_form'); ?-->
            <!--?php return redirect('upload/upload_form'); ?-->
            <!--?php echo form_close(); ?-->
        </div>

        <!-- Search bar -->
        <div class="form-group">
            <?php echo form_open(base_url() . 'search_post'); ?>
            <input type="text" id="Keyword" placeholder="Keyword.." name="query_post_heading" size="50">
            <input type="submit" name="search_button" value="search" size="50">
            <?php echo form_close(); ?>
        </div>

        <!-- google translate test -->
        <div id="google_translate_element"></div>

        <!-- Topics -->
        <div class="form-group">
            <?php echo form_open(base_url() . 'new_topic'); ?>
            <input type="submit" name="show_topics_button" value="Show Topics" size="50">
            <?php echo form_close(); ?>
        </div>

        <!--    Google Translate-->
        <!--script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->

        <!-- <input type="submit" name="Upload_form_button" value="Upload" size="50"> -->



</body>

</html>
<!-- <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">

<ul id="myMenu">
  <li><a href="#">HTML</a></li>
  <li><a href="#">CSS</a></li>
  <li><a href="#">JavaScript</a></li>
  <li><a href="#">PHP</a></li>
  <li><a href="#">Python</a></li>
  <li><a href="#">jQuery</a></li>
  <li><a href="#">SQL</a></li>
  <li><a href="#">Bootstrap</a></li>
  <li><a href="#">Node.js</a></li>
</ul> -->