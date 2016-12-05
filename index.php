<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/GetLogList/');
$result = curl_exec($curl);
curl_close($curl);
?>


<?php
require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$jsonLog = json_decode($result);

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('index.html.twig');
echo $template->render(array('title' => 'LogList', 'text' => $jsonLog));

