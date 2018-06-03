<?php
/**
 * Query API: ST_Query class
 *
 * @package SalesTools
 * @subpackage Query
 * @since 1.0.0
 */


 class ST_Query {

    	/**
	 * Query vars set by the user
	 *
	 * @since 1.5.0
	 * @var array
	 */
	public $query;
	
	public $current_record;

	public $record_count;
    

	 public function have_records()
	{
		if ( $this->current_record + 1 < $this->record_count ) {
			return true;
		} elseif ( $this->current_post + 1 == $this->post_count && $this->post_count > 0 ) {
			/**
			 * Fires once the loop has ended.
			 *
			 * @since 2.0.0
			 *
			 * @param WP_Query $this The WP_Query instance (passed by reference).
			 */
			do_action_ref_array( 'loop_end', array( &$this ) );
			// Do some cleaning up after the loop
			$this->rewind_posts();
		} elseif ( 0 === $this->post_count ) {
			/**
			 * Fires if no results are found in a post query.
			 *
			 * @since 4.9.0
			 *
			 * @param WP_Query $this The WP_Query instance.
			 */
			do_action( 'loop_no_results', $this );
		}

		$this->in_the_loop = false;
		return false;
	}
    

 }




?>