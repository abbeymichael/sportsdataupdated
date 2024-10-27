<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#clubModal">
        Create New Club
    </button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Country</th>
                <th>City</th>
                <th>Stadium</th>
                <th>Founded</th>
                <th>Manager</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clubs as $club)
                <tr>
                    <td>{{ $club->name }}</td>
                    <td>{{ $club->country }}</td>
                    <td>{{ $club->city }}</td>
                    <td>{{ $club->stadium_name }}</td>
                    <td>{{ $club->founded_year }}</td>
                    <td>{{ $club->manager }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="edit({{ $club->id }})" data-bs-toggle="modal" data-bs-target="#clubModal">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="confirmDelete({{ $club->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $clubs->links() }}

    <!-- Club Modal -->
    <div class="modal fade" id="clubModal" tabindex="-1" aria-labelledby="clubModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clubModalLabel">{{ $isEditing ? 'Edit' : 'Create' }} Club</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" wire:model="name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country:</label>
                            <input type="text" class="form-control" id="country" wire:model="country" required>
                            @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City:</label>
                            <input type="text" class="form-control" id="city" wire:model="city" required>
                            @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stadium_name" class="form-label">Stadium Name:</label>
                            <input type="text" class="form-control" id="stadium_name" wire:model="stadium_name">
                            @error('stadium_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="founded_year" class="form-label">Founded Year:</label>
                            <input type="number" class="form-control" id="founded_year" wire:model="founded_year">
                            @error('founded_year') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="manager" class="form-label">Manager:</label>
                            <input type="text" class="form-control" id="manager" wire:model="manager">
                            @error('manager') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="{{ $isEditing ? 'update' : 'create' }}">{{ $isEditing ? 'Update' : 'Create' }} Club</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this club?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>