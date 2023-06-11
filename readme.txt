Welcome to Laranuxt Crud App


Cara Menggunakan Aplikasi 


API


1. Download Zip application and extract

2. Open command prompt and direct your folder typing

   composer install

3. typing in command prompt

   php artisan migrate

4. run function seeder in command prompt

    php artisan db:seed --class=PostsSeeder

5. if you run unit testing you can run 
   
   php artisan test --testsuite=Feature --stop-on-failure

6. change .env.example to .env and change this code

7. For running make sure the host running your ipv4 in windows you can run command

    ipconfig

    and running

    php artisan serve --host=192.168.1.6

Nuxt js

1. Download Zip application and extract

2. Open command prompt and direct your folder typing

   npm install

3. you can open nuxt.config.ts and change apibase

public: {
      apiBase: "{your-api-host eg: http://192.168.1.6:8000}",
},

4. you can running command prompt

    npm run dev
5. if available error in fetch API you must be change version node version to 16 with NVM can be download at https://github.com/coreybutler/nvm-windows/releases

    after download and install you can run command prompt

    C:\Users\Acer>nvm -v
    1.1.10

    C:\Users\Acer>nvm install v16.10.0
    Downloading node.js version 16.10.0 (64-bit)...
    Extracting node and npm...
    Complete

    C:\Windows\system32>nvm list
        18.12.1
        16.16.0
        16.10.0
    * 14.17.3 (Currently using 64-bit executable)

    C:\Windows\system32>nvm use 16.16.0
    Now using node v16.16.0 (64-bit)

    C:\Windows\system32>node -v
    v16.16.0

    C:\Users\Acer>nvm list
        18.12.1
    * 16.16.0 (Currently using 64-bit executable)
        16.10.0
        14.17.3



PS 

For documentation API postman you can check file redcomm.postman_collection.json and import your postman.Thank you for attention.have a nice days :)