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
		echo '<label class="tags'.$selected.'" for="'.$id.'"><input type="checkbox" id="'.$id.'" name="'.$name.'" value="'.$value.'" '.$check.'/> '.$value.'</label>';
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
		echo '<label class="radio'.$selected.'" for="'.$id.'"><input type="radio" id="'.$id.'" name="'.$name.'" value="'.$value.'" '.$radio.'/> '.$value.'</label>';
	}

	function form_stars($name, $value, $id) {
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
		echo '<label class="star'.$selected.'" for="'.$id.'"><input type="radio" id="'.$id.'" name="'.$name.'" value="'.$value.'" '.$radio.'/> <img src="data:image/png;base64,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" /></label>';
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
			echo '<h3 class="headline3">'.$title.'</h3>';
			echo '<ul class="small">';
			foreach($data as $item) {
				echo '<li>'.$item.'</li>';
			}
			echo '</ul>';
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
			echo '><img src="data:image/png;base64,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" /></div>';
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
			$error = '<div class="error">We have missing fields</div>';
			return $error;
		}
	}



	function show_review_item($image, $title, $id, $date) {
		echo '<section class="product cf">';
			echo '<form action="index.php" id="form_1" method="post">';
				echo '<section class="product-header">';
					echo '<div class="product-image">';
						echo '<img height="auto" src="'.$image.'" width="100%" />';
					echo '</div>';
					echo '<div class="product-title">';
						echo '<h3 class="headline3">'.$title.'</h3>';
						echo '<p class="purchase-date">Purchased on '.$date.'</p>';
						echo '<span class="rating cf">';
							form_stars('rating', '5', 'star_5_'.$id);
							form_stars('rating', '4', 'star_4'.$id);
							form_stars('rating', '3', 'star_3'.$id);
							form_stars('rating', '2', 'star_2'.$id);
							form_stars('rating', '1', 'star_1'.$id);

						echo '</span>';
						echo '<div class="start-helper">Select a rating to start your review</div>';
					echo '</div>';
				echo '</section>';
				echo '<section class="product-comments">';
					echo '<div class="product-comments-wrapper">';
						echo '<p>';
						form_textarea('product_comments', 'How do you use the product? What things are great about it? What things aren\'t so great about it?');
						echo '</p>';
						echo '<p>';
						form_input('headline', '', 'headline', 'Add a headline for the review');
						echo '</p>';
						echo '<div class="image-container">';
							echo '<input class="file" type="file" id="file_upload">';
							echo '<label for="file_upload" class="secondary action add-image">';
								echo 'Add an Image <i class="fa fa-plus"></i>';
							echo '</label> ';
						echo '</div>';
					echo '</div>';
					echo '<div class="product-submit-wrapper">';
						primary_submit('Submit Review');
					echo '</div>';
				echo '</section>';
			echo '</form>';
		echo '</section>';
	}
?>