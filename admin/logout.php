<?php

include '../config.php';

$NguoiDung = new Admin();
$NguoiDung->endSession();

header('Location: login.html');
