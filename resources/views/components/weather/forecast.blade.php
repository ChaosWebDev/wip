@props(['forecast'])

<section id="forecastData">
    @forelse($forecast as $date => $periods)
        <div class="day-group">
            @if ($loop->first)
                <h2>Today</h2>
            @elseif ($loop->iteration === 2)
                <h2>Tomorrow</h2>
            @else
                <h2>{{ \Carbon\Carbon::parse($date)->format('l, F j') }}</h2>
            @endif
            @foreach ($periods as $period)
                <div class="card">
                    <h2 class='accent'>
                        {{ $period['name'] }} ({{ $period['temperature'] }}°{{ $period['temperatureUnit'] }})
                    </h2>
                    <h3>{{ $period['shortForecast'] }}</h3>

                    @if (isset($period['probabilityOfPrecipitation']['value']))
                        <div class="precep">
                            Prob Rain: {{ $period['probabilityOfPrecipitation']['value'] }}%
                        </div>
                    @endif

                    <div class="wind">{{ $period['windSpeed'] }} <i class="nf nf-cod-arrow_right"></i>
                        {{ $period['windDirection'] }}</div>
                    <div class="detailedForecast">
                        {{ $period['detailedForecast'] }}
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="card">No Data</div>
    @endforelse
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let openDetail = null;

        const cards = document.querySelectorAll('.card');

        cards.forEach(function(card) {
            card.addEventListener('click', function(e) {
                e.stopPropagation();

                const detail = card.querySelector('.detailedForecast');

                if (openDetail && openDetail !== detail) {
                    openDetail.classList.remove('active');
                }

                if (detail.classList.contains('active')) {
                    detail.classList.remove('active');
                    openDetail = null;
                } else {
                    detail.classList.add('active');
                    openDetail = detail;
                }
            });
        });

        document.querySelector("body")?.addEventListener('click', function() {
            document.querySelectorAll('.detailedForecast').forEach(function(detail) {
                detail.classList.remove('active');
            });
            openDetail = null;
        });
    });
</script>
