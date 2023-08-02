<?php
session_start();
$title = 'Success Page';
include('include/top.php');
include('include/admintop.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="alert alert-success mt-4">
        <h4 class="alert-heading">Success!</h4>
        <p><?php echo $_SESSION['success_message']; ?></p>
        <hr>
        <p class="mb-0">You have successfully registered a new customer.</p>
    </div>
</div>

<?php
include('include/foot.php');
?>
