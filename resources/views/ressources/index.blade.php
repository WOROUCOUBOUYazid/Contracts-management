@extends('layouts.admin')

@section('title','Ressources management')

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
					<h1 class="m_0 text-dark">Gestion des ressources</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					{{-- <button type="button" class="btn btn-default float-sm-right" data-toggle="modal" data-target="#modal_creation_form">
						Créer un utilisateur
					</button> --}}
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

    <div class="card">
		<div class="card-header">
		  <h3 class="card-title">Gérez vos ressources ici.  </h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
            <table id="table_classes" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Http méthode</th>
                <th>Uri</th>
                <th>Created at</th>
                <th>Updated at</th>
                </tr>
                </thead>
                <tbody>

                    @foreach ($ressources as $ressource)
                        <tr>
                            <td>{{ $ressource->id }}</td>
                            <td>{{ $ressource->name }}</td>
                            <td>{{ $ressource->http_method }}</td>
                            <td>{{ $ressource->uri }}</td>
                            <td>{{ $ressource->created_at }}</td>
                            <td>{{ $ressource->updated_at }}</td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Http méthode</th>
                    <th>Uri</th>
                    <th>Created at</th>
                    <th>Updated at</th>
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
