<?php

namespace ruvents\slate;

use ruvents\slate\annotations\ApiAction;
use ruvents\slate\annotations\ApiContent;
use ruvents\slate\annotations\ApiController;
use ruvents\slate\annotations\ApiError;
use ruvents\slate\annotations\ApiObject;
use ruvents\slate\md\Md;
use ruvents\slate\md\MdConfig;
use ruvents\slate\md\Action as MdAction;
use ruvents\slate\parser\Content as ContentParser;
use ruvents\slate\parser\Error as ErrorParser;
use ruvents\slate\parser\Controller as ControllerParser;
use ruvents\slate\parser\Action as ActionParser;
use ruvents\slate\parser\Obj as ObjParser;

use Doctrine\Common\Annotations\AnnotationReader;

class Parser
{

    private $_parsePath;

    private $_buildPath;

    private $_md;

    private function bootstrap($dir=null)
    {
        if(!is_null($dir) && is_dir($dir)) {
            array_walk(array_diff(scandir($dir), array('..', '.')), function ($file) use ($dir) {
                if(is_file($dir.$file)) {
                    require_once $dir.$file;
                }
                if( is_dir($dir.$file)) {
                    $this->bootstrap($dir.$file."/");
                }
            });
        } else {
            $this->bootstrap(__DIR__."/annotations/");
        }
    }

    public function __construct($parsePath, $buildPath, $params = [])
    {
        $this->bootstrap();

        if(empty($parsePath) || empty($buildPath)) {
            throw new \Exception("Empty directory for parse");
        } else {
            $this->_buildPath = $buildPath;
            $this->_parsePath = $parsePath;
            $this->_md = new Md();

            if(!empty($params)) {
                $config = MdConfig::getInstance();
                $config->params = $params;
            }

            if( !empty($params['vars']) ) $this->_md->vars = $params['vars'];
        }
    }

    public function parse($dir=null) {
        if(is_null($dir)) {
            $this->parse($this->_parsePath);
            $this->_md->save($this->_buildPath.DIRECTORY_SEPARATOR."index.html.md");
        } else {
            $_files = array_diff(scandir($dir), array('..', '.'));
            foreach( $_files as $file) {
                if( is_file($dir.DIRECTORY_SEPARATOR.$file ) && $this->_isPhpFile($file) ) {
                    $this->_parseFile($dir.DIRECTORY_SEPARATOR.$file);
                }
                if(is_dir($dir.DIRECTORY_SEPARATOR.$file)) {
                    $this->parse($dir.DIRECTORY_SEPARATOR.$file);
                }
            }
        }
    }

    private function _parseFile($file) {

        $className = '';
        if(is_file($file)) {
            require_once $file;
            $className = $this->_getClassName($file);
        }

        if(class_exists($className)) {

            $classAnnotations = $this->_fetchClassAnnotations($className);
            $methodAnnotation = $this->_fetchMethodsAnnotations($className);

            // parse class annotations
            if(!empty($classAnnotations)) {
                foreach ($classAnnotations as $annotation) {
                    if($annotation instanceof ApiController) {
                        $md = (new ControllerParser())->parse($annotation);
                        $this->_md->addController($md);
                    }
                    if($annotation instanceof ApiContent) {
                        $md = (new ContentParser())->parse($annotation);
                        $this->_md->addContent($md);
                    }
                    if($annotation instanceof ApiObject) {
                        $md = (new ObjParser())->parse($annotation);
                        $this->_md->addObject($md);
                    }
                    if($annotation instanceof ApiError) {
                        $md = (new ErrorParser())->parse($annotation);
                        $this->_md->addError($md);
                    }
                }
            }

            // parse methods annotations
            if(!empty($methodAnnotation)) {
                foreach ($methodAnnotation as $annotation) {
                    if($annotation instanceof ApiAction) {
                        $md = (new ActionParser())->parse($annotation);
                        $this->_md->addAction($md);
                    }
                }
            }

        }
    }

    private function _getClassName($path_to_file)
    {
        $contents = file_get_contents($path_to_file);
        $namespace = $class = "";
        $getting_namespace = $getting_class = false;

        foreach (token_get_all($contents) as $token) {

            if (is_array($token) && $token[0] == T_NAMESPACE) {
                $getting_namespace = true;
            }

            if (is_array($token) && $token[0] == T_CLASS) {
                $getting_class = true;
            }

            if ($getting_namespace === true) {
                if(is_array($token) && in_array($token[0], [T_STRING, T_NS_SEPARATOR])) {
                    $namespace .= $token[1];
                }
                else if ($token === ';') {
                    $getting_namespace = false;
                }
            }

            if ($getting_class === true) {
                if(is_array($token) && $token[0] == T_STRING) {
                    $class = $token[1];
                    break;
                }
            }
        }

        return $namespace ? $namespace . '\\' . $class : $class;
    }

    private function _fetchMethodsAnnotations($className)
    {
        $reader = new AnnotationReader();
        $classReflector = new \ReflectionClass($className);
        $methods = $classReflector->getMethods(\ReflectionMethod::IS_PUBLIC);
        $methodsAnnotations = [];
        foreach($methods as $method){
            $reflectedMethod = new \ReflectionMethod($className, $method->name);
            $annotations = $reader->getMethodAnnotations($reflectedMethod);
            if(!empty($annotations)) {
                foreach($annotations as $annotation) $methodsAnnotations[] = $annotation;
            }
        }
        return $methodsAnnotations;
    }

    private function _fetchClassAnnotations($className)
    {
        $classReflector = new \ReflectionClass($className);
        $reader = new AnnotationReader();
        $classAnnotations = $reader->getClassAnnotations($classReflector);
        return $classAnnotations;
    }

    private function _isPhpFile($file)
    {
        if (preg_match("/^.*?\.php$/", $file)) {
            return true;
        } else {
            return false;
        }
    }

}
