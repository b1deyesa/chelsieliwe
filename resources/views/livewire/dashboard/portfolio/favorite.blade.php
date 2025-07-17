<div x-data="{ favorite: @entangle('isFavorite') }">
    <template x-if="favorite">
        <i class="action__icon fas fa-star" style="color: rgb(230, 167, 42);"
           @click="favorite = false; $wire.update(false)">
        </i>
    </template>
    <template x-if="!favorite">
        <i class="action__icon far fa-star" style="color: rgb(230, 167, 42);"
           @click="favorite = true; $wire.update(true)">
        </i>
    </template>
</div>