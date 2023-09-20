<?php
require_once 'vendor/autoload.php';  // Certifique-se de que o autoload do Composer está configurado corretamente para incluir a biblioteca Day.js

use Carbon\Carbon;

interface IDateProvider {
    public function getDate($formattedDate);
    public function addDays($days);
    public function addMinutes($minutes);
    public function isValidDate($date);
}

class DateProvider implements IDateProvider {
    public function getDate($formattedDate) {
        return new DateTime($formattedDate);
    }

    public function addDays($days) {
        $formattedDate = Carbon::now()->addDays($days)->toDateTimeString();
        return $this->getDate($formattedDate);
    }

    public function addMinutes($minutes) {
        $formattedDate = Carbon::now()->addMinutes($minutes)->toDateTimeString();
        return $this->getDate($formattedDate);
    }

    public function isValidDate($date) {
        $currentDate = Carbon::now();
        $providedDate = Carbon::parse($date);

        return $providedDate->isAfter($currentDate);
    }
}

$dateProvider = new DateProvider();

// Exemplos de uso
$formattedDate = "2023-09-30T12:00:00Z";
$daysToAdd = 5;
$minutesToAdd = 30;

$dateFromFormatted = $dateProvider->getDate($formattedDate);
$addedDaysDate = $dateProvider->addDays($daysToAdd);
$addedMinutesDate = $dateProvider->addMinutes($minutesToAdd);

$isValid = $dateProvider->isValidDate($formattedDate);

echo "Date from formatted: " . $dateFromFormatted->format('Y-m-d H:i:s') . "\n";
echo "Added days date: " . $addedDaysDate->format('Y-m-d H:i:s') . "\n";
echo "Added minutes date: " . $addedMinutesDate->format('Y-m-d H:i:s') . "\n";
echo "Is valid date? " . ($isValid ? 'Yes' : 'No') . "\n";
?>
