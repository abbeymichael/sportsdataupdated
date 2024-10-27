<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1>{{ $player->name }}</h1>
    <p>Club: {{ $player->club->name }}</p>
    <p>Position: {{ $player->position }}</p>
    <p>Date of Birth: {{ $player->dob }}</p>
    <p>Height: {{ $player->height }} cm</p>
    <p>Weight: {{ $player->weight }} kg</p>
    <p>Preferred Foot: {{ ucfirst($player->preferred_foot) }}</p>

</div>