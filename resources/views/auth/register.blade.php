<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- firstname -->
        <div class="mt-4">
            <x-input-label for="firstname" :value="__('Prénoms')" />
            <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
        </div>

        <!-- lastname -->
        <div class="mt-4">
            <x-input-label for="lastname" :value="__('Nom')" />
            <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
        </div>

        <!-- phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Téléphone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- role -->
        <div class="mt-4">
            <x-input-label for="role_id" :value="__('Role')" />
            <select id="role_id" class="block mt-1 w-full" name="role_id" :value="old('role_id')" required>
                @if ($roles)
					@foreach ($roles as $role)

					<option value="{{ $role->id }}">{{ $role->name }}</option>

					@endforeach
				@endif
            </select>
            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- birth_date -->
        <div class="mt-4">
            <x-input-label for="birth_date" :value="__('Date de naissance')" />
            <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" autofocus autocomplete="birth_date" />
            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
        </div>

        <!-- birth_place -->
        <div class="mt-4">
            <x-input-label for="birth_place" :value="__('Lieu de naissance')" />
            <x-text-input id="birth_place" class="block mt-1 w-full" type="text" name="birth_place" :value="old('birth_place')" autofocus autocomplete="birth_place" />
            <x-input-error :messages="$errors->get('birth_place')" class="mt-2" />
        </div>

        <!-- residence_place -->
        <div class="mt-4">
            <x-input-label for="residence_place" :value="__('Lieu de résidence')" />
            <x-text-input id="residence_place" class="block mt-1 w-full" type="text" name="residence_place" :value="old('residence_place')" autofocus autocomplete="residence_place" />
            <x-input-error :messages="$errors->get('residence_place')" class="mt-2" />
        </div>

        <!-- adress -->
        <div class="mt-4">
            <x-input-label for="adress" :value="__('Adresse')" />
            <x-text-input id="adress" class="block mt-1 w-full" type="text" name="adress" :value="old('adress')" autofocus autocomplete="adress" />
            <x-input-error :messages="$errors->get('adress')" class="mt-2" />
        </div>

        <!-- marital_status -->
        <div class="mt-4">
            <x-input-label for="marital_status" :value="__('Situation matrimoniale')" />
            <select id="marital_status" class="block mt-1 w-full" name="marital_status">
                <option value="Célibataire">Célibataire</option>
                <option value="En couple">En couple</option>
                <option value="Marié">Marié</option>
            </select>
            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
        </div>

        <!-- children_number -->
        <div class="mt-4">
            <x-input-label for="children_number" :value="__('Nombre d\'enfants')" />
            <x-text-input id="children_number" class="block mt-1 w-full" type="number" name="children_number" :value="old('children_number')" autofocus autocomplete="children_number" />
            <x-input-error :messages="$errors->get('children_number')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
