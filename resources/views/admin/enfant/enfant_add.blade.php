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
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Enfant</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('user.create') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Enfant <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
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
				<div class="col-12">
					<form novalidate method="POST" action="{{ route('enfant.store')  }} " enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-6">
                            <strong>
                                <h4 style="color: #a0aec0; margin-top: 20px; border-bottom: 1px solid #374151; padding-bottom: 5px;">
                                Informations Personnelles
                              </h4>
                            </strong>

                        <div class="form-group">
								<h5>Image  :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="image" id="image"  class="form-control" required data-validation-required-message="This field is required">
                                </div>
                                <img id="showImage" src="{{ (!empty($editData->image)) ? url('upload/user_image/'.$editData->image) : url('upload/no_image.jpg') }}" alt="" style="width: 100px; height: 100px; border: 1px solid #000;">
                                    @error('image')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
                                    @error('image')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
							</div>
							<div class="form-group">
								<h5> Nom :   <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="nom" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('name')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5> Prenom :   <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="prenom" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('lastname')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                          <div class="form-group">
								<h5> Date Naissance :   <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="date" name="date_naissance" class="form-control date-input" required data-validation-required-message="This field is required"> </div>
                                    @error('birthdate')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                          <div class="form-group">
                                <h5>Sex :  <span class="text-danger">*</span></h5>
                                <select name="gender" id="select" required="" class="form-control" aria-invalid="false">
										<option value="">Genre</option>
										<option value="garçon">Garçon</option>
										<option value="fille">Fille</option>

									</select>
                                    @error('gender')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
                            </div>


                           <div class="form-group">
								<h5>Address :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="address" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('address')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                        </div>
                        <hr style="border: none; border-top: 2px solid #374151; margin: 30px 0;">
                        <div class="col-6">
                            <strong>
                                <h4 style="color: #a0aec0; margin-top: 20px; border-bottom: 1px solid #374151; padding-bottom: 5px;">
                                Informations Médicales
                              </h4>
                            </strong>

                            <div class="form-group">
                                <h5>Allergies :   <span class="text-danger">*</span></h5>
                                <select name="allergies" id="select" required="" class="form-control" aria-invalid="false">
										<option value="">Allergies</option>
										<option value="oui">Oui</option>
										<option value="no">No</option>

									</select>
                                    @error('allergies')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
                            </div>
                         <div class="form-group">
                                <h5>Infos Medicals : <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <textarea name="info_medicals" class="form-control" rows="4" required
                                            data-validation-required-message="This field is required"></textarea>
                                </div>
                                @error('info_medicals')
                                    <div class="text-danger"><strong>{{ $message }}</strong></div>
                                @enderror
                          </div>
                        <div class="form-group">
								<h5>Certaficat Medical  :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="File" name="medical" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('Medical')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
						</div>
                        <div class="form-group">
								<h5>Classe  :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="classe" id="class_enfant_id" class="form-control" required data-validation-required-message="This field is required">
                                        @foreach ($classes as $classes)
                                             <option value="{{ $classes->id }}" data-capacite="{{ $classes->place_disponible }}" >{{ $classes->nom }} </option>
                                        @endforeach
                                    </select>
                                    @error('educatrice')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
                                <div class="mt-3">
                                    <label class="text-danger dispo"> <strong>Le Nombre Disponible : </strong> </label>
                                     <input type="text" id="capacite_dispo" class="form-control text-danger" disabled readonly>
                                </div>
							</div>
                        <div class="form-group">
								<h5> Date Debut :   <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="date" name="date_debut" class="form-control date-input" required data-validation-required-message="This field is required"> </div>
                                    @error('firstday')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
						</div>
                        <div class="form-group">
								<h5> Téléphone Principal :   <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" name="telephone" class="form-control date-input" required data-validation-required-message="This field is required"> </div>
                                    @error('telephone')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
						</div>
                        </div>
					  </div>
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-lg btn-info mb-5" value=" Ajouter Enfant">
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
    $('.dispo').hide();
    $('#capacite_dispo').hide();
    $("#class_enfant_id").change(function(){
        $('.dispo').show();
        $('#capacite_dispo').show();
        var capacite = $(this).find(':selected').data('capacite');
        $('#capacite_dispo').val(capacite);
    });

</script>
<script>
  flatpickr("#date", {
    dateFormat: "d-m-Y",       // شكل التاريخ (يوم-شهر-سنة)
    altInput: true,            // عرض التاريخ بشكل أنيق في الحقل
    altFormat: "j F Y",        // التنسيق الظاهر (مثلاً: 2 نوفمبر 2025)
    locale: "ar",              // اللغة العربية
    minDate: "today",          // يمنع التواريخ السابقة
    allowInput: true,          // يسمح بالكتابة اليدوية
  });
</script>
@endsection
