@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

                @if( $message['level'] == 'success')
                    <i class="fa-fw fa fa-check"></i>
                @endif
                @if( $message['level'] == 'warning')
                    <i class="fa-fw fa fa-warning"></i>
                @endif
                @if( $message['level'] == 'info')
                    <i class="fa-fw fa fa-info-circle"></i>
                @endif
                @if( $message['level'] == 'danger')
                    <i class="fa-fw fa fa-times"></i>
                @endif

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
