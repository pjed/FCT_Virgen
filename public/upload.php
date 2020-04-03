<?php
$target_dir = "uploads/"; // Upload directory

$request = 1;
if(isset($_POST['request'])){ 
  $request = $_POST['request'];
}

// Upload file
if($request == 1){ 
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $msg = ""; 
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
    $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Se han subido los archivos correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>';
  }else{    
    $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al subir los archivos.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
              </div>'; 
  } 
  echo $msg;
  exit;
}

// Remove file
if($request == 2){ 
  $filename = $target_dir.$_POST['name'];  
  unlink($filename); 
  exit;
}