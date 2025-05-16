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
                                        <tbody>
                                            @foreach ($asset as $i => $assets )
                                                <tr class="nk-tb-item">
                                                <td class="nk-tb-col">{{ $assets->code ?? '' }}</td>
                                                <td class="nk-tb-col">{{ $assets->name ?? '' }}</td>
                                                <td class="nk-tb-col">{{ $assets->category ?? '' }}</td>
                                                <td class="nk-tb-col">{{ $assets->departemen ?? '' }}</td>
                                                <td class="nk-tb-col">{{ $assets->condition ?? '' }}</td>
                                                <td class="nk-tb-col">{{ $assets->purchase_date ?? '' }}</td>
                                                <td class="nk-tb-col"> Rp {{ $assets->price}} </td>
                                                <td class="nk-tb-col">{{ $assets->quantity ?? '' }}</td>
                                                <td class="nk-tb-col">{{ $assets->description ?? '' }}</td>
                                            </tr>
                                            @endforeach
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
            format: 'yyyy-mm-dd', // Format tampilan yang diinginkan
            autoclose: true, // Agar otomatis tertutup setelah memilih tanggal
            todayHighlight: true, // Menyoroti hari ini
            maxDate: new Date(), // Tidak bisa memilih tanggal setelah hari ini
        }).on('changeDate', function(e) {
            // Ketika tanggal dipilih, ubah format menjadi yyyy-mm-dd (format yang disimpan)
            const selectedDate = e.format('yyyy-mm-dd');
            $('#purchase_date').val(selectedDate);
        });
    });
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#createAssetForm').on('submit', function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: '{{ route('data.store') }}',
                method: 'POST',
                data: formData,
                success: function (response) {
                    alert('Berhasil menambahkan aset!');
                    $('#createAssetModal').modal('hide');
                    // Refresh data jika perlu
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let message = xhr.responseJSON.message || 'Terjadi kesalahan.';

                    if (errors) {
                        for (let key in errors) {
                            message += '\n' + errors[key];
                        }
                    }

                    alert(message);
                }
            });
        });
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
    });
</script>
@endsection
