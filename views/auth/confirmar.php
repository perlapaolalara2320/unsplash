<div class="confirm">
    <img class="img-confirm" src="https://images.unsplash.com/photo-1691796854007-2e7a11656da8?ixlib=rb-4.0.3&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max" alt="image confirm">
    <div class="content-sm">
        <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

        <div class="alerta <?php echo array_keys($alertas)[0] ?>">
            <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        </div>
        <a href="/login">Login</a>
    </div>
</div>