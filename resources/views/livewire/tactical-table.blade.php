<div>
    <div class="card shadow-sm">
        <!-- Header Section -->
        <div class="card-header bg-white py-3">
            <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
                <h3 class="mb-0 h4">Tactical</h3>
                
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

                        <select wire:model.live="club" class="form-select form-select-sm">
                            <option value="">All Clubs</option>
                            @foreach($players->pluck('club')->unique() as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                        </select>

                        <select wire:model.live="position" class="form-select form-select-sm">
                            <option value="">All Positions</option>
                            @foreach($players->pluck('position')->unique() as $position)
                                <option value="{{ $position }}">{{ $position }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            @if($file)
                <div class="mt-2">
                    <span class="badge bg-light text-dark">
                        <i class="fas fa-file-excel me-1"></i>
                        {{ $file->getClientOriginalName() }}
                    </span>
                </div>
            @endif
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
                        <th class="position-sticky start-0 bg-white border-end" 
                            style="min-width: 200px; z-index: 2;">
                            Player
                        </th>
                        @foreach($fields as $field => $abbr)
                            <th class="text-center bg-white" 
                                style="min-width: 80px;"
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top"
                                title="{{ ucwords(str_replace('_', ' ', $field)) }}">
                                <div class="d-flex flex-column align-items-center tooltip-header">
                                    <span class="tooltip-text">{{ $abbr }}</span>
                                    <i class="bi bi-info-circle text-primary tooltip-indicator"></i>
                                </div>
                            </th>
                        @endforeach
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
                            @foreach($fields as $field => $abbr)
                                <td class="p-0" style="height: 54px;">
                                    @if($editingPlayerId == $player->id && $editingField == $field)
                                        <input type="number"
                                               wire:model.defer="editingValue"
                                               wire:keydown.enter="saveValue"
                                               wire:keydown.escape="stopEditing"
                                               wire:blur="saveValue"
                                               class="form-control border-0 text-center h-100 shadow-none"
                                               min="0"
                                               max="100"
                                               autocomplete="off">
                                    @else
                                        <div wire:click="startEditing({{ $player->id }}, '{{ $field }}')"
                                             class="h-100 d-flex align-items-center justify-content-center editable-cell">
                                            {{ $tacticals[$player->id][$field] ?? 0 }}
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($fields) + 1 }}" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    No players found
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer with Pagination -->
        <div class="card-footer bg-white border-top py-3">
            {{ $players->links() }}
        </div>
    </div>


</div>
