$(document).ready(function() {

	reset_input();

	/* List Data - Begin */
	var table = $('#datatable_receiving_report_hdr').DataTable({
		destroy		: true,
		processing 	: true,
		serverSide 	: true,
		ajax 		: {
			url 	: '/receiving-report/list_receiving_report_hdr',
			dataType: 'json',
			type	: 'POST',
		},
		columns 	: [
			{ data: 'id', name: 'id', 'visible': false }, // 0
			{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // 1
			{ data: 'rr_no', name: 'rr_no', orderable: true, searchable: true }, // 2
			{ data: 'rr_date', name: 'rr_date', orderable: true, searchable: true }, // 3
			{ data: 'rdi_no', name: 'rdi_no', orderable: true, searchable: true }, // 4
			{ data: 'rdi_date', name: 'rdi_date', orderable: true, searchable: true }, // 5
			{ data: 'delivery_date', name: 'delivery_date', orderable: true, searchable: true }, // 6
			{ data: 'action', name: 'action', orderable: false, searchable: false } // 7
		],
		order 		: [['3', 'desc'], ['2', 'desc']],
		'columnDefs': [
			{ "className": "text-center", "targets": [0, 1, 2, 3, 4, 5, 6, 7] },
		],
		'autoWidth'	: false,
		'responsive': true,
	});
	/* List Data - End */

	/* Event - Begin */
	$('#cbo_nomor_rdi').change(function() {
		var di_id = $('#cbo_nomor_rdi option:selected').attr('data-id');

		if (di_id == '0') {
			$('#tgl_rdi').val('AUTO');
		} else {			
			$('#tgl_rdi').val(moment($('#cbo_nomor_rdi option:selected').attr('data-date')).format(format_date_display_2));
		}

		$.ajax({
			url: "/receiving-report/get_rdi_gr_os_detail/"+di_id,
			type: 'GET',
			datatype: 'json',
			beforeSend: function() {
				$("#detail_input_rr").LoadingOverlay("show", true);
			},
			complete: function() {
				$("#detail_input_rr").LoadingOverlay("hide", true);
			},
			success: function(data) {
				$("#detail_input_rr").empty();
				if (di_id == '0') {
					return false;
				}
				var html = '';
				var i = 0;
				if ($.isEmptyObject(data)) {
					html +=			'<div class="col-xs-12 col-md-2 col-lg-2 col-xl-2 text-center">'
			     	html +=				'<span class="text-center"><b>Tidak Ada Data</b></span>'
			     	html += 		'</div>'
				} else {
					data.forEach(function(row) {
						html += 	'<div class="row">'
				     	html += 		'<div class="col-xs-12 col-md-1 col-lg-1 col-xl-1">'
				     	html += 			'<div class="custom-control custom-checkbox text-center">'
				     	html += 				'<input type="checkbox" class="text-center" name="chk_select[]" value="'+i+'" checked>'
				     	html += 			'</div>'
				     	html += 		'</div>'
				     	html +=			'<div class="col-xs-12 col-md-2 col-lg-2 col-xl-2 text-center">'
				     	html +=				'<input type="text" value="'+row.Part_Number+'" id="part_number[]" name="part_number[]" class="form-control" readonly>'
				     	html +=				'<input type="hidden" value="'+row.SysId_VPN2+'" id="vpn_id[]" name="vpn_id[]" class="form-control">'
				     	html +=				'<input type="hidden" value="'+row.SysId_VPN+'" id="pn_id[]" name="pn_id[]" class="form-control">'
				     	html += 		'</div>'
				     	html += 		'<div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">'
				     	html += 			'<input type="text" value="'+row.Part_Name+'" id="part_name[]" name="part_name[]" class="form-control" readonly>'
				     	html += 		'</div>'
				     	html += 		'<div class="col-xs-12 col-md-1 col-lg-1 col-xl-1 text-center">'
				     	html += 			'<input type="text" value="'+row.Unit+'" id="satuan[]" name="satuan[]" class="form-control" readonly>'
				     	html += 		'</div>'
				     	html += 		'<div class="col-xs-12 col-md-2 col-lg-2 col-xl-2">'
				     	html += 			'<input type="text" value="'+currencyFormat(row.Outstanding_DI)+'" id="qty_rr_input[]" name="qty_rr_input[]" class="form-control text-right only-number">'
				     	html += 		'</div>'
				     	html += 		'<div class="col-xs-12 col-md-2 col-lg-2 Outstanding_DI-xl-2">'
				     	html += 			'<input type="text" value="'+currencyFormat(row.Outstanding_DI)+'" id="qty_rr_max[]" name="qty_rr_max[]" class="form-control text-right" readonly>'
				     	html += 		'</div>'
				     	html +=		'</div>'
				     	html += 	'<hr>';
				     	i = i+1;
					});
						html += 	'<div class="buttons">';
                        html += 		'<button class="btn btn-icon icon-left btn-lg btn-primary font-weigh-bold" id="btn_proses_rr"><i class="fas fa-check"></i> Proses RR</button>';
                        html += 		'<button class="btn btn-icon icon-left btn-lg btn-danger font-weigh-bold" id="btn_batal_rr"><i class="fas fa-ban"></i> Batal</button>';
                        html += 	'</div>';
				}
				$('#detail_input_rr').html(html);
			},
			error: function(xhr, status, error) {
				$("#detail_input_rr").LoadingOverlay("hide", true);
				var errorMessage = xhr.status + ': ' + xhr.statusText
			   	Swal.fire({
				   	type 		: 'error',
					title 		: '<strong>Error</strong>',
				   	text 		: errorMessage,
			   	});
			}
		}).always(function(){
    		$.LoadingOverlay("hide");
		});
    });

    $('#tgl_sj_vendor').change(function() {
    	$('#tgl_pengiriman').val($('#tgl_sj_vendor').val());
    });

    $("#check_all").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
	});

	$('body').on('click', '#btn_proses_rr', function (e) {
		e.preventDefault();

		var rdi_no         	= $('#cbo_nomor_rdi').val();
		var no_sj_vendor   	= $('#no_sj_vendor').val();

		if (rdi_no == '0') {
			Swal.fire({
				type 		: 'error',
			 	title 		: '<strong>Error</strong>',
				text 		: "Nomor DI belum dipilih !!!",
			});
			$('#cbo_nomor_rdi').focus();
			return false;
		}

		if (no_sj_vendor.length == 0) {
			Swal.fire({
				type 		: 'error',
			 	title 		: '<strong>Error</strong>',
				text 		: "Nomor SJ Vendor harus diisi !!!",
			});
			$('#no_sj_vendor').focus();
			return false;
		}

  		swal({
            title: "Lanjutkan proses pembuatan RR ?",
            text: "Proses pembuatan RR",
            type: "question",
            showCancelButton: !0,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
					type		: 'post',
					url			: "/receiving-report/store_receiving_report",
					data		: $('#form_input_rr').serialize(),
					beforeSend: function() {
						$.LoadingOverlay("show");
					},
					complete: function() {
						$.LoadingOverlay("hide");
					},
					success: function(response) {
						for (var key in response) {
							var flag 			= (response['success']);
							var message 		= (response['message']);
							var rr_id 	    	= (response['rr_id']);
							var rr_no 	    	= (response['rr_no']);
						}		
						if ($.trim(flag) == 'true') {
							var url = '/receiving-report';
							swal({								
					            title				: "Success!",
					            html				: message +
					            	  				  '<br>Nomor RR : <strong>' +
								      				  rr_no +
								      				  '</strong><br><br>Lanjutkan ke proses print RR ?',
					            type 				: 'success',
					            showCancelButton	: !0,
					            confirmButtonText	: "Ya",
					            cancelButtonText	: "Tidak",
					            reverseButtons		: !0
					        }).then(function (e) {
					        	$('#no_rr').val(rr_no);
					        	$('#id_rr').val(rr_id);
					            if (e.value === true) {
					            	window.open("/receiving-report/print_receiving_report/" + rr_id, "_blank");
					            } else {
					                e.dismiss;
					            }
					            window.location.replace(url);
					        }, function (dismiss) {
					            window.location.replace(url);
					        })
						} else {
							Swal.fire({
								type 		: 'error',
								title 		: '<strong>Error</strong>',
								html 		: '<u>Kemungkinan error :</u> <br>'+
											   message,
							});
						}
					},
					error: function(xhr, status, error) {
						var errorMessage = xhr.status + ': ' + xhr.statusText
					   	Swal.fire({
						   	type 		: 'error',
							title 		: '<strong>Error</strong>',
						   	text 		: errorMessage,
					   	});
					}
				}).always(function(){
		    		$.LoadingOverlay("hide");
				});
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
	});

	$('body').on('click', '#btn_batal_rr', function (e) {
		e.preventDefault();
  		swal({
            title: "Membatalkan input RR ?",
            text: "Data yang sudah diinput akan direset !",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                reset_input();
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
	});

	$("body").on("click", "#print_rr", function (e) {
		var table 	= $("#datatable_receiving_report_hdr").DataTable();
		var data 	= table.row(this).data();
		var id 		= $(this).data("id");

		window.open("/receiving-report/print_receiving_report/" + id, "_blank");
	});
    /* Event - End */

    /* Function - Begin */
    function reset_input() {
    	$("#cbo_nomor_rdi").select2();
    	$("#cbo_nomor_rdi").val('0').trigger('change');
    	$('#tgl_rdi').val('AUTO');
    	$('#no_sj_vendor').val('');
    	$('#tgl_sj_vendor').val(moment().format(format_date_display_2));
    	$('#tgl_pengiriman').val(moment().format(format_date_display_2));
    	$('#keterangan').val('');
    	$("#detail_input_rr").empty();
    }
    /* Function - End */

});	