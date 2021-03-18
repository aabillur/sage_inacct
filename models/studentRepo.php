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
                $sql = "INSERT INTO sage_student_info (fname, lname, dob, phone,created_at) VALUES ("."'".$studentInfo['firstName']."'".","."'".$studentInfo['lastName']."'".", ".strtotime($studentInfo['dob']).", ".$studentInfo['contactNo'].",".time().")";
            
                if ($this->queries->execute($sql)) {
                    return true;
                }
            }

            public function addCourceInfo(Cource $cource)
            {
                $courceInfo = $cource->getCourceInfo();
                $sql = "INSERT INTO sage_cource_info (cource, c_detail,created_at) VALUES ("."'".$courceInfo['courceName']."'".","."'".$courceInfo['courceDetails']."'".",".time().")";
                if ($this->queries->execute($sql)) {
                    return true;
                }
            }

            public function editStudentInfo($params)
            {
                $sql = "UPDATE  sage_student_info SET fname = "."'".$params['fname']."'".",lname = "."'".$params['lname']."'".",dob = ".strtotime($params['dob']).",phone = ".$params['phone'].",updated_at = ".time()." WHERE student_id = ".$params['student_id'];
                if ($this->queries->execute($sql)) {
                    return true;
                }
            }

            public function deleteStudentInfo($params)
            {
                $sql = "DELETE FROM sage_student_info WHERE student_id = ".$params['student_id'];
                if ($this->queries->execute($sql)) {
                    return true;
                }
            }


            public function addcourceSubscribe($params)
            {
                $sql = "REPLACE INTO sage_student_course_info (student_id, cource_id,created_at) VALUES (".$params['student'].",".$params['cource'].",".time().")";
                if ($this->queries->execute($sql)) {
                    return true;
                }
            }

            public function editCourceInfo($params)
            {
                $sql = "UPDATE sage_cource_info SET cource = "."'".$params['cource']."'".",c_detail = "."'".$params['cDetail']."'".",updated_at = ".time()." WHERE course_id = ".$params['cource_id'];
                if ($this->queries->execute($sql)) {
                    return true;
                }
            }

            public function deleteCourceInfo($params)
            {
                $sql = "DELETE FROM sage_cource_info WHERE course_id = ".$params['cource_id'];
                if ($this->queries->execute($sql)) {
                    return true;
                }
            }
        }
