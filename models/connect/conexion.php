<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';

class Conexion {

    private $host;
    private $namedb;
    private $userdb;
    private $paswordb;
    private $charset;

    private static $pdo = null;

    public function __construct() {

        $this->host = DB_HOST;
        $this->namedb = DB_NAME;
        $this->userdb = DB_USER;
        $this->paswordb = DB_PASS;
        $this->charset = 'utf8';

        if(self::$pdo == null){

            $this->conectar();
        }
    }

    private function conectar() {
        $dsn = "mysql:host={$this->host};dbname={$this->namedb};charset={$this->charset}";

        try{
            self::$pdo = new PDO($dsn, $this->userdb, $this->paswordb);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(pdoException $e){
            die('Hubo un error'.$e->getMessage());

        }
    }

    public static function obtenerConexion() {
        if (self::$pdo == null) {
            new self;
        }

        return self::$pdo;

    }

    public function contesta(){
        $dsn = "mysql:host={$this->host};dbname={$this->namedb};charset={$this->charset}";

        return $dsn;
    //return 'texto';
    }
}

// try {
//     $conexion = Conexion::obtenerConexion();
//     echo "conexion con exito ";


// }catch(Exception $e){

//     echo "Error : ".$e->getMessage();
// }
//echo "la compilacion esta ok";

?>