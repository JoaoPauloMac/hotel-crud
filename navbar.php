<?php
// Define a URL base do seu projeto.
// Se o projeto está em http://localhost:8091/hotel/, a variável é /hotel/
$BASE_URL = "/hotel/"; 
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        
        <a class="navbar-brand" href="<?= $BASE_URL ?>index.html">
            Sistema de Gestão Hotel X
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= $BASE_URL ?>index.html">
                        Página Inicial
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $BASE_URL ?>hospedes/index.php">
                        <span class="bi bi-people-fill"></span> Hóspedes (CRUD)
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= $BASE_URL ?>quartos/index.php">
                        <span class="bi bi-key-fill"></span> Quartos (CRUD)
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= $BASE_URL ?>reservas/index.php">
                        <span class="bi bi-calendar-check-fill"></span> Reservas (CRUD)
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>