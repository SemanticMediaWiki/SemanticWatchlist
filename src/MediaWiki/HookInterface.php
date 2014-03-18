<?php

namespace SWL\MediaWiki;

/**
 * @ingroup SWL
 *
 * @licence GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
interface HookInterface {

	/**
	 * @since 1.0
	 *
	 * @param array $configuration
	 */
	public function setConfiguration( array $configuration );

	/**
	 * @since 1.0
	 *
	 * @return boolean
	 */
	public function execute();

}
