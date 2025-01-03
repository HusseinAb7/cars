<?php
    $con = mysqli_connect("localhost", "root", "")
    or die("Could not connect to the server<br>" .mysqli_connect_error());
    echo "Connected to the server<br>";
    mysqli_select_db($con, "")
    or die("Could not connect to the DB<br>" .mysqli_error($con));
    echo "Connected to the DB<br>";
    
    $q = $_REQUEST["q"];
    $sql = "SELECT *from cars where id = '".$q."'";
    $result = mysqli_query($con, $sql);
    echo "<table width='80%' border='1'>
    <tr><th>name</th><th>model</th><th>year</th>
    <th>price</th><th>description</th><tr>";

    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['model']."</td>";
        echo "<td>".$row['price']."</td>";
        echo "<td>".$row['year']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "</tr>";
    }
    echo "<table>";
    
    mysqli_close($con);
?>