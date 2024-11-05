<?php include 'pages/base/header.php'; ?>
<main>
    <div class="calcForm">
        <h1>Калькулятор</h1>
        <?php session_start(); ?>




        <form action="scripts/php/validate.php" method="POST">
            <div class="row">
                <p>Дата оформления вклада</p>
                <input type="text" id="datepicker" name="datepicker" placeholder="дд-мм-гггг" required value="<?php if (isset($_SESSION['datepicker'])) {echo $_SESSION['datepicker'];} ?>">
            </div>
            <?php
                if (isset($_SESSION['error'][0])) {
                    echo '<div class="alert">' . $_SESSION['error'][0] . '</div>';
                    unset($_SESSION['error'][0]);
                }
            ?>

            <div class="row">
                <p>Сумма вклада</p>
                <input type="number" id="depositAmountValue" name="depositAmountValue" min="1000" max="3000000" step="500" required>

                <div>
                    <input type="range" id="depositAmountSlider" min="1000" max="3000000" value="<?php if (isset($_SESSION['depositAmountValue'])) {echo $_SESSION['depositAmountValue'];} else echo "1500500" ?>" step="500">
                    <span>1 тыс. руб.</span>
                    <span>3 000 000</span>
                </div>
            </div>
            <?php
            if (isset($_SESSION['error'][1])) {
                echo '<div class="alert">' . $_SESSION['error'][1] . '</div>';
                unset($_SESSION['error'][1]);
            }
            ?>

            <div class="row">
                <p>Срок вклада</p>
                <select name="depositPeriod" required>
                    <option value="oneYear" <?= (isset($_SESSION['depositPeriod']) && $_SESSION['depositPeriod'] == "oneYear") ? 'selected' : '' ?> >1 год</option>
                    <option value="twoYears" <?= (isset($_SESSION['depositPeriod']) && $_SESSION['depositPeriod'] == "twoYears") ? 'selected' : '' ?> >2 года</option>
                    <option value="threeYears" <?= (isset($_SESSION['depositPeriod']) && $_SESSION['depositPeriod'] == "threeYears") ? 'selected' : '' ?> >3 года</option>
                    <option value="fourYears" <?= (isset($_SESSION['depositPeriod']) && $_SESSION['depositPeriod'] == "fourYears") ? 'selected' : '' ?> >4 года</option>
                    <option value="fiveYears" <?= (isset($_SESSION['depositPeriod']) && $_SESSION['depositPeriod'] == "fiveYears") ? 'selected' : '' ?> >5 лет</option>
                </select>
            </div>
            <?php
            if (isset($_SESSION['error'][2])) {
                echo '<div class="alert">' . $_SESSION['error'][2] . '</div>';
                unset($_SESSION['error'][2]);
            }
            ?>

            <div class="row">
                <p>Пополнение вклада</p>
                <input type="radio" value="noReplenishment" name="depositReplenishment" checked required>
                <label for="noReplenishment">Нет</label>
                <input type="radio" value="Replenishment" name="depositReplenishment" <?= (isset($_SESSION['depositReplenishment']) && $_SESSION['depositReplenishment'] == "Replenishment") ? 'checked' : '' ?> >
                <label for="Replenishment">Да</label>
            </div>
            <?php
            if (isset($_SESSION['error'][3])) {
                echo '<div class="alert">' . $_SESSION['error'][3] . '</div>';
                unset($_SESSION['error'][3]);
            }
            ?>

            <div class="row">
                <p>Сумма пополнения вклада</p>
                <input type="number" id="amountReplenishmentValue" name="amountReplenishmentValue" min="1000" max="3000000" step="500"required>

                <div>
                    <input type="range" id="amountReplenishmentSlider" min="1000" max="3000000" value="<?php if (isset($_SESSION['amountReplenishmentValue'])) {echo $_SESSION['amountReplenishmentValue'];} else echo "1500500" ?>" step="500">
                    <span>1 тыс. руб.</span>
                    <span>3 000 000</span>
                </div>
            </div>
            <?php
            if (isset($_SESSION['error'][4])) {
                echo '<div class="alert">' . $_SESSION['error'][4] . '</div>';
                unset($_SESSION['error'][4]);
            }
            ?>

            <div class="row">
                <button>Рассчитать</button>
                <?php
                if (isset($_SESSION['result'])) {
                    echo '<div class="">' . $_SESSION['result'] . '</div>';
                    unset($_SESSION['result']);
                }
                ?>
            </div>
        </form>
    </div>
</main>
<?php include 'pages/base/footer.php'; ?>