<?php

class DB
{
    protected $dbType;
    protected $dbName;
    protected $host;
    protected $userName;
    protected $password;
    protected $connection;

    // whitelist tables
    protected $allowedTables = ['users'];

    function __construct($dbType, $dbName, $host, $password, $userName)
    {
        $this->dbName = $dbName;
        $this->dbType = $dbType;
        $this->host = $host;
        $this->password = $password;
        $this->userName = $userName;

        $this->connection = new PDO(
            "$this->dbType:host=$this->host;dbname=$this->dbName",
            $this->userName,
            $this->password
        );

        // important
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // validate table
    private function validateTable($table)
    {
        if (!in_array($table, $this->allowedTables)) {
            die("Invalid table name");
        }
    }

    // get all
    function index($table)
    {
        try {

            $this->validateTable($table);

            $query = "SELECT * FROM $table";
            $sqlQuery = $this->connection->prepare($query);
            $sqlQuery->execute();

            return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // get single by id
    function show($table, $id)
    {
        try {

            $this->validateTable($table);

            $query = "SELECT * FROM $table WHERE id = :id";
            $sqlQuery = $this->connection->prepare($query);
            $sqlQuery->execute(['id' => $id]);

            return $sqlQuery->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // delete
    function delete($table, $id)
    {
        try {

            $this->validateTable($table);

            $query = "DELETE FROM $table WHERE id = :id";
            $sqlQuery = $this->connection->prepare($query);
            $result = $sqlQuery->execute(['id' => $id]);

            return $result ? "Deleted Successfully" : "Check your data";

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // create
    function create($table, $data)
    {
        try {

            $this->validateTable($table);

            if (empty($data)) {
                return "Data cannot be empty";
            }

            $columns = implode(",", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));

            $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $sqlQuery = $this->connection->prepare($query);

            $result = $sqlQuery->execute($data);

            return $result ? "Inserted Successfully" : "Check your data";

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // update
    function update($table, $data, $id)
    {
        try {

            $this->validateTable($table);

            if (empty($data)) {
                return "Data cannot be empty";
            }

            $setPart = "";

            foreach ($data as $key => $value) {
                $setPart .= "$key = :$key, ";
            }

            $setPart = rtrim($setPart, ", ");

            $query = "UPDATE $table SET $setPart WHERE id = :id";
            $sqlQuery = $this->connection->prepare($query);

            $data['id'] = $id;

            $result = $sqlQuery->execute($data);

            return $result ? "Updated Successfully" : "Check your data";

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}


$database = new DB(
    dbType: "mysql",
    dbName: "users",
    host: "localhost",
    password: "",
    userName: "root"
);

