<div x-data="{ open: false }">
    <span x-on:click="open = true">Edit</span>
    <div class="modal" x-show="open" x-cloak>
        <div class="modal__container">
            <form wire:submit="update()">
                <div class="row">
                    <label>
                        Folder Name
                        <input type="text" wire:model="company">
                        <small>institution, company, etc.</small>
                    </label>
                </div>
                {{-- <textarea placeholder="Description your work" wire:model="job" rows="5"></textarea> --}}
                <div class="buttons">
                    <button class="btn btn-outline" type="button" x-on:click="open = false">Cancel</button>
                    <button class="btn" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>