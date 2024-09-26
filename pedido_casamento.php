<?php
// Configurações do banco de dados SQLite
$db = new SQLite3('respostas_casamento.db');

// Criar tabela se não existir
$db->exec("CREATE TABLE IF NOT EXISTS respostas_casamento (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    resposta TEXT NOT NULL,
    data_resposta DATETIME DEFAULT CURRENT_TIMESTAMP
);");

// Se o formulário for enviado, insira a resposta no banco de dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resposta = $_POST['response'];
    $query = "INSERT INTO respostas_casamento (resposta) VALUES ('$resposta')";
    $db->exec($query);
    
    // Redirecionar para a página de resposta
    header("Location: ?resposta=$resposta");
    exit;
}

// Pegar a resposta da URL, se houver
$resposta = isset($_GET['resposta']) ? $_GET['resposta'] : null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido de Casamento para Joseane</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5em;
            color: #333;
        }
        h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        button {
            padding: 15px 30px;
            margin: 10px;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .yes-btn {
            background-color: #28a745;
            color: white;
        }
        .no-btn {
            background-color: #dc3545;
            color: white;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            font-size: 1.1em;
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($resposta): ?>
            <?php if ($resposta === 'sim'): ?>
                <h1>Sim, você me fez a pessoa mais feliz do mundo!</h1>
                <p>Eu sabia que esse momento seria especial, mas nada se compara a ouvir você dizer "sim".</p>
                <p>Agora, vamos começar nossa vida juntos com muito amor e felicidade.</p>
            <?php else: ?>
                <h1>Oh não...</h1>
                <p>Entendo que você não está pronta, e tudo bem. Meu amor por você continua o mesmo.</p>
                <p>Estarei sempre esperando por você quando estiver preparada.</p>
            <?php endif; ?>
            <a href="?">Voltar</a>
        <?php else: ?>
            <h1>Um Pedido Especial para Joseane</h1>
            <p>Desde o momento que te conheci, eu sabia que você era especial. Agora, só me resta fazer a pergunta mais importante de todas:</p>
            <h2>Joseane, você quer se casar comigo?</h2>

            <form method="POST">
                <button type="submit" name="response" value="sim" class="yes-btn">Sim, quero!</button>
                <button type="submit" name="response" value="nao" class="no-btn">Não estou pronta</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>