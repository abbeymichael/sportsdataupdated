<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPlayerModal">
            Create New Player
        </button>
        
        <div class="d-inline-block">
            <input type="file" class="form-control" wire:model="importFile">
            <button class="btn btn-success" wire:click="importPlayers">Import Players</button>
            <button class="btn btn-info" wire:click="exportPlayers">Export Players</button>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>DOB</th>
                <th>Height</th>
                <th>Weight</th>
                <th>Position</th>
                <th>Preferred Foot</th>
                <th>Club</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
                <tr>
                    <td>{{ $player->name }}</td>
                    <td>{{ $player->dob }}</td>
                    <td>{{ $player->height }}</td>
                    <td>{{ $player->weight }}</td>
                    <td>{{ $player->position }}</td>
                    <td>{{ $player->preferred_foot }}</td>
                    <td>{{ $player->club->name }}</td>
                    <td>
                        @if($player->image)
                            <img src="{{ Storage::url($player->image) }}" alt="Player Image" style="max-height: 50px;">
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="edit({{ $player->id }})" data-bs-toggle="modal" data-bs-target="#editPlayerModal{{ $player->id }}">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="confirmDelete({{ $player->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                    </td>
                </tr>

                <div class="modal fade" id="editPlayerModal{{ $player->id }}" tabindex="-1" aria-labelledby="editPlayerModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPlayerModalLabel">Edit Player</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="update">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" class="form-control" id="name" wire:model="name" required>
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Date of Birth:</label>
                                        <input type="date" class="form-control" id="dob" wire:model="dob" required>
                                        @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="height" class="form-label">Height (cm):</label>
                                        <input type="number" class="form-control" id="height" wire:model="height" required>
                                        @error('height') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="weight" class="form-label">Weight (kg):</label>
                                        <input type="number" class="form-control" id="weight" wire:model="weight" required>
                                        @error('weight') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Position:</label>
                                        <input type="text" class="form-control" id="position" wire:model="position" required>
                                        @error('position') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="preferred_foot" class="form-label">Preferred Foot:</label>
                                        <select class="form-control" id="preferred_foot" wire:model="preferred_foot" required>
                                            <option value="">Select foot</option>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                        @error('preferred_foot') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="club_id" class="form-label">Club:</label>
                                        <select class="form-control" id="club_id" wire:model="club_id" required>
                                            <option value="">Select club</option>
                                            @foreach(\App\Models\Club::all() as $club)
                                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('club_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image:</label>
                                        <input type="file" class="form-control" id="image" wire:model="image">
                                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Player</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    {{ $players->links() }}

    <!-- Create Player Modal -->
    <div class="modal fade" id="createPlayerModal" tabindex="-1" aria-labelledby="createPlayerModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPlayerModalLabel">Create Player</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="create">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" wire:model="name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth:</label>
                            <input type="date" class="form-control" id="dob" wire:model="dob" required>
                            @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="height" class="form-label">Height (cm):</label>
                            <input type="number" class="form-control" id="height" wire:model="height" required>
                            @error('height') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight (kg):</label>
                            <input type="number" class="form-control" id="weight" wire:model="weight" required>
                            @error('weight') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position:</label>
                            <input type="text" class="form-control" id="position" wire:model="position" required>
                            @error('position') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="preferred_foot" class="form-label">Preferred Foot:</label>
                            <select class="form-control" id="preferred_foot" wire:model="preferred_foot" required>
                                <option value="">Select foot</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                            </select>
                            @error('preferred_foot') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="club_id" class="form-label">Club:</label>
                            <select class="form-control" id="club_id" wire:model="club_id" required>
                                <option value="">Select club</option>
                                @foreach(\App\Models\Club::all() as $club)
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endforeach
                            </select>
                            @error('club_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image:</label>
                            <input type="file" class="form-control" id="image" wire:model="image">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create Player</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Player Modal -->
  

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this player?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const createModal = document.getElementById('createPlayerModal');
        
        createModal.addEventListener('show.bs.modal', function () {
            @this.resetFields(); // Call the reset method when the modal opens
        });
    
        window.addEventListener('close-modal', event => {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                bootstrap.Modal.getInstance(modal).hide();
            });
        });
    });
    </script>
