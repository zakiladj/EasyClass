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
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Fournisseurs</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('user.create') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Fournisseur <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

         <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Ajouter Fournisseur</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-12">
					<form novalidate method="POST" action="{{ route('fournisseur.store')  }} " enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-6">
                            <strong>
                                <h4 style="color: #a0aec0; margin-top: 20px; border-bottom: 1px solid #374151; padding-bottom: 5px;">
                                Informations générales
                              </h4>
                            </strong>

							<div class="form-group">
								<h5> Nom Commercial :   <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="nom" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('name')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5> 	Raison Sociale :   <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="sociale" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('lastname')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5> 	Telephone 01 :   <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" name="phone1" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('phone1')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                           <div class="form-group">
								<h5> 	Telephone 02 :   <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" name="phone2" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('phone2')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>

                          <div class="form-group">
                                <h5>Type :  <span class="text-danger">*</span></h5>
                                <select name="type" id="select" required="" class="form-control" aria-invalid="false">
										<option value="" selected disabled>--- Select Type ---</option>
										<option value="personne">Personne</option>
										<option value="entreprise">Entreprise</option>
										<option value="autre">Autre</option>

									</select>
                                    @error('type')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
                            </div>
                            <div class="form-group">
								<h5> 	Email  :   <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" name="email" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('email')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
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
                                Informations financières
                              </h4>
                            </strong>
                           <div class="form-group">
								<h5>Banque  :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="banque" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('banque')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                         <div class="form-group">
								<h5>Rip / CCP :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number " name="rip" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('rip')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
						</div>
                        <div class="form-group">
								<h5>BaradiMob  :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="baradi_mob" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('baradi_mob')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
						</div>
                        <div class="form-group">
								<h5>Categorie  :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="categorie" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('categorie')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                         <div class="form-group">
                                <h5>Note : <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <textarea name="note" class="form-control" rows="4" required
                                            data-validation-required-message="This field is required"></textarea>
                                </div>
                                @error('note')
                                    <div class="text-danger"><strong>{{ $message }}</strong></div>
                                @enderror
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
