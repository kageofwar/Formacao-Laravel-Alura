<x-layout title="Episodios" :mensagem-sucesso="$mensagemSucesso">

    <form action="" method="post">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
            <li class="list-group-item d-flex justify-content-between aling-items-center">
                Episódio {{ $episode->number }}

                <input type="checkbox" 
                name="episodes[]" 
                value="{{ $episode->id }}"
                @if ($episode->watched) checked @endif>
            </li>
            @endforeach
        </ul>

        <button class="btn btn-primary mt-2 mb-2 btn-warning">Salvar</button>
    </form>
</x-layout>