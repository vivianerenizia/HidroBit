# tcc-turbidez

Para rodar o projeto é necessario ter o `Node` instalado 
- Depois instale o gerenciador de pactes `NPM` no computador

entre na raiz do projeto e digite `npm i` no terminal

O código arduino recebe os valores medidos pelo sensor LDR e envia para o banco de dados.

- Utilizo o Xampp para subir a aplicação do banco de dados mysql e o php.
- O SQL para criação do banco e inserção dos dados está na pasta de Dados (create_database.sql), pode ser importado na interface do myphpadmin.

Após subir as aplicações de forma local:
- Front da monitoração: http://localhost/hidrobit/index.php
- Banco de dados: http://localhost/phpmyadmin/
  - Vá na aba SQL, cole o código de create_database.sql e execute. O banco será preenchido com os dados já existentes.
