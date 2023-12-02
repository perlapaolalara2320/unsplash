<div class="content reset">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="content-sm">
        <?php
        if (!empty($alertas)) :

        ?>
            <div class="alerta <?php echo array_key_first($alertas); ?>">
                <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

            </div>
        <?php
        endif;
        ?>

        <form class="form" method="POST">
            <div class="row">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="password">
            </div>
            <input type="submit" class="btn" value="Save Password">
        </form>
    </div>

</div>