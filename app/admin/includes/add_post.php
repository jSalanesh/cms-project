<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 0;
    move_uploaded_file($post_image_temp, "../images/$post_image");

    $stmt = $connection->prepare("INSERT INTO posts (post_title,post_author,post_category_id,post_status,post_image,post_tags,post_content,post_date,post_comment_count) VALUES(?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssisssssi", $post_title, $post_author, $post_category_id, $post_status, $post_image, $post_tags, $post_content, $post_date, $post_comment_count);
    $stmt->execute();
    $stmt->close();

    $post_id = mysqli_insert_id($connection);
    echo "<div class='row bg-success'>";
    echo "<h3 class='text-center'>Successfully added a <a href='../post.php?p_id={$post_id}'>new post!</a></h3>";
    echo "</div>";
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="post_title" id="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category_id" id="post_category_id">
            <?php
            $query = "SELECT * FROM category";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <select name="post_author" id="post_author">
            <?php
            $query = "SELECT * FROM users";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['username']}'>{$row['username']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status">
            <option value="draft">draft</option>
            <option value="Published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" id="post_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" id="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea name="post_content" id="summernote" cols="120" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>

</form>