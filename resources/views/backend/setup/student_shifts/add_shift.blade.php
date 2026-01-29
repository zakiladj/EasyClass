@extends('admin.admin_master')
@section('admin_content')
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Shift </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">Ajouter Une Shift Student</li>
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
			  <h4 class="box-title">Update Shift Student</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form novalidate method="POST" action="{{ route('shift.update')  }} " enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-12">

							<div class="form-group">
								<h5>Shift  Name :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name"   class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('name')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
							</div>
                             <div class="form-group">
                                        <h5>Start Time: <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="time" name="start_time"  class="form-control timepicker" required data-validation-required-message="This field is required">
                                        </div>
                                        @error('start_time')
                                            <div class="text-danger"><strong>{{ $message }}</strong></div>
                                        @enderror
                             </div>

                            <div class="form-group">
                                <h5>End Time: <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="time" name="end_time"  class="form-control timepicker" required data-validation-required-message="This field is required">
                                </div>
                                @error('end_time')
                                    <div class="text-danger"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>


							<div class="form-group">
                                <h5>Description : <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <textarea name="description" class="form-control" rows="4" required
                                            data-validation-required-message="This field is required">   </textarea>
                                </div>
                                @error('description')
                                    <div class="text-danger"><strong>{{ $message }}</strong></div>
                                @enderror
                          </div>


					  </div>


						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info mb-5" value="Insert User">
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- اللغة العربية -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>


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
<script>
flatpickr(".timepicker", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    locale: "en"
});
</script>
@endsection
