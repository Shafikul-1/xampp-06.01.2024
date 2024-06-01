<?php
class database
{
    private $host_name = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "rest";

    private $result = array();
    private $sqli = "";
    private $conn = false;

    // database connection function
    public function __construct()
    {
        if (!$this->conn) {
            $this->sqli = new mysqli($this->host_name, $this->username, $this->password, $this->db_name);
            $this->conn = true;
            if ($this->sqli->connect_error) {
                array_push($this->result, $this->sqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }

    // database insert function
    public function insert($table, $params = array())
    {
        if ($this->tableCheck($table)) {
            $tableColumn = implode(' ,', array_keys($params));
            $tableValue = implode("' ,'", $params);

            $sql = "INSERT INTO $table ($tableColumn) VALUES ('$tableValue')";
            if ($this->sqli->query($sql)) {
                array_push($this->result, $this->sqli->insert_id);
                return true;
            } else {
                array_push($this->result, $this->sqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    // database Update function
    public function update($table, $params = array(), $where = null)
    {
        if ($this->tableCheck($table)) {
            $args = array();
            foreach ($params as $key => $value) {
                $args[] = "$key = '$value'";
            }
            $sql = "UPDATE $table SET " . implode(' ,', $args);
            if ($where != null) {
                $sql .= " WHERE $where";
            }

            if ($this->sqli->query($sql)) {
                array_push($this->result, $this->sqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->sqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    // database table Data delete function
    public function delete($table, $where = null)
    {
        if ($this->tableCheck($table)) {
            $sql = "DELETE FROM $table WHERE ";
            if ($where != null) {
                $sql .= "$where";
            }
            if ($this->sqli->query($sql)) {
                array_push($this->result, $this->sqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->sqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    // database table Select and data fetch function
    public function select($table, $rows = "*", $join = null, $where = null, $order = null, $limit = null)
    {
        if ($this->tableCheck($table)) {

            $sql = "SELECT $rows FROM $table";
            if ($join != null) {
                $sql .= " JOIN $join";
            }
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($order != null) {
                $sql .= " ORDER BY $order";
            }
            if ($limit != null) {
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $start = ($page - 1) * $limit;
                $sql .= " LIMIT $start,$limit";
            }
            // echo $sql;

            if ($query = $this->sqli->query($sql)) {
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            } else {
                array_push($this->result, $this->sqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    // Pagination Function
    public function pagination($table, $join = null, $where = null, $limit = null) 
    {
        if ($this->tableCheck($table)) {
            if($limit != null){
                $sql = "SELECT COUNT(*) FROM $table";
                if($join != null){
                    $sql .= " JOIN $join";
                }
                if($where != null){
                    $sql .= " WHERE $where";
                }
                // echo $sql."<br>";
                $query = $this->sqli->query($sql);
                $totalRecord = $query->fetch_array();
                $totalRecord = $totalRecord[0];
                // print_r($totalRecord);
                $totalPage = ceil($totalRecord / $limit);
                // echo "<br>".$totalPage;
                $url = basename($_SERVER['PHP_SELF']);
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                echo "<ul>";
                if ($totalRecord > $limit) {
                    for ($i=1; $i <= $totalPage; $i++) { 
                        if ($i == $page) {
                            $active = 'background: black; color:white;';
                        } else {
                            $active = '';
                        }
                        $style = "border:2px solid green; padding:8px; margin:3px; text-decoration: none; $active";
                        echo "<li style='display:inline-flex;'><a style='$style' href='$url?page=$i'>$i</a></li>";
                    }
                } else {
                    return false;
                }
                
                echo "</ul>";
                
                
            }
        } else {
            return false;
        }
            
    }
    // database table check function
    private function tableCheck($table)
    {
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
        $tableInDb = $this->sqli->query($sql);
        if ($tableInDb) {
            if ($tableInDb->num_rows == 1) {
                return true;
            } else {
                array_push($this->result, "<b>" . $table . "</b> Database Table Not Found");
                return false;
            }
        }
    }

    // array store result show function
    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    // database connection close function
    public function __destruct()
    {
        if ($this->conn) {
            if ($this->sqli->close()) {
                $this->conn = false;
                return true;
            }
        } else {
            return false;
        }
    }
}
