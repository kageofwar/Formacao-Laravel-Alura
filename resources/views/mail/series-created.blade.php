@component('mail::message')

# Uma Nova série foi adicionada!

A série {{ $nomeSerie }} com {{ $qtdTemporadas }} Temporadas e {{ $episodiosPorTemporada }} e {{ $episodiosPorTemporada }} episodios por temporada.

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $idSerie )]);
    Ver série
@endcomponent

@endcomponent
