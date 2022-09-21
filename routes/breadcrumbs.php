<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Kategorije;

/**
 * Names for Breadcrumbs are Same as defined in routes/web.php
 * for adding new Breadcrumb, create function with same route name as in web
 * after adding function render in blade like Breadcrumbs::render('{route.name}, {variables for route}')
 */

// Homepage
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Category/Subcategory
Breadcrumbs::for('category.index', function (BreadcrumbTrail $trail, Kategorije $category) {
    if ($category->kategorije) {
        $trail->parent('category.index', $category->kategorije);
    } else {
        $trail->parent('home');
    }
    $trail->push($category->tip, route('category.index', $category->slug));
});

// Product
Breadcrumbs::for('product.index', function (BreadcrumbTrail $trail, Kategorije $category) {
    if ($category->kategorije) {
        $trail->parent('category.index', $category->kategorije);
    } else {
        $trail->parent('home');
    }
    $trail->push($category->tip, route('category.index', $category->slug));
});

// Search
Breadcrumbs::for('search', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Search', route('search'));
});

// Register
Breadcrumbs::for('register', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Register', route('register'));
});

// Company
Breadcrumbs::for('company.index', function (BreadcrumbTrail $trail, \App\Models\CustomersCategory $category) {
    $trail->parent('home');
    $trail->push($category->cc_name, asset('company/category/' . $category->slug));
});
