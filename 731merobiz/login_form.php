<!-- login_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | Merobizhub</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="img/icon/merobiz.png">
</head>
<body class="bg-gradient-white">
<?php if (isset($login_error)) : ?>
  <div id="error-message" class="alert alert-danger text-dark text-center"><?php echo $login_error; ?></div>
  <script>
    setTimeout(function () {
      document.getElementById("error-message").style.display = "none";
    }, 3000); // 3000 milliseconds (3 seconds)
  </script>
<?php endif; ?>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body col-lg-12 p-5 ">
                    <!-- Nested Row within Card Body -->                     
                                        <p class="fs-4 fw-bold text-center text-primary mb-3"><img src="img/icon/merobiz.png" alt="" style="width:180px; height:160px;"><br><i class="fas fa-user"></i> SIGN IN</p>
                                        <hr class="text-dark bg-dark">


                        <form method="POST" value="">
                        <span>USERNAME</span>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="username" required>
                            </div><span>PASSWORD</span>
                            <div class="form-group">
                                
                                <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password" id="show_hide_password" required>
                            </div>
                            <span></span>
                            <button class="btn btn-primary btn-block mt-4 p-2" type="submit" name="submit">Login</button>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>