@component('mail::message')
# Olá {{$contact->name}}

{{$contact->return}}

Atenciosamente,
<br>
<br>
{{ env('DT_NAME') }}
<br>
{{ env('DT_PHONE') }}
<br>
<br>
_____________________________________________________________________________________________
Em {{$contact->created_at}}, {{$contact->name}} escreveu:<br>
Ticket:#{{$contact->id}}
_____________________________________________________________________________________________
{{$contact->message}}
@endcomponent
