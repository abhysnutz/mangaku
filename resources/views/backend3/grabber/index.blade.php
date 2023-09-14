@extends('backend.layout.layout')

@push('css-top')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <style>
        #grabber-container > tr > td > a{
            color:#a12f2f;
            -webkit-filter: brightness(100%);
        }
        #grabber-container > tr > td > a:hover{
            -webkit-filter: brightness(60%);
        }
    </style>
@endpush
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Grabber</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Grabber</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Simple Full Width Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px;">#</th>
                                            <th>Title</th>
                                            <th>Artisan</th>
                                            <th>date</th>
                                            <th>New</th>
                                        </tr>
                                    </thead>
                                    <tbody id="grabber-container">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        
        <!-- /.content -->
    </div>

@endsection

@push('js-bottom')
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        grabber_filter();
        
        $(document).on('click', '.grabber-destroy', function(e){
            e.preventDefault();
            let id = $(this).data('id');

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
                        url : "{{ route('console.grabber.destroy') }}",
                        method : "DELETE",
                        data : {
                            id : id
                        },
                        success:function(reply){
                            if(reply.status == 1){
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then((done) => {
                                    if (done.isConfirmed) {
                                        grabber_filter();
                                    } 
                                })
                            }else{
                                Swal.fire('Failed!','Something error at server!','error')
                            }
                        }
                    });
                }
            })
        });

        $(document).on('click', '.grabber-add', function(e){
            e.preventDefault();
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure ?',
                text: "Push this Grabber to Queue !!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Push it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : "{{ route('console.grabber.queue') }}",
                        method : "POST",
                        data : {
                            id : id
                        },
                        success:function(reply){
                            if(reply.status == 1){
                                Swal.fire(
                                    'Success!',
                                    'Your Grabber Has Pushed to Queue',
                                    'success'
                                ).then((done) => {
                                    if (done.isConfirmed) {
                                        grabber_filter();
                                    } 
                                })
                            }else{
                                Swal.fire('Failed!','Something error at server!','error')
                            }
                        }
                    });
                }
            })
        });

        function grabber_filter(){
            search = $('#search').val();

            $.ajax({
                url : "{{ route('console.grabber.list') }}",
                method : "POST",
                data : {
                    search : search
                },
                success : function(reply){
                    grabber_data(reply.data, reply.links, 1)
                }
            });  
        }


        function grabber_data(data, links, page){
            $('#grabber-container').empty();
            $('#pagination-container').empty();
            
            $.each(data, function(k,v){
                const cons_created_at = new Date(v.created_at);
                let date = moment(cons_created_at).format('DD MMM YYYY | HH:mm:ss');
                
                $('#grabber-container').append(`
                    <tr>
                        <td>`+(15 * (page - 1) + (k + 1))+`</td>
                        <td>`+v.title+`</td>
                        <td>`+v.artisan+`</td>
                        <td>`+moment(cons_created_at).format('DD MMM YYYY | HH:mm:ss')+`</td>
                        <td>
                            <a href="#" class="mr-2 grabber-add" data-toggle="modal" data-target="#modal-preview" data-id="`+v.id+`"><i class="fas fa-plus"></i></a>
                            <a href="#" class="mr-2 comic-edit" data-toggle="modal" data-target="#modal-form" data-id="`+v.id+`"><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" class="grabber-destroy" data-id="`+v.id+`"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                `);
            });

            $.each(links, function(k, v){
                $('#pagination-container').append(`
                    <li class="page-item `+(v.active ? 'active' : '')+`">
                        <a class="page-link paginate-link" href="#">`+v.label+`</a>
                    </li>
                `);
            });
        }
        
    </script>
@endpush    