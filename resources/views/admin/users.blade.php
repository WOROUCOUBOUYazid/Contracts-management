@extends('layouts.admin')

@section('title','Users management')

@section('head-complement')
	{{-- DataTables --}}
	<link rel="stylesheet" href="admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
	{{-- Header --}}
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m_0 text-dark">Gestion des utilisateurs</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<button type="button" class="btn btn-default float-sm-right" data-toggle="modal" data-target="#modal_user_creation">
						Créer un utilisateur
					</button>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	
	{{-- Modal (user creation form) --}}
	<div class="modal fade" id="modal_user_creation" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Création d'un utilisateur</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="mx-4" id="user-creation-form" action="/users/store" method="POST">
					@csrf
					<div>
						<label for="lastname">Nom</label>
						<input type="text" id="lastname" name="lastname" class="form-control" required>
					</div>
					<div class="mt-3">
						<label for="firstname">Prénom</label>
						<input type="text" id="firstname" name="firstname" class="form-control" required>
					</div>
					<div class="mt-3">
						<label for="phone">Téléphone</label>
						<input type="number" id="phone" name="phone" class="form-control" required>
					</div>
					<div class="mt-3">
						<label for="email">Email</label>
						<input type="text" id="email" name="email" class="form-control" onblur="validateEmail()" oninput="deleteMessage()" required>
						<span id="emailError" style="font-size: 0.8em; color: rgb(255, 68, 68); font-style: italic; border: solid 1px transparent;"></span>
					</div>
					<div>
						<label for="role_id">Role de l'utilisateur</label>
						<select class="form-control" id="role_id" name="role_id">
							<option value="1">Administrateur</option>
							<option value="2">Gestionnaire de contrat</option>
							<option value="3" selected>Prestataire</option>
						</select>
					</div>
					<div class="mt-3">
						<label for="password">Mot de passe</label>
						<input type="password" id="password" name="password" class="form-control" onblur="validatePassword()" required>
						<span id="passwordError" style="font-size: 0.8em; color: red; font-style: italic; border: solid 1px transparent;"></span>
					</div>
					<div>
						<label for="confirmPassword">Confirmer le mot de passe</label>
						<input type="password" id="confirmPassword" name="confirmPassword" class="form-control" onblur="confirmPassword()" required>
						<span id="confirmPasswordError" style="font-size: 0.8em; color: red; font-style: italic; border: solid 1px transparent;"></span>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary" form="user-creation-form">Enregistrer</button>
			</div>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	{{-- Modal (user update form) --}}
	<div class="modal fade" id="modal_user_update" data-backdrop="static">
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
	<div class="modal fade" id="modal_user_delete" data-backdrop="static">
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

	{{-- Datatable --}}
	<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Gérez vos utilisateurs ici</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
		  <table id="table_classes" class="table table-bordered table-striped">
			<thead>
			<tr>
			  <th>Id</th>
			  <th>Nom et Prénoms</th>
			  <th>Phone</th>
			  <th>Email</th>
			  <th>Role</th>
			  <th>Actions</th>
			</tr>
			</thead>
			<tbody>
			
			@if ($users)
					
				@foreach ($users as $element)
					
				<tr>
				<td>{{ $element->id }}</td>
				<td>{{ $element->lastname}} {{ $element->firstname }}</td>
				<td>{{ $element->phone }}</td>
				<td>{{ $element->email }}</td>
				<td>{{ $element->role->name }}</td>
				<td>
					<div class="row d-flex justify-content-around">
						{{-- <button class="border border-light bg-transparent edit-btn" data-user-id="{{ $element->id }}" data-toggle="modal" data-target="#modal_user_show" style="color: inherit"><i class="fas fa-eye"></i></button> --}}
						<button class="border border-light bg-transparent edit-btn" data-user-id="{{ $element->id }}" data-toggle="modal" data-target="#modal_user_update" style="color: inherit"><i class="fas fa-edit"></i></button>
						<button class="border border-light bg-transparent edit-btn" data-toggle="modal" data-target="#modal_user_delete" style="color: inherit"><i class="fas fa-trash"></i></button>
					</div>
				</td>
				</tr>

				@endforeach
			
			@endif

			</tbody>
			<tfoot>
				<tr>
				  <th>Id</th>
				  <th>Nom et Prénoms</th>
				  <th>Phone</th>
				  <th>Email</th>
				  <th>Role</th>
				  <th>Actions</th>
				</tr>
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
	{{-- validation script --}}
	<script>
		function validateEmail() {
			const emailInput = document.getElementById('email');
			const email = emailInput.value.trim();
			const errorSpan = document.getElementById('emailError');
	
			const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	
			if (!emailRegex.test(email)) {
				errorSpan.innerText = 'Veuillez entrer une adresse email valide. example@email.com';
				emailInput.style.border = "solid 1px red";
			} else {
					errorSpan.textContent = ''; // Effacer le message d'erreur s'il est valide
			}
		}
	
		function deleteMessage() {
				const errorSpan = document.getElementById('emailError');
	
				errorSpan.textContent = '';
		}

		function validatePassword() {
			const passwordInput = document.getElementById('password');
			const password = passwordInput.value;
			const errorSpan = document.getElementById('passwordError');

			var minLengthRegex = /^(.{8,})$/.test(password);
			var hasUpperCaseRegex = /^(?=.*[A-Z])/.test(password);
			var hasLowerCaseRegex = /^(?=.*[a-z])/.test(password);
			var hasNumberRegex = /^(?=.*[0-9])/.test(password);
			var hasSpecialCharRegex = /^(?=.*[!@#$%^&*_-])/.test(password);

			if(!hasUpperCaseRegex) {
				errorSpan.innerText = "Le mot de passe doit comporter une lettre majuscule.";
			} else if(!hasLowerCaseRegex) {
				errorSpan.innerText = "Le mot de passe doit comporter une lettre minuscule.";
			} else if(!hasNumberRegex) {
				errorSpan.innerText = "Le mot de passe doit comporter un chiffre.";
			} else if(!hasSpecialCharRegex) {
				errorSpan.innerText = "Le mot de passe doit comporter un caractere special.";
			} else if(!minLengthRegex) {
				errorSpan.innerText = "Le mot de passe doit avoir une longueur minimale de 8.";
			} else {
				errorSpan.textContent = '';
			}
		}
		
		function confirmPassword() {
			const passwordInput = document.getElementById('password');
			const password = passwordInput.value;
			const confirmPasswordInput = document.getElementById('confirmPassword');
			const confirmPassword = confirmPasswordInput.value;
			const errorSpan = document.getElementById('confirmPasswordError');

			if(true) {
				errorSpan.innerText = "Les mots de passe ne correspondent pas.";
			} else {
				errorSpan.textContent = '';
			}
		}
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
