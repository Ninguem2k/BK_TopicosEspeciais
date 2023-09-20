<?php
// Interface para representar a estrutura do email
interface IEmail {
    public $email;
    public $password;
}

// Configuração de email
$emailConfig = new class implements IEmail {
    public $email;
    public $password;

    public function __construct() {
        $this->email = getenv('EMAIL') ?: '';
        $this->password = getenv('PASSWORD') ?: '';
    }
};

// Exemplo de uso
var_dump($emailConfig);
?>
