<?php
require_once 'app/Core/Core.php';
require_once 'lib/Database/Connection.php';

require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/ErrorController.php';
require_once 'app/Controller/PostController.php';
require_once 'app/Controller/SobreController.php';
require_once 'app/Controller/AdminController.php';

require_once 'app/Model/Postage.php';
require_once 'app/Model/Coments.php';

require_once 'vendor/autoload.php';

$template = file_get_contents('app/template/structure.html');

ob_start(); //essa função inicia o ob_start
// esse trecho do codigo onde usamos o ob, serve pra pegar toda a saida de conteudo no navegador
    $core = new Core;
    $core->start($_GET);

    $content = ob_get_contents(); //essa função pega os dados da pagina requisitada e joga na variavel $content
ob_end_clean(); //essa funçao finaliza o ob_

$content_viewer = str_replace('{{dinamic_area}}', $content, $template);

echo $content_viewer;