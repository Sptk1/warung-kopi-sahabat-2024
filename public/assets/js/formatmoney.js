const harga_jual = document.getElementById("harga_jual");
const harga_modal = document.getElementById("harga_modal");

harga_jual.addEventListener("keyup", function (e) {
    harga_jual.value = formatRupiah(this.value);
});

harga_modal.addEventListener("keyup", function (e) {
    harga_modal.value = formatRupiah(this.value);
});

function formatRupiah(angka) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }
    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return rupiah;
}
