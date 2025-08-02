@component('mail::message')
# New Quote Request

{{ $slot }}

@component('mail::table')
{!! $tableContent !!}
@endcomponent

## Customer Details:
**Name:** {{ $quoteRequest->name }}
**Email:** {{ $quoteRequest->email }}
@if($quoteRequest->phone)
**Phone:** {{ $quoteRequest->phone }}
@endif

@if($quoteRequest->message)
## Customer Message:
{{ $quoteRequest->message }}
@endif

@component('mail::button', ['url' => $url, 'color' => 'success'])
View Quote Request
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
