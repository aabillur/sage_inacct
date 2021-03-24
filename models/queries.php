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
                try {
                    $conn = new PDO("mysql:host=".$scm_config['db.slave.host'].";dbname=".$scm_config['db.slave.db']."", $scm_config['db.slave.user'], $scm_config['db.slave.password']);
                    //error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->connection = $conn;
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            }

            public function execute($query)
            {
                /*$stmt = $this->connection->prepare($query);
                $stmt->execute();
                if (!$stmt->execute();) {
                    throw new Exception("Execute failed:");
                }
                return true;*/
            }

            //Get query result in array
            public function query_response($query)
            {
                $stmt = $this->connection->prepare($query);
                $stmt->execute();
                $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                if (!empty($res)) {
                    return $res;
                } else {
                    return false;
                }
            }


            public function num_of_rows($query)
            {
                $stmt = $this->connection->prepare($query);
                $stmt->execute();
                $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                if (!empty($res)) {
                    return sizeof($res);
                }
                return 0;
            }

            public function deleteQuery($table, $column, $id)
            {
                $stmt = $this->connection->prepare("DELETE FROM {$table} WHERE {$column} = :{$column}");
                $stmt->bindValue(':'.$column, $id);
                if (!$stmt->execute()) {
                    throw new Exception("Execute failed:");
                }
                return true;
            }


            public function updateQuery($table, $data, $whereClause, $whereVal)
            {
                $this->connection->beginTransaction();
                foreach ($data as $column => $value) {
                    $stmt = "UPDATE {$table} SET {$column} = :{$column} WHERE {$whereClause} = :{$whereClause}";
                    $stmt = $this->connection->prepare($stmt);
                    $stmt->bindValue(':'.$column, $value);
                    $stmt->bindValue(':'.$whereClause, $whereVal);
                    $stmt->execute();
                }
                $this->connection->commit();
            }

            public function insertQuery($table, $data)
            {
                $this->connection->beginTransaction();
                $sql = "INSERT INTO {$table} (".implode(',', array_keys($data)).") VALUES (:".implode(',:', array_keys($data)).")";
                $stmt = $this->connection->prepare($sql);
                foreach ($data as $key => $value) {
                    $stmt->bindValue(':'.$key, $value);
                }
                if (!$stmt->execute()) {
                    throw new Exception("Execute failed:");
                }
                $this->connection->commit();
            }

            public function replaceQuery($table, $data)
            {
                $this->connection->beginTransaction();
                $sql = "REPLACE INTO {$table} (".implode(',', array_keys($data)).") VALUES (:".implode(',:', array_keys($data)).")";
                $stmt = $this->connection->prepare($sql);
                foreach ($data as $key => $value) {
                    $stmt->bindValue(':'.$key, $value);
                }
                if (!$stmt->execute()) {
                    throw new Exception("Execute failed:");
                }
                $this->connection->commit();
            }
        }
