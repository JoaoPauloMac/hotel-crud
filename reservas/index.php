<?php
session_start();
require '../conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>reservas</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include('../navbar.php'); ?>
    <div class="container mt-4">
        <?php include('../mensagem.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Lista de Reservas
                            <a href="create.php" class="btn btn-primary float-end">Nova Reserva</a>
                        </h4>
                    </div>


                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hóspede</th>
                                    <th>Quarto ID</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Valor Total</th>
                                    <th>Pgto.</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Ajuste na query: selecionando os dados da Reserva (r) e nome do Hóspede (h)
                                $sql = 'SELECT r.*, h.nome FROM Reserva r JOIN hospede h ON r.id_hospede = h.id_hospede ORDER BY r.data_in DESC';
                                $query_run = mysqli_query($conexao, $sql);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($reserva = mysqli_fetch_assoc($query_run)) {
                                ?>
                                        <tr>
                                            <td><?= $reserva['id_reserva'] ?></td>
                                            <td><?= $reserva['nome'] ?></td>
                                            <td><?= $reserva['id_quarto'] ?></td>
                                            <td><?= date('d/m/Y', strtotime($reserva['data_in'])) ?></td>
                                            <td><?= date('d/m/Y', strtotime($reserva['data_out'])) ?></td>
                                            <td>R$ <?= number_format($reserva['valor_total'], 2, ',', '.') ?></td>
                                            <td><?= $reserva['status_pg'] ?></td>
                                            <td><?= $reserva['status'] ?></td>
                                            <td>
                                                <a href="view.php?id=<?php echo $reserva['id_reserva']; ?>" class="btn btn-secondary btn-sm">
                                                    Visualizar
                                                </a>
                                                <a href="edit.php?id=<?php echo $reserva['id_reserva']; ?>" class="btn btn-success btn-sm">Editar</a>
                                                <form action="../acoes-reserva.php" method="POST" class="d-inline">
                                                    <button
                                                        onclick="return confirm('Tem certeza que deseja cancelar/excluir?')"
                                                        type="submit"
                                                        name="delete_reserva"
                                                        value="<?php echo $reserva['id_reserva']; ?>"
                                                        class="btn btn-danger btn-sm">
                                                        <span class="bi-trash3-fill"></span>&nbsp;Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="9"><h5>Nenhuma reserva encontrada</h5></td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>