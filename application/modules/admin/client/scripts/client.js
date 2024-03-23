$(function() {

    ////////////////
    // DataTables //
    ////////////////
    var type_filter = '';

    // Reset Filter
    function resetFilter() {
        type_filter  = '';
        //$("#language_filter").val("").trigger('change.select2');
        // Refresh DataTable
        reloadDataTable(false);
    }

    // Initialize datatable
    var dataTableInstance = $('#myTable').DataTable({
                                lengthChange: false,
                                scrollResize: true,
                                searching: false,
                                //autoWidth: true,
                                //paging: false,
                                //info: false,
                                //scrollY: "100%",
                                scrollY: 500,
                                scrollCollapse: true,
                                processing: true,
                                serverSide: true,
                                rowId: 'id',
                                ajax: {
                                    url: baseURL+"admin/clients/datatable",
                                    type: "POST",
                                    data: function (d) {
                                        d.type    = type_filter;
                                    }
                                },
                                columns: [
                                    {
                                        className: 'report-id',
                                        data: 'name',
                                        name:'name'
                                    },
                                    {
                                        className: 'action',
                                        data: 'name',
                                        name:'location',
                                    },
                                    {
                                        className: 'category',
                                        data: 'total_incidents',
                                        name:'total_incidents'
                                    },
                                    {
                                        className: 'category',
                                        data: 'total_safetytips',
                                        name:'total_safetytips'
                                    },
                                    {
                                        className: 'posted-by table-fs-light',
                                        data: 'type',
                                        name:'type'
                                    },
                                    {
                                        className: 'date table-fs-light',
                                        render: getReportDateTimeHtml
                                    },
                                    {
                                        className: 'action',
                                        render: getActionHtml
                                    },
                                ],
                                deferRender: true
                              });

    function reloadDataTable(preservePage) {
        if(!preservePage)
            dataTableInstance.ajax.reload();
        else {
            console.log('resetting without page change');
            // don't reset the current page
            dataTableInstance.ajax.reload(null, false)
        }
    }

    // Datatable Row Rendering Helper
    function getActionHtml(data, type, row, meta) {
        return `<div>
                    <a class="btn text-primary pl-0 action-update-status" href="${baseURL}admin/clients/manage-client?client_id=${row.id}">Manage</a>
                </div>`;
                    //<button data-status="view" data-incidentid="${row.id}">Manage</button>
    }

    function getReportDateTimeHtml(data, type, row, meta) {
        var date = moment(row.created_on).format('DD MMM YYYY hh:mm A');
        return `<div>${date}</div>`;
    }

    // Clear filters
    $("#clear-filters").click(function(event) {
        resetFilter();
    });

});