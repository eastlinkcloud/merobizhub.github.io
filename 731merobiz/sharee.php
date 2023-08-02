<!-- sharee.php -->
<?php
include('include/config.php');
// Retrieve sales manager information
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $stmt = $conn->prepare("SELECT * FROM salesmanager WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $salesManager = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $rname = $_POST['rname'];
    $rphone = $_POST['rphone'];
    $address = $_POST['address'];
    $category = $_POST['category'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $remail = $_POST['remail'];

    if (empty($rname) || empty($rphone) || empty($address)) {
        echo '<script>alert("Please enter all required fields.");</script>';
    } else { 
        try {
            // Insert form data into the referrals table
            $stmt = $conn->prepare("INSERT INTO refer (salesmanager_id, rname, rphone, address, category, product, price, remail) 
                                   SELECT salesmanager_id, :rname, :rphone, :address, :category, :product, :price, :remail 
                                   FROM salesmanager WHERE username = :username");
            $stmt->bindParam(':rname', $rname);
            $stmt->bindParam(':rphone', $rphone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':product', $product);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':remail', $remail);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            // Display success message
            echo '<div id="success-message" role="alert" style="
                color: #fff;
                background-color: green;
                border-radius: 7px;
                padding: 10px;
                font-size: 18px;
                font-weight: 500;
                cursor: pointer;
                white-space: nowrap;
                width: 300px;
                position: fixed;
                top: 96px;
                left: 91%;
                transform: translateX(-50%);
                text-align: center;
                z-index: 9999;
                transition: opacity 0.2s ease-in-out;
            ">Area Manager Added Successfully.</div>';

            echo '<script>
                setTimeout(function() {
                    var successMessage = document.getElementById("success-message");
                    successMessage.style.opacity = "0";
                    setTimeout(function() {
                        successMessage.remove();
                    }, 200);
                }, 2000);
            </script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <title>Register for New Service </title>
 <style>
@media only screen and (max-width: 600px) {
.logo,img{
  max-width: 980px;
}
.img-fluid{
  max-width: 190px;
  margin-left:5px;
  margin-left: 140px;
}
}
  </style>  
</head>
  <body>
<section>
<header>
  <nav class="nav navbar" style=" height:auto; margin-left:9%;">
<img src="img/icon/merobizz.png" class="logo" alt="logo" style="max-width: 14%;margin-top:1%;" class="logo_tab">
  </nav>
</header>
  <div class="container">
  <div class="row">
  <div class="col-xl-6" style="margin-top:10%;">
  <div class="card mb-3" style="max-width: 580px;">
  <div class="row g-0">
    <div class="col-md-4" style="margin-left:-80px; margin-top:12px;">
      <img src="<?php echo $salesManager['profile_img']; ?>" class="img-fluid" alt="..." style="width: 100px;
    height: 180px;
    border-radius: 50%;
    display: block;
    border: 5px solid #fff;
    margin-left:155;
    margin-right: auto;
    width: 100%;">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <p class="card-text"><p>Name : <b><?php echo $salesManager['salesmanager_name']; ?></b></p>
              <p>Email Id : <b><?php echo $salesManager['email']; ?></b></p>
              <p>Contact No : <b>+977-<?php echo $salesManager['mobilenumber']; ?></b></p>
              <p>Alternate No : <b>01-4101181</b></p></p>
      </div>
    </div>
  </div>
</div>
  </div>
  <div class="col-xl-1"></div>
  <div class="col-xl-5">
  <div class="card" style="width: 400px; float:right;">
  <div class="row g-0">
  <form class="p-1" method="POST" >
    <h3>Register Here!</h3>
    <div class="form-group col-md-auto">
      <input type="text" class="form-control" placeholder="Username*" name="rname" required>
    </div><br>
    <div class="form-group col-md-auto">
      <input type="email" class="form-control" placeholder="Email*" name="remail" required>
    </div><br>
    <div class="form-group col-md-auto">
      <input type="text" class="form-control" placeholder="PhoneNumber*" name="rphone" required>
    </div><br>
    <div class="form-group col-md-auto">
      <input type="text" class="form-control" placeholder="Address*" name="address" required>
    </div>
    <style>.form-select{
        width:294%;}
        .input-group{
            width:294%;
        }
        .col-xl-4{
            margin:7px;
        }
        </style>
    <?php
    include('dropdown2.php');
    ?>
<br>
<button type="submit" class="btn btn-primary btn-sm btn-block text-center" name="submit">Register Now</button>
</form>
  </div>
</div>
  </div>
</div>
  </div>
</section>

  <div class="footer" style="color:#fff; padding:2%; width:100%;">
    <p class="card-center text-center text-dark fw-bold">For all queries Call  <span class="btn btn-warning btn-lg fw-bold" style="border: 6px solid #e97a0e;
    padding: 4px 10px;
    border-radius: 10px;">+977-<?php echo $salesManager['mobilenumber']; ?></span></p>
</div>
</body>
</html>


