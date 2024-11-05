const depositAmountSlider = document.getElementById("depositAmountSlider");
const depositAmountOutput = document.getElementById("depositAmountValue");

depositAmountOutput.value = depositAmountSlider.value;

depositAmountSlider.oninput = function() {
    depositAmountOutput.value = this.value;
}
depositAmountOutput.oninput = function() {
    depositAmountSlider.value = this.value;
}

const amountReplenishmentSlider = document.getElementById("amountReplenishmentSlider");
const amountReplenishmentOutput = document.getElementById("amountReplenishmentValue");

amountReplenishmentOutput.value = amountReplenishmentSlider.value;

amountReplenishmentSlider.oninput = function() {
    amountReplenishmentOutput.value = this.value;
}
amountReplenishmentOutput.oninput = function() {
    amountReplenishmentSlider.value = this.value;
}