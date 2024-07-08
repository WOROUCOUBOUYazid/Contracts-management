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
                 {{-- <div class="col-sm-6">
                    <button type="button" class="btn btn-default float-sm-right">
                        Ajouter un tâche
                    </button>
                 </div><!-- /.col --> --}}
             </div><!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Ajout d'un paiement</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form class="mx-4" action="/contracts/{contract_id}/tasks/store" method="POST">
                    @csrf
                    <div>
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="end_date">Date de fin</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                    </div>
                    <div class="mt-3 d-none">
                        <label for="contract_id">Id du contract</label>
                        <input value={{ $contract[0]->id }} type="text" id="contract_id" name="contract_id" class="form-control" required>
                    </div>
                    <div class="text-center mt-3">
                        {{-- <button class="btn btn-primary rounded-pill">Créer</button> --}}
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
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
