@props(['legend' => null])

<modal>
    <window>
        <form wire:submit.prevent='save'>
            <fieldset>
                @isset($legend)
                    <legend>{{ $legend }}</legend>
                @endisset

                <x-form.date name='date' />
                <x-form.number name='minutes'/>

                <label for="slot">Time of Day</label>
                <select name="slot" id="slot" wire:model='slot'>
                    <option value='day'>Day</option>
                    <option value='night'>Night</option>
                </select>

                <label for="notes" class="col-full text-center header">Notes</label>
                <textarea name="notes" id="notes" wire:model='notes' class='col-full'></textarea>

                <div class="buttons">
                    <button wire:click="cancelForm" type="button" class="btn secondary">Cancel</button>
                    <button class="btn primary">Save</button>
                </div>
            </fieldset>
        </form>
    </window>
</modal>
