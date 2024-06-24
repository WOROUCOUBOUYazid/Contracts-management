<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($ressources as $ressource)
        <div class="p-6 flex space-x-2">
            {{ $ressource }}
         </div>
     @endforeach
 </div>
