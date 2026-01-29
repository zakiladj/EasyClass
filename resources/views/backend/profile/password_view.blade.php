@extends('admin.admin_master')
@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Change Password </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">Change Password</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('user.create') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

                  		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Change Password</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
                    <form novalidate method="POST" action="{{ route('password.update') }} ">

                        @csrf
					  <div class="row">
						<div class="col-12">



                            <div class="form-group">
                                <h5> Old Password  <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="password" name="oldpassword" class="form-control" required data-validation-required-message="This field is required">
                                      @error('oldpassword')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror

                                 </div>

						</div>



                            <div class="form-group">
                                <h5>Password Field <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="password" name="password" class="form-control" required data-validation-required-message="This field is required">
                                      @error('password')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                     @enderror

                                 </div>

						</div>
                        	<div class="form-group">
								<h5> Password Confirmation <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="password_confirmation" data-validation-match-match="password" class="form-control" required> </div>
                                     @error('password_confirmation')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                     @enderror
							</div>

					  </div>


						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info mb-5" value="Update User">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>
  </div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


@endsection
