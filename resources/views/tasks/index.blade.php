@extends('layouts.manager')

 @section('title','Tasks management')

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
                     <h1 class="m_0 text-dark">Gestion des tâches</h1>
                 </div><!-- /.col -->
                 <div class="col-sm-6">
                    <button type="button" class="btn btn-default float-sm-right" onclick="window.location='http:\/\/127.0.0.1:8000\/contracts\/{{$contract[0]->id}}\/tasks\/create'">
                        Ajouter un tâche
                    </button>
                 </div><!-- /.col -->
             </div><!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>

    {{-- Modal (tasks creation form) --}}
	<div class="modal fade" id="modal_creation_form" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ajout d'une tâche</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="mx-4" id="task-form" method="POST" action="/roles/store">
					@csrf
					<div>
						<label for="name">Nom</label>
						<input type="text" id="name" name="name" class="form-control" required>
					</div>
					<div class="mt-3">
						<label for="description">Description</label>
                        <textarea name="description" id="description" form="task-form" cols="55" rows="3" required></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary" form="task-form">Enregistrer</button>
			</div>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

    {{-- Datatable --}}
     {{-- <div class="card">
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
     </div> --}}

    <div class="container-fluid">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0">
              <div class="w-25 d-flex justify-content-around align-items-center ml-2 mb-3 py-2">
                <p class="small mb-0 me-2 text-muted">Filtre</p>
                <select class="select">
                  <option value="1">Tout</option>
                  <option value="2">En cours</option>
                  <option value="3">Terminées</option>
                </select>
                <p class="small mb-0 ms-4 me-2 text-muted">Ordre</p>
                <select class="select">
                  <option value="1">Croissant</option>
                  <option value="2">Décroissant</option>
                  <option value="3">Date d'ajout</option>
                </select>
                {{-- <a href="#!" style="color: #23af89;" data-mdb-toggle="tooltip" title="Ascending"><i class="fas fa-sort-amount-down-alt ms-2"></i></a> --}}
              </div>
            </div>
            <div class="card-body">

              @foreach ($tasks as $task)
                  
              <div class="d-flex border-bottom">
                <div class="d-flex align-items-center form-check mx-4">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" style="width: 20px; height:20px;" aria-label="..."/>
                </div>
                <div class="col-10 d-flex flex-column">
                  <p class="lead fw-normal mb-0">{{ $task->name }}</p>
                  <p class="fst-italic small my-0">{{ $task->end_date }}</p>
                </div>
                <div class="col-1 d-flex flex-row align-items-center justify-content-end">
                  <a href="#!" class="mr-4" style="color: inherit" data-mdb-toggle="tooltip"><i class="fas fa-edit"></i></a>
                  <a href="#!" style="color: inherit" data-mdb-toggle="tooltip"><i class="fas fa-trash"></i></a>
                </div>
              </div>

              @endforeach

              {{-- <div class="d-flex border-bottom">
                <div class="d-flex align-items-center form-check mx-4">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" style="width: 20px; height:20px;" aria-label="..." checked />
                </div>
                <div class="col-10 d-flex flex-column">
                  <p class="lead fw-normal mb-0">Buy groceries for next week</p>
                  <p class="fst-italic small my-0">28th Jun 2020</p>
                </div>
                <div class="col-1 d-flex flex-row align-items-center justify-content-end">
                  <a href="#!" class="mr-4" style="color: inherit" data-mdb-toggle="tooltip"><i class="fas fa-edit"></i></a>
                  <a href="#!" style="color: inherit" data-mdb-toggle="tooltip"><i class="fas fa-trash"></i></a>
                </div>
              </div>
              <div class="d-flex border-bottom">
                <div class="d-flex align-items-center form-check mx-4">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" style="width: 20px; height:20px;" aria-label="..."/>
                </div>
                <div class="col-10 d-flex flex-column">
                  <p class="lead fw-normal mb-0">Buy groceries for next week</p>
                  <p class="fst-italic small my-0">28th Jun 2020</p>
                </div>
                <div class="col-1 d-flex flex-row align-items-center justify-content-end">
                  <a href="#!" class="mr-4" style="color: inherit" data-mdb-toggle="tooltip"><i class="fas fa-edit"></i></a>
                  <a href="#!" style="color: inherit" data-mdb-toggle="tooltip"><i class="fas fa-trash"></i></a>
                </div>
              </div>
              <div class="d-flex border-bottom">
                <div class="d-flex align-items-center form-check mx-4">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" style="width: 20px; height:20px;" aria-label="..."/>
                </div>
                <div class="col-10 d-flex flex-column">
                  <p class="lead fw-normal mb-0">Buy groceries for next week</p>
                  <p class="fst-italic small my-0">28th Jun 2020</p>
                </div>
                <div class="col-1 d-flex flex-row align-items-center justify-content-end">
                  <a href="#!" class="mr-4" style="color: inherit" data-mdb-toggle="tooltip"><i class="fas fa-edit"></i></a>
                  <a href="#!" style="color: inherit" data-mdb-toggle="tooltip"><i class="fas fa-trash"></i></a>
                </div>
              </div>
              <div class="d-flex border-bottom">
                <div class="d-flex align-items-center form-check mx-4">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" style="width: 20px; height:20px;" aria-label="..."/>
                </div>
                <div class="col-10 d-flex flex-column">
                  <p class="lead fw-normal mb-0">Buy groceries for next week</p>
                  <p class="fst-italic small my-0">28th Jun 2020</p>
                </div>
                <div class="col-1 d-flex flex-row align-items-center justify-content-end">
                  <a href="#!" class="mr-4" style="color: inherit" data-mdb-toggle="tooltip"><i class="fas fa-edit"></i></a>
                  <a href="#!" style="color: inherit" data-mdb-toggle="tooltip"><i class="fas fa-trash"></i></a>
                </div>
              </div> --}}
            </div>
            <!-- /.card-body -->
        </div>
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
