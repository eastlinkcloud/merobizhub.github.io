<style>
@import 'https://fonts.googleapis.com/css?family=Open+Sans:300,400';
.firstinfo, .badgescard, body {
  display: flex;
  justify-content: center;
  align-items: center;
}

html {
  height: 100%;
}

body {
  font-family: "Open Sans", sans-serif;
  width: 100%;
  min-height: 100%;
  background: #fff;
  font-size: 16px;
  overflow: hidden;
}

*, *:before, *:after {
  box-sizing: border-box;
}

.content {
  position: relative;
  animation: animatop 0.9s cubic-bezier(0.425, 1.14, 0.47, 1.125) forwards;
}

.card {
  width: 500px;
  min-height: 100px;
  padding: 20px;
  border-radius: 3px;
  background-color: white;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
  position: relative;
  overflow: hidden;
}
.card:after {
  content: "";
  display: block;
  width: 190px;
  height: 300px;
  background: #00008B;
  position: absolute;
  animation: rotatemagic 0.75s cubic-bezier(0.425, 1.04, 0.47, 1.105) 1s both;
}

.badgescard {
  padding: 10px 20px;
  border-radius: 3px;
  background-color: light-blue;
  width: 480px;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
  position: absolute;
  z-index: -1;
  left: 10px;
  bottom: 10px;
  animation: animainfos 0.5s cubic-bezier(0.425, 1.04, 0.47, 1.105) 0.75s forwards;
}
.badgescard span {
  font-size: 1.6em;
  margin: 0px 6px;
  opacity: 0.6;
}

.firstinfo {
  flex-direction: row;
  z-index: 2;
  position: relative;
}
.firstinfo img {
  border-radius: 50%;
  width: 120px;
  height: 120px;
}
.firstinfo .profileinfo {
  padding: 0px 20px;
}
.firstinfo .profileinfo h1 {
  font-size: 1.8em;
}
.firstinfo .profileinfo h3 {
  font-size: 1.2em;
  color: #009688;
  font-style: italic;
}
.firstinfo .profileinfo p.bio {
  padding: 10px 0px;
  color: #5A5A5A;
  line-height: 1.2;
  font-style: initial;
}

@keyframes animatop {
  0% {
    opacity: 0;
    bottom: -500px;
  }
  100% {
    opacity: 1;
    bottom: 0px;
  }
}
@keyframes animainfos {
  0% {
    bottom: 10px;
  }
  100% {
    bottom: -42px;
  }
}
@keyframes rotatemagic {
  0% {
    opacity: 0;
    transform: rotate(0deg);
    top: -24px;
    left: -253px;
  }
  100% {
    transform: rotate(-30deg);
    top: -24px;
    left: -78px;
  }
}
</style>

<!-- reffer.php -->
<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();
}

// Database credentials
$host = "localhost";
$username = "merobizh_root";
$password = "Kniltsae@977";
$database = "merobizh_sales";

try {
    // Establish database connection
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve sales manager information
    $stmt = $conn->prepare("SELECT * FROM salesmanager WHERE username = :username");
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $salesManager = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Refer Page</title>
</head>
<body>

<div class="content">
  <div class="card">
    <div class="firstinfo">
      <img src="<?php echo $salesManager['profile_img']; ?>" alt="Profile Image">
      <div class="profileinfo">
        <h1> 
          Name : <?php echo $salesManager['salesmanager_name']; ?>
        </h1>
        <h3>Email : <?php echo $salesManager['email']; ?></h3>
        <p class="bio">Contact No : +977 - <?php echo $salesManager['mobilenumber']; ?></p>
      </div>
    </div>
  </div>
  <div class="badgescard"> <span class="devicons devicons-django"></span><span class="devicons devicons-python"> </span><span class="devicons devicons-codepen"></span><span class="devicons devicons-javascript_badge"></span><span class="devicons devicons-gulp"></span><span class="devicons devicons-angular"></span><span class="devicons devicons-sass">
<div>
<div>
<input type="text" id="referral-link" value="<?php echo 'https://merobizhub.com/sharee.php?username=' . $_SESSION['username']; ?>" readonly>
<button onclick="copyReferralLink()">Copy Link</button>

<script>
function copyReferralLink() {
  var referralLinkInput = document.getElementById("referral-link");
  
  // Select the text inside the input field
  referralLinkInput.select();
  referralLinkInput.setSelectionRange(0, 99999); // For mobile devices
  
  // Copy the selected text to the clipboard
  document.execCommand("copy");
  
  // Alert the user that the link has been copied
  alert("Referral link copied to clipboard!");
}
</script>

</div>
</div>
    
    </span></div>
</div>
</body>
</html>