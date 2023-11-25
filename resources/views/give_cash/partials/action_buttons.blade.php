<a class="btn btn-sm btn-primary" href="{{route('give_cash.show', $give_cash->id)}}"><i data-feather="eye"></i></a>
<a class="btn btn-sm btn-secondary"  data-give_cash-id="{{ $give_cash->id }}" href="{{route('give_cash.edit', $give_cash->id)}}"><i data-feather="edit"></i></a>
<form action="{{ route('give_cash.destroy', ['give_cash' => $give_cash->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>
</form>