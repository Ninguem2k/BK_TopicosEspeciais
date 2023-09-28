<?php
abstract class DateProvider {
    abstract public function addDays($days);
    abstract public function addMinutes($minutes);
    abstract public function isValidDate($date);
}
?>
