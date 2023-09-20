<?php
// Exemplo de classe representando a entidade "UserToken"
class UserToken {
    public $id;
    public $refresh_token;
    public $expires_date;
    public $created_at;
    public $user_id;
    public $user;  // Representa o relacionamento com a classe User

    // Construtor
    public function __construct() {
        if (empty($this->id)) {
            $this->id = uniqid();  // Gera um ID único
        }
    }
}

// Exemplo de classe representando a entidade "User"
class User {
    // Propriedades da entidade User
}

// Exemplo de uso
$userToken = new UserToken();
$userToken->refresh_token = "refresh_token_value";
$userToken->expires_date = new DateTime("2023-12-31");
// ... Defina outras propriedades ...

// Exemplo de relação com a entidade User
$user = new User();
$userToken->user = $user;

// Saída de informações
var_dump($userToken);
?>
