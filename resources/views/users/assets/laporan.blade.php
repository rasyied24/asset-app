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
                                            <li><a href="#" class="btn btn-white btn-outline-light"><em
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
                                                <input type="text" id="search-input"
                                                    class="form-control border-transparent form-focus-none"
                                                    placeholder="Search by name">
                                                <button class="search-submit btn btn-icon" id="search-btn"><em
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
    $(document).ready(function() {
        const token = localStorage.getItem('token');

        if (!token) {
            window.location.href = '/users/login';
            return;
        }

        $.ajax({
            url: '/api/assets',
            method: 'GET',
            data: {
                    q: query
                },
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
                        <td class="nk-tb-col">${asset.condition}</td>
                        <td class="nk-tb-col">${asset.departemen}</td>
                        <td class="nk-tb-col">${asset.purchase_date}</td>
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

        $('#search-btn').on('click', function () {
            const query = $('#search-input').val();
            fetchAssets(query);
        });

        // Handle Enter key in search input
        $('#search-input').on('keypress', function (e) {
            if (e.which === 13) {
                $('#search-btn').click();
            }
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
