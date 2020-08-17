<?php
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

$message=null;

$args = [
    'title'=>FILTER_SANITIZE_STRING, //strips HMTL
    'meta_description'=>FILTER_SANITIZE_STRING, //strips HMTL
    'meta_keywords'=>FILTER_SANITIZE_STRING, //strips HMTL
    'body'=>FILTER_UNSAFE_RAW  //NULL FILTER
];

$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){

    //Strip white space, begining and end
    $input = array_map('trim', $input);

    //Allow only whitelisted HTML
    $input['body'] = cleanHTML($input['body']);

    //Create the slug
    $slug = slug($input['title']);

    //Sanitiezed insert
    $sql = 'INSERT INTO posts SET id=uuid(), title=?, slug=?, body=?';

    if($pdo->prepare($sql)->execute([
        $input['title'],
        $slug,
        $input['body']
    ])){
       header('LOCATION:/posts');
    }else{
        $message = 'Something bad happened';
    }
}

$content = <<<EOT
<h1>Confirm to delete post</h1>
{$message}
<form method="post">

<div class="form-group">
    <label for="title">Username</label>
    <input id="title" name="title" type="text" class="form-control">
</div>

<div class="form-group">
    <label for="body">Short description</label>
    <textarea id="body" name="body" rows="3" class="form-control"></textarea>
</div>

<div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary">
</div>
</form>
EOT;

include '../../core/layout.php';