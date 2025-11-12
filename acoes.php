<?php
session_start();
require 'conexao.php';

// ===================================
// 1. LÓGICA DE CRIAÇÃO (CREATE)
// ===================================
if (isset($_POST['create_hospede'])) {
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $documento = mysqli_real_escape_string($conexao, trim($_POST['documento']));
    $endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
    $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));

    $sql = "INSERT INTO hospede (nome, documento, endereco, data_nascimento) 
            VALUES ('$nome', '$documento', '$endereco', '$data_nascimento')";

    $query_executada = mysqli_query($conexao, $sql);

    if ($query_executada) {
        if (mysqli_affected_rows($conexao) > 0) {
            $_SESSION['mensagem'] = 'Hóspede criado com sucesso!';
        } else {
            $_SESSION['mensagem'] = 'Erro: A query foi executada, mas nenhuma linha foi afetada.';
        }
    } else {
        // Captura o erro do MySQL para depuração
        $_SESSION['mensagem'] = 'Hóspede não foi criado! Erro SQL: ' . mysqli_error($conexao);
    }

    header('Location: hospedes/index.php');
    exit;
}

// ===================================
// 2. LÓGICA DE ATUALIZAÇÃO (UPDATE)
// ===================================
if (isset($_POST['update_hospede'])) {
    $hospede_id = mysqli_real_escape_string($conexao, $_POST['hospede_id']);

    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $documento = mysqli_real_escape_string($conexao, trim($_POST['documento']));
    $endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
    $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));

    $sql = "UPDATE hospede SET 
                nome = '$nome', 
                documento = '$documento', 
                endereco = '$endereco', 
                data_nascimento = '$data_nascimento' 
            WHERE id_hospede = '$hospede_id'";

    $query_executada = mysqli_query($conexao, $sql);

    if ($query_executada) {
        if (mysqli_affected_rows($conexao) > 0) {
            $_SESSION['mensagem'] = 'Hóspede atualizado com sucesso!';
        } else {
            $_SESSION['mensagem'] = 'Dados não alterados (os dados enviados eram os mesmos).';
        }
    } else {
        $_SESSION['mensagem'] = 'Hóspede não foi atualizado! Erro SQL: ' . mysqli_error($conexao);
    }

    header('Location: hospedes/index.php');
    exit;
}

// ===================================
// 3. LÓGICA DE EXCLUSÃO (DELETE) - Adicionar aqui quando for implementar
// ===================================
if (isset($_POST['delete_hospede'])) {
    $hospede_id = mysqli_real_escape_string($conexao, $_POST['delete_hospede']);

    $sql = "DELETE FROM hospede WHERE id_hospede = '$hospede_id'";

    $query_executada = mysqli_query($conexao, $sql);
    if ($query_executada) {
        if (mysqli_affected_rows($conexao) > 0) {
            $_SESSION['mensagem'] = 'Hóspede deletado com sucesso!';
            header('Location: hospedes/index.php');
            exit;
        } else {
            // Adicionando um caso para 0 linhas afetadas, caso o ID não exista
            $_SESSION['mensagem'] = 'Hóspede não encontrado para deletar.';
            header('Location: hospedes/index.php');
            exit;
        }
    } else {
        $_SESSION['mensagem'] = 'Hóspede não foi deletado! Erro SQL: ' . mysqli_error($conexao);
        header('Location: hospedes/index.php');
        exit;
    }
}



// Opcional: Se nada foi postado, redirecionar
// header('Location: index.php');
// exit;
