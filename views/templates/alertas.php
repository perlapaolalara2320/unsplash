<?php

foreach ($alertas as $key => $alerta) :
    foreach ($alerta as $mensaje) :
?>
        <ul>
            <li><?php echo $mensaje; ?></li>
        </ul>

<?php
    endforeach;
endforeach;
?>