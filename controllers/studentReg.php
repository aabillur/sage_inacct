<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__DIR__, 1).'/controllers/studentController.php';
$controller = new StudentController();

if (isset($_POST) && $_POST['student_type'] == 'registration') {
    $redirect = $controller->studentRegister($_POST);
    header('Location: '.$redirect);
}

if (isset($_POST) && $_POST['student_type'] == 'cource') {
    $redirect = $controller->courceRegister($_POST);
    header('Location: '.$redirect);
}

if (isset($_POST) && $_POST['student_type'] == 'cource_subscribe') {
    $redirect = $controller->courceSubscribe($_POST);
    header('Location: '.$redirect);
}
