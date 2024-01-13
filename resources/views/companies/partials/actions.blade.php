<div class="d-flex align-items-center">
    <a class="btn btn-sm btn-primary py-0 me-1" href="{{ route('companies.edit', ['company' => $company]) }}">{{ __("Edit") }}</a>
    <a data-confirm="Are you sure want to delete?" data-method="DELETE" class="btn btn-sm btn-danger py-0" href="{{ route('companies.destroy', ['company' => $company]) }}">{{ __("Delete") }}</a>
</div>