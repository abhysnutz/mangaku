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
                        <h1>Change Password</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
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
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="input-old" class="col-sm-2 col-form-label">Old Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" id="input-old" class="form-control" placeholder="Enter Old Password" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-new" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" id="input-new" class="form-control" placeholder="Enter New Password" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-confirm" class="col-sm-2 col-form-label">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" id="input-confirm" class="form-control" placeholder="Enter Confirm Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-primary btn-change-password">Submit</button>
                                </div>
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

        $(document).ready(function(){
            
            $(document).on('click', '.btn-change-password', async function(){
                let old = $('#input-old').val();
                let newp = $('#input-new').val();
                let confirm = $('#input-confirm').val();
                let error = 0;
                $('.error').remove();

                if(old.length == 0){
                    $(`<span class="error" style="color: red; font-size:13px;"> Old Password is required</span>`).insertAfter('#input-old');
                    error += 1;
                }else{
                    if(await oldpassword(old) === false){
                        $(`<span class="error" style="color: red; font-size:13px;"> Old Password is Missmatch</span>`).insertAfter('#input-old');
                        error += 1;
                    }
                }

                if(newp.length == 0){
                    $(`<span class="error" style="color: red; font-size:13px;"> New Password is required</span>`).insertAfter('#input-new');
                    error += 1;
                }else{
                    if(confirm.length == 0){
                        $(`<span class="error" style="color: red; font-size:13px;"> Confirm Password is required</span>`).insertAfter('#input-confirm');
                        error += 1;
                    }else{
                        if(newp !== confirm){
                            $(`<span class="error" style="color: red; font-size:13px;"> New Password and Confirm Password is Missmatch</span>`).insertAfter('#input-confirm'); 
                            error += 1;
                        }
                    }
                }

                if(error == 0){
                    return updatePassword(confirm);
                }
            });
        })

        const oldpassword = old => $.post("{{ route('console.setting.password.check') }}", {old}, result => result )

        const updatePassword = password => {
            $.ajax({
                url : "{{ route('console.setting.password.update') }}",
                method : "POST",
                data : { password },
                success: reply => {
                    if(reply){
                        Swal.fire(
                            'Success!',
                            'Password Has Been Changed',
                            'success'
                        ).then((done) => {
                            if (done.isConfirmed) {
                                location.reload();
                            } 
                        })
                    }else{
                        Swal.fire('Failed!','Something error at server!','error')
                    }
                }
            });
        }
    </script>
@endpush    