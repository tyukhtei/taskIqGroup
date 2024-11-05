<?php
session_start();

$datepicker = $_SESSION['datepicker'];
$depositAmountValue = $_SESSION['depositAmountValue'];
$depositPeriod = $_SESSION['depositPeriod'];
$depositReplenishment = $_SESSION['depositReplenishment'];
$amountReplenishmentValue = isset($_SESSION['amountReplenishmentValue']) ? $_SESSION['amountReplenishmentValue'] : 0;

$percent = 0.10;
$daysInYear = 365;

$monthsInYear = [
    "oneYear" => 12,
    "twoYears" => 24,
    "threeYears" => 36,
    "fourYears" => 48,
    "fiveYears" => 60,
];

$totalMonths = $monthsInYear[$depositPeriod];
$initialAmount = floatval($depositAmountValue);
$totalAmount = $initialAmount;

$startDate = DateTime::createFromFormat('d-m-Y', $datepicker);

for ($n = 1; $n <= $totalMonths; $n++) {
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $startDate->format('n'), $startDate->format('Y'));

    if ($depositReplenishment === "Replenishment") {
        $totalAmount += $amountReplenishmentValue;
    }

    $totalAmount += ($totalAmount + ($depositReplenishment === "Replenishment" ? $amountReplenishmentValue : 0)) * ($percent / $daysInYear) * $daysInMonth;

    $startDate->modify('first day of next month');
}

$_SESSION['result'] = "<div class='result'><p>Результат:</p> " . number_format($totalAmount, 2, ',', ' ') . " руб</div>";

header("Location: ../../index.php");
exit();
?>