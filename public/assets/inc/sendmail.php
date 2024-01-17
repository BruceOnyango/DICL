<?php
//use Symfony\Component\Yaml\Yaml;
//require_once __DIR__ . '/vendor/autoload.php';
//require __DIR__.'/../vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $message = isset($_POST["message"]) ? $_POST["message"] : "";

    //$rootDirectory = base_path();

    if (!empty($name) && !empty($email) && !empty($message)) {
        // Create an array with the form data
        $data = [
            
            "name" => $name,  // You can use the name as the entry title
            "email" => $email,
            "message" => $message,
            "updated_at" => date("Y-m-d H:i:s"),
            "created_at" => date("Y-m-d H:i:s")//
        ];

        // Define a directory to store YAML files
        $yamlDirectory = __DIR__; // Change to your desired directory name

        // Ensure the directory exists, create it if not //content\collections\contact
      
        // Generate a unique YAML file name based on a timestamp
        $yamlFileName = '../../../content/collections/contact'  . '/'.$name . '_' . time() . '.md';

        // Convert data to YAML manually
        $yamlContent = "--- \n";
        $yamlContent .= "blueprint: contact \n";
        $yamlContent .= "title: " . $data['name'] . "\n";
        $yamlContent .= "email: " . $data['email'] . "\n";
        $yamlContent .= "message: " . $data['message'] . "\n";
        $yamlContent .= "updated_at: " . $data['updated_at'] . "\n";
        $yamlContent .= "created_at: " . $data['created_at'] . "\n";
        $yamlContent .= "---";

        // Generate a unique YAML file name based on a timestamp
        //$yamlFileName = $yamlDirectory . '/' . $name . '_' . time() . '.yaml';

        // Save the data to the generated YAML file
       // $yamlContent = Yaml::dump($data);
        file_put_contents($yamlFileName, $yamlContent);

        // Respond with a success message
        echo "Success! Message saved in YAML file: $yamlFileName";
    } else {
        // Handle form validation errors
        echo "Please fill in all required fields.";
    }
} else {
    // Handle non-POST requests (e.g., direct access to the script)
    echo "Invalid request.";
}
?>
