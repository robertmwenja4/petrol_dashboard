<a class="btn btn-sm btn-primary" href="{{route('customer.show', $customer->id)}}"><i data-feather="eye"></i></a>
<a class="btn btn-sm btn-secondary"  data-customer-id="{{ $customer->id }}" href="{{route('customer.edit', $customer->id)}}"><i data-feather="edit"></i></a>
<form action="{{ route('customer.destroy', ['customer' => $customer->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>
    {{-- <a class="btn btn-sm btn-danger" type="submit" href="#"><i data-feather="trash"></i></a> --}}
</form>
{{-- <a class="dropdown-item add-misc" href="javascript:"><i class="fa fa-plus"></i> Edit</a> --}}