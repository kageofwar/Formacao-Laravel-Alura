<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2" >Adicionar</a>
 
    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between aling-items-center">
            
            <div class="d-flex align-items-center">
                <img class="me-3" src="{{ asset('storage/' . $serie->cover) }}" class="img-thumbnail" width="100px">
                @auth <a href="{{ route('seasons.index', $serie->id) }}"> @endauth
                        {{ $serie->nome }}
                @auth </a> @endauth
            </div>
            
            <span class="d-flex">
                @auth
                <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                    E
                </a>
                @endauth
                
                <form action="{{ route('series.destroy', $serie->id) }}" method="POST" class="ms-2">
                    @csrf
                    @method('DELETE')
                        @auth
                            <button class="btn btn-danger btn-sm">
                                X    
                            </button>
                        @endauth
                </form>
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>