<form class="mx-4" action="/roles/store" method="POST">
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
    <div class="text-center mt-3">
        {{-- <button class="btn btn-primary rounded-pill">Créer</button> --}}
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
