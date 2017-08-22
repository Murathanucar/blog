<?php
/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 18.08.2017
 * Time: 10:12
 */

require_once  __DIR__ ."/vendor/autoload.php";

if($_POST){

    $article = new \src\controller\ArticleController();
    $article->insert($_POST);

}



?>
<form action="" method="POST">
    <table align="center">

        <tr>

            <td>Description</td>
            <td>:</td>
            <td><input type="text" name="description" id="description"></td>

        </tr>
        <tr>
            <td>Content</td>
            <td>:</td>
            <td><input type="text"  name="content" id="content"></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>:</td>

        <tr>
            <div id="categories">
                <td><input type="radio" name="category" value="1" checked>SANAT</td>

                <td><input type="radio" name="category" value="2">BİLİM</td>

                <td><input type="radio" name="category" value="3">SPOR</td>

                <td><input type="radio" name="category" value="4">OTOMOBİL</td>

                <td><input type="radio" name="category" value="5">UZAY</td>
            </div>

            <td><input type="submit" value="ADD"></td>
        </tr>
    </table>
</form>