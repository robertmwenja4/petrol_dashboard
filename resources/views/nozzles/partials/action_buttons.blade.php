<a class="btn btn-sm btn-primary" href="{{route('nozzle.show', $nozzle->id)}}"><i data-feather="eye"></i></a>
<button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$nozzle->id}}">
    <i data-feather="edit"></i>
  </button>
{{-- <a class="btn btn-sm btn-secondary btnEdit" data-toggle="modal" data-target="#editModal" data-nozzle-id="{{ $nozzle->id }}" href="javascript:"><i data-feather="edit"></i></a> --}}
<form action="{{ route('nozzle.destroy', ['nozzle' => $nozzle->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>
    {{-- <a class="btn btn-sm btn-danger" type="submit" href="#"><i data-feather="trash"></i></a> --}}
</form>
{{-- <a class="dropdown-item add-misc" href="javascript:"><i class="fa fa-plus"></i> Edit</a> --}}