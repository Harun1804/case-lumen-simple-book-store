<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;

class BookController extends Controller
{
    private $bookService;
    public function __construct()
    {
        $this->bookService = new BookService();
    }

    public function index()
    {
        return $this->successResponse($this->bookService->getAll());
    }

    public function show($id)
    {
        try {
            $book = $this->bookService->getById($id);
            if($book) {
                return $this->successResponse($book);
            }

            return $this->errorResponse('Book not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'required|string',
            'publisher' => 'required|string'
        ]);

        try {
            $this->bookService->store($request->all());
            return $this->successResponse([], 'Book created successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $book = $this->bookService->getById($id);
            if($book) {
                $this->validate($request, [
                    'title' => 'required|string',
                    'author' => 'required|string',
                    'description' => 'required|string',
                    'publisher' => 'required|string'
                ]);

                $this->bookService->update($id, $request->all());
                return $this->successResponse([], 'Book updated successfully', 201);
            }
            return $this->errorResponse('Book not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $book = $this->bookService->getById($id);
            if($book) {
                $this->bookService->destroy($id);
                return $this->successResponse([], 'Book deleted successfully', 200);
            }
            return $this->errorResponse('Book not found', 404);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
