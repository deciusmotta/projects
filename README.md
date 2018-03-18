[![Build Status](https://travis-ci.org/brasil-php/project-manager.svg?branch=master)](https://travis-ci.org/brasil-php/project-manager)

```
Em desenvolvimento, NÃO USE EM PRODUÇÃO
```

# PlanDesk

Este projeto tem o intuito de prover uma ferramenta de planejamento e gestão de demandas de TI. Seguindo as boas práticas propostas pelo ITIL, o PlanDesk entrega um catálogo de demandas que podem ser criadas manualmente ou importadas de ferramentas de mercado como Github, Gitlab e Bitbucket, que pode ser gerenciado em várias dimensões.

A ideia do PlanDesk é criar um quadro de planejamento para um projeto que pode ter vários repositórios. Para isso você pode contar com ferramentas como:

- criação de tickets pelos usuários. A finalidade desse recurso é proporcionar a experiência de help-desk para os usuários que tem algum papel junto à(s) ferramenta(s) gerenciada(s) pelo PlanDesk;

- quadro kanbam para controle das tarefas. Com o painel kanbam é possível ver facilmente o que está separado para ser feito, em andamento, pronto para entrega ou qualquer outro estado que seja válido nos processos internos e gerenciar sprints ou milestones;

- sincronização de issues. Com este recurso você pode vincular ao seu projeto vários repositórios, o que em termos práticos quer dizer que você gerenciar a construção e manutenção de várias ferramentas como se fossem uma;

- visualização de recursos em formato de calendário. Com este recurso é possível ver quem está fazendo o que, em que dia no formato de calendário;

- controle de níveis de acesso avançado. Com a ferramenta de controle de acesso avançado é possível determinar claramente o que cada usuário pode fazer dentro do sistema, permitindo que sejam criados perfis que podem editar, excluir ou apenas reportar demandas;

- predição de prazos. Utilizando as ferramentas de tags é possível fazer com que a ferramenta conheça os prazos médios de cada demanda e faça sugestões de prazos para as novas atividades. Se você marcar duas tarefas com a tag `Criar Cadastro` e demorar 4 horas para completar uma e 2 horas para completar a outra o sistema irá oferecer como custo 3 horas a próxima tarefa.

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
