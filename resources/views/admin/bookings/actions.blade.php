
<div class="btn-group" role="group" aria-label="Action Buttons">
    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-success">
        <i class="bi bi-eye"></i> Show
    </a>
    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-info">
        <i class="bi bi-pencil"></i> Edit
    </a>
    <form onclick="return confirm('Are you sure you want to delete this booking?');" class="d-inline-block" action="{{ route('admin.bookings.destroy', $booking->id) }}" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="bi bi-trash"></i> Delete
        </button>
    </form>
</div>
