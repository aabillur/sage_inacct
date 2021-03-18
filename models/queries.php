<?php
        /**
         * @author : Arun Billur
         */
        class Queries
        {
            private $connection;
            public function __construct()
            {
                require_once  dirname(__DIR__, 1)."/scm_config.php";
                $conn = mysqli_connect($scm_config['db.slave.host'], $scm_config['db.slave.user'], $scm_config['db.slave.password'], $scm_config['db.slave.db']);

                if (!$conn) {
                    die('Could not connect to database!');
                } else {
                    $this->connection = $conn;
                    //echo 'Connection established!';
                }
            }


            public function execute($query)
            {
                if (!$this->connection->query($query)) {
                    throw new Exception("Execute failed: ({$statement->errno}) {$statement->error}");
                }
                return true;
            }

            //Get query result in array
            public function query_response($query)
            {
                $count = 0;
                $res = $this->connection->query($query);
                $row_cnt = $res->num_rows;
                if ($row_cnt > 0) {
                    while ($rlt = mysqli_fetch_assoc($res)) {
                        $count = $count + 1;
                        $rlt['slNo'] = $count;
                        $result_array[] = $rlt;
                    }
                    return $result_array;
                } else {
                    return false;
                }
            }


            public function num_of_rows($query)
            {
               $res = $this->connection->query($query);
               return $res->num_rows;

            }
        }
