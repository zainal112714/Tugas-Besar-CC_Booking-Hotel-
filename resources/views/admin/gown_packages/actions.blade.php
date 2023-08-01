<div class="btn-group" role="group" aria-label="Action Buttons">
    <a href="{{ route('admin.gown_packages.edit', [$gownPackage]) }}" class="btn btn-sm btn-info">
        <i class="fa fa-edit"></i> Edit
    </a>
    <form onclick="return confirm('Are you sure you want to delete this gown package?');" class="d-inline-block" action="{{ route('admin.gown_packages.destroy', [$gownPackage]) }}" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></i> Delete
        </button>
    </form>
</div>
