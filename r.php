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

    $s = "SELECT * FROM remark WHERE id = '$did'";
    $re = mysqli_query($link, $s);
    $data = mysqli_fetch_array($re);

    $sde = "SELECT * FROM staff WHERE id = '$_SESSION[id]'";
    $rede = mysqli_query($link, $sde);
    $datade = mysqli_fetch_array($rede);

    if (isset($_REQUEST['s1'])){
        $t = date("Y-m-d h:i");
        $sqlee = "UPDATE remark SET s = '$_POST[s]', ps = '$_POST[ps]', atime = '$t' WHERE id = '$did'";
        $reee = mysqli_query($link, $sqlee);
        if($rs = true){
            echo '<script>alert("Remark Sent Successfully\n\n Proceed to Reload Page\nthank you");</script>';
        }else{
            echo '<script>alert("Sending Fail, Try Again !!!")</script>';
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
            <p class="mb-0"><b><?php echo $data['matric'];?> Remark Details</b>
                <span class="float-right">
                    <a href="" class="badge badge-dark">Reload</a>
                    <a href="landing2.php" class="badge badge-primary">Return</a>
                </span>
            </p>
        </div>
        <div class="container" >
        <div class="alert alert-info" role="alert" style="margin: 50px auto;">
                    <h4 class="alert-heading">Remark Details</h4>
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
                            <td><?php echo $data['matric']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Place of Internship:</th>
                            <td><?php echo $data['en']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Establishment Address:</th>
                            <td><?php echo $data['ea']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Establishment Contact Address:</th>
                            <td><?php echo $data['eca']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Student Rating (/10):</th>
                            <td><?php echo $data['r']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Remark:</th>
                            <td><textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="<?php echo $data['remark']; ?>" readonly></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">Establishment Agent Name:</th>
                            <td><?php echo $data['ean']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Agent Email Address:</th>
                            <td><?php echo $data['aea']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Agent Phone Number:</th>
                            <td><?php echo $data['apn']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Time of Submission:</th>
                            <td><?php echo $data['time']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Remark Status:</th>
                            <td><?php if($data['s'] == 0) { ?>
                                <span class="badge badge-warning">Remark Not Assessed</span>
                            <?php }else{?>
                                <span class="badge badge-success">Remark Assessed</span>
                            <?php }?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Payment Status:</th>
                            <td><?php if($data['ps'] == 0) { ?>
                                <span class="badge badge-warning">Payment Not Authorized</span>
                            <?php }else{?>
                                <span class="badge badge-success">Payment Authorized</span>
                            <?php }?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target="#exampleModalp1">Assess Remark</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
        </div>
    <div class="modal fade bd-example-modal-lg" id="exampleModalp1" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Feedback Response</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if( $data['s'] == 0){?>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="disabledSelect">Remark Assessment</label>
                            <select  name ="s" class="form-control" required>
                                <option></option>
                                <option value="0">Not Assessed</option>
                                <option value="1">Assessed</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="disabledSelect">Payment</label>
                            <select  name = "ps" class="form-control" required>
                                <option></option>
                                <option value="0">Not Authorized</option>
                                <option value="1">Authorized</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" name="s1" value="Submit">
                    </div>
                </form>
                <?php }else{?>
                    <div class="modal-body">
                        <h5>An Administrator Already Respond to This<br />
                            Thank you.</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" data-dismiss="modal" class="btn btn-dark">close</button>
                    </div>
                <?php }?>
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