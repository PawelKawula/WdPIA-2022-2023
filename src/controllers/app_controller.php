<?php

class AppController {

    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function is_get(): bool
    {
        return $this->request === 'GET';
    }

    protected function is_post(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $template_path = 'public/views/'. $template.'.php';
        $output = 'File not found';

        if(file_exists($template_path)){
            extract($variables);

            ob_start();
            include $template_path;
            $output = ob_get_clean();
        }
        print $output;
    }

    protected function redirect_to(string $path) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/{$path}");
    }
}
