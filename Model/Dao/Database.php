<?php
namespace Model\Dao;

use \PDO;
use \Exception;

class Database {
    const DATASOURCE = 'mysql';
    const HOST = 'localhost';
    const PORT = 3306;
    const DATABASE = 'tele';
    const LOGIN = 'root';
    const PASSWORD = '';

    /** @var Database */
    private static $instance;

    /** @return Database */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    private function __construct() {
    }

    /** @var PDO */
    private $db;

    /** @return PDO */
    private function getDatabase() {
        if ($this->db == null) {
            try {
                $this->db = new PDO(self::DATASOURCE . ':host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE, self::LOGIN, self::PASSWORD);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                exit($e->getTraceAsString());
            }
        }
        return $this->db;
    }

    /**
     * @param string $query
     * @param array $parameters
     * @param callable $factory
     * @return array
     */
    public function read($query, array $parameters = [], callable $factory=null) {
        $db = $this->getDatabase();
        $stmt = $db->prepare($query);
        $stmt->execute($parameters);
        $result = [];
        if ($factory == null) {
            while ($line = $stmt->fetch()) {
                $result[] = $line;
            }
        } else {
            while ($line = $stmt->fetch()) {
                /** @var Hydrator $object */
                $object = $factory();
                $object->hydrate($line);
                $result[] = $object;
            }
        }
        return $result;
    }

    /**
     * @param string $query
     * @param array $parameters
     * @param bool $returnLastId If true, returns the last inserted id, otherwise the number of changed rows.
     * @return int
     */
    public function update($query, array $parameters = [], $returnLastId=false) {
        $db = $this->getDatabase();
        $stmt = $db->prepare($query);
        $stmt->execute($parameters);
        if ($returnLastId) {
            return $db->lastInsertId();
        } else {
            return $stmt->rowCount();
        }
    }
}