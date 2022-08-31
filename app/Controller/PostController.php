<?php

class PostController {
    public function index($params_id) {
        try {
            // echo 'Está é a Home, será exibida no Conteudo da pagina';
            $post_for_id = Postage::selectForId($params_id);

            // var_dump($post_for_id);

            $loader = new \Twig\Loader\FilesystemLoader('app/View/'); //cria o caminho até a pasta dos arquivos
            $twig = new \Twig\Environment($loader); //inicializa o twig
            $template = $twig->load('single.html'); //pega a pagina html

            $params = array();
            $params['id'] = $post_for_id->id;
            $params['titulo'] = $post_for_id->titulo;
            $params['conteudo'] = $post_for_id->conteudo;
            $params['coments'] = $post_for_id->comentarios;

            $content = $template->render($params); //renderiza os dados carregados

            echo $content;
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }

    public function addComent () {
        try {
            Coments::insertComent($_POST);
            header("Location: ?page=post&id=".$_POST['id']);
        } catch (Exception $e) {
            echo "<script>alert('".$e->getMessage()."')</script>";
            echo "<script>location.href='?page=post&id=".$_POST['id']."'</script>";
        }
    }
}