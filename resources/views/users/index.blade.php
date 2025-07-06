@extends('layouts.app')

@section('content')
<style>
    .delete-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(118, 24, 123, 0.858);
    }
    .modal-content {
        background-color: #a71da575;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #600468;
        width: 80%;
        max-width: 500px;
        border-radius: 5px;
    }
    .modal-actions {
        margin-top: 20px;
        text-align: right;
    }
    .modal-actions button {
        margin-left: 10px;
    }
</style>

<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 style="font-family: 'Courier New', monospace; text-align: center;  font-weight: bold; color: #C2185B;">Paramétre utilisateur</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.users.create') }}" 
            class="btn btn-primary" 
            style="background-color: #C2185B; border-color: #C2185B; color: white; font-family: 'Courier New', monospace; font-weight: bold;">
             Nouveau utilisateur
         </a>
         
        </div>
    </div>

    @if($users->isEmpty())
        <div class="alert alert-info">
            Non utilisateur trouvé.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Créer en</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->is_admin ? 'bg-primary' : 'bg-secondary' }}">
                                    {{ $user->is_admin ? 'Admin' : 'User' }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                    <button type="button" 
                                            class="btn btn-sm btn-danger"
                                            onclick="showDeleteModal({{ $user->id }}, '{{ $user->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="delete-modal">
        <div class="modal-content">
            <h4>Confirmer suppression</h4>
            <p>Etes-vous sûre de vouloir supprimer? <span id="userName"></span>?</p>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="hideDeleteModal()">Annuler</button>
                <form id="deleteForm" action="" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showDeleteModal(userId, userName) {
        document.getElementById('deleteModal').style.display = 'block';
        document.getElementById('userName').textContent = userName;
        document.getElementById('deleteForm').action = `/admin/users/${userId}`;
    }

    function hideDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target == modal) {
            hideDeleteModal();
        }
    }
</script>
@endsection