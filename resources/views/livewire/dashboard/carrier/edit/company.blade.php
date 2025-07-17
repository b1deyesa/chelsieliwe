<h3 class="carrier__title" x-data x-init="$nextTick(() => autoResize($refs.ta))">
    <textarea
        wire:ignore
        x-ref="ta"
        class="input__edit"
        x-init="
            $refs.ta.value = @js($company);
            autoResize($refs.ta);
        "
        x-on:input="
            autoResize($refs.ta);
            $wire.set('company', $refs.ta.value);
        "
        x-on:keydown.enter.prevent=""
        rows="1"
        placeholder="Title"
        spellcheck="false"
    ></textarea>
    
    <script>
        function autoResize(el) {
            if (!el) return;
            el.style.height = 'auto';
            el.style.height = el.scrollHeight + 'px';
        }
    
        document.addEventListener('livewire:load', () => {
            Livewire.hook('message.processed', () => {
                document.querySelectorAll('.input__edit').forEach(autoResize);
            });
        });
    </script>
</h3>
