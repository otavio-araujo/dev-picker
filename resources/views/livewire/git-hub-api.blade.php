<div class="p-12">
    <div class="mb-3">
        <input class="mb-2 form-control" placeholder="Search query" type="text" wire:model="query">
        <input class="mb-2 form-control" placeholder="Language" type="text" wire:model="language">
        <input class="mb-2 form-control" placeholder="Location" type="text" wire:model="location">
        <input class="mb-2 form-control" placeholder="Minimum Followers" type="number" wire:model="followers">
        <button class="btn btn-primary" wire:click="search">Search</button>
    </div>

    @if ($users)
        <ul class="mt-3 list-group">
            @foreach ($users as $user)
                <li class="border rounded list-group-item">
                    <a href="{{ $user['html_url'] }}" target="_blank">{{ $user['login'] }}</a>
                    <p>Name: {{ $user['name'] ?? 'N/A' }}</p>
                    <p>Location: {{ $user['location'] ?? 'N/A' }}</p>
                    <p>Followers: {{ $user['followers'] }}</p>
                    <p>Public Repos: {{ $user['public_repos'] }}</p>
                </li>
            @endforeach
        </ul>

        <div class="mt-3">
            @if ($page > 1)
                <button class="btn btn-secondary" wire:click="previousPage">Previous</button>
            @endif

            @if (count($users) === $perPage)
                <button class="btn btn-secondary" wire:click="nextPage">Next</button>
            @endif
        </div>
    @else
        <p>No users found.</p>
    @endif
</div>
