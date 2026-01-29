@extends('admin.admin_master')
@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Classes </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Catégories financières</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('classes.add') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Catégories financières  <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

        <div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title"> <span class="text-success"> <strong> Ajouter Catégorie financière </strong></span></h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form novalidate method="POST" action="{{ route('finance.store')  }} " enctype="multipart/form-data">
                        @csrf
					  <div class="row">
                        <div class="col-12">
							<div class="form-group">
								<h5>Nom  :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="nom" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('classe')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Type  :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="type" id="type_frais" class="form-control" required data-validation-required-message="This field is required">
                                             <option value="" selected disabled>-- Choisir le type --</option>
                                             <option value="revenu">Revenu</option>
                                             <option value="charges">Charges</option>

                                    </select>
                                    @error('type')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>

							</div>
                            <div class="form-group">
								<h5>Note :  <span class="text-danger">*</span></h5>
								  <div class="controls">
                                    <textarea name="note" class="form-control" rows="4" required
                                            data-validation-required-message="This field is required"></textarea>
                                    </div>
                                    @error('description')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
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
