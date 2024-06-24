<form class="mx-4" action="/contracts/store" method="POST" enctype="multipart/form-data">
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
    {{-- <div class="mt-3">
        <label for="status">Etat</label>
        <select class="form-control" id="status" name="status">
            <option value="unsigned">Non signé</option>
            <option value="active">Actif</option>
            <option value="archived">Archivé</option>
        </select>
    </div> --}}
    <div class="mt-3">
        <label for="service_provider_id">Prestataire</label>
        <select class="form-control" id="service_provider_id" name="service_provider_id">

            @if ($serviceProviders)
                @foreach ($serviceProviders as $serviceProvider)

                <option value="{{ $serviceProvider->id }}">{{ $serviceProvider->user->firstname }}</option>

                @endforeach
            @endif

        </select>
    </div>
    <input type="file" name="file" id="file">
    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
