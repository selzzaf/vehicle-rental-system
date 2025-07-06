@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
            <div class="d-flex justify-content-between align-items-center">
                <h2 style="text-align: center; font-family: 'Courier New', monospace; color: #000000; font-weight: bold;">
                    Nouveau utilisateur
                </h2>
                
                
                <a href="{{ route('admin.users.index') }}" 
   class="btn btn-outline-secondary" 
   style="background-color: #C2185B; border-color: #C2185B; color: white; font-family: 'Courier New', monospace;">
    <i class="fas fa-arrow-left"></i> Retour à utilisateur
</a>

            </div>
        </div>
    </div>

    @include('users.form')
</div>
@endsection 