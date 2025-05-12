@extends('users.app')

@section('content')
<div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
    <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
            <div class="card card-bordered">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title center">Sign-In</h4>
                        </div>
                    </div>
                    <form id="login-form">
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="default-01">Email or Username</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="text" name="email" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address or username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter your passcode">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        </div>
                    </form>
                    <div class="form-note-s2 text-center pt-4"> New on our platform? <a href="html/pages/auths/auth-register-v2.html">Create an account</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-footer nk-auth-footer-full">
            <div class="container wide-lg">
                <div class="row g-3">
                    <div class="col-lg-12">
                        <div class="nk-block-content text-center text-lg-start">
                            <p class="text-soft">&copy; 2022 Dashlite. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wrap @e -->
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#login-form').on('submit', function (e) {
            e.preventDefault();

            let email = $('input[name="email"]').val();
            let password = $('input[name="password"]').val();
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/api/login',
                method: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function (response) {
                    // Simpan token
                    localStorage.setItem('token', response.access_token);

                    // Set session ke Laravel
                    fetch('/users/set-session', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + response.access_token
                        },
                        credentials: 'same-origin'
                    }).then(() => {
                        window.location.href = '/users/dashboard';
                    });
                },
                error: function (xhr) {
                    alert('Login gagal: ' + xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection
