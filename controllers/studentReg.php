<?php
require_once dirname(__DIR__, 1).'/controllers/studentController.php';
$controller = new StudentController();

if (isset($_POST) && $_POST['student_type'] == 'registration') {
    $redirect = $controller->studentRegister($_POST);
    echo "<script type='text/javascript'>alert('Saved successfully!')</script>";
    header('Location: '.$redirect);
}

if (isset($_POST) && $_POST['student_type'] == 'cource') {
    $redirect = $controller->courceRegister($_POST);
    echo "<script type='text/javascript'>alert('Saved successfully!')</script>";
    header('Location: '.$redirect);
}

if (isset($_POST) && $_POST['student_type'] == 'cource_subscribe') {
    $redirect = $controller->courceSubscribe($_POST);
    echo "<script type='text/javascript'>alert('Saved successfully!')</script>";
    header('Location: '.$redirect);
}
