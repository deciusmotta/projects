# project-manager

[![Build Status](https://travis-ci.org/IgorDePaula/project-manager.svg?branch=master)](https://travis-ci.org/IgorDePaula/project-manager)

## Em desenvolvimento, NÃO USE EM PRODUÇÃO

## Como instalar

1. Baixe ou clone este repositório.
2. Copie o arquivo .env.example para .env (`cp .env.example .env`)
3. Instale as dependências (`composer install`)
4. Gere a app key (`php artisan key:generate`)
5. Configure o banco de dados no arquivo .env
6. Rode migrations e seeders (`php artisan migrate && php artisan db:seed`)
7. Inicie o servidor (`php artisan serve`) e aproveite

## Como contribuir

1. Faça um fork deste repositório
2. Prepare as alterações no seu repositório (gerado no passo 1)
3. Envie um pull request

Você pode consultar o que precisa ser feito, bugs encontrados ou reportar bugs usando as issues:

[Clique aqui para ir para as issues](https://github.com/brasil-php/project-manager/issues)
