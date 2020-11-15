<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged In</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <!-- CSS Link -->
    <link rel="stylesheet" href="loggedIn.css">
    <!-- Pure CSS Link -->
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css">
    <!-- JQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1 class='heading'>Existing Form Details</h1><br>
    <?php 
        require_once("displayFormDetails.php");   
    ?>
    <form action="#" method="POST">
    <div class="delete-div">
        <h3>Deleting Row based on ID</h3>
        <?php 
           if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }
            else{
                $conn = mysqli_connect($servername, $username, $password, $dataBaseName);
                mysqli_select_db($conn,$dataBaseName);
                $query = "SELECT id from formdetails";
                $result = mysqli_query($conn,$query);
                echo "<select class='drop-down' id='deleteSelect' name='deleteSelect' required>";
                echo "<option value=''>--Please Select an ID--</option>";
                while($row=mysqli_fetch_array($result)){                    
                    echo "<option value='".$row['id'] . "'>" . $row['id'] . "</option>";
                }
                echo '</select>';
                mysqli_close($conn);
            }
        ?>
        <br/>
        <input type="submit" class="delete-btn" id ="deleteBtn" value="Delete" name="deleteBtn">
    </div>
    </form>

    <form action="#" method="POST">
    <div class="delete-div update-div">
        <h3>Updating Email based on ID</h3>
        <?php 
           if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }
            else{
                $conn = mysqli_connect($servername, $username, $password, $dataBaseName);
                mysqli_select_db($conn,$dataBaseName);
                $query = "SELECT id from formdetails";
                $result = mysqli_query($conn,$query);
                echo "<select class='drop-down' id='updateSelect' name='updateSelect' required>";
                echo "<option value=''>--Please Select an ID--</option>";
                while($row=mysqli_fetch_array($result)){                    
                    echo "<option value='".$row['id'] . "'>" . $row['id'] . "</option>";
                }
                echo '</select>';
                mysqli_close($conn);
            }
        ?>
        <br/>
        <input type="text" id="newEmail" name="newEmail" class="form-control textbox" placeholder="Enter the Updated Email" required>
        <span id="warningText"></span><br/>
        <input type="submit" class="delete-btn update-btn" id ="updateBtn" value="Update" name="updateBtn">
    </div>
    </form>

    <input type="submit" class="btn submit"id="mainPage" value="Go Back To Main Page">
    <script>
        //Go back Button
        $("#mainPage").click(function(){
            window.location.replace("index.php");             
        });
        //Email Validation : Works in Many Cases but not in all cases
        $("#newEmail").change(function(){
            var userEmail = $("#newEmail").val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var emailRes = regex.test(userEmail);
            //console.log("Email Result: "+emailRes);
            if(emailRes==false){
                $("#warningText").text("Dood, Proper Email Please!");
                //Emptying Email TextBox if entered Email is wrong
                $("#newEmail").val("");
            }
            else{
                $("#wrongEmail").text("");
            }
        });
    </script>
    <?php 
        if(isset($_POST['deleteBtn'])){
            $id = $_POST['deleteSelect'];
            $conn = mysqli_connect($servername, $username, $password, $dataBaseName);
            mysqli_select_db($conn,$dataBaseName);
            $deleteQuery = "DELETE from formdetails where id= $id";
            $result = mysqli_query($conn,$deleteQuery);
            mysqli_close($conn);
            //refreshing the page
            header("Refresh:0");
        }
        if(isset($_POST['updateBtn'])){
            $id = $_POST['updateSelect'];
            $updatedEmail = $_POST['newEmail'];
            $conn = mysqli_connect($servername, $username, $password, $dataBaseName);
            mysqli_select_db($conn,$dataBaseName);
            $deleteQuery = "UPDATE formdetails set email='$updatedEmail' where id= $id";
            $result = mysqli_query($conn,$deleteQuery);
            mysqli_close($conn);
            //refreshing the page
            header("Refresh:0");
        }
    ?>
</body>
</html>