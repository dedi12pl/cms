<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Metronic Theme | Keenthemes</title>
    <meta name="description"
        content="Craft admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="keywords"
        content="Craft, bootstrap, Angular 10, Vue, React, Laravel, admin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/assets/media/logos/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body"
    class="bg-white header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px" style="background-color: #F2C98A">
                <div class="d-flex flex-column text-center p-10 pt-lg-20">
                    <a href="index.html" class="py-9">
                        <img alt="Logo" src="/assets/media/logos/logo-3.svg" class="h-70px" />
                    </a>
                    <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Welcome to Metronic</h1>
                    <p class="fw-bold fs-2" style="color: #986923;">Discover Amazing Metronic
                        <br />with great build tools
                    </p>
                </div>
                <div class="d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-size-lg-auto bgi-position-y-bottom min-h-100px min-h-lg-350px"
                    style="background-image: url(/assets/media/svg/illustrations/checkout.svg)"></div>
            </div>




            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto">

                        <form class="form w-100" novalidate="novalidate" id="ajaxLoginForm">
                            @csrf
                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-3">Sign In to Metronic</h1>
                                <div class="text-gray-400 fw-bold fs-4">New Here?
                                    <a href="authentication/flows/aside/sign-up.html"
                                        class="link-primary fw-bolder">Create an Account</a>
                                </div>
                            </div>
                            <div class="fv-row mb-10">
                                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                                    autocomplete="off" />
                            </div>
                            <div class="fv-row mb-10">
                                <div class="d-flex flex-stack mb-2">
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                    <a href="authentication/flows/aside/password-reset.html"
                                        class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                                </div>
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    name="password" autocomplete="off" />
                            </div>
                            <div class="text-center">
                                <button type="submit" id="kt_sign_in_submit"
                                    class="btn btn-lg btn-primary fw-bolder me-3 my-2">
                                    <span class="indicator-label">Sign In</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <a href="#" class="btn btn-light-primary btn-lg fw-bolder my-2">
                                    <img alt="Logo" src="/assets/media/svg/social-icons/google.svg"
                                        class="h-20px me-3" />Sign in with Google</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                    <div class="d-flex flex-center fw-bold fs-6">
                        <a href="https://keenthemes.com/faqs" class="text-muted text-hover-primary px-2"
                            target="_blank">About</a>
                        <a href="https://keenthemes.com/support" class="text-muted text-hover-primary px-2"
                            target="_blank">Support</a>
                        <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2"
                            target="_blank">Purchase</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/js/scripts.bundle.js"></script>
    <script src="/assets/js/custom/authentication/sign-in/general.js"></script>


    <script>
        // save
        $("#ajaxLoginForm").on('submit', function(e) {
            e.preventDefault();

            var ajaxLoginForm = $(this);

            $.ajax({
                url: "{{ route('auth.ajax_login') }}",
                type: 'post',
                data: ajaxLoginForm.serialize(),
                dataType: 'json',
                success: function(response) {

                    if (response == 'success') {
                        window.location.href = '/';
                    } else {
                        swal.fire({
                            title: 'Gagal',
                            text: "Periksa kembali email dan password anda!",
                            type: 'error',
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Iya'
                        })
                    }

                }
            });
        });
    </script>
</body>

</html>
