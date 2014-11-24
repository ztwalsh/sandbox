<?php
	function form_input($name, $value, $id, $placeholder) {
		if (empty($value) && !empty($_POST)) {
			$value = stripslashes($_POST[$name]);
		} elseif (empty($value) && !empty($_SESSION['review'])) {
			$value = stripslashes($_SESSION['review'][$name]);
		} else {
			$value = $value;
		}
		echo '<input class="text" type="text" id="'.$id.'" name="'.$name.'" placeholder="'.$placeholder.'" value="'.$value.'" />';
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

	function form_stars($name, $display, $value, $id) {
		if (!empty($_POST)) {
			if ($_POST[$name] == $value) {
				$selected = ' selected ';
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
		echo '<label class="star'.$selected.'" for="'.$id.'"><input type="radio" id="'.$id.'" name="'.$name.'" value="'.$value.'" '.$radio.'/> '.$display.'</label>';
	}

	function form_textarea($name, $placeholder) {
		if (!empty($_POST)) {
			$value = stripslashes($_POST[$name]);
		} elseif (!empty($_SESSION['review'])) {
			$value = stripslashes($_SESSION['review'][$name]);
		} else {
			$value = '';
		}
		echo '<textarea name="'.$name.'" placeholder="'.$placeholder.'">'.$value.'</textarea>';
	}

	function primary_submit($value) {
		echo '<button class="primary" name="submit">';
		echo $value;
		echo '</button>';
	}

	function display_error($field) {
		if (!empty($_POST) && empty($_POST[$field])) {
			echo '<span class="required"><i class="fa fa-exclamation-triangle"></i> Please fill in this field</span>';
		} else {
			echo '';
		}
	}

	function show_selections($data, $title) {
		if ($data) {
			$count = count($data);
			$i = 1;
			echo '<h3 class="headline3">'.$title.'</h3>';
			echo '<p class="small">';
			foreach($data as $item) {
				echo $item;
				if ($i < $count) {
					echo ', ';
				}
				$i++;
			}
			echo '</p>';
		}
	}

	function show_stars($data) {
		$i = 1;
		$max = 5;
		while ($i <= $max) {
			echo '<div ';
			if ($i <= $data) {
				echo 'class="star-selected"';
			} else {
				echo 'class="star"';
			}
			echo '><i class="fa fa-star"></i></div>';
			$i++;
		}
	}

	function single_processor() {
		// Define requirements
		$required = array('rating', 'headline', 'product_comments', 'firstname', 'location', 'bottom_line');

		// Check for missing required fields
		$missing = array();
		foreach ($required as $key) {
	        if (empty($_POST[$key])) {
	            $missing = $key;
	        }
	    }

	    // Process
	    if(empty($missing)) {
			$review = array('rating', 'headline', 'pros', 'cons', 'best', 'product_comments', 'service_comments', 'similar_products', 'firstname', 'location', 'describe', 'bottom_line');

			session_start();
		    $_SESSION['review'] = array();
		    foreach ($review as $key) {
		        if (isset($_POST[$key])) {
		            $_SESSION['review'][$key] = $_POST[$key];
		        }
		    }

		    return $_SESSION['review'];
		} else {
			$error = '<div class="wrapper"><div class="error">We have missing fields</div></div>';
			return $error;
		}
	}
?>