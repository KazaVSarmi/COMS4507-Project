<h5>Posts</h5>
Here are the posts related to topic <?php echo $topic_name; ?>.
<br>
Use the form below to create a new post.
<!-- Display an input to add a new post under this topic -->
<div class="form-group">
    <?php
    $hidden = ['topic_name' => $topic_name, 'topic_id' => $topic_id];
    echo form_open(base_url() . 'add_new_post', '', $hidden); ?> <!-- hidden parameters are added as the third parameter -->
    <input type="text" placeholder="Enter a new post heading and click the button beside" name="new_post_heading" size="50">
    <input type="submit" name="new_post_button" value="Add new post" size="50">
    <?php echo form_close(); ?>
</div>

<!-- Display the posts categorised under the selected topic -->
<p>Click on a post below to see the discussion around it</p>
<div class="form-group">
    <table>
        <tr>
            <?php foreach ($posts_list as $post) {
                $hidden = ['post_heading' => $post->heading, 'post_id' => $post->id];
                echo form_open(base_url() . 'view_comments', '', $hidden);
                echo '<tr>';
                echo '<td>';
                echo '<input type="submit" name="view_comments_button" value="' . $post->heading . '" style="height:30px; width:500px; text-align:left"';
                echo '</td>';
                echo '</tr>';
                echo form_close();
            } ?>
        </tr>
    </table>
</div>