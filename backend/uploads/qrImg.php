<?php

//Convert image
/**
* $image - source of image
* $dpi - resolution to convert @param E.g.: 72dpi or 300dpi
*/
$image = 'IMG_20170213_101551.jpg';
$dpi = '300dpi';
function px2cm($image, $dpi) {
    #Create a new image from file or URL
    $img = ImageCreateFromJpeg($image);

    #Get image width / height
    $x = ImageSX($img);
    $y = ImageSY($img);
   
    #Convert to centimeter
    $h = $x * 2.54 / $dpi;
    $l = $y * 2.54 / $dpi;
   
    #Format a number with grouped thousands
    $h = number_format($h, 2, ',', ' ');
    $l = number_format($l, 2, ',', ' ');
   
    #add size unit
    $px2cm[] = $h."cm";
    $px2cm[] = $l."cm";
   
    #return array w values
    #$px2cm[0] = X
    #$px2cm[1] = Y   
    return $px2cm;
}

$result = px2cm($image, $dpi);

print ($result[0]." x ".$result[1]);

/* ------------------------------------------------------- */

	//Image convert
	$sourceImg = 'IMG_20170213_101551.jpg';
	$fileName = $sourceImg;
    $kaboom = explode(".", $sourceImg); // Split file name into an array using the dot
    $fileExt = end($kaboom); // Now target the last array element to get the file extension

    // Include the file that houses all of our custom image functions
    require "php_image_lib.php";

    // ---------- Start Universal Image Resizing Function --------
    $target_file = 'IMG_20170213_101551.jpg';
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

    // ----------- End Convert to JPG Function -----------
    // Display things to the page so you can see what is happening for testing purposes
    // echo "The file named <strong>$fileName</strong> uploaded successfuly.<br /><br />";
    // echo "The file extension is <strong>$fileExt</strong><br /><br />";
	
?>