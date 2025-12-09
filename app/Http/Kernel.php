protected $middlewareAliases = [
    // ... other middleware
    'official' => \App\Http\Middleware\EnsureUserIsOfficial::class,
];