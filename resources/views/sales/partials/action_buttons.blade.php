<a class="btn btn-sm btn-primary" href="{{route('sale.show', $sale->id)}}"><i data-feather="eye"></i></a>
<a class="btn btn-sm btn-secondary"  data-sale-id="{{ $sale->id }}" href="{{route('sale.edit', $sale->id)}}"><i data-feather="edit"></i></a>
<form action="{{ route('sale.destroy', ['sale' => $sale->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>
    {{-- <a class="btn btn-sm btn-danger" type="submit" href="#"><i data-feather="trash"></i></a> --}}
</form>