<?php

namespace Drupal\forcontu_plugins;

use Drupal\Core\Session\AccountInterface;

class ForcontuCourses implements ForcontuCoursesInterface {
  
  protected $courses;
  protected $currentUser;

  public function __construct($courses, AccountInterface $current_user) {
    $this->courses = $courses;
    $this->currentUser = $current_user;
  }

  public function getCourses() {
    if (!$this->currentUser->isAuthenticated()) {
      foreach ($this->courses as &$course) {
        $course['hours'] = 'N/A';
      }
    }
    return $this->courses;
  }
}