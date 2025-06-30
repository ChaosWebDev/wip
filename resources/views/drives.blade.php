<main id="drives">
    @if ($showForm)
        <x-modals.drive :legend="$legend" />
    @endif
    <table class='left'>
        <thead>
            <tr>
                <th colspan='99' class='header'>
                    {{ $driver->name }}'s Driving Tracker
                </th>
            </tr>
            <tr>
                <td colspan='99' class='center'>
                    <button class="btn primary" wire:click='create'>Add Drive</button>
                </td>
            </tr>
            <tr>
                <th>Date</th>
                <th>Minutes</th>
                <th>TOD</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($drives as $drive)
                <tr wire:click='edit({{ $drive->id }})' class='clickable'>
                    <td>{{ Carbon\Carbon::parse($drive->date)->format('d F Y') }}</td>
                    <td>{{ $drive->minutes }}</td>
                    <td class='text-center'>{{ ucfirst($drive->slot) }}</td>
                    <td>{{ $drive->notes ?? null }}</td>
                </tr>
            @empty
                <tr>
                    <th colspan='99'>No Drives Listed</th>
                </tr>
            @endforelse
        </tbody>
    </table>

    <section class="right">
        <h2>Requirements</h2>
        <div>
            <span class="title">Total Day Hours</span>
            <span>40</span>
        </div>
        <div>
            <span class="title">Total Night Hours</span>
            <span>10</span>
        </div>

        <h2>Completed Stats</h2>
        <div>
            <span class='title'>Total Minutes</span>
            <span>{{ array_sum($drives->pluck('minutes')->toArray()) }}</span>
        </div>
        <div>
            <span class="title">Day Hours</span>
            <span>{{ number_format($driver->totalDayHours, 2) }}</span>
            <span class='header'>
                ({{ number_format(($driver->totalDayHours / 40) * 100, 2) }}%)
            </span>
        </div>
        <div>
            <span class="title">Night Hours</span>
            <span>{{ number_format($driver->totalNightHours, 2) }}</span>
            <span class='header'>
                ({{ number_format(($driver->totalNightHours / 10) * 100, 2) }}%)
            </span>
        </div>

    </section>
</main>
