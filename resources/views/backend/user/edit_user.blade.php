@extends('admin.admin_master')
@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Parents </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Parents</li>
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
			  <h4 class="box-title">Ajouter Parent</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form novalidate method="POST" action="{{ route('user.update', $editData->id) }}') }}" enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-12">
                           <div class="form-group">
                                <h5>User Type :  <span class="text-danger">*</span></h5>
                                <select name="usertype" id="select" value="{{ $editData->usertype }}" required="" class="form-control" aria-invalid="false">
										<option value="">User Type</option>
										<option value="admin" {{ $editData->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
										<option value="user" {{ $editData->usertype == 'user' ? 'selected' : '' }}>User</option>

									</select>
                                    @error('usertype')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
                            </div>
							<div class="form-group">
								<h5>Full Name :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" value="{{ $editData->name }}" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('name')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                             <div class="form-group">
                                <h5>Gender :  <span class="text-danger">*</span></h5>
                                <select name="gender" id="select" value="{{ $editData->gender }}" required="" class="form-control" aria-invalid="false">
										<option value="">Gender</option>
										<option value="male" {{ $editData->gender == 'male' ? 'selected' : '' }}>Male</option>
										<option value="female" {{ $editData->gender == 'female' ? 'selected' : '' }}>Female</option>

									</select>
                                    @error('gender')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
                            </div>
                           <div class="form-group">
								<h5>Address :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="address" value="{{ $editData->address }}" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('address')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Mobile :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="mobile" value="{{ $editData->mobile }}" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('mobile')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>

							<div class="form-group">
								<h5>Email Field <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" name="email" value="{{ $editData->email }}" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('email')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
							</div>
                            <div class="form-group">
								<h5>Image  :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="image" id="image" value="{{ $editData->image }}" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                                    @error('email')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
							</div>
                            <div class="form-group">
								<h5>Image  :  <span class="text-danger">*</span></h5>
								<div class="controls">
                                </div>
                                    <img id="showImage" src="{{ (!empty($editData->image)) ? url('upload/user_image/'.$editData->image) : url('upload/no_image.jpg') }}" alt="" style="width: 100px; height: 100px; border: 1px solid #000;">
                                    @error('email')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
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
