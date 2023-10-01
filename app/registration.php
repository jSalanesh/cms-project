<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">
    <?php
    $message = "";
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['user_email'];
        $password = $_POST['user_password'];
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        $user_role = 'subscriber';
        if (!empty($username) && !empty($email) && !empty($password)) {
            $stmt = $connection->prepare("INSERT INTO users (username,user_email,user_password,user_role) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $username, $email, $password, $user_role);
            $stmt->execute();
            $stmt->close();
            $message = "Your Registration has been submitted";
        } else {
            $message = "Fields cannot be empty.";
        }
    }
    ?>
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h6 class="text-center"><?php echo $message; ?></h6>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="sr-only">Email</label>
                                <input type="email" name="user_email" id="user_email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="user_password" class="sr-only">Password</label>
                                <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>