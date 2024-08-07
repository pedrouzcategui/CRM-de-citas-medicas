<?php

namespace MVC;

class Controller
{
    protected function render($view_filename, $data = [], $template_name = "")
    {
        $view_exists = $this->does_view_exist($view_filename);
        if (!$view_exists) {
            $this->NotFound();
        }
        $view_file_path = VIEWS_DIR . "$view_filename.php";
        $file = file_get_contents($view_file_path);
        extract(array_merge($data, ['content' => $file]));
        // Render file or smth IDK

        include ROOT_DIR . "/includes/header.php";
        if (!empty($template_name)) {
            include_once TEMPLATES_DIR . $template_name . '.php';
        } else {
            include_once $view_file_path;
        }
        include ROOT_DIR . "/includes/footer.php";
    }
    private function does_view_exist($file)
    {
        $view_file_path = VIEWS_DIR . "$file.php";
        return file_exists($view_file_path);
    }
    public static function NotFound()
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
        include(VIEWS_DIR . "notFound.php");
        die();
    }
}
