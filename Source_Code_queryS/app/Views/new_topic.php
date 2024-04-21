
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
</head>

<body>
    <div class="form-group">
        <?php echo form_open(base_url() . 'add_new_topic'); ?>
        <input type="text" placeholder="Enter a new topic title and click the button beside" name="new_topic_title" size="50">
        <input type="submit" name="new_topic_button" value="Add new topic" size="50">
        <?php echo form_close(); ?>
    </div>
            
    <!-- list of topics displayed here -->
    <h5>Topics list</h5>
    <p>Click the button beside each topic name to see the posts related to it.</p>
    <div class="form-group">
        <table>
            <tr>
                <?php foreach($topics_list as $topic)
                {
                    $hidden = ['topic_name'=>$topic->name, 'topic_id'=>$topic->id];
                    echo form_open(base_url() . 'view_posts', '', $hidden);
                    echo '<td>';
                    echo '<input type="submit" name="view_posts_button" value="'. $topic->name.'"';
                    echo '</td>';
                    echo form_close();
                } ?>
            </tr>
        </table>
    </div>
 
</body>

</html>