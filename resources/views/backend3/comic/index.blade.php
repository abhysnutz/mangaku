@extends('backend.layout.layout')

@push('css-top')
    <!-- SweetAlert2 -->
    
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.css') }}">
    <!-- SimpleMDE -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/backend/plugins/simplemde/simplemde.min.css') }}"> --}}

    <style>
        #comic-container > tr > td > a{
            color:#a12f2f;
            -webkit-filter: brightness(100%);
        }
        #comic-container > tr > td > a:hover{
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
                        <h1>Comic</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Comic</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Comic List</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" id="search" class="form-control float-right" placeholder="Search" />

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Latest Update</th>
                                            <th>
                                                {{-- <a href="#" data-toggle="modal" data-target="#modal-form"> New </a> --}}
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="comic-container">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right" id="pagination-container">
                                    
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <div class="modal fade" id="modal-form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title modal-form-title">New Comic</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-create-comic">
                    <div class="modal-body">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><b>Comic</b></h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" placeholder="Enter Title" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-url" class="col-sm-2 col-form-label">URL</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="url" placeholder="Enter URL" />
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><b>Detail</b></h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-indo_title" class="col-sm-2 col-form-label">Indo Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="indo_title" placeholder="Enter Indo Title" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="type">
                                            @foreach (config('config.comic.type') as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Concept</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="categories">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-author" class="col-sm-2 col-form-label">Author</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="author" placeholder="Enter Author" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="status">
                                            @foreach (config('config.comic.status') as $status)
                                                <option value="{{ $status }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Rate</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="rate">
                                            @foreach (config('config.comic.rate') as $rate)
                                                <option value="{{ $rate }}">{{ $rate }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <b>Synopsis</b>
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <textarea id="summernote" name="synopsis">Place <em>some</em> <u>text</u> <strong>here</strong> </textarea>
                                    </div>
                                    <div class="card-footer">Visit <a href="https://github.com/summernote/summernote/">Summernote</a> documentation for more examples and information about the plugin.</div>
                                </div>
                            </div>
                            <!-- /.col-->
                        </div>
                        
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-store-comic">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@push('js-bottom')
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(document).on('click', '.btn-store-comic', function(){
            let data = $('#form-create-comic').serialize();
            console.log(data);
        });

        $('#summernote').summernote();
        comic_filter();

        $(document).on('click', '.paginate-link', function(){
            let page = $(this).text();
            search = $('#search').val();
            
            $.ajax({
                url:"{{ route('console.comic.list') }}?page="+page,
                method : "POST",
                data : {
                    search : search
                },
                success:function(reply){
                    comic_data(reply.data, reply.links, page)
                }
            });
        });

        $(document).on('keyup', '#search', function(){
            comic_filter();
        });

        $(document).on('click', '.comic-edit', function(){
            let id = $(this).data('id');
            
            $.ajax({
                url : "{{ route('console.comic.edit') }}",
                method : "POST",
                data : {
                    id : id
                },
                success : function(reply){
                    console.log(reply);
                    $('.modal-form-title').text(reply.title);
                    
                }
            });
        });

        $(document).on('click', '.comic-destroy', function(e){
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
                        url : "{{ route('console.comic.destroy') }}",
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
                                        comic_filter();
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

        $(document).on('click', '.comic-grabber', function(e){
            e.preventDefault();
            let id = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do You Want to Grab This Comic?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Grab It!'
            }).then((result) => {
                if (result.isConfirmed) {
                    comic_grabber(id)
                }
            });
        });

        function comic_grabber(id){
            $.ajax({
                url : "{{ route('console.comic.queue') }}",
                method : "POST",
                data : {
                    id : id,
                },
                success : function(reply){
                    if(reply.status == 1){
                        Swal.fire('Success!', 'Success Store to Queue', 'success' );
                    }else{
                        Swal.fire('Failed!','Something error at server!','error')
                    }
                }
            });
        }


        function comic_filter(){
            search = $('#search').val();

            $.ajax({
                url : "{{ route('console.comic.list') }}",
                method : "POST",
                data : {
                    search : search
                },
                success : function(reply){
                    comic_data(reply.data, reply.links, 1)
                }
            });  
        }

        function comic_data(data, links, page){
            $('#comic-container').empty();
            $('#pagination-container').empty();
            $.each(data, function(k,v){
                const cons_updated_at = new Date(v.updated_at);
                $('#comic-container').append(`
                    <tr>
                        <td>`+(15 * (page - 1) + (k + 1))+`</td>
                        <td>`+limit(v.title, 100)+`</td>
                        <td>`+moment(cons_updated_at).format('DD MMM YYYY | HH:mm:ss')+`</td>
                        <td>
                            <a href="#" class="mr-2 comic-view d-none" data-toggle="modal" data-target="#modal-preview" data-id="`+v.id+`"><i class="far fa-eye"></i></a>
                            <a href="#" class="mr-2 comic-edit d-none" data-toggle="modal" data-target="#modal-form" data-id="`+v.id+`"><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" class="mr-2 comic-destroy" data-id="`+v.id+`"><i class="fas fa-trash-alt"></i></a>
                            <a href="#" class="comic-grabber d-none" data-id="`+v.id+`"><i class="fas fa-hand-rock"></i></a>
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