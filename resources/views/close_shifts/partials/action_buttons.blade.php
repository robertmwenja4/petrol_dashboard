<a class="btn btn-sm btn-primary" href="{{route('close_shift.show', $close_shift->id)}}"><i data-feather="eye"></i></a>
<a class="btn btn-sm btn-secondary"  data-close_shift-id="{{ $close_shift->id }}" href="{{route('close_shift.edit', $close_shift->id)}}"><i data-feather="edit"></i></a>
<form action="{{ route('close_shift.destroy', ['close_shift' => $close_shift->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>
    {{-- <a class="btn btn-sm btn-danger" type="submit" href="#"><i data-feather="trash"></i></a> --}}
</form>
{{-- <a class="dropdown-item add-misc" href="javascript:"><i class="fa fa-plus"></i> Edit</a> --}}