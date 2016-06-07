<?php namespace davestewart\sketchpad\examples;

use davestewart\sketchpad\objects\SketchpadConfig;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\FileViewFinder;
use Illuminate\View\View;

/**
 * Get to know Sketchpad's basic functions
 *
 * @package App\Http\Controllers
 */
class BasicsController extends Controller
{

	/**
	 * Call a method just by clicking on its label
	 */
	public function simpleCall()
	{
		echo date(DATE_RFC850);
	}

	/**
	 * Defer a call by using the `deferred` tag in the method DocBlock. It will then only be called when you click "Run"
	 *
	 * @deferred
	 */
	public function deferredCall()
	{
		echo "Received call at " . date(DATE_RFC850);
	}

	/**
	 * Method parameters show in the UI as input fields, and re-call the method each time they're changed
	 *
	 * @param string $name
	 */
	public function parameters($name = 'world')
	{
		echo "Hello $name !";
	}

	/**
	 * Different paramater types render different controls
	 */
	public function parameterTypes($string = 'world', $number = 1, $bool = true)
	{
		vd(func_get_args());
	}

	/**
	 * If you type-hint your param docbocks, Sketchpad automatically casts values as they come in
	 *
	 * @param string $string    This is a string
	 * @param int    $number    This is a number
	 * @param bool   $bool      This is a bool
	 */
	public function parameterTypeConversion($string = 'world', $number = 1, $bool = true)
	{
		vd(func_get_args());
	}

	/**
	 * Sketchpad can post any forms you render using AJAX, and display the result
	 *
	 * @param Request $request
	 */
	public function postData(Request $request)
	{
		if($request->isMethod('post'))
		{
			$data = $request->get('data');
			echo "<p>You posted '$data'</p>";
		}
		else
		{
			?>
			<form action="?call=1" method="post">
				<label for="">Type something:</label>
				<input type="text" name="data">
			</form>
			<?php
		}
	}

	/**
	 * Sketchpad catches exceptions, shows you the full stack trace, and highlights the method in red until it's called again
	 */
	public function exception()
	{
		echo $a + $b;
	}

}