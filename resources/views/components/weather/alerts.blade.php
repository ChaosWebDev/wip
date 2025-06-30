@props(['alerts'])

<section id="alertsSection">
    @forelse ($alerts as $alert)
        <div class="card alert-box">
            <h2>{{ $alert['properties']['headline'] }}</h2>
            <p>
                <strong>Event:</strong>
                {{ $alert['properties']['event'] }}
            </p>
            <p class='danger'>
                <strong>Severity:</strong>
                {{ $alert['properties']['severity'] }}
            </p>
            <p>
                <strong>Urgency:</strong>
                {{ $alert['properties']['urgency'] }}
            </p>
            <p>
                <strong>Description:</strong>
                {!! $alert['properties']['description'] !!}
            </p>
            <p>
                <strong>Instructions:</strong>
                {{ $alert['properties']['instruction'] ?? 'None' }}
            </p>
            <p>
                <strong>Effective:</strong>
                {{ \Carbon\Carbon::parse($alert['properties']['effective'])->toDayDateTimeString() }}
            </p>
            <p>
                <strong>Expires:</strong>
                {{ \Carbon\Carbon::parse($alert['properties']['expires'])->toDayDateTimeString() }}
            </p>
        </div>
    @empty
        <div class="card alert-box">
            <h2 class='fv-sc tt-cap'>No Alerts at this time</h2>
        </div>
    @endforelse

</section>

@script
    <script type='module'>
        const interval = {{ env('REFRESH_TIME') }}; // Seconds

        setInterval(() => {
            const now = new Date();
            const timestamp = now.toLocaleString('en-US', {
                month: '2-digit',
                day: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false,
            });

            $wire.dispatch('alerts');
            console.log(`Updated ${timestamp}`);
        }, interval * 1000);
    </script>
@endscript
