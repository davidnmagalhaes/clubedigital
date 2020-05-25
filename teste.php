<?php
//criamos o arquivo
$arquivo = fopen('.htaccess','w');
//verificamos se foi criado
if ($arquivo == false) die('Não foi possível criar o arquivo.');
//escrevemos no arquivo
$texto = "
RewriteEngine on
RewriteRule ^website/?$ painel/site/index.php?clube=1 [NC,L]
RewriteRule ^website2/?$ painel/site/index.php [NC,L]
";
fwrite($arquivo, $texto);
//Fechamos o arquivo após escrever nele
fclose($arquivo);
?>