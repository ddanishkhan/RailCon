                    <div class="card-body">

                      <!-- Bulk action bar: visible only when rows are selected -->
                      <form action="bulkUpdate.php" method="POST" id="bulkIssueForm">
                        <input type="hidden" id="bulkIssueIds" name="bulkIssueIds" value="">
                        <div id="bulkActionBar" class="mb-3 px-3 py-2 bg-light border rounded align-items-center" style="display:none">
                          <i class="fa fa-check-square-o text-success mr-2"></i>
                          <span id="selectedCount" class="mr-3"><strong>0</strong> selected</span>
                          <span class="text-muted small mr-3">IDs: <span id="selectedIds">—</span></span>
                          <button type="submit" name="bulkIssueSubmit"
                                  class="btn btn-success btn-sm mr-2"
                                  onclick="return confirm('Issue passes for all selected students?')">
                            <i class="fa fa-check mr-1"></i>Bulk Issue
                          </button>
                          <button type="button" class="btn btn-outline-secondary btn-sm" id="clearSelectionBtn">
                            <i class="fa fa-times mr-1"></i>Clear
                          </button>
                        </div>
                      </form>

                      <div class="table-responsive">
                        <table class="table table-striped table-sm">
                          <thead class="thead-light">
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Gender</th>
                              <th>Age</th>
                              <th>Source</th>
                              <th>Destination</th>
                              <th>Passno</th>
                              <th>Class</th>
                              <th>Duration</th>
                              <th>DateOfEntry</th>
                              <th>Status</th>
                              <th>ID Card</th>
                              <th>Actions</th>
                              <th title="Select / deselect all on this page">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="selectAllCheckbox">
                                  <label class="custom-control-label font-weight-bold" for="selectAllCheckbox">Select</label>
                                </div>
                              </th>
                              <th>Remarks</th>
                            </tr>
                          </thead>
                          <tbody>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $idd = $row['id'];
        $age = date_diff(date_create(), date_create($row['DOB']));
?>
                            <tr id="row_<?= $idd ?>">
                              <th scope="row"><?= $idd ?></th>
                              <td>
                                <a href="complete_data.php?student=<?= $idd ?>">
                                  <?= htmlspecialchars($row['fullname']) ?>
                                </a>
                              </td>
                              <td><?= $row['gender'] == '1' ? 'Female' : 'Male' ?></td>
                              <td>
                                <?= htmlspecialchars($row['dateOB']) ?><br>
                                <small class="text-muted"><?= $age->format('%Y Y %M M') ?></small>
                              </td>
                              <td><?= htmlspecialchars($row['source']) ?></td>
                              <td><?= htmlspecialchars($row['destination']) ?></td>
                              <td>
                                <?= htmlspecialchars($row['passno']) ?>
                                <?php if (strcasecmp($row['passno'], 'NO') != 0): ?>
                                  <br><small class="text-muted"><?= htmlspecialchars($row['pass_end']) ?></small>
                                  <br><small class="text-muted"><?= htmlspecialchars($row['voucher']) ?></small>
                                  <br><small class="text-muted"><?= htmlspecialchars($row['season']) ?></small>
                                <?php endif; ?>
                              </td>
                              <td><?= htmlspecialchars($row['classof']) ?></td>
                              <td><?= htmlspecialchars($row['duration']) ?></td>
                              <td><?= htmlspecialchars($row['date']) ?></td>
                              <td>
                                <?php if ($row['verified'] == '1'): ?>
                                  <span class="badge badge-success">Issued</span>
                                <?php else: ?>
                                  <span class="badge badge-secondary">Pending</span>
                                <?php endif; ?>
                              </td>
                              <td>
                                <img id="img<?= $idd ?>"
                                     src="MyUploadImages/<?= htmlspecialchars($row['img_loc']) ?>"
                                     data-toggle="modal" data-target="#imgModal"
                                     height="60" style="cursor:pointer;border-radius:3px">
                              </td>
                              <td style="min-width:110px">
                                <form action="update.php" method="POST" class="mb-1">
                                  <input type="hidden" name="id" value="<?= $idd ?>">
                                  <button type="submit" class="btn btn-success btn-sm btn-block" name="verify_it">Issue</button>
                                  <button type="submit" class="btn btn-danger btn-sm btn-block mt-1" name="cancel_verify">Unissue</button>
                                </form>
                                <form action="edit.php" method="POST" class="mb-1">
                                  <input type="hidden" name="id" value="<?= $idd ?>">
                                  <button type="submit" class="btn btn-info btn-sm btn-block" name="edit">Edit</button>
                                </form>
                                <form action="delete.php" method="POST" class="mb-1"
                                      onsubmit="return confirm('Delete this record?')">
                                  <input type="hidden" name="id" value="<?= $idd ?>">
                                  <button type="submit" class="btn btn-outline-danger btn-sm btn-block" name="delete">Delete</button>
                                </form>
                                <form action="editform.php" method="POST">
                                  <input type="hidden" name="id" value="<?= $idd ?>">
                                  <button type="submit" class="btn btn-outline-secondary btn-sm btn-block" name="edit_form">Allow Edit</button>
                                </form>
                              </td>
                              <td>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input bulk-checkbox"
                                         id="bulk_<?= $idd ?>" value="<?= $idd ?>">
                                  <label class="custom-control-label" for="bulk_<?= $idd ?>"></label>
                                </div>
                              </td>
                              <td style="min-width:160px">
                                <form method="POST" action="update_remark.php">
                                  <input type="hidden" name="id" value="<?= $idd ?>">
                                  <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="remark" placeholder="Remarks">
                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-outline-secondary" name="update_remark">Save</button>
                                    </div>
                                  </div>
                                </form>
                              </td>
                            </tr>
<?php
    } // end while
} else {
    echo '<tr><td colspan="15" class="text-center py-4 text-muted"><strong>No Records</strong></td></tr>';
}
?>

                          </tbody>
                        </table>
                      </div>
                    </div>

<!-- Image preview modal (single instance, shared across all rows) -->
<div id="imgModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="max-width:90%">
    <div class="modal-content">
      <div class="modal-body">
        <div class="image-wrapper">
          <img class="showimage img-responsive" src="" style="max-width:90%;max-height:700px">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-secondary" id="rotateBtn">Rotate</button>
      </div>
    </div>
  </div>
</div>

<script>
$(function () {

  /* ---- Image modal ---- */
  var rotation = 0;
  $(document).on('click', 'img[data-target="#imgModal"]', function () {
    $('.showimage').attr('src', $(this).attr('src'));
    rotation = 0;
    rotateImage(0);
  });
  $('#rotateBtn').on('click', function () {
    rotation += 45;
    rotateImage(rotation);
  });
  function rotateImage(deg) {
    $('.showimage').css('transform', 'rotate(' + deg + 'deg)');
  }

  /* ---- Bulk issue ---- */
  function updateBulkBar() {
    var $checked = $('.bulk-checkbox:checked');
    var ids      = $checked.map(function () { return this.value; }).get();
    var count    = ids.length;
    var total    = $('.bulk-checkbox').length;

    $('#bulkIssueIds').val(ids.join(','));
    $('#selectedCount strong').text(count);
    $('#selectedIds').text(count > 0 ? ids.join(', ') : '—');
    $('#bulkActionBar').css('display', count > 0 ? 'flex' : 'none');

    // Subtle row highlight for selected rows
    $('.bulk-checkbox').each(function () {
      $(this).closest('tr').toggleClass('table-active', this.checked);
    });

    // Drive the select-all checkbox state
    $('#selectAllCheckbox')
      .prop('checked', count === total && total > 0)
      .prop('indeterminate', count > 0 && count < total);
  }

  $(document).on('change', '.bulk-checkbox', updateBulkBar);

  $('#selectAllCheckbox').on('change', function () {
    $('.bulk-checkbox').prop('checked', this.checked);
    updateBulkBar();
  });

  $('#clearSelectionBtn').on('click', function () {
    $('.bulk-checkbox').prop('checked', false);
    $('#selectAllCheckbox').prop('checked', false).prop('indeterminate', false);
    updateBulkBar();
  });

});
</script>
