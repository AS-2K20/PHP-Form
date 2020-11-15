<?php 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dataBaseName="formdb";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dataBaseName);

        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        else{
            mysqli_select_db($conn,$dataBaseName);
            $result = mysqli_query($conn,"SELECT * FROM formdetails ORDER BY id ASC");  

            echo '<table id="hor-zebra" class="pure-table pure-table-horizontal" summary="Datapass">
                <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">DOB</th>
                <th scope="col">Age</th>
                </tr>
                </thead>
                <tbody>';

                while($row = mysqli_fetch_array( $result )) {                
                    // Print out the contents of each row into a table
                    echo "<tr" . "><td>"; 
                    echo $row['id'];
                    echo "</td><td>"; 
                    echo $row['name'];
                    echo "</td><td>"; 
                    echo $row['email'];
                    echo "</td><td>"; 
                    echo $row['phoneNo'];
                    echo "</td><td>"; 
                    echo $row['dob'];
                    echo "</td><td>";
                    echo $row['age'];
                    echo "</td></tr>";
                } 
            
                echo "</tbody></table>";
               mysqli_close($conn);
        }
    ?>