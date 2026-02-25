<?php
session_start();
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/database_connection.php';

if (isset($_POST['edit'])) {
    $idd = (int) $_POST['id'];

    $sql_query = $db->prepare("SELECT fullname, gender, email, DOB, DATE_FORMAT(DOB, '%d/%m/%Y') AS dateOB, source, destination, passno, DATE_FORMAT(pass_end, '%d/%m/%y') AS pass_end, voucher, season, classof, duration, verified, DATE_FORMAT(dateofentry, '%d/%m/%Y') AS date FROM student WHERE id=?") OR die('query preparation failed');
    $sql_query->bind_param('i', $idd);
    $sql_query->execute();
    $sql_query->bind_result($fullname, $gender, $email, $dob, $dateOB, $source, $destination, $passno, $pass_end, $voucher, $season, $classof, $duration, $verified, $date_entry);
    $sql_query->fetch();

    if ($verified == 0) {
?>
<?php $page_title = 'Railcon Dashboard'; ?>
<!DOCTYPE html>
<html>
  <head>
    <?php require __DIR__ . '/includes/head.php'; ?>
    <link rel='stylesheet' type='text/css' href='modal.css'>
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <?php require __DIR__ . '/includes/navbar_admin.php'; ?>
      <div class="page-content align-items-stretch">
        <div class="content-inner" style="width:100%">
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin_filter.php">Filter</a></li>
              <li class="breadcrumb-item active">Dashboard - All Entries</li>
            </ul>
          </div>
          <div class="card-body" style="background:white;">
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Class</th>
                    <th>Duration</th>
                  </tr>
                </thead>
                <tbody>
<?php
        echo "<tr><th scope='row'>" . $idd;
        echo '</th><td>';
        echo htmlspecialchars($fullname);
        echo "<br><br>";
        echo "<form action='edit_record.php' method='POST'>
                <input type='hidden' name='id' value=" . $idd . ">
                <input type='text' name='fullname' placeholder='Enter name'><br><br>
                <input type='submit' class='bg-blue' name='edit_fullname' value='Edit' style='margin-top:6.5%;'>
              </form>";
        echo "</td><td>";
        echo $gender == '1' ? 'Female' : 'Male';
        echo "<br><br>";
        echo "<form action='edit_record.php' method='POST'>
                <input type='hidden' name='id' value=" . $idd . ">
                <select name='gender' style='height:2em;'>
                  <option value=0>Male</option>
                  <option value=1>Female</option>
                </select><br><br>
                <input type='submit' class='bg-blue' name='edit_gender' value='Edit' style='margin-top:27%;'>
              </form>";
        echo "</td><td>";
        echo htmlspecialchars($dateOB);
        echo "<br><br>";
        echo "<form action='edit_record.php' method='POST'>
                <input type='hidden' name='id' value=" . $idd . ">
                <input type='date' name='DOB'><br><br>
                <input type='submit' class='bg-blue' name='edit_DOB' value='Edit' style='margin-top:7.5%;'>
              </form>";
        echo "</td><td>";
        echo htmlspecialchars($email);
        echo "<br><br>";
        echo "<form action='edit_record.php' method='POST'>
                <input type='hidden' name='id' value=" . $idd . ">
                <input type='email' name='email' style='width:12em;'><br><br>
                <input type='submit' class='bg-blue' name='edit_email' value='Edit' style='margin-top:6.3%;'>
              </form>";
        echo "</td><td>";
        echo htmlspecialchars($source);
        echo "<br><br>";
        echo "<form action='edit_record.php' method='POST'>
                <input type='hidden' name='id' value=" . $idd . ">
                <input type='text' name='source'><br><br>
                <input type='submit' class='bg-blue' name='edit_source' value='Edit' style='margin-top:6.5%;'>
              </form>";
        echo "</td><td>";
        echo htmlspecialchars($destination);
        echo "<br><br>";
        echo "<form action='edit_record.php' method='POST'>
                <input type='hidden' name='id' value=" . $idd . ">
                <select name='destination' style='height:2em;'>
                  <option>Byculla Station</option>
                  <option>Dockyard Road</option>
                  <option>Sandhurst Road</option>
                  <option>Mumbai Central</option>
                </select><br><br>
                <input type='submit' class='bg-blue' name='edit_destination' value='Edit'>
              </form>";
        echo "</td><td>";
        echo htmlspecialchars($classof);
        echo "<br><br>";
        echo "<form action='edit_record.php' method='POST'>
                <input type='hidden' name='id' value=" . $idd . ">
                <select name='classof' style='height:2em;'>
                  <option>First Class</option>
                  <option>Second Class</option>
                </select><br><br>
                <input type='submit' class='bg-blue' name='edit_classof' value='Edit'>
              </form>";
        echo "</td><td>";
        echo htmlspecialchars($duration);
        echo "<br><br>";
        echo "<form action='edit_record.php' method='POST'>
                <input type='hidden' name='id' value=" . $idd . ">
                <select name='duration' style='height:2em;'>
                  <option>Monthly</option>
                  <option>Quarterly</option>
                </select><br><br>
                <input type='submit' class='bg-blue' name='edit_duration' value='Edit'>
              </form>";
        echo "</td></tr>";
?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Page Footer-->
      <?php require __DIR__ . '/includes/footer.php'; ?>
    </div>
    <?php require __DIR__ . '/includes/scripts.php'; ?>
  </body>
</html>
<?php
    } else {
        header("Refresh:1; url=dashboard.php");
        echo "<script> alert('Record Already Issued, cannot be edited'); </script>";
    }
}
?>
