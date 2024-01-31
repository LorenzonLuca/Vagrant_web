<div class="container mt-5">
    <h2 class="text-center mb-4">Crea utente</h2>
    <form method="post" action="<?php echo URL ?>usercreation/create">
        <div class="form-group mb-4">
            <label for="username">Nome utente:</label>
            <input type="text" class="form-control" id="username" placeholder="Inserire nome utente" name="username">
        </div>
        <div class="form-group mb-4">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Inserire la password" name="password">
        </div>
        <div class="form-group mb-4">
            <label for="password-conf">Conferma password:</label>
            <input type="password" class="form-control" id="password-conf" placeholder="Reinserisci la password" name="password-conf">
        </div>
        <div class="text-center">
            <div class="form-group mb-4">
                <label for="admin-flag">Admin:</label>
                <input type="checkbox" class="form-check-input" id="admin-flag" name="admin-flag">
            </div>
            <br>
            <?php if(isset($error)): ?>
                <p class="text-danger"><?php echo $error?></p>
            <?php endif; ?>
            <?php if(isset($created)): ?>
                <p class="text-success"><?php echo $created?></p>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Crea utente</button>
        </div>
    </form>
</div>

