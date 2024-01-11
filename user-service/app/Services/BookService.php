<?php

namespace App\Services;

use App\Traits\HasApiRequest;

class BookService
{
    use HasApiRequest;

    public $baseUri, $secret;

    public function __construct()
    {
        $this->baseUri = config('services.book.base_uri');
        $this->secret = config('services.book.secret');
    }

    public function getBooks()
    {
        return $this->request('GET', '/books');
    }

    public function getBook($book)
    {
        return $this->request('GET', "/books/{$book}");
    }

    public function createBook($data)
    {
        return $this->request('POST', '/books', $data);
    }

    public function updateBook($book, $data)
    {
        return $this->request('PUT', "/books/{$book}", $data);
    }

    public function deleteBook($book)
    {
        return $this->request('DELETE', "/books/{$book}");
    }
}
