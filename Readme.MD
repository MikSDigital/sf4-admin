Symfony 4 starter kit with this set up:

* FOSUser Bundle
* guard authenticator
* registartion and login form templates
* very basic [Gentelella](https://github.com/puikinsh/gentelella) admin template set up

1. Clone this repo
2. Set up **sqlite** DB
3. Run migrations
4. Create admin : ```php bin/console fos:user:create```
5. Promote just created admin: ```php bin/console fos:user:promote``` with ***ROLE_ADMIN***

##### ToDo:

* password reminder
* logging user just after registration


Similar repositories:
* https://github.com/vonLeebpl/BasicWithGentelella
* https://github.com/krzysiekpiasecki/Gentelella
* https://github.com/FlorientR/laravel-gentelella
* https://github.com/afourmy/flask-gentelella
* https://github.com/yiister/yii2-gentelella