<style>
    .main_dashboard_layout {
        height: 100vh;
        display: grid;
        grid-template-columns: 1fr 6fr;

        >aside,
        main {
            padding: 10px;
        }

        aside {
            background-color: var(--primary-color);
        }
    }
</style>

<div class="main_dashboard_layout">
    <aside>
        Logo de la app aki
        <ul>
            <li>
                <a href="#">Pacientes</a>
            </li>
            <li>
                <a href="#">Médicos</a>
            </li>
            <li>
                <a href="#">Citas</a>
            </li>
        </ul>
    </aside>
    <main>
        <?php echo $content ?>
    </main>
</div>

<?php include ROOT_DIR . "/includes/footer.php" ?>