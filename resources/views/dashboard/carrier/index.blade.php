<x-layout.dashboard>
    <div class="folder">
        <div class="folder__container">
            <h1 class="folder__title">Portfolio Folder</h1>
            <div class="folder__add">
                @livewire('dashboard.carrier.create')
            </div>
            <div class="folder__list" x-data="{ openId: null }">
                @foreach ($carriers as $carrier)
                    <div class="folder__item">
                        <div>
                            <i class="action fa-solid fa-ellipsis-vertical" @click="openId === {{ $carrier->id }} ? openId = null : openId = {{ $carrier->id }}"></i>
                            <div x-show="openId === {{ $carrier->id }}" x-cloak class="action__container" @click.outside="openId = null" x-transition>
                                @livewire('dashboard.carrier.update', ['carrier' => $carrier], key('update-' . $carrier->id))
                                @livewire('dashboard.carrier.delete', ['carrier' => $carrier], key('delete-' . $carrier->id))
                            </div>
                        </div>
                        <a href="{{ route('dashboard.portfolio.index', compact('carrier')) }}">
                            <img src="{{ asset('assets/img/folder.png') }}" alt="">
                        </a>
                        <small>{{ $carrier->company }}</small>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout.dashboard>