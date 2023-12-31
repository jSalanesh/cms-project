<?php include "../includes/db.php"; ?>
<?php ob_start();
session_start();
if (!isset($_SESSION['user_role'])) {
  header("Location: ../index.php");
} else if ($_SESSION['user_role'] != 'admin') {
  session_destroy();
  header("Location: ../index.php");
}
?>
<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>SB Admin - Bootstrap Admin Template</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link href="css/sb-admin.css" rel="stylesheet" />

  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="css/styles.css">

  <!-- summernote css -->
  <link rel="stylesheet" href="css/summernote.css">

</head>

<body>