<?php

/**
 * Fixes various issues found where markdown features don't match GitHub style.
 *
 * PHP version 7.
 *
 * Created: 2019-04-19, 11:20
 *
 * LICENSE:
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2009 - 2019 ValidWebs.com
 * @package        mormvc - markdown-extras.php
 * @license
 * @version
 * mormvc
 * markdown_parser.php
 */

class markdown_parser extends ParsedownExtra {


	protected function element( array $Element ) {
		if ( $this->safeMode ) {
			$Element = $this->sanitiseElement( $Element );
		}

		// Makes H tags like Github style
		$h_tags = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
		if ( in_array( $Element['name'], $h_tags ) ) {
			$text = strtolower( $Element['text'] );
			$text = trim( str_replace( array(' ', '_', '/', '&'), '-', $text ) );

			$markup = '<' . $Element['name'] . ' id="' . $text . '" ';
		} else {
			$markup = '<' . $Element['name'];
		}

		if ( isset( $Element['attributes'] ) ) {
			foreach ( $Element['attributes'] as $name => $value ) {
				if ( $value === null ) {
					continue;
				}

				$markup .= ' ' . $name . '="' . self::escape( $value ) . '"';
			}
		}

		if ( isset( $Element['text'] ) ) {
			$markup .= '>';

			if ( ! isset( $Element['nonNestables'] ) ) {
				$Element['nonNestables'] = array();
			}

			if ( isset( $Element['handler'] ) ) {
				$markup .= $this->{$Element['handler']}( $Element['text'], $Element['nonNestables'] );
			} else {
				$markup .= self::escape( $Element['text'], true );
			}

			$markup .= '</' . $Element['name'] . '>';
		} else {
			$markup .= ' />';
		}

		return $markup;
	}
}

// End markdown_parser.php
