<x-layout.dashboard>
    <div class="file">
        <div class="file__header">
            <div class="file__header__container">
                <a class="header__back" href="{{ route('dashboard.carrier.index') }}"><i class="fas fa-arrow-left"></i></a>
                <div class="header__content">
                    <div class="content__left">
                        @livewire('dashboard.carrier.edit.company', ['carrier' => $carrier], key($carrier->id))
                        <div class="content__work">
                            <h5 class="content__work__title">Work:</h5>
                            @livewire('dashboard.carrier.edit.job', ['carrier' => $carrier], key($carrier->id))
                        </div>
                    </div>
                    <div class="content__right">
                        @livewire('dashboard.carrier-cover', ['carrier' => $carrier], key($carrier->id))
                    </div>
                </div>
            </div>
        </div>
        <div class="file__content">
            <div class="content__container">
                <div class="content__add">
                    @livewire('dashboard.portfolio.create', compact('carrier'))
                </div>
                <div class="content__list">
                    @foreach ($carrier->portfolios as $portfolio)
                        <div class="content__item">
                            <div class="content__cover">
                                {!! embed_by_path_type_with_wrapper($portfolio->path, $portfolio->isLink) !!}
                                <div class="content__info">
                                    {!! icon_by_path_type($portfolio->path, $portfolio->isLink) !!}
                                    <small class="date">{{ $portfolio->created_at->format('d M Y') }}</small>
                                </div>
                            </div>
                            <hr class="content__separator">
                            <div class="content__action">
                                @livewire('dashboard.portfolio.favorite', ['portfolio' => $portfolio, 'carrier' => $carrier], key('favorite-' . $portfolio->id))
                                @php
                                    $isExternal = Str::contains($portfolio->path, ['tiktok.com', 'instagram.com', 'youtube.com', 'youtu.be']);
                                @endphp
                                @if ($isExternal)
                                    <a href="{{ $portfolio->path }}" target="_blank"><i class="action__icon fas fa-eye"></i></a>
                                @else
                                    <a href="{{ route('download', ['path' => urlencode($portfolio->path)]) }}"><i class="action__icon fas fa-download"></i></a>
                                @endif
                                @php
                                    $linkToCopy = $isExternal ? $portfolio->path : route('download', ['path' => urlencode($portfolio->path)]);
                                @endphp
                                <div x-data="{ copied: false, copy() { const t = document.createElement('textarea'); t.value = `{{ $linkToCopy }}`; document.body.appendChild(t); t.select(); document.execCommand('copy'); document.body.removeChild(t); this.copied = true; setTimeout(() => this.copied = false, 4000); } }">
                                    <a href="#" @click.prevent="copy" title="Copy link"><i class="action__icon fas fa-link"></i></a>
                                    <div class="alert" x-show="copied" x-transition.duration.800ms x-transition.origin.top x-cloak>
                                        <div class="alert__container">
                                            <i class="fas fa-check-circle"></i>
                                            <small>Success Copy</small>
                                        </div>
                                    </div>
                                </div>
                                @livewire('dashboard.portfolio.delete', ['portfolio' => $portfolio, 'carrier' => $carrier], key($portfolio->id))
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout.dashboard>