<?php

class Database 
{
    protected $connection = null;

    public function __construct()
    {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
            if(mysqli_connect_errno()){
                throw new Exception("Could not connect to database");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function select($query = "", $params = [], $types = "") 
    {
        try {
            $stmt = $this->executeStatement($query, $params, $types);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            return $result;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
        return false;
    }

    public function insert($query = "", $params = [], $types = "") 
    {
        try {
            $stmt = $this->executeStatement($query, $params, $types);
            $stmt->close();
            return true;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
        return false;
    }

    private function executeStatement($query = "", $params = [], $types = "") 
    {
        try {
            $stmt = $this->connection->prepare($query);
            if($stmt === false) {
                throw new Exception("Unable to do prepare statement: " . $query);
            }

            if($params) {
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();

            return $stmt;
        } catch (Exception $e) {
            throw new Exception( $e->getMessage() );
        }
        return false;
    }
}

?>
