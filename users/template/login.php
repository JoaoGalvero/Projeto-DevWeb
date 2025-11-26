<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../_static/css/padrao.css">
    <link rel="stylesheet" href="../../_static/css/login.css">
    <link rel="icon" type="image/x-icon" href="../../_static/assets/favicon.ico">

    <title>Login</title>
</head>
<body>
    <div id="page-loading" class="active"></div>
    <div id="page-transition"></div>

    <header>
        <button class="btn-voltar"><img src="../../_static/assets/button-return.png" alt="Voltar"></button>
    </header>

    <main>
        <form action="../url.php" method="POST" class="login-form">
			<input type="hidden" name="url" value="login_user">
			<div>
            <label for="email">Email:</label>
            <input id="email" type="email" name="email" required>
			</div>
			<div>
			<label for="password">Senha:</label>
			<input id="password" type="password" name="password" required>
			</div>
			<button type="submit" class="btn-enviar"></button>
        </form>
    </main>

    <footer class="footer">
        <p>© 2025 AUDIO·ANG3L LIBRARY·01 — CRIADO POR JOÃO PEDRO GALVERO APENAS PARA USO EDUCATIVO — AAL01</p>
    </footer>

    <script src="../../_static/app/page-transition.js"></script>
    <script src="../../_static/app/page-loader.js"></script>
</body>
</html>
