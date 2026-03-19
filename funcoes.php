<?php
declare(strict_types=1);

function caminhoArquivo(): string {
    return __DIR__ . "/../dados/alunos.json";
}

function garantirArquivo(): void {
    $arquivo = caminhoArquivo();
    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}

function lerAlunos(): array {
    garantirArquivo();
    $conteudo = file_get_contents(caminhoArquivo());
    $dados = json_decode($conteudo ?: "[]", true);
    return is_array($dados) ? $dados : [];
}

function salvarAlunos(array $alunos): void {
    file_put_contents(
        caminhoArquivo(),
        json_encode($alunos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}

function criarId(): string {
    return bin2hex(random_bytes(8));
}

function normalizarBusca(string $texto): string {
    return trim(mb_strtolower($texto));
}

function calcularMedia(float $n1, float $n2): float {
    return ($n1 + $n2) / 2;
}

function situacao(float $media): string {
    return $media >= 6.0 ? "Aprovado" : "Reprovado";
}