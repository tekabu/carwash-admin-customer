@extends('base.base')

@section('header_title', 'Customer Top-ups')

@section('content')
<style>
    .proof-thumb {
        width: 56px;
        height: 56px;
        object-fit: cover;
        border-radius: 0.35rem;
        border: 1px solid rgba(0, 0, 0, 0.08);
    }

    .proof-thumb-name {
        max-width: 90px;
        font-size: 0.75rem;
        text-align: center;
        display: inline-block;
    }
</style>
<div class="card">
    <div class="table-responsive">
        <table class="table dt datatable-basic dataTable">
            <thead>
                <tr>
                    <th class="action">#</th>
                    <th class="customer">Customer</th>
                    <th class="top_up_amount">Top-up Amount</th>
                    <th class="proof_of_payment">Proof of Payment</th>
                    <th class="status">Status</th>
                    <th class="remarks">Remarks</th>
                    <th class="created_at">Created At</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div id="modal-entry" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-save">Save</button>
            </div>
        </div>
    </div>
</div>
<div id="modal-proof-viewer" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Proof of Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <img id="proof-viewer-image" src="" alt="Proof of payment" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/vendor/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/vendor/tables/datatables/extensions/buttons.min.js') }}"></script>
<script src="{{ asset('js/vendor/notifications/sweet_alert.min.js') }}"></script>
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
                    case "'":
                        return '&#39;';
                    default:
                        return match;
                }
            });
        }

        function formatCurrency(value) {
            if (value == null || value === '') {
                return '';
            }

            var parsed = parseFloat(value);
            if (Number.isNaN(parsed)) {
                return escapeHtml(String(value));
            }

            var parts = parsed.toFixed(2).split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            return '₱ ' + parts.join('.');
        }

        const swalInit = Swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });

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

        $('.dt').DataTable({
            data: {!! $table->toJson() !!},
            columns: [
                { data: 'action_options' },
                { data: 'customer.name', defaultContent: '' },
                {
                    data: 'top_up_amount',
                    render: function(data) {
                        return formatCurrency(data);
                    }
                },
                {
                    data: 'proof_of_payment_url',
                    render: function(data, type, row) {
                        if (!data) {
                            return '';
                        }

                        var url = String(data);
                        var fileName = (row.proof_of_payment || '').split('/').pop() || 'Attachment';
                        var previewName = escapeHtml(fileName);
                        var extension = url.split('?')[0].split('.').pop().toLowerCase();

                        if (extension === 'pdf') {
                            return '<a class="text-reset text-decoration-underline d-inline-flex align-items-center" href="' + escapeHtml(url) + '" target="_blank" rel="noreferrer">' +
                                '<i class="ph-file-pdf text-danger me-1"></i>' + previewName +
                                '</a>';
                        }

                        return '<button type="button" class="btn btn-link p-0 proof-preview d-inline-flex flex-column align-items-center" data-url="' + escapeHtml(url) + '" data-filename="' + previewName + '">' +
                            '<img src="' + escapeHtml(url) + '" alt="' + previewName + '" class="proof-thumb mb-1">' +
                            '</button>';
                    }
                },
                { data: 'status' },
                { data: 'remarks' },
                { data: 'created_at' }
            ],
            columnDefs: [
                { targets: ['action'], className: 'text-center' },
                { targets: ['action'], width: '50' },
                { targets: ['action'], orderable: false },
            ],
            buttons: {
                dom: {
                    button: {
                        className: 'btn'
                    }
                },
                buttons: [
                    {
                        text: '<i class="ph-plus"></i> Add New',
                        className: 'btn-primary',
                        action: function(e, dt, node, config) {
                            $.ajax({
                                url: '{{ route("$route.create") }}',
                                type: 'GET',
                                success: function(result) {
                                    if (result.status || false) {
                                        $('#modal-entry .modal-body').empty().append(result.html);
                                        $('#modal-entry .btn-save').attr('data-action', 'create');
                                        $('#modal-entry').modal('show');
                                    } else {
                                        swalInit.fire('Failed!', result.message || 'Something went wrong.', 'error');
                                    }
                                },
                                error: function() {
                                    swalInit.fire('Failed!', 'Something went wrong.', 'error');
                                },
                            });
                        }
                    }
                ]
            }
        });

        $(document).on('show.bs.dropdown', '.actions', function () {
            $('.datatable-scroll-wrap').css('overflow-x', 'unset');
        });

        $(document).on('hidden.bs.dropdown', '.actions', function () {
            $('.datatable-scroll-wrap').css('overflow-x', 'auto');
        });

        $(document).on('hidden.bs.modal', '#modal-entry', function () {
            $('#modal-entry .modal-body').empty();
        });

        $(document).on('show.bs.modal', '#modal-entry', function () {
            $('#modal-entry .modal-title').html(($('#modal-entry input[name="id"]').length > 0 ? 'Edit' : 'New') + ' Top-up Request');
        });

        $(document).on('click', '.btn[data-action="create"]', function () {
            $('#modal-entry button').prop('disabled', true);

            $.ajax({
                url: '{{ route("$route.store") }}',
                type: 'POST',
                data: new FormData($('#modal-entry .modal-body .form-entry')[0]),
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(result) {
                    $('#modal-entry button').prop('disabled', false);

                    if (result.status || false) {
                        $('#modal-entry').modal('hide');

                        var table = $('.dt').DataTable();

                        table.row.add(result.data).draw();

                        var currentPage = table.page();

                        var rowCount = table.data().length - 1;
                        var insertedRow = table.row(rowCount).data();
                        var tempRow;

                        for (var i = rowCount; i > 0; i--) {
                            tempRow = table.row(i - 1).data();
                            table.row(i).data(tempRow);
                            table.row(i - 1).data(insertedRow);
                        }

                        table.page(currentPage).draw(false);

                        swalInit.fire('Success!', result.message, 'success');
                    } else {
                        swalInit.fire('Failed!', result.message || 'Something went wrong.', 'error');
                    }
                },
                error: function(result) {
                    $('#modal-entry button').prop('disabled', false);

                    let message = null;

                    if (result.responseJSON && result.responseJSON.message) {
                        message = result.responseJSON.message;
                    }

                    swalInit.fire('Failed!', message || 'Something went wrong.', 'error');
                },
            });
        });

        $(document).on('click', '.edit-row', function () {
            var _this = $(this);
            var tr = _this.closest('tr');
            var table = $('.dt').DataTable();
            var row = table.row(tr);
            var data = row.data();

            $.ajax({
                url: data.action_edit_url,
                type: 'GET',
                success: function(result) {
                    if (result.status || false) {
                        $('#modal-entry .modal-body').empty().append(result.html);
                        $('#modal-entry .modal-body input[name="id"]').attr('index', row.index());
                        $('#modal-entry .modal-body input[name="id"]').attr('url', data.action_update_url);
                        $('#modal-entry .btn-save').attr('data-action', 'update');
                        $('#modal-entry').modal('show');
                    } else {
                        swalInit.fire('Failed!', result.message || 'Something went wrong.', 'error');
                    }
                },
                error: function() {
                    swalInit.fire('Failed!', 'Something went wrong.', 'error');
                },
            });
        });

        $(document).on('click', '.btn[data-action="update"]', function () {
            $('#modal-entry button').prop('disabled', true);

            var formData = new FormData($('#modal-entry .modal-body .form-entry')[0]);
            formData.append('_method', 'PUT');

            $.ajax({
                url: $('#modal-entry .modal-body input[name="id"]').attr('url'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(result) {
                    $('#modal-entry button').prop('disabled', false);

                    if (result.status || false) {
                        var index = $('#modal-entry .modal-body input[name="id"]').attr('index');

                        $('#modal-entry').modal('hide');

                        var table = $('.dt').DataTable();

                        table.row(index).data(result.data).draw(false);

                        swalInit.fire('Success!', result.message, 'success');
                    } else {
                        swalInit.fire('Failed!', result.message || 'Something went wrong.', 'error');
                    }
                },
                error: function(result) {
                    $('#modal-entry button').prop('disabled', false);

                    let message = null;

                    if (result.responseJSON && result.responseJSON.message) {
                        message = result.responseJSON.message;
                    }

                    swalInit.fire('Failed!', message || 'Something went wrong.', 'error');
                },
            });
        });

        $(document).on('click', '.delete-row', function () {
            var _this = $(this);
            var tr = _this.closest('tr');
            var table = $('.dt').DataTable();
            var data = table.row(tr).data();

            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: data.action_delete_url,
                        type: 'DELETE',
                        success: function(result) {
                            if (result.status || false) {
                                table.row(tr).remove().draw(false);

                                swalInit.fire('Deleted!', result.message || 'Record has been deleted.', 'success');
                            } else {
                                swalInit.fire('Failed!', result.message || 'Something went wrong.', 'error');
                            }
                        },
                        error: function(result) {
                            let message = null;

                            if (result.responseJSON && result.responseJSON.message) {
                                message = result.responseJSON.message;
                            }

                            swalInit.fire('Failed!', message || 'Something went wrong.', 'error');
                        },
                    });
                }
            });
        });

        $(document).on('click', '.proof-preview', function(event) {
            event.preventDefault();

            var url = $(this).data('url');
            if (!url) {
                return;
            }

            var filename = $(this).data('filename') || 'Proof of Payment';

            $('#modal-proof-viewer .modal-title').text(filename);
            $('#proof-viewer-image').attr('src', url);
            $('#modal-proof-viewer').modal('show');
        });

        $(document).on('hidden.bs.modal', '#modal-proof-viewer', function() {
            $('#proof-viewer-image').attr('src', '');
        });
    });
</script>
@endsection
