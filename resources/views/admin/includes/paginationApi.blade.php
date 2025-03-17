<nav class="mt-3">
    <ul class="pagination justify-content-end">
        {{-- Botón "Anterior" --}}
        <li class="page-item {{ $data->meta->links[0]->url ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $data->meta->links[0]->url }}">Anterior</a>
        </li>

        {{-- Lógica para mostrar solo 6 números de página --}}
        @php
            $start = max(1, $data->meta->current_page - 3);
            $end = min($start + 5, $data->meta->last_page);
            if ($end - $start < 5) {
                $start = max(1, $end - 5);
            }
        @endphp

        @if ($start > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $data->meta->path }}?page={{ 1 }}">1</a>
            </li>
            @if ($start > 2)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
        @endif

        @for ($i = $start; $i <= $end; $i++)
            <li class="page-item {{ $i == $data->meta->current_page ? 'active' : '' }}">
                <a class="page-link" href="{{ $data->meta->path }}?page={{ $i }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($end < $data->meta->last_page)
            @if ($end < $data->meta->last_page - 1)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
            <li class="page-item">
                <a class="page-link" href="{{ $data->meta->path }}?page={{ $data->meta->last_page }} }}">{{ $data->meta->last_page }}</a>
            </li>
        @endif

        {{-- Botón "Siguiente" --}}
        <li class="page-item {{ $data->meta->current_page != $certificates->meta->last_page ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $data->links->last }}">Siguiente</a>
        </li>
    </ul>
</nav>