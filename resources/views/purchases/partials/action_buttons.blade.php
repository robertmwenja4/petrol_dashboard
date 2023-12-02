<a class="btn btn-sm btn-primary" href="{{route('purchase.show', $purchase->id)}}"><i data-feather="eye"></i></a>
<a class="btn btn-sm btn-secondary"  data-purchase-id="{{ $purchase->id }}" href="{{route('purchase.edit', $purchase->id)}}"><i data-feather="edit"></i></a>
<form action="{{ route('purchase.destroy', ['purchase' => $purchase->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>
    {{-- <a class="btn btn-sm btn-danger" type="submit" href="#"><i data-feather="trash"></i></a> --}}
</form>
{{-- <a class="dropdown-item add-misc" href="javascript:"><i class="fa fa-plus"></i> Edit</a> --}}