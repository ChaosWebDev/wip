<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use App\Services\WeatherService;

#[Title('Billings Weather')]
class Weather extends Component
{
    public $forecast = [];
    public $days = 5;
    public $page;
    public $alerts;

    public function mount()
    {
        $this->forecast();
    }

    #[On('alerts')]
    public function alerts()
    {
        $this->page = 'alerts';

        $weather = new WeatherService();
        $this->alerts = $weather->alerts() ?? [];

        foreach ($this->alerts as &$alert) {
            $alert['properties']['description'] = $this->highlightTerms($alert['properties']['description']);
        }
    }

    #[On('forecast')]
    public function forecast()
    {
        $this->page = "forecast";
        $weather = new WeatherService();
        $forecast = $weather->forecast() ?? [];
        $this->forecast = collect($forecast)->groupBy(fn($period) => Carbon::parse($period['startTime'])->toDateString())->toArray();

        $this->forecast = array_slice($this->forecast, 0, $this->days);
    }

    public function render()
    {
        return view('weather');
    }

    public function highlightTerms($text, $terms = ['Yellowstone', 'Billings'])
    {
        foreach ($terms as $term) {
            $text = preg_replace(
                "/\b(" . preg_quote($term, '/') . ")\b/i",
                '<span class="highlight">$1</span>',
                $text
            );
        }
        return $text;
    }
}
