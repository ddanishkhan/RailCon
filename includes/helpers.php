<?php
function deleteImage(string $path): void {
    if (file_exists($path)) {
        unlink($path);
    }
}

function archiveStudentById(int $id, mysqli $db): bool {
    $sel = $db->prepare("SELECT img_loc FROM student WHERE id = ? LIMIT 1");
    $sel->bind_param("i", $id);
    $sel->execute();
    $row = $sel->get_result()->fetch_assoc();
    $sel->close();
    if (!$row) return false;
    $img_loc = $row['img_loc'];

    $db->begin_transaction();

    $ins = $db->prepare(
        "INSERT INTO oldstudent
             (oldid,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,
              source,destination,passno,pass_end,voucher,season,classof,duration,branch,
              year,img_loc,verified,dateofentry,datetodelete,Remark)
         SELECT id,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,
                source,destination,passno,pass_end,voucher,season,classof,duration,branch,
                year,img_loc,verified,dateofentry,datetodelete,Remark
         FROM student WHERE id = ?"
    );
    $ins->bind_param("i", $id);
    $ins->execute();
    if ($ins->affected_rows <= 0) { $ins->close(); $db->rollback(); return false; }
    $ins->close();

    $del = $db->prepare("DELETE FROM student WHERE id = ? LIMIT 1");
    $del->bind_param("i", $id);
    $del->execute();
    if ($del->affected_rows <= 0) { $del->close(); $db->rollback(); return false; }
    $del->close();

    $db->commit();
    deleteImage('MyUploadImages/' . $img_loc);
    return true;
}

function checkIfPassExpiredForExistingEmail(string $email, string $duration, mysqli $db): bool {
    $days = strcasecmp($duration, 'Monthly') === 0 ? 28 : 88;
    $sel = $db->prepare(
        "SELECT id FROM student WHERE email = ? AND dateofentry <= subdate(current_date, ?) LIMIT 1"
    );
    $sel->bind_param("si", $email, $days);
    $sel->execute();
    $row = $sel->get_result()->fetch_assoc();
    $sel->close();
    if (!$row) return false;
    return archiveStudentById((int)$row['id'], $db);
}

function forceArchiveEmail(string $email, mysqli $db): bool {
    $sel = $db->prepare("SELECT id FROM student WHERE email = ? LIMIT 1");
    $sel->bind_param("s", $email);
    $sel->execute();
    $row = $sel->get_result()->fetch_assoc();
    $sel->close();
    if (!$row) return false;
    return archiveStudentById((int)$row['id'], $db);
}
