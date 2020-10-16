<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'asks' => 'c,r,u,d',
            'revisions' => 'c,r,u,d',
            'courses' => 'c,r,u,d',
            'students' => 'c,r,u,d',
            'levels' => 'c,r,u,d',
            'exams' => 'c,r,u,d',
            
            
           
        ],
        'administrator' => [
            'users' => 'r',
            'categories' => 'r',
            'courses' => 'r',
            'asks' => 'r',
            'revisions' => 'r',
            'students' => 'r,u',
            'levels' => 'r,u',
            'exams' => 'r,u',
            'profile' => 'r,u'
        ],
        
        'user' => [
            'profile' => 'r,u'
        ],
        
        
        'adminuser' => [
            'users' => 'c,r,u'
        ],
        
        'admincategory' => [
            'categories' => 'c,r,u'
        ],
        'admincourse' => [
            'courses' => 'c,r,u'
        ],
        'adminask' => [
            'asks' => 'c,r,u'
        ],
        'adminrevision' => [
            'revisions' => 'c,r,u'
        ],
        
    ],
    
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
