@component('mail::message')
# Alerta de Vencimento
A licença **{{ $license->number }}** do projeto **{{ $license->project->name }}** expira em **{{ $license->expires_at->format('d/m/Y') }}**.

@component('mail::button', ['url' => url('/projects/'.$license->project->id)])
Ver projeto
@endcomponent

Obrigado,
Equipe de Licenciamento
@endcomponent