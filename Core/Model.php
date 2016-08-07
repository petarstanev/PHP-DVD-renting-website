<?php

/**
 * Core class Model
 * Used by all models as a parent class.
 */
abstract class Model {
	/**
	 * @var database connection
	 */
	protected $db;

	/**
	 * Create a new instance of the database connection when we create the object.
	 */
	public function __construct()
	{
		$this->db = new PDO( 'mysql:host=localhost;dbname=cd_database;charset=utf8', 'root', '' );
	}
}