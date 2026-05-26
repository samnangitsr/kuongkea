<script>
    // Khmer digit words and tens
    const khmerDigits = [
      "សូន្យ",
      "មួយ",
      "ពីរ",
      "បី",
      "បួន",
      "ប្រាំ",
      "ប្រាំមួយ",
      "ប្រាំពីរ",
      "ប្រាំបី",
      "ប្រាំបួន",
    ];

    const khmerTens = [
      "",
      "ដប់",
      "ម្ភៃ",
      "សាមសិប",
      "សែសិប",
      "ហាសិប",
      "ហុកសិប",
      "ចិតសិប",
      "ប៉ែតសិប",
      "កៅសិប",
    ];

    function convertToKhmerWords(input,resultElement,curname) {
    //   const input = document.getElementById("numberInput").value.trim();
      // const resultElement = document.getElementById("result");

      if (isNaN(input) || input === "") {
        //resultElement.value = "Please enter a valid number";
        $(resultElement).val("Please enter a valid number");
        return;
      }

      const [integerPart, decimalPart] = input.split(".");
      let result = "";

      // Convert the integer part
      if (integerPart) {
        result += numberToKhmerWords(Number(integerPart));
      } else {
        result += khmerDigits[0]; // If no integer part, explicitly add "សូន្យ"
      }

      // Convert the decimal part if it exists
      // if (decimalPart) {
      //   result += " ចុច "; // Add "dot" separator
      //   result += decimalToKhmerWords(decimalPart);
      // }
      if (decimalPart) {
        let decimalPart0='0.' + decimalPart;
        let decimalPart1=parseFloat(decimalPart0);
        let decimalPart2=decimalPart1.toString().split('.');
        result += " ចុច "; // Add "dot" separator
        let found=0;

        for (const digit of decimalPart) {
          if(digit==0 && found==0){
            result += khmerDigits[Number(digit)]; // Convert each digit including leading zeros
          }else{
            found=1;
            result += numberToKhmerWords(decimalPart2[1]);
            break;
          }

        }

      }

      //resultElement.value = result.trim();
      $(resultElement).val(result.trim() + curname);

    }

    function decimalToKhmerWords(decimalPart) {
      let words = "";
      const length = decimalPart.length;

      for (let i = 0; i < length; i++) {
        const digit = parseInt(decimalPart[i], 10);

        if (digit > 0) {
          if (i === length - 1 && length > 1) {
            // Handle the last digit
            words += khmerDigits[digit];
          } else if (i === length - 2) {
            words += khmerTens[digit];
          } else if (i === length - 3) {
            words += khmerDigits[digit] + "រយ ";
          } else if (i === length - 4) {
            words += khmerDigits[digit] + "ពាន់ ";
          }
        } else {
          // Add zero for non-significant digits
          words += khmerDigits[0] + " ";
        }
      }

      return words.trim();
    }

    function numberToKhmerWords(number) {
      if (number === 0) return khmerDigits[0];

      let words = "";

      const units = [
        "កោដិ", // Billions
        "លាន", // Millions
        "សែន", // Hundred Thousands
        "ម៉ឺន", // Ten Thousands
        "ពាន់", // Thousands
        "រយ", // Hundreds
        "", // Tens
      ];

      const divisors = [1e9, 1e6, 1e5, 1e4, 1e3, 1e2, 10];

      for (let i = 0; i < divisors.length; i++) {
        const value = Math.floor(number / divisors[i]);
        if (value > 0) {
          if (i < 2) {
            // Special handling for billions and millions
            words +=
              (value > 1 ? numberToKhmerWords(value):"មួយ") + units[i];
          } else if (i === 6) {
            // Handle tens
            words += khmerTens[value];
          } else {
            // Handle other units
            words += khmerDigits[value] + units[i];
          }
          number %= divisors[i];
        }
      }

      // Add remaining digits
      if (number > 0) {
        words += khmerDigits[number];
      }

      return words.trim();
    }
  </script>
