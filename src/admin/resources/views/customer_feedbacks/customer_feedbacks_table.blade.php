@extends('base.base')

@section('header_title', 'Customer Feedbacks')

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table dt datatable-basic dataTable">
            <thead>
                <tr>
                    <th class="name">Name</th>
                    <th class="email">Email</th>
                    <th class="subject">Subject</th>
                    <th class="message">Message</th>
                    <th class="created_at">Received At</th>
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
        function escapeHtml(value) {
            if (value == null) {
                return '';
            }

            return String(value).replace(/[&<>"']/g, function(match) {
                switch (match) {
                    case '&':
                        return '&amp;';
                    case '<':
                        return '&lt;';
                    case '>':
                        return '&gt;';
                    case '"':
                        return '&quot;';
                    case '\'':
                        return '&#39;';
                    default:
                        return match;
                }
            });
        }

        function formatDate(value) {
            if (!value) {
                return '';
            }

            var date = moment(value);

            if (!date.isValid()) {
                return escapeHtml(value);
            }

            return date.format('MMM. D, YYYY h:mm A');
        }

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

        $.fn.dataTable.moment('MMM. D, YYYY h:mm A');

        var tableData = {!! $table->toJson() !!};

        $('.dt').DataTable({
            data: tableData,
            columns: [
                {
                    data: 'name',
                    render: function(data) {
                        return escapeHtml(data);
                    }
                },
                {
                    data: 'email',
                    render: function(data) {
                        return escapeHtml(data);
                    }
                },
                {
                    data: 'subject',
                    render: function(data) {
                        return escapeHtml(data);
                    }
                },
                {
                    data: 'message',
                    render: function(data) {
                        if (!data) {
                            return '';
                        }

                        return '<span class="d-inline-block" style="min-width: 200px; white-space: normal;">' + escapeHtml(data) + '</span>';
                    }
                },
                {
                    data: 'created_at',
                    render: function(data) {
                        return formatDate(data);
                    }
                }
            ],
            columnDefs: [
                { targets: ['message'], width: '30%' }
            ]
        });
    });
</script>
@endsection
