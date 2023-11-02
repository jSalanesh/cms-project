<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>
<?php
function updatePassword($connection,$length,$email){
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $newPassword = substr(str_shuffle($chars),0,$length);
    $hashedPassword = password_hash($newPassword,PASSWORD_BCRYPT,array("cost"=>12));
    $stmt = $connection->prepare("UPDATE users SET user_password = ? WHERE user_email=?");
    $stmt->bind_param("ss",$hashedPassword,$email);
    $stmt->execute();
    $stmt->close();
    return $newPassword;
}
?>

<!-- Page Content -->
<div class="container">
    <?php
    if (isset($_POST['submit'])) {
    $stmt = $connection->prepare("SELECT user_email FROM users WHERE user_email=?");
    $stmt->bind_param("s",$_POST["user_email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if($result->num_rows===0){
        header("Location: password_reset.php?noEmail=1");
    }else{
        //Load Composer's autoloader
        require 'vendor/autoload.php';
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $user_email = $_POST["user_email"];
        $subj = "Password Reset";
        $returnedPassword = updatePassword($connection,8,$user_email);
        $body = "Password has been reset. New password is: <b>$returnedPassword</b>";    
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'joseph.sala2001@gmail.com';                     //SMTP username
            $mail->Password   = 'upvo fcvo qpck joqt';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->isHTML(true);
            $mail->setFrom('joseph.sala2001@gmail.com');
            $mail->addAddress($user_email);     //Add a recipient
            //Content
            $mail->Subject = $subj;
            $mail->Body    = $body;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    }
    ?>
    <section id="login">
        <div class="container">
            <div class="row">

            </div>
            <?php
            if(isset($_GET["noEmail"])){
                echo "<p>No email found</p>";
            }
            ?>
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Reset Password</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input class="form-control" type="email" name="user_email" id="user_email">
                            </div>
                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>