@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Editer utilisateur</h2>
                <a href="{{ route('admin.users.index') }}" 
                class="btn btn-outline-secondary" 
                style="font-family: 'Courier New', monospace; font-weight: bold; background-color: #C2185B; border-color: #C2185B; color: white;">
                 <i class="fas fa-arrow-left"></i> Retour à utilisateur
             </a>
            </div>
        </div>
    </div>

    @include('users.form')
</div>
@endsection 