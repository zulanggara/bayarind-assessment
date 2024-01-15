
let inputElement = document.getElementById('total_purchase');
let debounceTimer;

inputElement.addEventListener('input', function(event) {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function() {
        checkInputPurchases(inputElement.value.replaceAll('.', ''))
    }, 500);
});

function checkInputPurchases(input_data) {
    fetch("logic/check.php", {
        method: "POST",
        body: JSON.stringify({
            input: input_data
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    }).then(response => {
        return response.json();
      }).then(data => {
        // Buat tombol dari respon opsi pembayaran
        html = '';
        data.pilihanPembayaran.forEach(pembayaran => {
            if (input_data != pembayaran) {
                if (pembayaran == 'Uang Pas') {
                    html += "<button style='background-color:yellow'>"+pembayaran+"</button>&nbsp;&nbsp;&nbsp;";
                }else{
                    html += "<button>"+pembayaran+"</button>&nbsp;&nbsp;&nbsp;";
                }
            }
        });
        document.getElementById("hasil_kemungkinan_bayar").innerHTML = html;
      });
}