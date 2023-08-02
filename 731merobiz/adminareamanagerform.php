<!-- areamanager form -->
<?php
session_start();
$title = 'Create AreaManager';
include('include/connection.php');

// Check if the form has been submitted
if (isset($_POST['btnregister'])) {
    $managerdata_name = $_POST['managerdata_name'];
    $username = $_POST['txtusername'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $password = $_POST['txtpassword'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $municipality = $_POST['municipality'];
    $wardno = $_POST['wardno'];
    $mobilenumber = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $totalpoints = $_POST['totalpoints'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $status = $_POST['status'];

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
      echo '<div id="error-messager" role="alert" >Image must be in JPG, JPEG, PNG, or PDF format and less than 2MB.</div>';
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
            $check_query = "SELECT * FROM managerdata WHERE username=:username";
            $stmt = $conn->prepare($check_query);
            $stmt->execute(array(':username' => $username));

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
                $insert_query = "INSERT INTO managerdata (profile_img, docs_img, managerdata_name, username, password, province, district, municipality, wardno, mobilenumber, email, totalpoints, latitude, longitude, status) 
                    VALUES (:profile_img, :docs_img, :managerdata_name, :username, :password, :province, :district, :municipality, :wardno, :mobilenumber, :email, :totalpoints, :latitude, :longitude, :status)";
                $stmt = $conn->prepare($insert_query);
                $stmt->bindParam(':profile_img', $profile_img);
                $stmt->bindParam(':docs_img', $docs_img);
                $stmt->bindParam(':managerdata_name', $managerdata_name);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password); //to store Hash form
                $stmt->bindParam(':province', $province);
                $stmt->bindParam(':district', $district);
                $stmt->bindParam(':municipality', $municipality);
                $stmt->bindParam(':wardno', $wardno);
                $stmt->bindParam(':mobilenumber', $mobilenumber);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':totalpoints', $totalpoints);
                $stmt->bindParam(':latitude', $latitude);
                $stmt->bindParam(':longitude', $longitude);
                $stmt->bindParam(':status', $status);

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
                    ">AreaManager Add Successfully.</div>';

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
include('include/admintop.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- form part -->
  <p class="h3 text-black fw-bold" style="margin-left:8%;">Create AreaManager</p>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal mx-auto col-10 col-md-10 col-lg-10 shadow-lg my-4 p-4 m-4 needs-validation" enctype="multipart/form-data" novalidate>
  <div class="form-row mt-4 mb-4">
  <div class="col-xl-6">
  Full Name*
  <input type="text" class="form-control" name="managerdata_name" placeholder="Full Name" pattern="[A-Za-z]{3,}(\s[A-Za-z]{3,})?" id="validationCustom03" required>
  <div class="invalid-feedback">Please enter full name.</div>
</div>
      <div class="col-xl-6">
        Username* <input type="text" name="txtusername" placeholder="Username" class="form-control" id="validationCustom03" required>
        <div class="invalid-feedback">Please enter username</div>
      </div>
    </div>
  
    <div class="form-row mt-4 mb-4">
    <div class="col-xl-6">
  Email* 
  <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address"  required >
  <div class="invalid-feedback feedback-pos">
  Please Enter Email Aaddress.
</div>

</div>
<div class="col-xl-6">
  Password* 
  <input type="password" name="txtpassword" placeholder="Password*" class="form-control" max="1000000000" min="999999999" required id="password-input">
  <div class="invalid-feedback feedback-pos">
    Please Enter Password.
  </div>
</div>
    </div>
      <?php
      include('dropdown.php');
      ?>

    <div class="form-row">
      <div class="col-xl-3">
        Ward No.* <input type="number" name="wardno" placeholder="Ward No" class="form-control" id="validationCustom03" required>
        <div class="invalid-feedback feedback-pos">
    Please Enter Ward No.
  </div>
      </div>
      <div class="col-xl-5">
        Street/Tole* <input type="text" name="totalpoints"  placeholder="Street/Tole" class="form-control" id="validationCustom03" required>
        <div class="invalid-feedback feedback-pos">
    Please Enter  Street/Tole.
  </div>
      </div>
      <div class="col-xl-4">
        Phone Number* <input type="number" min="1000000000" max="9999999999" name="mobilenumber"  placeholder="Phone Number" class="form-control" id="validationCustom03" required>
        <div class="invalid-feedback feedback-pos">
    Please Enter  Phone Number.
  </div>
      </div>
    </div>
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
    <input type="hidden" name="status" value="Active">
    <br>
    <div class="form-row mb-4">
  <div class="col-xl-6">
    Profile Image*
    <input type="file" name="profile_img" id="profile_img" class="form-control" onchange="Filevalidation(this)" accept=".jpg, .jpeg, .png, .pdf" id="validationCustom01" required>
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

