<?php
session_start();
require '../conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hospede - Editar</title>
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
                        <h4>
                            Editar hóspede
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $hospede_id = mysqli_real_escape_string($conexao, $_GET['id']);
                            $sql = "SELECT * FROM hospede WHERE id_hospede='$hospede_id'";
                            $query = mysqli_query($conexao, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $hospede = mysqli_fetch_assoc($query);

                        ?>
                                <form action="../acoes.php" method="POST">
                                    <input type="hidden" name="hospede_id" value="<?php echo $hospede['id_hospede']; ?>">
                                    <div class="mb-3">
                                        <label>Nome</label>
                                        <input type="text" name="nome" value="<?php echo $hospede['nome']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Documento</label>
                                        <input type="text" name="documento" value="<?php echo $hospede['documento']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Endereco</label>
                                        <input type="text" name="endereco" value="<?php echo $hospede['endereco']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Data de nascimento</label>
                                        <input type="date" name="data_nascimento" value="<?php echo $hospede['data_nascimento']; ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" name="update_hospede" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                        <?php
                            } else {
                                echo "<h5>Hospede nao encontrado</h5>";
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