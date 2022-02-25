<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <style>
        .header {
            margin: 20px;
        }

        table {
            text-align: left;
        }
    </style>

    <title><?= $title; ?></title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Tes App</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Home</a>
                        </li>
                </div>
            </div>
        </nav>


        <h2 class="mb-4 mt-4">List <?= $title; ?></h2>
        <div class="content">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Barang
            </button>
            <table id="myTable" class="table table-striped table-borderless">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($barang as $b) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b['nama_barang']; ?></td>
                            <td>Rp. <?= number_format($b['harga_beli']); ?></td>
                            <td>Rp. <?= number_format($b['harga_jual']); ?></td>
                            <td><?= $b['stok']; ?></td>
                            <td><img src="<?= base_url('storage/images/') . $b['foto_barang']; ?>" class="img-thumbnail" alt="gambar produk" width="150"></td>
                            <td>
                                <a href="<?= base_url('barang/ubah/') . $b['id'] ?>" class="btn btn-sm btn-success">UBAH</a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="delete_gallery('<?= $b['id'] ?>')">HAPUS</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if (isset($error)) : ?>
                <div class="invalid-feedback"><?= $error ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="form-new-data" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto_barang" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="foto_barang" name="foto_barang" accept="image/png, image/jpeg, image/jpg" required>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="submit" name="save" id="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <!-- datatables -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <!-- swal -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <!-- input new data alert -->
    <script>
        $(document).ready(function() {
            $('#form-new-data').on('submit', function(e) {
                e.preventDefault();
                var btn = $('#submit');
                $.ajax({
                    url: '<?= base_url(); ?>barang/tambah',
                    data: new FormData(this),
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    // cache:false,
                    // async:false,
                    beforeSend: function() {
                        btn.html('Loading...');
                    },
                    complete: function() {
                        btn.html('Send Message');
                    },
                    success: function(data) {
                        // console.log(data);
                        $('.form-group').removeClass('has-error');
                        $('.text-danger').remove();
                        if (data['error']) {
                            var text = '';
                            for (i in data['error']) {
                                console.log(i);
                                // console.log($('input[name=name]'));
                                $('input[name=\'' + i + '\']').closest('.form-group').addClass('has-error');
                                $('input[name=\'' + i + '\']').after('<small class="text-danger"><i>' + data['error'][i] + '</i></small>');
                                $('select[name=\'' + i + '\']').closest('.form-group').addClass('has-error');
                                $('select[name=\'' + i + '\']').after('<small class="text-danger"><i>' + data['error'][i] + '</i></small>');
                                $('textarea[name=\'' + i + '\']').closest('.form-group').addClass('has-error');
                                $('textarea[name=\'' + i + '\']').after('<small class="text-danger"><i>' + data['error'][i] + '</i></small>');
                            }
                        } else if (data['success']) {
                            swal("Success!", 'Thank You', "success")
                                .then((value) => {
                                    window.location.reload();
                                });
                        } else if (data['error_action']) {
                            swal("Sorry!", "Gagal terkirim :(", "warning");
                        } else if (data['error_submit']) {
                            swal("Sorry!", data['error_submit'], "warning");
                        } else {
                            swal("Oops...", "Something went wrong :(", "error");
                        }
                    },
                    error: function(data) {
                        swal("Oops...", "Something went wrong :(", "error");
                    }
                });
            });
        });
    </script>

    <script>
        function delete_gallery(idValue) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?= base_url(); ?>barang/hapus/' + idValue + '',
                        type: 'POST',
                        error: function() {
                            swal("Error!", "Something is wrong!", "error");
                        },
                        success: function(data) {

                            if (data['success']) {
                                // $("#" + idValue).remove();
                                // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                swal("Deleted!", 'Your imaginary file has been deleted.', "success")
                                    .then((value) => {
                                        window.location.reload();
                                    });
                            } else {
                                swal("Error!", "Something is wrong!", "error");
                            }
                        }
                    });
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
        }
    </script>
</body>

</html>