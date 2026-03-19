<?php
require __DIR__ . "/inc/funcoes.php";

$alunos = lerAlunos();

$busca = trim((string)($_GET["busca"] ?? ""));
$buscaNorm = normalizarBusca($busca);

$alunosFiltrados = $alunos;

if ($buscaNorm !== "") {
    $alunosFiltrados = array_values(array_filter($alunos, function ($aluno) use ($buscaNorm) {
        $nomeNorm = normalizarBusca((string)($aluno["nome"] ?? ""));
        return str_contains($nomeNorm, $buscaNorm);
    }));
}

$total = count($alunos);
$totalFiltrado = count($alunosFiltrados);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de Alunos</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body class="pagina-lista">

  <div class="container tabela">

    <h1>Alunos Cadastrados</h1>

    <p><strong>Total de alunos:</strong> <?= $total ?></p>

    <form method="GET" action="lista.php">
      <label for="busca">Buscar por nome:</label>
      <input type="text" name="busca" id="busca" value="<?= htmlspecialchars($busca) ?>" placeholder="Ex: Maria">
      <button type="submit">Buscar</button>
      <a href="lista.php">Limpar</a>
    </form>

    <p><strong>Mostrando:</strong> <?= $totalFiltrado ?> aluno(s)</p>

    <table border="1" cellpadding="6">
      <tr>
        <th>Nome</th>
        <th>Nota 1</th>
        <th>Nota 2</th>
        <th>Média</th>
        <th>Situação</th>
        <th>Ações</th>
      </tr>

      <?php if ($totalFiltrado === 0): ?>
        <tr><td colspan="6">Nenhum aluno encontrado.</td></tr>
      <?php endif; ?>

      <?php foreach ($alunosFiltrados as $aluno): ?>
        <tr>
          <td><?= htmlspecialchars((string)$aluno["nome"]) ?></td>
          <td><?= (float)$aluno["nota1"] ?></td>
          <td><?= (float)$aluno["nota2"] ?></td>
          <td><?= number_format((float)$aluno["media"], 2, ",", ".") ?></td>
          <td><?= htmlspecialchars((string)$aluno["situacao"]) ?></td>
          <td>
            <a href="editar.php?id=<?= htmlspecialchars((string)$aluno["id"]) ?>">Editar</a>

            <form action="excluir.php" method="POST" style="display:inline" onsubmit="return confirm('Deseja excluir este aluno?');">
                <input type="hidden" name="id" value="<?= htmlspecialchars((string)$aluno["id"]) ?>">
                <button type="submit">Excluir</button>
            </form>
        </td>
        </tr>
      <?php endforeach; ?>
    </table>

    <br>
    <a href="index.php">Novo cadastro</a>
  </div>
  
</body>
</html>