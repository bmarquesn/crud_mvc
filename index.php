<?php require_once('AutoLoadPages.php'); ?>
<!DOCTYPE html>
<html lang='pt-br'>
    <head>
        <?php require_once('view/estrutura/head_pages.php'); ?>
    </head>
    <body>
        <?php
        if(is_array($html_pagina)) {
            if(isset($html_pagina['tipo_view']) && $html_pagina['tipo_view'] == "pagina_interna") {
                include('body_logado.php');
            } else {
                if(file_exists($html_pagina['page_include'])) {
                    include($html_pagina['page_include']);
                }
            }
        } else {
            echo $html_pagina;
        }
        require_once('view/estrutura/footer_scripts_pages.php');
        ?>
    </body>
</html>