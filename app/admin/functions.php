<?php
function generateCategories()
{
    global $connection;
    $query = "SELECT * FROM category";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>{$row["cat_id"]}</td>
        <td>{$row['cat_title']}</td>
        <td><a href='categories.php?delete={$row['cat_id']}'>Delete</a></td>
        <td><a href='categories.php?edit={$row['cat_id']}'>Edit</a></td>
        </tr>";
    }
}
function addCategory()
{
    global $connection;
    $cat_title = $_POST["cat_title"];
    if ($cat_title == "" || empty($cat_title)) {
        echo "Category title cannot be empty";
    } else {
        $stmt = $connection->prepare("INSERT INTO category(cat_title) VALUES(?)");
        $stmt->bind_param("s", $cat_title);
        $stmt->execute();
        $stmt->close();
    }
}
function deleteCategory()
{
    global $connection;
    $stmt = $connection->prepare("DELETE FROM category WHERE cat_id = ?");
    $stmt->bind_param("i", $_GET["delete"]);
    $stmt->execute();
    $stmt->close();
    header("Location: categories.php");
}
function updateCategory()
{
    global $connection;
    $cat_title = $_POST["cat_title"];
    $stmt = $connection->prepare("UPDATE category SET cat_title = ? WHERE cat_id = ?");
    $stmt->bind_param("si", $cat_title, $_GET["edit"]);
    $stmt->execute();
    $stmt->close();
}
function users_online()
{
    if (isset($_GET["onlineusers"])) {
        global $connection;
        if (!$connection) {
            include("../includes/db.php");
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }
            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            $count_user = mysqli_num_rows($users_online_query);
            echo $count_user;
        }
    }
}
users_online();
