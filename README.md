# Todo List

## Installation
The project is using the powerful and elegant Laravel `sail` package. For fresh setup, you can pull the repo to your
local environment and then run `docker-compose up -d`. The process will take some time to finish especially if you're running
it for the first time. After the installation, you should see `todo-list-gql-test` container with 3 images for sail, redis and mysql.

After, you need to SSH to the image to run the migration `php artinsan migrate` and the DB seeder `php artisan db:seed` to create your first
user and 10 new random tasks to kickstart your testing.
