<?php declare(strict_types=1);

namespace Src\Models;

use Src\Models\Interfaces\DatabaseInterface;

class DatabaseMysql implements DatabaseInterface
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $result;

    public function __construct($servername=null, $username=null, $password=null, $dbname=null)
    {
        if (isset($GLOBALS['DB_DSN'])) {
            $this->servername = $GLOBALS['DB_DSN'];
            $this->username   = $GLOBALS['DB_USER'];
            $this->password   = $GLOBALS['DB_PASSWD'];
            $this->dbname     = $GLOBALS['DB_DBNAME'];
        } else {
            $this->servername = $servername ?? getenv('MYSQL_SERVER');
            $this->username   = $username ?? getenv('MYSQ_USER');
            $this->password   = $password ?? getenv('MYSQL_PASS');
            $this->dbname     = $dbname ?? getenv('MYSQL_DATABASE');
        }
    }

    public function openConnection(): void
    {

        $this->conn = mysqli_connect($this->servername,
                               $this->username,
                               $this->password,
                               $this->dbname);

        if (!$this->conn) {
            throw new \PDOException("Connection failed: " . mysqli_connect_error());
        }
    }

    public function runQuery(string $query)
    {
        return $this->result = mysqli_query($this->conn, $query);
    }

    public function fetchArray(): ?array
    {
        if(mysqli_num_rows($this->result) < 1) {
            return null;
        }

        return mysqli_fetch_all($this->result, MYSQLI_ASSOC);
    }

    public function fetchAssocData(): ?array
    {
        if(mysqli_num_rows($this->result) < 1) {
            return $this->result;
        }

        return mysqli_fetch_assoc($this->result);
    }

    public function closeConnection(): void
    {
        mysqli_close($this->conn);
    }
}