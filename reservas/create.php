<?php
session_start();
require '../conexao.php'; // Acessa a conexão na raiz do projeto

// 1. BUSCA DE DADOS PARA DROPDOWNS
// Busca todos os hóspedes ativos
$hospedes_query = mysqli_query($conexao, "SELECT id_hospede, nome FROM hospede ORDER BY nome");

// Busca apenas quartos que estejam marcados como 'Disponível'
$quartos_query = mysqli_query($conexao, "SELECT id_quarto FROM quarto WHERE disponibilidade = 'Disponível' ORDER BY id_quarto");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reserva - Criar</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
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
                            Criar Nova Reserva
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <form action="../acoes-reserva.php" method="POST">

                            <div class="mb-3">
                                <label>Hóspede</label>
                                <select name="id_hospede" class="form-control" required>
                                    <option value="" disabled selected>-- Selecione o Hóspede --</option>
                                    <?php while ($hospede = mysqli_fetch_assoc($hospedes_query)): ?>
                                        <option value="<?= $hospede['id_hospede'] ?>">
                                            <?= $hospede['nome'] ?> (ID: <?= $hospede['id_hospede'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Quarto Disponível</label>
                                <select name="id_quarto" class="form-control" required>
                                    <option value="" disabled selected>-- Selecione o Quarto --</option>
                                    <?php while ($quarto = mysqli_fetch_assoc($quartos_query)): ?>
                                        <option value="<?= $quarto['id_quarto'] ?>">
                                            Quarto ID: <?= $quarto['id_quarto'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Data de Check-in</label>
                                <input type="date" name="data_in" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Data de Check-out</label>
                                <input type="date" name="data_out" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Valor Total (R$)</label>
                                <input type="number" step="0.01" name="valor_total" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Status de Pagamento</label>
                                <select name="status_pg" class="form-control" required>
                                    <option value="Pago">Pago</option>
                                    <option value="Pendente">Pendente</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Status da Reserva</label>
                                <select name="status" class="form-control" required>
                                    <option value="Confirmada">Confirmada</option>
                                    <option value="Pendente">Pendente</option>
                                    <option value="Cancelada">Cancelada</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="create_reserva" class="btn btn-primary">Reservar</button>
                            </div>

                        </form>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>