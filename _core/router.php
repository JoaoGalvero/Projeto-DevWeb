<?php 
require_once "connection.php";

class Router {
	private array $url = [];
	private PDO $pdo;

	public function __construct($url) {
		$this->pdo = db();
		$this->url = $url;
		$this->call();
    }

	private function call() {
		$method = $_SERVER['REQUEST_METHOD'];
		$data = ($method === 'POST') ? $_POST : $_GET;

		$action = $data['url'] ?? '';

		if (!$action) {
			die("No URL in request");
		}

		if (!isset($this->url[$action])) {
			die("Route '$action' not found");
		}
		error_log($action);

		$fn = $this->url[$action];
		return $fn($data, $this->pdo);
		exit;
	}

}
