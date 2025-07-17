@component('mail::message')
Hello

Attached is the attencande report for **{{$period}}**

@component('mail::button', ['url' => $downloadUrl])
Download Report
@endcomponent

Thanks, <br>
{{config('app.name')}}

@endcomponent