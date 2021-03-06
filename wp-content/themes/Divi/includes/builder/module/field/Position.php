<?php

class ET_Builder_Module_Field_Position extends ET_Builder_Module_Field_Base {

	const TAB_SLUG    = 'custom_css';
	const TOGGLE_SLUG = 'position_fields';

	/**
	 * @var ET_Builder_Element
	 */
	private $module;

	public function get_fields( array $args = array() ) {

		$responsive_options = array();
		$additional_options = array();
		$skip               = array(
			'type'        => 'skip',
			'tab_slug'    => self::TAB_SLUG,
			'toggle_slug' => self::TOGGLE_SLUG,
		);

		if ( ! $args['hide_position_fields'] ) {

			$corner_options = array(
				'top_left'     => esc_html__( 'Top Left', 'et_builder' ),
				'top_right'    => esc_html__( 'Top Right', 'et_builder' ),
				'bottom_left'  => esc_html__( 'Bottom Left', 'et_builder' ),
				'bottom_right' => esc_html__( 'Bottom Right', 'et_builder' ),
			);

			$center_options = array(
				'center_left'   => esc_html__( 'Center Left', 'et_builder' ),
				'center_center' => esc_html__( 'Center Center', 'et_builder' ),
				'center_right'  => esc_html__( 'Center Right', 'et_builder' ),
				'top_center'    => esc_html__( 'Top Center', 'et_builder' ),
				'bottom_center' => esc_html__( 'Bottom Center', 'et_builder' ),
			);

			$additional_options['positioning'] = array(
				'label'             => esc_html__( 'Position', 'et_builder' ),
				'type'              => 'select',
				'options'           => array(
					'none'     => esc_html__( 'Default', 'et_builder' ),
					'relative' => 'Relative',
					'absolute' => 'Absolute',
					'fixed'    => 'Fixed',
				),
				'option_category'   => 'layout',
				'default'           => $args['defaults']['positioning'],
				'default_on_child'  => true,
				'tab_slug'          => self::TAB_SLUG,
				'toggle_slug'       => self::TOGGLE_SLUG,
				'mobile_options'    => true,
				'hover'             => 'tabs',
				'bb_support'        => false,
				'linked_responsive' => array( 'position_origin_a', 'position_origin_f', 'position_origin_r' ),
				'description'       => esc_html__( 'Here you can choose the element\'s position type. Absolutlely positioned elements will float inside their parent elements. Fixed positioned elements will float within the browser viewport. Relatively positioned elements sit statically in their parent container, but can still be offset without disrupting surrounding elements.',
					'et_builder' ),
			);

			// Position origin/location options
			$origin_option = array(
				'label'            => esc_html__( 'Location', 'et_builder' ),
				'type'             => 'position',
				'options'          => $corner_options + $center_options,
				'option_category'  => 'layout',
				'default'          => $args['defaults']['position_origin'],
				'default_on_child' => true,
				'tab_slug'         => self::TAB_SLUG,
				'toggle_slug'      => self::TOGGLE_SLUG,
				'mobile_options'   => true,
				'hover'            => 'tabs',
				'bb_support'       => false,
				'description'      => esc_html__( 'Here you can adjust the element\'s starting location within its parent container. You can further adjust the element\'s position using the offset controls.',
					'et_builder' ),
			);

			// For absolute position
			$additional_options['position_origin_a']                      = $origin_option;
			$additional_options['position_origin_a']['linked_responsive'] = array( 'positioning', 'position_origin_f', 'position_origin_r' );

			// For fixed position
			$additional_options['position_origin_f']                      = $origin_option;
			$additional_options['position_origin_f']['linked_responsive'] = array( 'positioning', 'position_origin_a', 'position_origin_r' );

			// For relative position
			$additional_options['position_origin_r']                      = $origin_option;
			$additional_options['position_origin_r']['label']             = esc_html__( 'Offset Origin ', 'et_builder' );
			$additional_options['position_origin_r']['description']       = esc_html__( 'Here you can choose from which corner this element is offset from. The vertical and horizontal offset adjustments will be affected based on the element\'s offset origin.',
				'et_builder' );
			$additional_options['position_origin_r']['options']           = $corner_options;
			$additional_options['position_origin_r']['linked_responsive'] = array( 'positioning', 'position_origin_f', 'position_origin_a' );

			// Offset options
			$offset_option = array(
				'type'             => 'range',
				'range_settings'   => array(
					'min'  => -1000,
					'max'  => 1000,
					'step' => 1,
				),
				'option_category'  => 'layout',
				'default_unit'     => 'px',
				'default_on_child' => true,
				'tab_slug'         => self::TAB_SLUG,
				'toggle_slug'      => self::TOGGLE_SLUG,
				'responsive'       => true,
				'mobile_options'   => true,
				'hover'            => 'tabs',
			);

			$additional_options['vertical_offset']                = $offset_option;
			$additional_options['vertical_offset']['default']     = $args['defaults']['vertical_offset'];
			$additional_options['vertical_offset']['label']       = esc_html__( 'Vertical Offset', 'et_builder' );
			$additional_options['vertical_offset']['description'] = esc_html__( 'Here you can adjust the element\'s position upwards or downwards from its starting location, which may differ based on its offset origin.',
				'et_builder' );

			$additional_options['horizontal_offset']                = $offset_option;
			$additional_options['horizontal_offset']['default']     = $args['defaults']['horizontal_offset'];
			$additional_options['horizontal_offset']['label']       = esc_html__( 'Horizontal Offset', 'et_builder' );
			$additional_options['horizontal_offset']['description'] = esc_html__( 'Here you can adjust the element\'s position left or right from its starting location, which may differ based on its offset origin.',
				'et_builder' );

			$responsive_options += array(
				'vertical_offset',
				'horizontal_offset',
				'position_origin_a',
				'position_origin_f',
				'position_origin_r',
			);
		}

		if ( ! $args['hide_z_index_fields'] ) {
			$additional_options['z_index'] = array(
				'label'            => esc_html__( 'Z Index', 'et_builder' ),
				'type'             => 'range',
				'range_settings'   => array(
					'min'  => -500,
					'max'  => 500,
					'step' => 1,
				),
				'option_category'  => 'layout',
				'default'          => $args['defaults']['z_index'],
				'default_on_child' => true,
				'tab_slug'         => self::TAB_SLUG,
				'toggle_slug'      => self::TOGGLE_SLUG,
				'unitless'         => true,
				'hover'            => 'tabs',
				'responsive'       => true,
				'mobile_options'   => true,
				'description'      => esc_html__( 'Here you can control element position on the z axis. Elements with higher z-index values will sit atop elements with lower z-index values.',
					'et_builder' ),
			);

			$responsive_options += array(
				'z_index',
			);
		}

		foreach ( $responsive_options as $option ) {
			$additional_options["${option}_tablet"]      = $skip;
			$additional_options["${option}_phone"]       = $skip;
			$additional_options["${option}_last_edited"] = $skip;
		}

		return $additional_options;
	}

	// Processing functions

	/**
	 * @param object $module Current module to be processed
	 */
	public function set_module( $module ) {
		$this->module = $module;
	}

	/**
	 * Interpreter of ET_Builder_Element::get_media_query
	 *
	 * @param string $view
	 *
	 * @return array
	 */
	public function get_media_query( $view ) {
		$media_query = array();
		if ( 'tablet' === $view ) {
			$media_query = array(
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
			);
		} elseif ( 'phone' === $view ) {
			$media_query = array(
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
			);
		}

		return $media_query;
	}

	/**
	 * @param array  $attrs
	 * @param string $name
	 * @param string $desktopDefault
	 * @param string $view
	 *
	 * @return mixed
	 */
	private function get_default( $attrs, $name, $desktopDefault = '', $view = 'desktop' ) {
		$utils      = ET_Core_Data_Utils::instance();
		$responsive = ET_Builder_Module_Helper_ResponsiveOptions::instance();
		$suffix     = in_array( $view, array( 'tablet', 'phone' ) ) ? "_$view" : '';
		if ( 'hover' === $view ) {
			return $utils->array_get( $attrs, $name, $desktopDefault );
		}

		return $responsive->get_default_value( $attrs, "$name$suffix", $desktopDefault );
	}

	/**
	 * @param array  $attrs
	 * @param string $name
	 * @param string $default_value
	 * @param string $view
	 * @param bool   $force_return
	 *
	 * @return mixed
	 */
	private function get_value( $attrs, $name, $default_value = '', $view = 'desktop', $force_return = false ) {
		$utils         = ET_Core_Data_Utils::instance();
		$responsive    = ET_Builder_Module_Helper_ResponsiveOptions::instance();
		$hover         = et_pb_hover_options();
		$is_hover      = 'hover' === $view;
		$field_device  = $is_hover ? 'desktop' : $view;
		$field_name    = $is_hover ? $hover->get_hover_field( $name ) : $name;
		$field_default = $is_hover ? $utils->array_get( $attrs, $name, $default_value ) : $default_value;

		return $responsive->get_any_value( $attrs, $field_name, $field_default, $force_return, $field_device );
	}

	/**
	 * @param string $function_name
	 */
	public function process( $function_name ) {
		$utils           = ET_Core_Data_Utils::instance();
		$hover           = et_pb_hover_options();
		$responsive      = ET_Builder_Module_Helper_ResponsiveOptions::instance();
		$position_config = $utils->array_get( $this->module->advanced_fields, self::TOGGLE_SLUG, array() );
		$z_index_config  = $utils->array_get( $this->module->advanced_fields, 'z_index', array() );

		$props = $this->module->props;

		$this->module->set_position_locations( array() );

		if ( ! is_array( $z_index_config ) && ! is_array( $position_config ) ) {
			return;
		}

		$has_z_index  = false;
		$has_position = false;

		// z_index processing
		if ( is_array( $z_index_config ) ) {
			$z_index_selector = $utils->array_get( $z_index_config, 'css.main', '%%order_class%%' );
			$z_index_default  = $utils->array_get( $z_index_config, 'default', '' );
			$z_important      = $utils->array_get( $z_index_config, 'important', false ) !== false ? ' !important' : '';
			$views            = array( 'desktop' );

			if ( $hover->is_enabled( 'z_index', $props ) ) {
				array_push( $views, 'hover' );
			}

			if ( $responsive->is_responsive_enabled( $props, 'z_index' ) ) {
				array_push( $views, 'tablet', 'phone' );
			}

			foreach ( $views as $type ) {
				$value = $this->get_value( $props, 'z_index', $z_index_default, $type, false );
				if ( '' !== $value ) {
					$type_selector = 'hover' === $type ? "${z_index_selector}:hover" : $z_index_selector;
					ET_Builder_Element::set_style( $function_name,
						array(
							'selector'    => $type_selector,
							'declaration' => "z-index: $value$z_important;",
							'priority'    => $this->module->get_style_priority(),
						) + $this->get_media_query( $type ) );
					$has_z_index = true;
				}
			}
		}

		if ( is_array( $position_config ) ) {
			$position_selector    = $utils->array_get( $position_config, 'css.main', '%%order_class%%' );
			$position_default     = $utils->array_get( $position_config, 'default', 'none' );
			$position_important   = $utils->array_get( $position_config, 'important', false ) !== false ? ' !important' : '';
			$desktop_origin_value = 'top_left';

			$views = array( 'desktop' );

			if ( $hover->is_enabled( 'positioning', $props ) ) {
				array_push( $views, 'hover' );
			}

			if ( $responsive->is_responsive_enabled( $props, 'positioning' ) ) {
				array_push( $views, 'tablet', 'phone' );
			}

			$position_origins = array();
			foreach ( $views as $type ) {
				$value          = $this->get_value( $props, 'positioning', $position_default, $type, true );
				$default_value  = $this->get_default( $props, 'positioning', $position_default, $type );
				$important      = in_array( $value, array( 'fixed', 'absolute' ) ) || ( 'desktop' != $type ) ? ' !important' : $position_important;
				$position_value = $value;
				if ( 'none' === $value ) {
					// default is interpreted as static in FE.
					$position_value            = 'static';
					$important                 = ' !important';
					$position_origins[ $type ] = 'default';
				} else {
					$suffix                    = sprintf( "_%s", substr( $value, 0, 1 ) );
					$position_origins[ $type ] = $this->get_value( $props, "position_origin$suffix", 'top_left', $type, true );
				}
				if ( 'desktop' === $type && ( $default_value === $value ) ) {
					$position_origins['desktop'] = 'default';
				}
				if ( $default_value !== $position_value && ( 'none' !== $value || 'desktop' !== $type ) ) {
					$type_selector = 'hover' === $type ? "${position_selector}:hover" : $position_selector;
					ET_Builder_Element::set_style( $function_name,
						array(
							'selector'    => $type_selector,
							'declaration' => "position: $position_value$important;",
							'priority'    => $this->module->get_style_priority(),
						) + $this->get_media_query( $type ) );
					$has_position = true;
				}
			}

			$resp_status = array(
				'horizontal' => $responsive->get_responsive_status( $utils->array_get( $props, 'horizontal_offset_last_edited', false ) ),
				'vertical'   => $responsive->get_responsive_status( $utils->array_get( $props, 'vertical_offset_last_edited', false ) ),
			);

			$hover_status = array(
				'horizontal' => $hover->is_enabled( 'horizontal_offset', $props ),
				'vertical'   => $hover->is_enabled( 'vertical_offset', $props ),
			);

			if ( $resp_status['horizontal'] || $resp_status['vertical'] ) {
				if ( ! isset( $position_origins['tablet'] ) ) {
					$position_origins['tablet'] = $position_origins[ 'desktop' ];
				}
				if ( ! isset( $position_origins['phone'] ) ) {
					$position_origins['phone'] = $position_origins[ 'desktop' ];
				}
			}

			if ( ( $hover_status['horizontal'] || $hover_status['vertical'] ) && ! isset( $position_origins['hover'] ) ) {
				$position_origins['hover'] = $position_origins[ 'desktop' ];
			}

			$this->module->set_position_locations( $position_origins );
			foreach ( $position_origins as $type => $active_origin ) {
				$type_selector = 'hover' === $type ? "${position_selector}:hover" : $position_selector;
				if ( 'default' === $active_origin ) {
					if ( 'desktop' !== $type ) {
						ET_Builder_Element::set_style( $function_name,
							array(
								'selector'    => $type_selector,
								'declaration' => "top:0px; right:auto; bottom:auto; left:0px;",
								'priority'    => $this->module->get_style_priority(),
							) + $this->get_media_query( $type ) );
					}
					continue;
				}
				$offsets = array( 'vertical', 'horizontal' );
				foreach ( $offsets as $offsetSlug ) {
					$field_slug       = "${offsetSlug}_offset";
					$is_hover         = 'hover' === $type && $hover_status[ $offsetSlug ];
					$is_responsive    = in_array( $type, array( 'tablet', 'phone' ) ) && $resp_status[ $offsetSlug ];
					$offset_view      = $is_hover ? 'hover' : ( $is_responsive ? $type : 'desktop' );
					$value            = esc_attr( $this->get_value( $props, $field_slug, '0px', $offset_view, true ) );
					$origin_array     = explode( '_', $active_origin );
					$property         = 'left';
					$inverse_property = 'right';
					if ( 'horizontal' === $offsetSlug ) {
						if ( 'center' === $origin_array[1] ) {
							$value = '50%';
						} elseif ( 'right' === $origin_array[1] ) {
							$property         = 'right';
							$inverse_property = 'left';
						}
					} else {
						$property         = 'top';
						$inverse_property = 'bottom';
						if ( 'center' === $origin_array[0] ) {
							$value = '50%';
						} elseif ( 'bottom' === $origin_array[0] ) {
							$property         = 'bottom';
							$inverse_property = 'top';
						}
						// add the adminbar height offset to avoid overflow of fixed elements.
						if ( 'top' === $property ) {
							$admin_bar_declaration = "$property: $value";
							if ( 'fixed' === $this->get_value( $props, 'positioning', $position_default, $type, true ) ) {
								$admin_bar_height      = 'phone' === $type ? '46px' : '32px';
								$admin_bar_declaration = "$property: calc($value + $admin_bar_height);";
							}
							ET_Builder_Element::set_style( $function_name,
								array(
									'selector'    => "body.logged-in.admin-bar $type_selector",
									'declaration' => $admin_bar_declaration,
									'priority'    => $this->module->get_style_priority(),
								) + $this->get_media_query( $type ) );
						}
						if ( 'top' === $inverse_property ) {
							ET_Builder_Element::set_style( $function_name,
								array(
									'selector'    => "body.logged-in.admin-bar $type_selector",
									'declaration' => "$inverse_property: auto",
									'priority'    => $this->module->get_style_priority(),
								) + $this->get_media_query( $type ) );
						}
					}
					ET_Builder_Element::set_style( $function_name,
						array(
							'selector'    => $type_selector,
							'declaration' => "$property: $value;",
							'priority'    => $this->module->get_style_priority(),
						) + $this->get_media_query( $type ) );

					ET_Builder_Element::set_style( $function_name,
						array(
							'selector'    => $type_selector,
							'declaration' => "$inverse_property: auto;",
							'priority'    => $this->module->get_style_priority(),
						) + $this->get_media_query( $type ) );
				}
			}
		}

		if ( $has_z_index && ( ! is_array( $position_config ) || ! $has_position ) ) {
			// Backwards compatibility. Before this feature if z-index was set, position got defaulted as relative
			ET_Builder_Element::set_style( $function_name,
				array(
					'selector'    => '%%order_class%%',
					'declaration' => "position: relative;",
					'priority'    => $this->module->get_style_priority(),
				) );
		}
	}
}

return new ET_Builder_Module_Field_Position();
