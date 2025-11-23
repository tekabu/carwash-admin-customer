@extends('base.base')

@section('header_title', 'Transactions')

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table dt datatable-basic dataTable">
            <thead>
                <tr>
                    <th class="customer">Customer</th>
                    <th class="vehicle_type">Vehicle Type</th>
                    <th class="package_type">Package Type</th>
                    <th class="is_guest">Guest</th>
                    <th class="created_at">Created At</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/vendor/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/vendor/tables/datatables/extensions/buttons.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/2.1.3/sorting/datetime-moment.js"></script>

<script type="text/javascript">
    $(function() {
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            dom: '<"datatable-header justify-content-start"f<"ms-sm-auto"l>><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
        });

        $.fn.dataTable.moment('MMM. D, YYYY');

        var tableData = {!! $table->toJson() !!};

        // Process data to add customer name and guest badge
        var processedData = tableData.map(function(row) {
            return {
                customer: row.is_guest ? '<span class="badge bg-secondary">Guest</span>' : (row.customer ? row.customer.name : 'N/A'),
                vehicle_type: row.vehicle_type ? row.vehicle_type.vehicle_type : 'N/A',
                package_type: row.package_type ? row.package_type.package_type : 'N/A',
                is_guest: row.is_guest ? '<span class="badge bg-warning">Yes</span>' : '<span class="badge bg-success">No</span>',
                created_at: row.created_at
            };
        });

        $('.dt').DataTable({
            data: processedData,
            columns: [
                { data: 'customer' },
                { data: 'vehicle_type' },
                { data: 'package_type' },
                { data: 'is_guest' },
                { data: 'created_at' }
            ],
            columnDefs: [
                { targets: ['is_guest'], className: 'text-center' },
            ]
        });
    });
</script>
@endsection
