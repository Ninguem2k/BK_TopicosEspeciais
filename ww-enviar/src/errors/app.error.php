<?php
class AppError extends Exception {
  public $code;

  public function __construct($message, $code) {
    parent::__construct($message);
    $this->code = $code;
  }
}
?>
