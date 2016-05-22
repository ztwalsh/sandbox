<?php
	function form_input($name, $value, $id, $placeholder, $class, $type, $post = true) {
		if (empty($value) && !empty($_POST) && $post == true) {
			$value = stripslashes($_POST[$name]);
		} elseif (empty($value) && !empty($_SESSION['review'])) {
			$value = stripslashes($_SESSION['review'][$name]);
		} else {
			$value = $value;
		}

		if ($type == 'password') {
			$value = null;
		} else {
			$value = $value;
		}

		echo '<input class="text';
		if ($class) {
			echo ' '.$class;
		} else {
		}
		echo '" type="'.$type.'" id="'.$id.'" name="'.$name.'" placeholder="'.$placeholder.'" value="'.$value.'" />';
	}

	function form_checkbox($name, $value, $id) {
		$clean_name = str_replace('[]', '', $name);
		if (!empty($_POST)) {
			if (is_array($_POST[$clean_name])) {
				$new_array = array_values($_POST[$clean_name]);
			} else {
				$new_array = $_POST[$clean_name];
			}
		} elseif (!empty($_SESSION['review'])) {
			if (is_array($_SESSION['review'][$clean_name])) {
				$new_array = array_values($_SESSION['review'][$clean_name]);
			} else {
				$new_array = $_SESSION['review'][$clean_name];
			}
		}

		if (is_array($new_array)) {
			if (in_array($value, $new_array)) {
				$selected = ' selected';
				$check = 'checked ';
			} else {
				$selected = '';
				$check = '';
			}
		} else {
			if ($new_array == $value) {
				$selected = ' selected';
				$check = 'checked ';
			} else {
				$selected = '';
				$check = '';
			}
		}
		echo '<label class="press'.$selected.'" for="'.$id.'"><input type="checkbox" id="'.$id.'" name="'.$name.'" value="'.$value.'" '.$check.'/> '.$value.'</label>';
	}

	function form_radio($name, $value, $id) {
		if (!empty($_POST)) {
			if ($_POST[$name] == $value) {
				$selected = ' selected';
				$radio = 'checked ';
			} else {
				$selected = '';
				$radio = '';
			}
		} elseif (!empty($_SESSION['review'])) {
			if ($_SESSION['review'][$name] == $value) {
				$selected = ' selected ';
				$radio = 'checked ';
			} else {
				$selected = '';
				$radio = '';
			}
		}
		echo '<label class="press'.$selected.'" for="'.$id.'"><input type="radio" id="'.$id.'" name="'.$name.'" value="'.$value.'" '.$radio.'/> '.$value.'</label>';
	}

	function form_textarea($name, $placeholder, $class, $value = '') {
		if (!empty($_POST)) {
			$value = stripslashes($_POST[$name]);
		} elseif (!empty($_SESSION['review'])) {
			$value = stripslashes($_SESSION['review'][$name]);
		} else {
			$value = $value;
		}
		echo '<textarea ';
		if ($class) {
			echo 'class="'.$class.'" ';
		} else {
		}
		echo 'name="'.$name.'" placeholder="'.$placeholder.'">'.$value.'</textarea>';
	}

	function form_countries($selected_country = '') {
		global $mysqli;

		$countries = $mysqli->query("SELECT * FROM cc_countries");

		echo '<select name="country">';
		echo '<option value="">Select a country</option>';
		while ($country = $countries->fetch_array()) {
			echo '<option value ="'.$country['id'].'"';
			if ($_POST && $_POST['country'] == $country['id']) {
				echo ' selected';
			} elseif ($selected_country == $country['id']) {
				echo ' selected';
			} else {
				echo '';
			}
			echo '>'.$country['country'].'</option>';
		}
		echo '</select>';
	}

	function form_weight_unit($weight_unit = '') {
		echo '<select class="short" name="weight_unit">';
		echo '<option value="lbs"';
		if ($weight_unit == 'lbs') {
			echo ' selected';
		}
		echo '>lbs</option>';
		echo '<option value="kg"';
		if ($weight_unit == 'kg') {
			echo ' selected';
		}
		echo '>kg</option>';
		echo '</select>';
	}

	function form_event_type($event_type = NULL) {
		global $mysqli;
		$types = $mysqli->query("SELECT * FROM cc_event_types");

		echo '<select name="type">';
		echo '<option value="">Select a type</option>';
		while ($type = $types->fetch_assoc()) {
			echo '<option value ="'.$type['id'].'"';
			if ($_POST && $_POST['type'] == $type['id']) {
				echo ' selected';
			} elseif ($event_type && $event_type == $type['id']) {
				echo ' selected';
			} else {
				echo '';
			}
			echo '>'.$type['name'].'</option>';
		}
		echo '</select>';
	}

	function form_am_pm($am_pm = NULL) {
		echo '<select class="short" name="am-pm">';
		echo '<option value="am"';
		if ($am_pm && $am_pm == 'am') {
			echo ' selected ';
		}
		echo '>am</option>';
		echo '<option value="pm"';
		if ($am_pm && $am_pm == 'pm') {
			echo ' selected ';
		}
		echo '>pm</option>';
		echo '</select>';
	}

	function form_priority($priority = NULL) {
		echo '<select name="priority">';
		echo '<option value="0"';
		if ($priority && $priority == 0 || $_POST && $_POST['priority'] == 0) {
			echo ' selected ';
		}
		echo '>Low Priority</option>';

		echo '<option value="1"';
		if ($priority && $priority == 1 || $_POST && $_POST['priority'] == 1) {
			echo ' selected ';
		}
		echo '>Normal Priority</option>';

		echo '<option value="2"';
		if ($priority && $priority == 2 || $_POST && $_POST['priority'] == 2) {
			echo ' selected ';
		}
		echo '>High Priority</option>';
		echo '</select>';
	}

	function form_sail_condition($condition = NULL) {
		$range = range(5,1);

		echo '<div class="rating">';
		foreach($range as $rating) {
			echo '<input class="star" id="rating-'.$rating.'" name="condition_rating" type="radio" value="'.$rating.'" ';
			if ($condition && $condition == $rating || $_POST && $_POST['condition_rating'] == $rating) {
				echo 'checked ';
			}
			echo '/>';
			echo '<label class="star" for="rating-'.$rating.'"';
			echo '><i class="fa fa-star"></i></label>';
		}
		echo '</div>';
	}

	function primary_submit($value) {
		echo '<button class="primary" name="submit">';
		echo $value;
		echo '</button>';
	}

	function display_error($field, $message = 'Please fill in this field') {
		if (!empty($_POST) && empty($_POST[$field])) {
			echo '<span class="error"><i class="fa fa-exclamation-triangle"></i> '.$message.'</span>';
		} else {
			echo '';
		}
	}
?>