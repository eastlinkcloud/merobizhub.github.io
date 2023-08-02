<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
$sql="select id,name from country";
$stmt=$conn->prepare($sql);
$stmt->execute();
$arrCountry=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>	
Address*<div class="form-group row mb-3">
<div class="col-sm-4">						
    <select class="form-select  text-dark" id="country" name="province"  id="validationCustom01" required>
							<option value="" >Select Province</option>
							<?php
							foreach($arrCountry as $country){
								echo "<option value='" . $country["id"] . "'>" . $country["name"] ."</option>";
							}
							?>
						</select>
                        <div class="invalid-feedback">
      Please select Province.
    </div>
</div>
<div class="col-sm-4">
<select class="form-select text-dark" id="state" name="district"  id="validationCustom01" required>
						<option value="">Select District </option>
						</select>
                        <div class="invalid-feedback">
      Please select District.
    </div>
</div>
<div class="col-sm-4">
<select class="form-select  text-dark" id="city" name="municipality" id="validationCustom01" required>
							<option value="">Select Municipality </option>
						</select>
                        <div class="invalid-feedback">
      Please select Municipality.
    </div>
</div>
	</div>

	<script>
	$(document).ready(function(){
		jQuery('#country').change(function(){
			var id=jQuery(this).val();
			if(id=='-1'){
				jQuery('#state').html('<option value="-1">Select District</option>');
			}else{
				$("#divLoading").addClass('show');
				jQuery('#state').html('<option value="-1">Select District</option>');
				jQuery('#city').html('<option value="-1">Select Municipality</option>');
				jQuery.ajax({
					type:'post',
					url:'get_data.php',
					data:'id='+id+'&type=state',
					success:function(result){
						$("#divLoading").removeClass('show');
						jQuery('#state').append(result);
					}
				});
			}
		});
		jQuery('#state').change(function(){
			var id=jQuery(this).val();
			if(id=='-1'){
				jQuery('#city').html('<option value="-1">Select Municipality</option>');
			}else{
				$("#divLoading").addClass('show');
				jQuery('#city').html('<option value="-1">Select Municipality</option>');
				jQuery.ajax({
					type:'post',
					url:'get_data.php',
					data:'id='+id+'&type=city',
					success:function(result){
						$("#divLoading").removeClass('show');
						jQuery('#city').append(result);
					}
				});
			}
		});
	});
	</script>
