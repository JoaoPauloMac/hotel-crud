<?php
session_start();
require '../conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hospedes</title>
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
                            Editar Quarto
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $quarto_id = mysqli_real_escape_string($conexao, $_GET['id']);
                            $sql = "SELECT id_quarto, disponibilidade FROM quarto WHERE id_quarto='$quarto_id'";
                            $query = mysqli_query($conexao, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $quarto = mysqli_fetch_assoc($query);
                        ?>
                                <form action="../acoes-quartos.php" method="POST">
                                    <input type="hidden" name="quarto_id" value="<?php echo $quarto['id_quarto']; ?>">

                                    <div class="mb-3">
                                        <label>Disponibilidade</label>
                                        <input type="text" name="disponibilidade" value="<?php echo $quarto['disponibilidade']; ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" name="update_quarto" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                        <?php
                            } else {
                                echo "<h5>Quarto não encontrado</h5>";
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