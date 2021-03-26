<?php
        /**
         * @author : Arun Billur
         */
        class Queries
        {
            const STUDENT_INFO = 'sage_student_info';
            const STUDENT_COURCE_INFO = 'sage_student_course_info';
            const COURCE_INFO = 'sage_cource_info';
            
            private $db;
            private $dbr;
            public function __construct()
            {
                require_once  dirname(__DIR__, 1)."/scm_config.php";
                $this->db  = $this->dbConnection(Scm_config::$scm_config['db']);
                $this->dbr = $this->dbConnection(Scm_config::$scm_config['dbr']);
            }

            public function dbr()
            {
                return $this->dbr;
            }

            private function dbConnection($scm_config)
            {
                try {
                    $conn = new PDO("mysql:host=".$scm_config['db.host'].";dbname=".$scm_config['db.db']."", $scm_config['db.user'], $scm_config['db.password']);

                    //error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $conn;
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            }

            //Get query result in array
            public function select($table, $fields = '*', $where = null)
            {
                $query = "SELECT {$fields} FROM {$table} {$where}";
                $dbConn = empty($dbConn) ? $this->db : $dbConn;
                $stmt = $dbConn->prepare($query);
                $stmt->execute();
                $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                if (!empty($res)) {
                    return $res;
                } else {
                    return false;
                }
            }

            public function rows($table, $fields = '*', $where = null, $dbConn = null)
            {
                $query = "SELECT {$fields} FROM {$table} {$where}";
                $dbConn = empty($dbConn) ? $this->db : $dbConn;
                $stmt = $dbConn->prepare($query);
                $stmt->execute();
                $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                if (!empty($res)) {
                    return sizeof($res);
                }
                return 0;
            }


            public function selectJoin($query, $bindVal = array())
            {
                $dbConn = empty($dbConn) ? $this->db : $dbConn;
                $stmt = $dbConn->prepare($query);
                if (!empty($bindVal)) {
                    $stmt->bindValue($bindValue);
                }
                $stmt->execute();
                $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                if (!empty($res)) {
                    return $res;
                } else {
                    return false;
                }
            }

            public function rowsJoin($query, $dbConn = null)
            {
                $dbConn = empty($dbConn) ? $this->db : $dbConn;
                $stmt = $dbConn->prepare($query);
                $stmt->execute();
                $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                if (!empty($res)) {
                    return sizeof($res);
                }
                return 0;
            }

            public function delete($table, $column, $id)
            {
                $dbConn = empty($dbConn) ? $this->db : $dbConn;
                $stmt = $dbConn->prepare("DELETE FROM {$table} WHERE {$column} = :{$column}");
                $stmt->bindValue(':'.$column, $id);
                if (!$stmt->execute()) {
                    throw new Exception("Execute failed:");
                }
                return true;
            }


            public function update($table, $data, $whereClause, $whereVal)
            {
                $dbConn = empty($dbConn) ? $this->db : $dbConn;
                $dbConn->beginTransaction();
                foreach ($data as $column => $value) {
                    $stmt = "UPDATE {$table} SET {$column} = :{$column} WHERE {$whereClause} = :{$whereClause}";
                    $stmt = $dbConn->prepare($stmt);
                    $stmt->bindValue(':'.$column, $value);
                    $stmt->bindValue(':'.$whereClause, $whereVal);
                    $stmt->execute();
                }
                $dbConn->commit();
            }

            public function insert($table, $data)
            {
                $dbConn = empty($dbConn) ? $this->db : $dbConn;
                $dbConn->beginTransaction();
                $sql = "INSERT INTO {$table} (".implode(',', array_keys($data)).") VALUES (:".implode(',:', array_keys($data)).")";
                $stmt = $this->db->prepare($sql);
                foreach ($data as $key => $value) {
                    $stmt->bindValue(':'.$key, $value);
                }
                if (!$stmt->execute()) {
                    throw new Exception("Execute failed:");
                }
                $dbConn->commit();
            }

            public function replace($table, $data)
            {
                $dbConn = empty($dbConn) ? $this->db : $dbConn;
                $dbConn->beginTransaction();
                $sql = "REPLACE INTO {$table} (".implode(',', array_keys($data)).") VALUES (:".implode(',:', array_keys($data)).")";
                $stmt = $dbConn->prepare($sql);
                foreach ($data as $key => $value) {
                    $stmt->bindValue(':'.$key, $value);
                }
                if (!$stmt->execute()) {
                    throw new Exception("Execute failed:");
                }
                $dbConn->commit();
            }
        }
