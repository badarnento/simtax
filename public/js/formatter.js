$(document).ready(function () {
    // Initialize the percent formatter for all inputs with class 'percent-input'
    initPercentFormatters();
    initNumberFormatters();

    function initNumberFormatters() {
        // Select all percentage inputs
        const numberInputs = document.querySelectorAll('.number-input');

        // Initialize each input
        numberInputs.forEach(function (input) {
            console.log('Initializing input:', input.id);
            setupNumberFormatter(input);
        });
    }

    function initPercentFormatters() {
        // Select all percentage inputs
        const percentInputs = document.querySelectorAll('.percent-input');

        // Initialize each input
        percentInputs.forEach(function (input) {
            console.log('Initializing input:', input.id);
            setupPercentFormatter(input);
        });
    }

    function setupPercentFormatter(input) {

        // Store the actual numeric value for this input
        let numericValue = 0;
        let userIsTyping = false;
        let lastKey = '';
        let hadSelection = false;

        // Function to format the value
        function formatValue(value) {
            if (value === "" || isNaN(value)) {
                return "0,00 %";
            }
            // Limit to 100%
            const limitedValue = Math.min(value, 100);
            return limitedValue.toFixed(2).replace('.', ',') + " %";
        }

        // Function to parse the input value
        function parseInputValue(inputVal) {
            // Remove the percentage sign and any spaces
            let cleaned = inputVal.replace(/[^\d,]/g, '');

            // Replace comma with dot for calculation
            cleaned = cleaned.replace(',', '.');

            // Parse as float
            return parseFloat(cleaned);
        }

        // Track keydown events to know what the user is typing
        input.addEventListener('keydown', function (e) {
            // Check if text is fully selected
            if (this.selectionEnd - this.selectionStart === this.value.length) {
                hadSelection = true;
            } else {
                hadSelection = false;
            }

            // Track what key is being pressed
            if ((e.key >= '0' && e.key <= '9') || e.key === ',') {
                userIsTyping = true;
                lastKey = e.key;
            }
        });

        // Handle input events
        input.addEventListener('input', function (e) {
            // Get current value and cursor position
            let currentValue = this.value;
            let cursorPos = this.selectionStart;

            // Only allow digits and comma
            let cleanedValue = currentValue.replace(/[^\d,]/g, '');

            // Ensure only one comma
            let commaCount = (cleanedValue.match(/,/g) || []).length;
            if (commaCount > 1) {
                cleanedValue = cleanedValue.replace(/,/g, function (match, offset) {
                    return offset === cleanedValue.indexOf(',') ? ',' : '';
                });
            }

            // Check if the value is too large before the comma
            let beforeComma = cleanedValue.split(',')[0] || '';
            if (beforeComma.length > 3) {
                beforeComma = beforeComma.substring(0, 3);
                if (parseInt(beforeComma) > 100) {
                    beforeComma = "100";
                }

                let afterComma = cleanedValue.split(',')[1] || '';
                cleanedValue = beforeComma + (afterComma ? ',' + afterComma : '');
            }

            // Parse and format the value
            let parsed = parseInputValue(cleanedValue);
            if (!isNaN(parsed)) {
                numericValue = Math.min(parsed, 100);
            } else if (cleanedValue === '' || cleanedValue === ',') {
                numericValue = 0;
            }

            // Determine cursor position strategy
            let newCursorPos = cursorPos;

            // Special handling for selected text replacement
            if (hadSelection && userIsTyping) {
                // When replacing all text with a single character
                const newValue = formatValue(numericValue);
                this.value = newValue;

                // Position cursor after the first digit
                if (lastKey >= '0' && lastKey <= '9') {
                    newCursorPos = 1;
                } else if (lastKey === ',') {
                    // If typed a comma, place cursor after it
                    newCursorPos = cleanedValue.indexOf(',') + 1;
                }

                // Reset flags
                hadSelection = false;
                userIsTyping = false;

                // Set cursor position
                setTimeout(() => {
                    this.setSelectionRange(newCursorPos, newCursorPos);
                }, 0);

                return;
            }

            // Update value with formatting
            this.value = formatValue(numericValue);

            // Normal cursor position adjustment
            if (userIsTyping) {
                if (lastKey >= '0' && lastKey <= '9') {
                    // For numbers, place cursor at the position where the number was entered
                    newCursorPos = cursorPos;
                } else if (lastKey === ',') {
                    // For comma, place cursor after the comma
                    const formattedValue = this.value;
                    newCursorPos = formattedValue.indexOf(',') + 1;
                }

                // Reset typing flag
                userIsTyping = false;
            }

            // Set cursor position
            setTimeout(() => {
                this.setSelectionRange(newCursorPos, newCursorPos);
            }, 0);
        });

        // Handle focus
        input.addEventListener('focus', function () {
            // If the value is the default, select all text when focused
            if (this.value === "0,00 %" && numericValue === 0) {
                this.select();
            }
        });

        // Handle blur (losing focus)
        input.addEventListener('blur', function () {
            // Ensure proper formatting when leaving the field
            this.value = formatValue(numericValue);
            userIsTyping = false;
            hadSelection = false;
        });

        // Initial formatting
        input.value = formatValue(numericValue);
    }


      function setupNumberFormatter(numberInput){

    const MIN_VALUE = 1; // Minimum allowed value is 1
    
    // Format a number with thousand separators
    function formatNumber(num) {
      // Handle empty input
      if (!num) return '';
      
      // Remove any non-numeric characters except decimal point
      // First, remove any existing thousand separators
      let cleanNum = num.replace(/\./g, '');
      // Then remove any other non-numeric characters except decimal point
      cleanNum = cleanNum.replace(/[^\d,]/g, '');
      // Convert comma to dot for decimal point if present
      cleanNum = cleanNum.replace(',', '.');
      
      // Ensure only one decimal point
      const parts = cleanNum.split('.');
      if (parts.length > 2) {
        cleanNum = parts[0] + '.' + parts.slice(1).join('');
      }
      
      // Split number into integer and decimal parts
      const decimalPart = cleanNum.includes('.') ? '.' + cleanNum.split('.')[1] : '';
      let integerPart = cleanNum.includes('.') ? cleanNum.split('.')[0] : cleanNum;
      
      // Handle empty integer part (e.g., ".123" was entered)
      if (integerPart === '') {
        integerPart = '0';
      }
      
      // Add thousand separators correctly to integer part
      // This regex adds a dot after every 3 digits from the right
      integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
      
      return integerPart + decimalPart;
    }
    
    // Validate if the number meets minimum requirements
    function validateValue(value) {
      if (!value) return true; // Allow empty input
      
      // Parse the formatted number (with thousand separators) to a float
      // Replace thousand separators and ensure decimal point is a period
      const numericValue = parseFloat(value.replace(/\./g, '').replace(',', '.'));
      
      // Check if value is less than minimum
      return !isNaN(numericValue) && numericValue >= MIN_VALUE;
    }

      
      // Handle input events
      numberInput.addEventListener('input', function(e) {
        const cursorPosition = this.selectionStart;
        const oldValue = this.value;
        const oldLength = oldValue.length;
        
        // Format the value
        const formattedValue = formatNumber(oldValue);
        
        // Update input value
        this.value = formattedValue;

        
        // Calculate new cursor position
        const newPosition = cursorPosition + (formattedValue.length - oldLength);
        // Ensure position is within bounds
        const safePosition = Math.max(0, Math.min(newPosition, formattedValue.length));
        this.setSelectionRange(safePosition, safePosition);
      });
      
      // Handle blur event to enforce minimum value
      numberInput.addEventListener('blur', function() {
        if (this.value && !validateValue(this.value)) {
          // If value is invalid on blur, reset to minimum
          this.value = MIN_VALUE.toString();
        }
      });
      
      // Handle paste events
      numberInput.addEventListener('paste', function(e) {
        // Let the paste happen, then format it in the next tick
        setTimeout(() => {
          const rawValue = this.value;
          const formattedValue = formatNumber(rawValue);
          this.value = formattedValue;
          
        }, 0);
      });
      
      // Allow only digits and decimal point on keydown
      numberInput.addEventListener('keydown', function(e) {
        // Allow: backspace, delete, tab, escape, enter, ctrl+a, etc.
        if ([46, 8, 9, 27, 13].indexOf(e.keyCode) !== -1 ||
            // Allow: Ctrl/cmd+A, C, V, X
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode === 86 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, up, down
            (e.keyCode >= 35 && e.keyCode <= 40)) {
          return;
        }
        
        // Block if it's not a number or decimal point
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && 
            (e.keyCode < 96 || e.keyCode > 105) && 
            e.keyCode !== 190 && e.keyCode !== 110) {
          e.preventDefault();
        }
        
        // Prevent a second decimal point
        if ((e.keyCode === 190 || e.keyCode === 110) && this.value.includes('.')) {
          e.preventDefault();
        }
      });
    }

});
