@extends('layouts.manager')

@section('title','Contracts management')

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
					<h1 class="m-0 text-dark">Gestion des contrats</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<button type="button" class="btn btn-default float-sm-right" data-toggle="modal" data-target="#modal-creation-form">
						Créer un contrat
					</button>
					<button type="button" class="btn btn-default float-sm-right" data-toggle="modal" data-target="#modal-default">
						Charger un contrat
					</button>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	
	{{-- Modal (contract creation form) --}}
	<div class="modal fade" id="modal-creation-form" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Création d'un contrat</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="mx-4" id="contract-form" action="">
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
						<label for="userType">Type de l'utilisateur</label>
						<select class="form-control" id="userType" name="userType">
							<option value="admin">Administrateur</option>
							<option value="contractManager">Gestionnaire de contrat</option>
							<option value="serviceProvider" selected>Prestataire</option>
						</select>
					</div>
					<div class="mt-3">
						<label for="password">Mot de passe</label>
						<input type="password" type="password" id="password" class="form-control" onblur="validatePassword()" required>
						<span id="passwordError" style="font-size: 0.8em; color: red; font-style: italic; border: solid 1px transparent;"></span>
					</div>
					<div>
						<label for="confirmPassword">Confirmer le mot de passe</label>
						<input type="password" id="confirmPassword" class="form-control" onblur="confirmPassword()" required>
						<span id="confirmPasswordError" style="font-size: 0.8em; color: red; font-style: italic; border: solid 1px transparent;"></span>
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

	{{-- Modal (Upload) --}}
	<div class="modal fade" id="modal-default">
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
	</div>

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
			<tr>
			  <td>01</td>
			  <td>Développeur d'application web</td>
			  <td>Mathias Carlton</td>
			  <td>01/10/2023</td>
			  <td>01/03/2023</td>
			  <td>
				<div class="row d-flex justify-content-around">
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					<div>
						<button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						</button>
						<ul class="dropdown-menu">
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-edit mr-2"></i>Modifier</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-trash mr-2"></i>Désactiver</a></li>
						</ul>
					</div>
				</div>
			  </td>
			</tr>
			<tr>
			  <td>02</td>
			  <td>Aide Soignant</td>
			  <td>Céline Brooks</td>
			  <td>01/10/2023</td>
			  <td>01/03/2023</td>
			  <td>
				<div class="row d-flex justify-content-around">
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					<div>
						<button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						</button>
						<ul class="dropdown-menu">
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-edit mr-2"></i>Modifier</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-trash mr-2"></i>Désactiver</a></li>
						</ul>
					</div>
				</div>
			  </td>
			</tr>
			<tr>
			  <td>03</td>
			  <td>Transfusionniste</td>
			  <td>Benjamin Kane</td>
			  <td>01/10/2023</td>
			  <td>01/03/2023</td>
			  <td>
				<div class="row d-flex justify-content-around">
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					<div>
						<button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						</button>
						<ul class="dropdown-menu">
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-edit mr-2"></i>Modifier</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-trash mr-2"></i>Désactiver</a></li>
						</ul>
					</div>
				</div>
			  </td>
			</tr>
			<tr>
			  <td>04</td>
			  <td>Administrateur système et réseau</td>
			  <td>Charlie Potter</td>
			  <td>01/10/2023</td>
			  <td>01/03/2023</td>
			  <td>
				<div class="row d-flex justify-content-around">
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					<div>
						<button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						</button>
						<ul class="dropdown-menu">
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-edit mr-2"></i>Modifier</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-trash mr-2"></i>Désactiver</a></li>
						</ul>
					</div>
				</div>
			  </td>
			</tr>
			<tr>
			  <td>05</td>
			  <td>Consultant en RH</td>
			  <td>Turner Amélie</td>
			  <td>01/10/2023</td>
			  <td>01/03/2023</td>
			  <td>
				<div class="row d-flex justify-content-around">
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					<div>
						<button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						</button>
						<ul class="dropdown-menu">
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-edit mr-2"></i>Modifier</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-trash mr-2"></i>Désactiver</a></li>
						</ul>
					</div>
				</div>
			  </td>
			</tr>
			<tr>
			  <td>06</td>
			  <td>Graphiste</td>
			  <td>Tiles Wolff</td>
			  <td>01/10/2023</td>
			  <td>01/03/2023</td>
			  <td>
				<div class="row d-flex justify-content-around">
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					<div>
						<button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						</button>
						<ul class="dropdown-menu">
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-edit mr-2"></i>Modifier</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-trash mr-2"></i>Désactiver</a></li>
						</ul>
					</div>
				</div>
			  </td>
			</tr>
			<tr>
			  <td>07</td>
			  <td>Gardien</td>
			  <td>Antony Davis</td>
			  <td>01/10/2023</td>
			  <td>01/03/2023</td>
			  <td>
				<div class="row d-flex justify-content-around">
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/tasks" style="text-decoration: none; color: inherit;"><i class="fas fa-clipboard"></i><p class="small">Taches</p></a></button>
					<button class="d-flex flex-column align-items-center border border-light bg-transparent"><a href="/payments" style="text-decoration: none; color: inherit;"><i class="fas fa-dollar-sign"></i><p class="small">Paiements</p></a></button>
					<div>
						<button type="button" class="border border-light bg-transparent dropdown-toggle" data-toggle="dropdown">
						</button>
						<ul class="dropdown-menu">
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-eye mr-2"></i>Afficher</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-edit mr-2"></i>Modifier</a></li>
						  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="fas fa-trash mr-2"></i>Désactiver</a></li>
						</ul>
					</div>
				</div>
			  </td>
			</tr>
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
@endsection
