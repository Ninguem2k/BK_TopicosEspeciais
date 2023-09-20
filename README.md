<center>

<h1>Requisitos do Usuário</h1>

Requisitos:

- PHP v8+
- MySQL v5+
- Composer v2+
- Linux/Windows

</center>
<center>

<h3>HTTP - Códigos</h3>

Respostas de informação (100-199),
Respostas de sucesso (200-299),
Redirecionamentos (300-399)
Erros do cliente (400-499)
Erros do servidor (500-599).

<h1>Configuração do Projeto</h1>

> Para começar com o projeto Laravel, siga estas etapas:

## Clonar o Projeto

1. Abra o terminal ou prompt de comando.
2. Navegue até o diretório onde deseja clonar o repositório do Laravel:

        cd caminho/do/diretorio

Execute o seguinte comando para clonar o repositório:

        git clone URL_DO_REPOSITORIO

## Configurar o Ambiente

1. Navegue até o diretório do projeto Laravel que você acabou de clonar:
        
        cd nome-do-repositorio

2. Execute o comando 'composer install'. Isso instalará todas as dependências do projeto listadas no arquivo composer.json:

        composer install

3. Crie um arquivo .env na raiz do projeto. Você pode copiar o arquivo .env.example que já existe e renomeá-lo para .env:

        copy .env.example .env

4. Configure as informações do banco de dados no arquivo .env. Certifique-se de fornecer os detalhes corretos para o seu ambiente:

        DB_CONNECTION=mysql
        DB_HOST=mysql
        DB_PORT=3306
        DB_DATABASE=NOME_DO_BANCO
        DB_USERNAME=Usuario
        DB_PASSWORD=senha_segura # Observe que uma senha segura deve ser usada em ambiente de produção

## Migrações do Banco de Dados

1. Execute as migrações do banco de dados executando o comando php artisan migrate. Isso criará as tabelas necessárias no banco de dados:

        php artisan migrate

## Iniciar o Servidor de Desenvolvimento
Inicie o servidor de desenvolvimento do Laravel executando o comando php artisan serve. Isso iniciará o servidor em http://localhost:8000 por padrão:

php artisan serve

  Agora você pode acessar o projeto Laravel em seu navegador, em http://localhost:8000. A partir daqui, você pode começar a trabalhar no projeto e fazer alterações como desejar.

## Documentação

## Projeto da API do Marketplace de Serviços

Este projeto tem como objetivo desenvolver uma API para um marketplace de serviços usando o framework Laravel, o banco de dados MySQL e a ferramenta Postman para testes.

### Descrição do Projeto

O objetivo deste projeto é criar uma API robusta e escalável para um marketplace de serviços, permitindo que os usuários se cadastrem, publiquem serviços, solicitem serviços. A API deve ser segura, eficiente e bem documentada.

### Tarefas do Projeto

2. **Design e Modelagem do Banco de Dados**

   - Descrição: Projetar o esquema do banco de dados para armazenar informações de usuários, serviços, pedidos e transações.
   - Responsável: Cássio Gabriel/Gabriel Marques
   - Prazo: [16/09/2023]

3. **Implementação da Autenticação**

   - Descrição: Implementar a autenticação de usuários usando tokens JWT para permitir o acesso seguro à API.
   - Responsável: Cássio Gabriel/Wilson Prates 
   - Prazo: [24/09/2023]

4. **Criação dos Endpoints da API**

   - Descrição: Desenvolver os endpoints da API para cadastro de usuários, publicação de serviços, solicitação de serviços, etc.
   - Responsável: Cássio Gabriel/Wilson Prates 
   - Prazo: [28/09/2023]


6. **Testes e Depuração**

   - Descrição: Realizar testes rigorosos em todos os endpoints da API usando o Postman e depurar quaisquer problemas identificados.
   - Responsável: Cássio Gabriel/Wilson Prates 
   - Prazo: [30/09/2023]

7. **Documentação da API**

   - Descrição: Criar documentação detalhada da API, incluindo informações sobre endpoints, parâmetros, respostas e exemplos de uso.
   - Responsável: Cássio Gabriel/Wilson Prates 
   - Prazo: [30/09/2023]

8. **Implantação em Ambiente de Produção**

   - Descrição: Implantação da API em um ambiente de produção, garantindo alta disponibilidade e segurança.
   - Responsável: Cássio Gabriel/Wilson Prates 
   - Prazo: [02/09/2023]
 
### Recursos

- Laravel
- MySQL
- Postman

### Entregáveis

- Código fonte do projeto no repositório Git
- Documentação da API
- Ambiente de produção da API em execução

### Cronograma

| Tarefa                               | Início       | Término      |
| ------------------------------------ | ------------ | ------------ |
| Design e Modelagem do Banco de Dados | [16/09/2023] | [16/09/2023] |
| Implementação da Autenticação        | [20/09/2023] | [24/09/2023] |
| Criação dos Endpoints da API         | [24/09/2023] | [28/09/2023] |
| Testes e Depuração                   | [28/09/2023] | [30/09/2023] |
| Documentação da API                  | [28/09/2023] | [30/09/2023] |
| Implantação em Ambiente de Produção  | [30/09/2023] | [02/09/2023] |


</center>
