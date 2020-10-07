<form action="{{ route('admin.destroy', $id) }}" method="POST">
    <a href="{{ route('admin.show', $id) }}">
        <button type="button" class="btn btn-secondary btn-sm"><i class="far fa-eye"></i></button>
    </a>
    <a href="{{ route('admin.edit', $id) }}">
        <button type="button" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></button>
    </a>
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
</form>


