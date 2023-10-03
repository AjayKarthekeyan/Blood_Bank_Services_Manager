<?php
session_start();
require 'file/connection.php';

if (isset($_GET['search'])) {
    $searchKey = $_GET['search'];
    $hospitalQuery = "SELECT h.id AS hid, h.hname, h.hcity, h.hemail, h.hphone, b.bg
                      FROM hospitals h
                      INNER JOIN bloodinfo b ON h.id = b.hid
                      WHERE b.bg LIKE '%$searchKey%'";
    $donorQuery = "SELECT donors.id AS hid, donors.dname AS hname, donors.dcity AS hcity, donors.demail AS hemail, donors.dphone AS hphone, donors.dbg
                   FROM donors
                   WHERE donors.dbg LIKE '%$searchKey%'";

    $sql = "SELECT * FROM (($hospitalQuery) UNION ($donorQuery)) AS combined";
} else {
    $hospitalQuery = "SELECT h.id AS hid, h.hname, h.hcity, h.hemail, h.hphone, b.bg
                      FROM hospitals h
                      INNER JOIN bloodinfo b ON h.id = b.hid";
    $donorQuery = "SELECT donors.id AS hid, donors.dname AS hname, donors.dcity AS hcity, donors.demail AS hemail, donors.dphone AS hphone, donors.dbg
                   FROM donors";

    $sql = "SELECT * FROM (($hospitalQuery) UNION ($donorQuery)) AS combined";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<?php $title = "Bloodbank | Available Blood Samples"; ?>
<?php require 'head.php'; ?>

<body>
    <?php require 'header.php'; ?>
    <div class="container cont">

        <?php require 'message.php'; ?>

        <div class="row col-lg-8 col-md-8 col-sm-12 mb-3">
            <form method="get" action="" style="margin-top:-20px;">
                <label class="font-weight-bolder">Select Blood Group:</label>
                <select name="search" class="form-control">
                    <option><?php echo @$_GET['search']; ?></option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select><br>
                <a href="abs.php" class="btn btn-info mr-4"> Reset</a>
                <input type="submit" name="submit" class="btn btn-info" value="search">
            </form>
        </div>

        <table class="table table-responsive table-striped rounded mb-5">
            <tr>
                <th colspan="7" class="title">Available Blood Samples</th>
            </tr>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>City</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Blood Group</th>
                <th>Action</th>
            </tr>

            <div>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    // echo "<b> Total " . mysqli_num_rows($result) . " </b>";
                } else {
                    echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">Nothing to show.</b>';
                }
                ?>
            </div>

            <?php while ($row = mysqli_fetch_array($result)) { ?>

                <tr>
                    <td><?php echo ++$counter; ?></td>
                    <td><?php echo isset($row['hname']) ? $row['hname'] : 'Donor'; ?></td>
                    <td><?php echo isset($row['hcity']) ? $row['hcity'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['hemail']) ? $row['hemail'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['hphone']) ? $row['hphone'] : 'N/A'; ?></td>
                    <td><?php echo isset($row['bg']) ? $row['bg'] : 'N/A'; ?></td>

                    <?php $hid = $row['hid']; ?>
                    <?php $bg = $row['bg']; ?>

                    <form action="file/request.php" method="post">
                        <input type="hidden" name="hid" value="<?php echo $hid; ?>">
                        <input type="hidden" name="bg" value="<?php echo $bg; ?>">

                        <?php if (isset($_SESSION['hid']) || isset($_SESSION['rid'])) { ?>
                            <td><input type="submit" name="request" class="btn btn-info" value="Request Sample"></td>
                        <?php } else { ?>
                            <td><a href="javascript:void(0);" class="btn btn-info hospital">Request Sample</a></td>
                        <?php } ?>
                    </form>
                </tr>

            <?php } ?>
        </table>
    </div>
    <?php require 'footer.php'; ?>
</body>

<script type="text/javascript">
    $('.hospital').on('click', function () {
        alert("Hospital user can't request for blood.");
    });
</script>

</html>
