<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookService;
    public function __construct()
    {
        $this->bookService = new BookService();
    }

    public function getAll()
    {
        return $this->serviceSuccessResponse($this->bookService->getBooks(), 'Books retrieved successfully');
    }

    public function getById($id)
    {
        try {
            $user = $this->bookService->getBook($id);
            if ($user){
                return $this->serviceSuccessResponse($user, 'Book retrieved successfully');
            }
        } catch (\Exception $e) {
            return $this->serviceErrorResponse($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->bookService->createBook($request->all());
            return $this->serviceSuccessResponse([], 'User created successfully', 201);
        } catch (\Exception $e) {
            return $this->serviceErrorResponse($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $this->bookService->getBook($id);
            if ($user) {
                $this->bookService->updateBook($id, $request->all());
                return $this->serviceSuccessResponse([], 'Book updated successfully');
            }
        } catch (\Exception $e) {
            return $this->serviceErrorResponse($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->bookService->getBook($id);
            if ($user) {
                $this->bookService->deleteBook($id);
                return $this->serviceSuccessResponse([], 'Book deleted successfully');
            }
        } catch (\Exception $e) {
            return $this->serviceErrorResponse($e->getMessage(), 500);
        }
    }
}
