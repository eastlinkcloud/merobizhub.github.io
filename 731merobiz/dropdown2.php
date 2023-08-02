<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
$sql = "SELECT category_id, category_name FROM category WHERE status = 'active'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="form-row">
    <div class="col-xl-4">
        Category*
        <select name="category" id="category" class="form-select" id="validationCustom04" required>
            <option value="">Select Category</option>
            <?php
            foreach ($categories as $category) {
                echo "<option value='{$category['category_id']}'>{$category['category_name']}</option>";
            }
            ?>
        </select>
        <div class="invalid-feedback ">
      Please select category.
    </div>
    </div>
    <div class="col-xl-4">
        Product*
        <select name="product" id="product" class="form-select"  id="validationCustom04" required>
            <option value="">Select Product</option>
        </select>
        <div class="invalid-feedback ">
      Please select product.
    </div>
    </div>

    <div class="col-xl-4">
    Price*<div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Rs.</div>
        </div>
        <input type="text" name="price" id="price" class="form-control bg-light" id="inlineFormInputGroup" readonly>
      </div>
    `</div>
    </div>

<script>
$(document).ready(function() {
    $('#category').change(function() {
        var categoryID = $(this).val();
        if (categoryID) {
            $.ajax({
                url: 'get-products.php', // Update the URL with the correct file name or endpoint
                type: 'POST',
                data: {category: categoryID},
                success: function(response) {
                    $('#product').html(response);
                    $('#price').val(''); // Reset price when category changes
                }
            });
        } else {
            $('#product').html('<option value="">Select Product</option>');
            $('#price').val('');
        }
    });

    $('#product').change(function() {
        var productID = $(this).val();
        if (productID) {
            $.ajax({
                url: 'get-price.php', // Update the URL with the correct file name or endpoint
                type: 'POST',
                data: {product: productID},
                success: function(response) {
                    $('#price').val(response);
                }
            });
        } else {
            $('#price').val('');
        }
    });
});
</script>
