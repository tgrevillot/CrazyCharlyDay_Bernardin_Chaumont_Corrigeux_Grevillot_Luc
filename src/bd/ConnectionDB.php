<?php
/**
 * Created by PhpStorm.
 * User: terry
 * Date: 07/02/19
 * Time: 09:53
 */

namespace justjob\bd;

use \Illuminate\Database\Capsule\Manager as DB;

class ConnectionDB {

    public static function start($file) {
        $db = new DB();
        $info= parse_ini_file($file);
        $db->addConnection($info);
        $db->setAsGlobal();
        $db->bootEloquent();
    }

}