<h5 class="card-title mb-2 text-start" style="color: #0e2238;">Master Coffee</h5>
<div class="row">
    <div class="col-lg-8">
        <div class="card">

            <div class="card-body">


                <!-- Modal untuk Edit Data -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <input type="hidden" id="editKey">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="editName">
                                        <label for="editName">Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="editPrice">
                                        <label for="editPrice" class="form-label">Price</label>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="saveChangesButton" class="btn btn-primary"
                                    onclick="saveEdit()">Save</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md table-responsive table-container">
                    <table class="table table-bordered table-hover align-middle rounded" id="dataTbl">
                        <thead>
                            <tr>
                                <th scope="col" class="col-md-1">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col" class="col-md-2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="dataTblBody">
                            <!-- Data will be inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg">
        <div class="card">
        <label class="mt-2">Tambah Item</label>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="Name" placeholder="Coffee Name">
                    <label for="floatingInput">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="Price" placeholder="Coffee Price">
                    <label for="floatingPassword">Price</label>
                </div>
                <button type="button" id="submitButton" class="btn btn-primary w-100"
                    data-bs-dismiss="modal">Save</button>
            </div>
        </div>

    </div>

</div>

<?php include('./script/config_coffee.php') ?>