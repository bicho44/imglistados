<?php defined('SYSPATH') or die('No direct script access.');

/*======================================

Ajaxval Formo Plugin by Jussi Tulisalo

Automated Ajax validation (element-based)

Uses:

 - jQuery (tested on jQuery v. 1.3.2)	http://www.jquery.com
 - jQuery Form Plugin	http://malsup.com/jquery/form/#download
  
 * scripts aren't included, so you have to add them yourself

Methods added:

$form->no_ajax():

You can remove form's (or elements') ajax functionality.
Passing no argument removes it completely for that form.
You can pass an array/string of elements too.
(commas and pipes allowed, eg. $form->no_ajax('title|username|something') )

NOTICE!

You have to disable auto-rendering of views (if in use) for ajax calls.
In main controller's construct:

		if(request::is_ajax())
		{
			$this->auto_render = FALSE;
		}

======================================*/

class Formo_ajaxval {
	
	public $form;
	static protected $script_already_added;
	public $valid_message = 'OK';
	public $message_class = 'ajax_validation';
	public $valid_class = 'success';
	public $error_class = 'error';
	protected $captcha;
	
	// path to your errors in Kohana::lang()
	public $i18n_errors = 'formo.errors.';
	
	public function __construct( & $form)
	{
		$this->form = $form;
		
		// do the jQuery script rendering only once
		if (self::$script_already_added == false) {		
			Event::add('system.display', array($this,'add_jquery'));
            self::$script_already_added = true;
        }
		
		// add possibility to remove ajax functionality
		$this->form->add_function('no_ajax', array($this,'no_ajax'));
		
		Event::add('formoel.add', array($this, 'mark_required'));
		
		if(request::is_ajax())
		{
			Event::add('formoel.post_validate', array($this, 'ajax_validation'));		
		}
	}
	
	public static function load( & $form)
	{
		return new Formo_ajaxval($form);
	}
	
	/**
	 * Removes Ajax functionality (marks form/element(s) with class 'no_ajax')
	 *
	 * @param   empty,string,array   elements to mark
	 */
	public function no_ajax($elements = NULL)
	{
		if(!$elements)
		{		
			foreach($this->form->find_elements() as $element)
			{
				$this->form->{$element}->class .= ' no_ajax';
			}
			
			return $this->form;
		}
		
		$elements = (func_num_args() > 1) ? func_get_args() : $this->form->splitby($elements);
				
		foreach($elements as $element)
		{
			$this->form->{$element}->class .= ' no_ajax';
		}
		
		return $this->form;
	}
	
	// mark required elements with a class 'required'
	public function mark_required()
	{
		$element = Event::$data;
				
		if($element->required AND !strpos($element->class, 'required'))
		{
			$element->class .= ' required';
		}
	}
	
	// appends jQuery script to <body> tag
	public function add_jquery()
	{
		$current_url = url::site(url::current());
		$script = <<<EOT
<script type="text/javascript">
$(document).ready(function(){	
	var elements = $('input:not(:hidden, :submit, #captcha, [class*=no_ajax]), textarea:not(.no_ajax), select:not(.no_ajax)');
	
	// add a span element to all inputs for the ajax messages
	
	$($('<span class="$this->message_class"></span>')).insertAfter(elements);
						
	// on change event, validate element using current url & element's name / value
	$(elements).change(function(){
		
		var element = $(this);

		// add a loading class to the element, and remove it after ajax call
		element.addClass('loading').ajaxStop(function(){
			element.removeClass('loading');
		});
		
		$(this).parents('form').ajaxSubmit({
			url: '$current_url?element='+element.attr('name'),
			success: function(data){
				
				data = jQuery.trim(data);

				var message = element.next('span.$this->message_class');

				// if an error message is present, remove it
				$('span[class*=error]',element.parents('p')).not(message).remove();
																			
				if(data) // if error
				{
					message.text(data)
						.removeClass()
						.addClass('$this->message_class $this->error_class');
				}
				else // if valid
				{
					message.text('$this->valid_message')
						.removeClass()
						.addClass('$this->message_class $this->valid_class');
				}
				
			}
		});
	});
	
	// on blur event, validate all required elements that are empty
	$('form .required').blur(function(){
		
		if($(this).val() == '')
		{
			$(this).change();
		}
	});
});
</script>
EOT;
				
		Event::$data = str_replace("</body>", $script . " </body>", Event::$data);
	}	
	
	// returns error message or null if valid
	public function ajax_validation()
	{
		$element = Event::$data;
		
		// if element is what we are looking for
		if($element->name == $_GET['element'])
		{
			// return error / success
			die($element->error);
		}
	}		
}