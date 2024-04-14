# Laravel API CRUD para Product e Status

Este projeto Laravel implementa uma API CRUD (Criar, Ler, Atualizar, Deletar) para gerenciar produtos e seus status associados

## Instalação

### Pré-requisitos

Antes de começar, você precisa ter instalado em sua máquina os seguintes requisitos:

- PHP (versão específica para sua versão do Laravel)
- Composer (gerenciador de pacotes)
- Servidor de banco de dados MySQL

### Clonagem e Instalação

Para começar, clone este repositório e instale as dependências:

    git clone https://github.com/keziaferretti/crud_api_laravel.git
    composer install

### Configuração do Banco de Dados:

1. Crie um banco de dados MySQL (eu utilizei um banco de dados chamado api-crud-laravel).
2. Renomeie o arquivo .env.example para .env.
3. Configure as credenciais do banco de dados no arquivo .env:

   - Defina DB_CONNECTION como mysql.
   - Defina DB_DATABASE com o nome do seu banco de dados (por exemplo, DB_DATABASE=api-crud-laravel).
   - Configure DB_USERNAME e DB_PASSWORD de acordo com sua conexão com o banco de dados.

## Em seguida, crie as tabelas de banco de dados necessárias para status e produtos:
php artisan migrate

## Execute php artisan serve para iniciar o projeto.
Você verá:
    INFO  Server running on [http://127.0.0.1:8000].
    Press Ctrl+C to stop the server.
    
Copie a URL (por exemplo, http://127.0.0.1:8000/api/) e utilize-a no Postman para testar os endpoints da API para status ou produtos.


## Documentação do Postman
Consulte a documentação do Postman para obter instruções detalhadas sobre como testar e interagir com a API: https://documenter.getpostman.com/view/25859010/2sA3Bj7tAm

