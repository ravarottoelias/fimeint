var fimeint = (function ($) {
	"use strict";
	return {
        /* --------------------------------- */
		/* Charts
		/* --------------------------------- */
		loadmorris: function () {

			//DONUT CHART
			const donut = new Morris.Donut({
				element: 'fimeint-verified-users',
				resize: true,
				colors: ["#e74c3c", "#e67e22", "#3498db"],
				data: JSON.parse(jsVerifiedUsersCountData),
				hideHover: 'auto'
			});
			
			const bar = new Morris.Bar({
				resize: true,
				data: JSON.parse(jsInscriptionChannels),
				hideHover: 'always',
				element: 'fimeint-inscription-channels',
				xkey: 'label',
				ykeys: ['value'],
				labels: ['Inscripciones'], 
				barColors: ["#007bff"],
				xLabelMargin: 12
			});

		},
		/* --------------------------------- */
		/* CURSO - Script de pagos
		/* --------------------------------- */
		saveScriptDePago : function () {
			var sp = {};

			sp.curso_id = $('#scriptsPagosModal [name ="curso_id"]').val()
			sp.sp_titulo = $('#scriptsPagosModal [name ="sp_titulo"]').val()
			sp.sp_descripcion = $('#scriptsPagosModal [name ="sp_descripcion"]').val()
			sp.sp_script = $('#scriptsPagosModal [name ="sp_script"]').val()
			console.log(sp)
			axios
				.post('/curso_add_scripts', sp)
				.then(res=>{
					$('#scriptsPagosModal [name ="sp_titulo"]').val('')
					$('#scriptsPagosModal [name ="sp_descripcion"]').val('')
					$('#scriptsPagosModal [name ="sp_script"]').val('')
					$('#scriptsPagosModal').modal('hide');
					document.querySelector('#spCloseBtnModal').click();
					this.getScriptsDePagos();
				})
				.catch(error => {
					const errorMessage = 'Ocurrió un error: ' + error.response ? error.response.data : error.message
					console.info(errorMessage);
				});
		},
		imprimirTablaScripts : function (scripts) {
				$("#body-scripts-de-pagos").html('')
		
				$.each( scripts, function( key, sp ) {
				  var tr = `<tr>
						  <th scope="row">${sp.id}</th>
						  <td>${sp.titulo}</td>
						  <td>${sp.descripcion}</td>
						  <td>${sp.script}</td>
						  <td class="text-right">
							  <a href="#" class="btn btn-sm btn-danger" onclick="eliminarScriptDePago(${sp.id})"><i class="fa fa-trash"></i></a>
						  </td>
						</tr>`;
					$("#body-scripts-de-pagos").append(tr);
				});
		},
		getScriptsDePagos : function () {
			const cursoId = $('#scriptsPagosModal [name ="curso_id"]').val();
			axios
				.get('/curso_scripts/'+cursoId)
				.then(res=>{
					console.log(res);
					this.imprimirTablaScripts(res.data);
				})
				.catch(error => {
					console.error(error);
					const errorMessage = 'Ocurrió un error:' + error.response ? error.response.data : error.message
					alert(errorMessage);
				});
		},
		deleteScriptDePago : function (sp_id) {
			const url = '/curso_delete_scripts/'+sp_id;
			const eliminar = confirm("Eliminar el item seleccionado?");

			if (eliminar) {
				axios
					.post(url)
					.then(res=>{
						this.getScriptsDePagos();
					})
			}
		}
    };
})(jQuery);