<?php
ini_set('display_errors', 1);

    class LearningPath {
        // Path properties
        private $pathName;
        private $pathCreator;
        private $pathDescription;
        private $pathResources;

        // Constructor
        public function __construct($name, $creator, $desc, $resources)
        {
            $this->pathName = $name;
            $this->pathCreator = $creator;
            $this->pathDescription = $desc;
            $this->pathResources = $resources;
        }

        // Getter
        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }
        // Setter
        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

//     $resource = array(
//         'Resource 1' => new Resources('Test', 'www.test.com'),
//         'Resource 2' => new Resources('Test2', 'www.test2.com')
//      );
//     $objTest = new LearningPath('PHP', 'Jay', 'Test desc.', $resource);

        // echo "Path Name: " . $objTest->__get('pathName') . "<br>";
        // echo "Path Creator: " . $objTest->__get('pathCreator') . "<br>";
        // echo "Path Description: " . $objTest->__get('pathDescription') . "<br>";
        // echo "Path Resource 1 Name: " . $objTest->__get('pathResources')['Resource 1']->__get('resourceName') . "<br>";
        // echo "Path Resource 1 URL: " . $objTest->__get('pathResources')['Resource 1']->__get('resourceUrl') . "<br>";
        // echo "Path Resource 2 Name: " . $objTest->__get('pathResources')['Resource 2']->__get('resourceName') . "<br>";
        // echo "Path Resource 2 URL: " . $objTest->__get('pathResources')['Resource 2']->__get('resourceUrl') . "<br>";
        // echo "<br>";
        // echo "<pre>"; print_r($objTest); echo "<pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Learning Paths</h1>
    <?php 
        // Add existing learning paths to a variable.
        $paths = file_get_contents("LearningPaths.txt");
        
        
    
    ?>
</body>
</html>
