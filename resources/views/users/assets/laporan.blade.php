@extends('users.assets.app')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Laporan Aset</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="#" class="btn btn-white btn-outline-light" id="export-pdf-btn"><em
                                                        class="icon ni ni-download-cloud"></em><span>Export PDF</span></a></li>
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
                                    <div class="card-title-group">
                                        <div class="card-tools">

                                        </div><!-- .card-tools -->
                                        <div class="card-tools me-n1">
                                            <ul class="btn-toolbar gx-1">
                                                <li>
                                                    <a href="#" class="btn btn-icon search-toggle toggle-search"
                                                        data-target="search"><em class="icon ni ni-search"></em></a>
                                                </li><!-- li -->
                                            </ul><!-- .btn-toolbar -->
                                        </div><!-- .card-tools -->
                                    </div><!-- .card-title-group -->

                                    <div class="card-search search-wrap" data-search="search">
                                        <div class="card-body">
                                            <div class="search-content">
                                                <a href="#" class="search-back btn btn-icon toggle-search"
                                                    data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                <input type="text" name="q" id="search-input"
                                                    class="form-control border-transparent form-focus-none"
                                                    placeholder="Search by name">
                                                <button type="button" id="search-btn" class="search-submit btn btn-icon">
                                                    <em class="icon ni ni-search"></em>
                                                </button>
                                            </div>
                                        </div>
                                    </div><!-- .card-search -->

                                </div><!-- .card-inner -->
                                <div class="card-inner p-0">
                                    <table class="nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false" data-searching="false" data-length-change="false" data-paging="false" data-info="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Kode</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Nama Aset</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Kategori</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Kondisi</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Departemen</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Tanggal Masuk</span></th>
                                            </tr><!-- .nk-tb-item -->
                                        </thead>
                                        <tbody id="asset-list">

                                        </tbody>
                                    </table><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        const token = localStorage.getItem('token');

        if (!token) {
            window.location.href = '/users/login';
            return;
        }

        function fetchAssets(query = '') {
            $.ajax({
                url: '/api/assets/filter',
                method: 'GET',
                data: { q: query },
                headers: {
                    Authorization: 'Bearer ' + token
                },
                success: function (response) {
                    const assets = response.data || [];
                    const container = $('#asset-list');
                    container.empty();

                    if (assets.length === 0) {
                        container.append(`<tr><td colspan="6" class="text-center text-soft">Tidak ada data ditemukan.</td></tr>`);
                        return;
                    }

                    assets.forEach(function (asset) {
                        const row = `
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col">${asset.code ?? '-'}</td>
                                <td class="nk-tb-col">${asset.name ?? '-'}</td>
                                <td class="nk-tb-col">${asset.category ?? '-'}</td>
                                <td class="nk-tb-col">${asset.condition ?? '-'}</td>
                                <td class="nk-tb-col">${asset.departemen ?? '-'}</td>
                                <td class="nk-tb-col">${asset.purchase_date ?? '-'}</td>
                            </tr>
                        `;
                        container.append(row);
                    });
                },
                error: function (xhr) {
                    console.error('API Error:', xhr);

                    if (xhr.status === 401) {
                        alert('Sesi login Anda telah habis. Silakan login ulang.');
                        localStorage.removeItem('token');
                        window.location.href = '/users/login';
                    } else {
                        alert('Gagal mengambil data aset. Coba lagi nanti.');
                    }
                }
            });
        }

        // Inisialisasi data awal
        fetchAssets();

        // Search button click
        $('#search-btn').on('click', function () {
            const query = $('#search-input').val();
            fetchAssets(query);
        });

        // Tekan Enter di input pencarian
        $('#search-input').on('keypress', function (e) {
            if (e.which === 13) {
                $('#search-btn').click();
            }
        });

        $('#export-pdf-btn').on('click', function(e) {
            e.preventDefault();

            const token = localStorage.getItem('token');
            const query = $('#search-input').val();

            const exportUrl = '/api/assets/export/pdf?q=' + encodeURIComponent(query);

            // Buat invisible link untuk download PDF
            const link = document.createElement('a');
            link.href = exportUrl;
            link.setAttribute('download', 'laporan_aset.pdf');
            link.setAttribute('target', '_blank');
            link.setAttribute('rel', 'noopener noreferrer');

            // Tambahkan Authorization Header menggunakan fetch dan blob
            fetch(exportUrl, {
                method: 'GET',
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => response.blob())
            .then(blob => {
                const blobUrl = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = blobUrl;
                a.download = "laporan_aset.pdf";
                document.body.appendChild(a);
                a.click();
                a.remove();
            }).catch(error => {
                alert("Gagal mendownload PDF.");
            });
        });

        // Logout handler
        $('#logout-btn').on('click', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/api/logout',
                method: 'POST',
                headers: {
                    Authorization: 'Bearer ' + token
                },
                success: function () {
                    localStorage.removeItem('token');
                    window.location.href = '/users/login';
                },
                error: function () {
                    alert('Logout gagal. Silakan coba lagi.');
                }
            });
        });
    });
</script>
@endsection
