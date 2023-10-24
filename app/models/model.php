<?php

namespace app\models;

class Model
{
    var $servername = "localhost";
    var $db_name = "recoveryniki_db";
    var $username = "root";
    var $password = "";
    var $conn = '';
    function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db_name);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function select($tableName, $select = '*', $where = '', $join = '', $data = [])
    {
        $sql = "Select $select From $tableName";

        if (!empty($join)) {
            $sql .= " $join ";
        }

        if (!empty($where)) {
            $sql .= " Where $where";
        }

        $sql .= ' ORDER BY id DESC';

        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            $data = [];
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }
            return $data;
        } else {
            return false;
        }
    }

    function insert($tableName, $data)
    {
        $columns = implode(",", array_column($data, 'name'));
        $values = implode("', '", array_column($data, 'value'));
        $sql = "INSERT INTO $tableName ($columns) VALUES ('$values');";

        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function update($tableName, $data)
    {
        $update = '';
        for ($i = 0; $i < count(array_column($data['formData'], 'name')); $i++) {
            $update .= ' ' . array_column($data['formData'], 'name')[$i] . '="' . array_column($data['formData'], 'value')[$i] . '"' . ((count(array_column($data['formData'], 'name')) - 1 != $i) ? ',' : '');
        }
        $sql = "UPDATE $tableName SET $update where id = " . $data['id'];
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function delete($tableName, $id)
    {
        $sql = "DELETE FROM $tableName WHERE id = " . $id;
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function user_authentication($data)
    {
        $sql = "SELECT id FROM user Where";
        for ($i = 0; $i < count($data); $i++) {
            if ($i != 0) {
                $sql .= " AND ";
            }
            $sql .= " " . array_keys($data)[$i] . " = '" . $data[array_keys($data)[$i]] . "'";
        }
        $sql .= " LIMIT 1 ";

        $result = mysqli_query($this->conn, $sql);
        if ($result->num_rows) {
            $data = [];
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }
            $_SESSION['user_id'] = $data[0]['id'];
            return true;
        } else {
            return false;
        }
    }
}
