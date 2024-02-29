<a class="btn btn-sm btn-primary" href="{{route('shift_type.show', $shift_type->id)}}"><i data-feather="eye"></i></a>
<a class="btn btn-sm btn-secondary"  data-shift_type-id="{{ $shift_type->id }}" href="{{route('shift_type.edit', $shift_type->id)}}"><i data-feather="edit"></i></a>
<form action="{{ route('shift_type.destroy', ['shift_type' => $shift_type->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>
    {{-- <a class="btn btn-sm btn-danger" type="submit" href="#"><i data-feather="trash"></i></a> --}}
</form>
{{-- <a class="dropdown-item add-misc" href="javascript:"><i class="fa fa-plus"></i> Edit</a> --}}