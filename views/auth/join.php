<div class="join">
    <div class="img-join">
        <div class="img-join-content">
            <h2>Creations starts here</h2>
            <p>Access free, high-resolution photos you can't find anywhere else</p>
        </div>
    </div>
    <div class="content-sm">
        <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
        <?php
        if (!empty($alertas)) :
        ?>
            <div class="alerta error">
                <p><?php echo count($alertas['error']) ?> <?php echo (count($alertas['error']) > 1 ?  'errors' : 'error'); ?> prohibited this user from being saved:</p>
                <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
            </div>

        <?php
        endif;
        ?>

        <form action="/join" class="form" method="POST">
            <div class="group">
                <div class="row">
                    <label for="name">First name</label>
                    <input type="text" id="name" placeholder="name" name="name">
                </div>

                <div class="row">
                    <label for="lastname">Last name</label>
                    <input type="text" id="lastname" placeholder="lastname" name="lastname">
                </div>
            </div>

            <div class="row">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="email" name="email">
            </div>

            <div class="row">
                <div class="label-justify">
                    <label for="username">Username</label>
                    <span>
                        (only letters, numbers, and underscores)
                    </span>
                </div>
                <input type="text" id="username" placeholder="username" name="username">
            </div>

            <div class="row">
                <div class="label-justify">
                    <label for="password">Password</label>
                    <span>
                        (min. 8 char)
                    </span>
                </div>
                <input type="password" id="password" placeholder="password" name="password">
            </div>
            <input type="submit" class="boton" value="Join">
        </form>
    </div>
</div>