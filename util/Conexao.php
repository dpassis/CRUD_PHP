<?php

require_once 'config.php';

class Conexao 
{

    /**
    * Instância da Conexaõ
    *@var PDO
    */
    private static $instance;

    /**
     * Tipo do banco de dados
     * 
     * Pode ser:
     * <li>MySQL</li>
     * <li>PostgreSQL</li>
     * <li>SQL Server</li>
     * <li>Oracle</li>
     * <li>SQLite</li>
     * @var string
     */
    private static $dbType = DB_TYPE;
    /**
     * Host do banco de dados
     * @var string
     */
    private static $host = DB_HOST;
    /**
     * Usuario de conexao ao banco de dados
     * @var string
     */
    private static $user = DB_USER;
    /**
     * Senha de conexao ao banco de dados
     * @var string
     */
    private static $senha = DB_PASS;
    /**
     * Nome do banco de dados
     * @var string
     */
    private static $db = DB_NAME;

    /**
    * Encoding do banco de dados
    *@var string
    */
    private static $encode = DB_ENCODING;
   

    /**
     * Retorna a instancia de conexao ao banco de dados
     * 
     * Caso a instancia de conexao ja exista, apenas a retorna, caso ainda
     * nao exista, cria a instancia e a retorna.
     * 
     * @return PDO
     */
    public static function getInstance(){

        if(!isset(self::$instance)){

            try {
                self::$instance = new PDO(self::$dbType.':host=' . self::$host . ';dbname=' . self::$db, self::$user, self::$senha,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.self::$encode));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

        }

        return self::$instance;
    }
    
    /**
    *
    *
    */
    public static function prepare($sql){
        return self::getInstance()->prepare($sql);
    }

    /**
     * Fecha a instancia de conexao ao banco de dados
     */
    public static function close() 
    {
        if (self::$instance != null)
            self::$instance = null;
    }
    
}