<?php

include '../config.php';

$NguoiDung = new NguoiDung();
$NguoiDung->endSession();

header('Location: login.html');
