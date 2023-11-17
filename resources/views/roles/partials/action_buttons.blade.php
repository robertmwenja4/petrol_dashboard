<a class="btn btn-sm btn-primary" href="{{route('role.show', $role->id)}}"><i data-feather="eye"></i></a>
<a class="btn btn-sm btn-secondary btnEdit" data-toggle="modal" data-target="#editModal" data-role-id="{{ $role->id }}" href="javascript:"><i data-feather="edit"></i></a>
<form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>
    {{-- <a class="btn btn-sm btn-danger" type="submit" href="#"><i data-feather="trash"></i></a> --}}
</form>
{{-- <a class="dropdown-item add-misc" href="javascript:"><i class="fa fa-plus"></i> Edit</a> --}}