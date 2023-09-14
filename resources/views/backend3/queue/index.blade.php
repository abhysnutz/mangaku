@extends('backend.layout.layout')

@push('css-top')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <style>
        #queue-container > tr > td > a{
            color:#a12f2f;
            -webkit-filter: brightness(100%);
        }
        #queue-container > tr > td > a:hover{
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
                        <h1>Queue</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Queue</li>
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
                                <h3 class="card-title">Queue List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Create</th>
                                            <th>Progress</th>
                                            <th>Update</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="queue-container"></tbody>
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
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
        });

        var channel = pusher.subscribe('queue.store');
        channel.bind('App\\Events\\QueueEvent', function(e) {
            const cons_created_at = new Date(e.message.created_at);
            const cons_updated_at = new Date(e.message.updated_at);
            let badge = (e.message.status == 0 ? 'badge-warning' : (e.message.status == 1 ? 'badge-primary' : 'badge-success'));
            let word = (e.message.status == 0 ? 'Pending' : (e.message.status == 1 ? 'Progress' : 'Success'));

            $('#queue-container').prepend(`
                <tr>
                    <td class="align-middle">`+e.message.title+`</td>
                    <td class="status-queue-`+e.message.id+` align-middle">
                        <span class="badge badge-pill `+badge+`"> `+word+` </span>    
                    </td>
                    <td>`+moment(cons_created_at).format('DD MMM YYYY | HH:mm:ss')+`</td>
                    <td class="progressed-queue-`+e.message.id+`"> - </td>
                    <td class="updated-queue-`+e.message.id+`">`+moment(cons_updated_at).format('DD MMM YYYY | HH:mm:ss')+`</td>
                    <td><a href="#" class="queue-destroy" data-id="`+e.message.id+`"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            `);
        });

        var channel = pusher.subscribe('queue.update');
        channel.bind('App\\Events\\QueueEvent', function(e) {
            const cons_created_at = new Date(e.message.created_at);
            const cons_progressed_at = new Date(e.message.progressed_at);
            const cons_updated_at = new Date(e.message.updated_at);

            let badge = (e.message.status == 0 ? 'badge-warning' : (e.message.status == 1 ? 'badge-primary' : 'badge-success'));
            let word = (e.message.status == 0 ? 'Pending' : (e.message.status == 1 ? 'Progress' : 'Success'));

            $('.status-queue-'+e.message.id).empty().html('<span class="badge badge-pill '+badge+' "> '+word+' </span>')
            $('.progressed-queue-'+e.message.id).empty().text(moment(cons_progressed_at).format('DD MMM YYYY | HH:mm:ss'))
            $('.updated-queue-'+e.message.id).empty().text(moment(cons_updated_at).format('DD MMM YYYY | HH:mm:ss'))
        });
    </script>

    <script>
        queue_filter();

        $(document).on('click', '.queue-destroy', function(e){
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
                        url : "{{ route('console.queue.destroy') }}",
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
                                        queue_filter();
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
       
        function queue_filter(){
            search = $('#search').val();

            $.ajax({
                url : "{{ route('console.queue.list') }}",
                method : "POST",
                data : {
                    search : search
                },
                success : function(reply){
                    queue_data(reply.data, reply.links, 1)
                }
            });  
        }


        function queue_data(data, links, page){
            $('#queue-container').empty();
            $('#pagination-container').empty();
            
            $.each(data, function(k,v){
                const cons_created_at = new Date(v.created_at);
                const cons_progressed_at = (v.progressed_at) ? new Date(v.progressed_at) : null;
                const cons_updated_at = new Date(v.updated_at);
                let badge = (v.status == 0 ? 'badge-warning' : (v.status == 1 ? 'badge-primary' : 'badge-success'));
                let word = (v.status == 0 ? 'Pending' : (v.status == 1 ? 'Progress' : 'Success'));
                
                $('#queue-container').append(`
                    <tr>
                        <td class="align-middle">`+v.title+`</td>
                        <td class="status-queue-`+v.id+` align-middle" >
                            <span class="badge badge-pill `+badge+`"> `+word+` </span>
                        </td>
                        <td class="align-middle">`+moment(cons_created_at).format('DD MMM YYYY | HH:mm:ss')+`</td>
                        <td class="progressed-queue-`+v.id+` align-middle">`+((cons_progressed_at) ? moment(cons_progressed_at).format('DD MMM YYYY | HH:mm:ss') : '-')+`</td>
                        <td class="updated-queue-`+v.id+` align-middle">`+moment(cons_updated_at).format('DD MMM YYYY | HH:mm:ss')+`</td>
                        <td>
                            <a href="#" class="queue-destroy" data-id="`+v.id+`"><i class="fas fa-trash-alt"></i></a>
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