<?php
// Routes
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    // Render index view
    return $this->renderer->render('index.html', $args);
});

//$app->get('/', 'Index:index')->setName('hello');