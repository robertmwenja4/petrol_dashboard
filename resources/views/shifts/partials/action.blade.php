{{-- <a class="btn btn-sm btn-primary" href="{{route('shift.show', $shift->id)}}"><i data-feather="eye"></i></a> --}}
<a class="btn btn-sm btn-secondary"  data-shift-id="{{ $shift->id }}" href="{{route('shift.edit', $shift->id)}}"><i data-feather="edit"></i></a>
<form action="{{ route('shift.destroy', ['shift' => $shift->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>
    {{-- <a class="btn btn-sm btn-danger" type="submit" href="#"><i data-feather="trash"></i></a> --}}
</form>
{{-- <a class="dropdown-item add-misc" href="javascript:"><i class="fa fa-plus"></i> Edit</a> --}}