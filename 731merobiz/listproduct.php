<?php
session_start();
$title = 'Product List';
include('include/connection.php');
include('include/top.php');
include('include/admintop.php');
?>

<!-- Include the Bootstrap Toast CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<h3 class="ml-3">Product List</h3>
<a href="addproduct.php" class="mt-4 btn btn-sm btn-success">+ Product</a>
<div class="card shadow mb-2">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 50px;">S.No.</th>
                        <th>Category Name</th>
                        <th>Product Name</th>
                        <th style="width: 95px;">Price</th>
                        <th style="width: 90px;">Status</th>
                        <th style="width: 90px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM product ORDER BY p_id DESC";

                    $stmt = $conn->query($query);
                    $serial = 1; // initialize counter variable

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr class='tr-shadow'>";
                        echo "<td>$serial</td>";
                        $category_id = $row['category_id'];
                        $category_name = "";
                        $query = "SELECT * FROM category WHERE category_id = :category_id";
                        $stmt_category = $conn->prepare($query);
                        $stmt_category->bindParam(':category_id', $category_id);
                        $stmt_category->execute();
                        $category = $stmt_category->fetch(PDO::FETCH_ASSOC);
                        if ($category) {
                            $category_name = $category['category_name'];
                        }
                        echo "<td>{$category_name}</td>";
                        echo "<td>{$row['product_name']}</td>";
                        echo "<td>{$row['price']}</td>";
                        echo "<td>{$row['status']}</td>";
                        echo "<td>
                        <a href='viewproduct.php?p_id={$row['p_id']}' >
                        <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-eye-fill text-success mr-1' viewBox='0 0 16 16'>
                        <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                        <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                      </svg>
                    </a>
                            <a href='editproduct.php?p_id={$row['p_id']}' >
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-pencil-square mr-1' viewBox='0 0 16 16'>
                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                </svg>
                            </a>
                            <a href='deleteproduct.php?p_id={$row['p_id']}' onclick='return confirmDelete()' >
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-trash3 text-danger' viewBox='0 0 16 16'>
                                    <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z'/>
                                </svg>
                            </a>

                        </td>";
                        echo "</tr>";
                        $serial++; // increment counter variable
                    }
                    ?>
                                       <script>
                        function confirmDelete() {
                            return confirm("Are you sure you want to delete this record?");
                        }
                    </script>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap Toast -->
<div class="toast" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="me-auto">Success</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Category updated successfully.
    </div>
</div>

<!-- Include the Bootstrap Toast JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
include('include/foot.php');

?>





        