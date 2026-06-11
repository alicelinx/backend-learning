<?php

class Book {
  private $title;
  private $author;

  public function __construct($title, $author) {
    $this->title = $title;
    $this->author = $author;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getAuthor() {
    return $this->author;
  }

  public function getTitleAndAuthor() {
    return $this->getTitle() . " by " . $this->getAuthor();
  }
}

interface StrategyInterface {
  public function showTitleAndAuthor($book);
}

class StrategyUpper implements StrategyInterface {
  public function showTitleAndAuthor($book) {
    return strtoupper($book->getTitleAndAuthor());
  }
}

class StrategyStrong implements StrategyInterface {
  public function showTitleAndAuthor($book) {
    return "<strong>" . $book->getTitleAndAuthor() . "</strong>";
  }
}

class StrategyEm implements StrategyInterface {
  public function showTitleAndAuthor($book) {
    return "<em>" . $book->getTitleAndAuthor() . "</em>";
  }
}

class StrategyHyphen implements StrategyInterface {
  public function showTitleAndAuthor($book) {
    return str_replace(" ", "-", $book->getTitleAndAuthor());
  }
}

class StrategyContext {
  private $strategy = NULL;

  public function __construct($strategy_id) {
    switch($strategy_id) {
      case "UPPER";
        $this->strategy = new StrategyUpper();
      break;
      case "STRONG";
        $this->strategy = new StrategyStrong();
      break;
      case "EM";
        $this->strategy = new StrategyEm();
      break;
      case "HYPHEN";
        $this->strategy = new StrategyHyphen();
      break;
    }      
  }

  public function showBookTitleAndAuthor($book) {
    return $this->strategy->showTitleAndAuthor($book);
  }
}

$book = new Book("Life of Pi", "Yann Martel");

$strategyUpper = new StrategyContext("UPPER");
print $strategyUpper->showBookTitleAndAuthor($book) . "<br>";

$strategyStrong = new StrategyContext("STRONG");
print $strategyStrong->showBookTitleAndAuthor($book). "<br>";

$strategyEm = new StrategyContext("EM");
print $strategyEm->showBookTitleAndAuthor($book). "<br>";

$strategyHyphen = new StrategyContext("HYPHEN");
print $strategyHyphen->showBookTitleAndAuthor($book). "<br>";
?>