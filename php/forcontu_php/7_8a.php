<?php

interface EventLogInterface {
  public function log($message);
}

class EventLogFile implements EventLogInterface {
  public function log($message) {
    echo "The message \"{$message}\" has been stored in the log file.<br>";
  }
}

class EventLogDatabase implements EventLogInterface {
  public function log($message) {
    echo "The message \"{$message}\" has been stored in the database.<br>";
  }
}

class EventLogSerialize implements EventLogInterface {
  public function log($message) {
    $serialized = serialize($message);
    echo "The message has been stored serialized: {$serialized}<br>";
  }
}

class EventLogJson implements EventLogInterface {
  public function log($message) {
    $json = json_encode($message);
    echo "The message has been stored in Json: {$json}<br>";
  }
}

class User {
  protected $logDestination;
  protected $username;

  public function __construct($username, EventLogInterface $logDestination) {
    $this->username = $username;
    $this->logDestination = $logDestination;
  }

  public function setLogDestination(EventLogInterface $logDestination) {
    $this->logDestination = $logDestination;
  }
  
  public function login() {
    $this->logDestination->log("The user {$this->username} has successfully logged in.");
  }

  public function logout() {
    $this->logDestination->log("The user {$this->username} has logged out.");
  }

  public function sendForm() {
    $this->logDestination->log("The user {$this->username} has submitted the form.");
  }

}

$user1 = new User("Alice", new EventLogDatabase());
echo "--- Login with database ---<br>";
$user1->login();
echo "--- Switch to serialize ---<br>";
$user1->setLogDestination(new EventLogSerialize());
$user1->sendForm();
echo "--- Switch with JSON ---<br>";
$user1->setLogDestination(new EventLogJson());
$user1->sendForm();
$user1->logout();
?>