@extends('users.assets.app')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Aset</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <div class="drodown">
                                                    <a href="#" class="btn btn-icon btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#createAssetModal"><em
                                                            class="icon ni ni-plus"></em></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner position-relative card-tools-toggle">
                                    <div class="card-search search-wrap" data-search="search">
                                        <div class="card-body">
                                            <div class="search-content">
                                                <a href="#" class="search-back btn btn-icon toggle-search"
                                                    data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                <input type="text"
                                                    class="form-control border-transparent form-focus-none"
                                                    placeholder="Search by user or email">
                                                <button class="search-submit btn btn-icon"><em
                                                        class="icon ni ni-search"></em></button>
                                            </div>
                                        </div>
                                    </div><!-- .card-search -->
                                </div><!-- .card-inner -->
                                <div class="card-inner p-0">
                                    <table class="nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false" data-searching="false" data-length-change="false" data-paging="false" data-info="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Kode</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Nama</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Kategori</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Departemen</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Kondisi</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Tgl Beli</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Harga</span>
                                                </th>
                                                <th class="nk-tb-col"><span class="sub-text">Jumlah</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Deskripsi</span></th>
                                            </tr>
                                        </thead>
                                        <tbody id="asset-list">

                                        </tbody>
                                    </table><!-- .nk-tb-item -->
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createAssetModal" tabindex="-1" aria-labelledby="createAssetModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="createAssetForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createAssetModalLabel">Tambah Aset Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label for="code" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="code" name="code" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="category" name="category">
                        </div>
                        <div class="col-md-6">
                            <label for="departemen" class="form-label">Departemen</label>
                            <input type="text" class="form-control" id="departemen" name="departemen">
                        </div>
                        <div class="col-md-6">
                            <label for="condition" class="form-label">Kondisi</label>
                            <select class="form-select js-select2" id="condition" name="condition">
                                <option value="baik">
                                    Baik</option>
                                <option value="rusak">
                                    Rusak</option>
                                <option value="hilang">
                                    Hilang</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="purchase_date" class="form-label">Tanggal Beli</label>
                            <input type="text" id="purchase_date" name="purchase_date" class="form-control"
                                placeholder="dd-mm-yyyy" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="quantity" name="quantity">
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            // Inisialisasi Datepicker menggunakan UI template
            $('#purchase_date').datepicker({
                format: 'dd-mm-yyyy', // Format tampilan yang diinginkan
                autoclose: true, // Agar otomatis tertutup setelah memilih tanggal
                todayHighlight: true, // Menyoroti hari ini
                maxDate: new Date(), // Tidak bisa memilih tanggal setelah hari ini
            }).on('changeDate', function(e) {
                // Ketika tanggal dipilih, ubah format menjadi yyyy-mm-dd (format yang disimpan)
                const selectedDate = e.format('yyyy-mm-dd');
                $('#purchase_date').val(selectedDate);
            });
        });

        $(document).ready(function() {
            const token = localStorage.getItem('token');

            if (!token) {
                window.location.href = '/users/login';
                return;
            }

            $.ajax({
                url: '/api/assets',
                method: 'GET',
                headers: {
                    Authorization: 'Bearer ' + token
                },
                success: function(response) {
                    const assets = response.data || response;
                    const container = $('#asset-list');
                    container.empty(); // Kosongkan dulu

                    assets.forEach(function(asset) {
                        const row = `
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">${asset.code}</td>
                            <td class="nk-tb-col">${asset.name}</td>
                            <td class="nk-tb-col">${asset.category}</td>
                            <td class="nk-tb-col">${asset.departemen}</td>
                            <td class="nk-tb-col">${asset.condition}</td>
                            <td class="nk-tb-col">${asset.purchase_date}</td>
                            <td class="nk-tb-col"> Rp ${asset.price ? Number(asset.price).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '-'} </td>
                            <td class="nk-tb-col">${asset.quantity}</td>
                            <td class="nk-tb-col">${asset.description ?? '-'}</td>
                        </tr>

                    `;
                        container.append(row);
                    });
                },
                error: function() {
                    alert('Gagal mengambil data aset.');
                    localStorage.removeItem('token');
                    window.location.href = '/users/login';
                }
            });

            // Fungsi untuk format tanggal agar sesuai dengan format yang akan disubmit
            function formatDateToSubmit(dateString) {
                const parts = dateString.split('-'); // misal: '12-05-2025'
                const day = parts[0];
                const month = parts[1];
                const year = parts[2];
                return `${year}-${month}-${day}`; // hasil: '2025-05-12'
            }


            $('#createAssetModal').on('show.bs.modal', function() {
                const token = localStorage.getItem('token');

                $.ajax({
                    url: '/api/assets/generate-code',
                    method: 'GET',
                    headers: {
                        Authorization: 'Bearer ' + token
                    },
                    success: function(response) {
                        $('#code').val(response.code); // isi inputan kode
                    },
                    error: function() {
                        alert('Gagal mengambil kode aset.');
                    }
                });
            });

            $('#createAssetForm').on('submit', function(e) {
                e.preventDefault();

                // Mengambil data dari form
                const code = $('#code').val();
                const name = $('#name').val();
                const category = $('#category').val();
                const departemen = $('#departemen').val();
                const condition = $('#condition')
            .val(); // pastikan ini adalah salah satu dari 'baik', 'rusak', 'hilang'
                const purchase_date = formatDateToSubmit($('#purchase_date').val()); // formatkan tanggal menjadi yyyy-mm-dd
                const price = parseFloat($('#price').val()).toFixed(2);
                const quantity = $('#quantity').val();
                const description = $('#description').val(); // Bisa null jika tidak diisi

                // // Mengecek apakah data wajib sudah ada
                if (!name || !category || !departemen || !condition || !purchase_date || !price || !
                    quantity) {
                    alert('Semua kolom wajib diisi!');
                    return;
                }

                const formData = {
                    code: code, // code bisa otomatis di-generate dan dimasukkan di backend
                    name: name,
                    category: category,
                    departemen: departemen,
                    condition: condition,
                    purchase_date: purchase_date,
                    price: price,
                    quantity: quantity,
                    description: description // tidak wajib
                };

                $.ajax({
                    url: '/api/assets',
                    method: 'POST',
                    headers: {
                        Authorization: 'Bearer ' + token
                    },
                    data: formData,
                    success: function(res) {
                        $('#createAssetModal').modal('hide');
                        $('#createAssetForm')[0].reset();
                        location.reload(); // Atau panggil ulang fungsi fetch asset
                    },
                    error: function(err) {
                        if (err.status === 422) {
                            alert('Data tidak valid, harap periksa kembali input Anda.');
                        } else {
                            alert('Gagal menyimpan data aset.');
                        }
                    }
                });
            });
            // Logout handler
            $('#logout-btn').on('click', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/api/logout',
                    method: 'POST',
                    headers: {
                        Authorization: 'Bearer ' + token
                    },
                    success: function(response) {
                        // Hapus token
                        localStorage.removeItem('token');
                        // Redirect ke login
                        window.location.href = '/users/login';
                    },
                    error: function() {
                        alert('Logout gagal. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>
@endsection
