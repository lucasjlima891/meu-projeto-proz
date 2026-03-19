<?php
require __DIR__ . "/inc/funcoes.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    die("Método não permitido.");
}

$id = trim((string)($_POST["id"] ?? ""));

if ($id === "") {
    die("ID inválido.");
}

$alunos = lerAlunos();

$alunosAtualizados = array_values(array_filter($alunos, function ($aluno) use ($id) {
    return (string)($aluno["id"] ?? "") !== $id;
}));

salvarAlunos($alunosAtualizados);

header("Location: lista.php");
exit;