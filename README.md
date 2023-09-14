<center>
<center>

<h1>Requisito de Usuario</h1>

Requisitos:

        #1 PHP v8+
        #2 MYSQL v5+
        #3 Composer v2+
        #4 Linux/Windows

</center>
<center>

<h3> HTTP - Códigos </h3>

        Respostas de informação (100-199),
        Respostas de sucesso (200-299),
        Redirecionamentos (300-399)
        Erros do cliente (400-499)
        Erros do servidor (500-599).

<h1>Setup do Projeto</h1>

> Após clonar o repositório Laravel, você precisa realizar algumas etapas para iniciar o projeto. Siga os seguintes passos:

1 - No terminal ou prompt de comando, navegue até o diretório do projeto Laravel que você acabou de clonar. Por exemplo:
    
        cd nome-do-repositorio

2 - Em seguida, execute o comando 'composer install'. Isso irá instalar todas as dependências do projeto listadas no arquivo composer.json.

3 - Crie um arquivo .env na raiz do projeto. Você pode copiar o arquivo .env.example que já existe e renomeá-lo para .env.
    
        copy .env.example .env

4 - Gere a chave do aplicativo executando o comando php artisan key:generate. Isso irá gerar uma nova chave para o seu aplicativo Laravel.
    
        php artisan key:generate

5 - Configure as informações do banco de dados no arquivo .env. Certifique-se de fornecer os detalhes corretos para o seu ambiente.

> Neste arquivo iremos configurar os dados do banco de dados
> exemplo:

        DB_CONNECTION=mysql
        DB_HOST=mysql
        DB_PORT=3306
        DB_DATABASE= NOM_DO_BANCO 
        DB_USERNAME=Usuario
        DB_PASSWORD=password #Obs. esse é um exmplo e senha forte deve ser usadas em anbiente de produção
    
6 - Execute as migrações do banco de dados executando o comando php artisan migrate. Isso irá criar as tabelas necessárias no banco de dados.

        php artisan migrate
    
7 - Inicie o servidor de desenvolvimento do Laravel executando o comando php artisan serve. Isso iniciará o servidor em http://localhost:8000 por padrão.

8 - Agora você pode acessar o projeto Laravel em seu navegador, em http://localhost:8000. A partir daqui, você pode começar a trabalhar no projeto e fazer              alterações como desejar.
