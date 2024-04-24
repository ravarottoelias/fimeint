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
    };
})(jQuery);