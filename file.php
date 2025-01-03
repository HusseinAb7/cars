<?php
    $target_dir = "upload/";
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
    $uploadOK = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    if(isset($_POST["submit"]))
    {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false)
        {
            echo "File is an image - " .$check["mime"].".";
            $uploadOK = 1; 
        }
        else
        {
            echo "File is not an image.";
            $uploadOK = 0;
        }
    }
    if(file_exists($target_file))
    {
        echo "Sorry, file already exists.";
        $uploadOK = 0;
    }
    if($_FILES["fileToUpload"]["size"] > 500000)
    {
        echo "Sorry, file is too large.";
        $uploadOK = 0;
    }
    if($imageFileType !="jpg" && $imageFileType !="png" &&
    $imageFileType !="gif")
    {
        echo "Sorry, only JPG, PNG and GIF files are allowed.";
        $uploadOK = 0;
    }
    if($uploadOK == 0)
    {
        echo "Sorry, your file was not uploaded.";
    }
    else
    {
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
        {
            echo "The file " .basename($_FILES["fileToUpload"]["tmp_name"]).
            " has been uploaded";
        }
        else
        {
            echo "Sorry, there was an error upoading your file.";
        }
    }
?>