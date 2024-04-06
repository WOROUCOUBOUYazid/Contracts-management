@extends('layouts.manager')

@section('title','Tasks management')

@section('content')

	{{-- Header --}}
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Gestion des taches</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<button type="button" class="btn btn-default float-sm-right" data-toggle="modal" data-target="#modal-default">
						Ajouter une tache
					</button>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	{{-- Modal (user creation form) --}}
	<div class="modal fade" id="modal-default" data-backdrop="static">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ajout d'une tache</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="mx-4" id="task-form" action="" method="POST">
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

  {{-- Todo list - Start --}}
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
          <div class="d-flex border-bottom">
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
          </div>
        </div>
        <!-- /.card-body -->
    </div>
  </div>
  {{-- Todo list - End --}}
@endsection

