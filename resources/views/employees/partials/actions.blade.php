<div class="d-flex align-items-center">
    <a class="btn btn-sm btn-primary py-0 me-1" href="{{ route('employees.edit', ['employee' => $employee]) }}">{{ __("Edit") }}</a>
    <a data-confirm="Are you sure want to delete?" data-method="DELETE" class="btn btn-sm btn-danger py-0" href="{{ route('employees.destroy', ['employee' => $employee]) }}">{{ __("Delete") }}</a>
</div>