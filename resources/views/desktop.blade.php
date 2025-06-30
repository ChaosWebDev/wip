<main id="desktop">

    <div class="icon" id="medical-icon" data-url="{{ route('medical.index') }}">
        <img src="{{ asset('storage/icons/medical.svg') }}" alt="medical-icon">
        <h3>Medical</h3>
    </div>

    <div class="icon" id="driving-icon" data-url="{{ route('drive.index') }}">
        <img src="{{ asset('storage/icons/driving.svg') }}" alt="drive-icon">
        <h3>Driving</h3>
    </div>

    <div class="icon" id="weather-icon" data-url="{{ route('weather.index') }}">
        <img src="{{ asset('storage/icons/weather.svg') }}" alt="weather-icon">
        <h3>Weather</h3>
    </div>

    <div class="icon" id="school-icon" data-url="{{ route('school.index') }}">
        <img src="{{ asset('storage/icons/school.svg') }}" alt="school-icon">
        <h3>School</h3>
    </div>

    <div class="icon" id="settings-icon" data-url="{{ route('settings') }}">
        <img src="{{ asset('storage/icons/settings.svg') }}" alt="settings-icon">
        <h3>Settings</h3>
    </div>

</main>


@script
    <script type='module'>
        const icons = document.querySelectorAll('.icon');

        icons.forEach(function(el) {
            el.addEventListener('click', function() {
                const url = el.dataset.url;

                window.location.href = url;
            });
        });
    </script>
@endscript
