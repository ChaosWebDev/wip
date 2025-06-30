<main id="weather">
    <div class="buttons">
        <button id='forecastButton' type='button' class="btn primary">Forecast</button>
        <button id='alertsButton' type="button" class="btn danger">Alerts</button>

    </div>

    @switch($page)
        @case('forecast')
            <x-weather.forecast :forecast="$forecast" />
        @break

        @case('alerts')
            <x-weather.alerts :alerts="$alerts" />
        @break
    @endswitch
</main>

@script
    <script type='module'>
        document.querySelector("#alertsButton").addEventListener('click', function(e) {
            $wire.set('page', 'alerts');
            $wire.dispatch('alerts');
        });

        document.querySelector("#forecastButton").addEventListener('click', function(e) {
            $wire.set('page', 'forecast');
            $wire.dispatch('forecast');
        });
    </script>
@endscript
