<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Details</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <!-- CSS Link -->
    <link rel="stylesheet" href="index.css">
    <!-- JQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="/__/firebase/8.0.2/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->

    <!-- Initialize Firebase -->
    <script src="/__/firebase/init.js"></script>
    
</head>

<body>
    <div class="container">
        <div class="left-grid">
            <img src="assets/user.png">
        </div>
        <div class="right-grid">
            <form class="form-group" action="#" method="POST">
                    <span id="googleCaptchaError" class="captcha-error"></span>
                    <h1>Kindly Fill this Form <svg width="1em" height="0.7em" viewBox="0 0 16 16" class="bi bi-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                      </svg></h1>
                    <!-- User's Name Limit is 50 characters including blank space -->
                    <input type="text" class="form-control textbox name-textbox" placeholder="May I know your Name ?" maxlength="50" name="userName" required><br>
                    <input type="email" id="email" class="form-control textbox" placeholder="Email Please ?" name="userEmail" required><br>
                    <span id="wrongEmail" class="error-message"></span>
                    <!-- Getting input as Number and slicing it -->
                    <input type="number" id="contactNumber" title="Buddy, Come On! Give me correct Contact Number!" name="userPhoneNo"
                    class="form-control textbox" placeholder="What's your Contact No. ?" maxlength="10" required 
                    oninput="javascript: if (this.value.length > this.maxLength) 
                    {this.value = this.value.slice(0, this.maxLength);}"><br>
                    <span id="wrongContactNumber" class="error-message"></span>
                    <!-- I have assumed User is minimum 3+ years old and maximum 79 years old -->
                    <input id="dob"class="form-control date-picker" type="date" min="1937-01-01" max="2016-12-31" required name="userDob"><br>
                    <input type="text" class=" form-control textbox age" id="userAge" placeholder="Select Your Age Please ! " name="userAge" readonly><br>
                    <input type="submit" class="btn submit" name="submit" value="Submit">
                    <!-- To Pass Token -->
                    <input type="hidden" id="token" name="token">
                    <!-- For taking Age value-->
                    <input type="hidden" id="hiddenAge" name="hiddenAge">
            </form>
        </div>
    </div>
    <!-- Google Captcha - Recaptha API -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LdJLOIZAAAAAFb957AYRYKIP3ZMJa8m_SQgZB01"></script>
    <script>
        grecaptcha.ready(function() {
           grecaptcha.execute('6LdJLOIZAAAAAFb957AYRYKIP3ZMJa8m_SQgZB01', 
           {action: 'submit'}).then(function(token) {
               console.log(token);
               $("#token").val(token);
           });
        });
        
    </script>

    <script>
        //Contact Number Validation : Total Digits should be 10
        $("#contactNumber").change(function(){
            var contactNo = $("#contactNumber").val();
            if(contactNo<1111111111){
                $("#wrongContactNumber").text("Don't Hurt Me by giving Wrong Number!");
                $("#contactNumber").val("");
            }
            else{
                $("#wrongContactNumber").text("");
            }
        });
        //Email Validation : Works in Many Cases but not in all cases
        $("#email").change(function(){
            var userEmail = $("#email").val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var emailRes = regex.test(userEmail);
            //console.log("Email Result: "+emailRes);
            if(emailRes==false){
                $("#wrongEmail").text("Dood, Proper Email Please!");
                //Emptying Email TextBox if entered Email is wrong
                $("#email").val("");
            }
            else{
                $("#wrongEmail").text("");
            }
        });
        //Age Calculation based only on the SELECTED YEAR
        $("#dob").change(function(){
            var currentYearDate = new Date();
            var currentYear = currentYearDate.getFullYear();
            var res=$("#dob").val();
            var str_split = res.split("-");
            var selectedYear = str_split[0];
            var userAge = parseInt(currentYear) - parseInt(selectedYear);
            //console.log(userAge);
            // var currentPlaceHolder = $("#userAge")[0];
            // currentPlaceHolder.placeholder = "Your Age : "+userAge+" Years";
            $("#userAge").val("Age : "+userAge+" Years");
            $("#hiddenAge").val(userAge);
        });
    </script>
    <?php 
    if(isset($_POST['submit'])){
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            'secret' => "6LdJLOIZAAAAACD3lDPV0x67IZIv6lqeWurYrw8g",
			'response' => $_POST['token']
        ];

        //Making a proper URL encoded query string
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        $response = file_get_contents($url,false,$context);
        $res = json_decode($response,true);
        

        //0.0 is the bot ; 1.0 -> most likely an user
        if($res['score']>0.0){
            echo '<script type="text/JavaScript">
            $("#googleCaptchaError").text("*Captcha Verification Successfull");
            $("#googleCaptchaError").css({"color": "green", "font-size": "1.2em", "font-weight": "800"});
            </script>';

            //MySQL Connection
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
            // Connected successfully
            $nameValue=$_POST['userName'];
            $emailValue=$_POST['userEmail'];
            $phoneNoValue=$_POST['userPhoneNo'];
            $dobValue=$_POST['userDob'];
            $ageValue=$_POST['hiddenAge'];
            // echo $nameValue;
            // echo $emailValue;
            // echo $phoneNoValue;
            // echo $dobValue;
            // echo $ageValue;
            $insert = "INSERT INTO formdetails(name,email,phoneNo,dob,age)" . " VALUES(?, ?, ?, ?, ?)";
            $q = mysqli_prepare($conn, $insert);
            mysqli_stmt_bind_param($q, "ssssi", $nameValue, $emailValue, $phoneNoValue, $dobValue, $ageValue);
            mysqli_stmt_execute($q);
            mysqli_close($conn);
            }

            echo '<script type="text/JavaScript">
            setTimeout(function (){
                window.location.replace("loggedIn.php");              
              }, 2000);
            </script>';
        }
        else{
            echo '<script type="text/JavaScript">
            $("#googleCaptchaError").text("*Google Captcha Verification Failed");
            </script>';
        }
    }
?>
</body>

</html>