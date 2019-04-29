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

    $s = "SELECT * FROM staff WHERE id = '$_SESSION[id]'";
    $re = mysqli_query($link, $s);
    $data = mysqli_fetch_array($re);

    $s4 = "SELECT * FROM student";
    $re4 = mysqli_query($link, $s4);
    $data4 = mysqli_num_rows($re4);

    $s4f = "SELECT * FROM feedback WHERE status = '0'";
    $re4f = mysqli_query($link, $s4f);
    $data4f = mysqli_num_rows($re4f);

    $s4r = "SELECT * FROM remark WHERE s = '0'";
    $re4r = mysqli_query($link, $s4r);
    $data4r = mysqli_num_rows($re4r);

    $s2 = "SELECT * FROM student WHERE approve = '1'";
    $re2 = mysqli_query($link, $s2);
    $data2 = mysqli_num_rows($re2);

    $s3 = "SELECT * FROM student WHERE approve = '0'";
    $re3 = mysqli_query($link, $s3);
    $data3 = mysqli_num_rows($re3);

    $s5 = "SELECT * FROM remark WHERE ps = '1'";
    $re5 = mysqli_query($link, $s5);
    $data5 = mysqli_num_rows($re5);

    if (isset($_REQUEST['upload'])){
        $image = $_FILES['image']['name'];
        $sqlee = "UPDATE staff SET dp = '$image' WHERE id = '$data[id]'";
        $reee = mysqli_query($link, $sqlee);

        $target = "img/dp/".basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target) && $reee = true){
            echo '<script>alert("Upload Successful\n\n Reload Page");</script>';
        }else{
            echo '<script>alert("Upload Fail, Try Again !!!")</script>';
        }

    }
    if (isset($_REQUEST['profile'])){
        $sqlee = "UPDATE staff SET name = '$_POST[name]',email = '$_POST[email]',phone = '$_POST[phone]',username = '$_POST[username]' WHERE id = '$data[id]'";
        $reee = mysqli_query($link, $sqlee);
        if($rs = true){
            echo '<script>alert("Modification Successful\n\n Reload Page");</script>';
        }else{
            echo '<script>alert("Modification Fail, Try Again !!!")</script>';
        }

    }

    if (isset($_REQUEST['cpass'])){
            if($data['password'] == $_POST['op']){
                if($_POST['np'] == $_POST['cnp']){
					$sqlee = "UPDATE staff SET password = '$_POST[cnp]' WHERE id = '$data[id]'";
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
            <p class="card-text text-monospace">Students Information and Payment System. (Admin Panel)</p>
            <hr>
            <p class="mb-0">Welcome: <b><?php echo $data['name'];?></b>
                <span class="float-right">
                    <a href="landing2.php" class="badge badge-dark">Reload</a>
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
                <a class="nav-link" data-toggle="tab" href="#student">Students  <span class="badge badge-success"><?php echo $data4; ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#feedback">Feedback  <span class="badge badge-success"><?php echo $data4f; ?></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#remark">Remark  <span class="badge badge-success"><?php echo $data4r; ?></span></a>
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
                                        <h5 class="card-title">Total Number of Students:</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $data4; ?></h6>
                                    </blockquote>
                                    <blockquote class="blockquote mb-0">
                                        <h5 class="card-title">Total Number of Approved Students Account:</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            <?php echo $data2; ?>
                                        </h6>
                                    </blockquote>
                                    <blockquote class="blockquote mb-0">
                                        <h5 class="card-title">Total Number of Unapproved Students Accounts</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $data3; ?></h6>
                                    </blockquote>
                                    <blockquote class="blockquote mb-0">
                                        <h5 class="card-title">Total Number of Paid Students:</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $data5; ?></h6>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm" style="margin: 10px auto;">
                            <div class="card" style="width: 18rem; margin: 10px auto;">
                                <img class="card-img-top" style="height: 18rem;" src="img/dp/<?php echo $data['dp']?>"
                                    alt="Staff Image">
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
                            <th scope="row">Email Address:</th>
                            <td><?php echo $data['email']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Phone Number:</th>
                            <td><?php echo $data['phone']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Username:</th>
                            <td><?php echo $data['username']; ?></td>
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
                
            </div>
            <div class="container tab-pane" id="student">
                <div class="alert alert-info" role="alert" style="margin: 50px auto;">
                    <h4 class="alert-heading">Students Record</h4>
                    <hr>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Student Name</th>
                            <th scope="col">Matric Number</th>
                            <th scope="col">School</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sfd = "SELECT * FROM student";
                    $refd = mysqli_query($link, $sfd);
						for($i=0; $row = mysqli_fetch_array($refd); $i++){							
					?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['matric']; ?></td>
                            <td><?php echo $row['school']; ?></td>
                            <td><a href="d.php?id=<?php echo $row['id']; ?>" class="btn btn-primary float-right">Modify</a>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <div class="container tab-pane" id="feedback">
                <div class="alert alert-info" role="alert" style="margin: 50px auto;">
                    <h4 class="alert-heading text-truncate" >Feedback Record (Scroll Down to See New Feedback)</h4>
                    <hr>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Matric Number</th>
                            <th scope="col">Message</th>
                            <th scope="col">Response</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sfd = "SELECT * FROM feedback";
                    $refd = mysqli_query($link, $sfd);
						for($i=0; $row = mysqli_fetch_array($refd); $i++){							
					?>
                        <tr>
                            <td><?php echo $row['time']; ?></td>
                            <td><?php echo $row['smatric']; ?></td>
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
                            <td>
                            <?php if($row['status'] == 0) { ?>
                            <small><b>Unread</b></small>
                            <?php }else{?>
                                <small><b>read</b></small>
                            <?php }?>
                            </td>
                            <td><a href="f.php?id=<?php echo $row['id']; ?>" class="btn btn-primary float-right">View</a>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <div class="container tab-pane" id="remark">
            <div class="alert alert-info" role="alert" style="margin: 50px auto;">
                    <h4 class="alert-heading text-truncate" >Students Remark From Place of Internship (Scroll Down to See New Remark)</h4>
                    <hr>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Matric Number</th>
                            <th scope="col">Place of Internship</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sfdr = "SELECT * FROM remark";
                    $refdr = mysqli_query($link, $sfdr);
						for($i=0; $rowr = mysqli_fetch_array($refdr); $i++){							
					?>
                        <tr>
                            <td><?php echo $rowr['time']; ?></td>
                            <td><?php echo $rowr['matric']; ?></td>
                            <td><?php echo $rowr['en']; ?></td>
                            <td>
                            <?php if($rowr['s'] == 0) { ?>
                            <small><b>Unassessed</b></small>
                            <?php }else{?>
                                <small><b>Assessed</b></small>
                            <?php }?>
                            </td>
                            <td>
                            <?php if($rowr['ps'] == 0) { ?>
                            <small><b>Not Authorized</b></small>
                            <?php }else{?>
                                <small><b>Authorized</b></small>
                            <?php }?>
                            </td>
                            <td><a href="r.php?id=<?php echo $rowr['id']; ?>" class="btn btn-primary float-right">Assess</a>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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
                    <h5 class="modal-title" id="exampleModalLabel">Profile Modidfication</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Full Name" required>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email Address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Phone Number</label>
                                <input type="text" name="phone" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">username</label>
                                <input type="text" name="username" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit" name="profile">
                        </form>
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
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
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