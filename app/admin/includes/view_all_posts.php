<?php

if (isset($_POST["bulk"])) {
    if (isset($_POST["options"])) {
        $arr = $_POST['selected'];
        if ($_POST["options"] == 'draft' || $_POST["options"] == 'Published') {
            for ($i = 0; $i < count($arr); $i++) {
                $stmt = $connection->prepare("UPDATE posts SET post_status=? WHERE post_id=?");
                $stmt->bind_param("si", $_POST["options"], $arr[$i]);
                $stmt->execute();
                $stmt->close();
            }
            echo '<div class="row bg-success">
                                  <h3 class="text-center">Post/s Statuses have been updated</h3>
                                  </div>';
        } else if ($_POST["options"] == 'delete') {
            for ($i = 0; $i < count($arr); $i++) {
                $stmt = $connection->prepare("DELETE FROM posts WHERE post_id=?");
                $stmt->bind_param("i", $arr[$i]);
                $stmt->execute();
                $stmt->close();
            }
            echo '<div class="row bg-success">
                                  <h3 class="text-center">Post/s have been deleted</h3>
                                  </div>';
        } else if ($_POST["options"] == "clone") {
            for ($i = 0; $i < count($arr); $i++) {
                try {
                    $connection->autocommit(FALSE);
                    $stmt1 = $connection->prepare("SELECT * FROM posts WHERE post_id=?");
                    $stmt2 = $connection->prepare("INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) 
                    VALUES (?,?,?,?,?,?,?,?,?)");
                    $stmt1->bind_param("i", $arr[$i]);
                    $stmt1->execute();
                    $result = $stmt1->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $cat_id = $row['post_category_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row["post_image"];
                        $post_content = $row["post_content"];
                        $post_tags = $row["post_tags"];
                        $post_comment_count = $row["post_comment_count"];
                        $post_status = $row["post_status"];
                    }
                    $stmt2->bind_param("issssssis", $cat_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_comment_count, $post_status);
                    $stmt2->execute();
                    $stmt1->close();
                    $stmt2->close();
                    $connection->autocommit(TRUE);
                } catch (Exception $e) {
                    $connection->rollback();
                    throw $e;
                }
            }
        }
    }
}

?>
<form action="" method="post">
    <select name="options" id="options">
        <option value="draft">draft</option>
        <option value="Published">publish</option>
        <option value="delete">delete</option>
        <option value="clone">clone</option>
    </select>
    <button type="submit" class="btn btn-success" name="bulk" value="bulkEdit">apply</button>
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Select <input type="checkbox" id="checkAll"></th>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Count</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Reset</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $connection->prepare("SELECT p.post_id,p.post_title,p.post_author,p.post_date,p.post_image,p.post_content,p.post_tags
            ,p.posts_views_count,p.post_status,c.cat_title FROM posts p,category c WHERE p.post_category_id=c.cat_id;");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $post_id = $row["post_id"];
                $post_author = $row["post_author"];
                $post_title = $row["post_title"];
                $cat_title = $row["cat_title"];
                $post_status = $row["post_status"];
                $post_image = $row["post_image"];
                $post_tags = $row["post_tags"];
                $posts_views_count = $row["posts_views_count"];
                $post_date = $row["post_date"];

                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_comment_query = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($send_comment_query);
                if (!empty($row["comment_id"])) {
                    $comment_id = $row["comment_id"];
                } else {
                    $comment_id = "no-comment";
                }
                $count_comments = mysqli_num_rows($send_comment_query);

                echo "<tr>";
                echo "<td><input type='checkbox' name='selected[]' value='$post_id' class='table-boxes'></td>";
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                echo "<td>{$cat_title}</td>";
                echo "<td>{$post_status}</td>";
                echo "<td><img width='100' src='../images/{$post_image}' alt='image'></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td><a href='post_comments.php?id=$post_id'>{$count_comments}</a></td>";
                echo "<td>{$post_date}</td>";
                echo "<td>$posts_views_count</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a onClick = \"javascript: return confirm('Are you sure you want to delete?');\"href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "<td><a onClick = \"javascript: return confirm('Are you sure you want to reset the view count?');\"href='posts.php?reset={$post_id}'>Reset</a></td>";
                echo "</tr>";
            }
            $stmt->close();
            ?>

        </tbody>
    </table>
</form>
<?php
if (isset($_GET['delete'])) {
    $delete_post_id = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM posts WHERE post_id=?");
    $stmt->bind_param("i", $delete_post_id);
    $stmt->execute();
    $stmt->close();
    header("Location: posts.php?success=3");
}
if (isset($_GET['reset'])) {
    $reset_count_id = $_GET['reset'];
    $zero = 0;
    $stmt = $connection->prepare("UPDATE posts SET posts_views_count = ? WHERE post_id = ?");
    $stmt->bind_param("ii", $zero, $reset_count_id);
    $stmt->execute();
    $stmt->close();
    header("Location: posts.php?success=4");
}
?>