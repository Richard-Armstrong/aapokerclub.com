<?php defined('BASEPATH') OR exit('No direct script access allowed');

function block_chart($block, $fixed_aspect_ratio = TRUE) {
	$instance =& get_instance();

	$instance->load->model('custom_model');
	$dimensions = $instance->custom_model->get_block_dimensions($block->id);

	$instance->load->model('nvp_codes_model');
	$chart_types = $instance->nvp_codes_model->getCodeValues('Chart_Types');
	$progress_bar_types = $instance->nvp_codes_model->getCodeValues('Progress_Bar_Types');

	$label_dimension = $block->dimensions[0]; // X Axis is first Dimension
	if ($label_dimension)
		$labels = json_encode($instance->custom_model->get_column_data($label_dimension));

	if ($chart_types[$block->chart_type] == 'Area Graph')
		$fill = 'origin';
	else
		$fill = false;

	$y_dimensions = array();
	if (reverse_dimensions($block->chart_type)) {
		for ($i = count($dimensions); $i > 1; $i--) // Y Axes start at index 1
			$y_dimensions[] = $dimensions[$i - 1];
	} else {
		for ($i = 1; $i < count($dimensions); $i++) // Y Axes start at index 1
			$y_dimensions[] = $dimensions[$i];
	}

	$datasets = array();
	foreach ($y_dimensions as $dimension) {
		$datasets[] = array(
			'label'						=> $dimension->title,
			'data'						=> $instance->custom_model->get_column_data($dimension),
			'borderColor'				=> $dimension->color,
			'backgroundColor'			=> dimension_color($block->chart_type, $dimension->color),
			'hoverBackgroundColor'		=> transform_color($dimension->color),
			'pointBackgroundColor'		=> $dimension->color,
			'pointHoverBackgroundColor'	=> transform_color($dimension->color),
			'borderWidth'				=> 1,
			'fill'						=> $fill
		);
	}

	$datasets = json_encode($datasets);

	if ($chart_types[$block->chart_type] != 'Progress Bar' && !($labels && $datasets))
		return 'Chart could not be rendered';

	$data['block_id'] = $block->id; // All charts use block_id
	// Load chart view with needed data
	if ($chart_types[$block->chart_type] == 'Progress Bar') {
		$data['percent'] = $block->progress_percent ? 1 : 0;
		$data['hide_percent'] = $block->hide_progress_percent ? 1 : 0;
		$data['color'] = $block->progress_interval_color;
		if ($block->hide_progress_value)
			$data['comparison'] = null;
		else
			$data['comparison'] = $block->progress_comparison;
		// Load the view of the correct progress bar type
		$instance->load->view("includes/charts/progress_bar_" . str_replace(' ', '_', strtolower($progress_bar_types[$block->progress_bar_type])), $data);
	} else {
		$data['formatters'] = formatters($block->dimensions);
		$data['labels'] = $labels;
		$data['datasets'] = $datasets;
		$data['hide_legend'] = $block->hide_legend ? 0 : 1;
		$data['begin_at_zero'] = $block->begin_at_zero ? 1 : 0;
		$data['fixed_aspect_ratio'] = $fixed_aspect_ratio;
		$data['min'] = ($block->minimum_override != '') ? floatval($block->minimum_override) : NULL;
		$data['max'] = ($block->maximum_override != '') ? floatval($block->maximum_override) : NULL;
		$data['x_axis_label'] = $block->x_axis_label;
		$data['y_axis_label'] = $block->y_axis_label;
		$data['line'] = ($block->line != '') ? floatval($block->line) : NULL;
		$data['line_color'] = $block->line_color;
		if ($block->maximum_override != '') {
			$data['box_min'] = ($block->box_min != '') ? floatval($block->box_min) : NULL;
			$data['box_min_color'] = box_color($block->box_min_color);
		} else {
			$data['box_min'] = NULL;
		}

		if ($block->minimum_override != '') {
			$data['box_max'] = ($block->box_max != '') ? floatval($block->box_max) : NULL;
			$data['box_max_color'] = box_color($block->box_max_color);
		} else {
			$data['box_max'] = NULL;
		}
		// Load the view of the correct chart type
		$instance->load->view("includes/charts/" . str_replace(' ', '_', strtolower($chart_types[$block->chart_type])), $data);
	}
}

function reverse_dimensions($chart_type) {
	$instance =& get_instance();
	$instance->load->model('nvp_codes_model');

	$chart_types = $instance->nvp_codes_model->getCodeValues('Chart_Types');

	return in_array($chart_types[$chart_type], array( 'Area Graph', 'Stacked Bar Graph', 'Line Graph' ));
}

function formatters($dimensions) {
	$format_string = "";
	foreach ($dimensions as $dimension)
		$format_string .= str_replace(' ', '_', strtolower($dimension->title)) . ": converters[`{$dimension->js_formatter}`],";
	$format_string = substr($format_string, 0, -1); // Cut off trailing ','
	return $format_string;
}

function dimension_color($chart_type, $color) {
	$instance =& get_instance();
	$instance->load->model('nvp_codes_model');

	$chart_types = $instance->nvp_codes_model->getCodeValues('Chart_Types');

	if ($chart_types[$chart_type] == 'Area Graph')
		return transform_color($color, 0.8, 0.2);
	else
		return transform_color($color, 0.8, 0.7);
}

function box_color($color) {
	return transform_color($color, 0.8, 0.4);
}

function transform_color($hex_color, $amount = 0.8, $transparency = NULL) {
	if (!$hex_color)
		return NULL;

	$hex_color = str_replace('#', '', $hex_color);
	$rgb = explode('.', chunk_split($hex_color, 2, '.'));
	array_pop($rgb);

	// Convert from hex to decimal
	foreach ($rgb as $index => $hex)
		$rgb[$index] = hexdec($hex);

	// Turn into rgba if transparency is being used
	if ($transparency)
		return "rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, {$transparency})";

	// Darken the color, for hovering over
	$rgb[0] = round(intval($rgb[0]) * $amount);
	$rgb[1] = round(intval($rgb[1]) * $amount);
	$rgb[2] = round(intval($rgb[2]) * $amount);

	$color = "#";
	// Convert from dec to hex and add to color string
	foreach ($rgb as $dec)
		$color .= str_pad(dechex($dec), 2, '0', STR_PAD_LEFT);

	return $color;
}
