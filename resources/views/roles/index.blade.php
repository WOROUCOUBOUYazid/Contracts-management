<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($roles as $role)
        <div class="p-6 flex space-x-2">
            {{ $role }}
         </div>
     @endforeach
 </div>
