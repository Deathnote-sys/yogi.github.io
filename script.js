document.getElementById("transactionForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Menghentikan pengiriman form

    var nama = document.getElementById("nama").value;
    var tanggal = document.getElementById("tanggal").value;
    var jumlah = parseInt(document.getElementById("jumlah").value);
    var keterangan = document.getElementById("keterangan").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "add_transaction.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            document.getElementById("message").innerHTML = response.message;
            document.getElementById("transactionForm").reset();
            updateTotalTabungan();
        }
    };
    xhr.send("nama=" + encodeURIComponent(nama) + "&tanggal=" + tanggal + "&jumlah=" + jumlah + "&keterangan=" + encodeURIComponent(keterangan));
});

function updateTotalTabungan() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_total_tabungan.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            document.getElementById("totalTabungan").innerHTML = "Rp " + response.total;
        }
    };
    xhr.send();
}

// Memanggil fungsi updateTotalTabungan saat halaman dimuat
updateTotalTabungan();
