# Repository Design Pattern Crud Laravel 9

To put it simply, Repository pattern is a kind of container where data access logic is stored. It hides the details of data access logic from business logic. In other words, we allow business logic to access the data object without having knowledge of underlying data access architecture.

# Step 1 

### Create a new laravel app

````
composer create laravel/laravel RepositoryPattern
````

# Step 2 Setup Database in your .env file

````
DB_DATABASE={DATABASE NAME}
DB_USERNAME=root
DB_PASSWORD=
````

# Step 3 Run migrations


````
php artisan migrate
````

# Step 4 Create Interface

### in app directory make a folder of interface

### then make new file of your desired name i am creating userInterface.php


#### paste the following code

````
<?php

namespace App\Contracts;

interface userInterface{

    // display function
    public function all();

    // insert function
    public function store(array $data);

    // find by id
    public function show($id);

    // edit display funtion
    public function edit($id);

    // update function
    public function update(array $data);

    // delete function
    public function destroy($id)
}

````

# Step 5 Create Repository

### in app directory make a folder of Repositories

### then make new file of your desired name i am creating userRepository.php


#### paste the following code

````
<?php

namespace App\Repositories;

use App\Contracts\userInterface;
use App\Models\User;


class userRepository implements userInterface{

    // display function
    public function all(){
        return $users = User::all();
    }

    // insertion function
    public function store(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>$data['password'],
        ]);
    }

    // find by id function
    public function show($id){
        return User::find($id);
    }

    // edit display function
    public function edit($id){
        return User::find($id);
    }

    // update function
    public function update(array $data)
    {
        $update = [
            "name"=>$data['request']['name'],
            "email"=>$data['request']['email'],
            "password"=>$data['request']['password'],
        ];
        return User::where('id',$data['id'])->update($update);
    }

    // delete function
    public function destroy($id)
    {
        return User::destroy($id);
    }
}
````

# Step 6 add interface and repository in service provider to initalize them

#### make a custom service provider


````
php artisan make:provider {provider name}
````

#### replace your register function with this

````
 public function register()
    {
        $this->app->bind(
            'App\Contracts\userInterface',
            'App\Repositories\userRepository',
        );
    }
````

#### register your service provider in config\app.php 

### after application service provider paste service provide path which you created earlier


````
*
* custom Service Providers...
*/
App\Providers\RepositoriesServiceProvider::class,
````


# Step 7 Create Controller

## i am creating resource controller it will have inbuild crud function we have to pass resource flag in command to create it 

````
php artisan make:controller {CONTROLLER NAME} --resource
````

#### paste the following code

````
<?php

namespace App\Repositories;

use App\Contracts\userInterface;
use App\Models\User;


class userRepository implements userInterface{

    // display function
    public function all(){
        return $users = User::all();
    }

    // insertion function
    public function store(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>$data['password'],
        ]);
    }

    // find by id function
    public function show($id){
        return User::find($id);
    }

    // edit display function
    public function edit($id){
        return User::find($id);
    }

    // update function
    public function update(array $data)
    {
        $update = [
            "name"=>$data['request']['name'],
            "email"=>$data['request']['email'],
            "password"=>$data['request']['password'],
        ];
        return User::where('id',$data['id'])->update($update);
    }

    // delete function
    public function destroy($id)
    {
        return User::destroy($id);
    }
}
````


## Have a nice day ahead




