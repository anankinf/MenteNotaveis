<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Iniciando a Aplicação

Crie o banco de dados com nome: mnteste 

Acesse o diretório Laravel, renomeie o arquivo .env.example para ".env".

Edite o arquivo .env e atualize as informações de conexão com banco de dados:

-  DB_CONNECTION=mysql
-  DB_HOST=127.0.0.1 (Endereço do banco de dados)
-  DB_PORT=3306 (porta do banco de dados)
-  DB_DATABASE=mnteste (Nome do banco de dados, Não alterar)
-  DB_USERNAME=root (Usuário de acesso)
-  DB_PASSWORD= (Senha de acesso)

Através dos prompt de comando acesse o diretório da aplicação e execute os comandos:

- "php artisan migrate" para criar as tabelas no banco de dados.
- "php artisan serve" para executar a aplicação.

Abra o browser e na barra de endereço acesse a aplicação através do endereço:

- http://localhost:8000 | e você será redirecionado para a rota "/modules"
- http://localhost:8000/modules | Esse endereço deverá abrir a lista de módulos através da tela é possivel visualisar e editar cadastros, ou iniciar um novo cadastro de módulos.
-  Ao cadastrar um novo módulo você é direcionado a tela de edição, onde poderá alterar os dados do módulo e suas atividades.
- as atividades podem ser cadastradas a partir do seu módulo, assim como editadas e deletadas.

A exclusão de um módulo acarreta na exclusão de todas atividades vinculadas ao mesmo.

Qualquer delete do sistema deve ser confirmado pelo usuário, no caso optei por usar um modal simple de alerta deixando o formulario de exclusão no botão de confirmação.
