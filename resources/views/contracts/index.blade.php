@extends('layouts.manager')

@section('title','Contracts management')

@section('head-complement')
	{{-- DataTables --}}
	<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')

    {{-- <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

        <table id="table_classes">
			<thead>
				<tr>
				<th>Id</th>
				<th>Intitulé du poste</th>
				<th>Prestataire</th>
				<th>Date de début</th>
				<th>Date de fin</th>
				<th>Actions</th>
				</tr>
			</thead>
			<tbody>

                @foreach ($contracts as $contract)

				<tr>
					<td>{{ $contract->id }}</td>
					<td>{{ $contract->title }}</td>
					<td>{{ $contract->serviceProvider->user->lastname }} {{ $contract->serviceProvider->user->firstname }}</td>
					<td>{{ $contract->start_date }}</td>
					<td>{{ $contract->end_date }}</td>
					<td>
					  <div class="flex justify-around">
						{{-- <button class="border-2 bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;">Taches</a></button>
						<button class="border-2 bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;">Paiements</a></button>
                        <a class="flex items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a> -}}
						<button class="border-2 bg-transparent edit-btn" data-user-id="{{ $contract->id }}" style="color: inherit" onclick="window.location='http://127.0.0.1:8000/contracts/edit/{{$contract->id}}'">Modifier</button>
						<form action="{{ route('contracts.delete',$contract->id) }}" method="POST" method="DELETE" style="display: inline-block" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border-2 bg-transparent delete-btn" data-user-id="{{ $contract->id }}" style="color: inherit">Supprimer</button>
                        </form>
                        {{-- <div>
							  <button type="button" class="border-2 bg-transparent dropdown-toggle" data-toggle="dropdown">
							  </button>
							  <ul class="dropdown-menu">
								<li><a class="dropdown-item flex items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
								<li><button class="dropdown-item border-2 bg-transparent edit-btn" data-user-id="{{ $contract->id }}" data-toggle="modal" data-target="#modal_update_form" style="color: inherit"><i class="fas fa-edit mr-2"></i>Modifier</button></li>
								<li><button class="dropdown-item border-2 bg-transparent edit-btn" data-toggle="modal" data-target="#modal_contract_delete" style="color: inherit"><i class="fas fa-trash mr-2"></i>Déssativer</button></li>
							  </ul>
						  </div> -}}
					  </div>
					</td>
				</tr>

		        @endforeach
            </tbody>
        </table>
    </div> --}}

    {{-- Header --}}
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Gestion des contrats</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<button type="button" class="btn btn-default float-sm-right" data-toggle="modal" data-target="#modal_creation_form">
						Créer un contrat
					</button>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	{{-- Modal (contract creation form) --}}
	<div class="modal fade" id="modal_creation_form" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Création d'un contrat</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="mx-4" id="contract-form" method="POST" action="/contracts/store" enctype="multipart/form-data">
					@csrf
					<div>
                        <label for="title">Intitulé du poste</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="object">Objet</label>
                        <input type="text" id="object" name="object" class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="start_date">Date de début</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="" required>
                    </div>
                    <div class="mt-3">
                        <label for="functions">Fonctions</label>
                        <input type="text" id="functions" name="functions" class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="earnings">Rémunération</label>
                        <input type="text" id="earnings" name="earnings" class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="salary">Salaire</label>
                        <input type="number" id="salary" name="salary" class="form-control" required>
                    </div>
					<div class="mt-3">
						<label for="service_provider_id">Prestataire</label>
						<select class="form-control" id="service_provider_id" name="service_provider_id">

							@if ($serviceProviders)
								@foreach ($serviceProviders as $serviceProvider)

								<option value="{{ $serviceProvider->id }}">{{ $serviceProvider->user->firstname }}</option>

								@endforeach
                            @else

                                <option value="">Aucun prestataire</option>

							@endif

						</select>
					</div>
					<div class="mt-3">
                        <label for="file">Fichier</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary" form="contract-form">Enregistrer</button>
			</div>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	{{-- Modal (user update form) --}}
	<div class="modal fade" id="modal_update_form" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Modification d'un utilisateur</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="mx-4" id="user-update-form" method="POST">
					@csrf
					<div>
						<label for="u_lastname">Nom</label>
						<input type="text" id="u_lastname" name="u_lastname" class="form-control" required>
					</div>
					<div class="mt-3">
						<label for="u_firstname">Prénom</label>
						<input type="text" id="u_firstname" name="u_firstname" class="form-control" required>
					</div>
					<div class="mt-3">
						<label for="u_phone">Téléphone</label>
						<input type="number" id="u_phone" name="u_phone" class="form-control" required>
					</div>
					<div class="mt-3">
						<label for="u_email">Email</label>
						<input type="text" id="u_email" name="u_email" class="form-control" onblur="validateEmail()" oninput="deleteMessage()" required>
						<span id="emailError" style="font-size: 0.8em; color: rgb(255, 68, 68); font-style: italic; border: solid 1px transparent;"></span>
					</div>
					<div>
						<label for="u_role_id">Role de l'utilisateur</label>
						<select class="form-control" id="u_role_id" name="u_role_id">
							<option value="1">Administrateur</option>
							<option value="2">Gestionnaire de contrat</option>
							<option value="3" selected>Prestataire</option>
						</select>
					</div>
					<div class="mt-3">
						<label for="u_password">Mot de passe</label>
						<input type="password" id="u_password" name="u_password" class="form-control" onblur="validatePassword()">
						<span id="passwordError" style="font-size: 0.8em; color: red; font-style: italic; border: solid 1px transparent;"></span>
					</div>
					<div>
						<label for="u_confirmPassword">Confirmer le mot de passe</label>
						<input type="password" id="u_confirmPassword" name="u_confirmPassword" class="form-control" onblur="confirmPassword()">
						<span id="confirmPasswordError" style="font-size: 0.8em; color: red; font-style: italic; border: solid 1px transparent;"></span>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary" form="user-update-form">Enregistrer</button>
			</div>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	{{-- Modal (user delete form) --}}
	<div class="modal fade" id="modal_contract_delete" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Suppression d'un utilisateur</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="mx-4" id="user-deletion-form" method="POST">
					@csrf
					<p>Êtes-vous sûr de vouloir supprimer l'utilisateur <span id="username"></span> ?</p>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
				<button type="submit" class="btn btn-primary" form="user-deletion-form">Confirmer</button>
			</div>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	{{-- @foreach ($errors->all() as $error)
		<div>
			{{ $error }}
		</div>
	@endforeach --}}
	{{-- Datatable --}}
	<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Gérez vos contrats ici</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
		  <table id="table_classes" class="table table-bordered table-striped">
			<thead>
				<tr>
				<th>Id</th>
				<th>Intitulé du poste</th>
				<th>Prestataire</th>
				<th>Date de début</th>
				<th>Date de fin</th>
				<th>Actions</th>
				</tr>
			</thead>
			<tbody>

			@if ($contracts)

				@foreach ($contracts as $contract)

				<tr>
					<td>{{ $contract->id }}</td>
					<td>{{ $contract->title }}</td>
					<td>{{ $contract->serviceProvider->user->lastname }} {{ $contract->serviceProvider->user->firstname }}</td>
					<td>{{ $contract->start_date }}</td>
					<td>{{ $contract->end_date }}</td>
					<td>
					  <div class="row d-flex justify-content-around">
						  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/contracts/{{ $contract->id }}/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
						  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/contracts/{{ $contract->id }}/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
						  <div>
							  <button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
							  </button>
							  <ul class="dropdown-menu">
								{{-- <li><a class="dropdown-item d-flex align-items-center" href="/contracts/download/{{ $contract->id }}"><i class="fas fa-eye mr-2"></i>Afficher</a></li> --}}
								<li><a class="dropdown-item d-flex align-items-center" href="/contracts/download/{{ $contract->id }}"><i class="fas fa-download mr-2"></i>Télécharger</a></li>
								<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-user-id="{{ $contract->id }}" data-toggle="modal" data-target="#modal_update_form" style="color: inherit"><i class="fas fa-edit mr-2"></i>Modifier</button></li>
								<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_contract_delete" style="color: inherit"><i class="fas fa-trash mr-2"></i>Déssativer</button></li>
							  </ul>
						  </div>
					  </div>
					</td>
				</tr>

				@endforeach

			@endif

			</tbody>
			<tfoot>
				<tr>
					<th>Id</th>
					<th>Intitulé du poste</th>
					<th>Prestataire</th>
					<th>Date de début</th>
					<th>Date de fin</th>
					<th>Actions</th>
				</tr>
			</tfoot>
			</tfoot>
		  </table>
		</div>
		<!-- /.card-body -->
	</div>

@endsection

@section('js_files-complement')
	{{-- DataTables --}}
	<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
	<script>

		$(function () {
			$("#table_classes").DataTable({
				"responsive": false,
				"autoWidth": false,
				"language" : {

					"sEmptyTable":     "Aucune donnée disponible dans le tableau",
					"sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
					"sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
					"sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
					"sInfoPostFix":    "",
					"sInfoThousands":  ",",
					"sLengthMenu":     "Afficher _MENU_ éléments",
					"sLoadingRecords": "Chargement...",
					"sProcessing":     "Traitement...",
					"sSearch":         "Rechercher :",
					"sZeroRecords":    "Aucun élément correspondant trouvé",
					"oPaginate": {
						"sFirst":    "Premier",
						"sLast":     "Dernier",
						"sNext":     "Suivant",
						"sPrevious": "Précédent"
					},
					"oAria": {
						"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
						"sSortDescending": ": activer pour trier la colonne par ordre décroissant"
					},
					"select": {
							"rows": {
								"_": "%d lignes sélectionnées",
								"0": "Aucune ligne sélectionnée",
								"1": "1 ligne sélectionnée"
							}
					}
				}
			});
		});

	</script>
	{{-- page script --}}
	<script>
		$(function () {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
		});
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
		});
	</script>
	{{-- Update and delete modal script --}}
	<script>
		var editbtns = document.getElementsByClassName('edit-btn');

		var lastname = document.getElementById('u_lastname');
		var firstname = document.getElementById('u_firstname');
		var phone = document.getElementById('u_phone');
		var email = document.getElementById('u_email');
		var role_id = document.getElementById('u_role_id');

		var form = document.getElementById('user-update-form');
		var delete_form = document.getElementById('user-deletion-form');
		var span = document.getElementById('username');

		for (let i = 0; i < editbtns.length; i++) {
			editbtns[i].addEventListener('click', function (){
				let id = this.getAttribute('data-user-id');
				fetch(`/users/find/${id}`, {
					method: 'GET',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
				})
				.then(response => response.json())
				.then(data => {
					// console.log(data); // Handle the response from the server
					lastname.value = data.lastname;
					firstname.value = data.firstname;
					phone.value = data.phone;
					email.value = data.email;
					role_id.value = data.role_id;

					form.action = `/users/update/${data.id}`;
					delete_form.action = `/users/destroy/${data.id}`;

					span.textContent = `${data.lastname} ${data.firstname}`;
					// form.setAttribute('action', `/users/update/${data.id}`);
				})
				.catch(error => console.error('Error:', error));
			});
		}

	</script>
@endsection
