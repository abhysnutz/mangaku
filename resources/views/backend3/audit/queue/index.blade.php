@extends('backend.layout.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Audit Queue</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Audit Queue</li>
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
                                <h3 class="card-title">Audit Queue</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm d-none" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
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
                                            <th>Queue</th>
                                            <th>Status</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="audit-queue-container">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right" id="pagination-container">
                                    
                                </ul>
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

        var channel = pusher.subscribe('grabber.all.comic');
        channel.bind('App\\Events\\Audit\\QueueEvent', function(e) {
            let audit = e.message;
            let badge = (audit.status == 0 ? 'badge-danger' : 'badge-success');
            let word = (audit.status == 0 ? 'Failed' :  'Success');
            const cons_created_at = new Date(audit.created_at);

            $('#audit-queue-container').prepend(`
                <tr>
                    <td>`+audit.queue.title+`</td>
                    <td>
                        <span class="badge badge-pill `+badge+`"> `+word+` </span>
                    </td>
                    <td>`+audit.msg+`</td>
                    <td>`+moment(cons_created_at).format('DD MMM YYYY | HH:mm:ss')+`</td>
                </tr>
            `);
        });
    </script>
   
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        
        auditQueue_filter();

        $(document).on('click', '.paginate-link', function(){
            let page = $(this).text();
            search = $('#search').val();
            
            $.ajax({
                url:"{{ route('console.audit.queue.list') }}?page="+page,
                method : "POST",
                data : {
                    search : search
                },
                success:function(reply){
                    auditQueue_data(reply.data, reply.links, page)
                }
            });
        });

        $(document).on('keyup', '#search', function(){
            auditQueue_filter();
        });

        function auditQueue_filter(){
            search = $('#search').val();

            $.ajax({
                url : "{{ route('console.audit.queue.list') }}",
                method : "POST",
                data : {
                    search : search
                },
                success : function(reply){
                    auditQueue_data(reply.data, reply.links, 1)
                }
            });  
        }

        function auditQueue_data(data, links, page){
            $('#audit-queue-container').empty();
            $('#pagination-container').empty();
            
            $.each(data, function(k,v){
                const cons_created_at = new Date(v.created_at);
                let date = moment(cons_created_at).format('DD MMM YYYY | HH:mm:ss');
                let badge = (v.status == 0 ? 'badge-danger' : 'badge-success');
                let word = (v.status == 0 ? 'Failed' :  'Success');

                $('#audit-queue-container').append(`
                    <tr>
                        <td>`+v.queue.title+`</td>
                        <td>
                            <span class="badge badge-pill `+badge+`"> `+word+` </span>
                        </td>
                        <td>`+v.msg+`</td>
                        <td>`+date+`</td>
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