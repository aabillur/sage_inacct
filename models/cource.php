<?php
    /**
     * @author : Arun Billur
     */
    class Cource
    {
        private $courceName;
        private $courceDetails;

        public function __construct($courceName, $courceDetails)
        {
            $this->courceName = $courceName;
            $this->courceDetails  = $courceDetails;
        }

        public function getCourceInfo()
        {
            $courceInfo = [
                'courceName' 	=> $this->courceName,
                'courceDetails' => $this->courceDetails
            ];
            return $courceInfo;
        }
    }
