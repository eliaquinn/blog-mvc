<?php

class AdminController {
    public function index() {
        $loader = new \Twig\Loader\FilesystemLoader('app/View/'); //cria o caminho até a pasta dos arquivos
        $twig = new \Twig\Environment($loader); //inicializa o twig
        $template = $twig->load('admin.html'); //pega a pagina html
        
        try {
            $objPost = Postage::selectAll();
        
            $params = array();
            $params['allposts'] = $objPost;

            $content = $template->render($params); //renderiza os dados carregados

            echo $content;

        } catch (Exception $e) {
            $content = $template->render();

            echo $content;
            echo $e->getMessage();

        }
    }

    public function create () {
        $loader = new \Twig\Loader\FilesystemLoader('app/View/'); //cria o caminho até a pasta dos arquivos
        $twig = new \Twig\Environment($loader); //inicializa o twig
        $template = $twig->load('create.html'); //pega a pagina html

        $params = array();
        
        $content = $template->render($params); //renderiza os dados carregados

        echo $content;
    }

    public function insert () {
        try {
            Postage::insert($_POST);
            echo "<script>alert('Post publicado com sucesso!')</script>";
            echo "<script>location.href='?page=home'</script>";
        } catch (Exception $e) {
            echo "<script>alert('".$e->getMessage()."')</script>";
            echo "<script>location.href='?page=admin&method=create'</script>";
        }
    }

    public function change ($pId) {
        $loader = new \Twig\Loader\FilesystemLoader('app/View/');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');

        $post = Postage::selectForId($pId);

        $params = array();
        $params['id'] = $post->id;
        $params['titulo'] = $post->titulo;
        $params['conteudo'] = $post->conteudo;
        
        $content = $template->render($params);

        echo $content;
    }

    public function update () {
        try {
            Postage::update($_POST);

            echo "<script>alert('Post alterado com sucesso!')</script>";
            echo "<script>location.href='?page=home'</script>";
        } catch (Exception $e) {
            echo "<script>alert('".$e->getMessage()."')</script>";
            echo "<script>location.href='?page=admin&method=change&id=".$_POST['id']."'</script>";
        }
    }

    public function delete ($paramId) {
        try {
            Postage::delete($paramId);
            echo "<script>alert('Post deletado com sucesso!')</script>";
            echo "<script>location.href='?page=admin'</script>";
        } catch (Exception $e) {
            echo "<script>alert('".$e->getMessage()."')</script>";
            echo "<script>location.href='?page=admin&method=index'</script>";
        }
    }
}