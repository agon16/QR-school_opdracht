<?php

/**
Some lines have been commented a bit in the way just for debugging purposes ^_^
*/
	
$target_dir = "";
$target_file = $target_dir . basename($_FILES["qr_image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["qr_image"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
// if ($_FILES["qr_image"]["size"] > 500000) {
//     // echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["qr_image"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["qr_image"]["name"]). " has been uploaded.";
    } else {
        // echo "Sorry, there was an error uploading your file.";
    }
}

//Convert image
/*** $image - source of image */
/* ------------------------------------------------------- */

	//Image convert
	$sourceImg = $target_file;
	$fileName = $sourceImg;
    $kaboom = explode(".", $sourceImg); // Split file name into an array using the dot
    $fileExt = end($kaboom); // Now target the last array element to get the file extension

    // Include the file that houses all of our custom image functions
    require "php_image_lib.php";

    // ---------- Start Universal Image Resizing Function --------
    $target_file = $sourceImg;
    $resized_file = 'RESIZED_' . $fileName;
    $wmax = 800;
    $hmax = 250;
    ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
    // ----------- End Universal Image Resizing Function ----------

    // ---------- Start Convert to JPG Function --------
    if (strtolower($fileExt) != "jpg") {
        $target_file = 'RESIZED_' . $fileName;
        $new_jpg = 'RESIZED_' . $fileName . $kaboom[0].".jpg";
        ak_img_convert_to_jpg($target_file, $new_jpg, $fileExt);
    }

    require '../lib/QrReader.php'; //Import QR detector

    $qrcode = new QrReader($resized_file);
    print $qrcode = $qrcode->text();

    //Delete images
    unlink($sourceImg);
    unlink('RESIZED_' . $fileName);

    header("Location: ../../login.php?qrcode=".$qrcode); //Go back to login screen

?>