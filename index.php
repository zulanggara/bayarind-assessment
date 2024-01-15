<?php
// include('logic/check.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <h1>Masukan Jumlah Belanja</h1>
        <input type="text" name="total_purchase" id="total_purchase" class="total_purchase numberOnly">

        <br>
        <hr>
        <hr>
        <br>

        <h4>Kemungkinan Pembayaran</h4>
        <div id="hasil_kemungkinan_bayar"></div>
    </center>
</body>

<script>
    document.addEventListener('keyup', function(event) {
        if (event.target.classList.contains('numberOnly')) {
            event.target.value = formatNumber(event.target.value);
        }
    });
</script>
<script src="js/index.js"></script>
<script src="js/function.js"></script>
<!-- <script>
    let inputElement = document.getElementById('total_purchase');
    let debounceTimer;

    inputElement.addEventListener('input', function(event) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            // Perform desired action here
            //   console.log(inputElement.value.replace(',',''));
            checkInputPurchases(inputElement.value.replace(',', ''))
        }, 500); // Adjust the debounce delay (in milliseconds) as needed
    });

    function checkInputPurchases(input) {
        fetch("logic/check.php", {
            method: "POST",
            body: JSON.stringify({
                input: input
            }),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        });
    }
</script> -->

</html>