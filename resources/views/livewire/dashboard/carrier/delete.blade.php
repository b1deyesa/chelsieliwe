<div x-data="{ show: false }">
    <span x-on:click="show = true">Delete</span>
    <div class="modal" x-show="show" x-cloak>
        <div class="modal__container">
            <form wire:submit="destroy()">
                <p>Delete this folder?</p>
                <div class="buttons">
                    <button class="btn btn-outline" type="button" x-on:click="show = false">Cancel</button>
                    <button class="btn" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
