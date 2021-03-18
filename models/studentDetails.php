<?php
    /**
     * @author : Arun Billur
     */
    require_once 'queries.php';
    class studentDetails extends Queries
    {
        private $pageSize = 10;

        public function getStudentRegDetails($offset)
        {
            $offset = (int) ($offset - 1) * 10;
            $query  = "select * from sage_student_info";
            $rowCount = parent::num_of_rows($query);
            $studentInfo = parent::query_response($query ." limit ".$offset.",".$this->pageSize);
            $dataList['studentInfo'] = $studentInfo;
            $dataList['page'] = $offset;
            $dataList['pageCount'] = !empty($rowCount) ? (int) ($rowCount / $this->pageSize) + 1 : 0;
            return $dataList;
        }

        public function getCourceDetails($offset)
        {
            $offset = (int) ($offset - 1) * 10;
            $query  = "select * from sage_cource_info";
            $rowCount = parent::num_of_rows($query);
            $counrceInfo = parent::query_response($query ." limit ".$offset.",".$this->pageSize);
            $dataList['counrceInfo'] = $counrceInfo;
            $dataList['page'] = $offset;
            $dataList['pageCount'] = !empty($counrceInfo) ? (int) (sizeof($counrceInfo) / $this->pageSize) + 1 : 0;
            return $dataList;
        }

        public function getStudentList()
        {
            $studentInfo = parent::query_response("select * from sage_student_info");
            return $studentInfo;
        }

        public function getCourceList()
        {
            $counrceInfo = parent::query_response("select * from sage_cource_info");
            return $counrceInfo;
        }

        public function getAllRegDetails($offset)
        {
            $offset = (int) ($offset - 1) * 10;
            $query  = "select fname,lname,cource,c_detail from sage_student_info s left join sage_student_course_info sc on sc.student_id = s.student_id left join sage_cource_info c on c.course_id = sc.cource_id";
            $rowCount = parent::num_of_rows($query);
            $studentInfo = parent::query_response($query ." limit ".$offset.",".$this->pageSize);

            $dataList['studentInfo'] = $studentInfo;
            $dataList['page'] = $offset;
            $dataList['pageCount'] = !empty($studentInfo) ? (int) (sizeof($studentInfo) / $this->pageSize) + 1 : 0;
            return $dataList;
        }
    }
