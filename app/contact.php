<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">
    <?php
    if (isset($_POST['submit'])) {
        $to = "jpls9400@gmail.com";
        $subject = $_POST['subject'];
        $body = $_POST['body'];
        $headers = "From: webmaster@cmssalanesh.com";

        $result = mail($to,$subject,$body,$headers);
        echo $result;
    }
    ?>
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                            </div>
                            <div class="form-group">
                               <textarea class="form-control" name="body" id="body" cols="50" rows="10"></textarea>
                            </div>
                            <?php echo $result;?>
                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>