<!-- Developed by: Danjuma Jubril Charles
    email: charlesjubril@yahoo.com
            charlesjubril@gmail.com -->
<?php
session_start();
include("connn.php");
if(!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
    header("location: index.php");
    exit();
}

    $s = "SELECT * FROM student WHERE matric = '$_SESSION[id]'";
    $re = mysqli_query($link, $s);
    $data = mysqli_fetch_array($re);

    $sr = "SELECT * FROM remark WHERE matric = '$data[matric]'";
    $rer = mysqli_query($link, $sr);
    $datar = mysqli_fetch_array($rer);

    if (isset($_REQUEST['upload'])){
        $image = $_FILES['image']['name'];
        $sqlee = "UPDATE student SET dp = '$image' WHERE matric = '$data[matric]'";
        $reee = mysqli_query($link, $sqlee);

        $target = "img/dp/".basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            echo '<script>alert("Upload Successfull");</script>';
        }else{
            echo '<script>alert("Upload Fail, Try Again !!!")</script>';
        }

    }
    
    if (isset($_REQUEST['siwes'])){
        if($data['ms'] == 0){
            $sqlee = "UPDATE student SET nplace = '$_POST[nplace]',ndept = '$_POST[ndept]',nstart = '$_POST[nstart]',nduration = '$_POST[nduration]',ms = '1' WHERE matric = '$data[matric]'";
        $reee = mysqli_query($link, $sqlee);
        if($ree = true){
            echo '<script>alert("modification Successfull\n Proceed to Reload Page to see changes");</script>';
        }else{
            echo '<script>alert("modification Fail, Try Again !!!")</script>';
        }
        }else{
            echo '<script>alert("To make further modification, \n Please send the content of your modification as feedback to system administrator!!!")</script>';
        }
        

    }
    
    if (isset($_REQUEST['cpass'])){
        if($data['ps'] == 0){
            if($data['password'] == $_POST['op']){
                if($_POST['np'] == $_POST['cnp']){
                    $sqlee = "UPDATE student SET password = '$_POST[cnp]',ps = '1' WHERE matric = '$data[matric]'";
                    $reee = mysqli_query($link, $sqlee);
                    if($ree = true){
                        echo '<script>alert("modification Successfull\n Proceed to Reload Page to see changes");</script>';
                    }else{
                        echo '<script>alert("modification Fail, Try Again !!!")</script>';
                    }
                }else{
                    echo '<script>alert("New Passwords Does Not Match, Try Again !!!")</script>';
                }
            }else{
                echo '<script>alert("Old Password is Not Correct, Try Again !!!")</script>';
            }
            
        
        }else{
            echo '<script>alert("To make further modification, \n Please send the content of your modification as feedback to system administrator!!!")</script>';
        }
        

	}
    if (isset($_REQUEST['bank'])){
        if($data['bs'] == 0){
            $sqlee = "UPDATE student SET bname = '$_POST[bname]',aname = '$_POST[aname]',anumber = '$_POST[anumber]',atype = '$_POST[atype]',scode = '$_POST[scode]',bs = '1' WHERE matric = '$data[matric]'";
        $reee = mysqli_query($link, $sqlee);
        if($ree = true){
            echo '<script>alert("modification Successfull\n Proceed to Reload Page to see changes");</script>';
        }else{
            echo '<script>alert("modification Fail, Try Again !!!")</script>';
        }
        }else{
            echo '<script>alert("To make further modification, \n Please send the content of your modification as feedback to system administrator!!!")</script>';
        }
        

    }
    
    if (isset($_REQUEST['fd'])){
		$sql="INSERT INTO feedback (smatric, msg)
			VALUES
		('$_POST[matric]','$_POST[msg]')";
        $r = mysqli_query($link, $sql);
        if($r = true){
            echo '<script>alert("Feedback Successfully Registered\n Thank You, Admin will Respond Shortly ")</script>';
        }else{
            echo '<script>alert("Submission Error, Try Again !!!")</script>';
        }
		
	}
    if (isset($_REQUEST['remark'])){
        if($datar['s'] == 0){
            $s = "SELECT * FROM remark WHERE matric = '$data[matric]'";
		$re = mysqli_query($link, $s);
		if (mysqli_num_Rows($re) > 0){
		echo '<script>alert("Remark Already Made on this Student, \n Contact Admin, through feedback.")</script>';
		}else{
		$sql="INSERT INTO remark (matric, en, ea, eca, r, remark, ean, aea, apn)
		 	VALUES
		('$data[matric]','$_POST[en]','$_POST[ea]','$_POST[eca]','$_POST[r]','$_POST[remark]','$_POST[ean]','$_POST[aea]','$_POST[apn]')";
         $r = mysqli_query($link, $sql);
         if($r = true){
             echo '<script>alert("Remark Successfully Registered\n Admin will respond shortly")</script>';
         }else{
             echo '<script>alert("Remark Error, Try Again !!!")</script>';
         }
		
         }
         
        }else{
            echo '<script>alert("Remark Already Sent,\n\n Thank You !!!")</script>';
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

<body style="padding: 20px;">
    <div class="container">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Industrial Trianing Fund</h4>
            <p class="card-text text-monospace">Students Information and Payment System.</p>
            <hr>
            <p class="mb-0">Welcome: <b><?php echo $data['name'];?></b>
                <span class="float-right">
                <?php if($data['approve'] == 0){?>
                    <span class="badge badge-pill badge-warning">Account Not Approved</span>
                <?php }else{?>
                    <span class="badge badge-success">Account Approved</span>
                <?php }?>
                    <a href="landing.php" class="badge badge-dark">Reload</a>
                    <a href="index.php" class="badge badge-danger">Logout</a>
                </span>
            </p>
        </div>
        <hr>
        <ul class="nav nav-tabs bg-white justify-content-center shadow-sm sticky-top">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#profile">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#messages">Feedback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Remarks">Establishment Remarks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Payment">Allowance</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="container tab-pane active" id="home">
                <div class="container">
                    <div class="row">
                        <div class="col-sm" style="margin: 50px auto;">
                            <div class="card">
                                <div class="card-header">
                                    Overview
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <h5 class="card-title">Duration of Internship:</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $data['nduration']?> months</h6>
                                    </blockquote>
                                    <blockquote class="blockquote mb-0">
                                        <h5 class="card-title">Current Date:</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            <?php echo date('Y / M / d');
                                        ?>
                                        </h6>
                                    </blockquote>
                                    <blockquote class="blockquote mb-0">
                                        <h5 class="card-title">Place of Internship:</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $data['nplace']?></h6>
                                    </blockquote>
                                    <blockquote class="blockquote mb-0">
                                        <h5 class="card-title">Department of Placement:</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $data['ndept']?></h6>
                                    </blockquote>
                                    <blockquote class="blockquote mb-0">
                                        <h5 class="card-title">Establishment Remarks:</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            <?php if($datar['s'] == 0) { ?>
                                                <span class="badge badge-warning">Remark Not Assessed</span>
                                            <?php }else{?>
                                                <span class="badge badge-success">Remark Assessed</span>
                                            <?php }?>
                                        </h6>
                                    </blockquote>
                                    <blockquote class="blockquote mb-0">
                                        <h5 class="card-title">Allowance Payment:</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                        <?php if($datar['ps'] == 0) { ?>
                                                <span class="badge badge-warning">Payment Not Authorized</span>
                                            <?php }else{?>
                                                <span class="badge badge-success">Payment Authorized</span>
                                            <?php }?>
                                        </h6>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm" style="margin: 10px auto;">
                            <div class="card" style="width: 18rem; margin: 10px auto;">
                                <img class="card-img-top" style="height: 18rem;" src="img/dp/<?php echo $data['dp']?>"
                                    alt="Student Image">
                                <div class="card-body">
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalp">Change
                                        Image</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container tab-pane" id="profile">
                <div class="alert alert-info" role="alert" style="margin: 50px auto;">
                    <h4 class="alert-heading">Personal Details</h4>
                    <hr>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Name:</th>
                            <td><?php echo $data['name']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Matric Number:</th>
                            <td><?php echo $data['matric']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email Address:</th>
                            <td><?php echo $data['email']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Phone Number:</th>
                            <td><?php echo $data['phone']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Institution:</th>
                            <td><?php echo $data['school']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Department:</th>
                            <td><?php echo $data['dept']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Level:</th>
                            <td><?php echo $data['level']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="btn btn-info float-left" data-toggle="modal"
                                    data-target="#exampleModalpp">Change Password</button>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target="#exampleModalp1">Modify</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="alert alert-info" role="alert" style="margin: 50px auto;">
                    <h4 class="alert-heading">SIWES Details</h4>
                    <hr>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Place of Internship:</th>
                            <td><?php echo $data['nplace']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Department of Placement:</th>
                            <td><?php echo $data['ndept']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Date of commencement:</th>
                            <td><?php echo $data['nstart']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Duration:</th>
                            <td><?php echo $data['nduration']; ?> Month (s)</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <a href="landing.php" class="btn btn-dark float-left">Reload</a>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target="#exampleModalp2">Modify</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="alert alert-info" role="alert" style="margin: 50px auto;">
                    <h4 class="alert-heading">Bank Account Details</h4>
                    <hr>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Bank Name:</th>
                            <td><?php echo $data['bname']?></td>
                        </tr>
                        <tr>
                            <th scope="row">Account Name:</th>
                            <td><?php echo $data['aname']?></td>
                        </tr>
                        <tr>
                            <th scope="row">Account Number:</th>
                            <td><?php echo $data['anumber']?></td>
                        </tr>
                        <tr>
                            <th scope="row">Account Type:</th>
                            <td><?php echo $data['atype']?></td>
                        </tr>
                        <tr>
                            <th scope="row">Sort Code:</th>
                            <td><?php echo $data['scode']?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <a href="landing.php" class="btn btn-dark float-left">Reload</a>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target="#exampleModal">Modify</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="container tab-pane" id="messages">
                <form action = "" method = "post" style="margin: 30px auto;">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Matric Number</label>
                        <div class="col-sm-10">
                            <input type="text" readonly name="matric" class="form-control-plaintext" id="staticEmail"
                                value="<?php echo $data['matric'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Feedback</label>
                        <textarea name="msg" class="form-control" id="exampleFormControlTextarea1" rows="3"
                            required></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" name = "fd" value="Submit">
                </form>
                <div class="alert alert-info" role="alert" style="margin: 50px auto;">
                    <h4 class="alert-heading">Feedback Record</h4>
                    <hr>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Time</th>
                            <th scope="col">Message</th>
                            <th scope="col">Response</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sfd = "SELECT * FROM feedback WHERE smatric = '$data[matric]'";
                    $refd = mysqli_query($link, $sfd);
						for($i=0; $row = mysqli_fetch_array($refd); $i++){							
					?>
                        <tr>
                            <td><?php echo $row['time']; ?></td>
                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 150px;">
                                <?php echo $row['msg']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 150px;">
                                <?php echo $row['response']; ?>
                                </span>
                            </td>
                            <td><a href="fs.php?id=<?php echo $row['id']; ?>" class="btn btn-primary float-right">View</a>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <div class="container tab-pane" id="Remarks">
                <form action = "" method = "post" style="margin: 30px auto;">
                <div class="alert alert-info" role="alert" style="margin: 50px auto;">
                    <h4 class="alert-heading">To Be Filled By Establishment Agent, After The Intern Period</h4>
                    <hr>
                </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Establishment Name:</label>
                        <div class="col-sm-10">
                            <input type="text" name = "en" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Establishment Address:</label>
                        <div class="col-sm-10">
                            <input type="text" name = "ea" class="form-control" required>   
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Establishment Contact Address:</label>
                        <div class="col-sm-10">
                            <input type="text" name = "eca" class="form-control" required>
                        </div>
                    </div>
                    <label for="customRange3">Rate Student (/10) *Drag thumb right or left to rate</label>
                    <script>
                        function updateTextInput(val) {
                            document.getElementById('textInput').value = val;
                        }
                    </script>
                    <input type="range" required class="custom-range" min="0" max="10" step="1" id="customRange3"
                        onchange="updateTextInput(this.value);" >
                    <label for="exampleFormControlTextarea1">Rating Value:</label>
                    <input type="text" name = "r" required class="form-control-plaintext" placeholder = "Get value by dragging thumb above" id="textInput" value="" ><br>
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Remark:</label>
                        <textarea class="form-control" name = "remark" id="exampleFormControlTextarea1" rows="3" required></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Establishment Agent Name:</label>
                        <div class="col-sm-10">
                            <input type="text" name = "ean" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Agent Email Address:</label>
                        <div class="col-sm-10">
                            <input type="email" name = "aea" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Agent Phone Number:</label>
                        <div class="col-sm-10">
                            <input type="text" name = "apn" class="form-control" required>
                        </div>
                    </div>
                    <input type="submit"  name = "remark" class="btn btn-primary" value="Submit">
                </form>
            </div>
            <div class="container tab-pane" id="Payment">
                <?php if($datar['ps'] == 0){?>
                    <div class="alert alert-warning mt-5" role="alert">
                    Payment Not Authorized
                    </div>
                <?php }else{ ?>
                    <div class="alert alert-success mt-5" role="alert">
                    Payment Authorized<br />
                    <b>Details</b>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">Student Name:</th>
                            <td><?php echo $data['name']?></td>
                            </tr>
                            <tr>
                            <th scope="row">Matric Number:</th>
                            <td><?php echo $data['matric']?></td>
                            </tr>
                            <tr>
                            <th scope="row">Bank Name</th>
                            <td><?php echo $data['bname']?></td>
                            </tr>
                            <tr>
                            <th scope="row">Account Number</th>
                            <td><?php echo $data['aname']?></td>
                            </tr>
                            <tr>
                            <th scope="row">Account Type</th>
                            <td><?php echo $data['atype']?></td>
                            </tr>
                            <tr>
                            <th scope="row">Sort Code</th>
                            <td><?php echo $data['scode']?></td>
                            </tr>
                            <tr>
                            <th scope="row">Amount</th>
                            <td>NGN 15,000.00</td>
                            </tr>
                        </tbody>
                    </table>           
                    </div>
                <?php }?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalpp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Password Modification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Old Password</label>
                            <input type="password" name="op" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" name="np" class="form-control" id="exampleInputPassword1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm New Password</label>
                            <input type="password" name="cnp" class="form-control" id="exampleInputPassword1" required>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            It should be noted that modification can only be done once, further modification are to be
                            sent as feedback, to be made by administrators!!!
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="cpass" value="Submit" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalp1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <h5>Your modification should be sent to the system
                            administrators for appropriation through the feedback channel<br />
                            This is so, to enhance and checkmate security lapses, such as third party
                            impersonation<br />
                            Thank you.</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" data-dismiss="modal" class="btn btn-dark">close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="exampleModalp2" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SIWES Details Modification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="validationDefault01">Place of Internship</label>
                                <input type="text" name="nplace" class="form-control" id="validationDefault01" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefaultUsername">Date of Commencement</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">#</span>
                                    </div>
                                    <input type="date" name="nstart" class="form-control" id="validationDefaultUsername"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03">Department of Placement</label>
                                <input type="text" name="ndept" class="form-control" id="validationDefault03" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefaultUsername">Duration</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">Month(s)</span>
                                    </div>
                                    <input type="number" name="nduration" class="form-control"
                                        id="validationDefaultUsername" required>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            It should be noted that modification can only be done once, further modification are to be
                            sent as feedback, to be made by administrators!!!
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="siwes" value="Submit Details">
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bank Details Modification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="validationDefault01">Bank Name</label>
                                <input type="text" name="bname" class="form-control" id="validationDefault01" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefaultUsername">Account Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">#</span>
                                    </div>
                                    <input type="number" name="anumber" class="form-control"
                                        id="validationDefaultUsername" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03">Account Name</label>
                                <input type="text" name="aname" class="form-control" id="validationDefault03" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault03">Account Type</label>
                                <input type="text" name="atype" class="form-control" id="validationDefault03" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault03">Sort Code</label>
                                <input type="number" name="scode" class="form-control" id="validationDefault03"
                                    required>
                            </div>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            It should be noted that modification can only be done once, further modification are to be
                            sent as feedback, to be made by administrators!!!
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="bank" value="Submit Details">
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="modalp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Profile Picture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="landing.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <script>
                            if (window.location.href.indexOf('reload') == -1) {
                                window.location.replace(window.location.href + '?reload');
                            }
                        </script>
                        <img src="img/dp/<?php echo $data['dp']; ?>" width="250px;" /><br />
                        <label>Upload New Photo: </label><br />
                        <input type="file" name="image">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Upload" name="upload">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="shadow-lg fixed-bottom p-2 bg-white text-right">
        <b>&copy Xhibit 2019,</b> Developed by Danjuma Jubril Charles
    </div>
</body>
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

</html>