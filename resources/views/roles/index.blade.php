@extends('layouts.admin')

 @section('title','Roles management')

 @section('head-complement')
     {{-- DataTables --}}
     <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
     <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
 @endsection

 @section('content')
     {{-- Header --}}
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m_0 text-dark">Gestion des rôles</h1>
                 </div><!-- /.col -->
                 <div class="col-sm-6">
                    <button type="button" class="btn btn-default float-sm-right" data-toggle="modal" data-target="#modal_creation_form">
                        Créer un rôle
                    </button>
                 </div><!-- /.col -->
             </div><!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>

    {{-- Modal (role creation form) --}}
	<div class="modal fade" id="modal_creation_form" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Création d'un role</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="mx-4" id="role-form" method="POST" action="/roles/store" enctype="multipart/form-data">
					@csrf
					<div class="input-box">
                        <label for="code">Code</label>
                        <input type="text" id="code" name="code" class="form-control" required>
                    </div>
                    <div class="input-box">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name"` class="form-control" required>
                        <span id="Error" style="font-size: 0.8em; color: rgb(255, 68, 68); font-style: italic; border: solid 1px transparent;"></span>
                    </div>
                    <div class="input-box">
                        <label for="ressource">Ressource</label>
                        <select class="form-control" id="ressource" name="ressources[]" multiple>
                            @if ($ressources)
                                @foreach ($ressources as $ressource)

                                <option value="{{ $ressource->id }}">{{ $ressource->name }}</option>

                                @endforeach
                            @endif
                        </select>
                    </div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary" form="role-form">Enregistrer</button>
			</div>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

    {{-- Datatable --}}
     <div class="card">
         <div class="card-header">
           <h3 class="card-title">Gérez vos rôles ici.	</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
             <table id="table_classes" class="table table-bordered table-striped">
                 <thead>
                 <tr>
                    <th>Id</th>
                    <th>Code</th>
                    <th>Nom</th>
                 </tr>
                 </thead>
                 <tbody>

                     @foreach ($roles as $role)
                         <tr>
                             <td>{{ $role->id }}</td>
                             <td>{{ $role->code }}</td>
                             <td>{{ $role->name }}</td>
                         </tr>
                     @endforeach

                 </tbody>
                 <tfoot>
                     <tr>
                        <th>Id</th>
                        <th>Code</th>
                        <th>Nom</th>
                     </tr>
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
             }
         );

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
