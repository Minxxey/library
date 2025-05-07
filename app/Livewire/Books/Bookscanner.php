<?php

namespace App\Livewire\Books;

use App\Models\Book;
use App\Services\BookCoverLookupService;
use App\Services\BookLookupService;
use Illuminate\Http\Client\ConnectionException;
use Livewire\Component;

class Bookscanner extends Component
{
    public string $isbn = '';
    public ?Book $book = null;

    /**
     * @throws ConnectionException
     */
    public function save()
    {
        list($bookData, $coverPath) = $this->getBookAndCoverInformation();
        $bookExists = Book::where('isbn', $this->isbn)->exists();

        if ($bookExists) {
            $this->book = Book::where('isbn', $this->isbn)->first();
            return redirect()->back()->with('message', 'Buch existiert bereits!');
        }
        $this->book = Book::create([
            'title' => $bookData['title'],
            'author' => $bookData['authors'][0]['name'] ?? '',
            'isbn' => $this->isbn,
            'cover_img' => $coverPath,
            'published_year' => $bookData['publish_date'] ?? ''
        ]);

        session()->flash('message', "Buch mit dem Titel $this->book->title wurde in deiner Bibliothek gespeichert.");
    }

    public function render()
    {
        return view('livewire.books.bookscanner');
    }

    /**
     * @throws ConnectionException
     */
    public function getBookAndCoverInformation(): array
    {
        $data = (new BookLookupService())->lookupByIsbn($this->isbn);
        $coverPath = (new BookCoverLookupService())->downloadAndStoreCoverImage($this->isbn);

        return [$data, $coverPath];
    }
}
