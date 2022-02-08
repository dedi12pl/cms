@extends('layout.app')

@section('css')
    <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="row gy-5 g-xl-8">
                <div class="col-sm-12">
                    <div class="card card-xxl-stretch mb-5 mb-xl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">{{ $menu }}</span>
                                <span class="text-muted mt-1 fw-bold fs-7">Over 500 members</span>
                            </h3>
                            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-trigger="hover" title="Click to add a user">
                                <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                    data-bs-target="#ajaxModal">
                                    <i class="fas fa-plus"></i> Add New
                                </a>
                            </div>
                        </div>


                        <div class="card-body py-3">

                            <table id="my-table"
                                class="table table-striped table-row-bordered gy-5 gs-7 border rounded table-hover">
                                <thead>
                                    <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                        <th style="width: 20px">No</th>
                                        <th>Kode Penyelenggara</th>
                                        <th>Nama Penyelenggara</th>
                                        <th>Email</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- modal add --}}
@section('modal')
    <div class="modal fade" id="ajaxModal" tabindex="-1" aria-hidden="true">
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
                            <h1 class="mb-3">Penyelenggara</h1>
                            <div class="text-gray-400 fw-bold fs-5">If you need more info, please check
                                <a href="#" class="fw-bolder link-primary">Project Guidelines</a>.
                            </div>
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Nama Penyelenggara</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Masukkan nama penyelenggara dengan lengkap dan benar!"></i>
                            </label>

                            <input type="text" class="form-control form-control-solid"
                                placeholder="Masukkan nama penyelenggara" id="nama_penyelenggara"
                                name="nama_penyelenggara" />
                        </div>

                        <div class="d-flex flex-column mb-8">
                            <label class="required fs-6 fw-bold mb-2">Alamat Penyelenggara</label>
                            <textarea class="form-control form-control-solid" rows="3" id="alamat_penyelenggara"
                                name="alamat_penyelenggara" placeholder="Masukkan alamat penyelenggara"></textarea>
                        </div>

                        <hr>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Email</span>
                            </label>

                            <input type="email" class="form-control form-control-solid"
                                placeholder="Masukkan email penyelenggara" id="email" name="email" />
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Password</span>
                            </label>

                            <input type="password" class="form-control form-control-solid"
                                placeholder="Masukkan passwors penyelenggara" id="password" name="password" />
                        </div>

                        <div class="text-center">
                            <button type="reset" id="modalAdd_cancel" class="btn btn-white me-3">Cancel</button>
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
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#my-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/penyelenggara",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kd_penyelenggara',
                        name: 'kd_penyelenggara'
                    },
                    {
                        data: 'nama_penyelenggara',
                        name: 'nama_penyelenggara'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
            });


            // save
            $("#ajaxForm").on('submit', function(e) {
                e.preventDefault();

                var ajaxForm = $(this);

                $.ajax({
                    url: "{{ route('penyelenggara.store') }}",
                    type: 'post',
                    data: ajaxForm.serialize(),
                    dataType: 'json',
                    success: function(response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data penyelenggara berhasil ditambahkan!',
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
                            url: "{{ route('penyelenggara.store') }}" + '/' + id,
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
                var id = $(this).data('kd_penyelenggara');
                $.get("{{ route('penyelenggara.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Book");
                    $('#saveBtn').val("Update");
                    $('#ajaxModal').modal('show');
                    // $('#id').val(data.id);
                    $('#title').val(data.title);
                    $('#author').val(data.author);
                })
            });

        });
    </script>
@endsection
