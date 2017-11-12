<?php

namespace dofus;

use Illuminate\Database\Capsule\Manager as DB;

/**
 * Classe de connection a la base de donees
 * Class DatabaseFactory
 * @package dofus
 */
class DatabaseFactory
{

    private static $connectionName;
	private static $dbConfig;

	/**
	 * Chargement du fichier de configuration
	 */
	public static function setConfig() {
		if (is_null(self::$dbConfig)) {
			$conf = require(SRC . DS . 'conf' . DS . 'db.conf.php');
			self::$connectionName = $conf['default'];
			self::$dbConfig = $conf[$conf['default']];
		}
	}

	/**
	 * Creation de la connexion a la base de donnees
	 */
	public static function makeConnection() {
		if (!is_null(self::$dbConfig)) {
			$db = new DB();
			$db->addConnection(
				[
					'driver'    => self::$dbConfig['driver'],
					'host'      => self::$dbConfig['host'],
					'port'      => self::$dbConfig['port'],
					'database'  => self::$dbConfig['dbName'],
					'username'  => self::$dbConfig['user'],
					'password'  => self::$dbConfig['pass'],
					'charset'   => 'utf8',
					'collation' => 'utf8_unicode_ci',
					'prefix'    => ''
				]
			);
			$db->setAsGlobal();
			$db->bootEloquent();
		}
	}

}
