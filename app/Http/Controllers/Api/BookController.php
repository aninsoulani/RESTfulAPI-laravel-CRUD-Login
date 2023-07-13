<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get books
        $books = Book::latest()->paginate(10);

        //return collection of books as a resource
        return new BookResource(true, 'List Data Buku', $books);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'isbn'          => 'required',
            'title'         => 'required',
            'subtitle'      => 'required',
            'author'        => 'required',
            'published'     => 'required',
            'publisher'     => 'required',
            'pages'         => 'required',
            'description'   => 'required',
            'website'       => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create book
        $book = Book::create([
            'isbn'          => $request->isbn,
            'title'         => $request->title,
            'subtitle'      => $request->subtitle,
            'author'        => $request->author,
            'published'     => $request->published,
            'publisher'     => $request->publisher,
            'pages'         => $request->pages,
            'description'   => $request->description,
            'website'       => $request->website,
        ]);

        //return response
        return new BookResource(true, 'Data Buku Berhasil Ditambahkan!', $book);
    }

    /**
     * show
     *
     * @param  mixed $book
     * @return void
     */
    
     public function show(Book $book)
    {
        //return single book as a resource
        return new BookResource(true, 'Data Buku Ditemukan!', $book);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $book
     * @return void
     */
    
     public function update(Request $request, Book $book)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'isbn'          => 'required',
            'title'         => 'required',
            'subtitle'      => 'required',
            'author'        => 'required',
            'published'     => 'required',
            'publisher'     => 'required',
            'pages'         => 'required',
            'description'   => 'required',
            'website'       => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        
        }else {

            //update book without image
            $book->update([
                'isbn'          => $request->isbn,
                'title'         => $request->title,
                'subtitle'      => $request->subtitle,
                'author'        => $request->author,
                'published'     => $request->published,
                'publisher'     => $request->publisher,
                'pages'         => $request->pages,
                'description'   => $request->description,
                'website'       => $request->website,
            ]);
        }

        //return response
        return new BookResource(true, 'Data Buku Berhasil Diubah!', $book);
    }

    /**
     * destroy
     *
     * @param  mixed $book
     * @return void
     */
    public function destroy(Book $book)
    {
        //delete book
        $book->delete();

        //return response
        return new BookResource(true, 'Data Buku Berhasil Dihapus!', null);
    }

}
