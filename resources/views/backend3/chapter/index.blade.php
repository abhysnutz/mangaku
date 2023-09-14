@extends('backend.layout.layout')

@push('css-top')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <style>
        #chapter-container > tr > td > a{
            color:#a12f2f;
            -webkit-filter: brightness(100%);
        }
        #chapter-container > tr > td > a:hover{
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
                        <h1>Chapter</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Chapter</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                   
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Comic</label>
                                    <select id="comic-select" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        @foreach ($comics as $key => $comic)
                                            <option value="{{ $comic->id }}">
                                                {{ $comic->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Chapter List</h3>

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
                                            <th>No</th>
                                            <th>Chapter</th>
                                            {{-- <th>URL</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="chapter-container"></tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right" id="pagination-container"></ul>
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

    
    <!-- Modal -->
    <div class="modal fade" id="modal-preview" tabindex="-1" role="dialog" aria-labelledby="modal-previewTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-previewTitle">Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12" id="container-image">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@endsection

@push('js-bottom')
    <!-- Select2 -->
    <script src="{{ asset('assets/backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        
        chapter_filter();

        $(document).on('change', '#comic-select', function(){
            chapter_filter();
        });

        $(document).on('keyup', '#search', function(){
            chapter_filter();
        });

        $(document).on('click', '.chapter-view', function(){
            let id = $(this).data('id');

            $.ajax({
                url : "{{ route('console.chapter.show') }}",
                method : "POST",
                data : {
                    id : id
                },
                success:function(reply){
                    if(reply.status == 1){
                        $('#container-image').empty();
                        $.each(reply.images, function(k,v){
                            $('#container-image').append(`
                                <img src="`+v.url+`" class=" ww `+(k != 0 ? 'klazy' : '')+` img-fluid">
                            `);
                        })
                    }
                }
            })
        })

        $(document).on('click', '.chapter-destroy', function(e){
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
                        url : "{{ route('console.chapter.destroy') }}",
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
                                        chapter_filter();
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

        $(document).on('click', '.chapter-grabber', function(e){
            e.preventDefault();
            let id = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do You Want to Grab This Chapter?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Grab It!'
            }).then((result) => {
                if (result.isConfirmed) {
                    chapter_grabber(id)
                }
            });
        });

        function chapter_filter(){
            search = $('#search').val();
            comic_id = $('#comic-select').val();

            $.ajax({
                url : "{{ route('console.chapter.list') }}",
                method : "POST",
                data : {
                    search : search,
                    comic_id : comic_id
                },
                success : function(reply){
                    chapter_data(reply)
                }
            });  
        }

        function chapter_data(data){
            console.log(data);
            $('#chapter-container').empty();
            $('#pagination-container').empty();
            
            $.each(data, function(k,v){
                $('#chapter-container').append(`
                    <tr>
                        <td>${k + 1}</td>
                        <td>`+v.title+`</td>
                        <td class='d-none'>
                            <a href="`+v.url+`" target="_blank">
                                URL
                            </a>
                        </td>
                        <td>
                            <a href="#" class="mr-2 chapter-view" data-toggle="modal" data-target="#modal-preview" data-id="`+v.id+`"><i class="far fa-eye"></i></a>
                            <a href="#" class="mr-2 d-none"><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" class="mr-2 chapter-destroy" data-id="`+v.id+`"><i class="fas fa-trash-alt"></i></a>
                            <a href="#" class="chapter-grabber d-none" data-id="`+v.id+`"><i class="fas fa-hand-rock"></i></a>
                        </td>
                    </tr>
                `);
            });
        }

        function chapter_grabber(id){
            $.ajax({
                url : "{{ route('console.chapter.queue') }}",
                method : "POST",
                data : {
                    id : id
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
    </script>

    <script>
        $(function () {
            $('.select2').select2()
        })
    </script>
    
@endpush