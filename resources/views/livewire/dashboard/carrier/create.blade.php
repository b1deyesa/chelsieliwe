<div x-data="{ open: false }">
    <button class="btn" x-on:click="open = true"><i class="fas fa-plus"></i>Add Folder</button>
    <div class="modal" x-show="open" x-transition.opacity x-cloak>
        <div class="modal__container">
            <form wire:submit="store()">
                <div class="row">
                    {{-- <span class="file-container">
                        <img src="{{ asset('assets/img/img.png') }}" class="icon" alt="">
                        <small>Choose Icon</small>
                    </span> --}}
                    <label>
                        Folder Name
                        <input type="text" wire:model="company">
                        <small>institution, company, etc.</small>
                    </label>
                </div>
                {{-- <textarea placeholder="Description your work" wire:model="job" rows="5"></textarea> --}}
                <div class="buttons">
                    <button class="btn btn-outline" type="button" x-on:click="open = false">Cancel</button>
                    <button class="btn" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
