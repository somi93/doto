var app = angular.module('doto', [])
    .constant("CSRF_TOKEN", '{{ csrf_token() }}')
    .constant('BASE_URL', 'http://localhost:8000/');