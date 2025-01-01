<form method="post" action="{{ route('masyarakat.profile.update') }}" class="mt-4" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="text-warning">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="btn btn-link p-0">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-success">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="mb-3">
        <label for="photo" class="form-label">{{ __('Photo') }}</label>
        <input id="photo" name="photo" type="file" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml" />
        <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        @if ($user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile Photo" 
            class="rounded-circle mt-2" 
            style="width: 200px; height: 200px; object-fit: cover;">   
        @endif
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">{{ __('Address') }}</label>
        <textarea id="address" name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('address')" />
    </div>

    <div class="mb-3">
        <label for="date_of_birth" class="form-label">{{ __('Date of Birth') }}</label>
        <input id="date_of_birth" name="date_of_birth" type="date" class="form-control"
       value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d') ?? '') }}" />
        <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-success"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>
