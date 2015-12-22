<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*
  Example usage:

  $messageStack = new messageStack();
  $messageStack->add('general', 'Error: Error 1', 'error');
  $messageStack->add('general', 'Error: Error 2', 'warning');
  if ($messageStack->size('general') > 0) echo $messageStack->output('general');
*/
class Wps_Deals_Message_Stack {
  
    public $messageToStack, $messages;

	// class constructor
    function __construct() {
    	
		if( !session_id() ) { 
			session_start();
		}	
		$this->messages = array();
		
		
		if( !isset( $_SESSION['wpsdeals_message_stack'] ) ) {
			$_SESSION['wpsdeals_message_stack'] = array( 'messageToStack' => array() );
		}
		
		$this->messageToStack =& $_SESSION['wpsdeals_message_stack']['messageToStack'];
		  
		for( $i=0, $n=sizeof( $this->messageToStack ); $i<$n; $i++ ) {
			$this->add( $this->messageToStack[$i]['class'], $this->messageToStack[$i]['text'], $this->messageToStack[$i]['type']);
		}
		$this->messageToStack = array();
    }

	// class methods
    function add( $class, $message, $type = '' ) {
      
		if ( $type == 'error' ) {
			$this->messages[] = array( 'params' => 'class="message_stack_error"', 'class' => $class, 'text' =>  '&nbsp;' . $message );
		} elseif ( $type == 'multierror' ) {
			$this->messages[] = array( 'params' => 'class="message_stack_multierror"', 'class' => $class, 'text' => '&nbsp;' . $message );
		} elseif ( $type == 'success' ) {
			$this->messages[] = array( 'params' => 'class="message_stack_success"', 'class' => $class, 'text' => '&nbsp;' . $message );
		} else {
			$this->messages[] = array( 'params' => 'class="message_stack_error"', 'class' => $class, 'text' => '' . $message );
		}
    }

    function add_session( $class, $message, $type = '' ) {
    	if ( $type == 'error' ) {
			$this->messageToStack[] = array( 'params' => 'class="message_stack_error"', 'class' => $class, 'text' =>  '' . $message, 'type' => $type );
		} elseif ( $type == 'multierror' ) {
			$this->messageToStack[] = array( 'params' => 'class="message_stack_multierror"', 'class' => $class, 'text' => '&nbsp;' . $message, 'type' => $type );
		}else {
			$this->messageToStack[] = array( 'params' => 'class="message_stack_success"','class' => $class, 'text' => '' .$message, 'type' => $type );
		}
    }

    /*function add_session( $class, $message, $type = '' ) {
		$this->messageToStack[] = array( 'params' => 'class="message_stack_success"','class' => $class, 'text' => '' .$message, 'type' => $type );
    }*/
    function reset() {
		$this->messages = array();
    }

    function output( $class ) {
     
		$str = '';
		$output = array();
		for ( $i=0, $n=count( $this->messages ); $i<$n; $i++ ) {
			if ( $this->messages[$i]['class'] == $class ) {
				$output[] = $this->messages[$i];
			}
		}
      
		$len = count( $output );
		for ( $ii=0; $ii<$len; $ii++ ) {
			$str .= '<div ' . $output[$ii]['params'] . '>' . $output[$ii]['text'] . '</div>';
		}
    
		return $str;
    }

    function size($class) {
      
		$count = 0;

		for ( $i=0, $n=sizeof( $this->messages ); $i<$n; $i++ ) {
			if ( $this->messages[$i]['class'] == $class ) {
				$count++;
			}
		}

      return $count;
    }
}