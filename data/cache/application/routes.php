<?php
return [
  0 => [
    'route' => '/Activities/:parentType/:id/:type',
    'method' => 'get',
    'actionClassName' => 'Espo\\Modules\\Crm\\Tools\\Activities\\Api\\Get',
    'adjustedRoute' => '/Activities/{parentType}/{id}/{type}'
  ],
  1 => [
    'route' => '/Activities/:parentType/:id/:type/list/:targetType',
    'method' => 'get',
    'actionClassName' => 'Espo\\Modules\\Crm\\Tools\\Activities\\Api\\GetListTyped',
    'adjustedRoute' => '/Activities/{parentType}/{id}/{type}/list/{targetType}'
  ],
  2 => [
    'route' => '/Activities/upcoming',
    'method' => 'get',
    'actionClassName' => 'Espo\\Modules\\Crm\\Tools\\Activities\\Api\\GetUpcoming',
    'adjustedRoute' => '/Activities/upcoming'
  ],
  3 => [
    'route' => '/Activities',
    'method' => 'get',
    'actionClassName' => 'Espo\\Modules\\Crm\\Tools\\Calendar\\Api\\GetCalendar',
    'adjustedRoute' => '/Activities'
  ],
  4 => [
    'route' => '/Timeline',
    'method' => 'get',
    'actionClassName' => 'Espo\\Modules\\Crm\\Tools\\Calendar\\Api\\GetTimeline',
    'adjustedRoute' => '/Timeline'
  ],
  5 => [
    'route' => '/Timeline/busyRanges',
    'method' => 'get',
    'actionClassName' => 'Espo\\Modules\\Crm\\Tools\\Calendar\\Api\\GetBusyRanges',
    'adjustedRoute' => '/Timeline/busyRanges'
  ],
  6 => [
    'route' => '/Meeting/:id/attendees',
    'method' => 'get',
    'params' => [
      'controller' => 'Meeting',
      'action' => 'attendees'
    ],
    'adjustedRoute' => '/Meeting/{id}/attendees'
  ],
  7 => [
    'route' => '/Call/:id/attendees',
    'method' => 'get',
    'params' => [
      'controller' => 'Call',
      'action' => 'attendees'
    ],
    'adjustedRoute' => '/Call/{id}/attendees'
  ],
  8 => [
    'route' => '/Campaign/:id/generateMailMerge',
    'method' => 'post',
    'actionClassName' => 'Espo\\Modules\\Crm\\Tools\\Campaign\\Api\\PostGenerateMailMerge',
    'adjustedRoute' => '/Campaign/{id}/generateMailMerge'
  ],
  9 => [
    'route' => '/',
    'method' => 'get',
    'params' => [
      'controller' => 'ApiIndex',
      'action' => 'index'
    ],
    'adjustedRoute' => '/'
  ],
  10 => [
    'route' => '/App/user',
    'method' => 'get',
    'actionClassName' => 'Espo\\Tools\\App\\Api\\GetUser',
    'adjustedRoute' => '/App/user'
  ],
  11 => [
    'route' => '/App/destroyAuthToken',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\App\\Api\\PostDestroyAuthToken',
    'adjustedRoute' => '/App/destroyAuthToken'
  ],
  12 => [
    'route' => '/Metadata',
    'method' => 'get',
    'params' => [
      'controller' => 'Metadata'
    ],
    'adjustedRoute' => '/Metadata'
  ],
  13 => [
    'route' => '/I18n',
    'method' => 'get',
    'params' => [
      'controller' => 'I18n'
    ],
    'noAuth' => true,
    'adjustedRoute' => '/I18n'
  ],
  14 => [
    'route' => '/Settings',
    'method' => 'get',
    'params' => [
      'controller' => 'Settings'
    ],
    'noAuth' => true,
    'adjustedRoute' => '/Settings'
  ],
  15 => [
    'route' => '/Settings',
    'method' => 'patch',
    'params' => [
      'controller' => 'Settings'
    ],
    'adjustedRoute' => '/Settings'
  ],
  16 => [
    'route' => '/Settings',
    'method' => 'put',
    'params' => [
      'controller' => 'Settings'
    ],
    'adjustedRoute' => '/Settings'
  ],
  17 => [
    'route' => '/Stream',
    'method' => 'get',
    'params' => [
      'controller' => 'Stream',
      'action' => 'list',
      'scope' => 'User'
    ],
    'adjustedRoute' => '/Stream'
  ],
  18 => [
    'route' => '/GlobalSearch',
    'method' => 'get',
    'actionClassName' => 'Espo\\Tools\\GlobalSearch\\Api\\Get',
    'adjustedRoute' => '/GlobalSearch'
  ],
  19 => [
    'route' => '/LeadCapture/:apiKey',
    'method' => 'post',
    'params' => [
      'controller' => 'LeadCapture',
      'action' => 'leadCapture',
      'apiKey' => ':apiKey'
    ],
    'noAuth' => true,
    'adjustedRoute' => '/LeadCapture/{apiKey}'
  ],
  20 => [
    'route' => '/LeadCapture/:apiKey',
    'method' => 'options',
    'params' => [
      'controller' => 'LeadCapture',
      'action' => 'leadCapture',
      'apiKey' => ':apiKey'
    ],
    'noAuth' => true,
    'adjustedRoute' => '/LeadCapture/{apiKey}'
  ],
  21 => [
    'route' => '/:controller/action/:action',
    'method' => 'post',
    'params' => [
      'controller' => ':controller',
      'action' => ':action'
    ],
    'adjustedRoute' => '/{controller}/action/{action}'
  ],
  22 => [
    'route' => '/:controller/action/:action',
    'method' => 'put',
    'params' => [
      'controller' => ':controller',
      'action' => ':action'
    ],
    'adjustedRoute' => '/{controller}/action/{action}'
  ],
  23 => [
    'route' => '/:controller/action/:action',
    'method' => 'get',
    'params' => [
      'controller' => ':controller',
      'action' => ':action'
    ],
    'adjustedRoute' => '/{controller}/action/{action}'
  ],
  24 => [
    'route' => '/:controller/layout/:name',
    'method' => 'get',
    'params' => [
      'controller' => 'Layout',
      'scope' => ':controller'
    ],
    'adjustedRoute' => '/{controller}/layout/{name}'
  ],
  25 => [
    'route' => '/:controller/layout/:name',
    'method' => 'put',
    'params' => [
      'controller' => 'Layout',
      'scope' => ':controller'
    ],
    'adjustedRoute' => '/{controller}/layout/{name}'
  ],
  26 => [
    'route' => '/:controller/layout/:name/:setId',
    'method' => 'put',
    'params' => [
      'controller' => 'Layout',
      'scope' => ':controller'
    ],
    'adjustedRoute' => '/{controller}/layout/{name}/{setId}'
  ],
  27 => [
    'route' => '/Admin/rebuild',
    'method' => 'post',
    'params' => [
      'controller' => 'Admin',
      'action' => 'rebuild'
    ],
    'adjustedRoute' => '/Admin/rebuild'
  ],
  28 => [
    'route' => '/Admin/clearCache',
    'method' => 'post',
    'params' => [
      'controller' => 'Admin',
      'action' => 'clearCache'
    ],
    'adjustedRoute' => '/Admin/clearCache'
  ],
  29 => [
    'route' => '/Admin/jobs',
    'method' => 'get',
    'params' => [
      'controller' => 'Admin',
      'action' => 'jobs'
    ],
    'adjustedRoute' => '/Admin/jobs'
  ],
  30 => [
    'route' => '/Admin/fieldManager/:scope/:name',
    'method' => 'get',
    'params' => [
      'controller' => 'FieldManager',
      'action' => 'read',
      'scope' => ':scope',
      'name' => ':name'
    ],
    'adjustedRoute' => '/Admin/fieldManager/{scope}/{name}'
  ],
  31 => [
    'route' => '/Admin/fieldManager/:scope',
    'method' => 'post',
    'params' => [
      'controller' => 'FieldManager',
      'action' => 'create',
      'scope' => ':scope'
    ],
    'adjustedRoute' => '/Admin/fieldManager/{scope}'
  ],
  32 => [
    'route' => '/Admin/fieldManager/:scope/:name',
    'method' => 'put',
    'params' => [
      'controller' => 'FieldManager',
      'action' => 'update',
      'scope' => ':scope',
      'name' => ':name'
    ],
    'adjustedRoute' => '/Admin/fieldManager/{scope}/{name}'
  ],
  33 => [
    'route' => '/Admin/fieldManager/:scope/:name',
    'method' => 'patch',
    'params' => [
      'controller' => 'FieldManager',
      'action' => 'update',
      'scope' => ':scope',
      'name' => ':name'
    ],
    'adjustedRoute' => '/Admin/fieldManager/{scope}/{name}'
  ],
  34 => [
    'route' => '/Admin/fieldManager/:scope/:name',
    'method' => 'delete',
    'params' => [
      'controller' => 'FieldManager',
      'action' => 'delete',
      'scope' => ':scope',
      'name' => ':name'
    ],
    'adjustedRoute' => '/Admin/fieldManager/{scope}/{name}'
  ],
  35 => [
    'route' => '/CurrencyRate',
    'method' => 'get',
    'actionClassName' => 'Espo\\Tools\\Currency\\Api\\Get',
    'adjustedRoute' => '/CurrencyRate'
  ],
  36 => [
    'route' => '/CurrencyRate',
    'method' => 'put',
    'actionClassName' => 'Espo\\Tools\\Currency\\Api\\PutUpdate',
    'adjustedRoute' => '/CurrencyRate'
  ],
  37 => [
    'route' => '/Action',
    'method' => 'post',
    'actionClassName' => 'Espo\\Core\\Action\\Api\\PostProcess',
    'adjustedRoute' => '/Action'
  ],
  38 => [
    'route' => '/MassAction',
    'method' => 'post',
    'actionClassName' => 'Espo\\Core\\MassAction\\Api\\PostProcess',
    'adjustedRoute' => '/MassAction'
  ],
  39 => [
    'route' => '/MassAction/:id/status',
    'method' => 'get',
    'actionClassName' => 'Espo\\Core\\MassAction\\Api\\GetStatus',
    'adjustedRoute' => '/MassAction/{id}/status'
  ],
  40 => [
    'route' => '/MassAction/:id/subscribe',
    'method' => 'post',
    'actionClassName' => 'Espo\\Core\\MassAction\\Api\\PostSubscribe',
    'adjustedRoute' => '/MassAction/{id}/subscribe'
  ],
  41 => [
    'route' => '/Export',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Export\\Api\\PostProcess',
    'adjustedRoute' => '/Export'
  ],
  42 => [
    'route' => '/Export/:id/status',
    'method' => 'get',
    'actionClassName' => 'Espo\\Tools\\Export\\Api\\GetStatus',
    'adjustedRoute' => '/Export/{id}/status'
  ],
  43 => [
    'route' => '/Export/:id/subscribe',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Export\\Api\\PostSubscribe',
    'adjustedRoute' => '/Export/{id}/subscribe'
  ],
  44 => [
    'route' => '/Import',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Import\\Api\\Post',
    'adjustedRoute' => '/Import'
  ],
  45 => [
    'route' => '/Import/file',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Import\\Api\\PostFile',
    'adjustedRoute' => '/Import/file'
  ],
  46 => [
    'route' => '/Import/:id/revert',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Import\\Api\\PostRevert',
    'adjustedRoute' => '/Import/{id}/revert'
  ],
  47 => [
    'route' => '/Import/:id/removeDuplicates',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Import\\Api\\PostRemoveDuplicates',
    'adjustedRoute' => '/Import/{id}/removeDuplicates'
  ],
  48 => [
    'route' => '/Import/:id/unmarkDuplicates',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Import\\Api\\PostUnmarkDuplicates',
    'adjustedRoute' => '/Import/{id}/unmarkDuplicates'
  ],
  49 => [
    'route' => '/Import/:id/exportErrors',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Import\\Api\\PostExportErrors',
    'adjustedRoute' => '/Import/{id}/exportErrors'
  ],
  50 => [
    'route' => '/Kanban/order',
    'method' => 'put',
    'actionClassName' => 'Espo\\Tools\\Kanban\\Api\\PutOrder',
    'adjustedRoute' => '/Kanban/order'
  ],
  51 => [
    'route' => '/Kanban/:entityType',
    'method' => 'get',
    'actionClassName' => 'Espo\\Tools\\Kanban\\Api\\GetData',
    'adjustedRoute' => '/Kanban/{entityType}'
  ],
  52 => [
    'route' => '/Attachment/file/:id',
    'method' => 'get',
    'actionClassName' => 'Espo\\Tools\\Attachment\\Api\\GetFile',
    'adjustedRoute' => '/Attachment/file/{id}'
  ],
  53 => [
    'route' => '/Attachment/chunk/:id',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Attachment\\Api\\PostChunk',
    'adjustedRoute' => '/Attachment/chunk/{id}'
  ],
  54 => [
    'route' => '/Attachment/fromImageUrl',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Attachment\\Api\\PostFromImageUrl',
    'adjustedRoute' => '/Attachment/fromImageUrl'
  ],
  55 => [
    'route' => '/Attachment/copy/:id',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Attachment\\Api\\PostCopy',
    'adjustedRoute' => '/Attachment/copy/{id}'
  ],
  56 => [
    'route' => '/EmailTemplate/:id/prepare',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\EmailTemplate\\Api\\PostPrepare',
    'adjustedRoute' => '/EmailTemplate/{id}/prepare'
  ],
  57 => [
    'route' => '/Email/:id/attachments/copy',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Email\\Api\\PostAttachmentsCopy',
    'adjustedRoute' => '/Email/{id}/attachments/copy'
  ],
  58 => [
    'route' => '/Email/sendTest',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Email\\Api\\PostSendTest',
    'adjustedRoute' => '/Email/sendTest'
  ],
  59 => [
    'route' => '/Email/inbox/read',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Email\\Api\\PostInboxRead',
    'adjustedRoute' => '/Email/inbox/read'
  ],
  60 => [
    'route' => '/Email/inbox/read',
    'method' => 'delete',
    'actionClassName' => 'Espo\\Tools\\Email\\Api\\DeleteInboxRead',
    'adjustedRoute' => '/Email/inbox/read'
  ],
  61 => [
    'route' => '/Email/inbox/important',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Email\\Api\\PostInboxImportant',
    'adjustedRoute' => '/Email/inbox/important'
  ],
  62 => [
    'route' => '/Email/inbox/important',
    'method' => 'delete',
    'actionClassName' => 'Espo\\Tools\\Email\\Api\\DeleteInboxImportant',
    'adjustedRoute' => '/Email/inbox/important'
  ],
  63 => [
    'route' => '/Email/inbox/inTrash',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Email\\Api\\PostInboxInTrash',
    'adjustedRoute' => '/Email/inbox/inTrash'
  ],
  64 => [
    'route' => '/Email/inbox/inTrash',
    'method' => 'delete',
    'actionClassName' => 'Espo\\Tools\\Email\\Api\\DeleteInboxInTrash',
    'adjustedRoute' => '/Email/inbox/inTrash'
  ],
  65 => [
    'route' => '/Email/inbox/folders/:folderId',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\Email\\Api\\PostFolder',
    'adjustedRoute' => '/Email/inbox/folders/{folderId}'
  ],
  66 => [
    'route' => '/Email/inbox/notReadCounts',
    'method' => 'get',
    'actionClassName' => 'Espo\\Tools\\Email\\Api\\GetNotReadCounts',
    'adjustedRoute' => '/Email/inbox/notReadCounts'
  ],
  67 => [
    'route' => '/Email/insertFieldData',
    'method' => 'get',
    'actionClassName' => 'Espo\\Tools\\Email\\Api\\GetInsertFieldData',
    'adjustedRoute' => '/Email/insertFieldData'
  ],
  68 => [
    'route' => '/EmailAddress/search',
    'method' => 'get',
    'actionClassName' => 'Espo\\Tools\\EmailAddress\\Api\\GetSearch',
    'adjustedRoute' => '/EmailAddress/search'
  ],
  69 => [
    'route' => '/User/:id/acl',
    'method' => 'get',
    'actionClassName' => 'Espo\\Tools\\UserSecurity\\Api\\GetUserAcl',
    'adjustedRoute' => '/User/{id}/acl'
  ],
  70 => [
    'route' => '/UserSecurity/apiKey/generate',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\UserSecurity\\Api\\PostApiKeyGenerate',
    'adjustedRoute' => '/UserSecurity/apiKey/generate'
  ],
  71 => [
    'route' => '/UserSecurity/password',
    'method' => 'put',
    'actionClassName' => 'Espo\\Tools\\UserSecurity\\Api\\PutPassword',
    'adjustedRoute' => '/UserSecurity/password'
  ],
  72 => [
    'route' => '/UserSecurity/password/recovery',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\UserSecurity\\Api\\PostPasswordRecovery',
    'adjustedRoute' => '/UserSecurity/password/recovery'
  ],
  73 => [
    'route' => '/UserSecurity/password/generate',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\UserSecurity\\Api\\PostPasswordGenerate',
    'adjustedRoute' => '/UserSecurity/password/generate'
  ],
  74 => [
    'route' => '/User/passwordChangeRequest',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\UserSecurity\\Api\\PostPasswordChangeRequest',
    'noAuth' => true,
    'adjustedRoute' => '/User/passwordChangeRequest'
  ],
  75 => [
    'route' => '/User/changePasswordByRequest',
    'method' => 'post',
    'actionClassName' => 'Espo\\Tools\\UserSecurity\\Api\\PostChangePasswordByRequest',
    'noAuth' => true,
    'adjustedRoute' => '/User/changePasswordByRequest'
  ],
  76 => [
    'route' => '/Oidc/authorizationData',
    'method' => 'get',
    'params' => [
      'controller' => 'Oidc',
      'action' => 'authorizationData'
    ],
    'noAuth' => true,
    'adjustedRoute' => '/Oidc/authorizationData'
  ],
  77 => [
    'route' => '/Oidc/backchannelLogout',
    'method' => 'post',
    'params' => [
      'controller' => 'Oidc',
      'action' => 'backchannelLogout'
    ],
    'noAuth' => true,
    'adjustedRoute' => '/Oidc/backchannelLogout'
  ],
  78 => [
    'route' => '/:controller/:id',
    'method' => 'get',
    'params' => [
      'controller' => ':controller',
      'action' => 'read',
      'id' => ':id'
    ],
    'adjustedRoute' => '/{controller}/{id}'
  ],
  79 => [
    'route' => '/:controller',
    'method' => 'get',
    'params' => [
      'controller' => ':controller',
      'action' => 'index'
    ],
    'adjustedRoute' => '/{controller}'
  ],
  80 => [
    'route' => '/:controller',
    'method' => 'post',
    'params' => [
      'controller' => ':controller',
      'action' => 'create'
    ],
    'adjustedRoute' => '/{controller}'
  ],
  81 => [
    'route' => '/:controller/:id',
    'method' => 'put',
    'params' => [
      'controller' => ':controller',
      'action' => 'update',
      'id' => ':id'
    ],
    'adjustedRoute' => '/{controller}/{id}'
  ],
  82 => [
    'route' => '/:controller/:id',
    'method' => 'patch',
    'params' => [
      'controller' => ':controller',
      'action' => 'update',
      'id' => ':id'
    ],
    'adjustedRoute' => '/{controller}/{id}'
  ],
  83 => [
    'route' => '/:controller/:id',
    'method' => 'delete',
    'params' => [
      'controller' => ':controller',
      'action' => 'delete',
      'id' => ':id'
    ],
    'adjustedRoute' => '/{controller}/{id}'
  ],
  84 => [
    'route' => '/:controller/:id/stream',
    'method' => 'get',
    'params' => [
      'controller' => 'Stream',
      'action' => 'list',
      'id' => ':id',
      'scope' => ':controller'
    ],
    'adjustedRoute' => '/{controller}/{id}/stream'
  ],
  85 => [
    'route' => '/:controller/:id/posts',
    'method' => 'get',
    'params' => [
      'controller' => 'Stream',
      'action' => 'listPosts',
      'id' => ':id',
      'scope' => ':controller'
    ],
    'adjustedRoute' => '/{controller}/{id}/posts'
  ],
  86 => [
    'route' => '/:controller/:id/subscription',
    'method' => 'put',
    'params' => [
      'controller' => ':controller',
      'id' => ':id',
      'action' => 'follow'
    ],
    'adjustedRoute' => '/{controller}/{id}/subscription'
  ],
  87 => [
    'route' => '/:controller/:id/subscription',
    'method' => 'delete',
    'params' => [
      'controller' => ':controller',
      'id' => ':id',
      'action' => 'unfollow'
    ],
    'adjustedRoute' => '/{controller}/{id}/subscription'
  ],
  88 => [
    'route' => '/:controller/:id/:link',
    'method' => 'get',
    'params' => [
      'controller' => ':controller',
      'action' => 'listLinked',
      'id' => ':id',
      'link' => ':link'
    ],
    'adjustedRoute' => '/{controller}/{id}/{link}'
  ],
  89 => [
    'route' => '/:controller/:id/:link',
    'method' => 'post',
    'params' => [
      'controller' => ':controller',
      'action' => 'createLink',
      'id' => ':id',
      'link' => ':link'
    ],
    'adjustedRoute' => '/{controller}/{id}/{link}'
  ],
  90 => [
    'route' => '/:controller/:id/:link',
    'method' => 'delete',
    'params' => [
      'controller' => ':controller',
      'action' => 'removeLink',
      'id' => ':id',
      'link' => ':link'
    ],
    'adjustedRoute' => '/{controller}/{id}/{link}'
  ]
];
