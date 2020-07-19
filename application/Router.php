<?php
class Router
{
	private static $routes = Array();
	private static $pathNotFound = null;
	private static $methodNotAllowed = null;

	public static function add($expression, $function, $method = 'GET')
	{
		array_push(self::$routes, Array(
			'expression' => $expression,
			'function' => $function,
			'method' => $method
		));
	}

	public static function pathNotFound($function)
	{
		self::$pathNotFound = $function;
	}

	public static function methodNotAllowed($function)
	{
		self::$methodNotAllowed = $function;
	}

	public static function run($basepath = '', $case_matters = false, $trailing_slash_matters = true, $multimatch = false)
	{
		$basepath = rtrim($basepath, '/');
		$parsed_url = parse_url($_SERVER['REQUEST_URI']);
		$path = '/';

		if (isset($parsed_url['path'])) 
		{
			if ($trailing_slash_matters) 
			{
				$path = $parsed_url['path'];
			} 
			else 
			{
				if ($basepath.'/'!=$parsed_url['path']) 
				{
					$path = rtrim($parsed_url['path'], '/');
				} 
				else 
				{
					$path = $parsed_url['path'];
				}
			}
		}

		$method = $_SERVER['REQUEST_METHOD'];
		$path_match_found = false;
		$route_match_found = false;

		foreach (self::$routes as $route) 
		{

			if ($basepath != '' && $basepath != '/') 
			{
				$route['expression'] = '(' . $basepath . ')' . $route['expression'];
			}

			$route['expression'] = '^' . $route['expression'];
			$route['expression'] = $route['expression'] . '$';

			if (preg_match('#' . $route['expression'] . '#' . ($case_matters ? '' : 'i'), $path, $matches))
			{
				$path_match_found = true;

				foreach ((array)$route['method'] as $allowedMethod) 
				{
					if (strtolower($method) == strtolower($allowedMethod)) 
					{
						array_shift($matches);

						if ($basepath != '' && $basepath != '/') 
						{
							array_shift($matches);
						}

						call_user_func_array($route['function'], $matches);
						$route_match_found = true;

						break;
					}
				}
			}

			if ($route_match_found && !$multimatch)
			{
				break;
			}
		}

		if (!$route_match_found) 
		{
			if ($path_match_found)
			{
				if (self::$methodNotAllowed) 
				{
					call_user_func_array(self::$methodNotAllowed, Array($path,$method));
				}
			} 
			else 
			{
				if (self::$pathNotFound) 
				{
					call_user_func_array(self::$pathNotFound, Array($path));
				}
			}

		}
	}
}
?>