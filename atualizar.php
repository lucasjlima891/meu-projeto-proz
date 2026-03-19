<?php
require __DIR__ . "/inc/funcoes.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    die("Método não permitido.");
}

$id    = trim((string)($_POST["id"] ?? ""));
$nome  = trim((string)($_POST["nome"] ?? ""));
$nota1 = (float)($_POST["nota1"] ?? 0);
$nota2 = (float)($_POST["nota2"] ?? 0);

if ($id === "") {
    die("ID inválido.");
}

if ($nome === "" || mb_strlen($nome) < 3) {
    die("Nome inválido.");
}

if ($nota1 < 0 || $nota1 > 10 || $nota2 < 0 || $nota2 > 10) {
    die("Notas devem estar entre 0 e 10.");
}

$media = calcularMedia($nota1, $nota2);
$situacaoAtual = situacao($media);

$alunos = lerAlunos();

$atualizado = false;
foreach ($alunos as $i => $aluno) {
    if ((string)($aluno["id"] ?? "") === $id) {
        $alunos[$i]["nome"] = $nome;
        $alunos[$i]["nota1"] = $nota1;
        $alunos[$i]["nota2"] = $nota2;
        $alunos[$i]["media"] = $media;
        $alunos[$i]["situacao"] = $situacaoAtual;
        $atualizado = true;
        break;
    }
}

if (!$atualizado) {
    die("Aluno não encontrado para atualizar.");
}

salvarAlunos($alunos);

header("Location: lista.php");
exit;