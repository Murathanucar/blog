<?php
$routers = [
    "select" => [
        "url" => "/select",
        "class" => "Article",
        "action" => "select",
        "template" => "select.twig"
    ],
    "admin" => [
        "url" => "/admin",
        "class" => "Admin",
        "action" => "admin",
        "template" => "admin.twig"
    ],

    "login" => [
        "url" => "/login$",
        "class" => "User",
        "action" => "adminSelect",
        "template" => "login.twig"
    ],
    "login_action" => [
        "url" => "/login_action(.*)",
        "class" => "User",
        "action" => "loginAction",
        "template" => "login_action.twig"
    ],
    "insertArticle" => [
        "url" => "/insert",
        "class" => "AdminArticle",
        "action" => "insertArticle",
        "template" => "insertArticle.twig"
    ],
    "deletetArticle" => [
        "url" => "/deleteArticle/(\d+)",
        "class" => "AdminArticle",
        "action" => "deleteArticle",
        "template" => "deleteArticle.twig"
    ],
    "updateArticle" => [
        "url" => "/updateArticle/(\d+)",
        "class" => "AdminArticle",
        "action" => "updateArticle",
        "template" => "updateArticle.twig"
    ],
    "admin_login_post" => [
        "url" => "/admin/login-post",
        "class" => "User",
        "action" => "loginPost",
        "template" => "empty.twig"
    ],
    "member_export" => [
        "url" => "/blog/member/export",
        "class" => "Member",
        "action" => "export",
        "template" => "member.export.twig"
    ],
    "blog_post" => [
        "url" => "/blog/post",
        "class" => "Article",
        "action" => "select",
        "template" => "post.twig"
    ],
    "delete" => [
        "url" => "/delete",
        "class" => "Article",
        "action" => "delete",
        "template" => "delete.twig"
    ],

    "update" => [
        "url" => "/update",
        "class" => "Article",
        "action" => "update",
        "template" => "update.twig"
    ],

    "get_article_category" => [
        "url" => "/get_article_category",
        "class" => "Article",
        "action" => "getCategory",
        "template" => "get_category.twig"
    ],
    "get_found_search" => [
        "url" => "/get_found_search",
         "class" => "Article",
        "action"=> "getSearch",
        "template" => "get_found.twig"
    ],
    "admin_check" => [
        "url" => "/",
        "class" => "User",
        "action"=> "adminSelect",
        "template" => "admin_check.twig"
    ],


];