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

    /**
     * Posts the object to the API (and to the database).
     * @return bool True if the object was successfully posted, false otherwise.
     */
    public function postToApi() : bool {
        $data_json = json_encode($this);

        try {
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, API_URL . $this::$table);
            curl_setopt($handle, CURLOPT_HTTPHEADER,array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
            curl_setopt($handle, CURLOPT_POST, 1);
            curl_setopt($handle, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        $response = $this->curlExec($handle);
        if (!$response) {
            echo "<pre>" . htmlspecialchars($response) . "</pre>";
            return false;
        }
        return true;
    }

    /**
     * Puts the object to the API (and to the database).
     * @return bool True if the object was successfully put, false otherwise.
     */
    public function putToApi() : bool {
        $data_json = json_encode($this);

        try {
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, API_URL . $this::$table);
            curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($handle, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        $response = $this->curlExec($handle);
        if (!$response) {
            echo "<pre>" . htmlspecialchars($response) . "</pre>";
            return false;
        }
        return true;
    }

    /**
     * Deletes the object from the API (and from the database).
     * @return bool True if the object was successfully deleted, false otherwise.
     */
    public function deleteFromApi() : bool {
        $data_json = json_encode($this);

        try {
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, API_URL . $this::$table);
            curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($handle, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        $response = $this->curlExec($handle);
        if (!$response) {
            echo "<pre>" . htmlspecialchars($response) . "</pre>";
            return false;
        }
        return true;
    }

    /**
     * Gets the object from the API (and from the database).
     * @return bool True if the object was successfully retrieved, false otherwise.
     */
    public function getFromApi() : bool {
        $data_json = json_encode($this);

        try {
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, API_URL . $this::$table);
            curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($handle, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        $response = $this->curlExec($handle);
        if (!$response) {
            echo "<pre>" . htmlspecialchars($response) . "</pre>";
            return false;
        }
        return true;
    }

    public static function getTableFromApi(string $orderby = null, bool $desc = false) : bool {
        $url = API_URL . "table/" . static::$table;
        if ($orderby) {
            $url .= "?orderby=" . $orderby;
            if ($desc) $url .= "&desc=true";
        }
        try {
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, $url);
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        $response = static::curlExec($handle);
        if (!$response) {
            echo "<pre>" . htmlspecialchars($response) . "</pre>";
            return false;
        }
        return true;
    }

    /**
     * Executes a cURL request safely and returns the response, or false if an error occurred.
     * @param CurlHandle $handle The cURL handle to execute.
     * @return string|false The response from the cURL request, or false if an error occurred.
     */
    public static function curlExec(CurlHandle $handle) : string|false {
        try {
            $response = curl_exec($handle);

            if (!$response) {
                throw new Exception("Error executing POST request");
                exit();
            }

            $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

            if ($httpCode > 299 || $httpCode < 200) {
                echo "<pre>" . htmlspecialchars($response) . "</pre>";
                throw new Exception("Error creating account: API returned HTTP code $httpCode.");
                exit();
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
        return $response;
    }

    public static function getCle() { return static::$cle; }
    public static function getTable() { return static::$table; }
    public function get(string $attr) { return $this->$attr; }
    public function set(string $attr, mixed $value) { $this->$attr = $value; }
}

?>
