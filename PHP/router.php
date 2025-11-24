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
        $action = $_POST["url"] ?? "";
		
		if (!$action) {
		    die("No URL in POST");
		}

        if (isset($this->url[$action])) {
            $fn = $this->url[$action];
            return $fn($_POST, $this->pdo);
		}else {
			die("Route '$action' not found");
		}
		exit;
    }
}
