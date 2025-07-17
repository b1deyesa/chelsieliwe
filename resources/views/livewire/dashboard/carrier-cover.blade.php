<div class="thumbnail">
    @foreach ($covers as $id => $cover)    
        <div class="thumbnail__item">
            <input type="file" wire:model.live="file.{{ $id }}">
            <div class="thumbnail__add">
                <small class="add__title">
                    @if ($loop->first)
                        <div class="title__logo">
                            <img src="{{ asset('assets/img/logo-icon.png') }}" alt="">
                            <b>Logo Here</b>
                        </div>
                    @else
                        <b>Add Media</b><br>Ratio 1 x 1
                    @endif
                </small>
            </div>
            @if ($cover)
                <div class="thumbnail__preview">
                    <img src="{{ asset('storage/'. $cover) }}">
                    <div class="thumbnail__action">
                        <i class="fas fa-trash" wire:click="destroy({{ $id }})"></i>
                        <small>tap to change</small>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>