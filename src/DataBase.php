<?php
declare(strict_types=1);

namespace App;


use InvalidArgumentException;
use PDO;
use PDOException;

class DataBase
{

    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * DataBase constructor.
     * @param string $dsn
     * @param string $username
     * @param string $password
     */
    public function __construct(string $dsn, string $username = '', string $password = '')
    {
        try {
            $this->connection = new PDO($dsn, $username, $password);
            // echo "Connected Successfully";

        } catch (PDOException $exception) {
            // echo "Connection with DataBase is failed " . $exception->getMessage();
            throw new InvalidArgumentException('Database error ' . $exception->getMessage());
        }

        //expect exception
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //when SELECT fetch
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }

}