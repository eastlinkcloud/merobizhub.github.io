<!-- receipt FORM -->
<?php
session_start();
$title = 'Receipt Form';
include('include/connection.php');

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $salesmanager_id = $_SESSION['myuser']; // set salesmanager_id to the user_id value from session
} else {
    // Redirect to login page if user is not logged in
    header("location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnregister'])) {
    // Check if the form has been submitted

    // Handle profile image upload
    $profile_img_folder = 'profile_images/'; // Specify the folder name here

    if (isset($_FILES['profile_img'])) {
        $profile_img = $_FILES['profile_img']['name'];
        $profile_img_tmp = $_FILES['profile_img']['tmp_name'];
        $profile_img_path = $profile_img_folder . $profile_img;

        // Validate and move uploaded image
        $allowed_extensions = array('jpg', 'jpeg', 'png');
        $file_extension = strtolower(pathinfo($profile_img, PATHINFO_EXTENSION));

        if (in_array($file_extension, $allowed_extensions)) {
            if (move_uploaded_file($profile_img_tmp, $profile_img_path)) {
                // Image uploaded successfully
            } else {
                echo "<script>alert('Failed to upload profile image');</script>";
            }
        } else {
            echo "<script>alert('Invalid image format. Only JPG, JPEG, and PNG are allowed.');</script>";
        }
    } else {
        echo "<script>alert('Profile image is required');</script>";
    }

    // Get form data
    $requested_by = $_POST['requested_by'];
    $customer_name = $_POST['customer_name'];
    $aword = $_POST['aword'];
    $anumber = $_POST['anumber'];
    $date = $_POST['date'];
    $payment_type = $_POST['payment_type'];
    $contactnumber = $_POST['contactnumber'];
    $email = $_POST['email'];
    $remark = $_POST['remark'];

    try {
        // Insert new customer into the database
        $insert_query = "INSERT INTO resellerwallet (requested_by, profile_img, customer_name, aword, anumber, date, payment_type, contactnumber, email, remark, salesmanager_id) 
        VALUES (:requested_by, :profile_img, :customer_name, :aword, :anumber, :date, :payment_type, :contactnumber, :email, :remark, :salesmanager_id)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(':profile_img', $profile_img_path);
        $stmt->bindParam(':requested_by', $requested_by);
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':aword', $aword);
        $stmt->bindParam(':anumber', $anumber);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':payment_type', $payment_type);
        $stmt->bindParam(':contactnumber', $contactnumber);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':remark', $remark);
        $stmt->bindParam(':salesmanager_id', $salesmanager_id);

        if ($stmt->execute()) {
            echo "<script>alert('Successfully Submit');</script>";
            // Redirect to success page or perform any other necessary actions
        } else {
            echo "<script>alert('Failed to register customer');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

include('include/top.php');
include('include/salestop.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid ">
 <div class="row ">
 <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal mx-auto col-10 col-md-10 col-lg-8 shadow-lg p-4 needs-validation" enctype="multipart/form-data" novalidate>
    <h1 class="h4  mb-0 text-light fw-bold p-3 mb-4 bg-primary text-center">Reseller Wallet Amount</h1>   
<div class="form-row">
<div class="col-xl-6">
    <div class="form-outline mb-3">
        <label class="form-label float-left" for="form6Example2">Amount in Number*</label>
        <input type="number" id="validationCustom03" class="form-control" name="anumber" required/>
        <div class="invalid-feedback feedback-pos">
    Please enter amount in number.
  </div>
    </div>
</div>
<div class="col-xl-6">
<div class="form-outline mb-3">
        <label class="form-label float-left" for="form6Example1" >Amount in Word*</label>
        <input type="text" id="validationCustom03" class="form-control" name="aword" required/>
        <div class="invalid-feedback feedback-pos">
    Please enter amount in word.
  </div>
    </div>
</div>

</div>
<div class="form-row">
<div class="col-xl-6">
    <div class="form-outline mb-3">
        <label class="form-label float-left" for="payment_type">Payment Method*</label>
        <select class="form-select btn btn-block border-secondary text-left" id="validationCustom03" name="payment_type" required>
        <option selected disabled value="">Select Payment Method</option>   
        <option value="Cheque">Cheque</option>
            <option value="Bank Deposit">Bank Deposit</option>
            <option value="Online Transfer">Online Transfer</option>
            <option value="Cash">Cash</option>
        </select>        
        <div class="invalid-feedback feedback-pos">
    Please select payment method.
  </div>
    </div></div>
    <div class="col-xl-6">
    <div class="form-outline mb-4">
        <label class="form-label float-left" for="date">Payment date*</label>
        <input type="date" id="validationCustom03" name="date" class="btn btn-block border-secondary" required>
        <div class="invalid-feedback feedback-pos">
    Please select payment Date.
  </div>
    </div>
    </div></div>
<div class="form-row">
<div class="col-xl-6">  
    <div class="form-outline mb-3">
        <label class="form-label float-left" for="requested_by">Requested By*</label>
        <input type="text" id="validationCustom03" class="form-control" name="requested_by" required/>
        <div class="invalid-feedback feedback-pos">
    Please enter requested by.
  </div>
    </div></div>
    <div class="col-xl-6">  
    <div class="form-outline mb-3">
        <label class="form-label float-left" for="requested_by">Customer Name*</label>
        <input type="text" id="validationCustom03" class="form-control" name="customer_name" required/>
        <div class="invalid-feedback feedback-pos">
    Please enter customer name.
  </div>
    </div></div></div>
    <div class="form-row">
<div class="col-xl-6"> 
<div class="form-outline mb-3">
        <label class="form-label float-left" for="requested_by">Contact*</label>
        <input type="text" id="validationCustom03" max="1000000000" min="999999999" class="form-control" name="contactnumber" required/>
        <div class="invalid-feedback feedback-pos">
    Please enter contact number.
  </div>
    </div>
</div>
    <div class="col-xl-6"> 
    <div class="form-outline mb-3">
        <label class="form-label float-left" for="email">Email*</label>
        <input type="email" id="validationCustom03" class="form-control" name="email" required/>
        <div class="invalid-feedback feedback-pos">
    Please enter email address.
  </div>
    </div></div></div>
    <div class="form-row">
    <div class="col-xl-6"> 
    <div class="form-outline mb-3"> <label class="form-label float-left" for="text"> Bank Slip*</label>
    <input type="file" name="profile_img" id="profile_img" class="form-control" onchange="Filevalidation(this)" accept=".jpg, .jpeg, .png, .pdf" id="validationCustom03" required>
    <div class="invalid-feedback feedback-pos">Please upload bank slip/voucher.</div>
    <div id="error-msg" style="color: red; font-size: 14px; margin-top: 2px;"></div></div></div>
    <div class="col-xl-6"> 
    <div class="form-outline mb-3">
    <label class="form-label float-left" for="exampleFormControlTextarea1">Remark</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remark"></textarea>
</div>

    </div>
</div>
    <input class="btn btn-primary col-3 mt-2" type="submit" value="Submit" name="btnregister"> 
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

















