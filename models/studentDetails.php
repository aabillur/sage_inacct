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
            $whereClause = " limit ".$offset.",".$this->pageSize;
            $rowCount = Queries::rows(Queries::STUDENT_INFO);
            $studentInfo = Queries::select(Queries::STUDENT_INFO, '*', $whereClause, (new Queries())->dbr());
            $dataList['studentInfo'] = $studentInfo;
            $dataList['page'] = $offset;
            $dataList['pageCount'] = !empty($rowCount) ? (int) ($rowCount / $this->pageSize) + 1 : 0;
            return $dataList;
        }

        public function getCourceDetails($offset)
        {
            $offset = (int) ($offset - 1) * 10;
            $rowCount = Queries::rows(Queries::COURCE_INFO);
            $whereClause = " limit ".$offset.",".$this->pageSize;
            $counrceInfo = Queries::select(Queries::COURCE_INFO, '*', $whereClause);
            $dataList['counrceInfo'] = $counrceInfo;
            $dataList['page'] = $offset;
            $dataList['pageCount'] = !empty($counrceInfo) ? (int) (sizeof($counrceInfo) / $this->pageSize) + 1 : 0;
            return $dataList;
        }

        public function getStudentList()
        {
            $studentInfo = Queries::select(Queries::STUDENT_INFO);
            return $studentInfo;
        }

        public function getCourceList()
        {
            $counrceInfo = Queries::select(Queries::COURCE_INFO);
            return $counrceInfo;
        }

        public function getAllRegDetails($offset)
        {
            $offset = (int) ($offset - 1) * 10;
            $query  = "select fname,lname,cource,c_detail from ".Queries::STUDENT_INFO." s left join ".Queries::STUDENT_COURCE_INFO." sc on sc.student_id = s.student_id left join ".Queries::COURCE_INFO." c on c.course_id = sc.cource_id";
            $rowCount = Queries::rowsJoin($query);
            $studentInfo = Queries::selectJoin($query ." limit ".$offset.",".$this->pageSize);
            $dataList['studentInfo'] = $studentInfo;
            $dataList['page'] = $offset;
            $dataList['pageCount'] = !empty($studentInfo) ? (int) (sizeof($studentInfo) / $this->pageSize) + 1 : 0;
            return $dataList;
        }
    }
