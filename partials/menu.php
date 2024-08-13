<?php

require_once MIDDLEWARE_FILE;

if (!is_user_logged_in()) {
    destroy_session_and_redirect_to_login();
}

?>
<style>
    nav {
        width: 100%;
        padding: 20px 0px;
        box-shadow: 1pt 5pt 20pt 1pt #efefef;
        background-color: white;

    }

    ul {
        width: 85%;
        margin: 0px auto;
        display: flex;
        justify-content: space-between;
        list-style-type: none;
        gap: 10px;

        li {
            a {
                color: blue;
                text-decoration: none;
                transition: color .3s ease-in-out;
            }

            a:hover {
                color: darkblue;
                text-decoration: underline;
            }
        }
    }

    .auth {
        background-color: darkred;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        transition: filter .1s ease-in-out;
        text-decoration: none;
    }

    .auth:hover {
        text-decoration: none;
        color: white;
        cursor: pointer;
        filter: brightness(.5);
    }
</style>

<nav>
    <ul>
        <div>
            <a>
                CRM MEDICO
            </a>
        </div>
        <div style="display: flex; gap: 10px">
            <?php if (is_user_allowed('nurse')) : ?>
                <li>
                    <a href="/crmmedico/pacientes/index.php">Pacientes</a>
                </li>
            <?php endif; ?>
            <?php if (is_user_allowed('admin')) : ?>
                <li>
                    <a href="/crmmedico/medicos/index.php">Medicos</a>
                </li>
            <?php endif; ?>
            <?php if (is_user_allowed('nurse')) : ?>
                <li>
                    <a href="/crmmedico/citas/index.php">Citas</a>
                </li>
            <?php endif; ?>
            <?php if (is_user_allowed('doctor')) : ?>
                <li>
                    <a href="/crmmedico/diagnosticos/index.php">Diagnosticos</a>
                </li>
            <?php endif; ?>
            <?php if (is_user_allowed('admin')) : ?>
                <li>
                    <a href="/crmmedico/users/index.php">Usuarios</a>
                </li>
            <?php endif; ?>
            <li>
                <a href="/crmmedico/auth/logout.php" class="auth">Log out</a>
            </li>
        </div>

    </ul>
</nav>