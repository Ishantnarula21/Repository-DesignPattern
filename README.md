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
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Contracts\userInterface;
use App\Repositories\userRepository;

class studentcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $user;

    function __construct(userInterface $interface){
        $this->user = $interface;
    }

    public function index()
    {
        $users = $this->user->all();
        return view('user.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->user->store($request->all());
        $msg = "New User Created successful! ";
        return redirect('user')->with('msg', $msg);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=$this->user->show($id);
        return view('user.show', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=$this->user->edit($id);
        return view('user.edit', compact('user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=[
            "request"=>$request->all(),
            "id"=>$id
        ];
        $this->user->update($data);
        $msg = "User Updated successful! ";
        return redirect('user')->with('msg', $msg);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->destroy($id);
        $msg = "User Deleted successful! ";
        return redirect('user')->with('msg', $msg);
    }
}

````


## Have a nice day ahead




