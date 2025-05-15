@extends('users.assets.app')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Dashboard</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-xxl-6">
                                <div class="row g-gs">
                                    <div class="col-lg-6 col-xxl-12">
                                        <div class="row g-gs">
                                            <div class="col-sm-6 col-lg-12 col-xxl-6">
                                                <div class="card card-bordered">
                                                    <div class="card-inner">
                                                        <div class="card-title-group align-start mb-2">
                                                            <div class="card-title">
                                                                <h6 class="title">Total Asset</h6>
                                                            </div>
                                                            <div class="card-tools">
                                                                <em class="card-hint icon ni ni-help-fill"
                                                                    data-bs-toggle="tooltip" data-bs-placement="left"
                                                                    title="Total Asset"></em>
                                                            </div>
                                                        </div>
                                                        <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                            <div class="nk-sale-data">
                                                                <span class="amount" id="total-assets">Loading..</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .card -->
                                            </div><!-- .col -->
                                        </div><!-- .row -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div><!-- .col -->
                        </div><!-- .row -->
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
                // Tidak ada token, redirect ke login
                window.location.href = '/users/login';
            }

            // Optionally: verifikasi token ke endpoint user
            $.ajax({
                url: '/api/assets',
                method: 'GET',
                headers: {
                    Authorization: 'Bearer ' + token
                },
                success: function(response) {
                    console.log('User valid');
                    const totalAssets = response.data.length;
                    $('#total-assets').text(totalAssets.toLocaleString());
                    // Lanjut tampilkan dashboard
                },
                error: function() {
                    // Token invalid, redirect
                    localStorage.removeItem('token');
                    window.location.href = '/users/login';
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
