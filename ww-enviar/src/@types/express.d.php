<?php
// Definindo uma classe para representar a estrutura de dados do usuário
class User {
    public $id;

    public function __construct($id) {
        $this->id = $id;
    }
}

// Representando a estrutura da requisição no PHP
class Request {
    public $user;

    public function __construct($userId) {
        $this->user = new User($userId);
    }
}

// Exemplo de uso
$request = new Request('123456');
echo $request->user->id;  // Saída: 123456
?>
