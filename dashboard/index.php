<?php
include_once('../config.php');

if (empty(getSESSION('token'))) header('Location: login.html');

$page = getREQUEST('page');
if (empty($page)) header('Location: TrangChu.html');

try {
  $checkSession = new NguoiDung();
  if ($checkSession->checkSession() == false) {
    $checkSession->endSession();
    header('Location: login.html');
  }
} catch (\Throwable $th) {
  //throw $th;
}

include_once('views/header.php');
include getViewPage('pages/' . $page . '.php');
include_once('views/footer.php');
