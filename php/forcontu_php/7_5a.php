<?php

class Book {
  private $title;
  private $sales;

  public function __construct($title) {
    $this->title = $title;
    $this->sales = 0;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getSales() {
    return $this->sales;
  }

  public function addSale() {
    $this->sales++;
  }
}

class BookFormatter {
  protected $book;

  public function __construct(Book $original_book) {
    $this->book = $original_book;
  }

  public function getSales() {
    if ($this->book->getSales() >= 10) {
      echo "<b>" . $this->book->getTitle() . " has sold " . $this->book->getSales() . " units</b><br>";
    } else {
      echo $this->book->getTitle() . " has sold " . $this->book->getSales() . " units<br>";
    }
  }
}

$book = new Book("Life of Pi");
$bookFormatter = new BookFormatter($book);
for ($i = 1; $i <= 15; $i++) {
  echo "Iteration $i<br>";
  $book->addSale();
  $bookFormatter->getSales();
}

?>