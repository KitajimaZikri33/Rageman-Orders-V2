<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rageman Order Menu</title>
    <link rel="stylesheet" href="bootstrap-5.2.3-dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

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

#dataTbl th:first-child {
    text-align: center;
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
<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
            aria-controls="offcanvasDarkNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Rageman Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Kasir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="dapur/dapur.php" class="nav-link">Dapur</a>
                    </li>
                    <li class="nav-item">
                        <a href="dapur/dapur_coffee.php" class="nav-link">Dapur Coffee</a>
                    </li>
                    <li class="nav-item">
                        <a href="dapur/dapur_drink.php" class="nav-link">Dapur Minuman</a>
                    </li>
                </ul>
            </div>
        </div>



    <script src="bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
    <!-- Include jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>

</html>
