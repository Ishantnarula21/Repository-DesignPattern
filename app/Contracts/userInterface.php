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
    public function destroy($id);
}
