<main id="settings">
    <section>
        <h1>Family Members</h1>

        <button class="btn primary" wire:click='create'>Add Family Member</button>

        <section class="cards">
            @foreach ($members as $member)
                <div class="card" wire:click="edit({{ $member->id }})">
                    <div class="title">Name</div>
                    <div class="value">{{ $member->name }}</div>

                    <div class="title">Date of Birth</div>
                    <div class="value">{{ \Carbon\Carbon::parse($member->dob)->format('m/d/Y') }}</div>

                    <div class="title">Sex</div>
                    <div class="value">{{ $member->sex }}</div>
                </div>
            @endforeach
        </section>
    </section>

    <section>
        <h1>Personalization</h1>
        <h3 style='color:var(--danger) !important;'>Nothing to Personalize at this time</h3>
    </section>

    @if ($showModal)
        <x-modals.settings.family.create />
    @endif
</main>
