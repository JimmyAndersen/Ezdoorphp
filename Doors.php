<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/GetDoorList/');
$result = curl_exec($curl);
curl_close($curl);
?>

<?php
if ($_POST["Oldnr"] != ""){
    echo ' has posted...';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/EditDoor/');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    $data = array('OldDoornr' => $_POST["Oldnr"], 'NewDoornr' => $_POST['Newnr']);
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
if ($_POST["Delete"] != "") {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/DeleteDoor/');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    $data = array('DoorId' => $_POST["Delete"]);
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
if ($_POST["DoorAdd"] != ""){
    echo ' has posted...';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/AddDoor/');
    curl_setopt($curl, CURLOPT_POST, true);
    $data = array('DoorId' => $_POST["DoorAdd"]);
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
require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$jsonDoor = json_decode($result);

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('Door.html.twig');
echo $template->render(array('title' => 'CardList', 'text' => $jsonDoor));