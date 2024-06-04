@extends('layouts.serviceProvider')

@section('title','Dashboard')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Mes contrats</h1>
            </div><!-- /.col -->
            {{-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col --> --}}
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Vos contrats sont affichés ici</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="accordion" id="accordion">
                    <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                    <div class="card rounded" style="border-bottom: 3px solid lightgreen; border-left: 3px solid lightgreen">
                      <div class="card-header" id="headingOne">
                        <div class="card-title container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a style="color: inherit" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        Contrat de prestation de service - Développeur web
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <button class="border border-light bg-transparent float-sm-right"><i class="fas fa-download"></i></button>
                                    <button class="border border-light bg-transparent float-sm-right"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                            {{-- <div class="row ml-1">
                              <p class="text-sm text-success m-0">Actif</p>
                              <p class="text-sm font-italic m-0">, Décembre 2023 - Mai 2024</p>
                            </div> --}}
                        </div>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in" aria-labelledby="headingOne" data-bs-parent="#accordion">
                        <div class="card-body">
                            <dl class="row">
                              <dt class="col-sm-4">Description</dt>
                                <dd class="col-sm-8">A description list is perfect for defining terms, conditions and whatever they want.</dd>
                                <dd class="col-sm-8 offset-sm-4">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                              <dt class="col-sm-4">Montant</dt>
                                <dd class="col-sm-8">200000 fcfa</dd>
                              <dt class="col-sm-4">Période</dt>
                                <dd class="col-sm-8">Décembre 2023 - Mai 2024</dd>
                              <dt class="col-sm-4">Status</dt>
                                <dd class="col-sm-8 text-success">Actif</dd>
                            </dl>
                        </div>
                      </div>
                    </div>
                    <div class="card rounded" style="border-bottom: 4px solid grey; border-left: 3px solid grey">
                      <div class="card-header" id="headingTwo">
                        <div class="card-title container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a style="color: inherit" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        Contrat de prestation de service - Développeur web
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <button class="border border-light bg-transparent float-sm-right"><i class="fas fa-download"></i></button>
                                    <button class="border border-light bg-transparent float-sm-right"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                            {{-- <div class="row ml-1">
                              <p class="text-sm text-primary m-0">Archivé</p>
                              <p class="text-sm font-italic m-0">, Mai 2023 - Octobre 2023</p>
                            </div> --}}
                        </div>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                        <div class="card-body">
                            <dl class="row">
                              <dt class="col-sm-4">Description</dt>
                                <dd class="col-sm-8">A description list is perfect for defining terms, conditions and whatever they want.</dd>
                                <dd class="col-sm-8 offset-sm-4">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                              <dt class="col-sm-4">Montant</dt>
                                <dd class="col-sm-8">120000 fcfa</dd>
                              <dt class="col-sm-4">Période</dt>
                                <dd class="col-sm-8">Mai 2023 - Octobre 2023</dd>
                              <dt class="col-sm-4">Status</dt>
                                <dd class="col-sm-8 text-secondary">Archivé</dd>
                            </dl>
                          </div>
                      </div>
                    </div>
                    <div class="card rounded" style="border-bottom: 4px solid grey; border-left: 3px solid grey">
                      <div class="card-header" id="headingThree">
                        <div class="card-title container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a style="color: inherit" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        Contrat de prestation de service - Maintenancier informatique
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <button class="border border-light bg-transparent float-sm-right"><i class="fas fa-download"></i></button>
                                    <button class="border border-light bg-transparent float-sm-right"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                            {{-- <div class="row ml-1">
                              <p class="text-sm text-primary m-0">Archivé</p>
                              <p class="text-sm font-italic m-0">, Février 2021 - Juillet 2021</p>
                            </div> --}}
                        </div>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
                        <div class="card-body">
                            <dl class="row">
                              <dt class="col-sm-4">Description</dt>
                                <dd class="col-sm-8">A description list is perfect for defining terms, conditions and whatever they want.</dd>
                                <dd class="col-sm-8 offset-sm-4">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                              <dt class="col-sm-4">Montant</dt>
                                <dd class="col-sm-8">50000 fcfa</dd>
                              <dt class="col-sm-4">Période</dt>
                                <dd class="col-sm-8">Février 2021 - Juillet 2021</dd>
                              <dt class="col-sm-4">Status</dt>
                                <dd class="col-sm-8 text-secondary">Archivé</dd>
                            </dl>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('js_files-complement')
  <script>
    const collapseList = document.querySelectorAll('.collapse');
    collapseList.forEach(collapse => {
      collapse.addEventListener('show.bs.collapse', function () {
        const collapseId = this.getAttribute('id');
        collapseList.forEach(item => {
          if (item.getAttribute('id') !== collapseId) {
            $(item).collapse('hide'); // Use jQuery for collapse manipulation
          }
        });
      });
    });
  </script>
@endsection
