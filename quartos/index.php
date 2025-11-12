<?php
session_start();
require '../conexao.php'; // Subir um nível para achar conexao.php
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Quartos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
  <?php include('../navbar.php'); ?>
  <div class="container mt-4">
    <?php include('../mensagem.php'); // Mensagem externa 
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Lista de Quartos
              <a href="create.php" class="btn btn-primary float-end">Adicionar Quarto</a>
            </h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Disponibilidade</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = 'SELECT id_quarto, disponibilidade FROM quarto'; // Query simplificada
                $query_run = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($query_run) > 0) {
                  while ($quarto = mysqli_fetch_assoc($query_run)) {
                ?>
                    <tr>
                      <td><?= $quarto['id_quarto'] ?></td>
                      <td><?= $quarto['disponibilidade'] ?></td>
                      <td>
                        <a href="edit.php?id=<?php echo $quarto['id_quarto']; ?>" class="btn btn-success btn-sm"><span class="bi-pencil-fill"></span>&nbsp;Editar</a>
                        <form action="../acoes-quartos.php" method="POST" class="d-inline">
                          <button
                            onclick="return confirm('Tem certeza de que deseja excluir o quarto?')"
                            type="submit"
                            name="delete_quarto"
                            value="<?php echo $quarto['id_quarto']; ?>"
                            class="btn btn-danger btn-sm">
                            <span class="bi-trash3-fill"></span>&nbsp;Excluir
                          </button>
                        </form>
                      </td>
                    </tr>
                <?php
                  }
                } else {
                  echo '<tr><td colspan="3"><h5>Nenhum quarto encontrado</h5></td></tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>