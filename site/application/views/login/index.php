<div class="container" style="margin-top: 5%">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8 col-xs-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo URL . 'login/check'; ?>">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Inserisci username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Inserisci password">
                        </div>
                        <div class="d-flex justify-content-between">
                            <span style="color: red"><?php if(isset($error)) echo $error ?></span>
                            <button type="submit" class="btn btn-primary btn-block mt-3">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>