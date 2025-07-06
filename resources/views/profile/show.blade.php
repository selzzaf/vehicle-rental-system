@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0" style="background: white; border-radius: 20px;">
                <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-radius: 20px 20px 0 0; border: none;">
                    <h3 class="mb-0" style="font-family: 'Inter', sans-serif; font-weight: 700; color: #fff;">
                        <i class="fas fa-user-circle me-2"></i>Mon profil
                    </h3>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-light" 
                       style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 12px; padding: 10px 24px;">
                        <i class="fas fa-edit me-2"></i>Éditer profil
                    </a>
                </div>
                <div class="card-body p-5">
                    @if(session('success'))
                        <div class="alert alert-success" style="border-radius: 12px; font-family: 'Inter', sans-serif;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-4 text-muted text-end" style="font-family: 'Inter', sans-serif; font-weight: 600;">Nom :</div>
                        <div class="col-md-8" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #1a1a1a;">{{ $user->name }}</div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4 text-muted text-end" style="font-family: 'Inter', sans-serif; font-weight: 600;">Email :</div>
                        <div class="col-md-8" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #1a1a1a;">{{ $user->email }}</div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4 text-muted text-end" style="font-family: 'Inter', sans-serif; font-weight: 600;">Rôle :</div>
                        <div class="col-md-8">
                            <span class="badge {{ $user->is_admin ? 'bg-dark' : 'bg-secondary' }}" style="font-family: 'Inter', sans-serif; font-weight: 600; font-size: 1rem; padding: 8px 18px; border-radius: 12px;">
                                {{ $user->is_admin ? 'Administrateur' : 'Utilisateur' }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4 text-muted text-end" style="font-family: 'Inter', sans-serif; font-weight: 600;">Client depuis :</div>
                        <div class="col-md-8" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #1a1a1a;">{{ $user->created_at->format('d F Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .badge.bg-dark {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%) !important;
        color: #fff !important;
    }
    .badge.bg-secondary {
        background: #e9ecef !important;
        color: #1a1a1a !important;
    }
    .alert-success {
        background: linear-gradient(135deg, #e3fcec 0%, #b2f2d7 100%);
        color: #087f5b;
        border: none;
    }
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0,0,0,0.1) !important;
    }
</style>
@endsection
