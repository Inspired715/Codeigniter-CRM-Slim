<?php return array (
  0 => 
  array (
    'GET' => 
    array (
      '/token/api/v1/Activities/upcoming' => 'route2',
      '/token/api/v1/Activities' => 'route3',
      '/token/api/v1/Timeline' => 'route4',
      '/token/api/v1/Timeline/busyRanges' => 'route5',
      '/token/api/v1/' => 'route9',
      '/token/api/v1/App/user' => 'route10',
      '/token/api/v1/Metadata' => 'route12',
      '/token/api/v1/I18n' => 'route13',
      '/token/api/v1/Settings' => 'route14',
      '/token/api/v1/Stream' => 'route17',
      '/token/api/v1/GlobalSearch' => 'route18',
      '/token/api/v1/Admin/jobs' => 'route29',
      '/token/api/v1/CurrencyRate' => 'route35',
      '/token/api/v1/Email/inbox/notReadCounts' => 'route66',
      '/token/api/v1/Email/insertFieldData' => 'route67',
      '/token/api/v1/EmailAddress/search' => 'route68',
      '/token/api/v1/Oidc/authorizationData' => 'route76',
    ),
    'POST' => 
    array (
      '/token/api/v1/App/destroyAuthToken' => 'route11',
      '/token/api/v1/Admin/rebuild' => 'route27',
      '/token/api/v1/Admin/clearCache' => 'route28',
      '/token/api/v1/Action' => 'route37',
      '/token/api/v1/MassAction' => 'route38',
      '/token/api/v1/Export' => 'route41',
      '/token/api/v1/Import' => 'route44',
      '/token/api/v1/Import/file' => 'route45',
      '/token/api/v1/Attachment/fromImageUrl' => 'route54',
      '/token/api/v1/Email/sendTest' => 'route58',
      '/token/api/v1/Email/inbox/read' => 'route59',
      '/token/api/v1/Email/inbox/important' => 'route61',
      '/token/api/v1/Email/inbox/inTrash' => 'route63',
      '/token/api/v1/UserSecurity/apiKey/generate' => 'route70',
      '/token/api/v1/UserSecurity/password/recovery' => 'route72',
      '/token/api/v1/UserSecurity/password/generate' => 'route73',
      '/token/api/v1/User/passwordChangeRequest' => 'route74',
      '/token/api/v1/User/changePasswordByRequest' => 'route75',
      '/token/api/v1/Oidc/backchannelLogout' => 'route77',
    ),
    'PATCH' => 
    array (
      '/token/api/v1/Settings' => 'route15',
    ),
    'PUT' => 
    array (
      '/token/api/v1/Settings' => 'route16',
      '/token/api/v1/CurrencyRate' => 'route36',
      '/token/api/v1/Kanban/order' => 'route50',
      '/token/api/v1/UserSecurity/password' => 'route71',
    ),
    'DELETE' => 
    array (
      '/token/api/v1/Email/inbox/read' => 'route60',
      '/token/api/v1/Email/inbox/important' => 'route62',
      '/token/api/v1/Email/inbox/inTrash' => 'route64',
    ),
  ),
  1 => 
  array (
    'GET' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/token/api/v1/Activities/([^/]+)/([^/]+)/([^/]+)|/token/api/v1/Activities/([^/]+)/([^/]+)/([^/]+)/list/([^/]+)|/token/api/v1/Meeting/([^/]+)/attendees()()()()|/token/api/v1/Call/([^/]+)/attendees()()()()()|/token/api/v1/([^/]+)/action/([^/]+)()()()()()|/token/api/v1/([^/]+)/layout/([^/]+)()()()()()()|/token/api/v1/Admin/fieldManager/([^/]+)/([^/]+)()()()()()()()|/token/api/v1/MassAction/([^/]+)/status()()()()()()()()()|/token/api/v1/Export/([^/]+)/status()()()()()()()()()())$~',
        'routeMap' => 
        array (
          4 => 
          array (
            0 => 'route0',
            1 => 
            array (
              'parentType' => 'parentType',
              'id' => 'id',
              'type' => 'type',
            ),
          ),
          5 => 
          array (
            0 => 'route1',
            1 => 
            array (
              'parentType' => 'parentType',
              'id' => 'id',
              'type' => 'type',
              'targetType' => 'targetType',
            ),
          ),
          6 => 
          array (
            0 => 'route6',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          7 => 
          array (
            0 => 'route7',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          8 => 
          array (
            0 => 'route23',
            1 => 
            array (
              'controller' => 'controller',
              'action' => 'action',
            ),
          ),
          9 => 
          array (
            0 => 'route24',
            1 => 
            array (
              'controller' => 'controller',
              'name' => 'name',
            ),
          ),
          10 => 
          array (
            0 => 'route30',
            1 => 
            array (
              'scope' => 'scope',
              'name' => 'name',
            ),
          ),
          11 => 
          array (
            0 => 'route39',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          12 => 
          array (
            0 => 'route42',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
        ),
      ),
      1 => 
      array (
        'regex' => '~^(?|/token/api/v1/Kanban/([^/]+)|/token/api/v1/Attachment/file/([^/]+)()|/token/api/v1/User/([^/]+)/acl()()|/token/api/v1/([^/]+)/([^/]+)()()|/token/api/v1/([^/]+)()()()()|/token/api/v1/([^/]+)/([^/]+)/stream()()()()|/token/api/v1/([^/]+)/([^/]+)/posts()()()()()|/token/api/v1/([^/]+)/([^/]+)/([^/]+)()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route51',
            1 => 
            array (
              'entityType' => 'entityType',
            ),
          ),
          3 => 
          array (
            0 => 'route52',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          4 => 
          array (
            0 => 'route69',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          5 => 
          array (
            0 => 'route78',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          6 => 
          array (
            0 => 'route79',
            1 => 
            array (
              'controller' => 'controller',
            ),
          ),
          7 => 
          array (
            0 => 'route84',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          8 => 
          array (
            0 => 'route85',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          9 => 
          array (
            0 => 'route88',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
              'link' => 'link',
            ),
          ),
        ),
      ),
    ),
    'POST' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/token/api/v1/Campaign/([^/]+)/generateMailMerge|/token/api/v1/LeadCapture/([^/]+)()|/token/api/v1/([^/]+)/action/([^/]+)()|/token/api/v1/Admin/fieldManager/([^/]+)()()()|/token/api/v1/MassAction/([^/]+)/subscribe()()()()|/token/api/v1/Export/([^/]+)/subscribe()()()()()|/token/api/v1/Import/([^/]+)/revert()()()()()()|/token/api/v1/Import/([^/]+)/removeDuplicates()()()()()()()|/token/api/v1/Import/([^/]+)/unmarkDuplicates()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route8',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          3 => 
          array (
            0 => 'route19',
            1 => 
            array (
              'apiKey' => 'apiKey',
            ),
          ),
          4 => 
          array (
            0 => 'route21',
            1 => 
            array (
              'controller' => 'controller',
              'action' => 'action',
            ),
          ),
          5 => 
          array (
            0 => 'route31',
            1 => 
            array (
              'scope' => 'scope',
            ),
          ),
          6 => 
          array (
            0 => 'route40',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          7 => 
          array (
            0 => 'route43',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          8 => 
          array (
            0 => 'route46',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          9 => 
          array (
            0 => 'route47',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          10 => 
          array (
            0 => 'route48',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
        ),
      ),
      1 => 
      array (
        'regex' => '~^(?|/token/api/v1/Import/([^/]+)/exportErrors|/token/api/v1/Attachment/chunk/([^/]+)()|/token/api/v1/Attachment/copy/([^/]+)()()|/token/api/v1/EmailTemplate/([^/]+)/prepare()()()|/token/api/v1/Email/([^/]+)/attachments/copy()()()()|/token/api/v1/Email/inbox/folders/([^/]+)()()()()()|/token/api/v1/([^/]+)()()()()()()|/token/api/v1/([^/]+)/([^/]+)/([^/]+)()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route49',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          3 => 
          array (
            0 => 'route53',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          4 => 
          array (
            0 => 'route55',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          5 => 
          array (
            0 => 'route56',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          6 => 
          array (
            0 => 'route57',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          7 => 
          array (
            0 => 'route65',
            1 => 
            array (
              'folderId' => 'folderId',
            ),
          ),
          8 => 
          array (
            0 => 'route80',
            1 => 
            array (
              'controller' => 'controller',
            ),
          ),
          9 => 
          array (
            0 => 'route89',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
              'link' => 'link',
            ),
          ),
        ),
      ),
    ),
    'OPTIONS' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/token/api/v1/LeadCapture/([^/]+))$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route20',
            1 => 
            array (
              'apiKey' => 'apiKey',
            ),
          ),
        ),
      ),
    ),
    'PUT' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/token/api/v1/([^/]+)/action/([^/]+)|/token/api/v1/([^/]+)/layout/([^/]+)()|/token/api/v1/([^/]+)/layout/([^/]+)/([^/]+)()|/token/api/v1/Admin/fieldManager/([^/]+)/([^/]+)()()()|/token/api/v1/([^/]+)/([^/]+)()()()()|/token/api/v1/([^/]+)/([^/]+)/subscription()()()()())$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 'route22',
            1 => 
            array (
              'controller' => 'controller',
              'action' => 'action',
            ),
          ),
          4 => 
          array (
            0 => 'route25',
            1 => 
            array (
              'controller' => 'controller',
              'name' => 'name',
            ),
          ),
          5 => 
          array (
            0 => 'route26',
            1 => 
            array (
              'controller' => 'controller',
              'name' => 'name',
              'setId' => 'setId',
            ),
          ),
          6 => 
          array (
            0 => 'route32',
            1 => 
            array (
              'scope' => 'scope',
              'name' => 'name',
            ),
          ),
          7 => 
          array (
            0 => 'route81',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          8 => 
          array (
            0 => 'route86',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
        ),
      ),
    ),
    'PATCH' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/token/api/v1/Admin/fieldManager/([^/]+)/([^/]+)|/token/api/v1/([^/]+)/([^/]+)())$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 'route33',
            1 => 
            array (
              'scope' => 'scope',
              'name' => 'name',
            ),
          ),
          4 => 
          array (
            0 => 'route82',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
        ),
      ),
    ),
    'DELETE' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/token/api/v1/Admin/fieldManager/([^/]+)/([^/]+)|/token/api/v1/([^/]+)/([^/]+)()|/token/api/v1/([^/]+)/([^/]+)/subscription()()|/token/api/v1/([^/]+)/([^/]+)/([^/]+)()())$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 'route34',
            1 => 
            array (
              'scope' => 'scope',
              'name' => 'name',
            ),
          ),
          4 => 
          array (
            0 => 'route83',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          5 => 
          array (
            0 => 'route87',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
            ),
          ),
          6 => 
          array (
            0 => 'route90',
            1 => 
            array (
              'controller' => 'controller',
              'id' => 'id',
              'link' => 'link',
            ),
          ),
        ),
      ),
    ),
  ),
);