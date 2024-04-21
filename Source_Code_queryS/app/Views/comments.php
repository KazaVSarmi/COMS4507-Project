<html>

<head>
    <!-- google translate functionality -->
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>
</head>

<body>

    <!-- Display a google translate button -->
    <div id=google_translate_element></div>
    <br>

    <!-- Display the post heading -->
    <?php echo $post_heading; ?>
    <br>

    <!-- Display the comments under the selected post -->
    <div class="form-group">
        <table>
            <?php
            for($i = 0; $i < count($comments_list); $i++)
            {
                echo '<tr>';
                echo '<td>' . $users_list[$i] . "</td>";
                echo '<td>' . $comments_list[$i]->content . "</td>";
                echo '<td>' . $timestamps_list[$i] . "</td>";
                echo '<td>';
                $hidden = ['comment_id' => $comments_list[$i]->id, 'post_heading'=>$post_heading, 'post_id'=>$post_id];
                echo form_open(base_url() . 'like_comment', '', $hidden);
                if($likes_status_list[$i])
                {
                    $like_btn_value = "Unlike";
                }
                else
                {
                    $like_btn_value = "Like";
                }
                echo '<input type="submit" name="like_comments_button" value='. $like_btn_value .' style="height:25px; width:60px; text-align:center">';
                echo form_close();
                echo '<td>';
                echo '</tr>';
            }
            ?>
            
        </table>
        
    </div>

    <!-- Display an input to add a new comment under this post -->
    <div class="form-group">
        <?php
        $hidden = ['post_heading' => $post_heading, 'post_id' => $post_id];
        echo form_open(base_url() . 'add_new_comment', '', $hidden); ?> <!-- hidden parameters are added as the third parameter -->
        <input type="text" placeholder="Enter a new comment" name="new_comment_content" size="50">
        <input type="submit" name="new_comment_button" value="Submit" size="50">
        <?php echo form_close(); ?>
    </div>
</body>

</html>