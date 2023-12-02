<div class="content forgot">
    <div class="content-sm">
        <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
        <?php
        if (!empty($alertas)) :

        ?>
            <div class="alerta <?php echo array_key_first($alertas); ?>">
                <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

            </div>
        <?php
        endif;
        ?>

        <?php if ($mostrar) { ?>
            <form action="/forgot" class="form" method="POST">
                <div class="row">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="email">
                </div>
                <input type="submit" class="boton" value="Send password reset instructions">
            </form>
        <?php }; ?>
    </div>
</div>