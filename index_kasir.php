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
#dataTblBody td:first-child {
    text-align: center;
    font-weight: bold;
}

#dataTblBody td:last-child {
    text-align: center;
}

#dataTblBody td:nth-child(5) {
    text-align: center;
}

#dataTblBody td:nth-child(6) {
    text-align: center;
}

#dataTbl th:first-child {
    text-align: center;
}

#dataTbl th:nth-child(5) {
    text-align: center;
}

#dataTbl th:nth-child(6) {
    text-align: center;
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
                if (isset($_GET["x"]) && $_GET["x"]=='dashboard') {include "dashboard_kasir.php";}
                elseif (isset($_GET["x"]) && $_GET["x"]=='order') {include "order_kasir.php";}
                ?>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</body>

</html>