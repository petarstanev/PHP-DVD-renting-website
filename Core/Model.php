<?php

/**
 * Created by PhpStorm.
 * User: Petar
 * Date: 05/01/2016
 * Time: 15:35
 */
abstract class Model {
	/**
	 * @var database connection
	 */
	protected $db;

	/**
	 * Create a new instance of the database connection.
	 */
	public function __construct()
	{
		$this->db = new PDO( 'mysql:host=localhost;dbname=dvd_project;charset=utf8', 'root', '' );
	}
}