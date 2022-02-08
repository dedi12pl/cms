@extends('layout.app')

@section('css')
    <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">
        <div id="" class="container">
            <div class="row gy-5 g-xl-8">
                <div class="col-sm-12">
                    <div class="card card-xxl-stretch mb-5 mb-xl-8 py-5">

                        <div class="row justify-content-center mb-4 mt-5">
                            <div class="col-sm-6">
                                <h3 class="text-center">
                                    Tampilkan Persyaratan Berdasarkan Layanan
                                </h3>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-6">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <select name="layanan" id="layanan" data-placeholder="Pilih layanan..."
                                        class="form-select form-select-solid">
                                        <option value="">Pilih layanan...</option>
                                        @foreach ($layanan as $u)
                                            <option value="{{ $u->id }}">{{ $u->nama_layanan }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-12 text-center">
                                <button id="btn_tampilkan" onclick="fetch_data()" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                    Tampilkan
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <table id="my-table"
                                    class="table table-striped table-row-bordered gy-5 gs-7 border rounded table-hover">
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection


{{-- modal add --}}
@section('modal')
    <div class="modal fade" id="ajaxModal">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.5"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">

                    <form id="ajaxForm" class="form">
                        @csrf

                        <input type="hidden" name="id" id="id">

                        <div class="mb-13 text-center">
                            <h1 class="mb-3" id="modal_title">{{ $menu }}</h1>
                            <div class="text-gray-400 fw-bold fs-5">If you need more info, please check
                                <a href="#" class="fw-bolder link-primary">Project Guidelines</a>.
                            </div>
                        </div>


                        <div class="d-flex flex-column mb-8 fv-row">

                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Nama Layanan</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Your payment statements may very based on selected country"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Select-->
                            <select name="country" data-control="select2" data-placeholder="Pilih layanan..."
                                class="form-select form-select-solid">
                                <option value="">Pilih layanan...</option>
                                @foreach ($layanan as $u)
                                    <option value="{{ $u->id }}">{{ $u->nama_layanan }}</option>
                                @endforeach

                            </select>
                        </div>

                        {{-- <div class="d-flex flex-column mb-8">
                            <label class="required fs-6 fw-bold mb-2">Alamat Penyelenggara</label>
                            <textarea class="form-control form-control-solid" rows="3" id="alamat_penyelenggara"
                                name="alamat_penyelenggara" placeholder="Masukkan alamat penyelenggara"></textarea>
                        </div> --}}

                        <div class="text-center">
                            <button type="reset" onclick="modal_cancel()" class="btn btn-white me-3">Cancel</button>
                            <button type="submit" id="saveBtn" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()


{{-- javascript --}}
@section('js')
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/assets/js/custom/intro.js"></script>

    <script>
        $('#ajaxModal').modal({
            backdrop: 'static',
            keyboard: false
        })


        function fetch_data() {

            var id_layanan = $('#layanan').val();

            if (id_layanan == '') {
                alert(123);
                Swal.fire(
                    title: 'Warning!',
                    text: "Pilih nama layanan terlebih dahulu!",
                    icon: 'warning',
                )
            } else {
                $('#my-table').append(' <thead>\
                                        <tr class="fw-bolder fs-6 text-gray-800 px-7">\
                                            <th style="width: 20px">No</th>\
                                            <th>Kode Penyelenggara</th>\
                                            <th>Nama Penyelenggara</th>\
                                            <th>Email</th>\
                                            <th>Aksi</th>\
                                        </tr>\
                                    </thead>')
            }
        }

        $(function() {
            // save
            $("#ajaxForm").on('submit', function(e) {
                e.preventDefault();

                var ajaxForm = $(this);

                $.ajax({
                    url: "{{ route('layanan.store') }}",
                    type: 'post',
                    data: ajaxForm.serialize(),
                    dataType: 'json',
                    success: function(response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Layanan berhasil ditambahkan!',
                            // footer: '<a href="">Why do I have this issue?</a>'
                        })

                        $('#ajaxModal').modal('hide');
                        $('#ajaxForm')[0].reset();
                        table.draw();
                    }
                });
            });

            $('body').on('click', '.delete', function() {

                var id = $(this).data("id");

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
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('layanan.store') }}" + '/' + id,
                            dataType: 'json',
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )

                                table.draw();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                })
            });

            // update
            $('body').on('click', '.edit', function() {
   