@extends('backend.layout.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Audit User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Audit User</li>
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
                                <h3 class="card-title">Responsive Hover Table</h3>
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
                                            <th>Tags</th>
                                            <th>Message</th>
                                            <th>URL</th>
                                            <th>IP Address</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="audit-user-container">
                                        
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
    {{-- <script src="/js/app.js"></script> --}}

    </div>

@endsection

@push('js-bottom')
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
        });

        var channel = pusher.subscribe('user-activity');
        channel.bind('App\\Events\\userActivity', function(e) {
            const cons_created_at = new Date(e.activity.created_at);
            
            $('#audit-user-container').prepend(`
                <tr>
                    <td>`+e.activity.tags+`</td>
                    <td>`+e.activity.msg+`</td>
                    <td>
                        <a href="`+e.activity.url+`" target="_blank">
                            `+e.activity.url+`
                        </a>
                    </td>
                    <td>`+e.activity.ip_address+`</td>
                    <td>`+moment(cons_created_at).format('DD MMM YYYY | HH:mm:ss')+`</td>
                </tr>
            `);
        });
    </script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        
        auditUser_filter();

        $(document).on('click', '.paginate-link', function(){
            let page = $(this).text();
            search = $('#search').val();
            
            $.ajax({
                url:"{{ route('console.audit.user.list') }}?page="+page,
                method : "POST",
                data : {
                    search : search
                },
                success:function(reply){
                    auditUser_data(reply.data, reply.links, page)
                }
            });
        });

        $(document).on('keyup', '#search', function(){
            auditUser_filter();
        });

    
        function auditUser_filter(){
            search = $('#search').val();

            $.ajax({
                url : "{{ route('console.audit.user.list') }}",
                method : "POST",
                data : {
                    search : search
                },
                success : function(reply){
                    auditUser_data(reply.data, reply.links, 1)
                }
            });  
        }

        function auditUser_data(data, links, page){
            $('#audit-user-container').empty();
            $('#pagination-container').empty();
            $.each(data, function(k,v){
                const cons_created_at = new Date(v.created_at);
                let date = moment(cons_created_at).format('DD MMM YYYY | HH:mm:ss');

                $('#audit-user-container').append(`
                    <tr>
                        <td>`+v.tags+`</td>
                        <td>`+v.msg+`</td>
                        <td>
                            <a href="`+v.url+`" target="_blank">
                                `+v.url+`
                            </a>
                        </td>
                        <td>`+v.ip_address+`</td>
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