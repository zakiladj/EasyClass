@extends('admin.admin_master')
@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Enfant </h3>
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
                    <a href="{{ route('user.create') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent  <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

                  		  <div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title"> <span class="text-success"> <strong> Le Paiement de  {{ $control->employes->nom }} {{ $control->employes->prenom }} </strong></span></h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form novalidate method="POST" action="{{ route('action.store')  }} " enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-12">


							<div class="form-group">
                                <input type="hidden" name="control_id" value="{{ $control->id }}">
								<h5>Le Salaire Net :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" value="{{ $control->salary_total }} DA" readonly name="salary_total" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('salary_total')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Total payé :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="paid_total" value="{{ $control->paid_total }} DA" readonly class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('paid_total')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Reste à payer :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="rest"  value="{{ $control->rest }} DA" readonly  class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('rest')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                          <div class="form-group">
                                <h5>Operation :  <span class="text-danger">*</span></h5>
                                <select name="type_action" id="select" required="" class="form-control" aria-invalid="false">
										<option value="" selected disabled>--- Select Type ---</option>
                                            @foreach($types as $key => $label)
                                                <option value="{{ $key }}" {{ old('type_action') == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach

								</select>
                                    @error('type')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
                            </div>
                            <div class="form-group">
								<h5>Montant :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" name="amount" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('montant')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>

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
