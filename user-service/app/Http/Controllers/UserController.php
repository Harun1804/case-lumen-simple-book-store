<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function getAll()
    {
        return $this->successResponse($this->userService->getAll(), 'Users retrieved successfully');
    }

    public function getById($id)
    {
        $user = $this->userService->getById($id);
        if ($user){
            return $this->successResponse($user, 'User retrieved successfully');
        }
        return $this->successResponse([], 'User not found', 404);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username'  => 'required|unique:users,username',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:3|confirmed',
            'role'      => 'required|in:admin,member'
        ]);

        try {
            $this->userService->store($request->all());

            return $this->successResponse([], 'User created successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $this->userService->getById($id);
            if ($user) {
                $this->validate($request, [
                    'username'  => 'required|unique:users,username,' . $id,
                    'email'     => 'required|email|unique:users,email,' . $id,
                    'password'  => 'nullable|min:3|confirmed',
                    'role'      => 'required|in:admin,member'
                ]);

                $this->userService->update($request->all(), $id);
                return $this->successResponse([], 'User updated successfully');
            }
            return $this->successResponse([], 'User not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->userService->getById($id);
            if ($user) {
                $this->userService->delete($id);
                return $this->successResponse([], 'User deleted successfully');
            }
            return $this->successResponse([], 'User not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
