<?php
session_start();
require '../conexao.php'; // Acessa a conexão na raiz do projeto
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reserva - Visualizar</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
</head>

<body>
    <?php include('../navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar Reserva
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $reserva_id = mysqli_real_escape_string($conexao, $_GET['id']);

                            // Query com JOIN para buscar o nome do hóspede
                            $sql = "SELECT r.*, h.nome 
                                    FROM Reserva r 
                                    JOIN hospede h ON r.id_hospede = h.id_hospede
                                    WHERE r.id_reserva='$reserva_id'";

                            $query = mysqli_query($conexao, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $reserva = mysqli_fetch_assoc($query);
                        ?>
                                <div class="mb-3">
                                    <label class="fw-bold">Hóspede:</label>
                                    <p class="form-control-plaintext"><?php echo $reserva['nome']; ?> (ID: <?php echo $reserva['id_hospede']; ?>)</p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Quarto ID:</label>
                                    <p class="form-control-plaintext"><?php echo $reserva['id_quarto']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Check-in:</label>
                                    <p class="form-control-plaintext"><?php echo date('d/m/Y', strtotime($reserva['data_in'])); ?></p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Check-out:</label>
                                    <p class="form-control-plaintext"><?php echo date('d/m/Y', strtotime($reserva['data_out'])); ?></p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Valor Total:</label>
                                    <p class="form-control-plaintext">R$ <?php echo number_format($reserva['valor_total'], 2, ',', '.'); ?></p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Status de Pagamento:</label>
                                    <p class="form-control-plaintext"><?php echo $reserva['status_pg']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Status da Reserva:</label>
                                    <p class="form-control-plaintext"><?php echo $reserva['status']; ?></p>
                                </div>

                        <?php
                            } else {
                                echo "<h5>Reserva não encontrada.</h5>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>