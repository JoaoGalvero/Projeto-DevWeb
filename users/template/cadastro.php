<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../_static/css/padrao.css">
    <link rel="stylesheet" href="../../_static/css/cadastro.css">
    <link rel="icon" type="image/x-icon" href="../../_static/assets/favicon.ico">

    <title>Cadastro</title>
</head>
<body>
    <div id="page-transition"></div>
    <div id="page-loader"></div>

    <header>
        <button class="btn-voltar"><img src="../../_static/assets/button-return.png" alt="Voltar"></button>
    </header>

    <main>
		<form action="../url.php" method="POST" class="signup-form">
			<input type="hidden" name="url" value="signup_user">
			<input type="hidden" name="url" value="signup_user">
			<div>
			<label for="username">Nome:</label><br>
			<input id="username" type="text" name="username" required>
			</div>
			<div>
			<label for="email">Email:</label><br>
            <input id="email" type="email" name="email" required> <br>
			</div>
			<div>
			<label for="password">Senha:</label><br>
            <input id="password" type="password" name="password" required>
			</div>
			<button type="submit" class="btn-enviar"></button>
        </form>

    </main>

    <footer class="footer">
        <p>© 2025 AUDIO·ANG3L LIBRARY·01 — CRIADO POR PEDRO GALVERO E KAUAI TÁVORA APENAS PARA USO EDUCATIVO — AAL01</p>
    </footer>
    
    <script src="../../_static/app/page-transition.js"></script>
</body>
</html>
