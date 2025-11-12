<?php
session_start();
require '../conexao.php';

// Teste rápido para ver se a conexão foi estabelecida
if (isset($conexao) && $conexao) {
  echo "<div class='alert alert-success' role='alert'>Conexão com o banco de dados OK!</div>";
  // O código de listagem de hóspedes virá aqui
} else {
  echo "<div class='alert alert-danger' role='alert'>Falha na Conexão com o Banco de Dados. Verifique o 'conexao.php'.</div>";
}
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
  <div class="container mt-4">
    <?php include('../mensagem.php'); ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Lista de Hóspedes
              <a href="hospede-create.php" class="btn btn-primary float-end">Adicionar hóspede</a>
            </h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Documento</th>
                  <th>Endereco</th>
                  <th>Data de nascimento</th>
                  <th>Acoes</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = 'SELECT * FROM hospede';
                $hospede = mysqli_query($conexao, $sql);
                if (mysqli_num_rows($hospede) > 0) {
                  foreach ($hospede as $hospede) {
                ?>
                    <tr>
                      <td><?= $hospede['id_hospede'] ?></td>
                      <td><?= $hospede['nome'] ?></td>
                      <td><?= $hospede['documento'] ?></td>
                      <td><?= $hospede['endereco'] ?></td>
                      <td><?= date('d/m/Y', strtotime($hospede['data_nascimento'])) ?></td>
                      <td>
                        <a href="hospede-view.php?id=<?php echo $hospede['id_hospede']; ?>" class="btn btn-secondary btn-sm"><span class="bi-eye-fill"></span>&nbsp;Visualizar</a>
                        <a href="hospede-edit.php?id=<?php echo $hospede['id_hospede']; ?>" class="btn btn-success btn-sm"><span class="bi-pencil-fill"></span>&nbsp;Editar</a>
                        <form action="../acoes.php" method="POST" class="d-inline">
                          <button
                            onclick="return confirm('Tem certeza de que deseja excluir?')"
                            type="submit"
                            name="delete_hospede"
                            value="<?php echo $hospede['id_hospede']; ?>"
                            class="btn btn-danger btn-sm">
                            <span class="bi-trash3-fill"></span>&nbsp;
                            Excluir
                          </button>
                        </form>
                      </td>
                    </tr>
                <?php
                  }
                } else {
                  echo  '<h5>Nenhum usuario encontrado</h5>';
                }
                ?>
              </tbody>
            </table>
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