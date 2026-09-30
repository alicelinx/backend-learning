<?php

namespace Drupal\forcontu_plugins;

class ForcontuCourses implements ForcontuCoursesInterface {
  
  protected $course;

  public function __construct($courses) {
    $this->courses = $courses;
  }

  public function getCourses() {
    return $this->courses;
  }
}