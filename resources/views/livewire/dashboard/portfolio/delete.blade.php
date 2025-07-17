<div x-data="{ open: false }">
    <i class="action__icon fas fa-trash" x-on:click="open = true" style="color: #d21e1e"></i>
    <div class="modal" x-show="open" x-transition.opacity x-cloak>
        <div class="modal__container">
            <form wire:submit="destroy()">
                <p>Delete this portfolio?</p>
                <div class="buttons">
                    <button class="btn btn-outline" type="button" x-on:click="open = false">Cancel</button>
                    <button class="btn" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
