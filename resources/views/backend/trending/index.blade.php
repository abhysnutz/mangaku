@extends('backend.layout.layout')

@push('css-top')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Trending</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Trending</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Trending List</h3>

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
                                                <th>Rank</th>
                                                <th>Comic</th>
                                                <th>Updated Date</th>
                                                <th>
                                                    <a class="new-trending" href="#" data-toggle="modal" data-target="#modal-form"> New </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="trending-container"></tbody>
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
                                <h3 class="card-title"><b>Trending</b></h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="input-comic" class="col-sm-2 col-form-label">Comic</label>
                                    <div class="col-sm-10">
                                        <select id="comic-select" class="form-control select2 select2-danger" name="comic_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-rank" class="col-sm-2 col-form-label">Rank</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="order" name="order" placeholder="Enter Rank" />
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <input type="hidden" id="id-trending-comic" name="id">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@push('js-bottom')
    <!-- Select2 -->
    <script src="{{ asset('assets/backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        trending_filter();

        $(document).on('click', '.new-trending', function(e){
            e.preventDefault();
            $('.btn-submit').removeClass('btn-update-trending').addClass('btn-store-trending').removeAttr('data-id');
        });

        $(document).on('click', '.edit-trending', function(e){
            e.preventDefault();
            
            let id = $(this).attr('data-id');
            $.ajax({
                url : "{{ route('console.trending.edit') }}",
                method : "POST",
                data : {
                    id : id
                },
                success : function(reply){
                    var datas = {
                        ids: reply.comic.id,
                        texts: reply.comic.title
                    };

                    var newOption = new Option(datas.texts, datas.ids, false, false);
                    $('#comic-select').append(newOption).trigger('change');
                    $("#comic-select").val(reply.comic_id).trigger('change');
                    $('#order').val(reply.order);
                }
            });
            $('.btn-submit').removeClass('btn-store-trending').addClass('btn-update-trending');
            $('#id-trending-comic').val($(this).attr('data-id'));
        });

        $(document).on('click', '.destroy-trending', function(e){
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
                        url : "{{ route('console.trending.destroy') }}",
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
                                        trending_filter();
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


        $(document).on('click', '.btn-store-trending', function(){
            let data = $('#form-create-comic').serialize();

            $.ajax({
                url : "{{ route('console.trending.store') }}",
                method : "POST",
                data : data,
                success : function(reply){
                    $('#modal-form').modal('hide')
                    if(reply.status == 1){
                        Swal.fire(
                            'Success!',
                            'Success Add Comic to Trending',
                            'success'
                        ).then((done) => {
                            if (done.isConfirmed) {
                                trending_filter();
                            } 
                        });
                    }else{
                        Swal.fire('Failed!','Something error at server!','error')
                    }
                }
            });
        });

        $(document).on('click', '.btn-update-trending', function(){
            let data = $('#form-create-comic').serialize();

            $.ajax({
                url : "{{ route('console.trending.update') }}",
                method : "POST",
                data : data,
                success : function(reply){
                    $('#modal-form').modal('hide')
                    if(reply.status == 1){
                        Swal.fire(
                            'Success!',
                            'Success Add Comic to Trending',
                            'success'
                        ).then((done) => {
                            if (done.isConfirmed) {
                                trending_filter();
                            } 
                        });
                    }else{
                        Swal.fire('Failed!','Something error at server!','error')
                    }
                }
            });
        });
        
        $(document).on('keyup', '#search', function(){
            trending_filter();
        });
    
        function trending_filter(){
            search = $('#search').val();

            $.ajax({
                url : "{{ route('console.trending.list') }}",
                method : "POST",
                data : {
                    search : search
                },
                success : function(reply){
                    trending_data(reply.trendings.data, reply.trendings.links, 1, reply.comics)
                }
            });  
        }

        function trending_data(data, links, page, comics){
            $('#trending-container').empty();
            $('#pagination-container').empty();
            
            $.each(data, function(k,v){
                const cons_updated_at = new Date(v.updated_at);
                
                $('#trending-container').append(`
                    <tr>
                        <td>`+v.order+`</td>
                        <td>`+v.comic.title+`</td>
                        <td>`+moment(cons_updated_at).format('DD MMM YYYY | HH:mm:ss')+`</td>
                        <td>
                            <a href="#" class="mr-2 edit-trending" data-toggle="modal" data-target="#modal-form" data-id="`+v.id+`"><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" class="mr-2 destroy-trending" data-id="`+v.id+`"><i class="fas fa-trash-alt"></i></a>
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

            $('#comic-select').empty();
            $.each(comics, function(k,v){
                $('#comic-select').append(`
                    <option value="`+v.id+`">
                        `+v.title+`
                    </option>
                `);
            });
        }
    </script>

    <script>
        $(function () {
            $('.select2').select2()
        })
    </script>
@endpush