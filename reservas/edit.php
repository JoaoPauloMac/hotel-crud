<?php
session_start();
require '../conexao.php';

// Busca de dados para popular os DROPDOWNS:
$hospedes_query = mysqli_query($conexao, "SELECT id_hospede, nome FROM hospede ORDER BY nome");
// Mantemos a busca de todos os quartos para que o quarto atual (mesmo que ocupado) apareça
$quartos_query = mysqli_query($conexao, "SELECT id_quarto, disponibilidade FROM quarto ORDER BY id_quarto");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reserva - Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include('../navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Editar Reserva
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $reserva_id = mysqli_real_escape_string($conexao, $_GET['id']);
                            
                            // 1. Consulta para buscar os dados da reserva atual
                            $sql = "SELECT * FROM Reserva WHERE id_reserva='$reserva_id'";
                            $query = mysqli_query($conexao, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $reserva = mysqli_fetch_assoc($query);
                        ?>
                                <form action="../acoes-reserva.php" method="POST">
                                    <input type="hidden" name="id_reserva" value="<?php echo $reserva['id_reserva']; ?>">
                                    <input type="hidden" name="update_reserva" value="1"> <div class="mb-3">
                                        <label>Hóspede</label>
                                        <select name="id_hospede" class="form-control" required>
                                            <option value="" disabled>-- Selecione o Hóspede --</option>
                                            <?php 
                                            // Reinicia o ponteiro da query de hóspedes
                                            mysqli_data_seek($hospedes_query, 0); 
                                            while($hospede = mysqli_fetch_assoc($hospedes_query)): 
                                                // Marca a opção que já está salva no banco
                                                $selected = ($hospede['id_hospede'] == $reserva['id_hospede']) ? 'selected' : '';
                                            ?>
                                                <option value="<?= $hospede['id_hospede'] ?>" <?= $selected ?>>
                                                    <?= $hospede['nome'] ?> (ID: <?= $hospede['id_hospede'] ?>)
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Quarto</label>
                                        <select name="id_quarto" class="form-control" required>
                                            <option value="" disabled>-- Selecione o Quarto --</option>
                                            <?php 
                                            // Reinicia o ponteiro da query de quartos
                                            mysqli_data_seek($quartos_query, 0); 
                                            while($quarto = mysqli_fetch_assoc($quartos_query)): 
                                                $selected = ($quarto['id_quarto'] == $reserva['id_quarto']) ? 'selected' : '';
                                            ?>
                                                <option value="<?= $quarto['id_quarto'] ?>" <?= $selected ?>>
                                                    Quarto ID: <?= $quarto['id_quarto'] ?> (Disponibilidade: <?= $quarto['disponibilidade'] ?>)
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Data de Check-in</label>
                                        <input type="date" name="data_in" value="<?php echo $reserva['data_in']; ?>" class="form-control" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Data de Check-out</label>
                                        <input type="date" name="data_out" value="<?php echo $reserva['data_out']; ?>" class="form-control" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Valor Total (R$)</label>
                                        <input type="number" step="0.01" name="valor_total" value="<?php echo number_format($reserva['valor_total'], 2, '.', ''); ?>" class="form-control" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Status de Pagamento</label>
                                        <select name="status_pg" class="form-control" required>
                                            <option value="Pago" <?= ($reserva['status_pg'] == 'Pago') ? 'selected' : ''; ?>>Pago</option>
                                            <option value="Pendente" <?= ($reserva['status_pg'] == 'Pendente') ? 'selected' : ''; ?>>Pendente</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Status da Reserva</label>
                                        <select name="status" class="form-control" required>
                                            <option value="Confirmada" <?= ($reserva['status'] == 'Confirmada') ? 'selected' : ''; ?>>Confirmada</option>
                                            <option value="Pendente" <?= ($reserva['status'] == 'Pendente') ? 'selected' : ''; ?>>Pendente</option>
                                            <option value="Cancelada" <?= ($reserva['status'] == 'Cancelada') ? 'selected' : ''; ?>>Cancelada</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Atualizar Reserva</button>
                                    </div>
                                </form>
                        <?php
                            } else {
                                echo "<h5>Reserva não encontrada</h5>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>