<?php
// api.php
require 'conexao.php'; // Usa a conexão existente

// 1. Dizer ao navegador que estamos enviando JSON
header('Content-Type: application/json');

// Desativa o reporte de erros para não poluir o JSON (opcional, mas profissional)
error_reporting(0);

// Verifica a rota via parâmetro 'tabela' na URL
if (isset($_GET['tabela'])) {
    $tabela = strtolower($_GET['tabela']);
    
    // Lista de tabelas permitidas para evitar SQL Injection
    $tabelas_permitidas = ['hospede', 'quarto', 'reserva'];

    if (in_array($tabela, $tabelas_permitidas)) {
        
        // 2. Executa a consulta
        $sql = "SELECT * FROM " . $tabela;
        $resultado = mysqli_query($conexao, $sql);
        
        $dados = [];
        
        // 3. Monta o array associativo
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($linha = mysqli_fetch_assoc($resultado)) {
                $dados[] = $linha;
            }
            
            // 4. Retorna os dados em JSON
            echo json_encode(['status' => 'sucesso', 'dados' => $dados]);
        } else {
            // Retorna array vazio se não houver dados
            echo json_encode(['status' => 'sucesso', 'dados' => []]);
        }
        
    } else {
        // Tabela não permitida ou inválida
        echo json_encode(['status' => 'erro', 'mensagem' => 'Tabela nao encontrada.']);
    }
} else {
    // Nenhuma rota especificada
    echo json_encode(['status' => 'erro', 'mensagem' => 'Especifique a tabela (Ex: ?tabela=hospede)']);
}
?>