<?php
session_start();

validateForm();

function validateForm()
{
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        return;
    }

    checkDates();
    checkDepositAmount();
    checkDepositPeriod();
    checkDepositReplenishment();
    checkAmountReplenishment();

    if (count($_SESSION["error"]) > 0){
        header("Location: ../../index.php");
        exit();
    }
    header("Location: calc.php");
    exit();
}

function checkDates()
{
    $datepicker = trim($_POST['datepicker']);
    $_SESSION['datepicker'] = $datepicker;

    if (!preg_match('/^\d{2}-\d{2}-\d{4}$/', $datepicker)) {
        addError("Неверный формат даты. Пожалуйста, используйте формат дд-мм-гггг.", 0);
    }

    $date = DateTime::createFromFormat('d-m-Y', $datepicker);
    if (!$date || $date->format('d-m-Y') !== $datepicker) {
        addError("Некорректная дата. Пожалуйста, введите дату в формате дд-мм-гггг.", 0);
    }
}

function checkDepositAmount(){
    $depositAmountValue = trim($_POST['depositAmountValue']);
    $_SESSION['depositAmountValue'] = $depositAmountValue;

    validateNumeric($depositAmountValue, "Пожалуйста, введите корректную сумму вклада.", 1);
    validateAmountRange($depositAmountValue, 1000, 3000000, "Сумма вклада должна быть от 1 000 до 3 000 000.", 1);
}

function checkDepositPeriod()
{
    $depositPeriod = trim($_POST['depositPeriod']);
    $_SESSION['depositPeriod'] = $depositPeriod;

    $validPeriods = ['oneYear', 'twoYears', 'threeYears', 'fourYears', 'fiveYears'];
    if (!in_array($depositPeriod, $validPeriods)) {
        addError("Пожалуйста, выберите срок вклада.", 2);
    }
}

function checkDepositReplenishment()
{
    if (isset($_POST['depositReplenishment'])) {
        $depositReplenishment = trim($_POST['depositReplenishment']);
        $_SESSION['depositReplenishment'] = $depositReplenishment;

        $validReplenishmentOptions = ['noReplenishment', 'Replenishment'];
        if (!in_array($depositReplenishment, $validReplenishmentOptions)) {
            addError("Пожалуйста, выберите вариант пополнения вклада.", 3);
        }
    } else {
        addError("Пожалуйста, выберите вариант пополнения вклада.", 3);
    }
}

function checkAmountReplenishment(){
    $amountReplenishmentValue = trim($_POST['amountReplenishmentValue']);
    $_SESSION['amountReplenishmentValue'] = $amountReplenishmentValue;

    validateNumeric($amountReplenishmentValue, "Пожалуйста, введите корректную сумму пополнения.", 4);
    validateAmountRange($amountReplenishmentValue, 1000, 3000000, "Сумма пополнения должна быть от 1 000 до 3 000 000.", 4);
}

function addError($message, $index)
{
    $_SESSION['error'][$index] = $message;
}

function validateNumeric($value, $errorMessage, $index) {
    if (!is_numeric($value)) {
        addError($errorMessage, $index);
    }
}

function validateAmountRange($value, $min, $max, $errorMessage, $index) {
    $value = floatval($value);
    if ($value < $min || $value > $max) {
        addError($errorMessage, $index);
    }
}
?>