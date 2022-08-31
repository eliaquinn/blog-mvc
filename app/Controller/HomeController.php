<?php

class HomeController {
    public function index() {
        try {
            // echo 'Está é a Home, será exibida no Conteudo da pagina';
            $collection = Postage::selectAll();

            $loader = new \Twig\Loader\FilesystemLoader('app/View/'); //cria o caminho até a pasta dos arquivos
            $twig = new \Twig\Environment($loader); //inicializa o twig
            $template = $twig->load('home.html'); //pega a pagina html

            $params = array();
            $params['postagens'] = $collection;

            $content = $template->render($params); //renderiza os dados carregados

            echo $content;
            
            // var_dump($collection);
        } catch (Exception $error) {
            echo $error->getMessage();
        }

    }
}