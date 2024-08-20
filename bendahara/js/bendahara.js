// script input transaksi baru
document.getElementById('debit').addEventListener('input', function () {
    var debitValue = this.value.trim(); // Menghapus spasi yang tidak diperlukan
    var kreditField = document.getElementById('kredit');

    if (debitValue !== "") {
        kreditField.disabled = true;
    } else {
        kreditField.disabled = false;
    }
});

document.getElementById('kredit').addEventListener('input', function () {
    var kreditValue = this.value.trim(); // Menghapus spasi yang tidak diperlukan
    var debitField = document.getElementById('debit');

    if (kreditValue !== "") {
        debitField.disabled = true;
    } else {
        debitField.disabled = false;
    }
});

// Script konfirmasi penghapusan
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Mengirim request AJAX ke delete_bendahara_umum.php
            fetch('delete_bendahara_umum.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Tampilkan SweetAlert dengan pesan berhasil
                        Swal.fire({
                            title: 'Deleted!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Setelah pop-up ditutup, refresh halaman
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was a problem connecting to the server.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    });
}

// Script konfirmasi penghapusan untuk daftar_utang
function confirmDeleteDaftarUtang(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Mengirim request AJAX ke delete_daftar_utang.php
            fetch('delete_daftar_utang.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Tampilkan SweetAlert dengan pesan berhasil
                        Swal.fire({
                            title: 'Deleted!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Setelah pop-up ditutup, refresh halaman
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was a problem connecting to the server.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    });
}


// Script pratinjau gambar
function previewImage(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const file = input.files[0];
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const refPreview = document.getElementById('refPreview');
                refPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            alert('Please select a valid image file.');
        }
    }
}
// Script untuk menonaktifkan debit atau kredit
document.addEventListener('DOMContentLoaded', function () {
    const debitInput = document.getElementById('debit');
    const kreditInput = document.getElementById('kredit');

    function toggleInputs() {
        if (parseInt(debitInput.value) > 0) {
            kreditInput.disabled = true;
            debitInput.disabled = false;
        } else if (parseInt(kreditInput.value) > 0) {
            debitInput.disabled = true;
            kreditInput.disabled = false;
        } else {
            debitInput.disabled = false;
            kreditInput.disabled = false;
        }
    }

    debitInput.addEventListener('input', toggleInputs);
    kreditInput.addEventListener('input', toggleInputs);

    // Panggil toggleInputs saat halaman dimuat untuk memastikan status yang benar
    toggleInputs();
});

// Script konfirmasi penghapusan untuk daftar_Piutang
function confirmDeleteDaftarPiutang(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Mengirim request AJAX ke delete_daftar_piutang.php
            fetch('delete_daftar_piutang.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Tampilkan SweetAlert dengan pesan berhasil
                        Swal.fire({
                            title: 'Deleted!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Setelah pop-up ditutup, refresh halaman
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was a problem connecting to the server.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    });
}
