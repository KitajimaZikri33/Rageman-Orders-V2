<script type="module">
<?php include('./firebase.js') ?>



function fetchDataAndUpdateOptions() {

    const menuSelect = document.getElementById('menuCoffee');
    const menuSelect2 = document.getElementById('menuDrink');
    const menuSelect3 = document.getElementById('menuFood');

    menuSelect.innerHTML = '<option selected disabled>Menu Pesanan</option>';
    menuSelect2.innerHTML = '<option selected disabled>Menu Pesanan</option>';
    menuSelect3.innerHTML = '<option selected disabled>Menu Pesanan</option>';



    // Fetch data from Firebase for 'menu'
    const menuRef = ref(database, 'coffee');
    onValue(menuRef, (snapshot) => {
        snapshot.forEach((childSnapshot) => {
            const menuKey = childSnapshot.key;
            const menuValue = childSnapshot.val().Name;
            const option = document.createElement('option');
            option.value = menuKey;
            option.text = menuValue;
            menuSelect.appendChild(option);
        });
    });

    const menuRef2 = ref(database, 'drink');
    onValue(menuRef2, (snapshot) => {
        snapshot.forEach((childSnapshot) => {
            const menuKey = childSnapshot.key;
            const menuValue = childSnapshot.val().Name;
            const option = document.createElement('option');
            option.value = menuKey;
            option.text = menuValue;
            menuSelect2.appendChild(option);
        });
    });

    const menuRef3 = ref(database, 'food');
    onValue(menuRef3, (snapshot) => {
        snapshot.forEach((childSnapshot) => {
            const menuKey = childSnapshot.key;
            const menuValue = childSnapshot.val().Name;
            const option = document.createElement('option');
            option.value = menuKey;
            option.text = menuValue;
            menuSelect3.appendChild(option);
        });
    });
}

//input coffee//
function handleSelectChange() {
    console.log('Select change event triggered');
    const selectedItemKey = this.value;
    console.log('Selected Item Key:', selectedItemKey);

    const selectedItemRef = ref(database, `coffee/${selectedItemKey}`);
    get(selectedItemRef).then(snapshot => {
        const selectedItemData = snapshot.val();
        console.log('Selected Item Data:', selectedItemData);

        if (selectedItemData) {
            document.getElementById('itemName').textContent = selectedItemData.Name;
            document.getElementById('itemPrice').textContent = selectedItemData.Price;

            $('#exampleModalCoffee').modal('show');
        }
    });
}

//input drink//
function handleSelectChange2() {
    console.log('Select change event triggered');
    const selectedItemKey = this.value;
    console.log('Selected Item Key:', selectedItemKey);

    const selectedItemRef = ref(database, `drink/${selectedItemKey}`);
    get(selectedItemRef).then(snapshot => {
        const selectedItemData = snapshot.val();
        console.log('Selected Item Data:', selectedItemData);

        if (selectedItemData) {
            document.getElementById('itemName2').textContent = selectedItemData.Name;
            document.getElementById('itemPrice2').textContent = selectedItemData.Price;

            $('#exampleModalDrink').modal('show');
        }
    });
}

//input food//
function handleSelectChange3() {
    console.log('Select change event triggered');
    const selectedItemKey = this.value;
    console.log('Selected Item Key:', selectedItemKey);

    const selectedItemRef = ref(database, `food/${selectedItemKey}`);
    get(selectedItemRef).then(snapshot => {
        const selectedItemData = snapshot.val();
        console.log('Selected Item Data:', selectedItemData);

        if (selectedItemData) {
            document.getElementById('itemName3').textContent = selectedItemData.Name;
            document.getElementById('itemPrice3').textContent = selectedItemData.Price;

            $('#exampleModalFood').modal('show');
        }
    });
}

document.getElementById('submitButton').addEventListener('click', function() {
    const itemName = document.getElementById('itemName').textContent;
    const itemPrice = document.getElementById('itemPrice').textContent;
    const jumlahPorsi = document.getElementById('porsi').value;
    const catatan = document.getElementById('catatan').value;
    const status = document.getElementById('status').value;

    const selectedItemKey = document.getElementById('menuCoffee').value;

    // Dapatkan orderId dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('orderId');

    if (orderId) {
        // Jika orderId ada, simpan pesanan di bawah orderId tersebut
        const orderItemRef = ref(database, `orders/${orderId}/order_item`);
        const newOrderItemRef = push(orderItemRef);

        set(newOrderItemRef, {
            itemName: itemName,
            itemPrice: itemPrice,
            jumlahPorsi: jumlahPorsi,
            catatan: catatan,
            status: status,
            selectedItemKey: selectedItemKey
        }).then(() => {
            document.getElementById('porsi').value = '1';
            document.getElementById('catatan').value = '';
            document.getElementById('menuCoffee').value = 'Menu Pesanan';

            $('#exampleModalCoffee').modal('hide');
        }).catch((error) => {
            console.error("Error saving order item: ", error);
        });
    } else {
        console.error('No orderId provided in the URL.');
    }
});


//submit drink//
document.getElementById('submitButton2').addEventListener('click', function() {
    const itemName2 = document.getElementById('itemName2').textContent;
    const itemPrice = document.getElementById('itemPrice2').textContent;
    const jumlahPorsi2 = document.getElementById('porsi2').value;
    const catatan2 = document.getElementById('catatan2').value;
    const status2 = document.getElementById('status2').value;

    const selectedItemKey2 = document.getElementById('menuDrink').value;

    // Dapatkan orderId dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('orderId');

    const orderRef = ref(database, `orders/${orderId}/order_item`);
    const newOrderRef = push(orderRef);

    set(newOrderRef, {
        itemName2: itemName2,
        itemPrice: itemPrice,
        jumlahPorsi2: jumlahPorsi2,
        catatan2: catatan2,
        status2: status2,
        selectedItemKey2: selectedItemKey2
    }).then(() => {

        document.getElementById('porsi2').value = '1';
        document.getElementById('catatan2').value = '';
        document.getElementById('menuDrink').value = 'Menu Pesanan';
        document.getElementById('status2').value = '';


        $('#exampleModalDrink').modal('hide');

    }).catch((error) => {
        console.error("Error saving order: ", error);
    });
});

//submit food//
document.getElementById('submitButton3').addEventListener('click', function() {
    const itemName3 = document.getElementById('itemName3').textContent;
    const itemPrice = document.getElementById('itemPrice3').textContent;
    const jumlahPorsi3 = document.getElementById('porsi3').value;
    const catatan3 = document.getElementById('catatan3').value;
    const status3 = document.getElementById('status3').value;

    const selectedItemKey3 = document.getElementById('menuFood').value;

    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('orderId');

    const orderRef = ref(database, `orders/${orderId}/order_item`);
    const newOrderRef = push(orderRef);

    set(newOrderRef, {
        itemName3: itemName3,
        itemPrice: itemPrice,
        jumlahPorsi3: jumlahPorsi3,
        catatan3: catatan3,
        status3: status3,
        selectedItemKey3: selectedItemKey3
    }).then(() => {

        document.getElementById('porsi3').value = '1';
        document.getElementById('catatan3').value = '';
        document.getElementById('menuFood').value = 'Menu Pesanan';


        $('#exampleModalFood').modal('hide');

    }).catch((error) => {
        console.error("Error saving order: ", error);
    });
});

const getData = () => {
    const dataTable = $('#ordersTableBody');
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('orderId');

    if (!orderId) {
        console.error('Order ID not found in the URL.');
        return;
    }

    dataTable.empty();
    const dbRef = ref(database, 'orders/' + orderId + '/order_item');

    onValue(dbRef, (snapshot) => {
        $('#ordersTableBody tr').remove();
        let rowNum = 1;

        snapshot.forEach((orderItemSnapshot) => {
            const orderItemId = orderItemSnapshot.key;
            const orderItemData = orderItemSnapshot.val();

            // Check if required properties exist
            if (
                orderItemData.hasOwnProperty('itemName') &&
                orderItemData.hasOwnProperty('jumlahPorsi') &&
                orderItemData.hasOwnProperty('catatan') &&
                orderItemData.hasOwnProperty('itemPrice')
            ) {
                const harga = parseFloat(orderItemData.itemPrice);
                const jumlahPorsi = parseInt(orderItemData.jumlahPorsi);
                const totalHarga = harga * jumlahPorsi;

                const formattedHarga = harga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });

                const formattedTotalHarga = totalHarga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                var badgeClass = orderItemData.status === 'Masuk Dapur' ? 'bg-warning' :
                    orderItemData.status === 'Siap Disajikan' ? 'bg-primary' : '';
                const row = `
        <tr data-key="${orderItemId}" data-name="${orderItemData.itemName}" data-nomor="${orderItemData.itemPrice}" data-time="${orderItemData.jumlahPorsi}" data-time="${orderItemData.catatan}" data-status="${orderItemData.status}">
        <td>${rowNum}</td>
        <td>${orderItemData.itemName}</td>
        <td>${orderItemData.jumlahPorsi}</td>
        <td>${orderItemData.catatan}</td>
        <td>${formattedHarga}</td>
        <td>${formattedTotalHarga}</td>
        <td>
        <span class="badge ${badgeClass}">${orderItemData.status}</span>
        </td>
        <td class="d-flex">
        <!-- ... -->
        <button id="delete1" class="btn btn-danger me-1" onclick="deleteData(this)">
        <i class="bi bi-trash3"></i>
        </button>
        </td>
        </tr>`;

                $(row).appendTo('#ordersTableBody');

                //updateTotalHarga();
                //if (orderItemData.status === 'Siap Disajikan') {
                //showNotification(orderItemData.itemName);
                //} else {

                //}


                rowNum++;
            } else if (
                orderItemData.hasOwnProperty('itemName2') &&
                orderItemData.hasOwnProperty('jumlahPorsi2') &&
                orderItemData.hasOwnProperty('catatan2') &&
                orderItemData.hasOwnProperty('itemPrice')
            ) {
                const harga = parseFloat(orderItemData.itemPrice);
                const jumlahPorsi = parseInt(orderItemData.jumlahPorsi2);
                const totalHarga = harga * jumlahPorsi;

                const formattedHarga = harga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });

                const formattedTotalHarga = totalHarga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                var badgeClass = orderItemData.status2 === 'Masuk Dapur' ? 'bg-warning' :
                    orderItemData.status2 === 'Siap Disajikan' ? 'bg-primary' : '';
                const row2 = `
        <tr data-key="${orderItemId}" data-name="${orderItemData.itemName2}" data-nomor="${orderItemData.itemPrice}" data-time="${orderItemData.jumlahPorsi2}" data-catatan="${orderItemData.catatan2}" data-status="${orderItemData.status2}">
        <td>${rowNum}</td>
        <td>${orderItemData.itemName2}</td>
        <td>${orderItemData.jumlahPorsi2}</td>
        <td>${orderItemData.catatan2}</td>
        <td>${formattedHarga}</td>
        <td>${formattedTotalHarga}</td>
        <td>
        <span class="badge ${badgeClass}">${orderItemData.status2}</span>
        </td>
        <td class="d-flex">
        <!-- ... -->
        <button id="delete2" class="btn btn-danger me-1" onclick="deleteData(this)">
        <i class="bi bi-trash3"></i>
        </button>
        </td>
        </tr>`;

                $(row2).appendTo('#ordersTableBody');

                updateTotalHarga();

                rowNum++;
            } else if (
                orderItemData.hasOwnProperty('itemName3') &&
                orderItemData.hasOwnProperty('jumlahPorsi3') &&
                orderItemData.hasOwnProperty('catatan3') &&
                orderItemData.hasOwnProperty('itemPrice')
            ) {
                const harga = parseFloat(orderItemData.itemPrice);
                const jumlahPorsi = parseInt(orderItemData.jumlahPorsi3);
                const totalHarga = harga * jumlahPorsi;

                const formattedHarga = harga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });

                const formattedTotalHarga = totalHarga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                var badgeClass = orderItemData.status3 === 'Masuk Dapur' ? 'bg-warning' :
                    orderItemData.status3 === 'Siap Disajikan' ? 'bg-primary' : '';
                const row3 = `
        <tr data-key="${orderItemId}" data-name="${orderItemData.itemName3}" data-nomor="${orderItemData.itemPrice}" data-time="${orderItemData.jumlahPorsi3}" data-catatan="${orderItemData.catatan3}" data-status="${orderItemData.status3}">
        <td>${rowNum}</td>
        <td>${orderItemData.itemName3}</td>
        <td>${orderItemData.jumlahPorsi3}</td>
        <td>${orderItemData.catatan3}</td>
        <td>${formattedHarga}</td>
        <td>${formattedTotalHarga}</td>
        <td>
        <span class="badge ${badgeClass}">${orderItemData.status3}</span>
        </td>
        <td class="d-flex">
        <!-- ... -->
        <button id="delete3" class="btn btn-danger me-1" onclick="deleteData(this)">
        <i class="bi bi-trash3"></i>
        </button>
        </td>
        </tr>`;

                $(row3).appendTo('#ordersTableBody');

                updateTotalHarga();

                rowNum++;
            }
        });
    });
};

// Call the function to fetch data based on the orderId from the URL
getData();


// Simpan daftar pesan yang telah ditampilkan
const displayedMessages = [];

function showNotification(itemName, itemId) {
    const message = `${itemName} sudah siap disajikan!`;

    // Periksa apakah pesan sudah ditampilkan sebelumnya
    if (displayedMessages.includes(message)) {
        return; // Jangan tampilkan toast baru jika pesan sudah ada
    }

    // Tambahkan pesan ke daftar yang telah ditampilkan
    displayedMessages.push(message);

    // Buat elemen toast baru secara dinamis
    const toastElement = document.createElement('div');
    toastElement.classList.add('toast', 'role-alert', 'aria-live-assertive', 'aria-atomic-true');
    toastElement.innerHTML = `

      <div class="toast-header">
        <img src="..." class="rounded me-2" alt="...">
        <strong class="me-auto">Notification</strong>
        <small>Now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body" id="notificationMessage">
      ${message}
      </div>
      <button type="button" class="btn btn-success accept-button" style="margin-left: 10px; margin-bottom: 10px;">Accept</button>

  `;

    // Tambahkan elemen toast ke dalam container toast
    document.body.appendChild(toastElement);

    // Inisialisasi objek toast dengan menggunakan Bootstrap Toast API
    const toast = new bootstrap.Toast(toastElement);

    // Tambahkan event listener untuk menghapus elemen toast setelah tertutup
    toastElement.addEventListener('hidden.bs.toast', function() {
        // Hapus pesan dari daftar yang telah ditampilkan
        const index = displayedMessages.indexOf(message);
        if (index !== -1) {
            displayedMessages.splice(index, 1);
        }

        // Hapus elemen toast dari DOM
        document.body.removeChild(toastElement);
    });

    // Tampilkan toast
    toast.show();

    // Tampilkan notifikasi suara
    const audio = new Audio('./sound/bell_small.mp3');
    audio.play();
}




const deleteData = (button) => {
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('orderId');
    console.log('Delete button clicked');

    // Tampilkan pesan konfirmasi penghapusan dengan SweetAlert2
    Swal.fire({
        icon: 'warning',
        title: 'Konfirmasi Penghapusan',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-danger', // Untuk menyesuaikan tombol "Ya"
        cancelButtonClass: 'btn btn-secondary', // Untuk menyesuaikan tombol "Batal"
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        customClass: {
            title: 'alert-title', // Kelas kustom untuk judul
            content: 'alert-text' // Kelas kustom untuk teks
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const row = button.closest('tr');
            const orderItemId = row.dataset.key; // Assuming that data-key contains the orderItemId

            const dbRef = ref(database, 'orders/' + orderId + '/order_item/' + orderItemId);

            remove(dbRef)
                .then(() => {
                    console.log('Data deleted successfully');

                    // Tampilkan pesan bahwa penghapusan berhasil menggunakan SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Penghapusan berhasil!',
                        text: 'Data berhasil dihapus.',
                        confirmButtonClass: 'btn btn-success',
                        customClass: {
                            title: 'alert-title',
                            content: 'alert-text'
                        }
                    });

                    getData(); // Refresh the data after deletion
                })
                .catch((error) => {
                    console.error("Error deleting data: ", error);
                });
        }
    });
};




const updateTotalHarga = () => {
    console.log('Updating total harga...');
    const dataTable = $('#ordersTableBody');
    let jmlHarga = 0;

    dataTable.find('tr').each((index, row) => {
        const itemPriceText = $(row).find('td:nth-child(6)').text().trim();
        const jumlahPorsiText = $(row).find('td:nth-child(3)').text().trim();

        // Menghapus karakter 'Rp', mengganti '.' dengan '', dan mengganti ',' dengan '.'
        const cleanedItemPriceText = itemPriceText.replace('Rp', '').replace('.', '').replace(',', '.');


        // Mengubah teks menjadi angka
        const itemPrice = parseFloat(cleanedItemPriceText);
        const jumlahPorsi = parseInt(jumlahPorsiText);

        // Memeriksa apakah nilai valid atau tidak
        if (!isNaN(itemPrice) && !isNaN(jumlahPorsi)) {
            jmlHarga += itemPrice;
        } else {
            console.error(`Invalid values: itemPrice=${itemPrice}, jumlahPorsi=${jumlahPorsi}`);
        }
    });

    // Update total harga di footer
    $('#totalHargaFooter').text(jmlHarga.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }));
};

// Panggil fungsi saat data berubah atau diupdate
onValue(ref(database, 'order_item/'), () => {
    getData();
    updateTotalHarga();
});





const urlParams = new URLSearchParams(window.location.search);
const orderId = urlParams.get('orderId');
const name = decodeURIComponent(urlParams.get('Name'));
const nomor = decodeURIComponent(urlParams.get('Nomor'));

if (orderId && name && nomor) {
    const floatingNameInput = document.getElementById('orderName');
    const floatingNomorInput = document.getElementById('orderNomor');

    floatingNameInput.value = name;
    floatingNomorInput.value = nomor;
} else {
    // Jika orderId, name, atau nomor tidak ditemukan, tampilkan pesan kesalahan
    const floatingNameInput = document.getElementById('orderName');
    floatingNameInput.value = 'Error: Nama tidak diinputkan';

    const floatingNomorInput = document.getElementById('orderNomor');
    floatingNomorInput.value = 'Error: Nomor meja tidak diinputkan';
}


const getDataBayar = () => {
    const dataTable = $('#tbBayar');
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('orderId');

    if (!orderId) {
        console.error('Order ID not found in the URL.');
        return;
    }

    dataTable.empty();
    const dbRef = ref(database, 'orders/' + orderId + '/order_item');

    onValue(dbRef, (snapshot) => {
        $('#tbBayar tr').remove();

        snapshot.forEach((orderItemSnapshot) => {
            const orderItemId = orderItemSnapshot.key;
            const orderItemData = orderItemSnapshot.val();

            // Check if required properties exist
            if (
                orderItemData.hasOwnProperty('itemName') &&
                orderItemData.hasOwnProperty('jumlahPorsi') &&
                orderItemData.hasOwnProperty('catatan') &&
                orderItemData.hasOwnProperty('itemPrice')
            ) {
                const harga = parseFloat(orderItemData.itemPrice);
                const jumlahPorsi = parseInt(orderItemData.jumlahPorsi);
                const totalHarga = harga * jumlahPorsi;
                const hargaPpn = totalHarga * 0.10 + totalHarga;

                const formattedHarga = harga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });

                const formattedTotalHarga = totalHarga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                const formattePPN = hargaPpn.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                const row = `
        <tr data-key="${orderItemId}" data-name="${orderItemData.itemName}" data-nomor="${orderItemData.itemPrice}" data-time="${orderItemData.jumlahPorsi}" data-time="${orderItemData.catatan}" data-status="${orderItemData.status}">
        <td>${orderItemData.itemName}</td>
        <td>${orderItemData.jumlahPorsi}</td>
        <td>${formattedHarga}</td>
        <td>${formattedTotalHarga}</td>
        <td hidden>${formattePPN}<td>
        </tr>`;

                $(row).appendTo('#tbBayar');

                updateTotalHargaBayar();
                updateTotalHargaBayar2();
                updateTotalHargaBayar3();

            } else if (
                orderItemData.hasOwnProperty('itemName2') &&
                orderItemData.hasOwnProperty('jumlahPorsi2') &&
                orderItemData.hasOwnProperty('catatan2') &&
                orderItemData.hasOwnProperty('itemPrice')
            ) {
                const harga = parseFloat(orderItemData.itemPrice);
                const jumlahPorsi = parseInt(orderItemData.jumlahPorsi2);
                const totalHarga = harga * jumlahPorsi;
                const hargaPpn = totalHarga * 0.10 + totalHarga;

                const formattedHarga = harga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });

                const formattedTotalHarga = totalHarga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                const formattePPN = hargaPpn.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                const row2 = `
        <tr data-key="${orderItemId}" data-name="${orderItemData.itemName2}" data-nomor="${orderItemData.itemPrice}" data-time="${orderItemData.jumlahPorsi2}" data-catatan="${orderItemData.catatan2}" data-status="${orderItemData.status2}">
        <td>${orderItemData.itemName2}</td>
        <td>${orderItemData.jumlahPorsi2}</td>
        <td>${formattedHarga}</td>
        <td>${formattedTotalHarga}</td>
        <td hidden>${formattePPN}<td>
        </td>
        </tr>`;

                $(row2).appendTo('#tbBayar');

                updateTotalHargaBayar();
                updateTotalHargaBayar2();
                updateTotalHargaBayar3();

            } else if (
                orderItemData.hasOwnProperty('itemName3') &&
                orderItemData.hasOwnProperty('jumlahPorsi3') &&
                orderItemData.hasOwnProperty('catatan3') &&
                orderItemData.hasOwnProperty('itemPrice')
            ) {
                const harga = parseFloat(orderItemData.itemPrice);
                const jumlahPorsi = parseInt(orderItemData.jumlahPorsi3);
                const totalHarga = harga * jumlahPorsi;
                const hargaPpn = totalHarga * 0.10 + totalHarga;

                const formattedHarga = harga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });

                const formattedTotalHarga = totalHarga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });

                const formattePPN = hargaPpn.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                const row3 = `
        <tr data-key="${orderItemId}" data-name="${orderItemData.itemName3}" data-nomor="${orderItemData.itemPrice}" data-time="${orderItemData.jumlahPorsi3}" data-catatan="${orderItemData.catatan3}">
        <td>${orderItemData.itemName3}</td>
        <td>${orderItemData.jumlahPorsi3}</td>
        <td>${formattedHarga}</td>
        <td>${formattedTotalHarga}</td>
        <td hidden>${formattePPN}<td>
        </tr>`;

                $(row3).appendTo('#tbBayar');

                updateTotalHargaBayar();
                updateTotalHargaBayar2();
                updateTotalHargaBayar3();
            }
        });
    });
};


getDataBayar();


const updateTotalHargaBayar = () => {
    console.log('Updating total harga...');
    const dataTable = $('#tbBayar');
    let jmlHarga = 0;

    dataTable.find('tr').each((index, row) => {
        const itemPriceText = $(row).find('td:nth-child(5)').text().trim();
        const jumlahPorsiText = $(row).find('td:nth-child(2)').text().trim();

        // Menghapus karakter 'Rp', mengganti '.' dengan '', dan mengganti ',' dengan '.'
        const cleanedItemPriceText = itemPriceText.replace('Rp', '').replace('.', '').replace(',', '.');


        // Mengubah teks menjadi angka
        const itemPrice = parseFloat(cleanedItemPriceText);
        const jumlahPorsi = parseInt(jumlahPorsiText);

        // Memeriksa apakah nilai valid atau tidak
        if (!isNaN(itemPrice) && !isNaN(jumlahPorsi)) {
            jmlHarga += itemPrice;
        } else {
            console.error(`Invalid values: itemPrice=${itemPrice}, jumlahPorsi=${jumlahPorsi}`);
        }
    });
    $('#totalBayar').text(jmlHarga);


    // Update total harga di footer
    $('#totalHargaModal').text(jmlHarga.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }));
};


const updateTotalHargaBayar2 = () => {
    console.log('Updating total harga...');
    const dataTable = $('#tbBayar');
    let jmlHarga = 0;

    dataTable.find('tr').each((index, row) => {
        const itemPriceText = $(row).find('td:nth-child(4)').text().trim();
        const jumlahPorsiText = $(row).find('td:nth-child(2)').text().trim();

        // Menghapus karakter 'Rp', mengganti '.' dengan '', dan mengganti ',' dengan '.'
        const cleanedItemPriceText = itemPriceText.replace('Rp', '').replace('.', '').replace(',', '.');


        // Mengubah teks menjadi angka
        const itemPrice = parseFloat(cleanedItemPriceText);
        const jumlahPorsi = parseInt(jumlahPorsiText);

        // Memeriksa apakah nilai valid atau tidak
        if (!isNaN(itemPrice) && !isNaN(jumlahPorsi)) {
            jmlHarga += itemPrice;
        } else {
            console.error(`Invalid values: itemPrice=${itemPrice}, jumlahPorsi=${jumlahPorsi}`);
        }
    });
    $('#total').text(jmlHarga);


    // Update total harga di footer
    $('#total').text(jmlHarga.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }));
};


const updateTotalHargaBayar3 = () => {
    console.log('Updating total harga...');
    const dataTable = $('#tbBayar');
    let jmlHarga = 0;

    dataTable.find('tr').each((index, row) => {
        const itemPriceText = $(row).find('td:nth-child(4)').text().trim();
        const jumlahPorsiText = $(row).find('td:nth-child(2)').text().trim();

        // Menghapus karakter 'Rp', mengganti '.' dengan '', dan mengganti ',' dengan '.'
        const cleanedItemPriceText = itemPriceText.replace('Rp', '').replace('.', '').replace(',', '.');


        // Mengubah teks menjadi angka
        const itemPrice = parseFloat(cleanedItemPriceText);
        const jumlahPorsi = parseInt(jumlahPorsiText);

        // Memeriksa apakah nilai valid atau tidak
        if (!isNaN(itemPrice) && !isNaN(jumlahPorsi)) {
            jmlHarga += itemPrice * 0.10;
        } else {
            console.error(`Invalid values: itemPrice=${itemPrice}, jumlahPorsi=${jumlahPorsi}`);
        }
    });
    $('#totalHargaPPN').text(jmlHarga);


    // Update total harga di footer
    $('#totalHargaPPN').text(jmlHarga.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }));
};

// Panggil fungsi saat data berubah atau diupdate
onValue(ref(database, 'order_item/'), () => {
    getDataBayar();
    updateTotalHargaBayar();
    updateTotalHargaBayar2();
    updateTotalHargaBayar3();
});


function cetakStruk() {
    var namaPelanggan = $('#orderName').val();
    var kontenStruk = $('#dataTb2').clone();
    var divStruk = $('<div id="strukCetak"></div>');

    var tanggalWaktu = new Date();
    var tanggalCetak = tanggalWaktu.toLocaleDateString();
    var waktuCetak = tanggalWaktu.toLocaleTimeString([], {
        hour12: false
    });


    divStruk.append('<div class="row">');
    divStruk.append('<div class="col">');
    divStruk.append('<p style="text-align: right;">' + tanggalCetak + ' - ' + waktuCetak + '</p>');
    divStruk.append('</div>');
    divStruk.append('<div class="col">');
    divStruk.append('<p style="text-align: left;">Name : ' + namaPelanggan + '</p>');
    divStruk.append('</div>');
    divStruk.append('</div>');


    divStruk.append(kontenStruk);

    var jendelaCetak = window.open('', '_blank');

    jendelaCetak.document.write(
        '<html><head><title>Pembayaran</title><link <link rel="stylesheet" href="bootstrap-5.2.3-dist/css/bootstrap.min.css"></head><body>'
    );
    jendelaCetak.document.write('<h1 style="text-align: center; font-weight: bold;"><br>RAGEMAN RESTO & COFFEE</h1>');
    jendelaCetak.document.write(
        '<p style="text-align: center;">Gunungkeling, Cigugur, Kuningan, Jawa Barat<br> Telp: 0822-1833-3364</p>')
    jendelaCetak.document.write('<hr style="">');
    jendelaCetak.document.write(divStruk.html());
    jendelaCetak.document.write('<br>');
    jendelaCetak.document.write('<h2 style="text-align: center;">TERIMA KASIH <br> TELAH BERKUNJUNG</h2>');
    jendelaCetak.document.write('</body></html>');

    jendelaCetak.document.close();
    jendelaCetak.print();

    jendelaCetak.onafterprint = function() {
        jendelaCetak.close();
    };
}


function prosesPembayaran() {

    cetakStruk();
}


$('#bayarButton').on('click', function() {
    const nominalBayar = parseFloat($('#bayar').val());
    const totalHargaModal = parseFloat($('#totalBayar').text().replace(/[^0-9.-]+/g, ''));
    if (nominalBayar >= totalHargaModal) {
        disableButtons();
        const urlParams = new URLSearchParams(window.location.search);
        const orderId = urlParams.get('orderId');
        const dbRef = ref(database, 'orders/' + orderId);
        update(dbRef, {
            status: 'Success'
        });
        const kembalian = nominalBayar - totalHargaModal;
        const formattedKembalian = kembalian.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR',
        });
        Swal.fire({
            icon: 'success',
            title: 'Pembayaran berhasil!',
            text: 'Kembalian : ' + formattedKembalian,
            confirmButtonClass: 'btn btn-success', // Untuk menyesuaikan tombol OK
            customClass: {
                title: 'alert-title', // Kelas kustom untuk judul
                content: 'alert-text' // Kelas kustom untuk teks
            }
        });

        $('#modalBayar').modal('hide');

    } else {
        Swal.fire({
            icon: 'error',
            title: 'Pembayaran Gagal',
            text: 'Maaf, nominal bayar kurang dari total harga. Pembayaran tidak berhasil.',
            confirmButtonClass: 'btn btn-danger',
            customClass: {
                title: 'alert-title',
                content: 'alert-text'
            }
        });

    }
});

function disableButtons() {
    $('#addCoffeeButton').prop('disabled', true);
    $('#addMinumanButton').prop('disabled', true);
    $('#addMakananButton').prop('disabled', true);
    $('#buttonBayar').prop('disabled', true);


    localStorage.setItem('buttonsDisabled', 'true');
}

$('#printStruk').on('click', function() {
    prosesPembayaran();
});





$(document).ready(function() {
    $('#ordersTableBody').on('click', '.btn-danger', function() {
        deleteData(this);
    });


});

document.addEventListener('DOMContentLoaded', fetchDataAndUpdateOptions);

document.getElementById('menuCoffee').addEventListener('change', handleSelectChange);
document.getElementById('menuDrink').addEventListener('change', handleSelectChange2);
document.getElementById('menuFood').addEventListener('change', handleSelectChange3);
</script>