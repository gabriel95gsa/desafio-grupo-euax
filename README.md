# desafio-grupo-euax

Neste desafio foram utizadas as seguintes ferramentas:
* Docker
* Laravel
* MySQL
* Bootstrap

Instruções:
- Para rodar o ambiente do desafio com o docker, basta acessar a raiz do projeto e executar o 
comando "docker-compose build && docker-compose up -d".

- Foi configurado o serviço mysql para rodar juntamente com o php no container docker, para criar as tabelas
do desafio basta rodar as migrations do Laravel. No caso se estiver rodando ambiente com Docker, basta acessar
a raiz do projeto e executar o comando "docker-compose exec php /var/www/html/artisan migrate".

- Caso não queira executar o projeto com Docker, os fontes estão todos dentro da pasta "src", portanto, basta
upar o ambiente com apache/nginx ou com o servidor nativo do Laravel considerando apenas o conteudo desta
pasta.

- O projeto foi desenvolvido nos moldes do MVC aproveitando os recursos que o Laravel dispõe, para o front foi
utilizada a ferramenta blade também disponibilizada pelo framework e bootstrap.

- Arquivo de confifurações de conexão com o banco de dados está na pasta "src" chamado .env, caso o ambiente
não seja rodado com docker, será necessário alterar os dados de conexão de acordo com o servidor mysql
utilizado.

Organização do sistema:
- A tela principal é um modelo de dashboard admin, contendo na barra lateral o menu com as opções consulas 
e cadastros de projetos e atividades.

- Há 4 telas aleḿ da tela principal, que são respectivas ao cadastro/edição e listagem dos registros.

- Foi desenvolvido o CRUD completo de projetos e atividades.