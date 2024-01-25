<h1 class="card-title mb-2 text-start" style="color: #0e2238;">Dashboard</h1>
<div class="row mb-5">
    <div class="col-lg">

        <div class="card">
            <div class="card-header text-light" style="background-color: #0e2238;">
                <i class="bi bi-clock-history"></i>
                History Pesanan
            </div>
            <div class="card-body">
                <h2 id="totalOrderItemCount">0</h2>
            </div>
        </div>
    </div>

    <div class="col-lg">

        <div class="card">
            <div class="card-header text-light" style="background-color: #0e2238;">
                <i class="bi bi-list"></i>
                Jumlah Order Siap Saji
            </div>
            <div class="card-body">
                <h2 id="siapDisajikanItemCount">0</h2>
            </div>
        </div>
    </div>

    <div class="col-lg">

        <div class="card">
            <div class="card-header text-light" style="background-color: #0e2238;">
                <i class="bi bi-list"></i>
                Jumlah Pesanan Masuk Dapur
            </div>
            <div class="card-body">
                <h2 id="masukDapurItemCount">0</h2>
            </div>
        </div>
    </div>



    <?php include 'script/config_dashboard.php' ?>