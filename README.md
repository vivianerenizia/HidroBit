# Desenvolvimento de um Sistema de Monitoramento de Turbidez

## Trabalho de Conclusão de Curso II desenvolvido para a Universidade Federal de Viçosa Campus Rio Paranaíba.

## **Configuração do projeto HidroBit (Interface)**

Esse projeto monitora a turbidez da água usando um sensor LDR, um Arduino e apresenta os dados através de uma interface web. Aqui está um guia passo a passo para configurar e rodar o projeto:

### **Pré-requisitos**:
1. **Node.js**: Certifique-se de ter o Node.js instalado em sua máquina. Caso não tenha, [baixe-o aqui](https://nodejs.org/).

2. **NPM**: Após instalar o Node.js, instale o gerenciador de pacotes NPM (embora a versão mais recente do Node.js já venha com o NPM incluído por padrão).

3. **XAMPP**: Utilizamos o XAMPP para servir a aplicação que utiliza o banco de dados MySQL e PHP. [Baixe o XAMPP aqui](https://www.apachefriends.org/pt_br/index.html).

### **Instruções de Configuração**:

1. **Instalação de Dependências**:
    - Navegue até a raiz do projeto via terminal.
    - Digite e execute o comando `npm i` para instalar todas as dependências necessárias.

2. **Configuração do Banco de Dados**:
    - Inicie o XAMPP e ative os serviços Apache e MySQL.
    - Acesse o phpMyAdmin através do link: http://localhost/phpmyadmin/
    - Na aba SQL, copie e cole o código contido no arquivo `create_database.sql`, localizado na pasta "Dados" do seu projeto.
    - Execute o código para criar e preencher o banco de dados.

3. **Executando o projeto**:
    - Com o XAMPP em execução e o banco de dados configurado, você pode acessar a interface de monitoramento através do link: http://localhost/hidrobit/index.php

---

Agora você deve estar pronto para visualizar e trabalhar com os dados coletados pelo sensor LDR e enviados pelo seu Arduino.

Alunas:

> Viviane Renizia Mendes Silva

> Stefani Kaline Leonel Dias
