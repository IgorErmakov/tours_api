## Tasks management system

* Create task (info to save: task name, priority, timestamps)
* Edit task
* Delete task
* Reorder tasks with drag and drop in the browser. Priority should automatically be updated based on this. #1 priority goes at top, #2 next down and so on.

Tasks should be saved to a mysql table.

* BONUS POINT: add project functionality to the tasks. User should be able to select a project from a dropdown and only view tasks associated with that project.

You will be graded on how well-written & readable your code is, if it works, and if you did it the Laravel way.

Include any instructions on how to set up & deploy the web application in your Readme.md file in the project directory


## Deployment
```shell
composer install
./vendor/bin/sail up
./vendor/bin/sail migrate
./vendor/bin/sail artisan db:seed
```


