<html>
    <head>
        <title>Login Page</title>
        <style>
           body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

h1 {
    text-align: center;
    color: #333;
    font-size: 2rem;
    margin-bottom: 20px;
}

form {
    background: #fff;
    padding: 20px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

p {
    margin-bottom: 15px;
    color: #555;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
}

button {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    margin-right: 10px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

button[name="register"] {
    background-color: #28a745;
}

button[name="register"]:hover {
    background-color: #1e7e34;
}

a {
    text-decoration: none;
    color: #007BFF;
    font-size: 1rem;
    transition: color 0.3s;
}

a:hover {
    color: #0056b3;
}

        </style>
    </head>
    <body>
        <h1>Login &nbsp;&nbsp;</h1>
        
        <form action="login.php" method="post">
            <p>Username
                <input type="text" name="username" id="">
            </p>
            <p>Password
                <input type="password" name="password" id="">
            </p>
            <p><button type="submit" name="login">Login</button>&nbsp;&nbsp;
            <button type="submit" name="register">Register</button>&nbsp;&nbsp;
            <a href="index.html">Home</a>
        </p>
        </form>
    </body>
</html>

<?php    
    $con = mysqli_connect("localhost", "root", "")
    or die("  Could not connect to the server<br>" .mysqli_connect_error());
    echo "  Connected to the server<br>";
    mysqli_select_db($con, "cars")
    or die("  Could not connect to the DB<br>" .mysqli_error($con));
    echo "  Connected to DB<br>"; 

    extract($_POST);
    if(isset($register))
    {
        if(empty($username) && empty($password))
        {
            echo '<script>alert("Both fields are required")</script>';
        }
        else
        {
            $password = md5($password);
            $dbI = mysqli_query($con, "INSERT into login 
            values ('$username', '$password')")
            or die("Could not insert into table.".mysqli_error($con));
            echo "" .mysqli_affected_rows($con)." record(s) added<br>";
        }
    }
    if(isset($login))
    {
        if(empty($username) && empty($password))
        {
            echo '<script>alert("Both fields are required")</script>';
        }
        else
        {
            $password = md5($password);
            //Print data
            $dbP =  mysqli_query($con, "SELECT * from login 
            where username='$username' AND password='$password'")
            or die("Could not find the table.".mysqli_error($con));
            if(mysqli_num_rows($dbP)>0)
            {
                echo "<table border='1' width='40%'>";
                echo "<tr><th>username</th><th>Password</th></tr>";
                while ($row = mysqli_fetch_array($dbP))
                {
                    echo "<tr><td>{$row['username']}</td>";
                    echo "<td>{$row['password']}</td></tr>";
                }
            }
            else
            {
                echo '<script>alert("Wrong User Details")</script>';
            }
            echo "</table><br>";
        }
    }

    mysqli_close($con);
?>