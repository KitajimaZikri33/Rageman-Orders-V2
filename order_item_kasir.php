<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rageman Order Menu</title>
    <link rel="stylesheet" href="bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">

</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
#ordersTableBody td:first-child {
    text-align: center;
    font-weight: bold;
}

#ordersTableBody td:last-child {
    text-align: center;
}

#dataTbl th:first-child {
    text-align: center;
}

.catatan-cell {
    white-space: pre-line;
}

.toast-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index_kasir: 9999;
}

/* Tambahkan ini pada file CSS Anda atau dalam tag style di head HTML */
.toast {
    position: fixed;
    top: auto;
    bottom: 0;
    right: 0;
    margin: 0.5rem;
    animation: slide-up 0.3s ease-in-out;
}

.footer {
    background-color: #f8f9fa;
    padding: 1rem 0;
    position: fixed;
    bottom: 0;
    width: 100%;
    text-align: center;
}

.footer p {
    margin: 0;
}

@keyframes slide-up {
    from {
        transform: translateY(100%);
    }

    to {
        transform: translateY(0);
    }
}





table {
    border-collapse: collapse;
    width: 100%;
    border-radius: 5px;
    overflow: hidden;
}

th,
td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

th {
    background-color: #f2f2f2;
}

.table-container {
    overflow-x: auto;
    max-width: 100%;
}

table.rounded {
    border-radius: 10px;
    overflow: hidden;
}
</style>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">RagemanOrders</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="index_kasir.php?x=dashboard"
                        class="sidebar-link <?php echo (isset($_GET['x']) && $_GET['x']== 'dashboard') ? 'active link-info' : 'link-light' ; ?>">
                        <i class="lni lni-user"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="index_kasir.php?x=order"
                        class="sidebar-link <?php echo (isset($_GET['x']) && $_GET['x']== 'order') ? 'active link-info' : 'link-light' ; ?>">
                        <i class="lni lni-agenda"></i>
                        <span>Order</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand-lg"
                style="background-color: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <div class="container-fluid">
                    <span class="" style="color: #0e2238; font-weight: bold;">RAGEMAN RESTO & COFFEE</span>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <a href="#" class="sidebar-link" style="color: #0e2238;" id="logout">
                        <i class="lni lni-exit"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </nav>
            <div class="text-center p-3">


                <?php
                if (isset($_GET["x"]) && $_GET["x"]=='dashboard') {include "dashboard.php";}
                elseif (isset($_GET["x"]) && $_GET["x"]=='order') {include "order.php";}
                ?>


                <div class="container-lg-1">
                    <h5 class="card-title text-start">
                        <a class="btn btn-transparent-dark" href="index_kasir.php?x=order" role="button">
                            <i class="bi bi-caret-left-fill"></i>
                        </a>
                    </h5>
                    <div class="row g-2 mb-2 mt-2">
                        <div class="col-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="orderName" placeholder="name@example.com"
                                    disabled>
                                <label for="floatingInputGrid">Nama Pelanggan</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="orderNomor" placeholder="name@example.com"
                                    disabled>
                                <label for="floatingInputGrid">Nomor Meja</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg">
                            <div class="card">

                                <div class="card-body">

                                    <div class="col-md table-responsive table-container">
                                        <table class="table table-striped align-middle rounded" id="dataTbl">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="col-md-1">No</th>
                                                    <th scope="col">Menu</th>
                                                    <th scope="col">Jumlah porsi</th>
                                                    <th scope="col" class="catatan-cell">Catatan</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" class="col-md-2">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ordersTableBody">
                                                <!-- Data will be inserted here -->
                                            </tbody>
                                            <tfooter>
                                                <th scope="col">Total Harga</th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th id="totalHargaFooter" scope="col"></th>
                                                <th></th>
                                                <th></th>
                                            </tfooter>
                                        </table>







                                        <!-- Modal -->
                                        <div class="modal fade" id="modalBayar" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success text-light">
                                                        <h1 class="modal-title fs-5" id="exampleModalBayar">Pembayaran
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="col-md table-responsive table-container">
                                                            <table class="table align-middle rounded" id="dataTb2">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Menu</th>
                                                                        <th scope="col">Qty</th>
                                                                        <th scope="col">Harga</th>
                                                                        <th scope="col">Total</th>

                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbBayar">

                                                                </tbody>
                                                                <tfooter>
                                                                    <tr>
                                                                        <th scope="col"></th>
                                                                        <th scope="col"></th>
                                                                        <th scope="col"></th>
                                                                        <th scope="col"></th>
                                                                        <th scope="col"></th>
                                                                    </tr>
                                                                    <tr class="table-secondary">
                                                                        <th scope="col">Total Harga</th>
                                                                        <th scope="col"></th>
                                                                        <th scope="col"></th>
                                                                        <th id="total" scope="col"></th>
                                                                        <th id="totalBayar" scope="col" hidden></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr class="table-secondary">
                                                                        <th scope="col">PPN 10%</th>
                                                                        <th scope="col"></th>
                                                                        <th scope="col"></th>
                                                                        <th id="totalHargaPPN" scope="col"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr class="table-secondary">
                                                                        <th scope="col">Total Harga + PPN</th>
                                                                        <th scope="col"></th>
                                                                        <th scope="col"></th>
                                                                        <th id="totalHargaModal" scope="col"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </tfooter>

                                                            </table>
                                                        </div>

                                                        <h4 style="color: red;">Apakah Anda Yakin Ingin Melakukan
                                                            Pembayaran?
                                                        </h4>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="bayar"
                                                                placeholder="name@example.com">
                                                            <label for="bayar">Nominal Bayar</label>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="bayarButton"
                                                            class="btn btn-success">Bayar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCoffee" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info text-light">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row g-2 mb-3">

                                                            <div class="col-md">
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="menuCoffee">
                                                                    <option selected>Menu Pesanan</option>

                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="row g-2">
                                                            <div class="col-md-2">
                                                                <div class="form-floating mb-3">
                                                                    <input type="number" class="form-control" id="porsi"
                                                                        placeholder="name@example.com" value="1">
                                                                    <label for="floatingInput">Jumlah</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control" id="catatan"
                                                                        placeholder="name@example.com">
                                                                    <label for="floatingInput">Catatan</label>
                                                                </div>
                                                            </div>

                                                            <span id="itemName" hidden></span>
                                                            <span type="number" id="itemPrice" hidden></span>
                                                            <input type="text" id="status" hidden></input>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="submitButton"
                                                            class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalDrink" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info text-light">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row g-2 mb-3">

                                                            <div class="col-md">
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="menuDrink">
                                                                    <option selected>Menu Pesanan</option>

                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="row g-2">
                                                            <div class="col-md-2">
                                                                <div class="form-floating mb-3">
                                                                    <input type="number" class="form-control"
                                                                        id="porsi2" placeholder="name@example.com"
                                                                        value="1">
                                                                    <label for="floatingInput">Jumlah</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        id="catatan2" placeholder="name@example.com">
                                                                    <label for="floatingInput">Catatan</label>
                                                                </div>
                                                            </div>

                                                            <span id="itemName2" hidden></span>
                                                            <span type="number" id="itemPrice2" hidden></span>
                                                            <input type="text" id="status2" hidden></input>


                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="submitButton2"
                                                            class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalFood" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info text-light">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row g-2 mb-3">

                                                            <div class="col-md">
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="menuFood">
                                                                    <option selected>Menu Pesanan</option>

                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="row g-2">
                                                            <div class="col-md-2">
                                                                <div class="form-floating mb-3">
                                                                    <input type="number" class="form-control"
                                                                        id="porsi3" placeholder="name@example.com"
                                                                        value="1">
                                                                    <label for="floatingInput">Jumlah</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        id="catatan3" placeholder="name@example.com">
                                                                    <label for="floatingInput">Catatan</label>
                                                                </div>
                                                            </div>

                                                            <span id="itemName3" hidden></span>
                                                            <span type="number" id="itemPrice3" hidden></span>
                                                            <input type="text" id="status3" hidden></input>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="submitButton3"
                                                            class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>





                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="row g-2 mb-2 mt-2">
                                    <div class="col text-start">
                                        <button type="button" class="btn btn-primary" id="printStruk">
                                            <i class="bi bi-printer"></i>
                                            Cetak Struk
                                        </button>
                                    </div>
                                    <div class="col text-end">
                                        <button type="button" class="btn btn-info text-light" data-bs-toggle="modal"
                                            id="addCoffeeButton" data-bs-target="#exampleModalCoffee">
                                            <i class="bi bi-plus-circle-fill"></i>
                                            Add Coffee
                                        </button>

                                        <button type="button" class="btn btn-info text-light" data-bs-toggle="modal"
                                            id="addMinumanButton" data-bs-target="#exampleModalDrink">
                                            <i class="bi bi-plus-circle-fill"></i>
                                            Add Minuman
                                        </button>

                                        <button type="button" class="btn btn-info text-light" data-bs-toggle="modal"
                                            id="addMakananButton" data-bs-target="#exampleModalFood">
                                            <i class="bi bi-plus-circle-fill"></i>
                                            Add Makanan
                                        </button>


                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            id="buttonBayar" data-bs-target="#modalBayar">
                                            <i class="bi bi-cash-coin"></i> Bayar
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php include('script/config_order_item.php') ?>
                    </div>
                </div>


                <div class="toast-container">

                </div>

            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2023 RagemanOrders. | KP60 Universitas Kuningan</p>
        </div>
    </footer>

    <script type="module">
    import {
        getAuth,
        signOut
    } from "https://www.gstatic.com/firebasejs/9.8.2/firebase-auth.js";
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.8.2/firebase-app.js";

    const firebaseConfig = {
        apiKey: "AIzaSyCl187TfdE2U96gwo_Wg7HToa0YmRV5wWk",
        authDomain: "rageman-orders.firebaseapp.com",
        databaseURL: "https://rageman-orders-default-rtdb.firebaseio.com",
        projectId: "rageman-orders",
        storageBucket: "rageman-orders.appspot.com",
        messagingSenderId: "998695493444",
        appId: "1:998695493444:web:a10201af4430f73e414111"
    };


    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    let logoutButton = document.getElementById("logout");
    console.log(logoutButton);

    logoutButton.addEventListener("click", (e) => {
        const auth = getAuth(app);
        signOut(auth)
            .then(() => {

                Swal.fire({
                    title: "Apakah kamu yakin?",
                    text: "Apakah kamu yakin ingin keluar dari halaman?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "index.php?#";
                    }
                });

            })
            .catch((error) => {});
    });
    </script>


    <script src="script.js"></script>
    <script src="bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
    <!-- Include jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>

</html>