angular.module('website', []).
    config(function($routeProvider) {
        $routeProvider.
            when('/about', {template:'partials/about.html'}).
            when('/experiments', {template:'partials/experiments.html'}).
            when('/home', {template:'partials/home.html'}).
            otherwise({redirectTo:'/home'});
    });