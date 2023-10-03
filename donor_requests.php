<?php
require 'file/connection.php'; 
session_start();

if (!isset($_SESSION['did'])) {
    header('location:login.php');
} else {
    $did = $_SESSION['did'];
    $sql = "SELECT bloodrequest.*, hospitals.hname, hospitals.hcity, hospitals.hemail, hospitals.hphone
            FROM bloodrequest
            JOIN hospitals ON bloodrequest.hid = hospitals.id
            WHERE rid = '$did'";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<?php $title = "Bloodbank | Blood Requests"; ?>
<?php require 'head.php'; ?>
<body>
    <?php require 'header.php'; ?>
    <div class="container cont">

        <?php require 'message.php'; ?>

        <table class="table table-responsive table-striped rounded mb-5">
            <tr><th colspan="9" class="title">Blood Requests</th></tr>
            <tr>
                <th>#</th>
                <th>Hospital Name</th>
                <th>Hospital City</th>
                <th>Hospital Email</th>
                <th>Hospital Phone</th>
                <th>Blood Group</th>
                <th>Status</th>
                <th colspan="2">Action</th>
            </tr>

            <div>
                <?php
                if ($result) {
                    $row = mysqli_num_rows($result);
                    if ($row) { //echo "<b> Total ".$row." </b>";
                    } else {
                        echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">No requests yet.</b>';
                    }
                }
                ?>
            </div>

            <?php while ($row = mysqli_fetch_array($result)) { ?>

            <tr>
                <td><?php echo ++$counter; ?></td>
                <td><?php echo $row['hname']; ?></td>
                <td><?php echo $row['hcity']; ?></td>
                <td><?php echo $row['hemail']; ?></td>
                <td><?php echo $row['hphone']; ?></td>
                <td><?php echo $row['bg']; ?></td>
                <td><?php echo 'Status: ' . $row['status']; ?></td>
                <td>
                    <?php if ($row['status'] == 'Accepted') { ?>
                        <a href="#" class="btn btn-success disabled">Accepted</a>
                    <?php } else { ?>
                        <a href="file/accept.php?reqid=<?php echo $row['reqid']; ?>" class="btn btn-success">Accept</a>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($row['status'] == 'Rejected') { ?>
                        <a href="#" class="btn btn-danger disabled">Rejected</a>
                    <?php } else { ?>
                        <a href="file/reject.php?reqid=<?php echo $row['reqid']; ?>" class="btn btn-danger">Reject</a>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>
<?php } ?>