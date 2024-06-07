@extends('layouts.manager')

@section('title','Contracts management')

@section('head-complement')
	{{-- DataTables --}}
	<link rel="stylesheet" href="admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<!-- daterange picker -->
	{{-- <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css"> --}}
@endsection

@section('content')

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
					{{-- <button type="button" class="btn btn-default float-sm-right" data-toggle="modal" data-target="#modal-default">
						Charger un contrat
					</button> --}}
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
				<form class="mx-4" id="contract-form" method="POST" action="/contracts/store">
					@csrf
					<div>
						<label for="title">Intitulé du poste</label>
						<input type="text" id="title" name="title" class="form-control" required>
					</div>
					<div class="mt-3">
						<label for="description">Description</label>
						<input type="text" id="description" name="description" class="form-control">
					</div>
					<div class="mt-3">
						<label for="start_date">Date de début</label>
						<input type="date" id="start_date" name="start_date" class="form-control" value="" required>
					</div>
					{{-- <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" /> --}}
					<div class="mt-3">
						<label for="end_date">Date de fin</label>
						<input type="date" id="end_date" name="end_date" class="form-control" required>
					</div>
					<div class="mt-3">
						<label for="amount">Montant</label>
						<input type="number" id="amount" name="amount" class="form-control" required>
					</div>
					<div class="mt-3">
						<label for="status">Etat</label>
						<select class="form-control" id="status" name="status">
							<option value="unsigned">Non signé</option>
							<option value="active">Actif</option>
							<option value="archived">Archivé</option>
						</select>
					</div>
					<div class="mt-3">
						<label for="service_provider_id">Prestataire</label>
						<select class="form-control" id="service_provider_id" name="service_provider_id">
							
							@if ($serviceProviders)
								@foreach ($serviceProviders as $serviceProvider)
								
								<option value="{{ $serviceProvider->id }}">{{ $serviceProvider->user->lastname }}</option>
						
								@endforeach
							@endif
							
						</select>
					</div>
					<input type="file" name="file" id="file">
					{{-- <div class="mt-3">
						<label for="file">Fichier</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="file" id="customFile">
							<label class="custom-file-label" for="customFile">Choose file</label>
						</div>
					</div> --}}
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

	{{-- Modal (Upload) --}}
	{{-- <div class="modal fade" id="modal-default">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2>BOOTSTRAP FILE UPLOAD</h2>
				</div>

				<div class="modal-body">
					<div class="file-drop-area">
						<span class="choose-file-button">Choose files</span>
						<span class="file-message">or drag and drop files here</span>
						<input class="file-input" type="file" multiple>
					</div>
				</div>
			</div>
		</div>
	</div> --}}

	@foreach ($errors->all() as $error)
		<div>
			{{ $error }}
		</div>
	@endforeach
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
				
				@foreach ($contracts as $element)
				
				<tr>
					<td>{{ $element->id }}</td>
					<td>{{ $element->title }}</td>
					<td>{{ $element->serviceProvider->user->lastname }} {{ $element->serviceProvider->user->firstname }}</td>
					<td>{{ $element->start_date }}</td>
					<td>{{ $element->end_date }}</td>
					<td>
					  <div class="row d-flex justify-content-around">
						  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
						  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
						  <div>
							  <button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
							  </button>
							  <ul class="dropdown-menu">
								<li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
								<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-user-id="{{ $element->id }}" data-toggle="modal" data-target="#modal_update_form" style="color: inherit"><i class="fas fa-edit mr-2"></i>Modifier</button></li>
								<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_contract_delete" style="color: inherit"><i class="fas fa-trash mr-2"></i>Déssativer</button></li>
							  </ul>
						  </div>
					  </div>
					</td>
				</tr>

				@endforeach

			@endif

			{{-- <tr>
				<td>01</td>
				<td>Développeur d'application web</td>
				<td>Mathias Carlton</td>
				<td>01/10/2023</td>
				<td>01/04/2024</td>
				<td>
				  <div class="row d-flex justify-content-around">
					  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					  <div>
						  <button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						  </button>
						  <ul class="dropdown-menu">
							<li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
							<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_update_form" style="color: inherit"><i class="fas fa-edit mr-2"></i>Modifier</button></li>
							<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_contract_delete" style="color: inherit"><i class="fas fa-trash mr-2"></i>Supprimer</button></li>
						  </ul>
					  </div>
				  </div>
				</td>
			</tr>
			<tr>
				<td>02</td>
				<td>Infirmier</td>
				<td>Céline Brooks</td>
				<td>12/05/2023</td>
				<td>12/11/2023</td>
				<td>
				  <div class="row d-flex justify-content-around">
					  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					  <div>
						  <button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						  </button>
						  <ul class="dropdown-menu">
							<li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
							<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_update_form" style="color: inherit"><i class="fas fa-edit mr-2"></i>Modifier</button></li>
							<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_contract_delete" style="color: inherit"><i class="fas fa-trash mr-2"></i>Supprimer</button></li>
						  </ul>
					  </div>
				  </div>
				</td>
			</tr>
			<tr>
				<td>03</td>
				<td>Technicien de laboratoire</td>
				<td>Benjamin Kane</td>
				<td>10/05/2023</td>
				<td>10/11/2023</td>
				<td>
				  <div class="row d-flex justify-content-around">
					  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					  <div>
						  <button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						  </button>
						  <ul class="dropdown-menu">
							<li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
							<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_update_form" style="color: inherit"><i class="fas fa-edit mr-2"></i>Modifier</button></li>
							<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_contract_delete" style="color: inherit"><i class="fas fa-trash mr-2"></i>Supprimer</button></li>
						  </ul>
					  </div>
				  </div>
				</td>
			</tr>
			<tr>
				<td>04</td>
				<td>Consultant RH</td>
				<td>Charlie Potter</td>
				<td>07/02/2023</td>
				<td>07/08/2023</td>
				<td>
				  <div class="row d-flex justify-content-around">
					  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					  <div>
						  <button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						  </button>
						  <ul class="dropdown-menu">
							<li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
							<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_update_form" style="color: inherit"><i class="fas fa-edit mr-2"></i>Modifier</button></li>
							<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_contract_delete" style="color: inherit"><i class="fas fa-trash mr-2"></i>Supprimer</button></li>
						  </ul>
					  </div>
				  </div>
				</td>
			</tr>
			<tr>
				<td>05</td>
				<td>Medecin</td>
				<td>Turner Amélie</td>
				<td>01/11/2022</td>
				<td>01/05/2023</td>
				<td>
				  <div class="row d-flex justify-content-around">
					  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					  <button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					  <div>
						  <button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						  </button>
						  <ul class="dropdown-menu">
							<li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
							<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_update_form" style="color: inherit"><i class="fas fa-edit mr-2"></i>Modifier</button></li>
							<li><button class="dropdown-item border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_contract_delete" style="color: inherit"><i class="fas fa-trash mr-2"></i>Supprimer</button></li>
						  </ul>
					  </div>
				  </div>
				</td>
			</tr> --}}

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
	<script src="admin/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
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
	<!-- date-range-picker -->
	{{-- <script type="text/javascript">
		$(function() {
			$('input[name="daterange"]').daterangepicker();
		});
	</script> --}}
	<!-- Task add -->
	<script>
		// jquery.repeater version 1.2.1
		// https://github.com/DubFriend/jquery.repeater
		// (MIT) 09-10-2016
		// Brian Detering <BDeterin@gmail.com> (http://www.briandetering.net/)
		(function ($) {
			'use strict';

			var identity = function (x) {
				return x;
			};

			var isArray = function (value) {
				return $.isArray(value);
			};

			var isObject = function (value) {
				return !isArray(value) && (value instanceof Object);
			};

			var isNumber = function (value) {
				return value instanceof Number;
			};

			var isFunction = function (value) {
				return value instanceof Function;
			};

			var indexOf = function (object, value) {
				return $.inArray(value, object);
			};

			var inArray = function (array, value) {
				return indexOf(array, value) !== -1;
			};

			var foreach = function (collection, callback) {
				for(var i in collection) {
					if(collection.hasOwnProperty(i)) {
						callback(collection[i], i, collection);
					}
				}
			};


			var last = function (array) {
				return array[array.length - 1];
			};

			var argumentsToArray = function (args) {
				return Array.prototype.slice.call(args);
			};

			var extend = function () {
				var extended = {};
				foreach(argumentsToArray(arguments), function (o) {
					foreach(o, function (val, key) {
						extended[key] = val;
					});
				});
				return extended;
			};

			var mapToArray = function (collection, callback) {
				var mapped = [];
				foreach(collection, function (value, key, coll) {
					mapped.push(callback(value, key, coll));
				});
				return mapped;
			};

			var mapToObject = function (collection, callback, keyCallback) {
				var mapped = {};
				foreach(collection, function (value, key, coll) {
					key = keyCallback ? keyCallback(key, value) : key;
					mapped[key] = callback(value, key, coll);
				});
				return mapped;
			};

			var map = function (collection, callback, keyCallback) {
				return isArray(collection) ?
					mapToArray(collection, callback) :
					mapToObject(collection, callback, keyCallback);
			};

			var pluck = function (arrayOfObjects, key) {
				return map(arrayOfObjects, function (val) {
					return val[key];
				});
			};

			var filter = function (collection, callback) {
				var filtered;

				if(isArray(collection)) {
					filtered = [];
					foreach(collection, function (val, key, coll) {
						if(callback(val, key, coll)) {
							filtered.push(val);
						}
					});
				}
				else {
					filtered = {};
					foreach(collection, function (val, key, coll) {
						if(callback(val, key, coll)) {
							filtered[key] = val;
						}
					});
				}

				return filtered;
			};

			var call = function (collection, functionName, args) {
				return map(collection, function (object, name) {
					return object[functionName].apply(object, args || []);
				});
			};

			//execute callback immediately and at most one time on the minimumInterval,
			//ignore block attempts
			var throttle = function (minimumInterval, callback) {
				var timeout = null;
				return function () {
					var that = this, args = arguments;
					if(timeout === null) {
						timeout = setTimeout(function () {
							timeout = null;
						}, minimumInterval);
						callback.apply(that, args);
					}
				};
			};


			var mixinPubSub = function (object) {
				object = object || {};
				var serviceProviderics = {};

				object.publish = function (topic, data) {
					foreach(topics[topic], function (callback) {
						callback(data);
					});
				};

				object.subscribe = function (topic, callback) {
					topics[topic] = topics[topic] || [];
					topics[topic].push(callback);
				};

				object.unsubscribe = function (callback) {
					foreach(topics, function (subscribers) {
						var index = indexOf(subscribers, callback);
						if(index !== -1) {
							subscribers.splice(index, 1);
						}
					});
				};

				return object;
			};

			// jquery.input version 0.0.0
			// https://github.com/DubFriend/jquery.input
			// (MIT) 09-04-2014
			// Brian Detering <BDeterin@gmail.com> (http://www.briandetering.net/)
			(function ($) {
				'use strict';

				var createBaseInput = function (fig, my) {
					var self = mixinPubSub(),
						$self = fig.$;

					self.getType = function () {
						throw 'implement me (return type. "text", "radio", etc.)';
					};

					self.$ = function (selector) {
						return selector ? $self.find(selector) : $self;
					};

					self.disable = function () {
						self.$().prop('disabled', true);
						self.publish('isEnabled', false);
					};

					self.enable = function () {
						self.$().prop('disabled', false);
						self.publish('isEnabled', true);
					};

					my.equalTo = function (a, b) {
						return a === b;
					};

					my.publishChange = (function () {
						var oldValue;
						return function (e, domElement) {
							var newValue = self.get();
							if(!my.equalTo(newValue, oldValue)) {
								self.publish('change', { e: e, domElement: domElement });
							}
							oldValue = newValue;
						};
					}());

					return self;
				};


				var createInput = function (fig, my) {
					var self = createBaseInput(fig, my);

					self.get = function () {
						return self.$().val();
					};

					self.set = function (newValue) {
						self.$().val(newValue);
					};

					self.clear = function () {
						self.set('');
					};

					my.buildSetter = function (callback) {
						return function (newValue) {
							callback.call(self, newValue);
						};
					};

					return self;
				};

				var inputEqualToArray = function (a, b) {
					a = isArray(a) ? a : [a];
					b = isArray(b) ? b : [b];

					var isEqual = true;
					if(a.length !== b.length) {
						isEqual = false;
					}
					else {
						foreach(a, function (value) {
							if(!inArray(b, value)) {
								isEqual = false;
							}
						});
					}

					return isEqual;
				};

				var createInputButton = function (fig) {
					var my = {},
						self = createInput(fig, my);

					self.getType = function () {
						return 'button';
					};

					self.$().on('change', function (e) {
						my.publishChange(e, this);
					});

					return self;
				};

				var createInputCheckbox = function (fig) {
					var my = {},
						self = createInput(fig, my);

					self.getType = function () {
						return 'checkbox';
					};

					self.get = function () {
						var values = [];
						self.$().filter(':checked').each(function () {
							values.push($(this).val());
						});
						return values;
					};

					self.set = function (newValues) {
						newValues = isArray(newValues) ? newValues : [newValues];

						self.$().each(function () {
							$(this).prop('checked', false);
						});

						foreach(newValues, function (value) {
							self.$().filter('[value="' + value + '"]')
								.prop('checked', true);
						});
					};

					my.equalTo = inputEqualToArray;

					self.$().change(function (e) {
						my.publishChange(e, this);
					});

					return self;
				};

				var createInputEmail = function (fig) {
					var my = {},
						self = createInputText(fig, my);

					self.getType = function () {
						return 'email';
					};

					return self;
				};

				var createInputFile = function (fig) {
					var my = {},
						self = createBaseInput(fig, my);

					self.getType = function () {
						return 'file';
					};

					self.get = function () {
						return last(self.$().val().split('\\'));
					};

					self.clear = function () {
						// http://stackoverflow.com/questions/1043957/clearing-input-type-file-using-jquery
						this.$().each(function () {
							$(this).wrap('<form>').closest('form').get(0).reset();
							$(this).unwrap();
						});
					};

					self.$().change(function (e) {
						my.publishChange(e, this);
						// self.publish('change', self);
					});

					return self;
				};

				var createInputHidden = function (fig) {
					var my = {},
						self = createInput(fig, my);

					self.getType = function () {
						return 'hidden';
					};

					self.$().change(function (e) {
						my.publishChange(e, this);
					});

					return self;
				};
				var createInputMultipleFile = function (fig) {
					var my = {},
						self = createBaseInput(fig, my);

					self.getType = function () {
						return 'file[multiple]';
					};

					self.get = function () {
						// http://stackoverflow.com/questions/14035530/how-to-get-value-of-html-5-multiple-file-upload-variable-using-jquery
						var fileListObject = self.$().get(0).files || [],
							names = [], i;

						for(i = 0; i < (fileListObject.length || 0); i += 1) {
							names.push(fileListObject[i].name);
						}

						return names;
					};

					self.clear = function () {
						// http://stackoverflow.com/questions/1043957/clearing-input-type-file-using-jquery
						this.$().each(function () {
							$(this).wrap('<form>').closest('form').get(0).reset();
							$(this).unwrap();
						});
					};

					self.$().change(function (e) {
						my.publishChange(e, this);
					});

					return self;
				};

				var createInputMultipleSelect = function (fig) {
					var my = {},
						self = createInput(fig, my);

					self.getType = function () {
						return 'select[multiple]';
					};

					self.get = function () {
						return self.$().val() || [];
					};

					self.set = function (newValues) {
						self.$().val(
							newValues === '' ? [] : isArray(newValues) ? newValues : [newValues]
						);
					};

					my.equalTo = inputEqualToArray;

					self.$().change(function (e) {
						my.publishChange(e, this);
					});

					return self;
				};

				var createInputPassword = function (fig) {
					var my = {},
						self = createInputText(fig, my);

					self.getType = function () {
						return 'password';
					};

					return self;
				};

				var createInputRadio = function (fig) {
					var my = {},
						self = createInput(fig, my);

					self.getType = function () {
						return 'radio';
					};

					self.get = function () {
						return self.$().filter(':checked').val() || null;
					};

					self.set = function (newValue) {
						if(!newValue) {
							self.$().each(function () {
								$(this).prop('checked', false);
							});
						}
						else {
							self.$().filter('[value="' + newValue + '"]').prop('checked', true);
						}
					};

					self.$().change(function (e) {
						my.publishChange(e, this);
					});

					return self;
				};

				var createInputRange = function (fig) {
					var my = {},
						self = createInput(fig, my);

					self.getType = function () {
						return 'range';
					};

					self.$().change(function (e) {
						my.publishChange(e, this);
					});

					return self;
				};

				var createInputSelect = function (fig) {
					var my = {},
						self = createInput(fig, my);

					self.getType = function () {
						return 'select';
					};

					self.$().change(function (e) {
						my.publishChange(e, this);
					});

					return self;
				};

				var createInputText = function (fig) {
					var my = {},
						self = createInput(fig, my);

					self.getType = function () {
						return 'text';
					};

					self.$().on('change keyup keydown', function (e) {
						my.publishChange(e, this);
					});

					return self;
				};

				var createInputTextarea = function (fig) {
					var my = {},
						self = createInput(fig, my);

					self.getType = function () {
						return 'textarea';
					};

					self.$().on('change keyup keydown', function (e) {
						my.publishChange(e, this);
					});

					return self;
				};

				var createInputURL = function (fig) {
					var my = {},
						self = createInputText(fig, my);

					self.getType = function () {
						return 'url';
					};

					return self;
				};

				var buildFormInputs = function (fig) {
					var inputs = {},
						$self = fig.$;

					var constructor = fig.constructorOverride || {
						button: createInputButton,
						text: createInputText,
						url: createInputURL,
						email: createInputEmail,
						password: createInputPassword,
						range: createInputRange,
						textarea: createInputTextarea,
						select: createInputSelect,
						'select[multiple]': createInputMultipleSelect,
						radio: createInputRadio,
						checkbox: createInputCheckbox,
						file: createInputFile,
						'file[multiple]': createInputMultipleFile,
						hidden: createInputHidden
					};

					var addInputsBasic = function (type, selector) {
						var $input = isObject(selector) ? selector : $self.find(selector);

						$input.each(function () {
							var name = $(this).attr('name');
							inputs[name] = constructor[type]({
								$: $(this)
							});
						});
					};

					var addInputsGroup = function (type, selector) {
						var names = [],
							$input = isObject(selector) ? selector : $self.find(selector);

						if(isObject(selector)) {
							inputs[$input.attr('name')] = constructor[type]({
								$: $input
							});
						}
						else {
							// group by name attribute
							$input.each(function () {
								if(indexOf(names, $(this).attr('name')) === -1) {
									names.push($(this).attr('name'));
								}
							});

							foreach(names, function (name) {
								inputs[name] = constructor[type]({
									$: $self.find('input[name="' + name + '"]')
								});
							});
						}
					};


					if($self.is('input, select, textarea')) {
						if($self.is('input[type="button"], button, input[type="submit"]')) {
							addInputsBasic('button', $self);
						}
						else if($self.is('textarea')) {
							addInputsBasic('textarea', $self);
						}
						else if(
							$self.is('input[type="text"]') ||
							$self.is('input') && !$self.attr('type')
						) {
							addInputsBasic('text', $self);
						}
						else if($self.is('input[type="password"]')) {
							addInputsBasic('password', $self);
						}
						else if($self.is('input[type="email"]')) {
							addInputsBasic('email', $self);
						}
						else if($self.is('input[type="url"]')) {
							addInputsBasic('url', $self);
						}
						else if($self.is('input[type="range"]')) {
							addInputsBasic('range', $self);
						}
						else if($self.is('select')) {
							if($self.is('[multiple]')) {
								addInputsBasic('select[multiple]', $self);
							}
							else {
								addInputsBasic('select', $self);
							}
						}
						else if($self.is('input[type="file"]')) {
							if($self.is('[multiple]')) {
								addInputsBasic('file[multiple]', $self);
							}
							else {
								addInputsBasic('file', $self);
							}
						}
						else if($self.is('input[type="hidden"]')) {
							addInputsBasic('hidden', $self);
						}
						else if($self.is('input[type="radio"]')) {
							addInputsGroup('radio', $self);
						}
						else if($self.is('input[type="checkbox"]')) {
							addInputsGroup('checkbox', $self);
						}
						else {
							//in all other cases default to a "text" input interface.
							addInputsBasic('text', $self);
						}
					}
					else {
						addInputsBasic('button', 'input[type="button"], button, input[type="submit"]');
						addInputsBasic('text', 'input[type="text"]');
						addInputsBasic('password', 'input[type="password"]');
						addInputsBasic('email', 'input[type="email"]');
						addInputsBasic('url', 'input[type="url"]');
						addInputsBasic('range', 'input[type="range"]');
						addInputsBasic('textarea', 'textarea');
						addInputsBasic('select', 'select:not([multiple])');
						addInputsBasic('select[multiple]', 'select[multiple]');
						addInputsBasic('file', 'input[type="file"]:not([multiple])');
						addInputsBasic('file[multiple]', 'input[type="file"][multiple]');
						addInputsBasic('hidden', 'input[type="hidden"]');
						addInputsGroup('radio', 'input[type="radio"]');
						addInputsGroup('checkbox', 'input[type="checkbox"]');
					}

					return inputs;
				};

				$.fn.inputVal = function (newValue) {
					var $self = $(this);

					var inputs = buildFormInputs({ $: $self });

					if($self.is('input, textarea, select')) {
						if(typeof newValue === 'undefined') {
							return inputs[$self.attr('name')].get();
						}
						else {
							inputs[$self.attr('name')].set(newValue);
							return $self;
						}
					}
					else {
						if(typeof newValue === 'undefined') {
							return call(inputs, 'get');
						}
						else {
							foreach(newValue, function (value, inputName) {
								inputs[inputName].set(value);
							});
							return $self;
						}
					}
				};

				$.fn.inputOnChange = function (callback) {
					var $self = $(this);
					var inputs = buildFormInputs({ $: $self });
					foreach(inputs, function (input) {
						input.subscribe('change', function (data) {
							callback.call(data.domElement, data.e);
						});
					});
					return $self;
				};

				$.fn.inputDisable = function () {
					var $self = $(this);
					call(buildFormInputs({ $: $self }), 'disable');
					return $self;
				};

				$.fn.inputEnable = function () {
					var $self = $(this);
					call(buildFormInputs({ $: $self }), 'enable');
					return $self;
				};

				$.fn.inputClear = function () {
					var $self = $(this);
					call(buildFormInputs({ $: $self }), 'clear');
					return $self;
				};

			}(jQuery));

			$.fn.repeaterVal = function () {
				var parse = function (raw) {
					var parsed = [];

					foreach(raw, function (val, key) {
						var parsedKey = [];
						if(key !== "undefined") {
							parsedKey.push(key.match(/^[^\[]*/)[0]);
							parsedKey = parsedKey.concat(map(
								key.match(/\[[^\]]*\]/g),
								function (bracketed) {
									return bracketed.replace(/[\[\]]/g, '');
								}
							));

							parsed.push({
								val: val,
								key: parsedKey
							});
						}
					});

					return parsed;
				};

				var build = function (parsed) {
					if(
						parsed.length === 1 &&
						(parsed[0].key.length === 0 || parsed[0].key.length === 1 && !parsed[0].key[0])
					) {
						return parsed[0].val;
					}

					foreach(parsed, function (p) {
						p.head = p.key.shift();
					});

					var grouped = (function () {
						var grouped = {};

						foreach(parsed, function (p) {
							if(!grouped[p.head]) {
								grouped[p.head] = [];
							}
							grouped[p.head].push(p);
						});

						return grouped;
					}());

					var built;

					if(/^[0-9]+$/.test(parsed[0].head)) {
						built = [];
						foreach(grouped, function (group) {
							built.push(build(group));
						});
					}
					else {
						built = {};
						foreach(grouped, function (group, key) {
							built[key] = build(group);
						});
					}

					return built;
				};

				return build(parse($(this).inputVal()));
			};

			$.fn.repeater = function (fig) {
				fig = fig || {};

				var setList;

				$(this).each(function () {

					var $self = $(this);

					var show = fig.show || function () {
						$(this).show();
					};

					var hide = fig.hide || function (removeElement) {
						removeElement();
					};

					var $list = $self.find('[data-repeater-list]').first();

					var $filterNested = function ($items, repeaters) {
						return $items.filter(function () {
							return repeaters ?
								$(this).closest(
									pluck(repeaters, 'selector').join(',')
								).length === 0 : true;
						});
					};

					var $items = function () {
						return $filterNested($list.find('[data-repeater-item]'), fig.repeaters);
					};

					var $itemTemplate = $list.find('[data-repeater-item]')
											.first().clone().hide();

					var $firstDeleteButton = $filterNested(
						$filterNested($(this).find('[data-repeater-item]'), fig.repeaters)
						.first().find('[data-repeater-delete]'),
						fig.repeaters
					);

					if(fig.isFirstItemUndeletable && $firstDeleteButton) {
						$firstDeleteButton.remove();
					}

					var getGroupName = function () {
						var groupName = $list.data('repeater-list');
						return fig.$parent ?
							fig.$parent.data('item-name') + '[' + groupName + ']' :
							groupName;
					};

					var initNested = function ($listItems) {
						if(fig.repeaters) {
							$listItems.each(function () {
								var $item = $(this);
								foreach(fig.repeaters, function (nestedFig) {
									$item.find(nestedFig.selector).repeater(extend(
										nestedFig, { $parent: $item }
									));
								});
							});
						}
					};

					var $foreachRepeaterInItem = function (repeaters, $item, cb) {
						if(repeaters) {
							foreach(repeaters, function (nestedFig) {
								cb.call($item.find(nestedFig.selector)[0], nestedFig);
							});
						}
					};

					var setIndexes = function ($items, groupName, repeaters) {
						$items.each(function (index) {
							var $item = $(this);
							$item.data('item-name', groupName + '[' + index + ']');
							$filterNested($item.find('[name]'), repeaters)
							.each(function () {
								var $input = $(this);
								// match non empty brackets (ex: "[foo]")
								var matches = $input.attr('name').match(/\[[^\]]+\]/g);

								var name = matches ?
									// strip "[" and "]" characters
									last(matches).replace(/\[|\]/g, '') :
									$input.attr('name');


								var newName = groupName + '[' + index + '][' + name + ']' +
									($input.is(':checkbox') || $input.attr('multiple') ? '[]' : '');

								$input.attr('name', newName);

								$foreachRepeaterInItem(repeaters, $item, function (nestedFig) {
									var $repeater = $(this);
									setIndexes(
										$filterNested($repeater.find('[data-repeater-item]'), nestedFig.repeaters || []),
										groupName + '[' + index + ']' +
													'[' + $repeater.find('[data-repeater-list]').first().data('repeater-list') + ']',
										nestedFig.repeaters
									);
								});
							});
						});

						$list.find('input[name][checked]')
							.removeAttr('checked')
							.prop('checked', true);
					};

					setIndexes($items(), getGroupName(), fig.repeaters);
					initNested($items());
					if(fig.initEmpty) {
						$items().remove();
					}

					if(fig.ready) {
						fig.ready(function () {
							setIndexes($items(), getGroupName(), fig.repeaters);
						});
					}

					var appendItem = (function () {
						var setItemsValues = function ($item, data, repeaters) {
							if(data || fig.defaultValues) {
								var inputNames = {};
								$filterNested($item.find('[name]'), repeaters).each(function () {
									var key = $(this).attr('name').match(/\[([^\]]*)(\]|\]\[\])$/)[1];
									inputNames[key] = $(this).attr('name');
								});

								$item.inputVal(map(
									filter(data || fig.defaultValues, function (val, name) {
										return inputNames[name];
									}),
									identity,
									function (name) {
										return inputNames[name];
									}
								));
							}


							$foreachRepeaterInItem(repeaters, $item, function (nestedFig) {
								var $repeater = $(this);
								$filterNested(
									$repeater.find('[data-repeater-item]'),
									nestedFig.repeaters
								)
								.each(function () {
									var fieldName = $repeater.find('[data-repeater-list]').data('repeater-list');
									if(data && data[fieldName]) {
										var $template = $(this).clone();
										$repeater.find('[data-repeater-item]').remove();
										foreach(data[fieldName], function (data) {
											var $item = $template.clone();
											setItemsValues(
												$item,
												data,
												nestedFig.repeaters || []
											);
											$repeater.find('[data-repeater-list]').append($item);
										});
									}
									else {
										setItemsValues(
											$(this),
											nestedFig.defaultValues,
											nestedFig.repeaters || []
										);
									}
								});
							});

						};

						return function ($item, data) {
							$list.append($item);
							setIndexes($items(), getGroupName(), fig.repeaters);
							$item.find('[name]').each(function () {
								$(this).inputClear();
							});
							setItemsValues($item, data || fig.defaultValues, fig.repeaters);
						};
					}());

					var addItem = function (data) {
						var $item = $itemTemplate.clone();
						appendItem($item, data);
						if(fig.repeaters) {
							initNested($item);
						}
						show.call($item.get(0));
					};

					setList = function (rows) {
						$items().remove();
						foreach(rows, addItem);
					};

					$filterNested($self.find('[data-repeater-create]'), fig.repeaters).click(function () {
						addItem();
					});

					$list.on('click', '[data-repeater-delete]', function () {
						var self = $(this).closest('[data-repeater-item]').get(0);
						hide.call(self, function () {
							$(self).remove();
							setIndexes($items(), getGroupName(), fig.repeaters);
						});
					});
				});

				this.setList = setList;

				return this;
			};

		}(jQuery));

		/*end of jquery repater   */

		$(document).ready(function () {
			'use strict';
			window.id = 0;

			$('.repeater').repeater(
			{
				defaultValues: {
					'id': window.id,
				},
				show: function () {
					$(this).slideDown();
					console.log($(this).find('input')[1]);
					$('#cat-id').val(window.id);
				},
				hide: function (deleteElement) {
					if(confirm('Are you sure you want to delete this element?')) {
						window.id--;
						$('#cat-id').val(window.id);
						$(this).slideUp(deleteElement);
						console.log($('.repeater').repeaterVal());
					}
				},
				ready: function (setIndexes) {}
			}
			);
		});
	</script>
@endsection
