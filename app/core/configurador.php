<?php
// APP
    define("APP_NOME", "Admin");
    define("APP_ID", md5(APP_NOME));
    define("PREFIXO_BANCO", 'db_admin_');
    define("PASTA_PROJETO", "admin");
    define("PASTA_PUBLIC",     asset('public'));
    define("FAVICON", PASTA_PUBLIC.'/template/img/icone.ico');
    define("LIMPAR_CACHE", false);    
    date_default_timezone_set('America/Sao_Paulo');

