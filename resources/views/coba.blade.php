<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Percentage Formatter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            max-width: 500px;
        }
        h1 {
            margin-top: 0;
            font-size: 1.5rem;
            color: #333;
        }
        .input-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        .percent-input {
            padding: 8px 12px;
            width: calc(100% - 24px);
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            text-align: right;
        }
        .helper-text {
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Percentage Formatter Demo</h1>
        
        <div class="input-group">
            <label for="percent1">Percentage Field 1:</label>
            <input type="text" id="percent1" class="percent-input" placeholder="0,00 %" autocomplete="off">
            <div class="helper-text">Use comma (,) as decimal separator</div>
        </div>
        
        <div class="input-group">
            <label for="percent2">Percentage Field 2:</label>
            <input type="text" id="percent2" class="percent-input" placeholder="0,00 %" autocomplete="off">
            <div class="helper-text">Use comma (,) as decimal separator</div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the percent formatter for all inputs with class 'percent-input'
            initPercentFormatters();
        });

        function initPercentFormatters() {
            // Select all percentage inputs
            const percentInputs = document.querySelectorAll('.percent-input');
            
            // Initialize each input
            percentInputs.forEach(function(input) {
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
            input.addEventListener('keydown', function(e) {
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
            input.addEventListener('input', function(e) {
                // Get current value and cursor position
                let currentValue = this.value;
                let cursorPos = this.selectionStart;
                
                // Only allow digits and comma
                let cleanedValue = currentValue.replace(/[^\d,]/g, '');
                
                // Ensure only one comma
                let commaCount = (cleanedValue.match(/,/g) || []).length;
                if (commaCount > 1) {
                    cleanedValue = cleanedValue.replace(/,/g, function(match, offset) {
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
            input.addEventListener('focus', function() {
                // If the value is the default, select all text when focused
                if (this.value === "0,00 %" && numericValue === 0) {
                    this.select();
                }
            });
            
            // Handle blur (losing focus)
            input.addEventListener('blur', function() {
                // Ensure proper formatting when leaving the field
                this.value = formatValue(numericValue);
                userIsTyping = false;
                hadSelection = false;
            });
            
            // Initial formatting
            input.value = formatValue(numericValue);
        }
        
        // Function to add a new percentage input dynamically
        function addPercentageInput(containerId, inputId, labelText) {
            const container = document.getElementById(containerId);
            if (!container) return;
            
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group';
            
            const label = document.createElement('label');
            label.setAttribute('for', inputId);
            label.textContent = labelText || 'Percentage:';
            
            const input = document.createElement('input');
            input.type = 'text';
            input.id = inputId;
            input.className = 'percent-input';
            input.placeholder = '0,00 %';
            input.autocomplete = 'off';
            
            const helperText = document.createElement('div');
            helperText.className = 'helper-text';
            helperText.textContent = 'Use comma (,) as decimal separator';
            
            inputGroup.appendChild(label);
            inputGroup.appendChild(input);
            inputGroup.appendChild(helperText);
            container.appendChild(inputGroup);
            
            // Initialize the formatter for the new input
            setupPercentFormatter(input);
        }
    </script>
</body>
</html>