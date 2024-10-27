<div>
    <div class="card shadow-sm">
        <!-- Header Section -->
        <div class="card-header bg-white py-3">
            <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
                <h3 class="mb-0 h4">Mental Skills</h3>
                
                <div class="d-flex flex-wrap gap-2">
                    <!-- Import/Export Controls -->
                    <div class="btn-group">
                        <label class="btn btn-outline-primary btn-sm {{ $file ? 'active' : '' }}">
                            <i class="fas fa-file-excel me-1"></i>Select Excel
                            <input type="file" 
                                   wire:model="file" 
                                   accept=".xlsx,.xls"
                                   class="d-none">
                        </label>
                        
                        <button wire:click="importFromExcel" 
                                class="btn btn-primary btn-sm {{ !$file ? 'disabled' : '' }}"
                                @if(!$file) disabled @endif>
                            <span wire:loading.remove wire:target="importFromExcel">
                                <i class="fas fa-upload me-1"></i>Import
                            </span>
                            <span wire:loading wire:target="importFromExcel">
                                <span class="spinner-border spinner-border-sm me-1"></span>
                                Importing...
                            </span>
                        </button>
                        
                        <button wire:click="exportToExcel" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-download me-1"></i>Export
                        </button>
                    </div>

                    <!-- Search & Filters -->
                    <div class="d-flex gap-2 flex-grow-1">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" 
                                   wire:model.live.debounce.300ms="search" 
                                   class="form-control form-control-sm" 
                                   placeholder="Search players...">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        <div class="position-relative">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show m-3 mb-0" role="alert">
                    <i class="fas fa-check-circle me-1"></i>
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show m-3 mb-0" role="alert">
                    <i class="fas fa-exclamation-circle me-1"></i>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        <!-- Table Section -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="position-sticky start-0 bg-white border-end" style="min-width: 200px; z-index: 2;">
                            Player
                        </th>
                        <th class="text-center bg-white" style="min-width: 80px;">Leadership</th>
                        <th class="text-center bg-white" style="min-width: 80px;">Temperament</th>
                        <th class="text-center bg-white" style="min-width: 80px;">Error Handling</th>
                        <th class="text-center bg-white" style="min-width: 80px;">Determination</th>
                        <th class="text-center bg-white" style="min-width: 80px;">Teamwork</th>
                        <th class="text-center bg-white" style="min-width: 80px;">Decision Making</th>
                        <th class="text-center bg-white" style="min-width: 80px;">Concentration</th>
                        <th class="text-center bg-white" style="min-width: 80px;">Charisma</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($players as $player)
                        <tr>
                            <td class="position-sticky start-0 bg-white border-end" style="z-index: 1;">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="fw-medium">{{ $player->name }}</div>
                                        <small class="text-muted">{{ $player->position }} · {{ $player->club->name }}</small>
                                    </div>
                                </div>
                            </td>
                            @foreach($fields as $field => $label)
                                <td class="text-center">
                                    @if($editingPlayerId === $player->id && $editingField === $field)
                                        <input type="number" 
                                               wire:model.defer="editingValue" 
                                               class="form-control form-control-sm"
                                               min="0" max="100" required>
                                        <button wire:click="saveValue" 
                                                class="btn btn-sm btn-success">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <button wire:click="stopEditing" 
                                                class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @else
                                        <span>{{ $mentals[$player->id]->$field ?? 0 }}</span>
                                        <button wire:click="startEditing({{ $player->id }}, '{{ $field }}')" 
                                                class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($fields) + 1 }}" class="text-center">No mental skills data available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center p-3">
            <div>
                Showing {{ $players->firstItem() }} to {{ $players->lastItem() }} of {{ $players->total() }} entries
            </div>
            <div>
                {{ $players->links() }}
            </div>
        </div>
    </div>
</div>
