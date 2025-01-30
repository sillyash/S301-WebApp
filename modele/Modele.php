<?php

define('CONSTRUCT_POST', 0);
define('CONSTRUCT_PUT', 1);
define('CONSTRUCT_DELETE', 2);
define('CONSTRUCT_GET', 3);

abstract class Modele extends stdClass {
    protected static string $table;
    protected static array $cle;
    protected static array $requiredAttributes;
    protected static array $optionalAttributes;

    public function __construct(array | object $attrs, int $flag = CONSTRUCT_POST) {
        $class = get_called_class();

        if (is_null($attrs)) throw new ArgumentCountError("Object $attrs is null.");

        foreach ($attrs as $attr => $value) {
            $this->set($attr, $value);
        }

        // Check keys (PRIMARY KEY in DB)
        if ($flag == CONSTRUCT_DELETE || $flag == CONSTRUCT_PUT || $flag == CONSTRUCT_GET) {
            foreach ($class::$cle as $k) {
                if (!isset($this->$k))
                    throw new ArgumentCountError("Key value $attr not set.");
            }
        }

        // Check required attributes (NOT NULL in DB)
        if ($flag == CONSTRUCT_POST) {
            foreach ($class::$requiredAttributes as $req) {
                if (!isset($this->$req))
                    throw new ArgumentCountError("Required attribute $req is not defined.");
            }
        }
    }

    /**
     * This function is used to initialize the Model.
     */
    public static function init() {
        $class = get_called_class();
        $class::$cle = [];
        $class::$requiredAttributes = [];
        $class::$optionalAttributes = [];

        $db = Database::$conn;
        $query = $db->query("SELECT * FROM " . $class::$table . " LIMIT 1");
        
        if (!$query) {
            throw new Exception("Table " . $class::$table . " doesn't exist.");
            return false;
        }
        $cols = $query->columnCount();
            
        for ($i = 0; $i < $cols; $i++) {
            $meta = $query->getColumnMeta($i);
            $flags = $meta["flags"];
            $colName = $meta["name"];
            
            if (in_array("primary_key", $flags)) {
                $class::$cle[] = $colName;
            }

            else if (in_array("not_null", $flags)) {
                $class::$requiredAttributes[] = $colName;
            }

            else {
                $class::$optionalAttributes[] = $colName;
            }
        }

        /*
        echo "\nCLE : "; var_dump($class::$cle);
        echo "\nREQ : "; var_dump($class::$requiredAttributes);
        echo "\nOPT : "; var_dump($class::$optionalAttributes);
        echo "\n\n";
        */
    }

    public static function getCle() { return static::$cle; }
    public static function getTable() { return static::$table; }
    public function get(string $attr) { return $this->$attr; }
    public function set(string $attr, mixed $value) { $this->$attr = $value; }
}

?>
