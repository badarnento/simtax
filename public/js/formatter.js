$(document).ready(function () {
    initPercentFormatters();
    initNumberFormatters();

    function initNumberFormatters() {
        const numberInputs = document.querySelectorAll(".number-input");

        numberInputs.forEach(function (input) {
            setupNumberFormatter(input);
        });
    }

    function initPercentFormatters() {
        const percentInputs = document.querySelectorAll(".percent-input");

        percentInputs.forEach(function (input) {
            setupPercentFormatter(input);
        });
    }

    function setupPercentFormatter(input) {
        let numericValue = 0;
        let userIsTyping = false;
        let lastKey = "";
        let hadSelection = false;

        function formatValue(value) {
            if (value === "" || isNaN(value)) {
                return "0,00 %";
            }
            const limitedValue = Math.min(value, 100);
            return limitedValue.toFixed(2).replace(".", ",") + " %";
        }

        function parseInputValue(inputVal) {
            let cleaned = inputVal.replace(/[^\d,]/g, "");

            cleaned = cleaned.replace(",", ".");

            return parseFloat(cleaned);
        }

        input.addEventListener("keydown", function (e) {
            if (this.selectionEnd - this.selectionStart === this.value.length) {
                hadSelection = true;
            } else {
                hadSelection = false;
            }

            if ((e.key >= "0" && e.key <= "9") || e.key === ",") {
                userIsTyping = true;
                lastKey = e.key;
            }
        });

        input.addEventListener("input", function (e) {
            let currentValue = this.value;
            let cursorPos = this.selectionStart;

            let cleanedValue = currentValue.replace(/[^\d,]/g, "");

            let commaCount = (cleanedValue.match(/,/g) || []).length;
            if (commaCount > 1) {
                cleanedValue = cleanedValue.replace(
                    /,/g,
                    function (match, offset) {
                        return offset === cleanedValue.indexOf(",") ? "," : "";
                    }
                );
            }

            let beforeComma = cleanedValue.split(",")[0] || "";
            if (beforeComma.length > 3) {
                beforeComma = beforeComma.substring(0, 3);
                if (parseInt(beforeComma) > 100) {
                    beforeComma = "100";
                }

                let afterComma = cleanedValue.split(",")[1] || "";
                cleanedValue =
                    beforeComma + (afterComma ? "," + afterComma : "");
            }

            let parsed = parseInputValue(cleanedValue);
            if (!isNaN(parsed)) {
                numericValue = Math.min(parsed, 100);
            } else if (cleanedValue === "" || cleanedValue === ",") {
                numericValue = 0;
            }

            let newCursorPos = cursorPos;

            if (hadSelection && userIsTyping) {
                const newValue = formatValue(numericValue);
                this.value = newValue;

                if (lastKey >= "0" && lastKey <= "9") {
                    newCursorPos = 1;
                } else if (lastKey === ",") {
                    newCursorPos = cleanedValue.indexOf(",") + 1;
                }

                hadSelection = false;
                userIsTyping = false;

                setTimeout(() => {
                    this.setSelectionRange(newCursorPos, newCursorPos);
                }, 0);

                return;
            }

            this.value = formatValue(numericValue);

            if (userIsTyping) {
                if (lastKey >= "0" && lastKey <= "9") {
                    newCursorPos = cursorPos;
                } else if (lastKey === ",") {
                    const formattedValue = this.value;
                    newCursorPos = formattedValue.indexOf(",") + 1;
                }

                userIsTyping = false;
            }

            setTimeout(() => {
                this.setSelectionRange(newCursorPos, newCursorPos);
            }, 0);
        });

        input.addEventListener("focus", function () {
            if (this.value === "0,00 %" && numericValue === 0) {
                this.select();
            }
        });

        input.addEventListener("blur", function () {
            this.value = formatValue(numericValue);
            userIsTyping = false;
            hadSelection = false;
        });

        input.value = formatValue(numericValue);
    }

    function setupNumberFormatter(numberInput) {
        const MIN_VALUE = 1;

        function formatNumber(num) {
            if (!num) return "";

            let cleanNum = num.replace(/\./g, "");
            cleanNum = cleanNum.replace(/[^\d,]/g, "");
            cleanNum = cleanNum.replace(",", ".");

            const parts = cleanNum.split(".");
            if (parts.length > 2) {
                cleanNum = parts[0] + "." + parts.slice(1).join("");
            }

            const decimalPart = cleanNum.includes(".")
                ? "." + cleanNum.split(".")[1]
                : "";
            let integerPart = cleanNum.includes(".")
                ? cleanNum.split(".")[0]
                : cleanNum;

            if (integerPart === "") {
                integerPart = "0";
            }

            integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            return integerPart + decimalPart;
        }

        function validateValue(value) {
            if (!value) return true;

            const numericValue = parseFloat(
                value.replace(/\./g, "").replace(",", ".")
            );

            return !isNaN(numericValue) && numericValue >= MIN_VALUE;
        }

        numberInput.addEventListener("input", function (e) {
            const cursorPosition = this.selectionStart;
            const oldValue = this.value;
            const oldLength = oldValue.length;

            const formattedValue = formatNumber(oldValue);

            this.value = formattedValue;

            const newPosition =
                cursorPosition + (formattedValue.length - oldLength);
            const safePosition = Math.max(
                0,
                Math.min(newPosition, formattedValue.length)
            );
            this.setSelectionRange(safePosition, safePosition);
        });

        numberInput.addEventListener("blur", function () {
            if (this.value && !validateValue(this.value)) {
                this.value = MIN_VALUE.toString();
            }
        });

        numberInput.addEventListener("paste", function (e) {
            setTimeout(() => {
                const rawValue = this.value;
                const formattedValue = formatNumber(rawValue);
                this.value = formattedValue;
            }, 0);
        });

        numberInput.addEventListener("keydown", function (e) {
            if (
                [46, 8, 9, 27, 13].indexOf(e.keyCode) !== -1 ||
                (e.keyCode === 65 &&
                    (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode === 67 &&
                    (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode === 86 &&
                    (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode === 88 &&
                    (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode >= 35 && e.keyCode <= 40)
            ) {
                return;
            }

            if (
                (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
                (e.keyCode < 96 || e.keyCode > 105) &&
                e.keyCode !== 190 &&
                e.keyCode !== 110
            ) {
                e.preventDefault();
            }

            if (
                (e.keyCode === 190 || e.keyCode === 110) &&
                this.value.includes(".")
            ) {
                e.preventDefault();
            }
        });
    }
});
