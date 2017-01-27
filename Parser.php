<?php

namespace nastradamus39\slate;

use nastradamus39\slate\annotations\Action;
use nastradamus39\slate\annotations\Content;
use nastradamus39\slate\annotations\Controller;
use nastradamus39\slate\md\Md;
use nastradamus39\slate\md\MdAction;
use nastradamus39\slate\md\MdContent;
use nastradamus39\slate\md\MdController;

use Doctrine\Common\Annotations\AnnotationReader;

class Parser
{

    private $_parsePath;

    private $_buildPath;

    private $_md;

    public function __construct($parsePath, $buildPath)
    {
        if(empty($parsePath) || empty($buildPath)) {
            throw new \Exception("Empty directory for parse");
        } else {
            $this->_buildPath = $buildPath;
            $this->_parsePath = $parsePath;
            $this->_md = new Md();
        }
    }

    public function parse() {

        $_files = array_diff(scandir($this->_parsePath), array('..', '.'));

        foreach( $_files as $file) {
            if( is_file($this->_parsePath.DIRECTORY_SEPARATOR.$file ) && $this->_isPhpFile($file) ) {
                $ctrl = $this->_parseFile($file);
                if(!empty($ctrl)) {
                    $this->_md->addController($ctrl);
                }
            }
        }

        $this->_md->save($this->_buildPath.DIRECTORY_SEPARATOR."index.html.md");
    }

    private function _parseFile($file) {

        require_once $this->_parsePath.DIRECTORY_SEPARATOR.$file;
        $className = explode(".",$file)[0];

        if(class_exists($className)) {

            $classAnnotations = $this->_fetchClassAnnotations($className);
            $methodsAnnotations = $this->_fetchMethodsAnnotations($className);

            if($classAnnotations){

                /** Parse controller annotations */
                $mdController = new MdController();
                foreach($classAnnotations as $annotation) {
                    if($annotation instanceof Controller) {
                        $mdController->title = $annotation->title;
                        $mdController->description = $annotation->description;
                    }
                    if($annotation instanceof Content) {
                        $mdContent = new MdContent();
                        $mdContent->title = $annotation->title;
                        $mdContent->description = $annotation->description;
                        $this->_md->addContent($mdContent);
                    }
                }

                foreach($methodsAnnotations as $annotation) {
                    if($annotation instanceof Action) {
                        $mdAction = new MdAction();
                        $mdAction->title = $annotation->title;
                        $mdAction->description = $annotation->description;
                        $mdAction->request = $annotation->request;
                        $mdAction->params = $annotation->params;
                        $mdController->addAction($mdAction);
                    }
                    if($annotation instanceof Content) {
                        $mdContent = new MdContent();
                        $mdContent->title = $annotation->title;
                        $mdContent->description = $annotation->description;
                        $this->_md->addContent($mdContent);
                    }
                }

                return $mdController;

            } else {
                return null;
            }

        } else {
            return null;
        }
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