$(document).ready(function() {
	
	$('#datatable_certificate_of_invoice_hdr').DataTable({
		destroy		: true,
		processing 	: true,
		serverSide 	: true,
		ajax 		: {
			url 	: '/certificate-of-invoice/list_certificate_of_invoice_hdr',
			dataType: 'json',
			type	: 'POST',
		},
		columns 	: [
			{ data: 'id', name: 'id', 'visible': false }, // 0
			{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // 1
			{ data: 'certificate_no', name: 'certificate_no', orderable: true, searchable: true }, // 2
			{ data: 'certificate_date', name: 'certificate_date', orderable: true, searchable: true }, // 3
			{ data: 'plo_no', name: 'plo_no', orderable: true, searchable: true }, // 4
			{ 
				data: 'grand_total', name: 'grand_total', orderable: true, searchable: true, render: function (data, type, row, meta) {
          			return currencyFormat(row.grand_total); }
			}, // 5
			{ data: 'action', name: 'action', orderable: false, searchable: false } // 6
		],
		order 		: [['3', 'desc'], ['2', 'desc']],
		'columnDefs': [
			{ "className": "text-center", "targets": [0, 1, 2, 3, 4, 5, 6] },
		],
		'autoWidth'	: false,
		'responsive': true,
	});


	$("body").on("click", "#print_coi", function (e) {
		var table 	= $("#datatable_certificate_of_invoice_hdr").DataTable();
		var data 	= table.row(this).data();
		var id 		= $(this).data("id");

		window.open("/certificate-of-invoice/print_certificate_of_invoice/" + id, "_blank");
	});

});