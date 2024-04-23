var fimeint = (function ($) {
	"use strict";
	return {
        /* --------------------------------- */
		/* Charts
		/* --------------------------------- */
		loadmorris: function () {

			// LINE CHART
			var line = new Morris.Line({
				element: 'gymie-registrations-trend',
				resize: true,
				data: JSON.parse(jsRegistraionsCount),
				xkey: 'month',
				ykeys: ['registrations'],
				labels: [jsRegistraionTrendLabel],
				hideHover: 'auto',
				lineColors: ['#27ae60']
			});

			//DONUT CHART
			var donut = new Morris.Donut({
				element: 'fimeint-verified-users',
				resize: true,
				colors: ["#e74c3c", "#e67e22", "#3498db"],
				data: JSON.parse(jsMembersPerPlan),
				hideHover: 'auto'
			});

		},
    }
}