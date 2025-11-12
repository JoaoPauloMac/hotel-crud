<?php
require '../conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Usuario - Visualizar</title>
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
                        <h4>Visualizar hospede
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            // 1. Captura o ID da URL. Continua sendo 'id' pois é o que está no seu link (hospede-view.php?id=...).
                            $hospede_id = mysqli_real_escape_string($conexao, $_GET['id']);

                            // 2. CORREÇÃO CRÍTICA: Altera 'id' para 'id_hospede' na cláusula WHERE.
                            $sql = "SELECT * FROM hospede WHERE id_hospede='$hospede_id'";

                            $query = mysqli_query($conexao, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                $hospede = mysqli_fetch_assoc($query);
                        ?>
                                <div class="mb-3">
                                    <label>Nome</label>
                                    <p class="form-control">
                                        <?php echo $hospede['nome']; ?>

                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label>Documento</label>
                                        <p class="form-control">
                                            <?php echo $hospede['documento']; ?>
                                        </p>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label>Endereco</label>
                                            <p class="form-control">
                                                <?php echo $hospede['endereco']; ?>
                                            </p>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label>Data de nascimento</label>
                                                <p class="form-control">
                                                    <?php echo date('d/m/Y', strtotime($hospede['data_nascimento'])); ?>
                                                </p>
                                            </div>

                                    <?php
                                } else {
                                    echo "<h5>Usuario nao encontrado</h5>";
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