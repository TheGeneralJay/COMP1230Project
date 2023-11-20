<?php
// Protects page from unwanted HTML code injections.
echo htmlspecialchars($_SERVER['PHP_SELF']);

// Set variables to global.
global $pathName, $pathUser, $pathDescription, $pathResources;

// If the user submits the form...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the name, user, desc, resources are set...
    if (isset($_POST['path_name']) && isset($_POST['path_desc']) && isset($_POST['given_resources1'])) {
        // Pull values from the form.
        $pathName = $_POST['path_name'];
        //$pathUser = $loadingFName;
        $pathDescription = $_POST['path_desc'];
        $pathResources = array();

        // Pull from counter element to push the array.
        if (isset($_POST['counter'])) {
            $counter = $_POST['counter'];
            for ($i = 1; $i < $counter; $i++) {
                // For as many resources as there are, push each resource to an array.
                array_push($pathResources, $_POST['given_resources' . $i]);
            }
        }
    }

    // Place variables into learning path object.
    // $paths = array();
    // array_push($paths, new LearningPath($pathName, 'Jay', $pathDescription));

    // Function to place resources in DB.
    pushResources($pathUser, $pathName, $pathDescription, $pathResources);
}

// Push resources function.
function pushResources($pathUser, $pathName, $pathDescription, $pathResources) {
    // DB info.
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "learning_paths";
    // Connection info.
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    // Separate elements into comma separated list.
    $resourceString = implode(',', $pathResources);

    // Query variables/queries.

    // ******* RESOURCE ID MANAGEMENT ********
    // Grab existing resource IDs.
    $sqlSelectResourceId = "SELECT resource_id FROM resources;";
    $existingResourceIds = mysqli_query($conn, $sqlSelectResourceId);
    
    // New resource id.
    $newResourceId = 1;
    // Existing resource ids.
    $resourceIds = array();
    while ($row = mysqli_fetch_assoc($existingResourceIds)) {
        array_push($resourceIds, $row['resource_id']);
    }

    // For as many resource ids that exist...
    for ($i = 0; $i < count($resourceIds); $i++) {
        if ($resourceIds[$i] == $newResourceId) {
            $newResourceId++;
        } 
    }

    // ******* PATH ID MANAGEMENT ********
    // Grab existing path IDs.
    $sqlSelectPathIds = "SELECT path_id FROM paths";
    $existingPathIds = mysqli_query($conn, $sqlSelectPathIds);
    
    // New path id.
    $newPathId = 1;
    // Existing path ids.
    $pathIds = array();
    while ($row = mysqli_fetch_assoc($existingPathIds)) {
        array_push($pathIds, $row['path_id']);
    }

    // For as many path ids that exist...
    for ($i = 0; $i < count($pathIds); $i++) {
        if ($pathIds[$i] == $newPathId) {
            $newPathId++;
        }
    }

    // Insert queries.
    $sqlPathInsert = "INSERT INTO paths (user_id, path_name, path_desc, resources_id)
                      VALUES (1, '$pathName', '$pathDescription', '$newResourceId');";

    $sqlResourceInsert = "INSERT INTO resources (path_id, resource_list)
                          VALUES ('$newPathId', '$resourceString')";
    
    mysqli_query($conn, $sqlPathInsert);
    mysqli_query($conn, $sqlResourceInsert);
}
// Show resources function.
function showResources($pathId) {
    // DB info.
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "learning_paths";
    // Connection info.
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    // Queries.
    $sqlSelectPaths = "SELECT * FROM paths p 
                       JOIN resources r ON p.resources_id = r.resource_id
                       WHERE p.path_id = $pathId";

    $selectPathsResult = mysqli_query($conn, $sqlSelectPaths);

    // Go through each row, split resources, grab path info.
    while ($row = mysqli_fetch_assoc($selectPathsResult)) {
        // Split resources.
        $resourceString = $row['resource_list'];
        $resourceArray = explode(',', $resourceString);

        // Path name.
        $givenPathName = $row['path_name'];

        // User name.
        $givenUserName = "Jay";

        // Path description.
        $givenPathDesc = $row['path_desc'];
    }


    echo "<h3>Path Name:</h3> $givenPathName <br>";
    echo "<h3>Path User:</h3> $givenUserName <br>";
    echo "<h3>Path Description:</h3> $givenPathDesc <br>";
    echo "<h3>Resources:</h3><br>";
    // Cycle through each resource.
    for ($i = 0; $i < count($resourceArray); $i++) {
        echo "$resourceArray[$i] <br>";
    }
}
// Delete path function.
function deletePath($pathId, $resourceId) {
        // DB info.
        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "learning_paths";
        // Connection info.
        $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

        // Sql queries.
        $sqlDeletePath = "DELETE FROM paths WHERE path_id = $pathId;";
        $sqlDeleteResources = "DELETE FROM resources WHERE resource_id = $resourceId;";

        mysqli_query($conn, $sqlDeletePath);
        mysqli_query($conn, $sqlDeleteResources);
}

// Learning path class/object.
// class LearningPath {
//     // Path properties
//     private $pathName;
//     private $pathCreator;
//     private $pathDescription;

//     // Constructor
//     public function __construct($name, $creator, $desc)
//     {
//         $this->pathName = $name;
//         $this->pathCreator = $creator;
//         $this->pathDescription = $desc;
//     }

//     // Getter
//     public function __get($property) {
//         if (property_exists($this, $property)) {
//             return $this->$property;
//         }
//     }
//     // Setter
//     public function __set($property, $value) {
//         if (property_exists($this, $property)) {
//             $this->$property = $value;
//         }
//     }
// }