<?php
session_start();
$title = 'customer form';
include('include/connection.php');
$title = 'Create customer';
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $managerdata_name = $username; // set maangername to the username value from session
    $d_id = $_SESSION['myuser']; // set salesmanager_id to the user_id value from session
  } else {
    // Redirect to login page if user is not logged in
    header("location: index.php");
    exit();
  }

$success_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnregister'])) {
    $customer_name = $_POST['customer_name'];
    $category = $_POST['category'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $wardno = $_POST['wardno'];
    $streetno = $_POST['streetno'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $municipality = $_POST['municipality'];
    $mobilenumber = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

 // Handle profile image upload
 $profile_img = $_FILES['profile_img']['name'];
 $profile_img_tmp = $_FILES['profile_img']['tmp_name'];
 $profile_img_folder = 'profile_images/'; // Specify the folder name here
 $profile_img_path = $profile_img_folder . $profile_img;
 
 // Handle documents image upload
 $docs_img = $_FILES['docs_img']['name'];
 $docs_img_tmp = $_FILES['docs_img']['tmp_name'];
 $docs_img_folder = 'docs_images/'; // Specify the folder name here
 $docs_img_path = $docs_img_folder . $docs_img;
 
 // Validate profile_img and docs_img
 $allowedFormats = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
 $maxSize = 2 * 1024 * 1024; // 2MB
 $errorMessages = [];

 if (!in_array($_FILES['profile_img']['type'], $allowedFormats) || $_FILES['profile_img']['size'] > $maxSize) {
     $errorMessages[] = 'Profile image must be in JPG, JPEG, PNG, or PDF format and less than 2MB.';
 }
 
 if (!in_array($_FILES['docs_img']['type'], $allowedFormats) || $_FILES['docs_img']['size'] > $maxSize) {
     $errorMessages[] = 'Document image must be in JPG, JPEG, PNG, or PDF format and less than 2MB.';
 }

 if (!empty($errorMessages)) {
   echo '<div id="error-messager" role="alert">Image must be in JPG, JPEG, PNG, or PDF format and less than 2MB.</div>';

echo '<script>
   setTimeout(function() {
       var errorMessage = document.getElementById("error-messager");
       errorMessage.style.opacity = "0";
       setTimeout(function() {
           errorMessage.remove();
       }, 200);
   }, 2000);
</script>'; foreach ($errorMessages as $errorMessage) {
         echo '<div class="invalid-feedback feedback">' . $errorMessage . '</div>';
     }
 } else {
     // Move uploaded files to destination folder
     if (move_uploaded_file($profile_img_tmp, $profile_img_path) && move_uploaded_file($docs_img_tmp, $docs_img_path)) {
         // Check if username already exists
         $check_query = "SELECT * FROM customer WHERE customer_name=:customer_name";
         $stmt = $conn->prepare($check_query);
         $stmt->execute(array(':customer_name' => $customer_name));

         if ($stmt->rowCount() > 0) {
             echo '<div id="error-message" role="alert" style="
                 color: #fff;
                 background-color: #ff8080;
                 border-radius: 7px;
                 padding: 10px;
                 font-size: 18px;
                 font-weight: 500;
                 cursor: pointer;
                 white-space: nowrap;
                 width: 300px;
                 position: fixed;
                 top: 96px;
                 left: 93%;
                 transform: translateX(-50%);
                 text-align: center;
                 z-index: 9999;
                 transition: opacity 0.2s ease-in-out;
             ">Username Already Exists.</div>';

             echo '<script>
                 setTimeout(function() {
                     var errorMessage = document.getElementById("error-message");
                     errorMessage.style.opacity = "0";
                     setTimeout(function() {
                         errorMessage.remove();
                     }, 200);
                 }, 2000);
             </script>';
         } else {
             // Insert new Area Manager into the database
        $insert_query = "INSERT INTO areacustomer (profile_img, docs_img, customer_name, category, product, price, wardno, streetno, province, district, municipality, mobilenumber, email, status, latitude, longitude, d_id) 
        VALUES (:profile_img, :docs_img, :customer_name, :category, :product, :price, :wardno, :streetno, :province, :district, :municipality, :mobilenumber, :email, :status, :latitude, :longitude, :d_id)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(':profile_img', $profile_img_path);
        $stmt->bindParam(':docs_img', $docs_img_path);
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':product', $product);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':wardno', $wardno);
        $stmt->bindParam(':streetno', $streetno);
        $stmt->bindParam(':province', $province);
        $stmt->bindParam(':district', $district);
        $stmt->bindParam(':municipality', $municipality);
        $stmt->bindParam(':mobilenumber', $mobilenumber);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':latitude', $latitude);
        $stmt->bindParam(':longitude', $longitude);
        $stmt->bindParam(':d_id', $d_id);

        if ($stmt->execute()) {
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
            ">Customer Add Successfully.</div>';

            echo '<script>
                setTimeout(function() {
                    var successMessage = document.getElementById("success-message");
                    successMessage.style.opacity = "0";
                    setTimeout(function() {
                        successMessage.remove();
                    }, 200);
                }, 2000);
            </script>';
        } else {
            echo '<div class="alert alert-danger" role="alert">ERROR</div>';
        }
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Error uploading files.</div>';
}
}
}

include('include/top.php');
include('include/areatop.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Form part -->
    <p class="h3 text-black fw-bold" style="margin-left:8%;">Create Customer</p>
 <!-- Display success message if set -->
 <?php if (!empty($success_message)) : ?>
        <div class="toastr-message">
            <script>
                window.addEventListener('DOMContentLoaded', (event) => {
                    toastr.success('<?php echo $success_message; ?>');
                });
            </script>
        </div>
    <?php endif; ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal mx-auto col-10 col-md-10 col-lg-10 shadow-lg my-4 p-4 m-4 needs-validation" enctype="multipart/form-data" novalidate>
        <!-- Rest of your form --> <div class="form-row mb-4">
            <!-- slect SalesPoint -->
            <input type="text" name="managerdata_name" value="<?php echo $managerdata_name; ?>" class="form-control" hidden>
            <!-- customer name -->
            <div class="col-xl-5">
                Customer Name*
                <input type="text" name="customer_name" id="validationTooltip01" placeholder="Customer Name*" class="form-control"  pattern="[A-Za-z]{3,}(\s[A-Za-z]{3,})?" required>
    <div class="invalid-feedback feedback-pos">
      Please enter customer name.
    </div>
            </div>
            <div class="col-xl-7">
            Email* <input type="email" name="email" placeholder="Email" class=" form-control" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
          <div class="valid-feedback feedback-pos ">
            Looks good!
          </div>
          <div class="invalid-feedback feedback-pos">
            Please enter your email.
          </div>
            </div>
        </div><br>
        <?php
        include('dropdown2.php');
        ?>
        <div class="form-row">
            <div class="col-xl-3">
                Ward No.* <input type="number" name="wardno" id="validationTooltip01" placeholder="Ward No.*" class="form-control" required>
                <div class="invalid-feedback feedback-pos ">
            Please input field.
          </div>
            </div>
            <div class="col-xl-5">
                Street/Tole.* <input type="text" name="streetno" id="validationTooltip01" placeholder="Street No.*" class="form-control" required>
                <div class="invalid-feedback feedback-pos ">
            Please input field.
          </div>
            </div> 
            <div class="col-xl-4">
               PhoneNumber* <input name="mobilenumber" class="form-control" id="phoneNumber" type="number" min="1000000000" max="9999999999" placeholder="Phone Number"  required />
                <div class="invalid-feedback feedback-pos ">
            Please enter mobilenumber.
        </div>     
        </div></div>
        <br>
<?php
    include('dropdown.php');
?>
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
    <input type="hidden" name="status" value="Active">
    <br>
    <div class="form-row mb-4">
  <div class="col-xl-6">
    Profile Image*
    <input type="file" name="profile_img" id="profile_img" class="form-control" onchange="Filevalidation(this)" accept=".jpg, .jpeg, .png, .pdf" id="validationCustom03" required>
    <div class="invalid-feedback feedback-pos">Please Upload Profile Image.</div>
    <div id="error-msg" style="color: red; font-size: 14px; margin-top: 2px;"></div>
  </div>

  <div class="col-xl-6">
    Citizenship/Driving License/PAN *
    <input type="file" name="docs_img" id="docs_img" class="form-control" onchange="Filevalidations(this)" accept=".jpg, .jpeg, .png, .pdf" id="validationCustom03" required>
    <div class="invalid-feedback feedback-pos">Please Upload Citizenship/Driving License/PAN.</div>
    <div id="error-msgs" style="color: red; font-size: 15px;"></div>
  </div>
</div>

<input class="btn btn-block btn-primary col-xl-2 center-button" type="submit" value="Register" name="btnregister">

<script>
  Filevalidation = (input) => {
    const file = input.files[0];
    const errorMsg = document.getElementById('error-msg');
    const profileImgInput = document.getElementById('profile_img');

    if (!file) {
      errorMsg.textContent = 'Please upload a profile image.';
      input.classList.add('is-invalid');
      profileImgInput.value = ''; // Clear the input value
      return;
    }
    
    const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    const fileSize = Math.round(file.size / 1024);
    
    if (!allowedExtensions.test(input.value)) {
      errorMsg.textContent = 'Profile image must be in JPG, JPEG, PNG, or PDF format.';
      input.classList.add('is-invalid');
      profileImgInput.value = ''; // Clear the input value
    } else if (fileSize > 2048) {
      errorMsg.textContent = 'File size is larger than 2MB. Please choose a smaller image.';
      input.classList.add('is-invalid');
      profileImgInput.value = ''; // Clear the input value
    } else {
      errorMsg.textContent = '';
      input.classList.remove('is-invalid');
    }
  };
</script>

<script>
  Filevalidations = (input) => {
    const file = input.files[0];
    const errorMsg = document.getElementById('error-msgs');
    const docsImgInput = document.getElementById('docs_img');

    if (!file) {
      errorMsg.textContent = 'Please upload a document image.';
      input.classList.add('is-invalid');
      docsImgInput.value = ''; // Clear the input value
      return;
    }
    
    const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    const fileSize = Math.round(file.size / 1024);
    
    if (!allowedExtensions.test(input.value)) {
      errorMsg.textContent = 'Document image must be in JPG, JPEG, PNG, or PDF format.';
      input.classList.add('is-invalid');
      docsImgInput.value = ''; // Clear the input value
    } else if (fileSize > 2048) {
      errorMsg.textContent = 'File size is larger than 2MB. Please choose a smaller image.';
      input.classList.add('is-invalid');
      docsImgInput.value = ''; // Clear the input value
    } else {
      errorMsg.textContent = '';
      input.classList.remove('is-invalid');
    }
  };
</script>

<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()
</script>

  </form>
</div>

<?php
include('include/foot.php');
?>

