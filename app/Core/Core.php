<?php

class Core {
    public function start ($urlGet) {
        if(isset($_GET['method'])) {
            $action = $urlGet['method'];
        } else {
            $action = 'index'; //esse vai ser o metodo padrão vindo do HomeController
        }

        if(isset($urlGet['page'])) { //verifica se existe a querystring page, caso existir vai fazer isso
            // $page está chamando e configurando um controller, o metodo ucfirst coloca a primeira letra sempre maiuscula.
            $controller = ucfirst($urlGet['page']."Controller");
        } else { //caso não existe ele por padrão vai chamar a HomeController
            $controller = 'HomeController';
        }

        if(!class_exists($controller)) { //verifica se a classe não existe
            $controller = 'ErrorController';
        }

        if(isset($urlGet['id']) && $urlGet['id'] != null) {
            $id = $urlGet['id'];
        } else {
            $id = null;
        }

        //abaixo ele cria um objeto controler da classe HomeController, 1 paramento é o nome da classe que vai ser o controller
        //o segundo parametro é o metodo da classe
        call_user_func_array(array(new $controller, $action), array('id'=>$id)); //o array vazio no final é pra não dar erro, nesse caso vc pode usar o id da postagem entre outros
        // call_user_func_array(array(new $controller, $action), 
        //     array('id'=>$urlGet['id'] ?? null
        // ));
    }
}