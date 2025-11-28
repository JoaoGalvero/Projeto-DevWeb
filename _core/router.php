<?php 
require_once "connection.php";

class Router {
    private array $routes = [];
    private PDO $pdo;

    public function __construct(array $routes) {
        $this->pdo = db();
        $this->routes = $routes;
        $this->dispatch();
    }

    private function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $data = ($method === 'POST') ? $_POST : $_GET;

        $action = $data['url'] ?? null;

        if (!$action) {
            die("❌ Nenhuma rota foi enviada (campo 'url' ausente).");
        }

        if (!isset($this->routes[$action])) {
            die("❌ Rota '{$action}' não encontrada.");
        }

        $function = $this->routes[$action];

        if (!function_exists($function)) {
            die("❌ A função '{$function}' não existe em view.php.");
        }

        // Limpa qualquer buffer de saída antes do redirecionamento
        if (ob_get_length()) {
            ob_end_clean();
        }

        // ✅ Executa a função e encerra o script
        call_user_func($function, $data, $this->pdo);
        exit;
    }
}
