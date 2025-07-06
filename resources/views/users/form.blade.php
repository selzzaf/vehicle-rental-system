<style>
    .card {
        box-shadow: 0 2px 4px rgba(179, 10, 153, 0.614);
        border-radius: 8px;
        border: none;
    }
    .card-header {
        background-color: #8a5079a3;
        border-bottom: 1px solid #cb18d852;
        padding: 1rem;
    }
    .card-header h4 {
        margin-bottom: 0;
        color: #af0ab5a8;
    }
    .card-body {
        padding: 2rem;
    }
    .form-label {
        font-weight: 500;
        color: #850857;
    }
    .form-control {
        border-radius: 4px;
        border: 1px solid #7d0d75;
        padding: 0.5rem 0.75rem;
    }
    .form-control:focus {
        border-color: #9e0eb4;
        box-shadow: 0 0 0 0.2rem rgba(125, 12, 108, 0.25);
    }
    .form-check-input:checked {
        background-color: #9d0fbcec;
        border-color: #fd0da9;
    }
    .btn {
        padding: 0.5rem 1rem;
        font-weight: 500;
    }
    .btn-primary {
        background-color: #910a86;
        border-color: #ac12a4bd;
    }
    .btn-primary:hover {
        background-color: #a50793;
        border-color: #ca0aa7;
    }
    .btn-outline-secondary:hover {
        background-color: #541e55;
        color: rgba(148, 14, 141, 0.263);
    }
</style>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h4 style="text-align: center; font-family: 'Courier New', monospace; color: #333333;">{{ isset($user) ? 'Editer utilisateur' : 'Nouveau utilisateur' }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" 
                      method="POST">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user->name ?? '') }}" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user->email ?? '') }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Mot de passe {{ isset($user) ? '(Laisser vide pour récuperer le courant)' : '' }}
                        </label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               {{ isset($user) ? '' : 'required' }}>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="hidden" name="is_admin" value="0">
                            <input type="checkbox" 
                                   class="form-check-input @error('is_admin') is-invalid @enderror" 
                                   id="is_admin" 
                                   name="is_admin" 
                                   value="1" 
                                   {{ old('is_admin', $user->is_admin ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_admin">
                                Administrateur
                            </label>
                            @error('is_admin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($user) ? 'Update' : 'Create' }} utilisateur
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 