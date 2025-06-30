<modal onclick='if (event.target === this) toggleModal()'>
    <window>
        <form wire:submit.prevent='save'>
            <fieldset>
                <x-form.text name='name' tabindex="1" />
                <x-form.date name='dob' label="Date of Birth" tabindex="2" />

                <label for="sex">Sex</label>
                <select wire:model='sex' name="sex" id="sex" required tabindex="3">
                    <option value="">-- Select their sex --</option>

                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                @error('sex')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="buttons">
                    <button class="btn secondary" type='button' onclick='toggleModal()'>Cancel</button>
                    <button class="btn primary" type='submit'>Save</button>
                </div>

            </fieldset>
        </form>

        <note>Hit Escape to cancel</note>
    </window>
</modal>

@script
    <script>
        window.toggleModal = () => {
            Livewire.dispatch('toggleModal');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                toggleModal();
            }
        });
    </script>
@endscript
