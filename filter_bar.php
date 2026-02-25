<?php
include_once 'logs/LOGGER.php';
include_once 'constants/departments.php';

	$statusSelected      = 'def';
	$genderSelected      = 'def';
	$deptSelected        = 'def';
	$train_classSelected = '';
	$durationSelected    = '';
	$train_dest_selected = '';
	$dates               = [];

	$sql_date = "SELECT DISTINCT DATE_FORMAT(dateofentry, '%d/%m/%Y') as date FROM student ORDER BY dateofentry DESC";
	$sql_date_rs = $db->query($sql_date);
	if ($sql_date_rs->num_rows > 0) {
		while ($rw = $sql_date_rs->fetch_assoc()) {
			$dates[] = $rw['date'];
		}
	}

/*Retain the value of dropdown*/
if (isset($_SESSION['query'])) {
	$queryFound = $_SESSION['query'];
	logger::log("INFO", $queryFound);
	if (preg_match("/verified=1/", $queryFound)) {
		$statusSelected = 'issued';
	} else if (preg_match("/verified=0/", $queryFound)) {
		$statusSelected = 'notIssued';
	}

	if (preg_match("/gender=0/", $queryFound)) {
		$genderSelected = 'M';
	} else if (preg_match("/gender=1/", $queryFound)) {
		$genderSelected = 'F';
	}

	if (preg_match('/branch = "Automobile"/', $queryFound)) {
		$deptSelected = 'A';
	} else if (preg_match('/branch = "Information Technology"/', $queryFound)) {
		$deptSelected = 'IT';
	} else if (preg_match('/branch = "Computer Science"/', $queryFound)) {
		$deptSelected = 'CS';
	} else if (preg_match('/branch = "Computer Engineering"/', $queryFound)) {
		$deptSelected = 'CSE';
	} else if (preg_match('/branch = "Computer Science & Engineering - AI & ML"/', $queryFound)) {
		logger::log("INFO", "preg_matched");
		$deptSelected = 'CSEAIML';
	} else if (preg_match('/branch = "Civil"/', $queryFound)) {
		$deptSelected = 'C';
	} else if (preg_match('/branch = "Electronics"/', $queryFound)) {
		$deptSelected = 'EX';
	} else if (preg_match('/branch = "Mechanical"/', $queryFound)) {
		$deptSelected = 'M';
	} else if (preg_match('/branch = "Electronics & Telecommunications"/', $queryFound)) {
		$deptSelected = 'EXTC';
	}

	if (preg_match('/classof = "First"/', $queryFound)) {
		$train_classSelected = 'F';
	} else if (preg_match('/classof = "Second"/', $queryFound)) {
		$train_classSelected = 'S';
	}

	if (preg_match('/duration = "Quarterly"/', $queryFound)) {
		$durationSelected = 'Q';
	} else if (preg_match('/duration = "Monthly"/', $queryFound)) {
		$durationSelected = 'M';
	}

	if (preg_match('/destination = "B/', $queryFound)) {
		$train_dest_selected = 'B';
	} else if (preg_match('/destination = "D/', $queryFound)) {
		$train_dest_selected = 'D';
	} else if (preg_match('/destination = "S/', $queryFound)) {
		$train_dest_selected = 'S';
	} else if (preg_match('/destination = "M/', $queryFound)) {
		$train_dest_selected = 'M';
	}
}

$filtersActive = isset($_SESSION['query']);
$totalCount    = $total_filtered ?? 0;
$countText     = $totalCount . ' record' . ($totalCount !== 1 ? 's' : '') . ($filtersActive ? ' found' : ' total');
?>

<div class="card mb-3">
  <div class="card-body py-2 px-3">
    <form class="form-inline" action='admin.php' name='filter_form' method='POST'>

      <i class="fa fa-filter text-muted mr-2"></i>

      <select class="form-control form-control-sm mr-2 mb-1" name='status'>
        <option value='def'>Status</option>
        <option <?php if($statusSelected=='notIssued') echo 'selected' ?> value='NI'>Not Issued</option>
        <option <?php if($statusSelected=='issued') echo 'selected' ?> value='I'>Issued</option>
      </select>

      <select class='form-control form-control-sm mr-2 mb-1' name='gender'>
        <option value='def'>Gender</option>
        <option <?php if($genderSelected=='M') echo 'selected' ?> value='M'>Male</option>
        <option <?php if($genderSelected=='F') echo 'selected' ?> value='F'>Female</option>
      </select>

      <select class='form-control form-control-sm mr-2 mb-1' name="dept">
        <option value='def'>Department</option>
        <option <?php if($deptSelected=='A') echo 'selected' ?> value='A'>Automobile</option>
        <option <?php if($deptSelected=='IT') echo 'selected' ?> value='IT'>Info. Tech.</option>
        <option <?php if($deptSelected=='C') echo 'selected' ?> value='C'>Civil</option>
        <option <?php if($deptSelected=='M') echo 'selected' ?> value='M'>Mechanical</option>
        <option <?php if($deptSelected=='EXTC') echo 'selected' ?> value='EXTC'>Elex &amp; Telecomn</option>
        <option <?php if($deptSelected=='CS') echo 'selected' ?> value='CS'>Comp. Science</option>
        <option <?php if($deptSelected=='CSE') echo 'selected' ?> value='CSE'>Comp. Engineering</option>
        <option <?php if($deptSelected=='CSEAIML') echo 'selected' ?> value='CSEAIML'><?php echo CSE_AI_ML; ?></option>
        <option <?php if($deptSelected=='EX') echo 'selected' ?> value='EX'>Electronics</option>
      </select>

      <select class='form-control form-control-sm mr-2 mb-1' name='train_dest'>
        <option value='def'>Destination</option>
        <option value='B' <?php if($train_dest_selected=='B') echo 'selected'?>>Byculla</option>
        <option value='D' <?php if($train_dest_selected=='D') echo 'selected'?>>Dockyard Rd</option>
        <option value='S' <?php if($train_dest_selected=='S') echo 'selected'?>>Sandhurst Rd</option>
        <option value='M' <?php if($train_dest_selected=='M') echo 'selected'?>>Mumbai Central</option>
      </select>

      <select class='form-control form-control-sm mr-2 mb-1' name='train_class'>
        <option value='def'>Class</option>
        <option <?php if($train_classSelected=='F') echo 'selected' ?> value='F'>First</option>
        <option <?php if($train_classSelected=='S') echo 'selected' ?> value='S'>Second</option>
      </select>

      <select class='form-control form-control-sm mr-2 mb-1' name='duration'>
        <option value='def'>Duration</option>
        <option <?php if($durationSelected=='Q') echo 'selected' ?> value='Q'>Quarterly</option>
        <option <?php if($durationSelected=='M') echo 'selected' ?> value='M'>Monthly</option>
      </select>

      <select class='form-control form-control-sm mr-2 mb-1' name='date_filter'>
        <option value='def'>Date</option>
        <?php foreach ($dates as $date): ?>
          <option value="<?= htmlspecialchars($date) ?>"><?= htmlspecialchars($date) ?></option>
        <?php endforeach; ?>
      </select>

      <button class="btn btn-primary btn-sm mr-1 mb-1" name='filter_submit' value='Search' type="submit">
        <i class="fa fa-search mr-1"></i>Search
      </button>

      <a href="admin.php?clear=1"
         class="btn btn-sm btn-outline-secondary mb-1 <?= $filtersActive ? '' : 'disabled' ?>"
         title="Clear filters">
        <i class="fa fa-times"></i>
      </a>

      <span class="small text-muted text-nowrap ml-auto mb-1">
        <?= $filtersActive ? '<span class="badge badge-primary badge-pill mr-1">Filtered</span>' : '' ?>
        <?= htmlspecialchars($countText) ?>
      </span>

    </form>
  </div>
</div>
