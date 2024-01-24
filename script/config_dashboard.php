<script type="module">
<?php include('./firebase.js') ?>

const dbRef = ref(database, 'orders');
const successOrderCountSpan = document.getElementById('successOrderCount');
const successTotalCount = document.getElementById('successTotalCount');
const successOngoingCount = document.getElementById('successOngoingCount');

onValue(dbRef, (snapshot) => {
    let totalOrders = 0; // Inisialisasi jumlah total pesanan
    let successOrderCount = 0; // Inisialisasi jumlah pesanan sukses
    let ongoingOrderCount = 0;

    snapshot.forEach((childSnapshot) => {
        // Ambil data dari setiap pesanan
        const childData = childSnapshot.val();

        // Periksa status pesanan, jika "Success" tambahkan ke jumlah sukses
        if (childData.status === 'Success') {
            successOrderCount++;
        } else if (childData.status === 'Ongoing') {
            ongoingOrderCount++;
        }
        // Tambahkan ke jumlah total pesanan
        totalOrders++;
    });

    console.log(`Total Orders: ${totalOrders}`);
    console.log(`Success Orders: ${successOrderCount}`);

    // Tampilkan jumlah pesanan sukses pada elemen span
    successOrderCountSpan.textContent = successOrderCount.toString();
    successTotalCount.textContent = totalOrders.toString();
    successOngoingCount.textContent = ongoingOrderCount.toString();
});

let totalOrderItemCount = 0;
let masukDapurItemCount = 0;
let siapDisajikanItemCount = 0;

onValue(dbRef, (snapshot) => {
    snapshot.forEach((orderSnapshot) => {
        const orderData = orderSnapshot.val();

        // Periksa apakah order memiliki properti order_item
        if (orderData.order_item) {
            // Iterasi melalui setiap order_item pada pesanan
            totalOrderItemCount += Object.keys(orderData.order_item).length;
            Object.values(orderData.order_item).forEach((orderItem) => {
                // Periksa status order_item
                switch (orderItem.status) {
                    case "Masuk Dapur":
                        masukDapurItemCount++;
                        break;
                    case "Siap Disajikan":
                        siapDisajikanItemCount++;
                        break;
                    // Tambahkan kasus lain jika diperlukan
                }
                switch (orderItem.status2) {
                    case "Masuk Dapur":
                        masukDapurItemCount++;
                        break;
                    case "Siap Disajikan":
                        siapDisajikanItemCount++;
                        break;
                    // Tambahkan kasus lain jika diperlukan
                }
                switch (orderItem.status3) {
                    case "Masuk Dapur":
                        masukDapurItemCount++;
                        break;
                    case "Siap Disajikan":
                        siapDisajikanItemCount++;
                        break;
                    // Tambahkan kasus lain jika diperlukan
                }
            });
        }
    });

    // Tampilkan hasilnya di dalam elemen HTML yang diinginkan
    document.getElementById('totalOrderItemCount').textContent = totalOrderItemCount;
    document.getElementById('masukDapurItemCount').textContent = masukDapurItemCount;
    document.getElementById('siapDisajikanItemCount').textContent = siapDisajikanItemCount;
});


const drinkRef = ref(database, 'drink');
let totalDrinkCount = 0;
onValue(drinkRef, (snapshot) => {
    snapshot.forEach((drinkSnapshot) => {
        // Setiap item pada tabel drink dihitung sebagai satu data
        totalDrinkCount++;
    });

    // Tampilkan hasilnya di dalam elemen HTML yang diinginkan
    document.getElementById('totalDrinkCount').textContent = totalDrinkCount;
});

const coffeeRef = ref(database, 'coffee');
let totalCoffeeCount = 0;
onValue(coffeeRef, (snapshot) => {
    snapshot.forEach((coffeeSnapshot) => {
        // Setiap item pada tabel drink dihitung sebagai satu data
        totalCoffeeCount++;
    });

    // Tampilkan hasilnya di dalam elemen HTML yang diinginkan
    document.getElementById('totalCoffeeCount').textContent = totalCoffeeCount;
});

const foodRef = ref(database, 'food');
let totalFoodCount = 0;
onValue(foodRef, (snapshot) => {
    snapshot.forEach((coffeeSnapshot) => {
        // Setiap item pada tabel drink dihitung sebagai satu data
        totalFoodCount++;
    });

    // Tampilkan hasilnya di dalam elemen HTML yang diinginkan
    document.getElementById('totalFoodCount').textContent = totalFoodCount;
});

</script>