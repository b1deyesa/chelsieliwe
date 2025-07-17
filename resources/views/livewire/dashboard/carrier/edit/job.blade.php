<ul class="content__work__list">
    @foreach ($jobs as $index => $job)
        <li wire:key="job-{{ $index }} }}" x-data x-init="$nextTick(() => autoResize($refs.ta))">
            <textarea
                wire:ignore
                x-ref="ta"
                class="input__edit"
                x-init="
                    $refs.ta.value = @js($job);
                    autoResize($refs.ta);
                    if ({{ $nextFocusIndex ?? 'null' }} === {{ $index }}) {
                        $refs.ta.focus();
                    }
                "
                x-on:input="
                    autoResize($refs.ta);
                    $wire.set('jobs.{{ $index }}', $refs.ta.value);
                "
                x-on:keydown.enter.prevent=""
                x-on:keydown.tab.prevent="
                    const next = document.querySelectorAll('.input__edit')[{{ $index + 1 }}];
                    if (next) next.focus();
                "
                x-on:keydown.shift.tab.prevent="
                    const prev = document.querySelectorAll('.input__edit')[{{ $index - 1 }}];
                    if (prev) prev.focus();
                "
                rows="1"
                placeholder="List your job"
                spellcheck="false"
            ></textarea>
        </li>
    @endforeach
</ul>
