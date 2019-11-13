<?php

namespace laucw\lib;

/**
 * 模型类
 * @package laucw\lib
 */
class Model extends \PDO
{
    /**
     * 模型构造函数
     * @throws \Exception
     */
    public function __construct()
    {
        $db = config::all('database');
        try {
            if (isset($db['persistent']) && $db['persistent'] === true) {
                $persistent = true;
            } else {
                $persistent = false;
            }
            parent::__construct($db['dsn'], $db['username'], $db['passwd'], 
                [\PDO::ATTR_PERSISTENT => $persistent]
            );
        } catch (\PDOException $e) {
            p($e->getMessage());
        }
    }
}
