<?php
// This fixes https://github.com/slimphp/Slim/issues/359, respectively https://bugs.php.net/bug.php?id=61286
$_SERVER['SCRIPT_NAME'] = '/index.php';

require 'vendor/autoload.php';
require 'classes/autoload.php';

// Include the configuration
require_once(__DIR__ . '/../config/config.php');

// Setup the app
$app = new \Slim\App($config);

// Inject the database dependency
$container = $app->getContainer();
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    try {
        $db = new PDO($settings['type'] . ":dbname=" . $settings['name'] . ";host=" . $settings['host'] . ";port=" . strval($settings['port']), $settings['user'], $settings['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
        return $db;
    } catch (PDOException $e) {
        die('Connection to database failed.');
    }
};

$app->group('/domain', function () {
    $this->get('/{id}', function ($request, $response, $args) {
        // Get the domain with the exact name
        $stmt = $this->db->prepare("SELECT id,name,type FROM domains WHERE id=:id LIMIT 1");        

        $stmt->bindValue(':id', $args['id'], PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $stmt->bindColumn('id', $id, PDO::PARAM_INT);
            $stmt->bindColumn('name', $name);
            $stmt->bindColumn('type', $type);
            $stmt->fetch(PDO::FETCH_BOUND);
            
            $text = [
                'id'    => $id,
                'name'  => $name,
                'type'  => $type,
            ];
    
            $content = generateContent(true, $text);
            return $response->write($content);
        } else {
            $content = generateContent(false);
            return $response->write($content);
        }
        
    });
});

// There are no easter eggs in this API, what are you looking for?
$app->any('/_motivation/{name}', function ($request, $response, $args) {
    $response   = $response->withAddedHeader('x-awesomeness', '9001');
    $text       = 'Hey ' . $args['name'] . ', you\'re awesome!';
    $content    = generateContent(true, $text);
    return $response->write($content);
});

// json_encode your input and return it
function generateContent(bool $success, $value=null) {
    // Initialize $content and add values
    $content = new \stdClass();
    $content->success   = $success;
    if ($value) {
        $content->value     = $value;        
    }

    return json_encode($content); 
}

$app->run();
