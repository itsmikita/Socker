<?php

class __Mustache_c0aa68f07f66bbaa6c031061af6a0008 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $newContext = array();

        $buffer .= $indent . '<!doctype html>
';
        $buffer .= $indent . '<html ';
        $value = $this->resolveValue($context->find('language_attributes '), $context, $indent);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= '>
';
        $buffer .= $indent . '	<head>
';
        $buffer .= $indent . '		<meta charset="utf-8">
';
        $buffer .= $indent . '		<meta http-equiv="x-ua-compatible" content="ie=edge">
';
        $buffer .= $indent . '		<meta name="viewport" content="width=device-width, initial-scale=1">
';
        $buffer .= $indent . '		
';
        $buffer .= $indent . '		<title>';
        $value = $this->resolveValue($context->find('title'), $context, $indent);
        $buffer .= $value;
        $buffer .= '</title>
';
        $buffer .= $indent . '		
';
        // 'styles' section
        $value = $context->find('styles');
        $buffer .= $this->sectionE8255ef6000abe1cda6cb2c91dc34c2d($context, $indent, $value);
        $buffer .= $indent . '		
';
        // 'scripts' section
        $value = $context->find('scripts');
        $buffer .= $this->sectionB77945fb6f44fcdd271c5b90da65a68c($context, $indent, $value);
        $buffer .= $indent . '		
';
        $buffer .= $indent . '		';
        $value = $this->resolveValue($context->find('head'), $context, $indent);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '	</head>
';
        $buffer .= $indent . '	<body ';
        $value = $this->resolveValue($context->find('body_class'), $context, $indent);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= '>
';
        $buffer .= $indent . '		<h1>Hello!</h1>
';
        $buffer .= $indent . '		<p>I\'m Toolbox.php.</p>
';
        $buffer .= $indent . '		
';
        $buffer .= $indent . '		';
        $value = $this->resolveValue($context->find('footer'), $context, $indent);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '	</body>
';
        $buffer .= $indent . '</html>
';
        $buffer .= $indent . '	
';
        $buffer .= $indent . '	
';
        $buffer .= $indent . '	';

        return $buffer;
    }

    private function sectionE8255ef6000abe1cda6cb2c91dc34c2d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
		<link rel="stylesheet" href="{{ . }}">
		';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '		<link rel="stylesheet" href="';
                $value = $this->resolveValue($context->findDot(' .'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '">
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB77945fb6f44fcdd271c5b90da65a68c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
		<script src="{{ . }}"></script>
		';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '		<script src="';
                $value = $this->resolveValue($context->findDot(' .'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '"></script>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }
}
