<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Aluno</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<div class="container">
  <h1>Cadastro de Aluno</h1>

  <form action="processa.php" method="POST">
    <label>Nome:</label><br>
    <input type="text" name="nome" required minlength="3"><br><br>

    <label>Nota 1:</label><br>
    <input type="number" name="nota1" step="0.1" min="0" max="10" required><br><br>

    <label>Nota 2:</label><br>
    <input type="number" name="nota2" step="0.1" min="0" max="10" required><br><br>

    <button type="submit">Cadastrar</button>
  </form>

  <br>
  <a href="lista.php">Ver alunos cadastrados</a>
</div>
  
</body>
</html>