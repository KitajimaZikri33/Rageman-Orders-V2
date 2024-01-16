<script type="module">

<?php include('./firebase.js') ?>

// write data
submitButton.addEventListener('click', (e) => {
    var Name = document.getElementById('Name').value;
    var Nomor = document.getElementById('Nomor').value;
    var Status = document.getElementById('status').value;

    var DateTime = document.getElementById('datetimeDisplay').value;

    const dbRef = ref(database, 'orders');
    const ordersRef = push(dbRef);

    Swal.fire({
    icon: 'success',
    title: 'Order Berhasil',
    text: 'Order pesanan berhasil dilakukan.',
    confirmButtonClass: 'btn btn-success',
    customClass: {
        title: 'alert-title',
        content: 'alert-text'
    }
});
    set(ordersRef, {
        Name: Name,
        Nomor: Nomor,
        DateTime: DateTime,
        status: Status
    }).then(() => {
        document.getElementById('Name').value = '';
        document.getElementById('Nomor').value = '';

        const newOrderRef = ref(database, 'orders/' + newOrderId);

        getData();
    }).catch((error) => {
        console.error("Error setting new data: ", error);
    });
});


function viewOrderItems(key, Name, Nomor) {
    console.log('View button clicked for key:', key);
    console.log('Name:', Name);
    console.log('Nomor:', Nomor);

    let encodedName = encodeURIComponent(Name);
    let encodedNomor = encodeURIComponent(Nomor);

    const url = `order_item.php?orderId=${key}&Name=${encodedName}&Nomor=${encodedNomor}`;

    window.location.href = url;
}


function getData() {
    const dataTable = $('#dataTblBody');

    dataTable.empty();
    const dbRef = ref(database, 'orders/');

    onValue(dbRef, (snapshot) => {
        $('#dataTblBody td').remove();
        let rowNum = 1;

        snapshot.forEach((childSnapshot) => {
            const childKey = childSnapshot.key;
            const childData = childSnapshot.val();

            if (childData.status === 'Success') {
                return;
            }

            var row = `<tr data-key="${childKey}" data-name="${childData.Name}" data-nomor="${childData.Nomor}" data-time="${childData.DateTime}">
                    <td>${rowNum}</td>
                    <td>${childData.Name}</td>
                    <td>${childData.Nomor}</td>
                    <td>${childData.DateTime}</td>
                    <td>${childData.status}</td>
                    <td class="d-flex">
                        <button class="btn btn-primary me-1" onclick="viewOrderItems('${childKey}', '${childData.Name}', '${childData.Nomor}')">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-warning me-1" onclick="editData(this)">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-danger me-1" onclick="deleteData(this)">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                    </tr>`;

            $(row).appendTo('#dataTblBody');

            rowNum++;
        });
    });
}


const editData = (button) => {
    console.log('Edit button clicked');
    const row = button.closest('tr');
    const key = row.dataset.key;
    const name = row.dataset.name;
    const nomor = row.dataset.nomor;
    const time = row.dataset.time;
    const status = row.dataset.status;

    $('#editKey').val(key);
    $('#editName').val(name);
    $('#editNomor').val(nomor);
    $('#datetimeHidden').val(time);
    $('#statusHidden').val(status);

    $('#editModal').modal('show');
};


const saveEdit = () => {
    console.log('Save Changes clicked');
    const key = $('#editKey').val();
    const updatedName = $('#editName').val();
    const updatedNomor = $('#editNomor').val();
    const updateTime = $('#datetimeHidden').val();
    const updateStatus = $('#statusHidden').val();

    const dbRef = ref(database, 'orders/' + key);

    Swal.fire({
    icon: 'success',
    title: 'Edit Berhasil',
    text: 'Edit data berhasil dilakukan.',
    confirmButtonClass: 'btn btn-success',
    customClass: {
        title: 'alert-title',
        content: 'alert-text'
    }
});

    set(dbRef, {
        Name: updatedName,
        Nomor: updatedNomor,
        DateTime: updateTime,
        status: updateStatus
    }).then(() => {
        $('#editModal').modal('hide');
        
        getData();
    }).catch((error) => {
        console.error("Error updating data: ", error);
    });
};

const deleteData = (button) => {
    console.log('Delete button clicked');

    Swal.fire({
        icon: 'warning',
        title: 'Konfirmasi Penghapusan',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-secondary',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        customClass: {
            title: 'alert-title',
            content: 'alert-text'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const row = button.closest('tr');
            const key = row.dataset.key;

            const dbRef = ref(database, 'orders/' + key);
            remove(dbRef)
                .then(() => {
                    console.log('Data deleted successfully');
                    getData();
                })
                .catch((error) => {
                    console.error("Error deleting data: ", error);
                });
        }
    });
};


async function setCurrentDateTime() {
    const datetimeDisplay = document.getElementById('datetimeDisplay');

    try {
        // Fetch current time from WorldTimeAPI (Asia/Jakarta timezone)
        const response = await fetch(
            'http://worldtimeapi.org/api/timezone/Asia/Jakarta');
        const data = await response.json();

        // Extract the date and time
        const currentDateTime = new Date(data.datetime);

        // Format the date and time for Indonesia
        const options = {
            year: 'numeric',
            month: 'numeric',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            timeZoneName: 'short',
            weekday: 'long'
        };

        // Set the value of the display element
        datetimeDisplay.value = currentDateTime.toLocaleString('id-ID', options);
    } catch (error) {
        console.error('Error fetching time:', error);
    }
}


setInterval(setCurrentDateTime, 1000);

setCurrentDateTime();





$(document).ready(function() {

    $('#dataTblBody').on('click', '.btn-warning', function() {
        editData(this);
    });

    $('#dataTblBody').on('click', '.btn-danger', function() {
        deleteData(this);
    });

    $('#saveChangesButton').on('click', function() {
        saveEdit();
    });


    $(document).ready(function() {
        $('#dataTblBody').on('click', '.btn-primary', function() {
            const row = $(this).closest('tr');
            const orderId = row.data('key');
            const name = row.data('name');
            const nomor = row.data('nomor');
            viewOrderItems(orderId, name, nomor);
        });
    });


});

document.addEventListener('DOMContentLoaded', function() {
    getData();
});
</script>
