# Laravel Starter Project

## Ready To Use:
- **Spatie** / Laravel Permission
- **Dynamic Route Files**
- **Image Upload Helper** 
- **Dynamic Global Method**

## How To Use:
1. Clone The Project
2. Add your new project git remote url by following command on terminal in the root of this project:

Open terminal by run as admin
~~~
.\newGit.bat "YOUR_GIT_REPOSITORY_URL"
~~~
---OR---

Delete .git folder in root project
~~~
git init
git add .
git commit -m "first commit"
git branch -M main
git remote add origin "YOUR_GIT_REPOSITORY_URL"
~~~

3. Open terminal in the root of this project and do following command:
~~~
install.sh
~~~
---OR ---
~~~
composer install
copy .env.example .env //or just copy the .env.example as .env
php artisan key:generate
~~~
4. Configure the .env file
5. do `php artisan migrate --seed`
6. yes now you can start build **AMAZING** project
##
Created at : 23/7/2021 by ❤ Aboy ❤

