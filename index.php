<!-- Developed by: Danjuma Jubril Charles
    email: charlesjubril@yahoo.com
            charlesjubril@gmail.com -->
<?php
	session_start();	
	unset($_SESSION['id']);
	unset($_SESSION['name']);
	include("connn.php");
	
	if (isset($_REQUEST['login'])){
		$p = $_POST['password'];
		$e = $_POST['username'];
		$s = "SELECT * FROM staff WHERE username = '$_POST[username]' AND password = '$_POST[password]'";
		$re = mysqli_query($link, $s);
		if (mysqli_num_Rows($re) > 0){
			$data = mysqli_fetch_array($re);
			$_SESSION['id'] = $data['id'];
			header("location: landing2.php");
		}else{
			$s1 = "SELECT * FROM student WHERE matric = '$_POST[username]' AND password = '$_POST[password]'";
			$re1 = mysqli_query($link, $s1);
			if (mysqli_num_Rows($re1) > 0){
			$data = mysqli_fetch_array($re1);
			$_SESSION['id'] = $data['matric'];
			header("location: landing.php");
		}else{
			echo '<script>alert("Login Error, Please try again using the correct login details...")</script>';
        }
    }}

    if (isset($_REQUEST['enrol'])){
		$s = "SELECT * FROM student WHERE matric = '$_POST[matric]'";
		$re = mysqli_query($link, $s);
		if (mysqli_num_Rows($re) > 0){
			echo '<script>alert("Student Already Registered, Try Again.")</script>';
		}else{
		$sql="INSERT INTO student (name, matric, school, dept, level, email, phone)
			VALUES
		('$_POST[name]','$_POST[matric]','$_POST[school]','$_POST[dept]','$_POST[level]','$_POST[email]','$_POST[phone]')";
        $r = mysqli_query($link, $sql);
        if($r = true){
            echo '<script>alert("Student Successfully Registered\n Student can now proceed to login with matric number and; \n password=123456")</script>';
        }else{
            echo '<script>alert("Enrolment Error, Try Again !!!")</script>';
        }
		
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ITF</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

    <section id="intro" class="clearfix">
        <div class="container">

            <div class="intro-img">
                <img src="img/about-extra-2.svg" alt="" class="img-fluid">
            </div>

            <div class="intro-info">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 28rem;">
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold">Industrial Trianing Fund</h4>
                        <h6 class="card-subtitle mb-2 text-muted">(ITF)</h6>
                        <hr>
                        <p class="card-text text-monospace">Students Information and Payment System.</p>
                    </div>
                </div>
                <div>
                    <a href="#" class="btn-get-started scrollto" data-toggle="modal"
                        data-target="#exampleModal">Login</a>
                    <a href="#" class="btn-services scrollto" data-toggle="modal"
                        data-target=".bd-example-modal-lg">Students Enrolment</a>
                </div>
            </div>

        </div>

    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login Phase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username / Matric Number</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name = "username" required autofocus>
                            <small id="emailHelp" class="form-text text-muted">Administrators are to use
                                <b>Username</b>, and Students are to Validate with <b>Matric Number.</b></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name = "password" class="form-control" id="exampleInputPassword1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name = "login" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Enrolment Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <form>
                            <div class="form-row">
                                <div class="col-md-8 mb-3">
                                    <label for="validationDefault01">Fullname name</label>
                                    <input type="text" name = "name" class="form-control" id="validationDefault01" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefaultUsername">Matric Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend2">#</span>
                                        </div>
                                        <input type="text" name = "matric" class="form-control" id="validationDefaultUsername" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault03">Email Address</label>
                                    <input type="text" name = "email" class="form-control" id="validationDefault03" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault04">Phone Number</label>
                                    <input type="text" name = "phone" class="form-control" id="validationDefault04" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault03">School</label>
                                    <input type="text" name = "school" class="form-control" id="validationDefault03" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault04">Department</label>
                                    <input type="text" name = "dept" class="form-control" id="validationDefault04" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationDefault05">Level</label>
                                    <select name = "level" class="form-control" required>
                                        <option></option>
                                        <option>300</option>
                                        <option>400</option>
                                        <option>500</option>
                                        <option>ND 2</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary" name = "enrol" type="submit">Submit form</button>
                        </form>
                </form>


            </div>
            </form>
        </div>
    </div>
    </div>

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/mobile-nav/mobile-nav.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="contactform/contactform.js"></script>
    <script src="js/main.js"></script>

</body>

</html>