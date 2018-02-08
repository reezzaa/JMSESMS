/*
 *  Document   : tablesDatatables.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Tables Datatables page
 */

var TablesDatatables = function() {

    return {
        init: function() {
            /* Initialize Bootstrap Datatables Integration */
            App.datatables();

            /* Initialize Datatables */
            //Maintenance
                //Group UOM
                $('#groupuom-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 1,2 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                //Detail UOM
                $('#detailuom-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 3,4 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                //Material Classification
                $('#matClass-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 1,2 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                //Material Category
                $('#matCategory-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 3,4 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                //Material
                $('#material-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 5,6 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                //Equipment Type
                $('#equipType-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 1,2 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                //Equipment
                $('#equipment-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 5,6 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                //Services Offered
                $('#serviceOff-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 1,2 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                //Delivery Truck
                $('#deliTruck-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 4,5 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                //Specialization
                $('#specialization-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 3,4 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                //Worker
                $('#worker-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 4,5 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                //Discount
                $('#price-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 2 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
                $('#price2-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 2 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });$('#price3-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 2 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                });
               

            //Transaction
                //CompClient
                 $('#client-datatable').dataTable({
                    "aaSorting": [ [2,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 1,5 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                    });
                //IndClient
                $('#indivclient-datatable').dataTable({
                    "aaSorting": [ [1,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 0,5 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                    });
                //Services in Quote
                $('#services-datatable').dataTable({
                    "aaSorting": [ [1,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 0 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                    });
                //Material
                $('#quotemat-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 0 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                    });

                //Equipment
                $('#receive-datatable').dataTable({
                    "aaSorting": [ [0,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 6 ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                    });

             $('#stock-datatable').dataTable({
                "aaSorting": [ [0,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false ,"bSortable": false, "aTargets": [ 3 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
             
             $('#progress-datatable').dataTable({
                "aaSorting": [ [0,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 6 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
            $('#billbycontract-datatable').dataTable({
                "aaSorting": [ [1,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 4 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
            


             //Queries
                $('#qclient-datatable').dataTable({
                    "aaSorting": [ [1,'asc'] ],
                    "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [  ] } ],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
                    });

            //utilities
            $('#rate-datatable').dataTable({
                "aaSorting": [ [0,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false ,"bSortable": false, "aTargets": [ 2,3 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
            $('#form-datatable').dataTable({
                "aaSorting": [ [0,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false ,"bSortable": false, "aTargets": [ 1,2 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });

            $('#4col-datatable').dataTable({
                "aaSorting": [ [0,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false ,"bSortable": false, "aTargets": [ 3 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
           
            $('#5col-datatable').dataTable({
                "aaSorting": [ [1,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 4 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
              $('#5cols-datatable').dataTable({
                "aaSorting": [ [1,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false ,"bSortable": false, "aTargets": [ 0,4 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
            $('#6col-datatable').dataTable({
                "aaSorting": [ [1,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 4,5 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
             $('#6cols-datatable').dataTable({
                "aaSorting": [ [1,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 5 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
            $('#7col-datatable').dataTable({
                "aaSorting": [ [0,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 5,6 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
             $('#7cols-datatable').dataTable({
                "aaSorting": [ [0,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [  ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
           
            $('#8col-datatable').dataTable({
                "aaSorting": [ [0,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 7 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
            $('#9col-datatable').dataTable({
                "aaSorting": [ [0,'asc'] ],
                "aoColumnDefs": [ { "bSearchable": false, "bSortable": false, "aTargets": [ 8 ] }, { width: '15%', targets: 8 } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });
           

            /* Add placeholder attribute to the search input */
            $('.dataTables_filter input').attr('placeholder', 'Search');
        }
    };
}();