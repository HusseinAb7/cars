<?php 
$email=filter_input(input_post,'email');
$password=filter_input(INPUT_POST,'password');
if(!empty($email)){
    if(!empty($password)){
        $host="localhost";
        $dbemail="root";
        $dbpassword="";
        $dbname="test"

        $conn= new mysqli ($host,$dbemail,$dbpassword,$dbname);

        $sql="INSERT INTO regesteration ( email , password) values('$email' ,'$password')";
        if($conn->query($sql)){
            echo "new record added"
        }

    }else{
        echo "pass shouldnt be empty"
        die();
    }
}else{
    echo "email shouldnt be empty"
    die();
}