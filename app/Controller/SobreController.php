<?php

class SobreController {
    public function index() {

        $loader = new \Twig\Loader\FilesystemLoader('app/View/'); //cria o caminho até a pasta dos arquivos
        $twig = new \Twig\Environment($loader); //inicializa o twig
        $template = $twig->load('sobre.html'); //pega a pagina html

        $params = array();
        
        $content = $template->render($params); //renderiza os dados carregados

        echo $content;
    }
}