<div class="dropdown theme-form-select">
    <button class="btn dropdown-toggle" type="button" id="select-language" data-bs-toggle="dropdown" aria-expanded="false">
        @php
            $locale = $languages->where('code', App::getLocale())->first();
        @endphp
        @if ($locale)
            <img src="{{ $locale->icon }}" class="img-fluid blur-up lazyloaded" alt="icon langauge">
            <span>{{ $locale->name }}</span>
        @endif
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">

        @forelse ($languages as $lang)
            <li class="w-100">
                <a class="dropdown-item" href="{{route('lang.switch', $lang->code)}}" id="english">
                    <img src="{{$lang->icon}}" class="img-fluid blur-up lazyloaded"
                        alt="icon langauge">
                    <span>{{$lang->name}}</span>
                </a>
            </li>
        @empty
        @endforelse
    </ul>
</div>
