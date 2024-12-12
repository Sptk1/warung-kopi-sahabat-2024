const cart = {};
let selectedTable = null; // Variabel untuk menampung meja yang dipilih

// Fungsi untuk mengupdate tampilan subtotal dan total
function updateCartDisplay() {
    let subtotal = 0;
    for (const id in cart) {
        subtotal += cart[id].harga * cart[id].quantity;
    }
    const total = subtotal;

    document.querySelector(
        ".sub-total"
    ).innerText = `Rp. ${subtotal.toLocaleString("id-ID")}`;
    document.querySelector(
        ".total-transaction"
    ).innerText = `Rp. ${total.toLocaleString("id-ID")}`;
    document.querySelector('input[name="total_transaksi"]').value = total;
}

// Fungsi untuk menambah atau mengurangi jumlah item di keranjang
function updateCartItem(id, quantityChange, harga, nama) {
    if (!cart[id]) {
        cart[id] = { harga, quantity: 0, nama };
    }
    cart[id].quantity += quantityChange;

    if (cart[id].quantity <= 0) {
        delete cart[id]; // Hapus item jika jumlahnya 0
    }
    document.querySelector(
        `.menu-item-cart[data-id="${id}"] .qty-numbers`
    ).innerText = cart[id]?.quantity || 0;

    updateCartDisplay();
    updateOrderList();
}

// Event Listener untuk tombol AddtoCart dan RemovetoCart
document.querySelectorAll(".AddtoCart").forEach((button) => {
    button.addEventListener("click", function () {
        const menuItem = this.closest(".menu-item-cart");
        const id = menuItem.dataset.id;
        const harga = parseInt(
            menuItem
                .querySelector(".product h6")
                .innerText.replace(/[Rp. ]/g, "")
        );
        const nama = menuItem.querySelector(".product h5").innerText;

        updateCartItem(id, 1, harga, nama);
    });
});

document.querySelectorAll(".RemovetoCart").forEach((button) => {
    button.addEventListener("click", function () {
        const menuItem = this.closest(".menu-item-cart");
        const id = menuItem.dataset.id;
        const harga = parseInt(
            menuItem
                .querySelector(".product h6")
                .innerText.replace(/[Rp. ]/g, "")
        );
        const nama = menuItem.querySelector(".product h5").innerText;

        updateCartItem(id, -1, harga, nama);
    });
});

// Fungsi untuk menampilkan daftar pesanan di sidebar Pesanan
function updateOrderList() {
    const menuOrder = document.querySelector(".menu-order");
    menuOrder.innerHTML = ""; // Kosongkan isi daftar pesanan

    for (const id in cart) {
        const item = cart[id];
        const orderItem = document.createElement("div");
        orderItem.className = "d-flex justify-content-between text-white";
        orderItem.innerHTML = `
                <span>${item.nama} (x${item.quantity})</span>
                <span>Rp. ${(item.harga * item.quantity).toLocaleString(
                    "id-ID"
                )}</span>
            `;
        menuOrder.appendChild(orderItem);
    }

    // Simpan menu_id ke input hidden
    document.querySelector('input[name="id_menu"]').value =
        JSON.stringify(cart);
}

// Fungsi untuk menghapus semua pesanan dan reset tampilan meja
function deleteOrder() {
    // Kosongkan elemen pesanan dari tampilan
    document.querySelector(".menu-order").innerHTML = "";
    document.querySelector(".tables-selected").innerText = "Meja: ";

    // Reset subtotal dan total transaksi ke 0
    document.querySelector(".sub-total").innerText = "Rp. 0";
    document.querySelector(".total-transaction").innerText = "Rp. 0";
    document.querySelector('input[name="total_transaksi"]').value = 0;

    // Kosongkan variabel `cart`
    for (const id in cart) {
        delete cart[id];
    }

    // Bersihkan input hidden untuk pesanan dan meja
    document.querySelector("#menu_id").value = "";
    document.querySelector("#table_selected").value = "";

    // Reset semua elemen qty-numbers ke 0
    document.querySelectorAll(".qty-numbers").forEach((element) => {
        element.innerText = "0";
    });

    // Hapus pilihan meja jika ada
    if (selectedTable) {
        selectedTable.setAttribute("data-table", "not-selected");
        selectedTable.style.opacity = "1"; // Kembalikan opacity ke default
        selectedTable = null; // Reset variabel meja terpilih
    }
}

// Event Listener untuk tombol bersihkan pesanan
document.querySelector(".fa-broom").addEventListener("click", deleteOrder);

// Event Listener untuk memilih meja
document.querySelectorAll(".table-B").forEach((table) => {
    table.addEventListener("click", function () {
        // Hapus seleksi meja sebelumnya jika ada
        if (selectedTable) {
            selectedTable.setAttribute("data-table", "not-selected");
            selectedTable.style.opacity = "1";
        }

        // Simpan meja yang baru dipilih dan ubah tampilannya
        selectedTable = this;
        selectedTable.setAttribute("data-table", "selected");
        selectedTable.style.opacity = "0.5";

        // Tampilkan meja yang dipilih dan set nilai input hidden
        document.querySelector(
            ".tables-selected"
        ).innerText = `Meja: ${selectedTable.getAttribute("data-number")}`;
        document.querySelector("#table_selected").value =
            selectedTable.getAttribute("data-number");
    });
});

// Function to validate before submitting the order
function validateOrder() {
    // Check if a table is selected
    if (!selectedTable) {
        alert("Silakan pilih meja terlebih dahulu.");
        return false;
    }

    // Check if the cart is empty
    if (Object.keys(cart).length === 0) {
        alert(
            "Keranjang pesanan masih kosong. Silakan tambahkan item ke keranjang."
        );
        return false;
    }

    // If everything is valid, return true to allow form submission
    return true;
}

// Event Listener for the submit button (Order button)
document
    .querySelector(".cart-order")
    .addEventListener("click", function (event) {
        // Validate before proceeding with the form submission
        if (!validateOrder()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });

// Function for clearing the order (deleteOrder) already exists in your code
