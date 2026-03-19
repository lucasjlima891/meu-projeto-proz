<?php
require __DIR__ . "/inc/funcoes.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    die("Método não permitido.");
}

$nome  = trim((string)($_POST["nome"] ?? ""));
$nota1 = (float)($_POST["nota1"] ?? 0);
$nota2 = (float)($_POST["nota2"] ?? 0);

if ($nome === "" || mb_strlen($nome) < 3) {
    die("Nome inválido.");
}

if ($nota1 < 0 || $nota1 > 10 || $nota2 < 0 || $nota2 > 10) {
    die("Notas devem estar entre 0 e 10.");
}

$media = calcularMedia($nota1, $nota2);

$novoAluno = [
    "id" => criarId(),
    "nome" => $nome,
    "nota1" => $nota1,
    "nota2" => $nota2,
    "media" => $media,
    "situacao" => situacao($media),
];

$alunos = lerAlunos();
$alunos[] = $novoAluno;
salvarAlunos($alunos);

header("Location: lista.php");
exit;