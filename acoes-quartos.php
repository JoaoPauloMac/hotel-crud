<?php
session_start();
require 'conexao.php'; // A conexão está OK

//========================================================================================
// 1. BLOCO DE CRIAÇÃO (CREATE)
//========================================================================================
if (isset($_POST['create_quarto'])) {
    // Captura dos dados
    $disponibilidade = mysqli_real_escape_string($conexao, trim($_POST['disponibilidade']));


    // Query SQL
    $sql = "INSERT INTO quarto (disponibilidade) 
        VALUES ('$disponibilidade')";

    $query_executada = mysqli_query($conexao, $sql);

    // Feedback
    if ($query_executada) {
        $_SESSION['mensagem'] = 'Quarto criado com sucesso!';
    } else {
        $_SESSION['mensagem'] = 'Erro ao criar quarto: ' . mysqli_error($conexao);
    }

    header('Location: quartos/index.php');
    exit;
}

//========================================================================================
// 2. BLOCO DE EDIÇÃO (UPDATE) - SOLUÇÃO DO PROBLEMA
//========================================================================================
if (isset($_POST['update_quarto'])) {
    // 1. Captura e sanitização dos dados do formulário
    $quarto_id = mysqli_real_escape_string($conexao, $_POST['quarto_id']);
    $disponibilidade = mysqli_real_escape_string($conexao, trim($_POST['disponibilidade']));

    // 2. Query SQL de UPDATE
    $sql = "UPDATE quarto SET 
                disponibilidade = '$disponibilidade'
            WHERE id_quarto = '$quarto_id'";

    // 3. Execução da Query
    $query_executada = mysqli_query($conexao, $sql);

    // 4. Feedback e Redirecionamento
    if ($query_executada) {
        // Verifica se houve alguma alteração (mysqli_affected_rows)
        if (mysqli_affected_rows($conexao) > 0) {
            $_SESSION['mensagem'] = 'Quarto atualizado com sucesso!';
        } else {
            $_SESSION['mensagem'] = 'Nenhuma alteração detectada.';
        }
    } else {
        // Erro fatal de SQL
        $_SESSION['mensagem'] = 'Quarto não foi atualizado! Erro SQL: ' . mysqli_error($conexao);
    }

    header('Location: quartos/index.php');
    exit;
}

//========================================================================================
// 3. BLOCO DE EXCLUSÃO (DELETE) - (Deixe-o para depois, se ainda não estiver pronto)
//========================================================================================
// No acoes-quartos.php
if (isset($_POST['delete_quarto'])) {
    $quarto_id = mysqli_real_escape_string($conexao, $_POST['delete_quarto']);

    // Certifique-se de que o nome da coluna é id_quarto
    $sql = "DELETE FROM quarto WHERE id_quarto = '$quarto_id'";

    $query_executada = mysqli_query($conexao, $sql);

    // DEBUG: Comente o header() e use echo para ver o resultado
    if ($query_executada) {
        if (mysqli_affected_rows($conexao) > 0) {
            echo "SUCESSO: Quarto deletado. ID: " . $quarto_id;
            // header('Location: index.php'); // Comente
        } else {
            echo "AVISO: Quarto não encontrado para deletar.";
        }
    } else {
        echo "ERRO FATAL DE SQL: " . mysqli_error($conexao);
    }

    header('Location: quartos/index.php'); // Comente
    exit; // Comente
}
