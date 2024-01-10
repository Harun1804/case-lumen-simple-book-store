<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function store($request)
    {
        $this->model->username = $request['username'];
        $this->model->email = $request['email'];
        $this->model->password = Hash::make($request['password']);
        $this->model->role = $request['role'];
        $this->model->save();
    }

    public function update($request, $id)
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->username = $request['username'];
            $user->email = $request['email'];
            if ($request['password']) {
                $user->password = Hash::make($request['password']);
            }
            $user->role = $request['role'];
            $user->save();
        }
    }

    public function delete($id)
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->delete();
        }
    }
}
