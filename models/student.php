<?php
    /**
     * @author : Arun Billur
     */
    class Student
    {
        private $firstName;
        private $lastName;
        private $dob;
        private $contactNo;

        public function __construct($firstName, $lastName, $dob, $contactNo)
        {
            $this->firstName = $firstName;
            $this->lastName  = $lastName;
            $this->dob 		 = $dob;
            $this->contactNo = $contactNo;
        }

        public function getStudentInfo()
        {
            $studentInfo = [
                'firstName' => $this->firstName,
                'lastName'  => $this->lastName,
                'dob' 	    => $this->dob,
                'contactNo' => $this->contactNo
            ];
            return $studentInfo;
        }
    }
