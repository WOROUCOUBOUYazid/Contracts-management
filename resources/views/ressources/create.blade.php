<form class="mx-4" action="/ressources/store">
    <div class="input-box">
        <label for="code" class="text-white">Code</label>
        <input type="code" id="code" class="form-control" required>
    </div>
    <div class="input-box">
        <label for="name" class="text-white">Name</label>
        <input type="text" id="name" name="name"` class="form-control" onblur="validateEmail()" oninput="deleteMessage()" required>
        <span id="Error" style="font-size: 0.8em; color: rgb(255, 68, 68); font-style: italic; border: solid 1px transparent;"></span>
    </div>

    <div class="text-center mt-3">
        {{-- <button class="btn btn-primary rounded-pill">Créer</button> --}}
        <input type="submit">
    </div>
</form>
