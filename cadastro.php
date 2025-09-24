<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Ideias - Nome da Startup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.html">Início</a></li>
                <li><a href="sobre.html">Sobre</a></li>
                <li><a href="cadastro.php">Cadastrar Ideia</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="form-container">
            <h1>Cadastre sua Ideia</h1>
            <p>Tem uma ideia de startup incrível? Preencha o formulário abaixo e nos conte sobre ela. Sua contribuição pode ser a próxima grande novidade no mercado!</p>
            
            <?php
            // Este é o código PHP que conecta ao banco de dados e salva a informação.
            // Para que funcione, você precisa ter um banco de dados chamado "teste" e
            // uma tabela chamada "users" com as colunas "nome" e "email".

            // O código a seguir verifica se o formulário foi enviado (método POST)
            // e, se sim, conecta ao banco de dados para salvar as informações.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $con = mysqli_connect("localhost", "root", "", "teste");

                // Verifica a conexão
                if (mysqli_connect_errno()) {
                    echo "<p class='message error'>Falha na conexão com o banco de dados: " . mysqli_connect_error() . "</p>";
                } else {
                    // Prepara os dados do formulário para evitar ataques (SQL Injection)
                    $nome = mysqli_real_escape_string($con, $_POST['nome']);
                    $email = mysqli_real_escape_string($con, $_POST['email']);
                    $ideia = mysqli_real_escape_string($con, $_POST['ideia']);

                    // Monta e executa a query de inserção
                    $query = "INSERT INTO users (nome, email, ideia) VALUES ('$nome', '$email', '$ideia')";
                    
                    if (mysqli_query($con, $query)) {
                        echo "<p class='message success'>Sua ideia foi cadastrada com sucesso! Agradecemos sua contribuição.</p>";
                    } else {
                        echo "<p class='message error'>Erro ao cadastrar: " . mysqli_error($con) . "</p>";
                    }

                    // Fecha a conexão com o banco de dados
                    mysqli_close($con);
                }
            }
            ?>

            <form action="cadastro.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="ideia">Sua Ideia:</label>
                    <textarea id="ideia" name="ideia" rows="5" required></textarea>
                </div>
                <button type="submit">Enviar Ideia</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Nome da Startup. Todos os direitos reservados.</p>
    </footer>

</body>
</html>