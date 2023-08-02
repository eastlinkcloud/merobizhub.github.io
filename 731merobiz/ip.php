<form action="" method="post" enctype="multipart/form-data">

 
   <p class="file-info"></p>
   <p id="error"></p>
   <input type="file" onchange="imagePreview(this)">
</form>
<script>
    function imagePreview(input){
   let error = document.querySelector("#error");
   error.innerHTML = "";
   document.querySelector(".file-info").innerHTML = "";
 
   if(input.files){
      let file = input.files[0];
      let reader = new FileReader();
 
      reader.readAsDataURL(file);
      reader.onload = function(){
         if(reader.readyState == 2){
            document.getElementById("image").src = reader.result;
         }
      }
 
      if(file.size > 1024 * 1024 * 2){
         error.innerHTML = "File must be smaller than 2MB";
         return false;
      }
 
      let allowedImageTypes = ["image/jpeg", "image/gif", "image/png"];
      if(!allowedImageTypes.includes(file.type)){
         error.innerHTML = "Allowed file type's are: [ .jpg .png .gif ]";
         return false;
      }
 
      let fileInfo = `
         <ul>
            <li> File name: <span>${file.name}</span> </li>
            <li> File size: <span>${file.size} bytes</span>  </li>
            <li> File type: <span>${file.type}</span> </li>
         </ul>
      `;
      document.querySelector('.file-info').innerHTML = fileInfo;
   }
}
</script>