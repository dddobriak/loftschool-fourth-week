<form action="addpost" method="POST">
    <div>
        <p>
            <label for="form-title">Title</label><br>
            <input id="form-title" name="title" type="text">
        </p>
        <p>
            <label for="form-text">Text</label><br>
            <textarea id="form-text" name="text" id="" cols="30" rows="5"></textarea>
        </p>
        <button type="submit">Send post</button>
    </div>
</form>

<?php

if ($atts['posts']) {
    foreach ($atts['posts'] as $post) {
        echo "<h3>{$post['title']}</h3>";
        echo "<p>{$post['text']}</p>";

        if ($atts['isAdmin']) {
            echo "<form action='deletepost' method='POST'>
                <button name='post' value='{$post['id']}'>Delete</button></form>";
        }
    }
}
