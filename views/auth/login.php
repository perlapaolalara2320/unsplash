<div class="login">
    <?php
    if (!empty($alertas)) :
    ?>
        <div class="alerta error">
            <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        </div>
    <?php
    endif;
    ?>
    <div class="content">

        <div class="content-sm">
            <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

            <form action="/login" class="form" method="POST">
                <div class="row">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="email" name="email">
                </div>

                <div class="row">
                    <div class="label-justify">
                        <label for="password">Password</label>
                        <span>
                            <a href="/forgot">Forgot your password?</a>
                        </span>
                    </div>
                    <input type="password" id="password" placeholder="password" name="password">
                </div>
                <input type="submit" class="boton" value="Login">
            </form>
            <div class="actions">
                Don´t have an account? <a href="/join">Join Unsplash</a>
                <svg class="login__alt-cta__img login__alt-cta__img01" width="182" height="86" xmlns="http://www.w3.org/2000/svg">
                    <path d="M43.268 1.471c-11.206.54-22.788 3.669-31.596 10.734C-1.078 22.435-2.35 39.097 9.405 51.12c11.884 12.154 32.194 17.12 48.204 12.741 4.955-1.355 19.666-8.944 13.358-16.521-6.018-7.229-21.23-5.946-28.683-3.458-6.158 2.056-11.646 6.205-12.796 12.96-2.248 13.209 7.936 25.114 17.727 32.555 16.072 12.213 35.92 19.617 55.411 23.973 19.712 4.406 42.14 6.367 61.06-1.73 6.398-2.737 11.807-7.276 16.11-12.636.399-.497 1.542-2.033 1.164-1.52"></path>
                </svg>
                <svg class="login__alt-cta__img login__alt-cta__img02" width="53" height="51" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path d="M13.81 47.388c-2.05-.767-4.005-1.768-5.967-2.716a64.79 64.79 0 0 0-4.025-1.792c-.063-.025-1.036-.312-.998-.456.081-.313.512-.654.71-.877 1.072-1.197 2.106-2.416 3.004-3.744 1.273-1.882 2.492-4.036 2.763-6.3"></path>
                    </g>
                </svg>
            </div>
        </div>
    </div>
</div>