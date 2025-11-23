@extends('base.base')

@section('header_title', 'Sales Report')

@section('content')
<div class="card">
    <div class="card-header border-bottom-0 pb-0">
        <div class="row g-3 align-items-end">
            <div class="col-sm-6 col-md-3">
                <label for="filter-customer" class="form-label">Customer</label>
                <select id="filter-customer" class="form-select form-select-sm">
                    <option value="">All</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <label for="filter-vehicle" class="form-label">Vehicle Type</label>
                <select id="filter-vehicle" class="form-select form-select-sm">
                    <option value="">All</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <label for="filter-package" class="form-label">Package Type</label>
                <select id="filter-package" class="form-select form-select-sm">
                    <option value="">All</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <label class="form-label">Created Date</label>
                <div class="d-flex gap-2">
                    <input type="date" id="filter-date-from" class="form-control form-control-sm" placeholder="From">
                    <input type="date" id="filter-date-to" class="form-control form-control-sm" placeholder="To">
                </div>
            </div>
        </div>
    </div>
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
<script src="{{ asset('js/vendor/tables/datatables/extensions/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vendor/tables/datatables/extensions/pdfmake/vfs_fonts.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/2.1.3/sorting/datetime-moment.js"></script>

<script type="text/javascript">
    $(function() {
        const dateFormat = 'MMM. D, YYYY';

        function escapeRegex(value) {
            return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }

        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            dom: '<"datatable-header justify-content-start"f<"ms-sm-auto"l><"ms-sm-3"B>><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
        });

        $.fn.dataTable.moment('MMM. D, YYYY');

        var tableData = {!! $table->toJson() !!};

        // Process data to add display values and raw fields for filtering
        var processedData = tableData.map(function(row) {
            var customerName = row.is_guest ? 'Guest' : (row.customer ? row.customer.name : 'N/A');
            var vehicleType = row.vehicle_type ? row.vehicle_type.vehicle_type : 'N/A';
            var packageType = row.package_type ? row.package_type.package_type : 'N/A';

            return {
                customer_name: customerName,
                customer_display: row.is_guest ? '<span class="badge bg-secondary">Guest</span>' : customerName,
                vehicle_type: vehicleType,
                package_type: packageType,
                is_guest_badge: row.is_guest ? '<span class="badge bg-warning">Yes</span>' : '<span class="badge bg-success">No</span>',
                created_at: row.created_at
            };
        });

        function populateFilter(selector, values) {
            var select = $(selector);
            select.find('option:not(:first)').remove();

            values.sort().forEach(function(value) {
                if (!value) {
                    return;
                }
                select.append('<option value="' + value + '">' + value + '</option>');
            });
        }

        populateFilter('#filter-customer', Array.from(new Set(processedData.map(function(row) { return row.customer_name; }))));
        populateFilter('#filter-vehicle', Array.from(new Set(processedData.map(function(row) { return row.vehicle_type; }))));
        populateFilter('#filter-package', Array.from(new Set(processedData.map(function(row) { return row.package_type; }))));

        var table;

        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            if (!table || settings.nTable !== table.table().node()) {
                return true;
            }

            var rowData = table.row(dataIndex).data();
            var from = $('#filter-date-from').val();
            var to = $('#filter-date-to').val();
            var createdMoment = moment(rowData.created_at, dateFormat, true);

            if (!createdMoment.isValid()) {
                createdMoment = moment(rowData.created_at);
            }

            if (from) {
                var fromMoment = moment(from, 'YYYY-MM-DD');
                if (createdMoment.isBefore(fromMoment, 'day')) {
                    return false;
                }
            }

            if (to) {
                var toMoment = moment(to, 'YYYY-MM-DD');
                if (createdMoment.isAfter(toMoment, 'day')) {
                    return false;
                }
            }

            return true;
        });

        table = $('.dt').DataTable({
            data: processedData,
            columns: [
                {
                    data: 'customer_name',
                    name: 'customer',
                    render: function(data, type, row) {
                        return row.customer_display;
                    }
                },
                {
                    data: 'vehicle_type',
                    name: 'vehicle_type'
                },
                {
                    data: 'package_type',
                    name: 'package_type'
                },
                {
                    data: 'is_guest_badge',
                    name: 'is_guest',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                }
            ],
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-light'
                    }
                },
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="ph-file-xls"></i> Excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        text: '<i class="ph-file-text"></i> CSV',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="ph-file-pdf"></i> PDF',
                        exportOptions: {
                            columns: ':visible'
                        },
                        orientation: 'landscape',
                        pageSize: 'A4'
                    }
                ]
            }
        });

        $('#filter-customer').on('change', function() {
            var value = $(this).val();
            table.column('customer:name').search(value ? '^' + escapeRegex(value) + '$' : '', true, false).draw();
        });

        $('#filter-vehicle').on('change', function() {
            var value = $(this).val();
            table.column('vehicle_type:name').search(value ? '^' + escapeRegex(value) + '$' : '', true, false).draw();
        });

        $('#filter-package').on('change', function() {
            var value = $(this).val();
            table.column('package_type:name').search(value ? '^' + escapeRegex(value) + '$' : '', true, false).draw();
        });

        $('#filter-date-from, #filter-date-to').on('change', function() {
            table.draw();
        });
    });
</script>
@endsection
