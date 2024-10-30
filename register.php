<?php
$db_conn       = NULL;
$db_servername = "localhost";
$db_username   = "root";
$db_password   = "";
$db_name       = "msec";
$host          ="localhost";

function get_db_connection() {
	global $db_conn;
	global $db_servername;
	global $db_username;
	global $db_password;
	global $db_name;

	if ($db_conn != NULL) {
		return $db_conn;
	} else {
		$db_conn = mysqli_connect($db_servername, $db_username, $db_password, $db_name);
		if (!$db_conn) {
			die("Connection failed: ".mysqli_connect_error());
		} else {
			return $db_conn;
		}
	}
}
$flag = 0;
//$sem=preg_split("/[\d]/", $_GET['name'], 2);


//Define variables and initialize with empty values
$username = $regno = $clg = $dept = $gender = $state = $city = $event = $phno = $email = "";
$username_err = $regno_err = $clg_err = $dept_err = $gender_err = $state_err = $city_err = $event_err = $phno_err = $email_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validate Username
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Please enter a username.";
    } else{
        $username = $input_username;
    }

    // Validate Register Number
    $input_regno = trim($_POST["regno"]);
    if(empty($input_regno)){
        $regno_err = "Please enter a register number.";     
    } else{
        $regno = $input_regno;
    }

    // Validate College Name
    $clg = trim($_POST["clg"]);

    // Validate Department
    $dept = trim($_POST["dept"]);

    // Validate Gender
    if(isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    }

    // Validate State
    $state = $_POST["state"];

    // Validate City
    $city = $_POST["city"];

    // Validate Event
    $input_event = trim($_POST["event"]);
    if(empty($input_event)){
        $event_err = "Please enter an event name.";
    } else{
        $event = $input_event;
    }

    // Validate Phone Number
    $input_phno = trim($_POST["phno"]);
    if(empty($input_phno)){
        $phno_err = "Please enter a phone number.";     
    } else{
        $phno = $input_phno;
    }

    // Validate Email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an email.";     
    } else{
        $email = $input_email;
    }

    // Check input errors before inserting in database
    // if(empty($name_err) && empty($reg_err)){ 
        // Prepare an update statement
        $db_conn = get_db_connection();
       

    if(isset($_POST['submit']))
    {
        $sql = "INSERT INTO registration (username, regno, clg, dept, gender, state, city, event, phno, email) VALUES ('$username', '$regno', '$clg', '$dept', '$gender', '$state', '$city', '$event', '$phno', '$email')";
        if($result = mysqli_query($db_conn, $sql))
       {
        $flag=1;
       }
       else{
        $flag=2;
       }
       mysqli_close($db_conn);
        
    }      

    // Close connection
   

}
    // Your registration logic goes here...

    if(isset($_POST['submit'])) {
        if($flag == 1) {
            echo "<script>
            var popupWidth = 500;
            var popupHeight = 400;
            var screenWidth = window.screen.width;
            var screenHeight = window.screen.height;
            var leftPosition = (screenWidth - popupWidth) / 2;
            var topPosition = (screenHeight - popupHeight) / 2;
            var popup = window.open('', '_blank', 'width=' + popupWidth + ',height=' + popupHeight + ',left=' + leftPosition + ',top=' + topPosition);
            
            popup.document.write(`<!DOCTYPE html>
            <html lang=\"en\">
            <head>
                <meta charset=\"UTF-8\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                <title>Registration Success</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        text-align: center;
                    }
                    .success-message {
                        margin-top: 100px;
                        padding: 20px;
                        background-color: #dff0d8;
                        border: 1px solid #3c763d;
                        color: #3c763d;
                        border-radius: 5px;
                        max-width: 400px;
                        margin-left: auto;
                        margin-right: auto;
                    }
                    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
            
                    body {
                        background: #170F1E;
                        display: grid;
                        height: 100vh;
                        place-items: center;
                        -webkit-font-smoothing: antialiased;
                        width: 100vw;
                    }
            
                    button {
                        animation: 1.5s ease infinite alternate running shimmer;
                        background: linear-gradient(90deg, #FFE27D 0%, #64E3FF 30%, #9192FF 85%);
                        background-size: 200% 100%;
                        border: none;
                        border-radius: 6px;
                        box-shadow: -2px -2px 10px rgba(255, 227, 126, 0.5), 2px 2px 10px rgba(144, 148, 255, 0.5);
                        color: #170F1E;
                        cursor: pointer;
                        font-family: 'Inter', sans-serif;
                        font-size: 16px;
                        font-weight: 670;
                        line-height: 24px;
                        overflow: hidden;
                        padding: 12px 24px;
                        position: relative;
                        text-decoration: none;
                        transition: 0.2s;
            
                        svg {
                            left: -20px;
                            opacity: 0.5;
                            position: absolute;
                            top: -2px;
                            transition: 0.5s cubic-bezier(.5,-0.5,.5,1.5);
                        }
            
                        &:hover svg {
                            opacity: 0.8;
                            transform: translateX(50px) scale(1.5);
                        }
            
                        &:hover {
                            transform: rotate(-3deg);
                        }
            
                        &:active {
                            transform: scale(0.95) rotate(-3deg);
                        }
                    }
            
                    @keyframes shimmer {
                        to {
                            background-size: 100% 100%;
                            box-shadow: -2px -2px 6px rgba(255, 227, 126, 0.5), 2px 2px 6px rgba(144, 148, 255, 0.5);
                        }
                    }
            
                </style>
            </head>
            <body>
                <div class=\"success-message\">
                    <h2>Registration Successful!</h2>
                    <p>Your registration has been successfully submitted.</p>
                    <p>Thank you for registering.</p>
                    <button  onclick=window.close() >
                        Close
                        <svg width=\"79\" height=\"46\" viewBox=\"0 0 79 46\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                            <g filter=\"url(#filter0_f_618_1123)\">
                                <path d=\"M42.9 2H76.5L34.5 44H2L42.9 2Z\" fill=\"url(#paint0_linear_618_1123)\"/>
                            </g>
                            <defs>
                                <filter id=\"filter0_f_618_1123\" x=\"0\" y=\"0\" width=\"78.5\" height=\"46\" filterUnits=\"userSpaceOnUse\" color-interpolation-filters=\"sRGB\">
                                    <feFlood flood-opacity=\"0\" result=\"BackgroundImageFix\"/>
                                    <feBlend mode=\"normal\" in=\"SourceGraphic\" in2=\"BackgroundImageFix\" result=\"shape\"/>
                                    <feGaussianBlur stdDeviation=\"1\" result=\"effect1_foregroundBlur_618_1123\"/>
                                </filter>
                                <linearGradient id=\"paint0_linear_618_1123\" x1=\"76.5\" y1=\"2.00002\" x2=\"34.5\" y2=\"44\" gradientUnits=\"userSpaceOnUse\">
                                    <stop stop-color=\"white\" stop-opacity=\"0.6\"/>
                                    <stop offset=\"1\" stop-color=\"white\" stop-opacity=\"0.05\"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </button>
                </div>
            
                
            </body>
            </html>`);
    
                  </script>";
    
    
        } elseif($flag == 2) {
            echo "<script>alert('Registration failed. Please try again.');</script>";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <!-- Main css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section class="header">
    <nav>
    <img src="picture.png">
    <h1>MEENAKSHI SUNDARARAJAN ENGINEERING COLLEGE</h1>
    </nav>   
    </section>
    <div class="main">
        <div class="container">
            <div class="booking-content">
                <div class="booking-image">
                    <img class="booking-img" src="image.jpg" alt="Booking Image">
                </div>
                <div class="booking-form">
                    <form id="booking-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <h2>Register Here! </h2>
                        
                        <div class="form-group form-input">
                            <input type="text" id="username" name="username" value="" required/>
                            <label class="form-label" for="username">Username</label>
                        </div>
                        <div class="form-group form-input">
                            <input type="number" id="regno" name="regno" value="" required/>
                            <label class="form-label" for="regno">Register Number</label>
                        </div>
                        <div class="form-group form-input">
                            <input type="text" id="clg" name="clg" value="" required/>
                            <label class="form-label" for="clg">College Name</label>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="select-list">
                                <select id="dept" name="dept" required>
                                    <option value="dept">Department</option>
                                    <option value="mech">Mechanical Engineering</option>
                                    <option value="civil">Civil Engineering</option>
                                    <option value="ece">Electrical and Communication Engineering</option>
                                    <option value="eee">Electrical and Electronical Engineering</option>
                                    <option value="aids">Artificial Intelligence and Data Science</option>
                                    <option value="it">Information Technology</option>
                                    <option value="cse">Computer Science Engineering</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="select-list">
                                <select name="gender" id="gender" required>
                                    <option value="">Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="select-list">
                                <select id="state" onchange="populateCities()" name="state">
                                    <option value="">Select State</option>
                                    <option value="tamil">Tamil Nadu</option>
                                    <option value="kerala">Kerala</option>
                                    <option value="karna">Karnataka</option>
                                    <option value="andhra">Andhra Pradesh</option>
                                    <!-- Add more states as needed -->
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="select-list">
                                <select id="city" name="city">
                                    <option value="">Select City</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-input">
                            <input type="text" id="event" name="event" value="<?php echo isset($_GET['event']) ? htmlspecialchars($_GET['event']) : ''; ?>" required/>
                            <label class="form-label" for="event">Event</label>
                        </div>
                        <div class="form-group form-input">
                            <input type="number" name="phno" id="phno" value="" required />
                            <label for="phno" class="form-label">Phone Number</label>
                        </div>
                        <div class="form-group form-input">
                            <input type="email" id="email" name="email" required/>
                            <label class="form-label" for="email">Email</label>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="checkbox" id="recheck-all" name="recheck-all">
                            <label class="checkbox-label" for="recheck-all">I am here to verify that all the above details are correct.</label>
                        </div>

                        <br>
                        <div class="form-submit">
                            <center>
                                <button type="submit" name="submit" onclick="open()">
                                    <img class="hand-icon" src="hand.png" alt="Hand Icon">
                                    <span style="font-size: 20px;">Register</span> <!-- Increased font size -->
                                </button>
                                </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="jquery.min.js"></script>
    <script src="main.js"></script>
    <script>
        <script>
    function open() {
        window.location.href = 'index.html'; // Change 'event_page.html' to the desired URL
    }
</script>

        function toggleNav() {
            var navLinks = document.getElementById("navLinks");
            navLinks.classList.toggle("show");
        }
        function populateCities() {
            var stateSelect = document.getElementById("state");
            var citySelect = document.getElementById("city");
            var stateValue = stateSelect.value;
            citySelect.innerHTML = ""; // Clear existing options

            if (stateValue === "tamil") 
            {
                var cities = [  "Chennai", "Coimbatore", "Madurai", "Tiruchirappalli", "Salem", "Tirunelveli", "Thanjavur", "Erode", "Vellore", "Kanchipuram", "Thoothukudi", "Karur", "Nagercoil", "Cuddalore", "Hosur", "Pollachi", "Dindigul", "Ramanathapuram", "Krishnagiri", "Neyveli", "Ooty", "Tiruppur", "Villupuram", "Avadi", "Tiruvannamalai", "Karaikkudi", "Kumbakonam", "Rajapalayam", "Pudukkottai", "Tambaram", "Tiruvallur", "Nellai", "Sivakasi", "Ambur", "Nagapattinam", "Vaniyambadi", "Arakkonam", "Virudhunagar", "Mayiladuthurai", "Dharmapuri", "Kanyakumari", "Tirupathur", "Udumalaipettai", "Aruppukkottai", "Pallavaram", "Tindivanam", "Ranipet", "Tenkasi"]; // Cities for TamilNadu
            } 
            else if (stateValue === "kerala") 
            {
                var cities = ["Thiruvananthapuram", "Kochi", "Kozhikode", "Thrissur", "Kollam", "Alappuzha", "Palakkad", "Kannur", "Kottayam", "Malappuram", "Pathanamthitta", "Kasaragod", "Wayanad", "Idukki"]; // Cities for Kerala 
            }
            else if (stateValue === "karna") 
            {
                var cities = ["Bengaluru", "Mysuru", "Hubballi-Dharwad", "Mangaluru", "Belagavi", "Kalaburagi", "Davanagere", "Ballari", "Vijayapura", "Shivamogga", "Tumakuru", "Hassan", "Raichur", "Bidar", "Hospet", "Udupi", "Chitradurga", "Kolar", "Mandya", "Chikkamagaluru", "Gadag-Betageri", "Haveri", "Chamarajanagar", "Ramanagara", "Bagalkot", "Chikkaballapur", "Yadgir", "Karwar", "Vijayapura"]; // Cities for Karnataka 
            }
            else if (stateValue === "andhra") 
            {
                var cities = ["Visakhapatnam", "Vijayawada", "Guntur", "Nellore", "Kurnool", "Rajahmundry", "Tirupati", "Kadapa", "Kakinada", "Anantapur", "Vizianagaram", "Eluru", "Ongole", "Nandyal", "Machilipatnam", "Adoni", "Tenali", "Proddatur", "Chittoor", "Hindupur", "Bhimavaram", "Srikakulam", "Gudivada", "Narasaraopet", "Tadipatri", "Madanapalle", "Chirala"]; // Cities for Andhra Pradesh
            }
            // Add options to the city dropdown
            cities.forEach(function(city) 
            {
                var option = document.createElement("option");
                option.text = city;
                option.value = city.toLowerCase().replace(/\s+/g, ''); // Convert city name to lowercase and remove spaces
                citySelect.add(option);
            });
    }
    </script>
</body>
</html>