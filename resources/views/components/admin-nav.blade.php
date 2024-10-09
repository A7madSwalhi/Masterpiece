


			{{-- <ul class="metismenu" id="menu">

                @foreach ($items as $item )
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon">
                                <i class='{{ $item["main_icon"] }}'></i>
                            </div>
                            <div class="menu-title">{{ $item["main_name"] }}</div>
                        </a>
                        <ul>
                            @foreach ($item['sub_routes'] as $subitem )
                                <li>
                                    <a href="{{ route($subitem['route']) }}">
                                        <i class="{{ $subitem['icon'] }}"></i>
                                        {{ $subitem['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @isset($item['breaker'])
                        <li class="menu-label">{{ $item['breaker'] }}</li>
                    @endisset

                @endforeach --}}


<ul class="metismenu" id="menu">
    @foreach ($items as $item)
        @if (!empty($item))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="{{ $item['main_icon'] }}"></i>
                    </div>
                    <div class="menu-title">{{ $item['main_name'] }}</div>
                </a>
                <ul>
                    @foreach ($item['sub_routes'] as $subitem)
                        <li>
                            <a href="{{ route($subitem['route']) }}">
                                <i class="{{ $subitem['icon'] }}"></i>
                                {{ $subitem['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            @isset($item['breaker'])
                <li class="menu-label">{{ $item['breaker'] }}</li>
            @endisset
        @endif
    @endforeach


