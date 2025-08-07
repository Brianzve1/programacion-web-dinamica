<?php
require_once('websockets.php');

class SalaChatServer extends WebSocketServer {

  protected function process($user, $message) {
    $data = json_decode($message, true);

    if ($data['type'] === 'alias') {
      $user->alias = $data['alias'];
    }

    if ($data['type'] === 'mensaje') {
      $alias = isset($user->alias) ? $user->alias : "Anónimo";
      $texto = $data['texto'];
      $mensajeFormateado = "[" . $alias . "]: " . $texto;

      foreach ($this->users as $u) {
        $this->send($u, $mensajeFormateado);
      }
    }
  }

  protected function connected($user) {
    $this->send($user, "[Conectado al servidor]");
  }

  protected function closed($user) {
    // Puedes agregar lógica si querés notificar desconexiones
  }
}
