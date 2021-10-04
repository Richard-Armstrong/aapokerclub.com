
var initialize_sortable;

initialize_sortable = function() {
  return $('.sortable').sortable();
};

window.label_formatter_for = block_id => (tooltipItem, chart) => format_chart_labels(tooltipItem, chart, block_id);

window.ticks_formatter_for = block_id => (value, index, values) => format_chart_ticks(value, index, values, block_id);

function format_chart_labels(tooltipItem, chart, block_id) {
	let newLabel;
	const metaIndex    = Object.keys(chart.datasets["0"]._meta)[0];
	const chart_type   = chart.datasets["0"]._meta[metaIndex].type;
	const datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
	const format_key   = datasetLabel.replace(/[^-\w\s]/g, ' ').replace(/^\s+|\s+$/g, '').replace(/[-\s]+/g, '_').toLowerCase();

	if (chart_type === 'horizontalBar') {
		newLabel = formatters[block_id][format_key](tooltipItem.xLabel);
	} else if (chart_type === 'doughnut') {
		newLabel = formatters[block_id][format_key](chart.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]);
	} else if (chart_type === 'pie') {
		newLabel = formatters[block_id][format_key](chart.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]);
	} else {
		newLabel = formatters[block_id][format_key](tooltipItem.yLabel);
	}

	return datasetLabel + ': ' + newLabel;
};

function format_chart_ticks(value, index, values, block_id) {
	if (Object.keys(formatters[block_id])[0]) {
		return formatters[block_id][Object.keys(formatters[block_id])[0]](value);
	}
};

window.formatters = {};

window.converters = {
	no_format(value)					{ return value; },
	thousands_separator(value)			{ return numeral(value).format('0,0.[00000000]'); },
	thousands_separator_rounded(value)	{ return numeral(value).format('0,0'); },
	currency(value)						{ return numeral(value).format('$0,0.[00]'); },
	currency_rounded(value)				{ return numeral(value).format('$0,0'); },
	percentage(value)					{ return numeral(value).format('0,0.[000000]%'); },
	percentage_rounded(value)			{ return numeral(value).format('0,0%'); },
	whole_percentage(value)				{ return numeral(value).format('0,0.[000000]') + '%'; },
	whole_percentage_rounded(value)		{ return numeral(value).format('0,0') + '%'; },
	mon(date)							{ return moment(date).format("MMM"); },         	//'Jan'
	mon_year(date)						{ return moment(date).format("MMM `YY"); },     	//'Jan `19'
	mon_day(date)						{ return moment(date).format("MMM D"); },       	//'Jan 1'
	mon_day_year(date)					{ return moment(date).format("MMM D, YYYY"); }, 	//'Jan 1, 2019'
	wkdy_mon_day(date)					{ return moment(date).format("ddd MMM D"); },		//'Tue Jan 1'
	wkdy_mon_day_year(date)				{ return moment(date).format("ddd MMM D, YYYY"); },	//'Tue Jan 1 2019'
	mon_day_ordinal_year(date)			{ return moment(date).format("MMM Do YYYY"); }, 	//'Jan 1st, 2019'
	month_day_year(date)				{ return moment(date).format("MM-DD-YYYY"); },  	//'02-16-2019'
	day_month_year(date)				{ return moment(date).format("DD-MM-YYYY"); },  	//'16-02-2019'
	year_month_day(date)				{ return moment(date).format("YYYY-MM-DD"); },  	//'2019-02-16'
	year_day_month(date)				{ return moment(date).format("YYYY-DD-MM"); }   	//'2019-16-02'
};
