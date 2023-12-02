<a class="btn btn-sm btn-primary" href="{{route('stock_adjustment.show', $stock_adjustment->id)}}"><i data-feather="eye"></i></a>
<a class="btn btn-sm btn-secondary"  data-stock_adjustment-id="{{ $stock_adjustment->id }}" href="{{route('stock_adjustment.edit', $stock_adjustment->id)}}"><i data-feather="edit"></i></a>
<form action="{{ route('stock_adjustment.destroy', ['stock_adjustment' => $stock_adjustment->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>
    {{-- <a class="btn btn-sm btn-danger" type="submit" href="#"><i data-feather="trash"></i></a> --}}
</form>
{{-- <a class="dropdown-item add-misc" href="javascript:"><i class="fa fa-plus"></i> Edit</a> --}}