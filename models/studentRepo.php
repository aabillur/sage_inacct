<?php
        /**
         * @author : Arun Billur
         */
        require_once 'queries.php';
        interface StudentsRepo
        {
            public function addStudentInfo(Student $student);
            public function addCourceInfo(Cource $cource);
        }
        class StudentRepo implements StudentsRepo
        {
            private $queries;
            public function __construct()
            {
                $this->queries = new Queries();
            }

            public function addStudentInfo(Student $student)
            {
                $studentInfo = $student->getStudentInfo();
                $data = [
                    'fname' => $studentInfo['firstName'],
                    'lname' => $studentInfo['lastName'],
                    'dob' => strtotime($studentInfo['dob']),
                    'phone' => $studentInfo['contactNo'],
                    'created_at' => time()
                ];
                if ($this->queries->insertQuery('sage_student_info', $data)) {
                    return true;
                }
            }

            public function addCourceInfo(Cource $cource)
            {
                $courceInfo = $cource->getCourceInfo();
                $data = [
                    'cource' => $courceInfo['courceName'],
                    'c_detail' => $courceInfo['courceDetails'],
                    'created_at' => time()
                ];
                if ($this->queries->insertQuery('sage_cource_info', $data)) {
                    return true;
                }
            }

            public function editStudentInfo($params)
            {
                $data = [
                    'fname' => $params['fname'],
                    'lname' => $params['lname'],
                    'dob' => strtotime($params['dob']),
                    'phone' => $params['phone'],
                    'updated_at' => time()
                ];
                if ($this->queries->updateQuery('sage_student_info', $data, 'student_id', $params['student_id'])) {
                    return true;
                }
            }

            public function deleteStudentInfo($params)
            {
                if ($this->queries->deleteQuery('sage_student_info', 'student_id', $params['student_id'])) {
                    return true;
                }
            }

            public function addcourceSubscribe($params)
            {
                $data = [
                    'student_id' => $params['student'],
                    'cource_id'  => $params['cource'],
                    'created_at' => time()
                ];
                if ($this->queries->replaceQuery('sage_student_course_info', $data)) {
                    return true;
                }
            }

            public function editCourceInfo($params)
            {
                $data = [
                    'cource' => $params['cource'],
                    'c_detail' => $params['cDetail'],
                    'updated_at' => time()
                ];
                if ($this->queries->updateQuery('sage_cource_info', $data, 'course_id', $params['course_id'])) {
                    return true;
                }
            }

            public function deleteCourceInfo($params)
            {
                if ($this->queries->deleteQuery('sage_cource_info', 'course_id', $params['cource_id'])) {
                    return true;
                }
            }
        }
