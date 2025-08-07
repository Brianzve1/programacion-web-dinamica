require_once('SalaChatServer.php');

$server = new SalaChatServer("localhost", 9000);
$server->run();
