[![Build Status](https://travis-ci.org/brasil-php/project-manager.svg?branch=master)](https://travis-ci.org/brasil-php/project-manager)

```
Under development, DO NOT USE IN PRODUCTION
```

# PlanDesk

This project is intended to provide a tool for planning and managing IT demands. Following the best practices proposed by ITIL, PlanDesk delivers a catalog of demands, which can be created manually or imported from market tools such as Github, Gitlab and Bitbucket, which can be managed in several dimensions.

The idea of PlanDesk is to create a planning board for a project that can have multiple repositories. For this you can count on tools like:

- creation of tickets by users. The purpose of this feature is to provide the helpdesk experience for users who have some role with the tool (s) managed by PlanDesk;

- kanbam framework for task control. With the kanbam panel you can easily see what is separate to be made, in progress, ready for delivery or any other state that is valid in internal processes and manage sprints or milestones;

- issue synchronization. With this feature you can link to your project multiple repositories, which in practical terms means that you manage the construction and maintenance of various tools as if they were one;

- view resources in calendar format. With this features you can see who is doing what on what day in calendar format;

- control of advanced access levels. With the advanced access control tool it is possible to clearly determine what each user can do within the system, allowing profiles to be created that can edit, delete or just report demands;

- prediction of deadlines. Using the tag tools you can make the tool know the average deadlines of each demand and make suggestions for deadlines for new activities. If you mark your tasks with the `Create Registration` tag and it takes 4 hours to complete one and 2 hours to complete the other, the system will offer the next 3 hours as a cost.

## How to install

1. Download or clone this repository.
2. Copy the .env.example file to .env (`cp .env.example .env`)
3. Install the `composer install`
4. Generate an application key (`php artisan key: generate`)
5. Configure the database in .env file
6. Run migrations and seeders (`php artisan migrate && php artisan db: seed`)
7. Start the server (`php artisan serve`) and

## How to contribute

1. Make a fork of this repository
2. Prepare asberto in your repository (generated in step 1)
3. Send a traction request

You can check what needs to be done, bugs found or report bugs using problems:

[Click here to go to issues](https://github.com/brasil-php/project-manager/issues)

