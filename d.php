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
$did = $_GET['id'];
    $s = "SELECT * FROM student WHERE id = '$did'";
    $re = mysqli_query($link, $s);
    $data = mysqli_fetch_array($re);

    if (isset($_REQUEST['reset'])){
        $sqlee = "UPDATE student SET password = '123456' WHERE id = '$did'";
        $reee = mysqli_query($link, $sqlee);
        if($rs = true){
            echo '<script>alert("Modification Successful\n\n Student Password Reset to: 123456");</script>';
        }else{
            echo '<script>alert("Modification Fail, Try Again !!!")</script>';
        }

    }

    if (isset($_REQUEST['s1'])){
        $sqlee = "UPDATE student SET name = '$_POST[name]', matric = '$_POST[matric]', email = '$_POST[email]', phone = '$_POST[phone]', school = '$_POST[school]', dept = '$_POST[dept]', level = '$_POST[level]', approve = '$_POST[approve]' WHERE id = '$did'";
        $reee = mysqli_query($link, $sqlee);
        if($rs = true){
            echo '<script>alert("Modification Successful\n\n Proceed to Reload Page\nthank you");</script>';
        }else{
            echo '<script>alert("Modification Fail, Try Again !!!")</script>';
        }

    }

    if (isset($_REQUEST['s2'])){
        $sqlee = "UPDATE student SET nplace = '$_POST[nplace]', nstart = '$_POST[nstart]', ndept = '$_POST[ndept]', nduration = '$_POST[nduration]' WHERE id = '$did'";
        $reee = mysqli_query($link, $sqlee);
        if($rs = true){
            echo '<script>alert("Modification Successful\n\n Proceed to Reload Page\nthank you");</script>';
        }else{
            echo '<script>alert("Modification Fail, Try Again !!!")</script>';
        }

    }

    if (isset($_REQUEST['s3'])){
        $sqlee = "UPDATE student SET bname = '$_POST[bname]', aname = '$_POST[aname]', atype = '$_POST[atype]', anumber = '$_POST[anumber]', scode = '$_POST[scode]' WHERE id = '$did'";
        $reee = mysqli_query($link, $sqlee);
        if($rs = true){
            echo '<script>alert("Modification Successful\n\n Proceed to Reload Page\nthank you");</script>';
        }else{
            echo '<script>alert("Modification Fail, Try Again !!!")</script>';
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
        <div class="alert alert-success sticky-top" role="alert">
            <h4 class="alert-heading">Industrial Trianing Fund</h4>
            <p class="card-text text-monospace">Students Information and Payment System. (Admin Panel)</p>
            <hr>
            <p class="mb-0"><b><?php echo $data['name'];?>'s Details</b>
                <span class="float-right">
                    <a href="" class="badge badge-dark">Reload</a>
                    <a href="landing2.php" class="badge badge-primary">Return</a>
                </span>
            </p>
        </div>
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
                            <th scope="row">Matric Number:</th>
                            <td><?php echo $data['matric']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">School:</th>
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
                            <th scope="row">Account Status:</th>
                            <td><?php if($data['approve'] == 0) { ?>
                                <span class="badge badge-warning">Account Not Approved</span>
                            <?php }else{?>
                                <span class="badge badge-success">Account Approved</span>
                            <?php }?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                            <form action="" method="post">
                                <input type="submit" value="Reset Passord" name="reset" class="btn btn-info float-left" />
                            </form>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target="#exampleModalp2">Modify</button>
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
                            <th scope="row">Pace of Internship:</th>
                            <td><?php echo $data['nplace']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Department of Placement:</th>
                            <td><?php echo $data['ndept']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Date of Comencement:</th>
                            <td><?php echo $data['nstart']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Internship Duration:</th>
                            <td><?php echo $data['nduration']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target="#exampleModalp3">Modify</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="alert alert-info" role="alert" style="margin: 50px auto;">
                    <h4 class="alert-heading">Bank Details</h4>
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
                            <td><?php echo $data['bname']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Account Name:</th>
                            <td><?php echo $data['aname']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Account Type:</th>
                            <td><?php echo $data['atype']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Account Number:</th>
                            <td><?php echo $data['anumber']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Sort Code:</th>
                            <td><?php echo $data['scode']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target="#exampleModalp4">Modify</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

    <div class="modal fade bd-example-modal-lg" id="exampleModalp2" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Details Modification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="validationDefault01">Name</label>
                                <input type="text" name="name" value="<?php echo $data['name']?>" class="form-control" id="validationDefault01" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefaultUsername">Matric Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">#</span>
                                    </div>
                                    <input type="text" name="matric" value="<?php echo $data['matric']?>" class="form-control" id="validationDefaultUsername"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03">Email Address</label>
                                <input type="text" name="email" value="<?php echo $data['email']?>" class="form-control" id="validationDefault03" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefaultUsername">Phone Number</label>
                                <div class="input-group">
                                    <input type="number" name="phone" value="<?php echo $data['phone']?>" class="form-control"
                                        id="validationDefaultUsername" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03">School</label>
                                <input type="text" name="school" value="<?php echo $data['school']?>" class="form-control" id="validationDefault03" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefaultUsername">Department</label>
                                <div class="input-group">
                                    <input type="text" name="dept" value="<?php echo $data['dept']?>" class="form-control"
                                        id="validationDefaultUsername" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03">Level</label>
                                <input type="text" name="level" value="<?php echo $data['level']?>" class="form-control" id="validationDefault03" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefaultUsername">Status</label>
                                <div class="input-group">
                                <select name = "approve" class="form-control" id="exampleFormControlSelect1">
                                    <option><?php if($data['approve'] == 0){ ?>
                                    Current Status: Not Approved
                                    <?php }else{ ?>
                                        Current Status: Approved
                                    </option>
                                    <?php } ?>
                                    <option value="0">Pending</option>
                                    <option value="1">Approve</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="s1" value="Submit Details">
                        </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="exampleModalp3" tabindex="-1" role="dialog"
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
                                <input type="text" name="nplace" value="<?php echo $data['nplace']?>" class="form-control" id="validationDefault01" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefaultUsername">Date of Comencement</label>
                                <div class="input-group">
                                    <input type="date" name="nstart" value="<?php echo $data['nstart']?>" class="form-control" id="validationDefaultUsername"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03">Department of Placement</label>
                                <input type="text" name="ndept" value="<?php echo $data['ndept']?>" class="form-control" id="validationDefault03" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefaultUsername">Internship Duration</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">Month (s)</span>
                                </div>
                                    <input type="number" name="nduration" value="<?php echo $data['nduration']?>" class="form-control"
                                        id="validationDefaultUsername" required>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="s2" value="Submit Details">
                        </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="exampleModalp4" tabindex="-1" role="dialog"
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
                                <input type="text" name="bname" value="<?php echo $data['bname']?>" class="form-control" id="validationDefault01" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefaultUsername">Account Name</label>
                                <div class="input-group">
                                    <input type="text" name="aname" value="<?php echo $data['aname']?>" class="form-control" id="validationDefaultUsername"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03">Account Type</label>
                                <input type="text" name="atype" value="<?php echo $data['atype']?>" class="form-control" id="validationDefault03" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefaultUsername">Account Number</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">#</span>
                                </div>
                                    <input type="number" name="anumber" value="<?php echo $data['anumber']?>" class="form-control"
                                        id="validationDefaultUsername" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03">Sort Code</label>
                                <input type="number" name="scode" value="<?php echo $data['scode']?>" class="form-control" id="validationDefault03" required>
                            </div>
                        </div>
                        
                        
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="s3" value="Submit Details">
                        </div>
                </form>
            </div>
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