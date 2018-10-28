@php
    if (isset($kycUser)){
    $kyc = $kycUser->getOCProfile();

    } else {
    $kyc = request()->user()->getOCProfile();
    }


@endphp

<div class="container">
    <div class="row">
        <ul>
            @foreach($kyc as $k => $v)
                {{--{{dd($k,$v)}}--}}
                @if(!is_array($v))

                    <li>{!! $k . '='. $v !!} </li>
                @else
                    <ul>
                        @foreach($v as $kk => $vv)
                            @if(!is_array($vv))

                                <li>{!! $kk . '='. $vv !!} </li>
                            @endif


                        @endforeach
                    </ul>
                @endif
            @endforeach
        </ul>
    </div>
</div>
