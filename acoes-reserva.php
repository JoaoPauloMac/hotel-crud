<?php
session_start();
require 'conexao.php';

// ===================================
// 1. LÓGICA DE CRIAÇÃO (CREATE)
// ===================================
if (isset($_POST['create_reserva'])) {
    
    // Captura e sanitiza as Chaves Estrangeiras e os dados
    $id_hospede = mysqli_real_escape_string($conexao, $_POST['id_hospede']);
    $id_quarto = mysqli_real_escape_string($conexao, $_POST['id_quarto']);
    $data_in = mysqli_real_escape_string($conexao, $_POST['data_in']);
    $data_out = mysqli_real_escape_string($conexao, $_POST['data_out']);
    $valor_total = mysqli_real_escape_string($conexao, $_POST['valor_total']);
    $status_pg = mysqli_real_escape_string($conexao, $_POST['status_pg']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);

    // ALTERAÇÃO APLICADA: 'status' delimitado por backticks
    $sql = "INSERT INTO Reserva (id_hospede, id_quarto, data_in, data_out, valor_total, status_pg, `status`) 
            VALUES ('$id_hospede', '$id_quarto', '$data_in', '$data_out', '$valor_total', '$status_pg', '$status')";

    $query_executada = mysqli_query($conexao, $sql);

    if ($query_executada && mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Reserva criada com sucesso!';
    } else {
        $_SESSION['mensagem'] = 'Reserva não foi criada! Erro SQL: ' . mysqli_error($conexao);
    }

    header('Location: reservas/index.php');
    exit;
}

// ===================================
// 2. LÓGICA DE ATUALIZAÇÃO (UPDATE)
// ===================================
if (isset($_POST['update_reserva'])) {
    $id_reserva = mysqli_real_escape_string($conexao, $_POST['id_reserva']);
    
    // Captura e sanitiza os dados
    $id_hospede = mysqli_real_escape_string($conexao, $_POST['id_hospede']);
    $id_quarto = mysqli_real_escape_string($conexao, $_POST['id_quarto']);
    $data_in = mysqli_real_escape_string($conexao, $_POST['data_in']);
    $data_out = mysqli_real_escape_string($conexao, $_POST['data_out']);
    $valor_total = mysqli_real_escape_string($conexao, $_POST['valor_total']);
    $status_pg = mysqli_real_escape_string($conexao, $_POST['status_pg']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);

    // ALTERAÇÃO APLICADA: 'status' delimitado por backticks
    $sql = "UPDATE Reserva SET 
                id_hospede = '$id_hospede', 
                id_quarto = '$id_quarto', 
                data_in = '$data_in', 
                data_out = '$data_out', 
                valor_total = '$valor_total', 
                status_pg = '$status_pg', 
                `status` = '$status'
                -- ^^^ CORREÇÃO APLICADA AQUI
            WHERE id_reserva = '$id_reserva'";

    $query_executada = mysqli_query($conexao, $sql);

    if ($query_executada) {
        if (mysqli_affected_rows($conexao) > 0) {
            $_SESSION['mensagem'] = 'Reserva atualizada com sucesso!';
        } else {
            $_SESSION['mensagem'] = 'Dados não alterados (não houve mudança).';
        }
    } else {
        $_SESSION['mensagem'] = 'Reserva não foi atualizada! Erro SQL: ' . mysqli_error($conexao);
    }

    header('Location: reservas/index.php');
    exit;
}

// ===================================
// 3. LÓGICA DE EXCLUSÃO (DELETE)
// ===================================
if (isset($_POST['delete_reserva'])) {
    $id_reserva = mysqli_real_escape_string($conexao, $_POST['delete_reserva']);

    // 1. PRIMEIRO, BUSCAMOS O ID DO QUARTO ASSOCIADO
    $sql_fetch_quarto = "SELECT id_quarto FROM Reserva WHERE id_reserva = '$id_reserva'";
    $quarto_result = mysqli_query($conexao, $sql_fetch_quarto);
    $quarto_data = mysqli_fetch_assoc($quarto_result);
    $id_quarto = $quarto_data['id_quarto']; // Captura o ID do quarto

    // 2. EXECUTAMOS O DELETE DA RESERVA
    $sql_delete = "DELETE FROM Reserva WHERE id_reserva = '$id_reserva'";
    $query_delete = mysqli_query($conexao, $sql_delete);
    
    // 3. VERIFICAMOS O RESULTADO DO DELETE
    if ($query_delete && mysqli_affected_rows($conexao) > 0) {
        
        // 4. SE O DELETE FOI BEM-SUCEDIDO, LIBERAMOS O QUARTO
        $sql_liberar_quarto = "UPDATE quarto SET disponibilidade = 'Disponível' WHERE id_quarto = '$id_quarto'";
        mysqli_query($conexao, $sql_liberar_quarto); // Não verificamos o resultado deste UPDATE, apenas o executamos
        
        $_SESSION['mensagem'] = 'Reserva deletada e Quarto Liberado com sucesso!';
        
    } else {
        $_SESSION['mensagem'] = 'Reserva não encontrada ou não foi deletada! Erro SQL: ' . mysqli_error($conexao);
    }
    
    header('Location: reservas/index.php');
    exit;
}