<?php

/**
 * @author : Arun Billur
 */
require_once dirname(__DIR__, 1).'/models/studentRepo.php';
require_once dirname(__DIR__, 1).'/models/student.php';
require_once dirname(__DIR__, 1).'/models/cource.php';
class StudentController
{
    private $repository;
    public function __construct()
    {
        $this->repository = new StudentRepo();
    }

    public function studentRegister($params)
    {
        if (isset($params['type']) && $params['type'] == 'edit') {
            $this->repository->editStudentInfo($params);
            return '../views/studentView.php';
        } elseif (isset($params['type']) && $params['type'] == 'delete') {
            $this->repository->deleteStudentInfo($params);
            return '../views/studentView.php';
        } else {
            if (isset($params['fname'])) {
                $user = new Student($params['fname'], $params['lname'], $params['dob'], $params['phone']);
                $this->repository->addStudentInfo($user);
                return '../views/studentView.php';
            }
        }
    }

    public function courceRegister($params)
    {
        if (isset($params['type']) && $params['type'] == 'edit') {
            $this->repository->editCourceInfo($params);
            return '../views/courceView.php';
        } elseif (isset($params['type']) && $params['type'] == 'delete') {
            $this->repository->deleteCourceInfo($params);
            return '../views/courceView.php';
        } else {
            if (isset($params['cname'])) {
                $user = new Cource($params['cname'], $params['cdetails']);
                $this->repository->addCourceInfo($user);
                return '../views/courceView.php';
            }
        }
    }

    public function courceSubscribe($params)
    {
        $this->repository->addcourceSubscribe($params);
        return '../views/courceSubscribeView.php';
    }
}
