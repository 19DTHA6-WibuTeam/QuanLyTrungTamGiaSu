<?php
include_once('../config.php');

if (empty(getSESSION('token'))) header('Location: login.html');

$page = getREQUEST('page');
if (empty($page)) header('Location: TrangChu.html');

include_once('views/header.php');
include getViewPage('pages/' . $page . '.php');
include_once('views/footer.php');
