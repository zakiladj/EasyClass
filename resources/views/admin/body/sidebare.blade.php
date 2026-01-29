@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp



  <!-- Left side column. contains the logo and sidebar -->
  <!-- sidebar: style can be found in sidebar.less -->


<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">

						  <img src="{{ asset('backend/images/logo-light.png') }}" alt="Logo EasyClass">
						  <h3><b>EasyClass +</b> Admin</h3>
					 </div>
				</a>
			</div>
        </div>

      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">

		<li class="{{ ($route == 'dashboard')?'active':'' }} " >
          <a href="{{ route('dashboard') }}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>
      {{-- User Section  --}}
        {{-- <li class="treeview {{ ($prefix == '/users')?'active':'' }} "   > --}}
        <li class="treeview {{ Request::is('admin/users/*') || Request::is('admin/users') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="users"></i>
            <span>Manage Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user.view') }}"><i data-feather="eye"></i> View Users</a></li>
            <li><a href="{{ route('user.create') }}"><i data-feather="user-plus"></i> Add User</a></li>
          </ul>
        </li>
        {{-- Manger Section  --}}

        <li class="treeview {{ Request::is('admin/enfant/*') || Request::is('admin/enfant') ? 'active' : '' }}">
            <a href="#">
              <i data-feather="user"></i>
                <span>Liste Des  Enfants</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('enfant.view') }}"><i data-feather="folder"></i> Dossier  Enfants</a></li>
                <li><a href="{{ route('enfant.add') }}"><i data-feather="plus"></i> Ajouter  Enfant</a></li>
                <li><a href="{{ route('abmenfant.view') }}"><i data-feather="repeat"></i> Abonnement  Enfant</a></li>
                <li><a href="{{ route('abmenfant.reste') }}"><i data-feather="alert-circle"></i> Reste  Paiements</a></li>


            </ul>
        </li>
        {{-- <li class="treeview {{ ($prefix == '/abonnement')?'active':'' }} " > --}}
        <li class="treeview {{ Request::is('admin/abonnement/*') || Request::is('admin/abonnement') ? 'active' : '' }}">
            <a href="#">
              <i data-feather="refresh-cw"></i>
                <span>Abonnement</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('abonnement.view') }}"><i data-feather="layers"></i> Liste Des   Abonnements</a></li>
                <li><a href="{{ route('abonnement.add') }}"><i data-feather="plus"></i> Ajouter  Abonnement</a></li>
            </ul>
        </li>
        {{-- <li class="treeview {{ ($prefix == '/employes')?'active':'' }} " > --}}
        <li class="treeview {{ Request::is('admin/employes/*') || Request::is('admin/employes') ? 'active' : '' }}">
            <a href="#">
              <i data-feather="user-check"></i>
                <span>Les Employes</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('employes.view') }}"><i data-feather="users"></i> Liste Des   Employes</a></li>
                <li><a href="{{ route('employes.add') }}"><i data-feather="user-plus"></i> Ajouter  Employe</a></li>
            </ul>
        </li>
        {{-- <li class="treeview {{ ($prefix == '/classes')?'active':'' }} " > --}}
        <li class="treeview {{ Request::is('admin/classes/*') || Request::is('admin/classes') ? 'active' : '' }}">
            <a href="#">
              <i data-feather="book"></i>
                <span>Les Classes</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('classes.view') }}"><i data-feather="grid"></i> Liste Des   Classes</a></li>
                <li><a href="{{ route('classes.add') }}"><i data-feather="plus-square"></i> Ajouter  Classe</a></li>
            </ul>
        </li>
        {{-- <li class="treeview {{ ($prefix == '/finance')?'active':'' }} " > --}}
        <li class="treeview {{ Request::is('admin/finance/*') || Request::is('admin/finance') ? 'active' : '' }}">
            <a href="#">
              <i data-feather="dollar-sign"></i>
                <span>Finance</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('finance.view') }}"><i data-feather="layers"></i> Liste   catégories</a></li>
                <li><a href="{{ route('finance.add') }}"><i data-feather="plus"></i> Ajouter  catégorie</a></li>
                <li><a href="{{ route('charge.view') }}"><i data-feather="shopping-cart"></i> Liste   Charges</a></li>
                <li><a href="{{ route('charge.add') }}"><i data-feather="plus-circle"></i> Ajouter  Charges</a></li>


            </ul>
        </li>
     <li class="treeview {{ Request::is('admin/fournisseurs/*') || Request::is('admin/fournisseurs') ? 'active' : '' }}">
            <a href="#">
             <i data-feather="truck"></i>
                <span>Les Fournisseurs</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('fournisseur.view') }}"><i data-feather="users"></i> Liste   Fournisseurs</a></li>
                <li><a href="{{ route('fournisseur.add') }}"><i data-feather="plus"></i> Ajouter  Fournisseur</a></li>


            </ul>
        </li>
    <li class="treeview {{ Request::is('admin/Paiement/*') || Request::is('admin/Paiement') ? 'active' : '' }}">
            <a href="#">
             <i data-feather="briefcase"></i>
                <span>Paiement Employé</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('paiement.add') }}"><i data-feather="settings"></i> Ouvrir la paie du mois</a></li>
                <li><a href="{{ route('paiement.view') }}"><i data-feather="plus"></i>  Paiements  des Employés </a></li>


            </ul>
     </li>
    <li class="treeview {{ Request::is('admin/chart/*') || Request::is('admin/chart') ? 'active' : '' }}">
            <a href="#">
             <i data-feather="pie-chart"></i>
                <span>statistiques</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('chart.js') }}"><i data-feather="bar-chart-2"></i> Statistiques </a></li>
                <li><a href="{{ route('employe.chart.js') }}"><i data-feather="pie-chart"></i>  Paiements  des Employés </a></li>
                <li><a href="{{ route('enfant.chart.js') }}"><i data-feather="pie-chart"></i>  Paiements  des Enfants </a></li>
                <li><a href="{{ route('charge.chart.js') }}"><i data-feather="percent"></i>  Charges / Revenus</a></li>


            </ul>
     </li>
        <li class="treeview {{ ($prefix == '/setups')?'active':'' }} " >
            <a href="#">
              <i data-feather="user"></i>
                <span>Setup Management</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">

                    <li><a href="{{ route('student.class.view') }}"><i data-feather="info"></i> Student Class View</a></li>
                    <li><a href="{{ route('student.class.add') }}"><i data-feather="plus"></i> Add  Class </a></li>


                <li><a href="{{ route('student.year.view') }}"><i data-feather="layers"></i> Student Years</a></li>
                <li><a href="{{ route('student.year.add') }}"><i data-feather="plus"></i> Add  Year </a></li>
                <li><a href="{{ route('student.group.view') }}"><i data-feather="grid"></i> Student Group </a></li>
                <li><a href="{{ route('student.group.add') }}"><i data-feather="plus"></i> Add  Group </a></li>
                <li><a href="{{ route('student.shift.view') }}"><i data-feather="clock"></i> Student Shift </a></li>
                <li><a href="{{ route('student.shift.add') }}"><i data-feather="plus"></i> Add  Shift  </a></li>
                <li><a href="{{ route('student.fee.category.view') }}"><i data-feather="eye"></i> Fee   Category  </a></li>
                <li><a href="{{ route('student.fee.category.add') }}"><i data-feather="plus"></i> Add  Fee  </a></li>
                <li><a href="{{ route('fee.category.amount') }}"><i data-feather="dollar-sign"></i> Fee Amount </a></li>





            </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i data-feather="mail"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="mailbox_inbox.html"><i class="ti-more"></i>Inbox</a></li>
            <li><a href="mailbox_compose.html"><i class="ti-more"></i>Compose</a></li>
            <li><a href="mailbox_read_mail.html"><i class="ti-more"></i>Read</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="profile.html"><i class="ti-more"></i>Profile</a></li>
            <li><a href="invoice.html"><i class="ti-more"></i>Invoice</a></li>
            <li><a href="gallery.html"><i class="ti-more"></i>Gallery</a></li>
            <li><a href="faq.html"><i class="ti-more"></i>FAQs</a></li>
            <li><a href="timeline.html"><i class="ti-more"></i>Timeline</a></li>
          </ul>
        </li>

        <li class="header nav-small-cap">User Interface</li>

        <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Components</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
            <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
            <li><a href="components_buttons.html"><i class="ti-more"></i>Buttons</a></li>
          </ul>
        </li>

		<li class="treeview">
          <a href="#">
            <i data-feather="credit-card"></i>
            <span>Cards</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
			<li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
			<li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
		  </ul>
        </li>


		<li>
          <a href="{{ route('admin.logout') }}">
            <i data-feather="lock"></i>
			<span>Log Out</span>
          </a>
        </li>

      </ul>
    </section>

	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="{{ route('admin.logout') }}" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>

   <aside class="control-sidebar">

	<div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger"><i class="ion ion-close text-white" data-toggle="control-sidebar"></i></span> </div>  <!-- Create the tabs -->
    <ul class="nav nav-tabs control-sidebar-tabs">
      <li class="nav-item"><a href="#control-sidebar-home-tab" data-toggle="tab" class="active">Chat</a></li>
      <li class="nav-item"><a href="#control-sidebar-settings-tab" data-toggle="tab">Todo</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
          <div class="flexbox">
			<a href="javascript:void(0)" class="text-grey"><i class="ti-minus"></i></a>
			<p>Users</p>
			<a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>
		  </div>
		  <div class="lookup lookup-sm lookup-right d-none d-lg-block">
			<input type="text" name="s" placeholder="Search" class="w-p100">
		  </div>
          <div class="media-list media-list-hover mt-20">
			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-success" href="#">
				<img src="{{ asset('backend/images/avatar/.jpg') }}">
			  </a>
			  <div class="media-body">
				<p class="font-size-16">
				  <a class="hover-primary" href="#"><strong>Tyler</strong></a>
				</p>
				<p>Praesent tristique diam...</p>
				  <span>Just now</span>
			  </div>
			</div>

			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-danger" href="#">

				<img src="{{ asset('backend/images/avatar/2.jpg') }}">
			  </a>
			  <div class="media-body">
				<p class="font-size-16">
				  <a class="hover-primary" href="#"><strong>Luke</strong></a>
				</p>
				<p>Cras tempor diam ...</p>
				  <span>33 min ago</span>
			  </div>
			</div>

			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-warning" href="#">
				<img src="{{ asset('backend/images/avatar/3.jpg') }}" alt="...">
			  </a>
			  <div class="media-body">
				<p class="font-size-16">
				  <a class="hover-primary" href="#"><strong>Evan</strong></a>
				</p>
				<p>In posuere tortor vel...</p>
				  <span>42 min ago</span>
			  </div>
			</div>

			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-primary" href="#">
				<img src="{{ asset('backend/images/avatar/4.jpg') }}" alt="...">
			  </a>
			  <div class="media-body">
				<p class="font-size-16">
				  <a class="hover-primary" href="#"><strong>Evan</strong></a>
				</p>
				<p>In posuere tortor vel...</p>
				  <span>42 min ago</span>
			  </div>
			</div>

			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-success" href="#">
				<img src="{{ asset('backend/images/avatar/1.jpg') }}">
			  </a>
			  <div class="media-body">
				<p class="font-size-16">
				  <a class="hover-primary" href="#"><strong>Tyler</strong></a>
				</p>
				<p>Praesent tristique diam...</p>
				  <span>Just now</span>
			  </div>
			</div>

			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-danger" href="#">
				<img src={{ asset('backend/images/avatar/2.jpg') }}>
			  </a>
			  <div class="media-body">
				<p class="font-size-16">
				  <a class="hover-primary" href="#"><strong>Luke</strong></a>
				</p>
				<p>Cras tempor diam ...</p>
				  <span>33 min ago</span>
			  </div>
			</div>

			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-warning" href="#">
				<img src="{{ asset('backend/images/avatar/3.jpg') }}" alt="...">
			  </a>
			  <div class="media-body">
				<p class="font-size-16">
				  <a class="hover-primary" href="#"><strong>Evan</strong></a>
				</p>
				<p>In posuere tortor vel...</p>
				  <span>42 min ago</span>
			  </div>
			</div>

			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-primary" href="#">
				<img src="{{ asset('backend/images/avatar/4.jpg') }}" alt="...">
			  </a>
			  <div class="media-body">
				<p class="font-size-16">
				  <a class="hover-primary" href="#"><strong>Evan</strong></a>
				</p>
				<p>In posuere tortor vel...</p>
				  <span>42 min ago</span>
			  </div>
			</div>

		  </div>

      </div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
          <div class="flexbox">
			<a href="javascript:void(0)" class="text-grey"><i class="ti-minus"></i></a>
			<p>Todo List</p>
			<a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>
		  </div>
        <ul class="todo-list mt-20">
			<li class="py-15 px-5 by-1">
			  <!-- checkbox -->
			  <input type="checkbox" id="basic_checkbox_1" class="filled-in">
			  <label for="basic_checkbox_1" class="mb-0 h-15"></label>
			  <!-- todo text -->
			  <span class="text-line">Nulla vitae purus</span>
			  <!-- Emphasis label -->
			  <small class="badge bg-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
			  <!-- General tools such as edit or delete-->
			  <div class="tools">
				<i class="fa fa-edit"></i>
				<i class="fa fa-trash-o"></i>
			  </div>
			</li>
			<li class="py-15 px-5">
			  <!-- checkbox -->
			  <input type="checkbox" id="basic_checkbox_2" class="filled-in">
			  <label for="basic_checkbox_2" class="mb-0 h-15"></label>
			  <span class="text-line">Phasellus interdum</span>
			  <small class="badge bg-info"><i class="fa fa-clock-o"></i> 4 hours</small>
			  <div class="tools">
				<i class="fa fa-edit"></i>
				<i class="fa fa-trash-o"></i>
			  </div>
			</li>
			<li class="py-15 px-5 by-1">
			  <!-- checkbox -->
			  <input type="checkbox" id="basic_checkbox_3" class="filled-in">
			  <label for="basic_checkbox_3" class="mb-0 h-15"></label>
			  <span class="text-line">Quisque sodales</span>
			  <small class="badge bg-warning"><i class="fa fa-clock-o"></i> 1 day</small>
			  <div class="tools">
				<i class="fa fa-edit"></i>
				<i class="fa fa-trash-o"></i>
			  </div>
			</li>
			<li class="py-15 px-5">
			  <!-- checkbox -->
			  <input type="checkbox" id="basic_checkbox_4" class="filled-in">
			  <label for="basic_checkbox_4" class="mb-0 h-15"></label>
			  <span class="text-line">Proin nec mi porta</span>
			  <small class="badge bg-success"><i class="fa fa-clock-o"></i> 3 days</small>
			  <div class="tools">
				<i class="fa fa-edit"></i>
				<i class="fa fa-trash-o"></i>
			  </div>
			</li>
			<li class="py-15 px-5 by-1">
			  <!-- checkbox -->
			  <input type="checkbox" id="basic_checkbox_5" class="filled-in">
			  <label for="basic_checkbox_5" class="mb-0 h-15"></label>
			  <span class="text-line">Maecenas scelerisque</span>
			  <small class="badge bg-primary"><i class="fa fa-clock-o"></i> 1 week</small>
			  <div class="tools">
				<i class="fa fa-edit"></i>
				<i class="fa fa-trash-o"></i>
			  </div>
			</li>
			<li class="py-15 px-5">
			  <!-- checkbox -->
			  <input type="checkbox" id="basic_checkbox_6" class="filled-in">
			  <label for="basic_checkbox_6" class="mb-0 h-15"></label>
			  <span class="text-line">Vivamus nec orci</span>
			  <small class="badge bg-info"><i class="fa fa-clock-o"></i> 1 month</small>
			  <div class="tools">
				<i class="fa fa-edit"></i>
				<i class="fa fa-trash-o"></i>
			  </div>
			</li>
			<li class="py-15 px-5 by-1">
			  <!-- checkbox -->
			  <input type="checkbox" id="basic_checkbox_7" class="filled-in">
			  <label for="basic_checkbox_7" class="mb-0 h-15"></label>
			  <!-- todo text -->
			  <span class="text-line">Nulla vitae purus</span>
			  <!-- Emphasis label -->
			  <small class="badge bg-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
			  <!-- General tools such as edit or delete-->
			  <div class="tools">
				<i class="fa fa-edit"></i>
				<i class="fa fa-trash-o"></i>
			  </div>
			</li>
			<li class="py-15 px-5">
			  <!-- checkbox -->
			  <input type="checkbox" id="basic_checkbox_8" class="filled-in">
			  <label for="basic_checkbox_8" class="mb-0 h-15"></label>
			  <span class="text-line">Phasellus interdum</span>
			  <small class="badge bg-info"><i class="fa fa-clock-o"></i> 4 hours</small>
			  <div class="tools">
				<i class="fa fa-edit"></i>
				<i class="fa fa-trash-o"></i>
			  </div>
			</li>
			<li class="py-15 px-5 by-1">
			  <!-- checkbox -->
			  <input type="checkbox" id="basic_checkbox_9" class="filled-in">
			  <label for="basic_checkbox_9" class="mb-0 h-15"></label>
			  <span class="text-line">Quisque sodales</span>
			  <small class="badge bg-warning"><i class="fa fa-clock-o"></i> 1 day</small>
			  <div class="tools">
				<i class="fa fa-edit"></i>
				<i class="fa fa-trash-o"></i>
			  </div>
			</li>
			<li class="py-15 px-5">
			  <!-- checkbox -->
			  <input type="checkbox" id="basic_checkbox_10" class="filled-in">
			  <label for="basic_checkbox_10" class="mb-0 h-15"></label>
			  <span class="text-line">Proin nec mi porta</span>
			  <small class="badge bg-success"><i class="fa fa-clock-o"></i> 3 days</small>
			  <div class="tools">
				<i class="fa fa-edit"></i>
				<i class="fa fa-trash-o"></i>
			  </div>
			</li>
		  </ul>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
