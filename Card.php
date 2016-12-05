<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/GetCardList/');
$result = curl_exec($curl);
curl_close($curl);
?>

<?php
if ($_POST["Delete"] != "") {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/DeleteCard/');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    $data = array('CardId' => $_POST["Delete"]);
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
if ($_POST["OldCardnr"] != ""){
    echo ' has posted...';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/EditCard/');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    $data = array('OldCardnr' => $_POST["OldCardnr"], 'NewCardnr' => $_POST['NewCardnr']);
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
if ($_POST["CardAdd"] != ""){
    echo ' has posted...';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://localhost:2727/WcfService.svc/AddCard/');
    curl_setopt($curl, CURLOPT_POST, true);
    $data = array('CardId' => $_POST["CardAdd"]);
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

$jsonCard = json_decode($result);

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('Card.html.twig');
echo $template->render(array('title' => 'CardList', 'text' => $jsonCard));