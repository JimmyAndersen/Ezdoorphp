<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/GetAccessList/');
$result = curl_exec($curl);
curl_close($curl);
?>
<?php
if ($_POST["d"] != ""){
    echo ' asgdhaslsakdfklasdflkjasn';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/AddDoorAccess/');
    curl_setopt($curl, CURLOPT_POST, true);
    $data = array('CardId' => $_POST["c"], 'DoorId' => $_POST['d']);
    $jsonData = json_encode($data);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = [
        'Host: localhost:2727',
        'Content-Type: application/json'
    ];
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $postResult = curl_exec($curl);
    curl_close($curl);


}
?>
<?php
if ($_POST["AccessDelete"] != "") {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/DeleteDoorAccess/');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    $data = array('CardId' => $_POST["AccessDelete"]);
    $jsonData = json_encode($data);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = [
        'Host: localhost:2727',
        'Content-Type: application/json'
    ];
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($curl);
    curl_close($curl);
}

?>
<?php
require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$jsonAccess = json_decode($result);

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('Access.html.twig');
echo $template->render(array('title' => 'AccessList', 'text' => $jsonAccess));
?>