<?php
session_start();

$datepicker = $_SESSION['datepicker'];
$depositAmountValue = $_SESSION['depositAmountValue'];
$depositPeriod = $_SESSION['depositPeriod'];
$depositReplenishment = $_SESSION['depositReplenishment'];
$amountReplenishmentValue = isset($_SESSION['amountReplenishmentValue']) ? $_SESSION['amountReplenishmentValue'] : 0;

// Установим процентную ставку
$percent = 0.10; // 10%
$daysInYear = 365; // Количество дней в году

// Определяем количество месяцев в зависимости от выбранного периода
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

// Получение даты начала вклада
$startDate = DateTime::createFromFormat('d-m-Y', $datepicker);

// Итерация по месяцам для расчета суммы
for ($n = 1; $n <= $totalMonths; $n++) {
    // Получаем количество дней в текущем месяце
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $startDate->format('n'), $startDate->format('Y'));

    // Если пополнение вклада "да", мы учитываем его в расчетах
    if ($depositReplenishment === "Replenishment") {
        $totalAmount += $amountReplenishmentValue; // добавляем сумму пополнения
    }

    // Вычисляем итоговую сумму на конец месяца
    $totalAmount += ($totalAmount + ($depositReplenishment === "Replenishment" ? $amountReplenishmentValue : 0)) * ($percent / $daysInYear) * $daysInMonth;

    // Переход к следующему месяцу
    $startDate->modify('first day of next month');
}

// Сохраняем результат в сессии для вывода на странице
$_SESSION['result'] = "Итоговая сумма на счете: " . number_format($totalAmount, 2, ',', ' ') . " руб.";

// Перенаправление обратно на главную страницу
header("Location: ../../index.php");
exit();
?>