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
