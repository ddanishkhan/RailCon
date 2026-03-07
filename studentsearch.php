<?php
session_start();
require_once __DIR__ . '/includes/csrf.php';

if (isset($_POST['action_override'])) {
    validate_csrf_token($_POST['csrf_token'] ?? '');
    $_SESSION['override_email_check'] = true;
    unset($_SESSION['allow_override']);
    header('location:index.php');
    die();
}

// Direct POST with email always shows results; session path requires SearchRequest guard
$show_results = isset($_POST['email_id'])
    || ((isset($_SESSION['studentemail']) && isset($_SESSION['SearchRequest'])) || isset($_SESSION['allow_override']));
?>
<?php $page_title = 'RailCon — Form Status'; ?>
<!DOCTYPE html>
<html>
<head>
  <?php require __DIR__ . '/includes/head.php'; ?>
  <style>
    body { background: #f4f6f9; }
    .status-shell { min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; padding: 2rem 1rem; }
    .status-card  { background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,.08); width: 100%; max-width: 680px; overflow: hidden; }
    .status-header { background: #1a73e8; color: #fff; padding: 1.25rem 1.5rem; }
    .status-header h4 { margin: 0; font-weight: 600; letter-spacing: .3px; }
    .status-header p  { margin: .25rem 0 0; font-size: .85rem; opacity: .85; }
    .result-row { display: flex; gap: 1rem; padding: 1.25rem 1.5rem; border-bottom: 1px solid #f0f0f0; align-items: flex-start; }
    .result-row:last-child { border-bottom: none; }
    .result-thumb { flex-shrink: 0; width: 80px; height: 80px; object-fit: cover; border-radius: 8px; cursor: zoom-in; border: 2px solid #e8eaed; transition: border-color .2s; }
    .result-thumb:hover { border-color: #1a73e8; }
    .result-info { flex: 1; min-width: 0; }
    .result-name { font-size: 1rem; font-weight: 600; color: #202124; margin: 0 0 .25rem; }
    .result-meta { font-size: .82rem; color: #5f6368; margin: 0 0 .5rem; }
    .badge-issued  { background: #e6f4ea; color: #1e7e34; padding: .2rem .6rem; border-radius: 20px; font-size: .75rem; font-weight: 600; }
    .badge-pending { background: #fff3cd; color: #856404; padding: .2rem .6rem; border-radius: 20px; font-size: .75rem; font-weight: 600; }
    .remark-box { background: #fef7e0; border-left: 3px solid #f9a825; border-radius: 0 6px 6px 0; padding: .4rem .75rem; font-size: .82rem; color: #5f4a00; margin-top: .5rem; }
    .enroll-no { font-size: .8rem; color: #9aa0a6; margin-top: .3rem; }
    .empty-state { text-align: center; padding: 3rem 1.5rem; color: #9aa0a6; }
    .empty-state i { font-size: 3rem; display: block; margin-bottom: 1rem; }
    /* Lightbox */
    #lightbox { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.88); z-index: 9999; align-items: center; justify-content: center; flex-direction: column; }
    #lightbox.open { display: flex; }
    #lightbox-img { max-width: 90vw; max-height: 82vh; border-radius: 8px; box-shadow: 0 8px 40px rgba(0,0,0,.5); }
    #lightbox-name { color: #fff; margin-top: .75rem; font-size: .95rem; opacity: .85; }
    #lightbox-close { position: fixed; top: 1.25rem; right: 1.5rem; background: rgba(255,255,255,.15); border: none; color: #fff; font-size: 1.5rem; line-height: 1; width: 2.25rem; height: 2.25rem; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background .2s; }
    #lightbox-close:hover { background: rgba(255,255,255,.3); }
    /* Search bar */
    .search-shell { width: 100%; max-width: 680px; margin-bottom: 1.5rem; }
    .search-input-wrap { display: flex; gap: .5rem; }
    .search-input-wrap input { border-radius: 8px; border: 1.5px solid #dadce0; padding: .6rem 1rem; font-size: .95rem; flex: 1; outline: none; transition: border-color .2s; }
    .search-input-wrap input:focus { border-color: #1a73e8; }
    .search-input-wrap button { background: #1a73e8; color: #fff; border: none; border-radius: 8px; padding: .6rem 1.25rem; font-size: .95rem; cursor: pointer; white-space: nowrap; }
    .search-input-wrap button:hover { background: #1558b0; }
    .brand-bar { width: 100%; max-width: 680px; margin-bottom: 1rem; display: flex; align-items: center; gap: .5rem; color: #5f6368; font-size: .9rem; }
    .brand-bar a { color: #1a73e8; text-decoration: none; font-weight: 500; }
    .override-box { background: #fff3cd; border: 1px solid #ffc107; border-radius: 8px; padding: 1rem 1.25rem; margin-bottom: 1rem; width: 100%; max-width: 680px; }
    .error-box { background: #fce8e6; border: 1px solid #f28b82; border-radius: 8px; padding: .75rem 1.25rem; margin-bottom: 1rem; width: 100%; max-width: 680px; font-size: .9rem; color: #c5221f; }
    .edit-link { display: inline-block; margin-top: .5rem; font-size: .82rem; background: #e8f0fe; color: #1a73e8; border: none; border-radius: 6px; padding: .25rem .75rem; cursor: pointer; text-decoration: none; }
    .edit-link:hover { background: #d2e3fc; color: #1558b0; }
  </style>
</head>
<body>

<div class="status-shell">

  <!-- Brand / back link -->
  <div class="brand-bar">
    <a href="index.php">&larr; Back to Form</a>
    <span style="margin-left:auto;font-weight:600;color:#202124">Railway Concession &mdash; Form Status</span>
  </div>

<?php if ($show_results): ?>
<?php
  if (isset($_SESSION['SearchRequest'])) unset($_SESSION['SearchRequest']);

  // Override prompt
  if (isset($_SESSION['allow_override'])): unset($_SESSION['allow_override']); ?>
  <div class="override-box">
    <strong>An existing application was found for this email.</strong><br>
    <small>You can proceed anyway to submit a new application, which will archive the existing one.</small>
    <form method="POST" action="studentsearch.php" class="mt-2">
      <?= csrf_input() ?>
      <input type="hidden" name="action_override" value="1">
      <button type="submit" style="background:#e6a817;color:#fff;border:none;border-radius:6px;padding:.4rem 1rem;cursor:pointer;font-weight:600">Proceed Anyway</button>
    </form>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['studenterror'])): ?>
  <div class="error-box"><?= htmlspecialchars($_SESSION['studenterror']) ?></div>
  <?php unset($_SESSION['studenterror']); ?>
<?php endif; ?>

  <!-- Search again -->
  <div class="search-shell">
    <form method="POST" action="studentsearch.php" class="search-input-wrap">
      <input type="email" name="email_id" placeholder="Search by email address…" value="<?= htmlspecialchars($_SESSION['studentemail'] ?? '') ?>" required>
      <button type="submit">Search</button>
    </form>
  </div>

  <div class="status-card">
    <div class="status-header">
      <h4>Application Status</h4>
      <p><?= htmlspecialchars($_SESSION['studentemail'] ?? ($_POST['email_id'] ?? '')) ?></p>
    </div>

<?php
  require_once __DIR__ . '/database_connection.php';
  $raw_query = isset($_POST['email_id']) ? $_POST['email_id'] : ($_SESSION['studentemail'] ?? '');

  if (strlen($raw_query) >= 3) {
    $search = '%' . $raw_query . '%';
    $stmt = $db->prepare(
      "SELECT id, fullname, source, destination, passno, classof, duration, verified, img_loc,
       DATE_FORMAT(dateofentry, '%d %b %Y') AS date, Remark, edit
       FROM student WHERE email LIKE ? LIMIT 3"
    );
    $stmt->bind_param('s', $search);
    $stmt->execute();
    $rows = $stmt->get_result();
    $stmt->close();

    if ($rows->num_rows === 0): ?>
      <div class="empty-state">
        <i class="fa fa-inbox"></i>
        No application found for this email address.
      </div>
    <?php else:
      while ($row = $rows->fetch_assoc()):
        $imgSrc = htmlspecialchars($row['img_loc'], ENT_QUOTES);
    ?>
      <div class="result-row">
        <img src="MyUploadImages/<?= $imgSrc ?>"
             class="result-thumb"
             data-src="MyUploadImages/<?= $imgSrc ?>"
             data-name="<?= htmlspecialchars($row['fullname'], ENT_QUOTES) ?>"
             alt="ID Card">
        <div class="result-info">
          <p class="result-name"><?= htmlspecialchars($row['fullname']) ?></p>
          <p class="result-meta">
            <?= htmlspecialchars($row['source']) ?> &rarr; <?= htmlspecialchars($row['destination']) ?>
            &nbsp;&middot;&nbsp; <?= htmlspecialchars($row['classof']) ?>
            &nbsp;&middot;&nbsp; <?= htmlspecialchars($row['duration']) ?>
          </p>
          <?php if ($row['verified'] == 1): ?>
            <span class="badge-issued">&#10003; Issued</span>
          <?php else: ?>
            <span class="badge-pending">&#9679; Pending</span>
          <?php endif; ?>
          <p class="enroll-no">Enrollment #<?= (int)$row['id'] ?> &nbsp;&middot;&nbsp; Submitted <?= htmlspecialchars($row['date']) ?></p>
          <?php if (!empty($row['Remark']) && $row['Remark'] !== 'No Remarks'): ?>
            <div class="remark-box"><?= htmlspecialchars($row['Remark']) ?></div>
          <?php endif; ?>
          <?php if ($row['edit'] == 1): ?>
            <form action="student_edit.php" method="POST" style="display:inline">
              <input type="hidden" name="id" value="<?= (int)$row['id'] ?>">
              <button type="submit" name="student_edit" class="edit-link">Edit my form</button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    <?php endwhile; endif;
  } else { ?>
      <div class="empty-state">
        <i class="fa fa-search"></i>
        Enter at least 3 characters to search.
      </div>
  <?php } ?>

  </div><!-- /.status-card -->

<?php else:
  $_SESSION['SearchRequest'] = true;
  unset($_SESSION['studenterror']);
  unset($_SESSION['studentemail']);
?>

  <!-- Initial email entry -->
  <div class="status-card">
    <div class="status-header">
      <h4>Check Application Status</h4>
      <p>Enter your email address to look up your form</p>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="studentsearch.php" class="search-input-wrap">
        <input type="email" name="email_id" placeholder="your@email.com" required autofocus>
        <button type="submit">Check Status</button>
      </form>
      <p style="margin-top:1rem;font-size:.85rem;color:#9aa0a6;text-align:center">
        Want to submit a new form? <a href="index.php" style="color:#1a73e8">Go to the form</a>
      </p>
    </div>
  </div>

<?php endif; ?>

</div><!-- /.status-shell -->

<!-- Custom lightbox (no Bootstrap modal) -->
<div id="lightbox">
  <button id="lightbox-close" onclick="closeLightbox()" title="Close">&times;</button>
  <img id="lightbox-img" src="" alt="ID Card">
  <span id="lightbox-name"></span>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Lightbox
  document.querySelectorAll('.result-thumb').forEach(function (img) {
    img.addEventListener('click', function () {
      document.getElementById('lightbox-img').src  = this.dataset.src;
      document.getElementById('lightbox-name').textContent = this.dataset.name || '';
      document.getElementById('lightbox').classList.add('open');
    });
  });

  function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.getElementById('lightbox-img').src = '';
  }

  document.getElementById('lightbox').addEventListener('click', function (e) {
    if (e.target === this) closeLightbox();
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeLightbox();
  });

  // Restore SearchRequest on search-again submit
  document.querySelector('form.search-input-wrap') &&
    document.querySelector('form.search-input-wrap').addEventListener('submit', function () {
      // session set server-side on next load
    });
</script>
</body>
</html>
