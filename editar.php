<?php
require __DIR__ . "/inc/funcoes.php";

$id = trim((string)($_GET["id"] ?? ""));
if ($id === "") {
    die("ID inválido.");
}

$alunos = lerAlunos();

$alunoEncontrado = null;
foreach ($alunos as $aluno) {
    if ((string)($aluno["id"] ?? "") === $id) {
        $alunoEncontrado = $aluno;
        break;
    }
}

if (!$alunoEncontrado) {
    die("Aluno não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Aluno</title>
  <link rel="stylesheet" href="styles/style.css">
</head>

<body class="pagina-form">

  <div class="container">

    <h1>Editar Aluno</h1>

    <form action="atualizar.php" method="POST">

      <input type="hidden" name="id" value="<?= htmlspecialchars((string)$alunoEncontrado["id"]) ?>">

      <label>Nome:</label>
      <input type="text"
             name="nome"
             required
             minlength="3"
             value="<?= htmlspecialchars((string)$alunoEncontrado["nome"]) ?>">

      <label>Nota 1:</label>
      <input type="number"
             name="nota1"
             step="0.1"
             min="0"
             max="10"
             required
             value="<?= htmlspecialchars((string)$alunoEncontrado["nota1"]) ?>">

      <label>Nota 2:</label>
      <input type="number"
             name="nota2"
             step="0.1"
             min="0"
             max="10"
             required
             value="<?= htmlspecialchars((string)$alunoEncontrado["nota2"]) ?>">

      <button type="submit">Salvar alterações</button>

    </form>

    <a href="lista.php">← Voltar para a lista</a>

  </div>

</body>
</html>