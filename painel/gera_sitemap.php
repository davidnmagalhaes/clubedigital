<?php 
include('config.php');

$sql = "SELECT * FROM rfa_clubes WHERE urldominio!=''";
$listaclubes = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listaclubes = mysqli_fetch_assoc($listaclubes);
$totalRows_listaclubes = mysqli_num_rows($listaclubes);

foreach($listaclubes as $lis){
$idclube = $lis['id_clube'];
$urldominio = $lis['urldominio'];
//$pasta = mkdir('sitemap'.$idclube.'/', 0777, true);

// Data e hora atual
$datetime = new DateTime(date('Y-m-d H:i:s'));
// A linha abaixo me retornará uma data no seguinte formato: 2017-11-22T00:06:23-02:00
$date = $datetime->format(DateTime::ATOM); // ISO8601

// Gera o arquivo XML do sitemap
$xml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>'.$urldominio.'</loc>
        <lastmod>'.$date.'</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
    </url>';
    $sqlblog = "SELECT * FROM rfa_site_blog WHERE clube='$idclube' AND slug_blog!=''";
    $blog = mysqli_query($link, $sqlblog) or die(mysqli_error($link));
    $row_blog = mysqli_fetch_assoc($blog);

    foreach($blog as $b){
        $datetimes = new DateTime($b['data_blog']);
        $dates = $datetimes->format(DateTime::ATOM);
        $xml .='
        <url>
            <loc>'.$urldominio.'/'.$b['slug_blog'].'</loc>
            <lastmod>'.$dates.'</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.85</priority>
        </url>';
    }
$xml .= '
</urlset>';

// Abre o arquivo ou tenta cria-lo se ele não exixtir
$arquivo = fopen('sitemap'.$idclube.'.xml', 'w');
if (fwrite($arquivo, $xml)) {
    echo "Arquivo sitemap.xml criado com sucesso para ".$urldominio;
} else {
    echo "Não foi possível criar o arquivo. Verifique as permissões do diretório.";
}
fclose($arquivo);
/*
// Envia para o Google o novo sitemap gerado
$urlSitemap = "http://www.google.com/webmasters/sitemaps/ping?sitemap=https://".$urldominio."/";
// Arquivos a serem enviados
$Files = ['sitemap'.$idclube.'.xml'];

// Envia os dois arquivos sitemap gerados para a URL do Google
foreach ($Files as $file) {
    $url = $urlSitemap . $file;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
}
*/
}//Finaliza foreach

?>