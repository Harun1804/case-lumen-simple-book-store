<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    private $model;

    public function __construct()
    {
        $this->model = new Book();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $book = $this->model->find($id);
        if ($book) {
            $book->update($data);
        }
    }

    public function destroy($id)
    {
        $book = $this->model->find($id);
        if ($book) {
            $book->delete();
        }
    }
}
