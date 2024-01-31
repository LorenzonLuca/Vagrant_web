<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-2">
    <a class="navbar-brand" href="#">Libreria</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <?php if ($_SESSION['is_admin']): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL . 'management' ?>">Crea libro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL . 'usercreation' ?>">Crea Utente</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="d-flex ms-auto">
        <span class="navbar-text">
            Benvenuto, <?php echo $_SESSION['username']; ?>
        </span>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link px-1" href="<?php echo URL . 'login/logout' ?>">Logout</a>
            </li>
        </ul>
    </div>
</nav>