<?php


class database
{

    // Initialise all local variables
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $charset = DB_CHARSET;

    private $dbh;
    private $error;

    private $statement;

    public function __construct() // called on new object (connect to db)
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname='. $this->dbname .';charset='. $this->charset;

        $db_options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $db_options);
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function query($query) { // prepare a new query
        $this->statement = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null){ // replace parameters with variable of type in query
        if (is_null($type)) {
            switch (true) {
                case is_int($value): // if int
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value): // if bool
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value): // if null
                    $type = PDO::PARAM_NULL;
                    break;
                default: // if string
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($param, $value, $type);
    }

    public function execute(){ // run query
        return $this->statement->execute();
    }

    public function resultArray(){ // array of query results
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){ // get single query reset
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount(){ // number of rows of query
        return $this->statement->rowCount();
    }

    public function lastInsertId(){ // id of latest insert
        return $this->dbh->lastInsertId();
    }

}