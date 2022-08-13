<?php
$host = 'localhost';
$user = 'root';
$password = '12345';
$dbname = 'pdoposts';

//set DNS

$dsn = 'mysql:host='. $host . ';dbname='. $dbname;


//create PDO instance
$connection = new PDO($dsn, $user, $password);
$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);//set to default object


#PDO QUERY

/*
$stmt = $connection->query('SELECT * FROM posts');

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){//override as assoc array
    echo $row['title']. '<br>';
}
*/
# PREPARE STATEMENTS(PREPARE 6 EXECUTE)

/*-----NOT SO GOOD METHOD----*/

//$sql = "SELECT * FROM posts WHERE author = '$author'";

//FECTH MULTIPLE POSTS

/*----User Input----*/

$author = 'Ines';
$is_published = true;
$id = 1;

//Positional Params --->placeholder----> ?
/*
$sql = 'SELECT * FROM posts WHERE author = ?';
$stmt = $connection->prepare($sql);//prepare statement
$stmt->execute([$author]);
$posts = $stmt->fetchAll();
*/
//var_dump($posts);//show whats inside var post

/*-----Named Params---------*/

/* 
$sql = 'SELECT * FROM posts WHERE author = :author && is_published = :is_published';
$stmt = $connection->prepare($sql);//prepare statement
$stmt->execute(['author' => $author, 'is_published' => $is_published]);
$posts = $stmt->fetchAll();
//var_dump($posts);
foreach($posts as $post){//loop
    echo $post->title . '<br>';
} 
 */

/*---------FETCH SINGLE POST----*/

/* 
$sql = 'SELECT * FROM posts WHERE id = ?';
$stmt = $connection->prepare($sql);//prepare statement
$stmt->execute([$id]);
$post = $stmt->fetch();
echo $post->body . '<br>';
*/

/*--------GET TABLE ROW COUNT----*/

/* 
$stmt = $connection->prepare('SELECT * FROM POSTS WHERE author = ?');
$stmt->execute([$author]);
$postCount = $stmt->rowCount();
echo $postCount; 
*/

/*----------INSERT DATA---------*/

/* $title = 'Post Five';
$body = 'This is post five';
$author = 'Kevin';

$sql = 'INSERT INTO posts(title, body, author) VALUES(:title, :body, :author)';
$stmt = $connection->prepare($sql);
$stmt->execute(['title' => $title, 'body' => $body, 'author' => $author]);

echo 'Post Added';
 */

/*--------UPDATE DATA-----------*/

/* 
$id = 1;
$body = 'This is the updated post';


$sql = 'UPDATE posts SET body = :body WHERE id= :id';
$stmt = $connection->prepare($sql);
$stmt->execute(['body' => $body, 'id' => $id]);
echo 'Post Updated'; 
*/

/*-----------DELETE DATA---------*/

/* $id =3;
$sql ='DELETE FROM posts WHERE id= :id';
$stmt=$connection->prepare($sql);
$stmt->execute(['id'=> $id]);
echo 'Post Deleted';
 */

/*-----------SEARCH DATA------------*/

$search ="%f%";

$sql = 'SELECT * FROM posts WHERE title LIKE ?';
$stmt = $connection->prepare($sql);
$stmt->execute([$search]);
$posts = $stmt->fetchall();

foreach($posts as $post){
    echo $post->title . '<br>';
}