<?php
return (object) [
  'aclDefs' => (object) [
    'ActionHistoryRecord' => (object) [
      'ownershipCheckerClassName' => 'Espo\\Classes\\Acl\\ActionHistoryRecord\\OwnershipChecker'
    ],
    'Attachment' => (object) [
      'accessCheckerClassName' => 'Espo\\Classes\\Acl\\Attachment\\AccessChecker',
      'ownershipCheckerClassName' => 'Espo\\Classes\\Acl\\Attachment\\OwnershipChecker',
      'portalAccessCheckerClassName' => 'Espo\\Classes\\AclPortal\\Attachment\\AccessChecker',
      'portalOwnershipCheckerClassName' => 'Espo\\Classes\\AclPortal\\Attachment\\OwnershipChecker'
    ],
    'AuthToken' => (object) [
      'accessCheckerClassName' => 'Espo\\Classes\\Acl\\AuthToken\\AccessChecker'
    ],
    'Email' => (object) [
      'accessCheckerClassName' => 'Espo\\Classes\\Acl\\Email\\AccessChecker',
      'ownershipCheckerClassName' => 'Espo\\Classes\\Acl\\Email\\OwnershipChecker',
      'portalAccessCheckerClassName' => 'Espo\\Classes\\AclPortal\\Email\\AccessChecker',
      'portalOwnershipCheckerClassName' => 'Espo\\Classes\\AclPortal\\Email\\OwnershipChecker',
      'assignmentCheckerClassName' => 'Espo\\Classes\\Acl\\Email\\AssignmentChecker',
      'readOwnerUserField' => 'users'
    ],
    'EmailFilter' => (object) [
      'ownershipCheckerClassName' => 'Espo\\Classes\\Acl\\EmailFilter\\OwnershipChecker'
    ],
    'Import' => (object) [
      'accessCheckerClassName' => 'Espo\\Classes\\Acl\\Import\\AccessChecker'
    ],
    'ImportError' => (object) [
      'accessCheckerClassName' => 'Espo\\Core\\Acl\\AccessChecker\\AccessCheckers\\Foreign',
      'link' => 'import'
    ],
    'Note' => (object) [
      'accessCheckerClassName' => 'Espo\\Classes\\Acl\\Note\\AccessChecker',
      'ownershipCheckerClassName' => 'Espo\\Classes\\Acl\\Note\\OwnershipChecker',
      'portalAccessCheckerClassName' => 'Espo\\Classes\\AclPortal\\Note\\AccessChecker',
      'portalOwnershipCheckerClassName' => 'Espo\\Classes\\AclPortal\\Note\\OwnershipChecker'
    ],
    'Notification' => (object) [
      'ownershipCheckerClassName' => 'Espo\\Classes\\Acl\\Notification\\OwnershipChecker',
      'portalOwnershipCheckerClassName' => 'Espo\\Classes\\AclPortal\\Notification\\OwnershipChecker'
    ],
    'Portal' => (object) [
      'accessCheckerClassName' => 'Espo\\Classes\\Acl\\Portal\\AccessChecker'
    ],
    'ScheduledJob' => (object) [
      'accessCheckerClassName' => 'Espo\\Classes\\Acl\\ScheduledJob\\AccessChecker'
    ],
    'Team' => (object) [
      'ownershipCheckerClassName' => 'Espo\\Classes\\Acl\\Team\\OwnershipChecker'
    ],
    'User' => (object) [
      'accessCheckerClassName' => 'Espo\\Classes\\Acl\\User\\AccessChecker',
      'ownershipCheckerClassName' => 'Espo\\Classes\\Acl\\User\\OwnershipChecker',
      'portalOwnershipCheckerClassName' => 'Espo\\Classes\\AclPortal\\User\\OwnershipChecker'
    ],
    'Webhook' => (object) [
      'accessCheckerClassName' => 'Espo\\Classes\\Acl\\Webhook\\AccessChecker',
      'ownershipCheckerClassName' => 'Espo\\Classes\\Acl\\Webhook\\OwnershipChecker'
    ],
    'WorkingTimeRange' => (object) [
      'assignmentCheckerClassName' => 'Espo\\Classes\\Acl\\WorkingTimeRange\\AssignmentChecker'
    ],
    'Account' => (object) [
      'portalOwnershipCheckerClassName' => 'Espo\\Modules\\Crm\\Classes\\AclPortal\\Account\\OwnershipChecker'
    ],
    'Call' => (object) [
      'accessCheckerClassName' => 'Espo\\Modules\\Crm\\Classes\\Acl\\Call\\AccessChecker',
      'readOwnerUserField' => 'users'
    ],
    'CampaignLogRecord' => (object) [
      'ownershipCheckerClassName' => 'Espo\\Modules\\Crm\\Classes\\Acl\\CampaignLogRecord\\OwnershipChecker'
    ],
    'CampaignTrackingUrl' => (object) [
      'ownershipCheckerClassName' => 'Espo\\Modules\\Crm\\Classes\\Acl\\CampaignTrackingUrl\\OwnershipChecker'
    ],
    'Contact' => (object) [
      'portalOwnershipCheckerClassName' => 'Espo\\Modules\\Crm\\Classes\\AclPortal\\Contact\\OwnershipChecker'
    ],
    'KnowledgeBaseArticle' => (object) [
      'portalAccessCheckerClassName' => 'Espo\\Modules\\Crm\\Classes\\AclPortal\\KnowledgeBaseArticle\\AccessChecker'
    ],
    'MassEmail' => (object) [
      'ownershipCheckerClassName' => 'Espo\\Modules\\Crm\\Classes\\Acl\\MassEmail\\OwnershipChecker'
    ],
    'Meeting' => (object) [
      'accessCheckerClassName' => 'Espo\\Modules\\Crm\\Classes\\Acl\\Meeting\\AccessChecker',
      'readOwnerUserField' => 'users'
    ]
  ],
  'app' => (object) [
    'acl' => (object) [
      'mandatory' => (object) [
        'scopeLevel' => (object) [
          'Note' => (object) [
            'read' => 'own',
            'edit' => 'own',
            'delete' => 'own',
            'create' => 'yes'
          ],
          'Portal' => (object) [
            'read' => 'all',
            'edit' => 'no',
            'delete' => 'no',
            'create' => 'no'
          ],
          'Attachment' => (object) [
            'read' => 'own',
            'edit' => 'own',
            'delete' => 'own',
            'create' => 'yes'
          ],
          'EmailAccount' => (object) [
            'read' => 'own',
            'edit' => 'own',
            'delete' => 'own',
            'create' => 'yes'
          ],
          'EmailFilter' => (object) [
            'read' => 'own',
            'edit' => 'own',
            'delete' => 'own',
            'create' => 'yes'
          ],
          'EmailFolder' => (object) [
            'read' => 'own',
            'edit' => 'own',
            'delete' => 'own',
            'create' => 'yes'
          ],
          'GroupEmailFolder' => (object) [
            'read' => 'team',
            'edit' => 'no',
            'delete' => 'no',
            'create' => 'no'
          ],
          'Preferences' => (object) [
            'read' => 'own',
            'edit' => 'own',
            'delete' => 'no',
            'create' => 'no'
          ],
          'Notification' => (object) [
            'read' => 'own',
            'edit' => 'no',
            'delete' => 'own',
            'create' => 'no'
          ],
          'ActionHistoryRecord' => (object) [
            'read' => 'own'
          ],
          'Role' => false,
          'PortalRole' => false,
          'ImportError' => 'Import',
          'WorkingTimeRange' => 'WorkingTimeCalendar',
          'Stream' => true,
          'MassEmail' => 'Campaign',
          'CampaignLogRecord' => 'Campaign',
          'CampaignTrackingUrl' => 'Campaign',
          'EmailQueueItem' => 'Campaign'
        ],
        'fieldLevel' => (object) [],
        'scopeFieldLevel' => (object) [
          'EmailAccount' => (object) [
            'assignedUser' => (object) [
              'read' => 'yes',
              'edit' => 'no'
            ]
          ],
          'EmailFolder' => (object) [
            'assignedUser' => (object) [
              'read' => 'yes',
              'edit' => 'no'
            ]
          ],
          'Email' => (object) [
            'inboundEmails' => false,
            'emailAccounts' => false
          ],
          'User' => (object) [
            'dashboardTemplate' => false,
            'workingTimeCalendar' => (object) [
              'read' => 'yes',
              'edit' => 'no'
            ],
            'password' => false,
            'passwordConfirm' => false,
            'auth2FA' => false,
            'authMethod' => false,
            'apiKey' => false,
            'secretKey' => false,
            'token' => false
          ],
          'ActionHistoryRecord' => (object) [
            'authToken' => false,
            'authLogRecord' => false
          ]
        ]
      ],
      'strictDefault' => (object) [
        'scopeLevel' => (object) [
          'User' => (object) [
            'read' => 'own',
            'edit' => 'no'
          ],
          'Team' => (object) [
            'read' => 'team'
          ],
          'Import' => false,
          'Webhook' => false
        ],
        'fieldLevel' => (object) [],
        'scopeFieldLevel' => (object) [
          'User' => (object) [
            'gender' => false
          ]
        ]
      ],
      'adminMandatory' => (object) [
        'scopeLevel' => (object) [
          'User' => (object) [
            'create' => 'yes',
            'read' => 'all',
            'edit' => 'all',
            'delete' => 'all'
          ],
          'Team' => (object) [
            'create' => 'yes',
            'read' => 'all',
            'edit' => 'all',
            'delete' => 'all'
          ],
          'Job' => (object) [
            'create' => 'no',
            'read' => 'all',
            'edit' => 'no',
            'delete' => 'all'
          ],
          'Extension' => (object) [
            'create' => 'no',
            'read' => 'all',
            'edit' => 'no',
            'delete' => 'all'
          ],
          'Stream' => true
        ]
      ],
      'valuePermissionList' => [
        0 => 'assignmentPermission',
        1 => 'userPermission',
        2 => 'messagePermission',
        3 => 'portalPermission',
        4 => 'groupEmailAccountPermission',
        5 => 'exportPermission',
        6 => 'massUpdatePermission',
        7 => 'followerManagementPermission',
        8 => 'dataPrivacyPermission'
      ],
      'valuePermissionHighestLevels' => (object) [
        'assignmentPermission' => 'all',
        'userPermission' => 'all',
        'messagePermission' => 'all',
        'portalPermission' => 'yes',
        'groupEmailAccountPermission' => 'all',
        'exportPermission' => 'yes',
        'massUpdatePermission' => 'yes',
        'followerManagementPermission' => 'all',
        'dataPrivacyPermission' => 'yes'
      ],
      'permissionsStrictDefaults' => (object) [
        'assignmentPermission' => 'no',
        'userPermission' => 'no',
        'messagePermission' => 'no',
        'portalPermission' => 'no',
        'groupEmailAccountPermission' => 'no',
        'exportPermission' => 'no',
        'massUpdatePermission' => 'no',
        'followerManagementPermission' => 'no',
        'dataPrivacyPermission' => 'no'
      ],
      'scopeLevelTypesStrictDefaults' => (object) [
        'boolean' => false,
        'record' => false
      ]
    ],
    'aclPortal' => (object) [
      'mandatory' => (object) [
        'scopeLevel' => (object) [
          'User' => (object) [
            'read' => 'own',
            'edit' => 'no',
            'delete' => 'no',
            'stream' => 'no',
            'create' => 'no'
          ],
          'Team' => false,
          'Note' => (object) [
            'read' => 'own',
            'edit' => 'own',
            'delete' => 'own',
            'create' => 'yes'
          ],
          'Notification' => (object) [
            'read' => 'own',
            'edit' => 'no',
            'delete' => 'own',
            'create' => 'no'
          ],
          'Portal' => false,
          'Attachment' => (object) [
            'read' => 'own',
            'edit' => 'own',
            'delete' => 'own',
            'create' => 'yes'
          ],
          'ExternalAccount' => false,
          'Role' => false,
          'PortalRole' => false,
          'EmailFilter' => false,
          'EmailFolder' => false,
          'EmailAccount' => false,
          'EmailTemplate' => false,
          'ActionHistoryRecord' => (object) [
            'read' => 'own'
          ],
          'Preferences' => (object) [
            'read' => 'own',
            'edit' => 'own',
            'delete' => 'no',
            'create' => 'no'
          ],
          'MassEmail' => 'Campaign',
          'CampaignLogRecord' => 'Campaign',
          'CampaignTrackingUrl' => 'Campaign',
          'EmailQueueItem' => false
        ],
        'fieldLevel' => (object) [],
        'scopeFieldLevel' => (object) [
          'Preferences' => (object) [
            'smtpServer' => false,
            'smtpPort' => false,
            'smtpSecurity' => false,
            'smtpUsername' => false,
            'smtpPassword' => false,
            'smtpAuth' => false,
            'receiveAssignmentEmailNotifications' => false,
            'receiveMentionEmailNotifications' => false,
            'defaultReminders' => false,
            'autoFollowEntityTypeList' => false,
            'emailReplyForceHtml' => false,
            'emailReplyToAllByDefault' => false,
            'signature' => false,
            'followCreatedEntities' => false,
            'followEntityOnStreamPost' => false,
            'doNotFillAssignedUserIfNotRequired' => false,
            'useCustomTabList' => false,
            'tabList' => false,
            'emailUseExternalClient' => false,
            'assignmentNotificationsIgnoreEntityTypeList' => false,
            'assignmentEmailNotificationsIgnoreEntityTypeList' => false,
            'dashletsOptions' => false,
            'dashboardLayout' => false
          ],
          'Call' => (object) [
            'reminders' => false
          ],
          'Meeting' => (object) [
            'reminders' => false
          ],
          'Note' => (object) [
            'isInternal' => false,
            'isGlobal' => false
          ],
          'Email' => (object) [
            'inboundEmails' => false,
            'emailAccounts' => false
          ],
          'User' => (object) [
            'dashboardTemplate' => false,
            'workingTimeCalendar' => false,
            'password' => false,
            'authMethod' => false,
            'apiKey' => false,
            'secretKey' => false,
            'token' => false,
            'isAdmin' => false,
            'type' => false,
            'contact' => false,
            'accounts' => false,
            'account' => false,
            'portalRoles' => false,
            'portals' => false,
            'roles' => false,
            'defaultTeam' => false,
            'auth2FA' => false,
            'isActive' => false
          ],
          'ActionHistoryRecord' => (object) [
            'authToken' => false,
            'authLogRecord' => false
          ]
        ]
      ],
      'strictDefault' => (object) [
        'scopeLevel' => (object) [],
        'fieldLevel' => (object) [
          'assignedUser' => (object) [
            'read' => 'yes',
            'edit' => 'no'
          ],
          'assignedUsers' => (object) [
            'read' => 'yes',
            'edit' => 'no'
          ],
          'teams' => false
        ],
        'scopeFieldLevel' => (object) [
          'User' => (object) [
            'gender' => false
          ],
          'KnowledgeBaseArticle' => (object) [
            'portals' => false,
            'order' => false,
            'status' => false,
            'assignedUser' => false
          ],
          'Call' => (object) [
            'users' => (object) [
              'read' => 'yes',
              'edit' => 'no'
            ],
            'leads' => false
          ],
          'Meeting' => (object) [
            'users' => (object) [
              'read' => 'yes',
              'edit' => 'no'
            ],
            'leads' => false
          ],
          'Case' => (object) [
            'status' => (object) [
              'read' => 'yes',
              'edit' => 'no'
            ]
          ]
        ]
      ],
      'valuePermissionList' => [
        0 => 'exportPermission',
        1 => 'massUpdatePermission'
      ],
      'permissionsStrictDefaults' => (object) [
        'exportPermission' => 'no',
        'massUpdatePermission' => 'no'
      ],
      'scopeLevelTypesStrictDefaults' => (object) [
        'boolean' => false,
        'record' => false
      ]
    ],
    'actions' => (object) [
      'convertCurrency' => (object) [
        'implementationClassName' => 'Espo\\Core\\Action\\Actions\\ConvertCurrency'
      ],
      'merge' => (object) [
        'implementationClassName' => 'Espo\\Core\\Action\\Actions\\Merge'
      ]
    ],
    'addressFormats' => (object) [
      1 => (object) [
        'formatterClassName' => 'Espo\\Classes\\AddressFormatters\\Formatter1'
      ],
      2 => (object) [
        'formatterClassName' => 'Espo\\Classes\\AddressFormatters\\Formatter2'
      ],
      3 => (object) [
        'formatterClassName' => 'Espo\\Classes\\AddressFormatters\\Formatter3'
      ],
      4 => (object) [
        'formatterClassName' => 'Espo\\Classes\\AddressFormatters\\Formatter4'
      ]
    ],
    'adminPanel' => (object) [
      'system' => (object) [
        'label' => 'System',
        'itemList' => [
          0 => (object) [
            'url' => '#Admin/settings',
            'label' => 'Settings',
            'iconClass' => 'fas fa-cog',
            'description' => 'settings',
            'recordView' => 'views/admin/settings'
          ],
          1 => (object) [
            'url' => '#Admin/userInterface',
            'label' => 'User Interface',
            'iconClass' => 'fas fa-desktop',
            'description' => 'userInterface',
            'recordView' => 'views/admin/user-interface'
          ],
          2 => (object) [
            'url' => '#Admin/authentication',
            'label' => 'Authentication',
            'iconClass' => 'fas fa-sign-in-alt',
            'description' => 'authentication',
            'recordView' => 'views/admin/authentication'
          ],
          3 => (object) [
            'url' => '#ScheduledJob',
            'label' => 'Scheduled Jobs',
            'iconClass' => 'fas fa-clock',
            'description' => 'scheduledJob'
          ],
          4 => (object) [
            'url' => '#Admin/currency',
            'label' => 'Currency',
            'iconClass' => 'fas fa-euro-sign',
            'description' => 'currency',
            'recordView' => 'views/admin/currency'
          ],
          5 => (object) [
            'url' => '#Admin/notifications',
            'label' => 'Notifications',
            'iconClass' => 'fas fa-bell',
            'description' => 'notifications',
            'recordView' => 'views/admin/notifications'
          ],
          6 => (object) [
            'url' => '#Admin/integrations',
            'label' => 'Integrations',
            'iconClass' => 'fas fa-network-wired',
            'description' => 'integrations'
          ],
          7 => (object) [
            'url' => '#Admin/extensions',
            'label' => 'Extensions',
            'iconClass' => 'fas fa-upload',
            'description' => 'extensions'
          ],
          8 => (object) [
            'url' => '#Admin/systemRequirements',
            'label' => 'System Requirements',
            'iconClass' => 'fas fa-server',
            'description' => 'systemRequirements'
          ],
          9 => (object) [
            'url' => '#Admin/jobsSettings',
            'label' => 'Job Settings',
            'iconClass' => 'fas fa-list-ul',
            'description' => 'jobsSettings',
            'recordView' => 'views/admin/jobs-settings'
          ],
          10 => (object) [
            'url' => '#Admin/upgrade',
            'label' => 'Upgrade',
            'iconClass' => 'fas fa-arrow-alt-circle-up',
            'description' => 'upgrade',
            'view' => 'views/admin/upgrade/index'
          ],
          11 => (object) [
            'action' => 'clearCache',
            'label' => 'Clear Cache',
            'iconClass' => 'fas fa-broom',
            'description' => 'clearCache'
          ],
          12 => (object) [
            'action' => 'rebuild',
            'label' => 'Rebuild',
            'iconClass' => 'fas fa-database',
            'description' => 'rebuild'
          ]
        ],
        'order' => 0
      ],
      'users' => (object) [
        'label' => 'Users',
        'itemList' => [
          0 => (object) [
            'url' => '#Admin/users',
            'label' => 'Users',
            'iconClass' => 'fas fa-user',
            'description' => 'users'
          ],
          1 => (object) [
            'url' => '#Admin/teams',
            'label' => 'Teams',
            'iconClass' => 'fas fa-users',
            'description' => 'teams'
          ],
          2 => (object) [
            'url' => '#Admin/roles',
            'label' => 'Roles',
            'iconClass' => 'fas fa-key',
            'description' => 'roles'
          ],
          3 => (object) [
            'url' => '#Admin/authLog',
            'label' => 'Auth Log',
            'iconClass' => 'fas fa-sign-in-alt',
            'description' => 'authLog'
          ],
          4 => (object) [
            'url' => '#Admin/authTokens',
            'label' => 'Auth Tokens',
            'iconClass' => 'fas fa-shield-alt',
            'description' => 'authTokens'
          ],
          5 => (object) [
            'url' => '#Admin/actionHistory',
            'label' => 'Action History',
            'iconClass' => 'fas fa-history',
            'description' => 'actionHistory'
          ],
          6 => (object) [
            'url' => '#Admin/apiUsers',
            'label' => 'API Users',
            'iconClass' => 'fas fa-user-cog',
            'description' => 'apiUsers'
          ]
        ],
        'order' => 5
      ],
      'customization' => (object) [
        'label' => 'Customization',
        'itemList' => [
          0 => (object) [
            'url' => '#Admin/entityManager',
            'label' => 'Entity Manager',
            'iconClass' => 'fas fa-tools',
            'description' => 'entityManager'
          ],
          1 => (object) [
            'url' => '#Admin/layouts',
            'label' => 'Layout Manager',
            'iconClass' => 'fas fa-table',
            'description' => 'layoutManager'
          ],
          2 => (object) [
            'url' => '#Admin/labelManager',
            'label' => 'Label Manager',
            'iconClass' => 'fas fa-language',
            'description' => 'labelManager'
          ],
          3 => (object) [
            'url' => '#Admin/templateManager',
            'label' => 'Template Manager',
            'iconClass' => 'fas fa-envelope-open-text',
            'description' => 'templateManager'
          ]
        ],
        'order' => 10
      ],
      'email' => (object) [
        'label' => 'Messaging',
        'itemList' => [
          0 => (object) [
            'url' => '#Admin/outboundEmails',
            'label' => 'Outbound Emails',
            'iconClass' => 'fas fa-paper-plane',
            'description' => 'outboundEmails',
            'recordView' => 'views/admin/outbound-emails'
          ],
          1 => (object) [
            'url' => '#Admin/inboundEmails',
            'label' => 'Inbound Emails',
            'iconClass' => 'fas fa-envelope',
            'description' => 'inboundEmails',
            'recordView' => 'views/admin/inbound-emails'
          ],
          2 => (object) [
            'url' => '#Admin/groupEmailAccounts',
            'label' => 'Group Email Accounts',
            'iconClass' => 'fas fa-inbox',
            'description' => 'groupEmailAccounts'
          ],
          3 => (object) [
            'url' => '#Admin/personalEmailAccounts',
            'label' => 'Personal Email Accounts',
            'iconClass' => 'fas fa-inbox',
            'description' => 'personalEmailAccounts'
          ],
          4 => (object) [
            'url' => '#Admin/emailFilters',
            'label' => 'Email Filters',
            'iconClass' => 'fas fa-filter',
            'description' => 'emailFilters'
          ],
          5 => (object) [
            'url' => '#Admin/groupEmailFolders',
            'label' => 'Group Email Folders',
            'iconClass' => 'fas fa-folder',
            'description' => 'groupEmailFolders'
          ],
          6 => (object) [
            'url' => '#Admin/emailTemplates',
            'label' => 'Email Templates',
            'iconClass' => 'fas fa-envelope-square',
            'description' => 'emailTemplates'
          ],
          7 => (object) [
            'url' => '#Admin/sms',
            'label' => 'SMS',
            'iconClass' => 'fas fa-paper-plane',
            'description' => 'sms',
            'recordView' => 'views/admin/sms'
          ]
        ],
        'order' => 15
      ],
      'portal' => (object) [
        'label' => 'Portal',
        'itemList' => [
          0 => (object) [
            'url' => '#Admin/portals',
            'label' => 'Portals',
            'iconClass' => 'fas fa-parking',
            'description' => 'portals'
          ],
          1 => (object) [
            'url' => '#Admin/portalUsers',
            'label' => 'Portal Users',
            'iconClass' => 'fas fa-user',
            'description' => 'portalUsers'
          ],
          2 => (object) [
            'url' => '#Admin/portalRoles',
            'label' => 'Portal Roles',
            'iconClass' => 'fas fa-key',
            'description' => 'portalRoles'
          ]
        ],
        'order' => 20
      ],
      'data' => (object) [
        'label' => 'Data',
        'itemList' => [
          0 => (object) [
            'url' => '#Admin/import',
            'label' => 'Import',
            'iconClass' => 'fas fa-file-import',
            'description' => 'import'
          ],
          1 => (object) [
            'url' => '#Admin/leadCapture',
            'label' => 'Lead Capture',
            'iconClass' => 'fas fa-id-card',
            'description' => 'leadCapture'
          ],
          2 => (object) [
            'url' => '#Admin/pdfTemplates',
            'label' => 'PDF Templates',
            'iconClass' => 'fas fa-file-pdf',
            'description' => 'pdfTemplates'
          ],
          3 => (object) [
            'url' => '#Admin/webhooks',
            'label' => 'Webhooks',
            'iconClass' => 'fas fa-share-alt icon-rotate-90',
            'description' => 'webhooks'
          ],
          4 => (object) [
            'url' => '#Admin/dashboardTemplates',
            'label' => 'Dashboard Templates',
            'iconClass' => 'fas fa-th-large',
            'description' => 'dashboardTemplates'
          ],
          5 => (object) [
            'url' => '#Admin/layoutSets',
            'label' => 'Layout Sets',
            'iconClass' => 'fas fa-table',
            'description' => 'layoutSets'
          ],
          6 => (object) [
            'url' => '#Admin/workingTimeCalendar',
            'label' => 'Working Time Calendars',
            'iconClass' => 'far fa-calendar-alt',
            'description' => 'workingTimeCalendars'
          ],
          7 => (object) [
            'url' => '#Admin/attachments',
            'label' => 'Attachments',
            'iconClass' => 'fas fa-paperclip',
            'description' => 'attachments'
          ],
          8 => (object) [
            'url' => '#Admin/jobs',
            'label' => 'Jobs',
            'iconClass' => 'fas fa-list-ul',
            'description' => 'jobs'
          ],
          9 => (object) [
            'url' => '#Admin/authenticationProviders',
            'label' => 'Authentication Providers',
            'iconClass' => 'fas fa-sign-in-alt',
            'description' => 'authenticationProviders'
          ],
          10 => (object) [
            'url' => '#Admin/emailAddresses',
            'label' => 'Email Addresses',
            'iconClass' => 'fas fa-envelope',
            'description' => 'emailAddresses'
          ],
          11 => (object) [
            'url' => '#Admin/phoneNumbers',
            'label' => 'Phone Numbers',
            'iconClass' => 'fas fa-phone',
            'description' => 'phoneNumbers'
          ]
        ],
        'order' => 25
      ],
      'misc' => (object) [
        'label' => 'Misc',
        'itemList' => [
          0 => (object) [
            'url' => '#Admin/formulaSandbox',
            'label' => 'Formula Sandbox',
            'iconClass' => 'fas fa-code',
            'description' => 'formulaSandbox',
            'view' => 'views/admin/formula-sandbox/index'
          ]
        ],
        'order' => 26
      ]
    ],
    'api' => (object) [
      'globalMiddlewareClassNameList' => [],
      'routeMiddlewareClassNameListMap' => (object) [],
      'controllerMiddlewareClassNameListMap' => (object) [],
      'controllerActionMiddlewareClassNameListMap' => (object) []
    ],
    'appParams' => (object) [
      'templateEntityTypeList' => (object) [
        'className' => 'Espo\\Classes\\AppParams\\TemplateEntityTypeList'
      ],
      'extensions' => (object) [
        'className' => 'Espo\\Classes\\AppParams\\Extensions'
      ]
    ],
    'authentication' => (object) [
      'beforeLoginHookClassNameList' => [
        0 => 'Espo\\Core\\Authentication\\Hook\\Hooks\\FailedAttemptsLimit'
      ],
      'onFailHookClassNameList' => [],
      'onSuccessHookClassNameList' => [],
      'onSuccessByTokenHookClassNameList' => [],
      'onSecondStepRequiredHookClassNameList' => []
    ],
    'authentication2FAMethods' => (object) [
      'Totp' => (object) [
        'settings' => (object) [
          'isAvailable' => true
        ],
        'userApplyView' => 'views/user-security/modals/totp',
        'loginClassName' => 'Espo\\Core\\Authentication\\TwoFactor\\Totp\\TotpLogin',
        'userSetupClassName' => 'Espo\\Core\\Authentication\\TwoFactor\\Totp\\TotpUserSetup'
      ],
      'Email' => (object) [
        'settings' => (object) [
          'isAvailable' => true
        ],
        'userApplyView' => 'views/user-security/modals/two-factor-email',
        'loginClassName' => 'Espo\\Core\\Authentication\\TwoFactor\\Email\\EmailLogin',
        'userSetupClassName' => 'Espo\\Core\\Authentication\\TwoFactor\\Email\\EmailUserSetup'
      ],
      'Sms' => (object) [
        'settings' => (object) [
          'isAvailable' => true
        ],
        'userApplyView' => 'views/user-security/modals/two-factor-sms',
        'loginClassName' => 'Espo\\Core\\Authentication\\TwoFactor\\Sms\\SmsLogin',
        'userSetupClassName' => 'Espo\\Core\\Authentication\\TwoFactor\\Sms\\SmsUserSetup'
      ]
    ],
    'cleanup' => (object) [
      'reminders' => (object) [
        'className' => 'Espo\\Classes\\Cleanup\\Reminders',
        'order' => 10
      ],
      'webhookQueue' => (object) [
        'className' => 'Espo\\Classes\\Cleanup\\WebhookQueue',
        'order' => 11
      ],
      'twoFactorCodes' => (object) [
        'className' => 'Espo\\Classes\\Cleanup\\TwoFactorCodes'
      ],
      'massActions' => (object) [
        'className' => 'Espo\\Classes\\Cleanup\\MassActions'
      ],
      'exports' => (object) [
        'className' => 'Espo\\Classes\\Cleanup\\Exports'
      ],
      'passwordChangeRequests' => (object) [
        'className' => 'Espo\\Classes\\Cleanup\\PasswordChangeRequests'
      ],
      'subscribers' => (object) [
        'className' => 'Espo\\Classes\\Cleanup\\Subscribers'
      ]
    ],
    'client' => (object) [
      'scriptList' => [
        0 => 'client/lib/espo.js',
        1 => 'client/lib/espo-main.js'
      ],
      'developerModeScriptList' => [
        0 => 'client/src/loader.js'
      ],
      'linkList' => [
        0 => (object) [
          'href' => 'client/fonts/open-sans/open-sans-v16-cyrillic_latin_cyrillic-ext_latin-ext-regular.woff2',
          'as' => 'font',
          'type' => 'font/woff2',
          'rel' => 'preload',
          'noTimestamp' => true,
          'crossorigin' => true
        ],
        1 => (object) [
          'href' => 'client/fonts/open-sans/open-sans-v16-cyrillic_latin_cyrillic-ext_latin-ext-600.woff2',
          'as' => 'font',
          'type' => 'font/woff2',
          'rel' => 'preload',
          'noTimestamp' => true,
          'crossorigin' => true
        ],
        2 => (object) [
          'href' => 'client/fonts/fa-solid-900.woff2',
          'as' => 'font',
          'type' => 'font/woff2',
          'rel' => 'preload',
          'noTimestamp' => true,
          'crossorigin' => true
        ],
        3 => (object) [
          'href' => 'client/fonts/fa-regular-400.woff2',
          'as' => 'font',
          'type' => 'font/woff2',
          'rel' => 'preload',
          'noTimestamp' => true,
          'crossorigin' => true
        ]
      ]
    ],
    'clientRoutes' => (object) [
      'AddressMap/view/:entityType/:id/:field' => (object) [
        'params' => (object) [
          'controller' => 'AddressMap',
          'action' => 'view'
        ]
      ],
      'Admin/:page' => (object) [
        'params' => (object) [
          'controller' => 'Admin',
          'action' => 'page'
        ],
        'order' => 1
      ],
      'Admin/:page/:options' => (object) [
        'params' => (object) [
          'controller' => 'Admin',
          'action' => 'page'
        ],
        'order' => 1
      ],
      ':entityType/activities/:id/:targetEntityType' => (object) [
        'params' => (object) [
          'controller' => 'Activities',
          'action' => 'activities'
        ],
        'order' => 1
      ],
      ':entityType/history/:id/:targetEntityType' => (object) [
        'params' => (object) [
          'controller' => 'Activities',
          'action' => 'history'
        ],
        'order' => 1
      ]
    ],
    'complexExpression' => (object) [
      'functionList' => [
        0 => (object) [
          'name' => 'EQUAL',
          'insertText' => 'EQUAL:(VALUE1, VALUE2)',
          'returnType' => 'bool'
        ],
        1 => (object) [
          'name' => 'NOT_EQUAL',
          'insertText' => 'NOT_EQUAL:(VALUE1, VALUE2)',
          'returnType' => 'bool'
        ],
        2 => (object) [
          'name' => 'OR',
          'insertText' => 'OR:(EXPR1, EXPR2)',
          'returnType' => 'bool'
        ],
        3 => (object) [
          'name' => 'AND',
          'insertText' => 'AND:(EXPR1, EXPR2)',
          'returnType' => 'bool'
        ],
        4 => (object) [
          'name' => 'NOT',
          'insertText' => 'NOT:(EXPR)',
          'returnType' => 'bool'
        ],
        5 => (object) [
          'name' => 'LIKE',
          'insertText' => 'LIKE:(VALUE, \'pattern%\')',
          'returnType' => 'bool'
        ],
        6 => (object) [
          'name' => 'NOT_LIKE',
          'insertText' => 'NOT_LIKE:(VALUE, \'pattern%\')',
          'returnType' => 'bool'
        ],
        7 => (object) [
          'name' => 'GREATER_THAN',
          'insertText' => 'GREATER_THAN:(VALUE1, VALUE2)',
          'returnType' => 'bool'
        ],
        8 => (object) [
          'name' => 'LESS_THAN',
          'insertText' => 'LESS_THAN:(VALUE1, VALUE2)',
          'returnType' => 'bool'
        ],
        9 => (object) [
          'name' => 'GREATER_THAN_OR_EQUAL',
          'insertText' => 'GREATER_THAN_OR_EQUAL:(VALUE1, VALUE2)',
          'returnType' => 'bool'
        ],
        10 => (object) [
          'name' => 'LESS_THAN_OR_EQUAL',
          'insertText' => 'LESS_THAN_OR_EQUAL:(VALUE1, VALUE2)',
          'returnType' => 'bool'
        ],
        11 => (object) [
          'name' => 'IS_NULL',
          'insertText' => 'IS_NULL:(VALUE)',
          'returnType' => 'bool'
        ],
        12 => (object) [
          'name' => 'IS_NOT_NULL',
          'insertText' => 'IS_NOT_NULL:(VALUE)',
          'returnType' => 'bool'
        ],
        13 => (object) [
          'name' => 'IN',
          'insertText' => 'IN:(VALUE, VALUE1, VALUE2, VALUE3)',
          'returnType' => 'bool'
        ],
        14 => (object) [
          'name' => 'NOT_IN',
          'insertText' => 'NOT_IN:(VALUE, VALUE1, VALUE2, VALUE3)',
          'returnType' => 'bool'
        ],
        15 => (object) [
          'name' => 'IF',
          'insertText' => 'IF:(CONDITION, THEN_VALUE, ELSE_VALUE)'
        ],
        16 => (object) [
          'name' => 'SWITCH',
          'insertText' => 'SWITCH:(CONDITION1, VALUE1, CONDITION2, VALUE2, ELSE_VALUE)'
        ],
        17 => (object) [
          'name' => 'MAP',
          'insertText' => 'MAP:(EXPR, WHEN_VALUE1, THEN_VALUE1, WHEN_VALUE2, THEN_VALUE2, ELSE_VALUE)'
        ],
        18 => (object) [
          'name' => 'MONTH_NUMBER',
          'insertText' => 'MONTH_NUMBER:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        19 => (object) [
          'name' => 'WEEK_NUMBER_0',
          'insertText' => 'WEEK_NUMBER_0:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        20 => (object) [
          'name' => 'WEEK_NUMBER_1',
          'insertText' => 'WEEK_NUMBER_1:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        21 => (object) [
          'name' => 'DAYOFWEEK',
          'insertText' => 'DAYOFWEEK:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        22 => (object) [
          'name' => 'DAYOFMONTH',
          'insertText' => 'DAYOFMONTH:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        23 => (object) [
          'name' => 'YEAR',
          'insertText' => 'YEAR:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        24 => (object) [
          'name' => 'HOUR',
          'insertText' => 'HOUR:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        25 => (object) [
          'name' => 'MINUTE',
          'insertText' => 'MINUTE:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        26 => (object) [
          'name' => 'MONTH',
          'insertText' => 'MONTH:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        27 => (object) [
          'name' => 'QUARTER',
          'insertText' => 'QUARTER:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        28 => (object) [
          'name' => 'WEEK',
          'insertText' => 'WEEK:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        29 => (object) [
          'name' => 'NOW',
          'insertText' => 'NOW:()',
          'returnType' => 'string'
        ],
        30 => (object) [
          'name' => 'TZ',
          'insertText' => 'TZ:(DATE_VALUE, OFFSET)',
          'returnType' => 'string'
        ],
        31 => (object) [
          'name' => 'UNIX_TIMESTAMP',
          'insertText' => 'UNIX_TIMESTAMP:(DATE_VALUE)',
          'returnType' => 'int'
        ],
        32 => (object) [
          'name' => 'CONCAT',
          'insertText' => 'CONCAT:(STRING1, STRING2)',
          'returnType' => 'string'
        ],
        33 => (object) [
          'name' => 'LEFT',
          'insertText' => 'LEFT:(STRING, NUMBER_OF_CHARACTERS)',
          'returnType' => 'string'
        ],
        34 => (object) [
          'name' => 'LOWER',
          'insertText' => 'LOWER:(STRING)',
          'returnType' => 'string'
        ],
        35 => (object) [
          'name' => 'UPPER',
          'insertText' => 'UPPER:(STRING)',
          'returnType' => 'string'
        ],
        36 => (object) [
          'name' => 'TRIM',
          'insertText' => 'TRIM:(STRING)',
          'returnType' => 'string'
        ],
        37 => (object) [
          'name' => 'CHAR_LENGTH',
          'insertText' => 'CHAR_LENGTH:(STRING)',
          'returnType' => 'int'
        ],
        38 => (object) [
          'name' => 'BINARY',
          'insertText' => 'BINARY:(STRING)',
          'returnType' => 'string'
        ],
        39 => (object) [
          'name' => 'REPLACE',
          'insertText' => 'REPLACE:(HAYSTACK, NEEDLE, REPLACE_WITH)',
          'returnType' => 'string'
        ],
        40 => (object) [
          'name' => 'ADD',
          'insertText' => 'ADD:(VALUE1, VALUE2)',
          'returnType' => 'float'
        ],
        41 => (object) [
          'name' => 'SUB',
          'insertText' => 'SUB:(VALUE1, VALUE2)',
          'returnType' => 'float'
        ],
        42 => (object) [
          'name' => 'MUL',
          'insertText' => 'MUL:(VALUE1, VALUE2)',
          'returnType' => 'float'
        ],
        43 => (object) [
          'name' => 'DIV',
          'insertText' => 'DIV:(VALUE1, VALUE2)',
          'returnType' => 'float'
        ],
        44 => (object) [
          'name' => 'MOD',
          'insertText' => 'MOD:(VALUE1, VALUE2)',
          'returnType' => 'float'
        ],
        45 => (object) [
          'name' => 'FLOOR',
          'insertText' => 'FLOOR:(VALUE)',
          'returnType' => 'int'
        ],
        46 => (object) [
          'name' => 'CEIL',
          'insertText' => 'CEIL:(VALUE)',
          'returnType' => 'int'
        ],
        47 => (object) [
          'name' => 'ROUND',
          'insertText' => 'ROUND:(VALUE, PRECISION)',
          'returnType' => 'float'
        ],
        48 => (object) [
          'name' => 'COUNT',
          'insertText' => 'COUNT:(EXPR)',
          'returnType' => 'int'
        ],
        49 => (object) [
          'name' => 'SUM',
          'insertText' => 'SUM:(EXPR)',
          'returnType' => 'int|float'
        ],
        50 => (object) [
          'name' => 'AVG',
          'insertText' => 'AVG:(EXPR)',
          'returnType' => 'float'
        ],
        51 => (object) [
          'name' => 'MAX',
          'insertText' => 'MAX:(EXPR)',
          'returnType' => 'int|float'
        ],
        52 => (object) [
          'name' => 'MIN',
          'insertText' => 'MIN:(EXPR)',
          'returnType' => 'int|float'
        ]
      ]
    ],
    'config' => (object) [
      'entityTypeListParamList' => [
        0 => 'tabList',
        1 => 'quickCreateList',
        2 => 'globalSearchEntityList',
        3 => 'assignmentEmailNotificationsEntityList',
        4 => 'assignmentNotificationsEntityList',
        5 => 'calendarEntityList',
        6 => 'streamEmailNotificationsEntityList',
        7 => 'activitiesEntityList',
        8 => 'historyEntityList',
        9 => 'streamEmailNotificationsTypeList',
        10 => 'emailKeepParentTeamsEntityList'
      ],
      'params' => (object) [
        'isDeveloperMode' => (object) [
          'readOnly' => true
        ],
        'clientSecurityHeadersDisabled' => (object) [
          'readOnly' => true
        ],
        'clientCspDisabled' => (object) [
          'readOnly' => true
        ],
        'clientCspScriptSourceList' => (object) [
          'readOnly' => true
        ],
        'clientStrictTransportSecurityHeaderDisabled' => (object) [
          'readOnly' => true
        ],
        'clientXFrameOptionsHeaderDisabled' => (object) [
          'readOnly' => true
        ],
        'systemUserId' => (object) [
          'level' => 'admin',
          'readOnly' => true
        ],
        'smtpPassword' => (object) [
          'level' => 'internal'
        ],
        'awsS3Storage' => (object) [
          'level' => 'system'
        ],
        'defaultFileStorage' => (object) [
          'level' => 'admin',
          'readOnly' => true
        ],
        'smsProvider' => (object) [
          'level' => 'admin'
        ],
        'authAnotherUserDisabled' => (object) [
          'level' => 'admin',
          'readOnly' => true
        ],
        'workingTimeCalendar' => (object) [
          'level' => 'admin'
        ],
        'ldapPassword' => (object) [
          'level' => 'internal'
        ],
        'oidcClientId' => (object) [
          'level' => 'admin'
        ],
        'oidcClientSecret' => (object) [
          'level' => 'internal'
        ],
        'oidcAuthorizationEndpoint' => (object) [
          'level' => 'admin'
        ],
        'oidcTokenEndpoint' => (object) [
          'level' => 'admin'
        ],
        'oidcJwksEndpoint' => (object) [
          'level' => 'admin'
        ],
        'oidcJwksCachePeriod' => (object) [
          'level' => 'admin'
        ],
        'oidcJwtSignatureAlgorithmList' => (object) [
          'level' => 'admin'
        ],
        'oidcScopes' => (object) [
          'level' => 'admin'
        ],
        'oidcGroupClaim' => (object) [
          'level' => 'admin'
        ],
        'oidcCreateUser' => (object) [
          'level' => 'admin'
        ],
        'oidcUsernameClaim' => (object) [
          'level' => 'admin'
        ],
        'oidcTeamsIds' => (object) [
          'level' => 'admin'
        ],
        'oidcTeamsNames' => (object) [
          'level' => 'admin'
        ],
        'oidcTeamsColumns' => (object) [
          'level' => 'admin'
        ],
        'oidcSync' => (object) [
          'level' => 'admin'
        ],
        'oidcSyncTeams' => (object) [
          'level' => 'admin'
        ],
        'oidcFallback' => (object) [
          'level' => 'admin'
        ],
        'oidcAllowRegularUserFallback' => (object) [
          'level' => 'admin'
        ],
        'oidcAllowAdminUser' => (object) [
          'level' => 'admin'
        ],
        'oidcAuthorizationPrompt' => (object) [
          'level' => 'admin'
        ],
        'oidcAuthorizationMaxAge' => (object) [
          'level' => 'admin'
        ],
        'oidcLogoutUrl' => (object) [
          'level' => 'admin'
        ],
        'apiCorsAllowedMethodList' => (object) [
          'level' => 'admin'
        ],
        'apiCorsAllowedHeaderList' => (object) [
          'level' => 'admin'
        ],
        'apiCorsAllowedOriginList' => (object) [
          'level' => 'admin'
        ],
        'apiCorsMaxAge' => (object) [
          'level' => 'admin'
        ],
        'customExportManifest' => (object) [
          'level' => 'admin'
        ]
      ]
    ],
    'consoleCommands' => (object) [
      'import' => (object) [
        'className' => 'Espo\\Classes\\ConsoleCommands\\Import',
        'listed' => true
      ],
      'clearCache' => (object) [
        'listed' => true
      ],
      'rebuild' => (object) [
        'listed' => true
      ],
      'appInfo' => (object) [
        'listed' => true
      ],
      'setPassword' => (object) [
        'listed' => true
      ],
      'upgrade' => (object) [
        'listed' => true
      ],
      'extension' => (object) [
        'listed' => true
      ],
      'runJob' => (object) [
        'listed' => true
      ],
      'version' => (object) [
        'listed' => true
      ],
      'createAdminUser' => (object) [
        'className' => 'Espo\\Classes\\ConsoleCommands\\CreateAdminUser',
        'listed' => true
      ],
      'rebuildCategoryPaths' => (object) [
        'className' => 'Espo\\Classes\\ConsoleCommands\\RebuildCategoryPaths',
        'listed' => false
      ],
      'populateArrayValues' => (object) [
        'className' => 'Espo\\Classes\\ConsoleCommands\\PopulateArrayValues',
        'listed' => false
      ],
      'populateNumbers' => (object) [
        'className' => 'Espo\\Classes\\ConsoleCommands\\PopulateNumbers',
        'listed' => false
      ]
    ],
    'containerServices' => (object) [
      'authTokenManager' => (object) [
        'className' => 'Espo\\Core\\Authentication\\AuthToken\\EspoManager'
      ],
      'ormMetadataData' => (object) [
        'className' => 'Espo\\Core\\Utils\\Metadata\\OrmMetadataData'
      ],
      'classFinder' => (object) [
        'className' => 'Espo\\Core\\Utils\\ClassFinder'
      ],
      'fileStorageManager' => (object) [
        'className' => 'Espo\\Core\\FileStorage\\Manager'
      ],
      'jobManager' => (object) [
        'className' => 'Espo\\Core\\Job\\JobManager'
      ],
      'webSocketSubmission' => (object) [
        'className' => 'Espo\\Core\\WebSocket\\Submission'
      ],
      'crypt' => (object) [
        'className' => 'Espo\\Core\\Utils\\Crypt'
      ],
      'passwordHash' => (object) [
        'className' => 'Espo\\Core\\Utils\\PasswordHash'
      ],
      'number' => (object) [
        'loaderClassName' => 'Espo\\Core\\Loaders\\NumberUtil'
      ],
      'selectBuilderFactory' => (object) [
        'className' => 'Espo\\Core\\Select\\SelectBuilderFactory'
      ],
      'selectManagerFactory' => (object) [
        'className' => 'Espo\\Core\\Select\\SelectManagerFactory'
      ],
      'serviceFactory' => (object) [
        'className' => 'Espo\\Core\\ServiceFactory'
      ],
      'recordServiceContainer' => (object) [
        'className' => 'Espo\\Core\\Record\\ServiceContainer'
      ],
      'recordHookManager' => (object) [
        'className' => 'Espo\\Core\\Record\\HookManager'
      ],
      'templateFileManager' => (object) [
        'className' => 'Espo\\Core\\Utils\\TemplateFileManager'
      ],
      'webhookManager' => (object) [
        'className' => 'Espo\\Core\\Webhook\\Manager'
      ],
      'hookManager' => (object) [
        'className' => 'Espo\\Core\\HookManager'
      ],
      'clientManager' => (object) [
        'className' => 'Espo\\Core\\Utils\\ClientManager'
      ],
      'themeManager' => (object) [
        'className' => 'Espo\\Core\\Utils\\ThemeManager'
      ],
      'fieldUtil' => (object) [
        'className' => 'Espo\\Core\\Utils\\FieldUtil'
      ],
      'fieldManager' => (object) [
        'className' => 'Espo\\Core\\Utils\\FieldManager'
      ],
      'fieldManagerUtil' => (object) [
        'className' => 'Espo\\Core\\Utils\\FieldManagerUtil'
      ],
      'emailSender' => (object) [
        'className' => 'Espo\\Core\\Mail\\EmailSender'
      ],
      'mailSender' => (object) [
        'className' => 'Espo\\Core\\Mail\\Sender'
      ],
      'htmlizerFactory' => (object) [
        'className' => 'Espo\\Core\\Htmlizer\\HtmlizerFactory'
      ],
      'fieldValidationManager' => (object) [
        'className' => 'Espo\\Core\\FieldValidation\\FieldValidationManager'
      ],
      'assignmentCheckerManager' => (object) [
        'className' => 'Espo\\Core\\Acl\\AssignmentChecker\\AssignmentCheckerManager'
      ],
      'hasher' => (object) [
        'className' => 'Espo\\Core\\Utils\\Hasher'
      ],
      'emailFilterManager' => (object) [
        'className' => 'Espo\\Core\\Utils\\EmailFilterManager'
      ],
      'externalAccountClientManager' => (object) [
        'className' => 'Espo\\Core\\ExternalAccount\\ClientManager'
      ],
      'formulaManager' => (object) [
        'className' => 'Espo\\Core\\Formula\\Manager'
      ],
      'user' => (object) [
        'settable' => true
      ]
    ],
    'currency' => (object) [
      'symbolMap' => (object) [
        'AED' => 'د.إ',
        'AFN' => '؋',
        'ALL' => 'L',
        'ANG' => 'ƒ',
        'AOA' => 'Kz',
        'ARS' => '$',
        'AUD' => '$',
        'AWG' => 'ƒ',
        'AZN' => '₼',
        'BAM' => 'KM',
        'BBD' => '$',
        'BDT' => '৳',
        'BGN' => 'лв',
        'BHD' => '.د.ب',
        'BIF' => 'FBu',
        'BMD' => '$',
        'BND' => '$',
        'BOB' => 'Bs.',
        'BRL' => 'R$',
        'BSD' => '$',
        'BTN' => 'Nu.',
        'BWP' => 'P',
        'BYN' => 'Br',
        'BYR' => 'p.',
        'BZD' => 'BZ$',
        'CAD' => '$',
        'CDF' => 'FC',
        'CHF' => 'Fr.',
        'CLP' => '$',
        'CNY' => '¥',
        'COP' => '$',
        'CRC' => '₡',
        'CUC' => '$',
        'CUP' => '₱',
        'CVE' => '$',
        'CZK' => 'Kč',
        'DJF' => 'Fdj',
        'DKK' => 'kr',
        'DOP' => 'RD$',
        'DZD' => 'دج',
        'EEK' => 'kr',
        'EGP' => '£',
        'ERN' => 'Nfk',
        'ETB' => 'Br',
        'EUR' => '€',
        'FJD' => '$',
        'FKP' => '£',
        'GBP' => '£',
        'GEL' => '₾',
        'GGP' => '£',
        'GHC' => '₵',
        'GHS' => 'GH₵',
        'GIP' => '£',
        'GMD' => 'D',
        'GNF' => 'FG',
        'GTQ' => 'Q',
        'GYD' => '$',
        'HKD' => '$',
        'HNL' => 'L',
        'HRK' => 'kn',
        'HTG' => 'G',
        'HUF' => 'Ft',
        'IDR' => 'Rp',
        'ILS' => '₪',
        'IMP' => '£',
        'INR' => '₹',
        'IQD' => 'ع.د',
        'IRR' => '﷼',
        'ISK' => 'kr',
        'JEP' => '£',
        'JMD' => 'J$',
        'JPY' => '¥',
        'KES' => 'KSh',
        'KGS' => 'лв',
        'KHR' => '៛',
        'KMF' => 'CF',
        'KPW' => '₩',
        'KRW' => '₩',
        'KYD' => '$',
        'KZT' => '₸',
        'LAK' => '₭',
        'LBP' => '£',
        'LKR' => '₨',
        'LRD' => '$',
        'LSL' => 'M',
        'LTL' => 'Lt',
        'LVL' => 'Ls',
        'MAD' => 'MAD',
        'MDL' => 'lei',
        'MGA' => 'Ar',
        'MKD' => 'ден',
        'MMK' => 'K',
        'MNT' => '₮',
        'MOP' => 'MOP$',
        'MUR' => '₨',
        'MVR' => 'Rf',
        'MWK' => 'MK',
        'MXN' => '$',
        'MYR' => 'RM',
        'MZN' => 'MT',
        'NAD' => '$',
        'NGN' => '₦',
        'NIO' => 'C$',
        'NOK' => 'kr',
        'NPR' => '₨',
        'NZD' => '$',
        'OMR' => '﷼',
        'PAB' => 'B/.',
        'PEN' => 'S/.',
        'PGK' => 'K',
        'PHP' => '₱',
        'PKR' => '₨',
        'PLN' => 'zł',
        'PYG' => 'Gs',
        'QAR' => '﷼',
        'RMB' => '￥',
        'RON' => 'lei',
        'RSD' => 'Дин.',
        'RUB' => '₽',
        'RWF' => 'R₣',
        'SAR' => '﷼',
        'SBD' => '$',
        'SCR' => '₨',
        'SDG' => 'ج.س.',
        'SEK' => 'kr',
        'SGD' => '$',
        'SHP' => '£',
        'SLL' => 'Le',
        'SOS' => 'S',
        'SRD' => '$',
        'SSP' => '£',
        'STD' => 'Db',
        'SVC' => '$',
        'SYP' => '£',
        'SZL' => 'E',
        'THB' => '฿',
        'TJS' => 'SM',
        'TMT' => 'T',
        'TND' => 'د.ت',
        'TOP' => 'T$',
        'TRL' => '₤',
        'TRY' => '₺',
        'TTD' => 'TT$',
        'TVD' => '$',
        'TWD' => 'NT$',
        'TZS' => 'TSh',
        'UAH' => '₴',
        'UGX' => 'USh',
        'USD' => '$',
        'UYU' => '$U',
        'UZS' => 'лв',
        'VEF' => 'Bs',
        'VND' => '₫',
        'VUV' => 'VT',
        'WST' => 'WS$',
        'XAF' => 'FCFA',
        'XBT' => 'Ƀ',
        'XCD' => '$',
        'XOF' => 'CFA',
        'XPF' => '₣',
        'YER' => '﷼',
        'ZAR' => 'R',
        'ZWD' => 'Z$',
        'BTC' => '฿'
      ],
      'list' => [
        0 => 'AFN',
        1 => 'AED',
        2 => 'ALL',
        3 => 'ANG',
        4 => 'AOA',
        5 => 'ARS',
        6 => 'AUD',
        7 => 'BAM',
        8 => 'BGN',
        9 => 'BHD',
        10 => 'BND',
        11 => 'BOB',
        12 => 'BRL',
        13 => 'BWP',
        14 => 'BYN',
        15 => 'CAD',
        16 => 'CHF',
        17 => 'CLP',
        18 => 'CNY',
        19 => 'COP',
        20 => 'CRC',
        21 => 'CVE',
        22 => 'CZK',
        23 => 'DKK',
        24 => 'DOP',
        25 => 'DZD',
        26 => 'EGP',
        27 => 'EUR',
        28 => 'FJD',
        29 => 'GBP',
        30 => 'GNF',
        31 => 'GTQ',
        32 => 'HKD',
        33 => 'HNL',
        34 => 'HRK',
        35 => 'HUF',
        36 => 'IDR',
        37 => 'ILS',
        38 => 'INR',
        39 => 'IRR',
        40 => 'JMD',
        41 => 'JOD',
        42 => 'JPY',
        43 => 'KES',
        44 => 'KRW',
        45 => 'KWD',
        46 => 'KYD',
        47 => 'KZT',
        48 => 'LBP',
        49 => 'LKR',
        50 => 'MAD',
        51 => 'MDL',
        52 => 'MKD',
        53 => 'MMK',
        54 => 'MUR',
        55 => 'MXN',
        56 => 'MYR',
        57 => 'MZN',
        58 => 'NAD',
        59 => 'NGN',
        60 => 'NIO',
        61 => 'NOK',
        62 => 'NPR',
        63 => 'NZD',
        64 => 'OMR',
        65 => 'PEN',
        66 => 'PGK',
        67 => 'PHP',
        68 => 'PKR',
        69 => 'PLN',
        70 => 'PYG',
        71 => 'QAR',
        72 => 'RON',
        73 => 'RSD',
        74 => 'RUB',
        75 => 'SAR',
        76 => 'SCR',
        77 => 'SEK',
        78 => 'SGD',
        79 => 'SLL',
        80 => 'SVC',
        81 => 'THB',
        82 => 'TND',
        83 => 'TRY',
        84 => 'TTD',
        85 => 'TWD',
        86 => 'TZS',
        87 => 'UAH',
        88 => 'UGX',
        89 => 'USD',
        90 => 'UYU',
        91 => 'UZS',
        92 => 'VND',
        93 => 'XAF',
        94 => 'YER',
        95 => 'ZAR',
        96 => 'ZMW',
        97 => 'ZWL'
      ]
    ],
    'currencyConversion' => (object) [
      'entityConverterClassNameMap' => (object) []
    ],
    'databasePlatforms' => (object) [
      'Mysql' => (object) [
        'detailsProviderClassName' => 'Espo\\Core\\Utils\\Database\\DetailsProviders\\MysqlDetailsProvider',
        'dbalConnectionFactoryClassName' => 'Espo\\Core\\Utils\\Database\\Dbal\\Factories\\MysqlConnectionFactory',
        'indexHelperClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\IndexHelpers\\MysqlIndexHelper',
        'columnPreparatorClassName' => 'Espo\\Core\\Utils\\Database\\Schema\\ColumnPreparators\\MysqlColumnPreparator',
        'preRebuildActionClassNameList' => [
          0 => 'Espo\\Core\\Utils\\Database\\Schema\\RebuildActions\\PrepareForFulltextIndex'
        ],
        'postRebuildActionClassNameList' => [],
        'dbalTypeClassNameMap' => (object) [
          'mediumtext' => 'Espo\\Core\\Utils\\Database\\Dbal\\Types\\MediumtextType',
          'longtext' => 'Espo\\Core\\Utils\\Database\\Dbal\\Types\\LongtextType',
          'uuid' => 'Espo\\Core\\Utils\\Database\\Dbal\\Types\\UuidType'
        ]
      ],
      'Postgresql' => (object) [
        'detailsProviderClassName' => 'Espo\\Core\\Utils\\Database\\DetailsProviders\\PostgresqlDetailsProvider',
        'dbalConnectionFactoryClassName' => 'Espo\\Core\\Utils\\Database\\Dbal\\Factories\\PostgresqlConnectionFactory',
        'indexHelperClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\IndexHelpers\\PostgresqlIndexHelper',
        'columnPreparatorClassName' => 'Espo\\Core\\Utils\\Database\\Schema\\ColumnPreparators\\PostgresqlColumnPreparator',
        'dbalTypeClassNameMap' => (object) [
          'uuid' => 'Espo\\Core\\Utils\\Database\\Dbal\\Types\\UuidType'
        ]
      ]
    ],
    'dateTime' => (object) [
      'dateFormatList' => [
        0 => 'DD.MM.YYYY',
        1 => 'MM/DD/YYYY',
        2 => 'DD/MM/YYYY',
        3 => 'YYYY-MM-DD',
        4 => 'DD. MM. YYYY'
      ],
      'timeFormatList' => [
        0 => 'HH:mm',
        1 => 'hh:mma',
        2 => 'hh:mmA',
        3 => 'hh:mm A',
        4 => 'hh:mm a'
      ]
    ],
    'defaultDashboardLayouts' => (object) [
      'Standard' => [
        0 => (object) [
          'name' => 'My Espo',
          'layout' => [
            0 => (object) [
              'id' => 'defaultActivities',
              'name' => 'Activities',
              'x' => 2,
              'y' => 2,
              'width' => 2,
              'height' => 2
            ],
            1 => (object) [
              'id' => 'defaultStream',
              'name' => 'Stream',
              'x' => 0,
              'y' => 0,
              'width' => 2,
              'height' => 4
            ],
            2 => (object) [
              'id' => 'defaultTasks',
              'name' => 'Tasks',
              'x' => 2,
              'y' => 4,
              'width' => 2,
              'height' => 2
            ]
          ]
        ]
      ]
    ],
    'defaultDashboardOptions' => (object) [
      'Standard' => (object) [
        'defaultStream' => (object) [
          'displayRecords' => 10
        ]
      ]
    ],
    'entityManager' => (object) [
      'createHookClassNameList' => [
        0 => 'Espo\\Tools\\EntityManager\\Hook\\Hooks\\PlusCreateHook',
        1 => 'Espo\\Tools\\EntityManager\\Hook\\Hooks\\EventCreateHook'
      ],
      'deleteHookClassNameList' => [
        0 => 'Espo\\Tools\\EntityManager\\Hook\\Hooks\\PlusDeleteHook',
        1 => 'Espo\\Tools\\EntityManager\\Hook\\Hooks\\EventDeleteHook'
      ],
      'updateHookClassNameList' => []
    ],
    'entityManagerParams' => (object) [
      'Global' => (object) [
        'optimisticConcurrencyControl' => (object) [
          'location' => 'entityDefs',
          'fieldDefs' => (object) [
            'type' => 'bool',
            'tooltip' => true
          ]
        ]
      ],
      '@Company' => (object) [
        'updateDuplicateCheck' => (object) [
          'location' => 'recordDefs',
          'fieldDefs' => (object) [
            'type' => 'bool',
            'tooltip' => true
          ]
        ],
        'duplicateCheckFieldList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'tooltip' => true,
            'view' => 'views/admin/entity-manager/fields/duplicate-check-field-list'
          ]
        ]
      ],
      '@Person' => (object) [
        'updateDuplicateCheck' => (object) [
          'location' => 'recordDefs',
          'fieldDefs' => (object) [
            'type' => 'bool',
            'tooltip' => true
          ]
        ],
        'duplicateCheckFieldList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'tooltip' => true,
            'view' => 'views/admin/entity-manager/fields/duplicate-check-field-list'
          ]
        ]
      ],
      '@Base' => (object) [
        'updateDuplicateCheck' => (object) [
          'location' => 'recordDefs',
          'fieldDefs' => (object) [
            'type' => 'bool',
            'tooltip' => true
          ]
        ],
        'duplicateCheckFieldList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'tooltip' => true,
            'view' => 'views/admin/entity-manager/fields/duplicate-check-field-list'
          ]
        ]
      ],
      '@BasePlus' => (object) [
        'updateDuplicateCheck' => (object) [
          'location' => 'recordDefs',
          'fieldDefs' => (object) [
            'type' => 'bool',
            'tooltip' => true
          ]
        ],
        'duplicateCheckFieldList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'tooltip' => true,
            'view' => 'views/admin/entity-manager/fields/duplicate-check-field-list'
          ]
        ]
      ],
      'Account' => (object) [
        'updateDuplicateCheck' => (object) [
          'location' => 'recordDefs',
          'fieldDefs' => (object) [
            'type' => 'bool',
            'tooltip' => true
          ]
        ],
        'duplicateCheckFieldList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'tooltip' => true,
            'view' => 'views/admin/entity-manager/fields/duplicate-check-field-list'
          ]
        ]
      ],
      'Contact' => (object) [
        'updateDuplicateCheck' => (object) [
          'location' => 'recordDefs',
          'fieldDefs' => (object) [
            'type' => 'bool',
            'tooltip' => true
          ]
        ],
        'duplicateCheckFieldList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'tooltip' => true,
            'view' => 'views/admin/entity-manager/fields/duplicate-check-field-list'
          ]
        ]
      ],
      'Lead' => (object) [
        'updateDuplicateCheck' => (object) [
          'location' => 'recordDefs',
          'fieldDefs' => (object) [
            'type' => 'bool',
            'tooltip' => true
          ]
        ],
        'duplicateCheckFieldList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'bool',
            'tooltip' => true,
            'view' => 'views/admin/entity-manager/fields/duplicate-check-field-list'
          ]
        ]
      ],
      'Meeting' => (object) [
        'activityStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ],
        'historyStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ],
        'completedStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ],
        'canceledStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ]
      ],
      'Call' => (object) [
        'activityStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ],
        'historyStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ],
        'completedStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ],
        'canceledStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ]
      ],
      'Task' => (object) [
        'completedStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ],
        'canceledStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ]
      ],
      '@Event' => (object) [
        'activityStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ],
        'historyStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ],
        'completedStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ],
        'canceledStatusList' => (object) [
          'location' => 'scopes',
          'fieldDefs' => (object) [
            'type' => 'multiEnum',
            'required' => true,
            'tooltip' => true,
            'view' => 'crm:views/admin/entity-manager/fields/status-list'
          ]
        ]
      ]
    ],
    'entityTemplateList' => [
      0 => 'Base',
      1 => 'BasePlus',
      2 => 'Event',
      3 => 'Person',
      4 => 'Company'
    ],
    'entityTemplates' => (object) [
      'Base' => (object) [
        'entityClassName' => 'Espo\\Core\\Templates\\Entities\\Base',
        'repositoryClassName' => 'Espo\\Core\\Templates\\Repositories\\Base'
      ],
      'BasePlus' => (object) [
        'entityClassName' => 'Espo\\Core\\Templates\\Entities\\BasePlus',
        'repositoryClassName' => 'Espo\\Core\\Templates\\Repositories\\BasePlus'
      ],
      'Event' => (object) [
        'entityClassName' => 'Espo\\Core\\Templates\\Entities\\Event',
        'repositoryClassName' => 'Espo\\Core\\Templates\\Repositories\\Event'
      ],
      'Company' => (object) [
        'entityClassName' => 'Espo\\Core\\Templates\\Entities\\Company',
        'repositoryClassName' => 'Espo\\Core\\Templates\\Repositories\\Company'
      ],
      'Person' => (object) [
        'entityClassName' => 'Espo\\Core\\Templates\\Entities\\Person',
        'repositoryClassName' => 'Espo\\Core\\Templates\\Repositories\\Person'
      ]
    ],
    'export' => (object) [
      'formatList' => [
        0 => 'xlsx',
        1 => 'csv'
      ],
      'formatDefs' => (object) [
        'csv' => (object) [
          'processorClassName' => 'Espo\\Tools\\Export\\Format\\Csv\\Processor',
          'additionalFieldsLoaderClassName' => 'Espo\\Tools\\Export\\Format\\Csv\\AdditionalFieldsLoader',
          'mimeType' => 'text/csv',
          'fileExtension' => 'csv'
        ],
        'xlsx' => (object) [
          'processorClassName' => 'Espo\\Tools\\Export\\Format\\Xlsx\\Processor',
          'processorParamsHandler' => 'Espo\\Tools\\Export\\Format\\Xlsx\\ParamsHandler',
          'additionalFieldsLoaderClassName' => 'Espo\\Tools\\Export\\Format\\Xlsx\\AdditionalFieldsLoader',
          'mimeType' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
          'fileExtension' => 'xlsx',
          'cellValuePreparatorClassNameMap' => (object) [
            'link' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Link',
            'linkOne' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Link',
            'linkParent' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Link',
            'file' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Link',
            'bool' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Boolean',
            'int' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Integer',
            'float' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Floating',
            'currency' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Currency',
            'currencyConverted' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\CurrencyConverted',
            'personName' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\PersonName',
            'date' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Date',
            'datetime' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\DateTime',
            'datetimeOptional' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\DateTimeOptional',
            'linkMultiple' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\LinkMultiple',
            'attachmentMultiple' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\LinkMultiple',
            'address' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Address',
            'duration' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Duration',
            'enum' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\Enumeration',
            'multiEnum' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\MultiEnum',
            'array' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\MultiEnum',
            'checklist' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\MultiEnum',
            'urlMultiple' => 'Espo\\Tools\\Export\\Format\\Xlsx\\CellValuePreparators\\MultiEnum'
          ],
          'params' => (object) [
            'fields' => (object) [
              'lite' => (object) [
                'type' => 'bool',
                'default' => false,
                'tooltip' => true
              ],
              'recordLinks' => (object) [
                'type' => 'bool',
                'default' => false
              ],
              'title' => (object) [
                'type' => 'bool',
                'default' => false,
                'tooltip' => true
              ]
            ],
            'layout' => [
              0 => [
                0 => (object) [
                  'name' => 'lite'
                ],
                1 => (object) [
                  'name' => 'recordLinks'
                ],
                2 => (object) [
                  'name' => 'title'
                ]
              ]
            ],
            'dynamicLogic' => (object) [
              'recordLinks' => (object) [
                'visible' => (object) [
                  'conditionGroup' => [
                    0 => (object) [
                      'type' => 'isFalse',
                      'attribute' => 'xlsxLite'
                    ]
                  ]
                ]
              ],
              'title' => (object) [
                'visible' => (object) [
                  'conditionGroup' => [
                    0 => (object) [
                      'type' => 'isFalse',
                      'attribute' => 'xlsxLite'
                    ]
                  ]
                ]
              ]
            ]
          ]
        ]
      ]
    ],
    'fieldProcessing' => (object) [
      'readLoaderClassNameList' => [
        0 => 'Espo\\Core\\FieldProcessing\\Link\\HasOneLoader',
        1 => 'Espo\\Core\\FieldProcessing\\Link\\NotJoinedLoader',
        2 => 'Espo\\Core\\FieldProcessing\\LinkMultiple\\Loader',
        3 => 'Espo\\Core\\FieldProcessing\\LinkParent\\Loader',
        4 => 'Espo\\Core\\FieldProcessing\\EmailAddress\\Loader',
        5 => 'Espo\\Core\\FieldProcessing\\PhoneNumber\\Loader',
        6 => 'Espo\\Core\\FieldProcessing\\Stream\\FollowersLoader'
      ],
      'listLoaderClassNameList' => [
        0 => 'Espo\\Core\\FieldProcessing\\LinkParent\\Loader',
        1 => 'Espo\\Core\\FieldProcessing\\LinkMultiple\\ListLoader'
      ],
      'saverClassNameList' => [
        0 => 'Espo\\Core\\FieldProcessing\\EmailAddress\\Saver',
        1 => 'Espo\\Core\\FieldProcessing\\PhoneNumber\\Saver',
        2 => 'Espo\\Core\\FieldProcessing\\Relation\\Saver',
        3 => 'Espo\\Core\\FieldProcessing\\MultiEnum\\Saver',
        4 => 'Espo\\Core\\FieldProcessing\\File\\Saver',
        5 => 'Espo\\Core\\FieldProcessing\\Wysiwyg\\Saver'
      ]
    ],
    'file' => (object) [
      'extensionMimeTypeMap' => (object) [
        'aac' => [
          0 => 'audio/aac'
        ],
        'abw' => [
          0 => 'application/x-abiword'
        ],
        'arc' => [
          0 => 'application/x-freearc'
        ],
        'avif' => [
          0 => 'image/avif'
        ],
        'avi' => [
          0 => 'video/x-msvideo'
        ],
        'azw' => [
          0 => 'application/vnd.amazon.ebook'
        ],
        'bin' => [
          0 => 'application/octet-stream'
        ],
        'bmp' => [
          0 => 'image/bmp'
        ],
        'bz' => [
          0 => 'application/x-bzip'
        ],
        'bz2' => [
          0 => 'application/x-bzip2'
        ],
        'cda' => [
          0 => 'application/x-cdf'
        ],
        'csh' => [
          0 => 'application/x-csh'
        ],
        'css' => [
          0 => 'text/css'
        ],
        'csv' => [
          0 => 'text/csv'
        ],
        'doc' => [
          0 => 'application/msword'
        ],
        'docx' => [
          0 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ],
        'eot' => [
          0 => 'application/vnd.ms-fontobject'
        ],
        'epub' => [
          0 => 'application/epub+zip'
        ],
        'gz' => [
          0 => 'application/gzip'
        ],
        'gif' => [
          0 => 'image/gif'
        ],
        'htm' => [
          0 => 'text/html'
        ],
        'html' => [
          0 => 'text/html'
        ],
        'ico' => [
          0 => 'image/vnd.microsoft.icon'
        ],
        'ics' => [
          0 => 'text/calendar'
        ],
        'jar' => [
          0 => 'application/java-archive'
        ],
        'jpeg' => [
          0 => 'image/jpeg'
        ],
        'jpg' => [
          0 => 'image/jpeg'
        ],
        'js' => [
          0 => 'text/javascript'
        ],
        'json' => [
          0 => 'application/json'
        ],
        'jsonld' => [
          0 => 'application/ld+json'
        ],
        'mid' => [
          0 => 'audio/midi',
          1 => 'audio/x-midi'
        ],
        'midi' => [
          0 => 'audio/midi',
          1 => 'audio/x-midi'
        ],
        'mjs' => [
          0 => 'text/javascript'
        ],
        'mp3' => [
          0 => 'audio/mpeg'
        ],
        'mp4' => [
          0 => 'video/mp4'
        ],
        'mpeg' => [
          0 => 'video/mpeg'
        ],
        'mpkg' => [
          0 => 'application/vnd.apple.installer+xml'
        ],
        'odp' => [
          0 => 'application/vnd.oasis.opendocument.presentation'
        ],
        'ods' => [
          0 => 'application/vnd.oasis.opendocument.spreadsheet'
        ],
        'odt' => [
          0 => 'application/vnd.oasis.opendocument.text'
        ],
        'oga' => [
          0 => 'audio/ogg'
        ],
        'ogv' => [
          0 => 'video/ogg'
        ],
        'ogx' => [
          0 => 'application/ogg'
        ],
        'opus' => [
          0 => 'audio/opus'
        ],
        'otf' => [
          0 => 'font/otf'
        ],
        'png' => [
          0 => 'image/png'
        ],
        'pdf' => [
          0 => 'application/pdf'
        ],
        'php' => [
          0 => 'application/x-httpd-php'
        ],
        'ppt' => [
          0 => 'application/vnd.ms-powerpoint'
        ],
        'pptx' => [
          0 => 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
        ],
        'rar' => [
          0 => 'application/vnd.rar'
        ],
        'rtf' => [
          0 => 'application/rtf'
        ],
        'sh' => [
          0 => 'application/x-sh'
        ],
        'svg' => [
          0 => 'image/svg+xml'
        ],
        'swf' => [
          0 => 'application/x-shockwave-flash'
        ],
        'tar' => [
          0 => 'application/x-tar'
        ],
        'tif' => [
          0 => 'image/tiff'
        ],
        'tiff' => [
          0 => 'image/tiff'
        ],
        'ts' => [
          0 => 'video/mp2t'
        ],
        'ttf' => [
          0 => 'font/ttf'
        ],
        'txt' => [
          0 => 'text/plain'
        ],
        'vsd' => [
          0 => 'application/vnd.visio'
        ],
        'wav' => [
          0 => 'audio/wav'
        ],
        'weba' => [
          0 => 'audio/webm'
        ],
        'webm' => [
          0 => 'video/webm'
        ],
        'webp' => [
          0 => 'image/webp'
        ],
        'woff' => [
          0 => 'font/woff'
        ],
        'woff2' => [
          0 => 'font/woff2'
        ],
        'xhtml' => [
          0 => 'application/xhtml+xml'
        ],
        'xls' => [
          0 => 'application/vnd.ms-excel'
        ],
        'xlsx' => [
          0 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ],
        'xml' => [
          0 => 'application/xml'
        ],
        'xul' => [
          0 => 'application/vnd.mozilla.xul+xml'
        ],
        'zip' => [
          0 => 'application/zip'
        ],
        '3gp' => [
          0 => 'video/3gpp',
          1 => 'audio/3gpp'
        ],
        '3g2' => [
          0 => 'video/3gpp2',
          1 => 'audio/3gpp2'
        ],
        '7z' => [
          0 => 'application/x-7z-compressed'
        ],
        'md' => [
          0 => 'text/markdown'
        ]
      ],
      'inlineMimeTypeList' => [
        0 => 'application/pdf',
        1 => 'text/plain',
        2 => 'audio/wav',
        3 => 'audio/mpeg',
        4 => 'audio/ogg',
        5 => 'audio/webm',
        6 => 'video/mpeg',
        7 => 'video/mp4',
        8 => 'video/ogg',
        9 => 'video/webm',
        10 => 'image/jpeg',
        11 => 'image/png',
        12 => 'image/gif',
        13 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        14 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        15 => 'application/vnd.ms-word',
        16 => 'application/vnd.ms-excel',
        17 => 'application/vnd.oasis.opendocument.text',
        18 => 'application/vnd.oasis.opendocument.spreadsheet',
        19 => 'application/msword',
        20 => 'application/msexcel'
      ]
    ],
    'fileStorage' => (object) [
      'implementationClassNameMap' => (object) [
        'EspoUploadDir' => 'Espo\\Core\\FileStorage\\Storages\\EspoUploadDir',
        'AwsS3' => 'Espo\\Core\\FileStorage\\Storages\\AwsS3'
      ]
    ],
    'formula' => (object) [
      'functionList' => [
        0 => (object) [
          'name' => 'ifThenElse',
          'insertText' => 'ifThenElse(CONDITION, CONSEQUENT, ALTERNATIVE)'
        ],
        1 => (object) [
          'name' => 'ifThen',
          'insertText' => 'ifThen(CONDITION, CONSEQUENT)'
        ],
        2 => (object) [
          'name' => 'list',
          'insertText' => 'list(ITEM_1, ITEM_2)',
          'returnType' => 'array'
        ],
        3 => (object) [
          'name' => 'string\\concatenate',
          'insertText' => 'string\\concatenate(STRING_1, STRING_2)',
          'returnType' => 'string'
        ],
        4 => (object) [
          'name' => 'string\\substring',
          'insertText' => 'string\\substring(STRING, START, LENGTH)',
          'returnType' => 'string'
        ],
        5 => (object) [
          'name' => 'string\\contains',
          'insertText' => 'string\\contains(STRING, NEEDLE)',
          'returnType' => 'bool'
        ],
        6 => (object) [
          'name' => 'string\\pos',
          'insertText' => 'string\\pos(STRING, NEEDLE)',
          'returnType' => 'int'
        ],
        7 => (object) [
          'name' => 'string\\pad',
          'insertText' => 'string\\pad(STRING, LENGTH, PAD_STRING)',
          'returnType' => 'string'
        ],
        8 => (object) [
          'name' => 'string\\test',
          'insertText' => 'string\\test(STRING, REGULAR_EXPRESSION)',
          'returnType' => 'bool'
        ],
        9 => (object) [
          'name' => 'string\\length',
          'insertText' => 'string\\length(STRING)',
          'returnType' => 'int'
        ],
        10 => (object) [
          'name' => 'string\\trim',
          'insertText' => 'string\\trim(STRING)',
          'returnType' => 'string'
        ],
        11 => (object) [
          'name' => 'string\\lowerCase',
          'insertText' => 'string\\lowerCase(STRING)',
          'returnType' => 'string'
        ],
        12 => (object) [
          'name' => 'string\\upperCase',
          'insertText' => 'string\\upperCase(STRING)',
          'returnType' => 'string'
        ],
        13 => (object) [
          'name' => 'string\\match',
          'insertText' => 'string\\match(STRING, REGULAR_EXPRESSION)',
          'returnType' => 'string|null'
        ],
        14 => (object) [
          'name' => 'string\\matchAll',
          'insertText' => 'string\\matchAll(STRING, REGULAR_EXPRESSION)',
          'returnType' => 'string[]|null'
        ],
        15 => (object) [
          'name' => 'string\\matchExtract',
          'insertText' => 'string\\matchExtract(STRING, REGULAR_EXPRESSION)',
          'returnType' => 'string[]|null'
        ],
        16 => (object) [
          'name' => 'string\\replace',
          'insertText' => 'string\\replace(STRING, SEARCH, REPLACE)',
          'returnType' => 'string'
        ],
        17 => (object) [
          'name' => 'string\\split',
          'insertText' => 'string\\split(STRING, SEPARATOR)',
          'returnType' => 'string[]'
        ],
        18 => (object) [
          'name' => 'datetime\\today',
          'insertText' => 'datetime\\today()',
          'returnType' => 'string'
        ],
        19 => (object) [
          'name' => 'datetime\\now',
          'insertText' => 'datetime\\now()',
          'returnType' => 'string'
        ],
        20 => (object) [
          'name' => 'datetime\\format',
          'insertText' => 'datetime\\format(VALUE)',
          'returnType' => 'string'
        ],
        21 => (object) [
          'name' => 'datetime\\date',
          'insertText' => 'datetime\\date(VALUE)',
          'returnType' => 'int'
        ],
        22 => (object) [
          'name' => 'datetime\\month',
          'insertText' => 'datetime\\month(VALUE)',
          'returnType' => 'int'
        ],
        23 => (object) [
          'name' => 'datetime\\year',
          'insertText' => 'datetime\\year(VALUE)',
          'returnType' => 'int'
        ],
        24 => (object) [
          'name' => 'datetime\\hour',
          'insertText' => 'datetime\\hour(VALUE)',
          'returnType' => 'int'
        ],
        25 => (object) [
          'name' => 'datetime\\minute',
          'insertText' => 'datetime\\minute(VALUE)',
          'returnType' => 'int'
        ],
        26 => (object) [
          'name' => 'datetime\\dayOfWeek',
          'insertText' => 'datetime\\dayOfWeek(VALUE)',
          'returnType' => 'int'
        ],
        27 => (object) [
          'name' => 'datetime\\addMinutes',
          'insertText' => 'datetime\\addMinutes(VALUE, MINUTES)',
          'returnType' => 'string'
        ],
        28 => (object) [
          'name' => 'datetime\\addHours',
          'insertText' => 'datetime\\addHours(VALUE, HOURS)',
          'returnType' => 'string'
        ],
        29 => (object) [
          'name' => 'datetime\\addDays',
          'insertText' => 'datetime\\addDays(VALUE, DAYS)',
          'returnType' => 'string'
        ],
        30 => (object) [
          'name' => 'datetime\\addWeeks',
          'insertText' => 'datetime\\addWeeks(VALUE, WEEKS)',
          'returnType' => 'string'
        ],
        31 => (object) [
          'name' => 'datetime\\addMonths',
          'insertText' => 'datetime\\addMonths(VALUE, MONTHS)',
          'returnType' => 'string'
        ],
        32 => (object) [
          'name' => 'datetime\\addYears',
          'insertText' => 'datetime\\addYears(VALUE, YEARS)',
          'returnType' => 'string'
        ],
        33 => (object) [
          'name' => 'datetime\\diff',
          'insertText' => 'datetime\\diff(VALUE_1, VALUE_2, INTERVAL_TYPE)',
          'returnType' => 'int'
        ],
        34 => (object) [
          'name' => 'datetime\\closest',
          'insertText' => 'datetime\\closest(VALUE, TYPE, TARGET, IS_PAST, TIMEZONE)',
          'returnType' => 'string'
        ],
        35 => (object) [
          'name' => 'number\\format',
          'insertText' => 'number\\format(VALUE)',
          'returnType' => 'string'
        ],
        36 => (object) [
          'name' => 'number\\abs',
          'insertText' => 'number\\abs(VALUE)'
        ],
        37 => (object) [
          'name' => 'number\\round',
          'insertText' => 'number\\round(VALUE, PRECISION)',
          'returnType' => 'int|float'
        ],
        38 => (object) [
          'name' => 'number\\floor',
          'insertText' => 'number\\floor(VALUE)',
          'returnType' => 'int'
        ],
        39 => (object) [
          'name' => 'number\\ceil',
          'insertText' => 'number\\ceil(VALUE)',
          'returnType' => 'int'
        ],
        40 => (object) [
          'name' => 'number\\randomInt',
          'insertText' => 'number\\randomInt(MIN, MAX)',
          'returnType' => 'int'
        ],
        41 => (object) [
          'name' => 'number\\parseInt',
          'insertText' => 'number\\parseInt(STRING)',
          'returnType' => 'int'
        ],
        42 => (object) [
          'name' => 'number\\parseFloat',
          'insertText' => 'number\\parseFloat(STRING)',
          'returnType' => 'float'
        ],
        43 => (object) [
          'name' => 'entity\\isNew',
          'insertText' => 'entity\\isNew()',
          'returnType' => 'bool'
        ],
        44 => (object) [
          'name' => 'entity\\isAttributeChanged',
          'insertText' => 'entity\\isAttributeChanged(ATTRIBUTE)',
          'returnType' => 'bool'
        ],
        45 => (object) [
          'name' => 'entity\\isAttributeNotChanged',
          'insertText' => 'entity\\isAttributeNotChanged(ATTRIBUTE)',
          'returnType' => 'bool'
        ],
        46 => (object) [
          'name' => 'entity\\attribute',
          'insertText' => 'entity\\attribute(ATTRIBUTE)',
          'returnType' => 'mixed'
        ],
        47 => (object) [
          'name' => 'entity\\attributeFetched',
          'insertText' => 'entity\\attributeFetched(ATTRIBUTE)',
          'returnType' => 'mixed'
        ],
        48 => (object) [
          'name' => 'entity\\setAttribute',
          'insertText' => 'entity\\setAttribute(ATTRIBUTE, VALUE)'
        ],
        49 => (object) [
          'name' => 'entity\\addLinkMultipleId',
          'insertText' => 'entity\\addLinkMultipleId(LINK, ID)'
        ],
        50 => (object) [
          'name' => 'entity\\hasLinkMultipleId',
          'insertText' => 'entity\\hasLinkMultipleId(LINK, ID)',
          'returnType' => 'bool'
        ],
        51 => (object) [
          'name' => 'entity\\removeLinkMultipleId',
          'insertText' => 'entity\\removeLinkMultipleId(LINK, ID)'
        ],
        52 => (object) [
          'name' => 'entity\\getLinkColumn',
          'insertText' => 'entity\\getLinkColumn(LINK, ID, COLUMN)',
          'returnType' => 'mixed'
        ],
        53 => (object) [
          'name' => 'entity\\setLinkMultipleColumn',
          'insertText' => 'entity\\setLinkMultipleColumn(LINK, ID, COLUMN, VALUE)'
        ],
        54 => (object) [
          'name' => 'entity\\isRelated',
          'insertText' => 'entity\\isRelated(LINK, ID)',
          'returnType' => 'bool'
        ],
        55 => (object) [
          'name' => 'entity\\sumRelated',
          'insertText' => 'entity\\sumRelated(LINK, FIELD, FILTER)',
          'returnType' => 'int|float'
        ],
        56 => (object) [
          'name' => 'entity\\countRelated',
          'insertText' => 'entity\\countRelated(LINK, FILTER)',
          'returnType' => 'int'
        ],
        57 => (object) [
          'name' => 'record\\exists',
          'insertText' => 'record\\exists(ENTITY_TYPE, KEY, VALUE)',
          'returnType' => 'bool'
        ],
        58 => (object) [
          'name' => 'record\\count',
          'insertText' => 'record\\count(ENTITY_TYPE, KEY, VALUE)',
          'returnType' => 'int'
        ],
        59 => (object) [
          'name' => 'record\\attribute',
          'insertText' => 'record\\attribute(ENTITY_TYPE, ID, ATTRIBUTE)',
          'returnType' => 'mixed'
        ],
        60 => (object) [
          'name' => 'record\\findOne',
          'insertText' => 'record\\findOne(ENTITY_TYPE, ORDER_BY, ORDER, KEY1, VALUE1, KEY2, VALUE2)',
          'returnType' => 'string'
        ],
        61 => (object) [
          'name' => 'record\\findMany',
          'insertText' => 'record\\findMany(ENTITY_TYPE, LIMIT, ORDER_BY, ORDER, KEY1, VALUE1, KEY2, VALUE2)',
          'returnType' => 'string'
        ],
        62 => (object) [
          'name' => 'record\\findRelatedOne',
          'insertText' => 'record\\findRelatedOne(ENTITY_TYPE, ID, LINK, ORDER_BY, ORDER, KEY1, VALUE1, KEY2, VALUE2)',
          'returnType' => 'string'
        ],
        63 => (object) [
          'name' => 'record\\findRelatedMany',
          'insertText' => 'record\\findRelatedMany(ENTITY_TYPE, ID, LINK, LIMIT, ORDER_BY, ORDER, KEY1, VALUE1, KEY2, VALUE2)',
          'returnType' => 'string[]'
        ],
        64 => (object) [
          'name' => 'record\\fetch',
          'insertText' => 'record\\fetch(ENTITY_TYPE, ID)',
          'returnType' => '?object'
        ],
        65 => (object) [
          'name' => 'record\\relate',
          'insertText' => 'record\\relate(ENTITY_TYPE, ID, LINK, FOREIGN_ID)'
        ],
        66 => (object) [
          'name' => 'record\\unrelate',
          'insertText' => 'record\\unrelate(ENTITY_TYPE, ID, LINK, FOREIGN_ID)'
        ],
        67 => (object) [
          'name' => 'record\\create',
          'insertText' => 'record\\create(ENTITY_TYPE, ATTRIBUTE1, VALUE1, ATTRIBUTE2, VALUE2)',
          'returnType' => 'string'
        ],
        68 => (object) [
          'name' => 'record\\update',
          'insertText' => 'record\\update(ENTITY_TYPE, ID, ATTRIBUTE1, VALUE1, ATTRIBUTE2, VALUE2)'
        ],
        69 => (object) [
          'name' => 'record\\delete',
          'insertText' => 'record\\delete(ENTITY_TYPE, ID)'
        ],
        70 => (object) [
          'name' => 'record\\relationColumn',
          'insertText' => 'record\\relationColumn(ENTITY_TYPE, ID, LINK, FOREIGN_ID, COLUMN)',
          'returnType' => 'mixed'
        ],
        71 => (object) [
          'name' => 'record\\updateRelationColumn',
          'insertText' => 'record\\updateRelationColumn(ENTITY_TYPE, ID, LINK, FOREIGN_ID, COLUMN, VALUE)'
        ],
        72 => (object) [
          'name' => 'env\\userAttribute',
          'insertText' => 'env\\userAttribute(ATTRIBUTE)',
          'returnType' => 'mixed'
        ],
        73 => (object) [
          'name' => 'util\\generateId',
          'insertText' => 'util\\generateId()',
          'returnType' => 'string'
        ],
        74 => (object) [
          'name' => 'util\\generateRecordId',
          'insertText' => 'util\\generateRecordId()',
          'returnType' => 'string'
        ],
        75 => (object) [
          'name' => 'object\\create',
          'insertText' => 'object\\create()',
          'returnType' => 'object'
        ],
        76 => (object) [
          'name' => 'object\\get',
          'insertText' => 'object\\get(OBJECT, KEY)',
          'returnType' => 'mixed'
        ],
        77 => (object) [
          'name' => 'object\\has',
          'insertText' => 'object\\has(OBJECT, KEY)',
          'returnType' => 'bool'
        ],
        78 => (object) [
          'name' => 'object\\set',
          'insertText' => 'object\\set(OBJECT, KEY, VALUE)',
          'returnType' => 'object'
        ],
        79 => (object) [
          'name' => 'object\\clear',
          'insertText' => 'object\\clear(OBJECT, KEY)',
          'returnType' => 'object'
        ],
        80 => (object) [
          'name' => 'object\\cloneDeep',
          'insertText' => 'object\\cloneDeep(OBJECT)',
          'returnType' => 'object'
        ],
        81 => (object) [
          'name' => 'password\\generate',
          'insertText' => 'password\\generate()',
          'returnType' => 'string'
        ],
        82 => (object) [
          'name' => 'password\\hash',
          'insertText' => 'password\\hash(PASSWORD)',
          'returnType' => 'string'
        ],
        83 => (object) [
          'name' => 'array\\includes',
          'insertText' => 'array\\includes(LIST, VALUE)',
          'returnType' => 'bool'
        ],
        84 => (object) [
          'name' => 'array\\push',
          'insertText' => 'array\\push(LIST, VALUE)'
        ],
        85 => (object) [
          'name' => 'array\\length',
          'insertText' => 'array\\length(LIST)',
          'returnType' => 'int'
        ],
        86 => (object) [
          'name' => 'array\\at',
          'insertText' => 'array\\at(LIST, INDEX)',
          'returnType' => 'mixed'
        ],
        87 => (object) [
          'name' => 'array\\join',
          'insertText' => 'array\\join(LIST, SEPARATOR)',
          'returnType' => 'string'
        ],
        88 => (object) [
          'name' => 'array\\indexOf',
          'insertText' => 'array\\indexOf(LIST, ELEMENT)',
          'returnType' => '?int'
        ],
        89 => (object) [
          'name' => 'array\\removeAt',
          'insertText' => 'array\\removeAt(LIST, INDEX)',
          'returnType' => 'array'
        ],
        90 => (object) [
          'name' => 'array\\unique',
          'insertText' => 'array\\unique(LIST)',
          'returnType' => 'array'
        ],
        91 => (object) [
          'name' => 'language\\translate',
          'insertText' => 'language\\translate(LABEL, CATEGORY, SCOPE)',
          'returnType' => 'string'
        ],
        92 => (object) [
          'name' => 'language\\translateOption',
          'insertText' => 'language\\translateOption(OPTION, FIELD, SCOPE)',
          'returnType' => 'string'
        ],
        93 => (object) [
          'name' => 'json\\retrieve',
          'insertText' => 'json\\retrieve(JSON, PATH)',
          'returnType' => 'mixed'
        ],
        94 => (object) [
          'name' => 'json\\encode',
          'insertText' => 'json\\encode(VALUE)',
          'returnType' => 'string'
        ],
        95 => (object) [
          'name' => 'ext\\email\\send',
          'insertText' => 'ext\\email\\send(EMAIL_ID)',
          'returnType' => 'bool'
        ],
        96 => (object) [
          'name' => 'ext\\sms\\send',
          'insertText' => 'ext\\sms\\send(SMS_ID)',
          'returnType' => 'bool'
        ],
        97 => (object) [
          'name' => 'ext\\email\\applyTemplate',
          'insertText' => 'ext\\email\\applyTemplate(EMAIL_ID, EMAIL_TEMPLATE_ID)'
        ],
        98 => (object) [
          'name' => 'ext\\pdf\\generate',
          'insertText' => 'ext\\pdf\\generate(ENTITY_TYPE, ENTITY_ID, TEMPLATE_ID, FILENAME)',
          'returnType' => 'string'
        ],
        99 => (object) [
          'name' => 'ext\\workingTime\\addWorkingDays',
          'insertText' => 'ext\\workingTime\\addWorkingDays(DATE, DAYS)',
          'returnType' => 'string|null'
        ],
        100 => (object) [
          'name' => 'ext\\workingTime\\findClosestWorkingTime',
          'insertText' => 'ext\\workingTime\\findClosestWorkingTime(DATE)',
          'returnType' => 'string|null'
        ],
        101 => (object) [
          'name' => 'ext\\workingTime\\getSummedWorkingHours',
          'insertText' => 'ext\\workingTime\\getSummedWorkingHours(FROM, TO)',
          'returnType' => 'float'
        ],
        102 => (object) [
          'name' => 'ext\\workingTime\\getWorkingDays',
          'insertText' => 'ext\\workingTime\\getWorkingDays(FROM, TO)',
          'returnType' => 'int'
        ],
        103 => (object) [
          'name' => 'ext\\workingTime\\hasWorkingTime',
          'insertText' => 'ext\\workingTime\\hasWorkingTime(FROM, TO)',
          'returnType' => 'bool'
        ],
        104 => (object) [
          'name' => 'ext\\workingTime\\isWorkingDay',
          'insertText' => 'ext\\workingTime\\isWorkingDay(DATE)',
          'returnType' => 'bool'
        ],
        105 => (object) [
          'name' => 'ext\\user\\sendAccessInfo',
          'insertText' => 'ext\\user\\sendAccessInfo(USER_ID)'
        ],
        106 => (object) [
          'name' => 'ext\\email\\send',
          'insertText' => 'ext\\email\\send(EMAIL_ID)',
          'returnType' => 'bool'
        ],
        107 => (object) [
          'name' => 'ext\\currency\\convert',
          'insertText' => 'ext\\currency\\convert(AMOUNT, FROM_CODE)',
          'returnType' => 'string'
        ],
        108 => (object) [
          'name' => 'ext\\account\\findByEmailAddress',
          'insertText' => 'ext\\account\\findByEmailAddress(EMAIL_ADDRESS)',
          'returnType' => 'string'
        ],
        109 => (object) [
          'name' => 'ext\\calendar\\userIsBusy',
          'insertText' => 'ext\\calendar\\userIsBusy(USER_ID, FROM, TO)',
          'returnType' => 'bool'
        ]
      ],
      'functionClassNameMap' => (object) [
        'ext\\account\\findByEmailAddress' => 'Espo\\Modules\\Crm\\Classes\\FormulaFunctions\\ExtGroup\\AccountGroup\\FindByEmailAddressType',
        'ext\\calendar\\userIsBusy' => 'Espo\\Modules\\Crm\\Classes\\FormulaFunctions\\ExtGroup\\CalendarGroup\\UserIsBusyType'
      ]
    ],
    'hook' => (object) [
      'suppressClassNameList' => []
    ],
    'image' => (object) [
      'allowedFileTypeList' => [
        0 => 'image/jpeg',
        1 => 'image/png',
        2 => 'image/gif',
        3 => 'image/webp',
        4 => 'image/svg+xml'
      ],
      'resizableFileTypeList' => [
        0 => 'image/jpeg',
        1 => 'image/png',
        2 => 'image/gif',
        3 => 'image/webp'
      ],
      'fixOrientationFileTypeList' => [
        0 => 'image/jpeg'
      ],
      'previewFileTypeList' => [
        0 => 'image/jpeg',
        1 => 'image/png',
        2 => 'image/gif',
        3 => 'image/webp',
        4 => 'image/svg+xml'
      ],
      'sizes' => (object) [
        'xxx-small' => [
          0 => 18,
          1 => 18
        ],
        'xx-small' => [
          0 => 32,
          1 => 32
        ],
        'x-small' => [
          0 => 64,
          1 => 64
        ],
        'small' => [
          0 => 128,
          1 => 128
        ],
        'medium' => [
          0 => 256,
          1 => 256
        ],
        'large' => [
          0 => 512,
          1 => 512
        ],
        'x-large' => [
          0 => 864,
          1 => 864
        ],
        'xx-large' => [
          0 => 1024,
          1 => 1024
        ],
        'small-logo' => [
          0 => 181,
          1 => 44
        ]
      ]
    ],
    'jsLibs' => (object) [
      'jquery' => (object) [
        'exposeAs' => '$'
      ],
      'backbone' => (object) [
        'exportsTo' => 'window',
        'exportsAs' => 'Backbone'
      ],
      'bullbone' => (object) [
        'exposeAs' => 'Bull'
      ],
      'handlebars' => (object) [
        'exposeAs' => 'Handlebars'
      ],
      'underscore' => (object) [
        'exposeAs' => '_'
      ],
      'marked' => (object) [],
      'dompurify' => (object) [
        'exposeAs' => 'DOMPurify'
      ],
      'js-base64' => (object) [
        'exportsTo' => 'window',
        'exportsAs' => 'Base64'
      ],
      'moment' => (object) [
        'exportsTo' => 'window',
        'exportsAs' => 'moment'
      ],
      'flotr2' => (object) [
        'path' => 'client/lib/flotr2.js',
        'devPath' => 'client/lib/original/flotr2.js',
        'exportsTo' => 'window',
        'exportsAs' => 'Flotr',
        'sourceMap' => true,
        'aliases' => [
          0 => 'lib!Flotr'
        ]
      ],
      'espo-funnel-chart' => (object) [
        'path' => 'client/lib/espo-funnel-chart.js',
        'exportsTo' => 'window',
        'exportsAs' => 'EspoFunnel'
      ],
      'summernote' => (object) [
        'path' => 'client/lib/summernote.js',
        'devPath' => 'client/lib/original/summernote.js',
        'exportsTo' => '$.fn',
        'exportsAs' => 'summernote',
        'sourceMap' => true
      ],
      'jquery-ui' => (object) [
        'exportsTo' => '$',
        'exportsAs' => 'ui'
      ],
      'jquery-ui-touch-punch' => (object) [
        'exportsTo' => '$',
        'exportsAs' => 'ui'
      ],
      'jquery-textcomplete' => (object) [
        'exportsTo' => '$.fn',
        'exportsAs' => 'textcomplete'
      ],
      'autocomplete' => (object) [
        'exportsTo' => '$.fn',
        'exportsAs' => 'autocomplete'
      ],
      'timepicker' => (object) [
        'exportsTo' => '$.fn',
        'exportsAs' => 'timepicker'
      ],
      'bootstrap-datepicker' => (object) [
        'exportsTo' => '$.fn',
        'exportsAs' => 'datepicker'
      ],
      'selectize' => (object) [
        'path' => 'client/lib/selectize.js',
        'devPath' => 'client/lib/original/selectize.js',
        'exportsTo' => 'window',
        'exportsAs' => 'Selectize'
      ],
      'autonumeric' => (object) [],
      'cronstrue' => (object) [
        'path' => 'client/lib/cronstrue-i18n.js',
        'devPath' => 'client/lib/original/cronstrue-i18n.js',
        'sourceMap' => true
      ],
      'cropper' => (object) [
        'path' => 'client/lib/cropper.js',
        'exportsTo' => '$.fn',
        'exportsAs' => 'cropper',
        'sourceMap' => true
      ],
      'gridstack' => (object) [
        'exportsTo' => 'window',
        'exportsAs' => 'GridStack'
      ],
      'bootstrap-colorpicker' => (object) [
        'path' => 'client/lib/bootstrap-colorpicker.js',
        'exportsTo' => '$.fn',
        'exportsAs' => 'colorpicker',
        'aliases' => [
          0 => 'lib!Colorpicker'
        ]
      ],
      'exif-js' => (object) [
        'path' => 'client/lib/exif.js',
        'devPath' => 'client/lib/original/exif.js',
        'sourceMap' => true
      ],
      'jsbarcode' => (object) [
        'path' => 'client/lib/JsBarcode.all.js',
        'devPath' => 'client/lib/original/JsBarcode.all.js',
        'exportsTo' => 'window',
        'exportsAs' => 'JsBarcode',
        'sourceMap' => true
      ],
      'qrcodejs' => (object) [
        'path' => 'client/lib/qrcode.js',
        'exportsTo' => 'window',
        'exportsAs' => 'QRCode'
      ],
      'ace' => (object) [
        'path' => 'client/lib/ace.js',
        'exportsTo' => 'window',
        'exportsAs' => 'ace'
      ],
      'ace-mode-javascript' => (object) [
        'path' => 'client/lib/ace-mode-javascript.js',
        'exportsTo' => 'ace.require.define.modules',
        'exportsAs' => 'ace/mode/javascript'
      ],
      'ace-ext-language_tools' => (object) [
        'path' => 'client/lib/ace-ext-language_tools.js',
        'exportsTo' => 'ace.require.define.modules',
        'exportsAs' => 'ace/ext/language_tools'
      ],
      'ace-theme-tomorrow_night' => (object) [
        'path' => 'client/lib/ace-theme-tomorrow_night.js',
        'exportsTo' => 'ace.require.define.modules',
        'exportsAs' => 'ace/theme/tomorrow_night'
      ],
      'fullcalendar' => (object) [
        'path' => 'client/modules/crm/lib/fullcalendar.js',
        'devPath' => 'client/modules/crm/lib/original/fullcalendar.js',
        'exportsTo' => 'window',
        'exportsAs' => 'FullCalendar',
        'sourceMap' => true
      ],
      '@fullcalendar/moment' => (object) [
        'path' => 'client/modules/crm/lib/fullcalendar-moment.js',
        'devPath' => 'client/modules/crm/lib/original/fullcalendar-moment.js',
        'exportsTo' => 'FullCalendar',
        'exportsAs' => 'Moment',
        'sourceMap' => true
      ],
      '@fullcalendar/moment-timezone' => (object) [
        'path' => 'client/modules/crm/lib/fullcalendar-moment-timezone.js',
        'devPath' => 'client/modules/crm/lib/original/fullcalendar-moment-timezone.js',
        'exportsTo' => 'FullCalendar',
        'exportsAs' => 'MomentTimezone',
        'sourceMap' => true
      ],
      'vis-timeline' => (object) [
        'path' => 'client/modules/crm/lib/vis-timeline.js',
        'devPath' => 'client/modules/crm/lib/original/vis-timeline.js',
        'sourceMap' => true
      ],
      'vis-data' => (object) [
        'path' => 'client/modules/crm/lib/vis-data.js',
        'devPath' => 'client/modules/crm/lib/original/vis-data.js',
        'aliases' => [
          0 => 'vis-data/peer/umd/vis-data.js'
        ],
        'sourceMap' => true
      ]
    ],
    'language' => (object) [
      'list' => [
        0 => 'en_US',
        1 => 'ar_AR',
        2 => 'bg_BG',
        3 => 'en_GB',
        4 => 'es_MX',
        5 => 'cs_CZ',
        6 => 'da_DK',
        7 => 'de_DE',
        8 => 'es_ES',
        9 => 'hr_HR',
        10 => 'hu_HU',
        11 => 'fa_IR',
        12 => 'fr_FR',
        13 => 'id_ID',
        14 => 'it_IT',
        15 => 'lt_LT',
        16 => 'lv_LV',
        17 => 'nb_NO',
        18 => 'nl_NL',
        19 => 'th_TH',
        20 => 'tr_TR',
        21 => 'sk_SK',
        22 => 'sl_SI',
        23 => 'sr_RS',
        24 => 'sv_SE',
        25 => 'ro_RO',
        26 => 'ru_RU',
        27 => 'pl_PL',
        28 => 'pt_BR',
        29 => 'pt_PT',
        30 => 'uk_UA',
        31 => 'vi_VN',
        32 => 'zh_CN',
        33 => 'zh_TW'
      ],
      'aclDependencies' => (object) [
        'Meeting' => (object) [
          'anyScopeList' => [
            0 => 'Call'
          ]
        ]
      ]
    ],
    'linkManager' => (object) [
      'createHookClassNameList' => [
        0 => 'Espo\\Tools\\LinkManager\\Hook\\Hooks\\TargetListCreate',
        1 => 'Espo\\Tools\\LinkManager\\Hook\\Hooks\\AssignedUsersCreate'
      ],
      'deleteHookClassNameList' => [
        0 => 'Espo\\Tools\\LinkManager\\Hook\\Hooks\\TargetListDelete',
        1 => 'Espo\\Tools\\LinkManager\\Hook\\Hooks\\ForeignFieldDelete'
      ]
    ],
    'massActions' => (object) [
      'convertCurrency' => (object) [
        'implementationClassName' => 'Espo\\Core\\MassAction\\Actions\\MassConvertCurrency'
      ],
      'follow' => (object) [
        'implementationClassName' => 'Espo\\Core\\MassAction\\Actions\\MassFollow'
      ],
      'unfollow' => (object) [
        'implementationClassName' => 'Espo\\Core\\MassAction\\Actions\\MassUnfollow'
      ],
      'recalculateFormula' => (object) [
        'implementationClassName' => 'Espo\\Core\\MassAction\\Actions\\MassRecalculateFormula'
      ],
      'update' => (object) [
        'implementationClassName' => 'Espo\\Core\\MassAction\\Actions\\MassUpdate'
      ],
      'delete' => (object) [
        'implementationClassName' => 'Espo\\Core\\MassAction\\Actions\\MassDelete'
      ]
    ],
    'metadata' => (object) [
      'frontendHiddenPathList' => [
        0 => [
          0 => 'app',
          1 => 'metadata'
        ],
        1 => [
          0 => 'app',
          1 => 'loaders'
        ],
        2 => [
          0 => 'app',
          1 => 'containerServices'
        ],
        3 => [
          0 => 'app',
          1 => 'portalContainerServices'
        ],
        4 => [
          0 => 'app',
          1 => 'consoleCommands'
        ],
        5 => [
          0 => 'app',
          1 => 'formula',
          2 => 'functionClassNameMap'
        ],
        6 => [
          0 => 'app',
          1 => 'fileStorage',
          2 => 'implementationClassNameMap'
        ],
        7 => [
          0 => 'app',
          1 => 'client'
        ],
        8 => [
          0 => 'app',
          1 => 'language',
          2 => 'aclDependencies'
        ],
        9 => [
          0 => 'app',
          1 => 'templateHelpers'
        ],
        10 => [
          0 => 'app',
          1 => 'appParams'
        ],
        11 => [
          0 => 'app',
          1 => 'cleanup'
        ],
        12 => [
          0 => 'app',
          1 => 'authentication'
        ],
        13 => [
          0 => 'app',
          1 => 'pdfEngines',
          2 => '__ANY__',
          3 => 'implementationClassNameMap'
        ],
        14 => [
          0 => 'app',
          1 => 'addressFormats',
          2 => '__ANY__',
          3 => 'formatterClassName'
        ],
        15 => [
          0 => 'app',
          1 => 'authentication2FAMethods',
          2 => '__ANY__',
          3 => 'loginClassName'
        ],
        16 => [
          0 => 'app',
          1 => 'authentication2FAMethods',
          2 => '__ANY__',
          3 => 'userSetupClassName'
        ],
        17 => [
          0 => 'app',
          1 => 'select'
        ],
        18 => [
          0 => 'app',
          1 => 'massActions',
          2 => '__ANY__',
          3 => 'implementationClassName'
        ],
        19 => [
          0 => 'app',
          1 => 'actions',
          2 => '__ANY__',
          3 => 'implementationClassName'
        ],
        20 => [
          0 => 'app',
          1 => 'fieldProcessing'
        ],
        21 => [
          0 => 'app',
          1 => 'scheduledJobs'
        ],
        22 => [
          0 => 'app',
          1 => 'webSocket',
          2 => 'messagers'
        ],
        23 => [
          0 => 'app',
          1 => 'config'
        ],
        24 => [
          0 => 'app',
          1 => 'rebuild'
        ],
        25 => [
          0 => 'app',
          1 => 'smsProviders',
          2 => '__ANY__',
          3 => 'senderClassName'
        ],
        26 => [
          0 => 'app',
          1 => 'orm'
        ],
        27 => [
          0 => 'app',
          1 => 'relationships'
        ],
        28 => [
          0 => 'app',
          1 => 'linkManager'
        ],
        29 => [
          0 => 'app',
          1 => 'hook'
        ],
        30 => [
          0 => 'app',
          1 => 'api'
        ],
        31 => [
          0 => 'app',
          1 => 'databasePlatforms'
        ],
        32 => [
          0 => 'app',
          1 => 'recordId'
        ],
        33 => [
          0 => 'app',
          1 => 'currencyConversion'
        ],
        34 => [
          0 => 'selectDefs'
        ],
        35 => [
          0 => 'pdfDefs'
        ],
        36 => [
          0 => 'aclDefs'
        ],
        37 => [
          0 => 'notificationDefs'
        ],
        38 => [
          0 => 'authenticationMethods',
          1 => '__ANY__',
          2 => 'implementationClassName'
        ],
        39 => [
          0 => 'app',
          1 => 'calendar',
          2 => 'additionalAttributeList'
        ]
      ],
      'frontendNonAdminHiddenPathList' => [
        0 => [
          0 => 'recordDefs'
        ]
      ],
      'aclDependencies' => (object) []
    ],
    'orm' => (object) [
      'platforms' => (object) [
        'Mysql' => (object) [
          'queryComposerClassName' => 'Espo\\ORM\\QueryComposer\\MysqlQueryComposer',
          'pdoFactoryClassName' => 'Espo\\ORM\\PDO\\MysqlPDOFactory',
          'functionConverterClassNameMap' => (object) [
            'ABS' => 'Espo\\Core\\ORM\\QueryComposer\\Part\\FunctionConverters\\Abs'
          ]
        ],
        'Postgresql' => (object) [
          'queryComposerClassName' => 'Espo\\ORM\\QueryComposer\\PostgresqlQueryComposer',
          'pdoFactoryClassName' => 'Espo\\ORM\\PDO\\PostgresqlPDOFactory',
          'functionConverterClassNameMap' => (object) [
            'ABS' => 'Espo\\Core\\ORM\\QueryComposer\\Part\\FunctionConverters\\Abs'
          ]
        ]
      ]
    ],
    'pdfEngines' => (object) [
      'Tcpdf' => (object) [
        'implementationClassNameMap' => (object) [
          'entity' => 'Espo\\Tools\\Pdf\\Tcpdf\\TcpdfEntityPrinter',
          'collection' => 'Espo\\Tools\\Pdf\\Tcpdf\\TcpdfCollectionPrinter'
        ],
        'fontFaceList' => [
          0 => 'aealarabiya',
          1 => 'aefurat',
          2 => 'cid0cs',
          3 => 'cid0ct',
          4 => 'cid0jp',
          5 => 'cid0kr',
          6 => 'courier',
          7 => 'dejavusans',
          8 => 'dejavusanscondensed',
          9 => 'dejavusansextralight',
          10 => 'dejavusansmono',
          11 => 'dejavuserif',
          12 => 'dejavuserifcondensed',
          13 => 'freemono',
          14 => 'freesans',
          15 => 'freeserif',
          16 => 'helvetica',
          17 => 'hysmyeongjostdmedium',
          18 => 'kozgopromedium',
          19 => 'kozminproregular',
          20 => 'msungstdlight',
          21 => 'pdfacourier',
          22 => 'pdfahelvetica',
          23 => 'pdfasymbol',
          24 => 'pdfatimes',
          25 => 'stsongstdlight',
          26 => 'symbol',
          27 => 'times'
        ]
      ],
      'Dompdf' => (object) [
        'implementationClassNameMap' => (object) [
          'entity' => 'Espo\\Tools\\Pdf\\Dompdf\\EntityPrinter'
        ],
        'fontFaceList' => [
          0 => 'Courier',
          1 => 'Helvetica',
          2 => 'Times',
          3 => 'Symbol',
          4 => 'ZapfDingbats',
          5 => 'DejaVu Sans',
          6 => 'DejaVu Serif',
          7 => 'DejaVu Sans Mono'
        ]
      ]
    ],
    'portalContainerServices' => (object) [
      'layoutProvider' => (object) [
        'className' => 'Espo\\Tools\\Layout\\PortalLayoutProvider'
      ],
      'themeManager' => (object) [
        'className' => 'Espo\\Core\\Portal\\Utils\\ThemeManager'
      ]
    ],
    'rebuild' => (object) [
      'actionClassNameList' => [
        0 => 'Espo\\Core\\Rebuild\\Actions\\AddSystemUser',
        1 => 'Espo\\Core\\Rebuild\\Actions\\AddSystemData',
        2 => 'Espo\\Core\\Rebuild\\Actions\\CurrencyRates',
        3 => 'Espo\\Core\\Rebuild\\Actions\\ScheduledJobs',
        4 => 'Espo\\Core\\Rebuild\\Actions\\ConfigMetadataCheck'
      ]
    ],
    'recordId' => (object) [
      'length' => 17
    ],
    'regExpPatterns' => (object) [
      'noBadCharacters' => (object) [
        'pattern' => '[^<>=]+'
      ],
      'noAsciiSpecialCharacters' => (object) [
        'pattern' => '[^`~!@#$%^&*()_+={}\\[\\]|\\\\:;"\'<,>.?]+'
      ],
      'latinLetters' => (object) [
        'pattern' => '[A-Za-z]+'
      ],
      'latinLettersDigits' => (object) [
        'pattern' => '[A-Za-z0-9]+'
      ],
      'latinLettersDigitsWhitespace' => (object) [
        'pattern' => '[A-Za-z0-9 ]+'
      ],
      'latinLettersWhitespace' => (object) [
        'pattern' => '[A-Za-z ]+'
      ],
      'digits' => (object) [
        'pattern' => '[0-9]+'
      ],
      'id' => (object) [
        'pattern' => '[A-Za-z0-9_=\\-\\.]+',
        'isSystem' => true
      ],
      'phoneNumberLoose' => (object) [
        'pattern' => '[0-9A-Za-z_@:#\\+\\(\\)\\-\\. ]+',
        'isSystem' => true
      ],
      'uriOptionalProtocol' => (object) [
        'pattern' => '((a-zA-Z0-9)\\:\\/\\/)?[a-zA-Z0-9%\\.\\/\\?\\:@\\-_=#$!+*\\(\\)\',]+\\.([a-zA-Z0-9%\\&\\.\\/\\?\\:@\\-_=#$!+*\\(\\)\',])*',
        'isSystem' => true
      ]
    ],
    'relationships' => (object) [
      'attachments' => (object) [
        'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\LinkConverters\\Attachments'
      ],
      'emailEmailAddress' => (object) [
        'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\LinkConverters\\EmailEmailAddress'
      ],
      'entityTeam' => (object) [
        'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\LinkConverters\\EntityTeam'
      ],
      'entityUser' => (object) [
        'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\LinkConverters\\EntityUser'
      ],
      'smsPhoneNumber' => (object) [
        'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\LinkConverters\\SmsPhoneNumber'
      ]
    ],
    'scheduledJobs' => (object) [
      'ProcessJobGroup' => (object) [
        'name' => 'Process Job Group',
        'isSystem' => true,
        'scheduling' => '* * * * *',
        'jobClassName' => 'Espo\\Core\\Job\\Job\\Jobs\\ProcessJobGroup',
        'preparatorClassName' => 'Espo\\Core\\Job\\Preparator\\Preparators\\ProcessJobGroupPreparator'
      ],
      'ProcessJobQueueQ0' => (object) [
        'name' => 'Process Job Queue q0',
        'isSystem' => true,
        'scheduling' => '* * * * *',
        'jobClassName' => 'Espo\\Core\\Job\\Job\\Jobs\\ProcessJobQueueQ0'
      ],
      'ProcessJobQueueQ1' => (object) [
        'name' => 'Process Job Queue q1',
        'isSystem' => true,
        'scheduling' => '*/1 * * * *',
        'jobClassName' => 'Espo\\Core\\Job\\Job\\Jobs\\ProcessJobQueueQ1'
      ],
      'ProcessJobQueueE0' => (object) [
        'name' => 'Process Job Queue e0',
        'isSystem' => true,
        'scheduling' => '* * * * *',
        'jobClassName' => 'Espo\\Core\\Job\\Job\\Jobs\\ProcessJobQueueE0'
      ],
      'Dummy' => (object) [
        'isSystem' => true,
        'scheduling' => '1 */12 * * *',
        'jobClassName' => 'Espo\\Classes\\Jobs\\Dummy'
      ],
      'CheckNewVersion' => (object) [
        'name' => 'Check for New Version',
        'isSystem' => true,
        'scheduling' => '15 5 * * *',
        'jobClassName' => 'Espo\\Classes\\Jobs\\CheckNewVersion'
      ],
      'CheckNewExtensionVersion' => (object) [
        'name' => 'Check for New Versions of Installed Extensions',
        'isSystem' => true,
        'scheduling' => '25 5 * * *',
        'jobClassName' => 'Espo\\Classes\\Jobs\\CheckNewExtensionVersion'
      ],
      'Cleanup' => (object) [
        'jobClassName' => 'Espo\\Classes\\Jobs\\Cleanup'
      ],
      'AuthTokenControl' => (object) [
        'jobClassName' => 'Espo\\Classes\\Jobs\\AuthTokenControl'
      ],
      'SendEmailNotifications' => (object) [
        'jobClassName' => 'Espo\\Classes\\Jobs\\SendEmailNotifications'
      ],
      'ProcessWebhookQueue' => (object) [
        'jobClassName' => 'Espo\\Classes\\Jobs\\ProcessWebhookQueue'
      ],
      'CheckEmailAccounts' => (object) [
        'preparatorClassName' => 'Espo\\Classes\\JobPreparators\\CheckEmailAccounts',
        'jobClassName' => 'Espo\\Classes\\Jobs\\CheckEmailAccounts'
      ],
      'CheckInboundEmails' => (object) [
        'preparatorClassName' => 'Espo\\Classes\\JobPreparators\\CheckInboundEmails',
        'jobClassName' => 'Espo\\Classes\\Jobs\\CheckInboundEmails'
      ]
    ],
    'smsProviders' => (object) [],
    'templateHelpers' => (object) [
      'googleMapsImage' => 'Espo\\Classes\\TemplateHelpers\\GoogleMaps',
      'tableTag' => 'Espo\\Classes\\TemplateHelpers\\TableTag',
      'trTag' => 'Espo\\Classes\\TemplateHelpers\\TrTag',
      'tdTag' => 'Espo\\Classes\\TemplateHelpers\\TdTag'
    ],
    'templates' => (object) [
      'accessInfo' => (object) [
        'scope' => 'User'
      ],
      'accessInfoPortal' => (object) [
        'scope' => 'User'
      ],
      'assignment' => (object) [
        'scopeListConfigParam' => 'assignmentEmailNotificationsEntityList'
      ],
      'mention' => (object) [
        'scope' => 'Note'
      ],
      'noteEmailReceived' => (object) [
        'scope' => 'Note'
      ],
      'notePost' => (object) [
        'scope' => 'Note'
      ],
      'notePostNoParent' => (object) [
        'scope' => 'Note'
      ],
      'noteStatus' => (object) [
        'scope' => 'Note'
      ],
      'passwordChangeLink' => (object) [
        'scope' => 'User'
      ],
      'twoFactorCode' => (object) [
        'scope' => 'User'
      ],
      'invitation' => (object) [
        'scopeList' => [
          0 => 'Meeting',
          1 => 'Call'
        ],
        'module' => 'Crm'
      ],
      'cancellation' => (object) [
        'scopeList' => [
          0 => 'Meeting',
          1 => 'Call'
        ],
        'module' => 'Crm'
      ],
      'reminder' => (object) [
        'scopeList' => [
          0 => 'Meeting',
          1 => 'Call',
          2 => 'Task'
        ],
        'module' => 'Crm'
      ]
    ],
    'webSocket' => (object) [
      'categories' => (object) [
        'newNotification' => (object) [],
        'recordUpdate' => (object) [
          'paramList' => [
            0 => 'scope',
            1 => 'id'
          ],
          'accessCheckCommand' => 'AclCheck --userId=:userId --scope=:scope --id=:id --action=read'
        ],
        'streamUpdate' => (object) [
          'paramList' => [
            0 => 'scope',
            1 => 'id'
          ],
          'accessCheckCommand' => 'AclCheck --userId=:userId --scope=:scope --id=:id --action=stream'
        ],
        'popupNotifications.event' => (object) []
      ],
      'messagers' => (object) [
        'ZeroMQ' => (object) [
          'senderClassName' => 'Espo\\Core\\WebSocket\\ZeroMQSender',
          'subscriberClassName' => 'Espo\\Core\\WebSocket\\ZeroMQSubscriber'
        ]
      ]
    ],
    'calendar' => (object) [
      'additionalAttributeList' => [
        0 => 'color'
      ]
    ],
    'popupNotifications' => (object) [
      'event' => (object) [
        'grouped' => true,
        'providerClassName' => 'Espo\\Modules\\Crm\\Tools\\Activities\\PopupNotificationsProvider',
        'useWebSocket' => true,
        'portalDisabled' => true,
        'view' => 'crm:views/meeting/popup-notification'
      ]
    ]
  ],
  'authenticationMethods' => (object) [
    'ApiKey' => (object) [
      'api' => true,
      'credentialsHeader' => 'X-Api-Key'
    ],
    'Espo' => (object) [
      'portalDefault' => true,
      'settings' => (object) [
        'isAvailable' => true
      ]
    ],
    'Hmac' => (object) [
      'api' => true,
      'credentialsHeader' => 'X-Hmac-Authorization'
    ],
    'LDAP' => (object) [
      'implementationClassName' => 'Espo\\Core\\Authentication\\Ldap\\LdapLogin',
      'portalDefault' => true,
      'settings' => (object) [
        'isAvailable' => true,
        'layout' => (object) [
          'label' => 'LDAP',
          'rows' => [
            0 => [
              0 => (object) [
                'name' => 'ldapHost'
              ],
              1 => (object) [
                'name' => 'ldapPort'
              ]
            ],
            1 => [
              0 => (object) [
                'name' => 'ldapAuth'
              ],
              1 => (object) [
                'name' => 'ldapSecurity'
              ]
            ],
            2 => [
              0 => (object) [
                'name' => 'ldapUsername',
                'fullWidth' => true
              ]
            ],
            3 => [
              0 => (object) [
                'name' => 'ldapPassword'
              ],
              1 => (object) [
                'name' => 'testConnection',
                'customLabel' => NULL,
                'view' => 'views/admin/authentication/fields/test-connection'
              ]
            ],
            4 => [
              0 => (object) [
                'name' => 'ldapUserNameAttribute'
              ],
              1 => (object) [
                'name' => 'ldapUserObjectClass'
              ]
            ],
            5 => [
              0 => (object) [
                'name' => 'ldapAccountCanonicalForm'
              ],
              1 => (object) [
                'name' => 'ldapBindRequiresDn'
              ]
            ],
            6 => [
              0 => (object) [
                'name' => 'ldapBaseDn',
                'fullWidth' => true
              ]
            ],
            7 => [
              0 => (object) [
                'name' => 'ldapUserLoginFilter',
                'fullWidth' => true
              ]
            ],
            8 => [
              0 => (object) [
                'name' => 'ldapAccountDomainName'
              ],
              1 => (object) [
                'name' => 'ldapAccountDomainNameShort'
              ]
            ],
            9 => [
              0 => (object) [
                'name' => 'ldapTryUsernameSplit'
              ],
              1 => (object) [
                'name' => 'ldapOptReferrals'
              ]
            ],
            10 => [
              0 => (object) [
                'name' => 'ldapCreateEspoUser'
              ],
              1 => false
            ],
            11 => [
              0 => (object) [
                'name' => 'ldapUserFirstNameAttribute'
              ],
              1 => (object) [
                'name' => 'ldapUserLastNameAttribute'
              ]
            ],
            12 => [
              0 => (object) [
                'name' => 'ldapUserTitleAttribute'
              ],
              1 => false
            ],
            13 => [
              0 => (object) [
                'name' => 'ldapUserEmailAddressAttribute'
              ],
              1 => (object) [
                'name' => 'ldapUserPhoneNumberAttribute'
              ]
            ],
            14 => [
              0 => (object) [
                'name' => 'ldapUserTeams'
              ],
              1 => (object) [
                'name' => 'ldapUserDefaultTeam'
              ]
            ],
            15 => [
              0 => (object) [
                'name' => 'ldapPortalUserLdapAuth'
              ],
              1 => false
            ],
            16 => [
              0 => (object) [
                'name' => 'ldapPortalUserPortals'
              ],
              1 => (object) [
                'name' => 'ldapPortalUserRoles'
              ]
            ]
          ]
        ],
        'fieldList' => [
          0 => 'ldapHost',
          1 => 'ldapPort',
          2 => 'ldapAuth',
          3 => 'ldapSecurity',
          4 => 'ldapUsername',
          5 => 'ldapPassword',
          6 => 'ldapBindRequiresDn',
          7 => 'ldapUserLoginFilter',
          8 => 'ldapBaseDn',
          9 => 'ldapAccountCanonicalForm',
          10 => 'ldapAccountDomainName',
          11 => 'ldapAccountDomainNameShort',
          12 => 'ldapAccountDomainName',
          13 => 'ldapAccountDomainNameShort',
          14 => 'ldapTryUsernameSplit',
          15 => 'ldapOptReferrals',
          16 => 'ldapCreateEspoUser',
          17 => 'ldapPortalUserLdapAuth'
        ],
        'dynamicLogic' => (object) [
          'fields' => (object) [
            'ldapHost' => (object) [
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'equals',
                    'attribute' => 'authenticationMethod',
                    'value' => 'LDAP'
                  ]
                ]
              ]
            ],
            'ldapUserNameAttribute' => (object) [
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'equals',
                    'attribute' => 'authenticationMethod',
                    'value' => 'LDAP'
                  ]
                ]
              ]
            ],
            'ldapUserObjectClass' => (object) [
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'equals',
                    'attribute' => 'authenticationMethod',
                    'value' => 'LDAP'
                  ]
                ]
              ]
            ],
            'ldapUsername' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapAuth'
                  ]
                ]
              ],
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapAuth'
                  ]
                ]
              ]
            ],
            'ldapPassword' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapAuth'
                  ]
                ]
              ]
            ],
            'testConnection' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapAuth'
                  ]
                ]
              ]
            ],
            'ldapAccountDomainName' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'in',
                    'attribute' => 'ldapAccountCanonicalForm',
                    'value' => [
                      0 => 'Backslash',
                      1 => 'Principal'
                    ]
                  ]
                ]
              ]
            ],
            'ldapAccountDomainNameShort' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'in',
                    'attribute' => 'ldapAccountCanonicalForm',
                    'value' => [
                      0 => 'Backslash',
                      1 => 'Principal'
                    ]
                  ]
                ]
              ]
            ],
            'ldapUserTitleAttribute' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ],
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ]
            ],
            'ldapUserFirstNameAttribute' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ],
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ]
            ],
            'ldapUserLastNameAttribute' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ],
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ]
            ],
            'ldapUserEmailAddressAttribute' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ],
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ]
            ],
            'ldapUserPhoneNumberAttribute' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ],
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ]
            ],
            'ldapUserTeams' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ]
            ],
            'ldapUserDefaultTeam' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapCreateEspoUser'
                  ]
                ]
              ]
            ],
            'ldapPortalUserPortals' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapPortalUserLdapAuth'
                  ]
                ]
              ]
            ],
            'ldapPortalUserRoles' => (object) [
              'visible' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'ldapPortalUserLdapAuth'
                  ]
                ]
              ]
            ]
          ]
        ]
      ]
    ],
    'Oidc' => (object) [
      'implementationClassName' => 'Espo\\Core\\Authentication\\Oidc\\Login',
      'logoutClassName' => 'Espo\\Core\\Authentication\\Oidc\\Logout',
      'login' => (object) [
        'handler' => 'handlers/login/oidc',
        'fallbackConfigParam' => 'oidcFallback'
      ],
      'provider' => (object) [
        'isAvailable' => true
      ],
      'settings' => (object) [
        'isAvailable' => true,
        'layout' => (object) [
          'label' => 'OIDC',
          'rows' => [
            0 => [
              0 => (object) [
                'name' => 'oidcClientId'
              ],
              1 => (object) [
                'name' => 'oidcClientSecret'
              ]
            ],
            1 => [
              0 => (object) [
                'name' => 'oidcAuthorizationRedirectUri',
                'view' => 'views/settings/fields/oidc-redirect-uri',
                'params' => (object) [
                  'readOnly' => true,
                  'copyToClipboard' => true
                ]
              ],
              1 => false
            ],
            2 => [
              0 => (object) [
                'name' => 'oidcAuthorizationEndpoint'
              ],
              1 => (object) [
                'name' => 'oidcTokenEndpoint'
              ]
            ],
            3 => [
              0 => (object) [
                'name' => 'oidcJwksEndpoint'
              ],
              1 => (object) [
                'name' => 'oidcJwtSignatureAlgorithmList'
              ]
            ],
            4 => [
              0 => (object) [
                'name' => 'oidcScopes'
              ],
              1 => (object) [
                'name' => 'oidcUsernameClaim'
              ]
            ],
            5 => [
              0 => (object) [
                'name' => 'oidcCreateUser'
              ],
              1 => (object) [
                'name' => 'oidcSync'
              ]
            ],
            6 => [
              0 => (object) [
                'name' => 'oidcTeams'
              ],
              1 => (object) [
                'name' => 'oidcGroupClaim'
              ]
            ],
            7 => [
              0 => (object) [
                'name' => 'oidcSyncTeams'
              ],
              1 => false
            ],
            8 => [
              0 => (object) [
                'name' => 'oidcFallback'
              ],
              1 => (object) [
                'name' => 'oidcAllowRegularUserFallback'
              ]
            ],
            9 => [
              0 => (object) [
                'name' => 'oidcAllowAdminUser'
              ],
              1 => (object) [
                'name' => 'oidcLogoutUrl'
              ]
            ]
          ]
        ],
        'fieldList' => [
          0 => 'oidcClientId',
          1 => 'oidcClientSecret',
          2 => 'oidcAuthorizationEndpoint',
          3 => 'oidcTokenEndpoint',
          4 => 'oidcJwksEndpoint',
          5 => 'oidcJwtSignatureAlgorithmList',
          6 => 'oidcScopes',
          7 => 'oidcGroupClaim',
          8 => 'oidcCreateUser',
          9 => 'oidcUsernameClaim',
          10 => 'oidcTeams',
          11 => 'oidcSync',
          12 => 'oidcSyncTeams',
          13 => 'oidcAuthorizationRedirectUri',
          14 => 'oidcFallback',
          15 => 'oidcAllowRegularUserFallback',
          16 => 'oidcAllowAdminUser',
          17 => 'oidcLogoutUrl'
        ],
        'dynamicLogic' => (object) [
          'fields' => (object) [
            'oidcClientId' => (object) [
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'equals',
                    'attribute' => 'authenticationMethod',
                    'value' => 'Oidc'
                  ]
                ]
              ]
            ],
            'oidcAuthorizationEndpoint' => (object) [
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'equals',
                    'attribute' => 'authenticationMethod',
                    'value' => 'Oidc'
                  ]
                ]
              ]
            ],
            'oidcTokenEndpoint' => (object) [
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'equals',
                    'attribute' => 'authenticationMethod',
                    'value' => 'Oidc'
                  ]
                ]
              ]
            ],
            'oidcUsernameClaim' => (object) [
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'equals',
                    'attribute' => 'authenticationMethod',
                    'value' => 'Oidc'
                  ]
                ]
              ]
            ],
            'oidcJwtSignatureAlgorithmList' => (object) [
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'equals',
                    'attribute' => 'authenticationMethod',
                    'value' => 'Oidc'
                  ]
                ]
              ]
            ],
            'oidcJwksEndpoint' => (object) [
              'required' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'equals',
                    'attribute' => 'authenticationMethod',
                    'value' => 'Oidc'
                  ],
                  1 => (object) [
                    'type' => 'or',
                    'value' => [
                      0 => (object) [
                        'type' => 'contains',
                        'attribute' => 'oidcJwtSignatureAlgorithmList',
                        'value' => 'RS256'
                      ],
                      1 => (object) [
                        'type' => 'contains',
                        'attribute' => 'oidcJwtSignatureAlgorithmList',
                        'value' => 'RS384'
                      ],
                      2 => (object) [
                        'type' => 'contains',
                        'attribute' => 'oidcJwtSignatureAlgorithmList',
                        'value' => 'RS512'
                      ]
                    ]
                  ]
                ]
              ]
            ],
            'oidcAllowRegularUserFallback' => (object) [
              'invalid' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'equals',
                    'attribute' => 'authenticationMethod',
                    'value' => 'Oidc'
                  ],
                  1 => (object) [
                    'type' => 'isTrue',
                    'attribute' => 'oidcAllowRegularUserFallback'
                  ],
                  2 => (object) [
                    'type' => 'isFalse',
                    'attribute' => 'oidcFallback'
                  ]
                ]
              ]
            ],
            'oidcAllowAdminUser' => (object) [
              'invalid' => (object) [
                'conditionGroup' => [
                  0 => (object) [
                    'type' => 'equals',
                    'attribute' => 'authenticationMethod',
                    'value' => 'Oidc'
                  ],
                  1 => (object) [
                    'type' => 'isFalse',
                    'attribute' => 'oidcAllowAdminUser'
                  ],
                  2 => (object) [
                    'type' => 'isFalse',
                    'attribute' => 'oidcFallback'
                  ]
                ]
              ]
            ]
          ]
        ]
      ]
    ]
  ],
  'clientDefs' => (object) [
    'ActionHistoryRecord' => (object) [
      'controller' => 'controllers/record',
      'createDisabled' => true,
      'recordViews' => (object) [
        'list' => 'views/action-history-record/record/list'
      ],
      'modalViews' => (object) [
        'detail' => 'views/action-history-record/modals/detail'
      ]
    ],
    'AddressMap' => (object) [
      'controller' => 'controllers/address-map'
    ],
    'ApiUser' => (object) [
      'controller' => 'controllers/api-user',
      'views' => (object) [
        'detail' => 'views/user/detail',
        'list' => 'views/api-user/list'
      ],
      'recordViews' => (object) [
        'list' => 'views/user/record/list',
        'detail' => 'views/user/record/detail',
        'edit' => 'views/user/record/edit',
        'detailSmall' => 'views/user/record/detail-quick',
        'editSmall' => 'views/user/record/edit-quick'
      ],
      'defaultSidePanelFieldLists' => (object) [
        'detail' => [
          0 => 'avatar',
          1 => 'createdAt',
          2 => 'lastAccess'
        ],
        'detailSmall' => [
          0 => 'avatar',
          1 => 'createdAt'
        ],
        'edit' => [
          0 => 'avatar'
        ],
        'editSmall' => [
          0 => 'avatar'
        ]
      ],
      'filterList' => [],
      'boolFilterList' => []
    ],
    'Attachment' => (object) [
      'controller' => 'controllers/record',
      'createDisabled' => true,
      'recordViews' => (object) [
        'list' => 'views/attachment/record/list',
        'detail' => 'views/attachment/record/detail'
      ],
      'modalViews' => (object) [
        'detail' => 'views/attachment/modals/detail'
      ],
      'filterList' => [
        0 => 'orphan'
      ]
    ],
    'AuthLogRecord' => (object) [
      'controller' => 'controllers/record',
      'recordViews' => (object) [
        'list' => 'views/admin/auth-log-record/record/list',
        'detail' => 'views/admin/auth-log-record/record/detail',
        'detailSmall' => 'views/admin/auth-log-record/record/detail-small'
      ],
      'modalViews' => (object) [
        'detail' => 'views/admin/auth-log-record/modals/detail'
      ],
      'filterList' => [
        0 => 'accepted',
        1 => 'denied'
      ],
      'createDisabled' => true,
      'relationshipPanels' => (object) [
        'actionHistoryRecords' => (object) [
          'createDisabled' => true,
          'selectDisabled' => true,
          'unlinkDisabled' => true,
          'rowActionsView' => 'views/record/row-actions/relationship-view-only'
        ]
      ]
    ],
    'AuthToken' => (object) [
      'controller' => 'controllers/record',
      'recordViews' => (object) [
        'list' => 'views/admin/auth-token/record/list',
        'detail' => 'views/admin/auth-token/record/detail',
        'detailSmall' => 'views/admin/auth-token/record/detail-small'
      ],
      'modalViews' => (object) [
        'detail' => 'views/admin/auth-token/modals/detail'
      ],
      'filterList' => [
        0 => 'active',
        1 => 'inactive'
      ],
      'createDisabled' => true,
      'relationshipPanels' => (object) [
        'actionHistoryRecords' => (object) [
          'createDisabled' => true,
          'selectDisabled' => true,
          'unlinkDisabled' => true,
          'rowActionsView' => 'views/record/row-actions/relationship-view-only'
        ]
      ]
    ],
    'AuthenticationProvider' => (object) [
      'controller' => 'controllers/record',
      'recordViews' => (object) [
        'detail' => 'views/authentication-provider/record/detail',
        'edit' => 'views/authentication-provider/record/edit'
      ],
      'searchPanelDisabled' => true,
      'inlineEditDisabled' => true,
      'duplicateDisabled' => true,
      'massUpdateDisabled' => true,
      'massRemoveDisabled' => true,
      'mergeDisabled' => true
    ],
    'Dashboard' => (object) [
      'controller' => 'controllers/dashboard',
      'iconClass' => 'fas fa-th-large'
    ],
    'DashboardTemplate' => (object) [
      'controller' => 'controllers/record',
      'views' => (object) [
        'detail' => 'views/dashboard-template/detail'
      ],
      'recordViews' => (object) [
        'list' => 'views/dashboard-template/record/list'
      ],
      'menu' => (object) [
        'detail' => (object) [
          'buttons' => [
            0 => (object) [
              'action' => 'deployToUsers',
              'label' => 'Deploy to Users'
            ],
            1 => (object) [
              'action' => 'deployToTeam',
              'label' => 'Deploy to Team'
            ]
          ]
        ]
      ],
      'searchPanelDisabled' => true
    ],
    'DynamicLogic' => (object) [
      'itemTypes' => (object) [
        'and' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/group-base',
          'operator' => 'and'
        ],
        'or' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/group-base',
          'operator' => 'or'
        ],
        'not' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/group-not',
          'operator' => 'not'
        ],
        'equals' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-base',
          'operatorString' => '='
        ],
        'notEquals' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-base',
          'operatorString' => '&ne;'
        ],
        'greaterThan' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-base',
          'operatorString' => '&gt;'
        ],
        'lessThan' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-base',
          'operatorString' => '&lt;'
        ],
        'greaterThanOrEquals' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-base',
          'operatorString' => '&ge;'
        ],
        'lessThanOrEquals' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-base',
          'operatorString' => '&le;'
        ],
        'isEmpty' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-operator-only-base',
          'operatorString' => '= &empty;'
        ],
        'isNotEmpty' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-operator-only-base',
          'operatorString' => '&ne; &empty;'
        ],
        'isTrue' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-operator-only-base',
          'operatorString' => '= 1'
        ],
        'isFalse' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-operator-only-base',
          'operatorString' => '= 0'
        ],
        'in' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-multiple-values-base',
          'operatorString' => '&isin;'
        ],
        'notIn' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-multiple-values-base',
          'operatorString' => '&notin;'
        ],
        'isToday' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-is-today',
          'operatorString' => '='
        ],
        'inFuture' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-in-future',
          'operatorString' => '&isin;'
        ],
        'inPast' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-in-past',
          'operatorString' => '&isin;'
        ],
        'contains' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-value-link',
          'operatorString' => '&niv;'
        ],
        'notContains' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-value-link',
          'operatorString' => '&notni;'
        ],
        'has' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-value-enum',
          'operatorString' => '&niv;'
        ],
        'notHas' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-value-enum',
          'operatorString' => '&notni;'
        ],
        'startsWith' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-value-varchar'
        ],
        'endsWith' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-value-varchar'
        ],
        'matches' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions-string/item-value-varchar'
        ]
      ],
      'fieldTypes' => (object) [
        'bool' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/base',
          'typeList' => [
            0 => 'isTrue',
            1 => 'isFalse'
          ]
        ],
        'varchar' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/base',
          'typeList' => [
            0 => 'equals',
            1 => 'notEquals',
            2 => 'isEmpty',
            3 => 'isNotEmpty',
            4 => 'contains',
            5 => 'notContains',
            6 => 'startsWith',
            7 => 'endsWith',
            8 => 'matches'
          ],
          'conditionTypes' => (object) [
            'contains' => (object) [
              'valueType' => 'field',
              'itemView' => 'views/admin/dynamic-logic/conditions-string/item-base'
            ],
            'notContains' => (object) [
              'valueType' => 'field',
              'itemView' => 'views/admin/dynamic-logic/conditions-string/item-base'
            ]
          ]
        ],
        'url' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/base',
          'typeList' => [
            0 => 'equals',
            1 => 'notEquals',
            2 => 'isEmpty',
            3 => 'isNotEmpty'
          ]
        ],
        'email' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/base',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty'
          ]
        ],
        'phone' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/base',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty'
          ]
        ],
        'text' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/base',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'contains',
            3 => 'notContains',
            4 => 'matches'
          ],
          'conditionTypes' => (object) [
            'contains' => (object) [
              'valueType' => 'varchar',
              'itemView' => 'views/admin/dynamic-logic/conditions-string/item-value-varchar'
            ],
            'notContains' => (object) [
              'valueType' => 'varchar',
              'itemView' => 'views/admin/dynamic-logic/conditions-string/item-value-varchar'
            ]
          ]
        ],
        'int' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/base',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'equals',
            3 => 'notEquals',
            4 => 'greaterThan',
            5 => 'lessThan',
            6 => 'greaterThanOrEquals',
            7 => 'lessThanOrEquals'
          ]
        ],
        'float' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/base',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'equals',
            3 => 'notEquals',
            4 => 'greaterThan',
            5 => 'lessThan',
            6 => 'greaterThanOrEquals',
            7 => 'lessThanOrEquals'
          ]
        ],
        'currency' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/base',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'equals',
            3 => 'notEquals',
            4 => 'greaterThan',
            5 => 'lessThan',
            6 => 'greaterThanOrEquals',
            7 => 'lessThanOrEquals'
          ]
        ],
        'date' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/date',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'isToday',
            3 => 'inFuture',
            4 => 'inPast',
            5 => 'equals',
            6 => 'notEquals'
          ]
        ],
        'datetime' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/date',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'isToday',
            3 => 'inFuture',
            4 => 'inPast'
          ]
        ],
        'datetimeOptional' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/date',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'isToday',
            3 => 'inFuture',
            4 => 'inPast'
          ]
        ],
        'enum' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/enum',
          'typeList' => [
            0 => 'equals',
            1 => 'notEquals',
            2 => 'isEmpty',
            3 => 'isNotEmpty',
            4 => 'in',
            5 => 'notIn'
          ]
        ],
        'link' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/link',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'equals',
            3 => 'notEquals'
          ]
        ],
        'file' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/link',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty'
          ]
        ],
        'image' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/link',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty'
          ]
        ],
        'linkParent' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/link-parent',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'equals',
            3 => 'notEquals'
          ]
        ],
        'linkMultiple' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/link-multiple',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'contains',
            3 => 'notContains'
          ]
        ],
        'foreign' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/base',
          'typeList' => [
            0 => 'equals',
            1 => 'notEquals',
            2 => 'isEmpty',
            3 => 'isNotEmpty'
          ]
        ],
        'id' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/enum',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty'
          ]
        ],
        'multiEnum' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/multi-enum',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'has',
            3 => 'notHas'
          ]
        ],
        'array' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/multi-enum',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'has',
            3 => 'notHas'
          ]
        ],
        'checklist' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/multi-enum',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty',
            2 => 'has',
            3 => 'notHas'
          ]
        ],
        'urlMultiple' => (object) [
          'view' => 'views/admin/dynamic-logic/conditions/field-types/multi-enum',
          'typeList' => [
            0 => 'isEmpty',
            1 => 'isNotEmpty'
          ]
        ]
      ],
      'conditionTypes' => (object) [
        'isTrue' => (object) [
          'valueType' => 'empty'
        ],
        'isFalse' => (object) [
          'valueType' => 'empty'
        ],
        'isEmpty' => (object) [
          'valueType' => 'empty'
        ],
        'isNotEmpty' => (object) [
          'valueType' => 'empty'
        ],
        'equals' => (object) [
          'valueType' => 'field'
        ],
        'notEquals' => (object) [
          'valueType' => 'field'
        ],
        'greaterThan' => (object) [
          'valueType' => 'field'
        ],
        'lessThan' => (object) [
          'valueType' => 'field'
        ],
        'greaterThanOrEquals' => (object) [
          'valueType' => 'field'
        ],
        'lessThanOrEquals' => (object) [
          'valueType' => 'field'
        ],
        'in' => (object) [
          'valueType' => 'field'
        ],
        'notIn' => (object) [
          'valueType' => 'field'
        ],
        'contains' => (object) [
          'valueType' => 'custom'
        ],
        'notContains' => (object) [
          'valueType' => 'custom'
        ],
        'inPast' => (object) [
          'valueType' => 'empty'
        ],
        'isFuture' => (object) [
          'valueType' => 'empty'
        ],
        'isToday' => (object) [
          'valueType' => 'empty'
        ],
        'has' => (object) [
          'valueType' => 'field'
        ],
        'notHas' => (object) [
          'valueType' => 'field'
        ],
        'startsWith' => (object) [
          'valueType' => 'varchar'
        ],
        'endsWith' => (object) [
          'valueType' => 'varchar'
        ],
        'matches' => (object) [
          'valueType' => 'varchar'
        ]
      ]
    ],
    'Email' => (object) [
      'controller' => 'controllers/email',
      'acl' => 'acl/email',
      'views' => (object) [
        'list' => 'views/email/list',
        'detail' => 'views/email/detail'
      ],
      'recordViews' => (object) [
        'list' => 'views/email/record/list',
        'detail' => 'views/email/record/detail',
        'edit' => 'views/email/record/edit',
        'editQuick' => 'views/email/record/edit-quick',
        'detailQuick' => 'views/email/record/detail-quick',
        'compose' => 'views/email/record/compose',
        'listRelated' => 'views/email/record/list-related'
      ],
      'modalViews' => (object) [
        'detail' => 'views/email/modals/detail',
        'compose' => 'views/modals/compose-email'
      ],
      'quickCreateModalType' => 'compose',
      'defaultSidePanelView' => 'views/email/record/panels/default-side',
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'event',
            'label' => 'Event',
            'view' => 'views/email/record/panels/event',
            'isForm' => true,
            'hidden' => true
          ]
        ]
      ],
      'menu' => (object) [
        'list' => (object) [
          'buttons' => [
            0 => (object) [
              'label' => 'Compose',
              'action' => 'composeEmail',
              'style' => 'danger',
              'acl' => 'create',
              'className' => 'btn-s-wide',
              'title' => 'Ctrl+Space'
            ]
          ],
          'dropdown' => [
            0 => (object) [
              'label' => 'Archive Email',
              'link' => '#Email/create',
              'acl' => 'create'
            ],
            1 => false,
            2 => (object) [
              'label' => 'Email Templates',
              'link' => '#EmailTemplate',
              'acl' => 'read',
              'aclScope' => 'EmailTemplate'
            ],
            3 => (object) [
              'label' => 'Folders',
              'link' => '#EmailFolder',
              'configCheck' => '!emailFoldersDisabled',
              'accessDataList' => [
                0 => (object) [
                  'inPortalDisabled' => true
                ]
              ]
            ],
            4 => (object) [
              'label' => 'Group Folders',
              'link' => '#GroupEmailFolder',
              'configCheck' => '!emailFoldersDisabled',
              'accessDataList' => [
                0 => (object) [
                  'inPortalDisabled' => true
                ],
                1 => (object) [
                  'isAdminOnly' => true
                ]
              ]
            ],
            5 => (object) [
              'label' => 'Filters',
              'link' => '#EmailFilter',
              'accessDataList' => [
                0 => (object) [
                  'inPortalDisabled' => true
                ]
              ]
            ]
          ]
        ],
        'detail' => (object) [
          'dropdown' => [
            0 => (object) [
              'label' => 'Reply',
              'action' => 'reply',
              'acl' => 'read'
            ],
            1 => (object) [
              'label' => 'Reply to All',
              'action' => 'replyToAll',
              'acl' => 'read'
            ],
            2 => (object) [
              'label' => 'Forward',
              'action' => 'forward',
              'acl' => 'read'
            ]
          ]
        ]
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'replied' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'repliedId',
                  'data' => (object) [
                    'field' => 'replied'
                  ]
                ]
              ]
            ]
          ],
          'replies' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'repliesIds',
                  'data' => (object) [
                    'field' => 'replies'
                  ]
                ]
              ]
            ]
          ]
        ],
        'panels' => (object) [
          'event' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'icsEventDateStart'
                ]
              ]
            ]
          ]
        ]
      ],
      'filterList' => [],
      'defaultFilterData' => (object) [],
      'boolFilterList' => [],
      'iconClass' => 'fas fa-envelope',
      'layoutBottomPanelsDetailDisabled' => true,
      'layoutDetailDisabled' => true,
      'layoutDetailSmallDisabled' => true,
      'layoutSidePanelsDetailSmallDisabled' => true,
      'layoutSidePanelsEditSmallDisabled' => true,
      'layoutMassUpdateDisabled' => true
    ],
    'EmailAccount' => (object) [
      'controller' => 'controllers/record',
      'recordViews' => (object) [
        'list' => 'views/email-account/record/list',
        'detail' => 'views/email-account/record/detail',
        'edit' => 'views/email-account/record/edit'
      ],
      'views' => (object) [
        'list' => 'views/email-account/list'
      ],
      'inlineEditDisabled' => true,
      'searchPanelDisabled' => true,
      'formDependency' => (object) [
        'storeSentEmails' => (object) [
          'map' => (object) [
            'true' => [
              0 => (object) [
                'action' => 'show',
                'fields' => [
                  0 => 'sentFolder'
                ]
              ],
              1 => (object) [
                'action' => 'setRequired',
                'fields' => [
                  0 => 'sentFolder'
                ]
              ]
            ]
          ],
          'default' => [
            0 => (object) [
              'action' => 'hide',
              'fields' => [
                0 => 'sentFolder'
              ]
            ],
            1 => (object) [
              'action' => 'setNotRequired',
              'fields' => [
                0 => 'sentFolder'
              ]
            ]
          ]
        ]
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'smtpUsername' => (object) [
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'and',
                  'value' => [
                    0 => (object) [
                      'type' => 'isTrue',
                      'attribute' => 'useSmtp'
                    ],
                    1 => (object) [
                      'type' => 'isTrue',
                      'attribute' => 'smtpAuth'
                    ]
                  ]
                ]
              ]
            ]
          ],
          'fetchSince' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'useImap'
                ]
              ]
            ],
            'readOnly' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'fetchData'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'useImap'
                ]
              ]
            ]
          ]
        ]
      ],
      'relationshipPanels' => (object) [
        'filters' => (object) [
          'select' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-edit-and-remove',
          'unlinkDisabled' => true
        ],
        'emails' => (object) [
          'select' => false,
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/remove-only',
          'unlinkDisabled' => true
        ]
      ]
    ],
    'EmailAddress' => (object) [
      'controller' => 'controllers/record',
      'createDisabled' => true,
      'editDisabled' => true,
      'exportDisabled' => true,
      'mergeDisabled' => true,
      'filterList' => [
        0 => 'orphan'
      ]
    ],
    'EmailFilter' => (object) [
      'controller' => 'controllers/record',
      'dynamicHandler' => 'handlers/email-filter',
      'modalViews' => (object) [
        'edit' => 'views/email-filter/modals/edit'
      ],
      'recordViews' => (object) [
        'list' => 'views/email-filter/record/list'
      ],
      'inlineEditDisabled' => true,
      'searchPanelDisabled' => false,
      'menu' => (object) [
        'list' => (object) [
          'buttons' => [
            0 => (object) [
              'label' => 'Emails',
              'link' => '#Email',
              'style' => 'default',
              'aclScope' => 'Email'
            ]
          ]
        ]
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'parent' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'attribute' => 'isGlobal',
                  'type' => 'isFalse'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'attribute' => 'isGlobal',
                  'type' => 'isFalse'
                ]
              ]
            ]
          ],
          'emailFolder' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'attribute' => 'action',
                  'type' => 'equals',
                  'value' => 'Move to Folder'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'attribute' => 'action',
                  'type' => 'equals',
                  'value' => 'Move to Folder'
                ]
              ]
            ]
          ],
          'groupEmailFolder' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'attribute' => 'action',
                  'type' => 'equals',
                  'value' => 'Move to Group Folder'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'attribute' => 'action',
                  'type' => 'equals',
                  'value' => 'Move to Group Folder'
                ]
              ]
            ]
          ],
          'markAsRead' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'attribute' => 'parentType',
                  'type' => 'equals',
                  'value' => 'User'
                ]
              ]
            ]
          ]
        ],
        'options' => (object) [
          'action' => [
            0 => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'attribute' => 'isGlobal',
                  'type' => 'isTrue'
                ]
              ],
              'optionList' => [
                0 => 'Skip'
              ]
            ],
            1 => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'attribute' => 'parentType',
                  'type' => 'equals',
                  'value' => 'User'
                ]
              ],
              'optionList' => [
                0 => 'Skip',
                1 => 'Move to Folder',
                2 => 'None'
              ]
            ],
            2 => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'attribute' => 'parentType',
                  'type' => 'equals',
                  'value' => 'InboundEmail'
                ]
              ],
              'optionList' => [
                0 => 'Skip',
                1 => 'Move to Group Folder'
              ]
            ],
            3 => (object) [
              'conditionGroup' => [],
              'optionList' => [
                0 => 'Skip'
              ]
            ]
          ]
        ]
      ]
    ],
    'EmailFolder' => (object) [
      'controller' => 'controllers/record',
      'views' => (object) [
        'list' => 'views/email-folder/list'
      ],
      'recordViews' => (object) [
        'list' => 'views/email-folder/record/list'
      ],
      'menu' => (object) [
        'list' => (object) [
          'buttons' => [
            0 => (object) [
              'label' => 'Emails',
              'link' => '#Email',
              'style' => 'default',
              'aclScope' => 'Email'
            ]
          ]
        ]
      ],
      'searchPanelDisabled' => true
    ],
    'EmailTemplate' => (object) [
      'controller' => 'controllers/record',
      'views' => (object) [
        'list' => 'views/email-template/list'
      ],
      'recordViews' => (object) [
        'edit' => 'views/email-template/record/edit',
        'detail' => 'views/email-template/record/detail',
        'editQuick' => 'views/email-template/record/edit-quick'
      ],
      'modalViews' => (object) [
        'select' => 'views/modals/select-records-with-categories'
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'information',
            'label' => 'Info',
            'view' => 'views/email-template/record/panels/information'
          ]
        ],
        'edit' => [
          0 => (object) [
            'name' => 'information',
            'label' => 'Info',
            'view' => 'views/email-template/record/panels/information'
          ]
        ]
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'filterList' => [
        0 => 'actual'
      ],
      'placeholderList' => [
        0 => 'today',
        1 => 'now',
        2 => 'currentYear',
        3 => 'optOutUrl',
        4 => 'optOutLink'
      ],
      'iconClass' => 'fas fa-envelope-square'
    ],
    'EmailTemplateCategory' => (object) [
      'controller' => 'controllers/record-tree',
      'collection' => 'collections/tree',
      'menu' => (object) [
        'listTree' => (object) [
          'buttons' => [
            0 => (object) [
              'label' => 'List View',
              'link' => '#EmailTemplateCategory/list',
              'acl' => 'read',
              'style' => 'default'
            ],
            1 => (object) [
              'label' => 'Email Templates',
              'link' => '#EmailTemplate',
              'acl' => 'read',
              'aclScope' => 'EmailTemplate',
              'style' => 'default'
            ]
          ]
        ],
        'list' => (object) [
          'buttons' => [
            0 => (object) [
              'label' => 'Tree View',
              'link' => '#EmailTemplateCategory',
              'acl' => 'read',
              'style' => 'default'
            ],
            1 => (object) [
              'label' => 'Email Templates',
              'link' => '#EmailTemplate',
              'acl' => 'read',
              'aclScope' => 'EmailTemplate',
              'style' => 'default'
            ]
          ]
        ]
      ],
      'relationshipPanels' => (object) [
        'emailTemplates' => (object) [
          'create' => false
        ],
        'children' => (object) [
          'selectDisabled' => true,
          'unlinkDisabled' => true
        ]
      ]
    ],
    'ExternalAccount' => (object) [
      'controller' => 'controllers/external-account'
    ],
    'GroupEmailFolder' => (object) [
      'controller' => 'controllers/record',
      'recordViews' => (object) [
        'list' => 'views/group-email-folder/record/list'
      ],
      'searchPanelDisabled' => true,
      'massUpdateDisabled' => true,
      'mergeDisabled' => true,
      'massRemoveDisabled' => true,
      'relationshipPanels' => (object) [
        'emails' => (object) [
          'select' => false,
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/remove-only',
          'unlinkDisabled' => true
        ]
      ]
    ],
    'Home' => (object) [
      'iconClass' => 'fas fa-th-large'
    ],
    'Import' => (object) [
      'controller' => 'controllers/import',
      'acl' => 'acl/import',
      'recordViews' => (object) [
        'list' => 'views/import/record/list',
        'detail' => 'views/import/record/detail'
      ],
      'views' => (object) [
        'list' => 'views/import/list',
        'detail' => 'views/import/detail'
      ],
      'bottomPanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'imported',
            'label' => 'Imported',
            'view' => 'views/import/record/panels/imported',
            'createDisabled' => true,
            'selectDisabled' => true,
            'unlinkDisabled' => true
          ],
          1 => (object) [
            'name' => 'duplicates',
            'label' => 'Duplicates',
            'view' => 'views/import/record/panels/duplicates',
            'rowActionsView' => 'views/import/record/row-actions/duplicates',
            'createDisabled' => true,
            'selectDisabled' => true,
            'unlinkDisabled' => true
          ],
          2 => (object) [
            'name' => 'updated',
            'label' => 'Updated',
            'view' => 'views/import/record/panels/updated',
            'createDisabled' => true,
            'selectDisabled' => true,
            'unlinkDisabled' => true
          ]
        ]
      ],
      'searchPanelDisabled' => true,
      'relationshipPanels' => (object) [
        'errors' => (object) [
          'unlinkDisabled' => true,
          'actionList' => [
            0 => (object) [
              'name' => 'export',
              'action' => 'errorExport',
              'label' => 'Export',
              'data' => (object) [
                'handler' => 'handlers/import'
              ]
            ]
          ]
        ]
      ],
      'iconClass' => 'fas fa-file-import',
      'dateFormatList' => [
        0 => 'YYYY-MM-DD',
        1 => 'DD-MM-YYYY',
        2 => 'MM-DD-YYYY',
        3 => 'MM/DD/YYYY',
        4 => 'DD/MM/YYYY',
        5 => 'DD.MM.YYYY',
        6 => 'MM.DD.YYYY',
        7 => 'YYYY.MM.DD',
        8 => 'DD. MM. YYYY'
      ],
      'timeFormatList' => [
        0 => 'HH:mm:ss',
        1 => 'HH:mm',
        2 => 'hh:mm a',
        3 => 'hh:mma',
        4 => 'hh:mm A',
        5 => 'hh:mmA',
        6 => 'hh:mm:ss a',
        7 => 'hh:mm:ssa',
        8 => 'hh:mm:ss A',
        9 => 'hh:mm:ssA'
      ]
    ],
    'ImportError' => (object) [
      'controller' => 'controllers/record',
      'acl' => 'acl/foreign',
      'searchPanelDisabled' => true,
      'createDisabled' => true,
      'editDisabled' => true
    ],
    'InboundEmail' => (object) [
      'recordViews' => (object) [
        'detail' => 'views/inbound-email/record/detail',
        'edit' => 'views/inbound-email/record/edit',
        'list' => 'views/inbound-email/record/list'
      ],
      'inlineEditDisabled' => true,
      'formDependency' => (object) [
        'reply' => (object) [
          'map' => (object) [
            'true' => [
              0 => (object) [
                'action' => 'show',
                'fields' => [
                  0 => 'replyEmailTemplate',
                  1 => 'replyFromAddress',
                  2 => 'replyFromName'
                ]
              ],
              1 => (object) [
                'action' => 'setRequired',
                'fields' => [
                  0 => 'replyEmailTemplate'
                ]
              ]
            ]
          ],
          'default' => [
            0 => (object) [
              'action' => 'hide',
              'fields' => [
                0 => 'replyEmailTemplate',
                1 => 'replyFromAddress',
                2 => 'replyFromName'
              ]
            ],
            1 => (object) [
              'action' => 'setNotRequired',
              'fields' => [
                0 => 'replyEmailTemplate'
              ]
            ]
          ]
        ]
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'smtpUsername' => (object) [
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'and',
                  'value' => [
                    0 => (object) [
                      'type' => 'isTrue',
                      'attribute' => 'useSmtp'
                    ],
                    1 => (object) [
                      'type' => 'isTrue',
                      'attribute' => 'smtpAuth'
                    ]
                  ]
                ]
              ]
            ]
          ],
          'fetchSince' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'useImap'
                ]
              ]
            ],
            'readOnly' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'fetchData'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'useImap'
                ]
              ]
            ]
          ]
        ]
      ],
      'searchPanelDisabled' => true,
      'relationshipPanels' => (object) [
        'filters' => (object) [
          'select' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-edit-and-remove',
          'unlinkDisabled' => true
        ],
        'emails' => (object) [
          'select' => false,
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/remove-only',
          'unlinkDisabled' => true
        ]
      ],
      'defaultSidePanelFieldLists' => (object) [
        'detail' => [],
        'detailSmall' => [],
        'edit' => [],
        'editSmall' => []
      ]
    ],
    'Job' => (object) [
      'modalViews' => (object) [
        'detail' => 'views/admin/job/modals/detail'
      ],
      'recordViews' => (object) [
        'list' => 'views/admin/job/record/list',
        'detailQuick' => 'views/admin/job/record/detail-small'
      ]
    ],
    'LastViewed' => (object) [
      'controller' => 'controllers/last-viewed',
      'views' => (object) [
        'list' => 'views/last-viewed/list'
      ],
      'recordViews' => (object) [
        'list' => 'views/last-viewed/record/list'
      ]
    ],
    'LayoutSet' => (object) [
      'controller' => 'controllers/layout-set',
      'recordViews' => (object) [
        'list' => 'views/layout-set/record/list'
      ],
      'searchPanelDisabled' => true,
      'duplicateDisabled' => true,
      'relationshipPanels' => (object) [
        'teams' => (object) [
          'createDisabled' => true,
          'viewDisabled' => true,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only'
        ]
      ]
    ],
    'LeadCapture' => (object) [
      'controller' => 'controllers/record',
      'searchPanelDisabled' => true,
      'recordViews' => (object) [
        'detail' => 'views/lead-capture/record/detail',
        'list' => 'views/lead-capture/record/list'
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'targetList' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'subscribeToTargetList'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'subscribeToTargetList'
                ]
              ]
            ]
          ],
          'subscribeContactToTargetList' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'subscribeToTargetList'
                ]
              ]
            ]
          ],
          'optInConfirmationLifetime' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'optInConfirmation'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'optInConfirmation'
                ]
              ]
            ]
          ],
          'optInConfirmationSuccessMessage' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'optInConfirmation'
                ]
              ]
            ]
          ],
          'createLeadBeforeOptInConfirmation' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'optInConfirmation'
                ]
              ]
            ]
          ],
          'smtpAccount' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'optInConfirmation'
                ]
              ]
            ]
          ],
          'skipOptInConfirmationIfSubscribed' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'and',
                  'value' => [
                    0 => (object) [
                      'type' => 'isTrue',
                      'attribute' => 'optInConfirmation'
                    ],
                    1 => (object) [
                      'type' => 'isNotEmpty',
                      'attribute' => 'targetListId',
                      'data' => (object) [
                        'field' => 'targetList'
                      ]
                    ]
                  ]
                ]
              ]
            ]
          ],
          'optInConfirmationEmailTemplate' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'optInConfirmation'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'optInConfirmation'
                ]
              ]
            ]
          ],
          'apiKey' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'id'
                ]
              ]
            ]
          ]
        ]
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'request',
            'label' => 'Request',
            'isForm' => true,
            'view' => 'views/lead-capture/record/panels/request'
          ]
        ]
      ],
      'relationshipPanels' => (object) [
        'logRecords' => (object) [
          'rowActionsView' => 'views/record/row-actions/view-and-remove',
          'layout' => 'listForLeadCapture',
          'select' => false,
          'create' => false
        ]
      ]
    ],
    'LeadCaptureLogRecord' => (object) [
      'modalViews' => (object) [
        'detail' => 'views/lead-capture-log-record/modals/detail'
      ]
    ],
    'Note' => (object) [
      'controller' => 'controllers/note',
      'collection' => 'collections/note',
      'recordViews' => (object) [
        'edit' => 'views/note/record/edit',
        'editQuick' => 'views/note/record/edit',
        'listRelated' => 'views/stream/record/list'
      ],
      'modalViews' => (object) [
        'edit' => 'views/note/modals/edit'
      ],
      'itemViews' => (object) [
        'Post' => 'views/stream/notes/post',
        'EventConfirmation' => 'crm:views/stream/notes/event-confirmation'
      ]
    ],
    'Notification' => (object) [
      'controller' => 'controllers/notification',
      'acl' => 'acl/notification',
      'aclPortal' => 'acl-portal/notification',
      'collection' => 'collections/note',
      'itemViews' => (object) [
        'System' => 'views/notification/items/system',
        'EventAttendee' => 'crm:views/notification/items/event-attendee'
      ]
    ],
    'PasswordChangeRequest' => (object) [
      'controller' => 'controllers/password-change-request'
    ],
    'PhoneNumber' => (object) [
      'controller' => 'controllers/record',
      'createDisabled' => true,
      'editDisabled' => true,
      'exportDisabled' => true,
      'mergeDisabled' => true,
      'filterList' => [
        0 => 'orphan'
      ]
    ],
    'Portal' => (object) [
      'controller' => 'controllers/record',
      'recordViews' => (object) [
        'list' => 'views/portal/record/list'
      ],
      'relationshipPanels' => (object) [
        'users' => (object) [
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
          'layout' => 'listSmall',
          'selectPrimaryFilterName' => 'activePortal'
        ],
        'authenticationProvider' => (object) [
          'createDisabled' => true
        ]
      ],
      'searchPanelDisabled' => true
    ],
    'PortalRole' => (object) [
      'recordViews' => (object) [
        'detail' => 'views/portal-role/record/detail',
        'edit' => 'views/portal-role/record/edit',
        'editQuick' => 'views/portal-role/record/edit',
        'list' => 'views/portal-role/record/list'
      ],
      'relationshipPanels' => (object) [
        'users' => (object) [
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only'
        ]
      ],
      'views' => (object) [
        'list' => 'views/portal-role/list'
      ]
    ],
    'PortalUser' => (object) [
      'controller' => 'controllers/portal-user',
      'views' => (object) [
        'detail' => 'views/user/detail',
        'list' => 'views/portal-user/list'
      ],
      'recordViews' => (object) [
        'list' => 'views/user/record/list',
        'detail' => 'views/user/record/detail',
        'edit' => 'views/user/record/edit',
        'detailSmall' => 'views/user/record/detail-quick',
        'editSmall' => 'views/user/record/edit-quick'
      ],
      'defaultSidePanelFieldLists' => (object) [
        'detail' => [
          0 => 'avatar',
          1 => 'createdAt',
          2 => 'lastAccess'
        ],
        'detailSmall' => [
          0 => 'avatar',
          1 => 'createdAt'
        ],
        'edit' => [
          0 => 'avatar'
        ],
        'editSmall' => [
          0 => 'avatar'
        ]
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ]
        ],
        'detailSmall' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ]
        ]
      ],
      'filterList' => [
        0 => 'activePortal'
      ],
      'boolFilterList' => [],
      'selectDefaultFilters' => (object) [
        'filter' => 'activePortal'
      ],
      'iconClass' => 'far fa-user-circle'
    ],
    'Preferences' => (object) [
      'recordViews' => (object) [
        'edit' => 'views/preferences/record/edit'
      ],
      'views' => (object) [
        'edit' => 'views/preferences/edit'
      ],
      'acl' => 'acl/preferences',
      'aclPortal' => 'acl-portal/preferences',
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'assignmentEmailNotificationsIgnoreEntityTypeList' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'receiveAssignmentEmailNotifications'
                ]
              ]
            ]
          ]
        ]
      ]
    ],
    'Role' => (object) [
      'recordViews' => (object) [
        'detail' => 'views/role/record/detail',
        'edit' => 'views/role/record/edit',
        'editQuick' => 'views/role/record/edit',
        'list' => 'views/role/record/list'
      ],
      'relationshipPanels' => (object) [
        'users' => (object) [
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only'
        ],
        'teams' => (object) [
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only'
        ]
      ],
      'views' => (object) [
        'list' => 'views/role/list'
      ]
    ],
    'ScheduledJob' => (object) [
      'controller' => 'controllers/record',
      'relationshipPanels' => (object) [
        'log' => (object) [
          'readOnly' => true,
          'view' => 'views/scheduled-job/record/panels/log',
          'createDisabled' => true,
          'selectDisabled' => true,
          'viewDisabled' => true,
          'unlinkDisabled' => true
        ]
      ],
      'recordViews' => (object) [
        'list' => 'views/scheduled-job/record/list',
        'detail' => 'views/scheduled-job/record/detail'
      ],
      'views' => (object) [
        'list' => 'views/scheduled-job/list'
      ],
      'jobWithTargetList' => [
        0 => 'CheckEmailAccounts',
        1 => 'CheckInboundEmails'
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'job' => (object) [
            'readOnly' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'id'
                ]
              ]
            ]
          ]
        ]
      ]
    ],
    'ScheduledJobLogRecord' => (object) [
      'controller' => 'controllers/record'
    ],
    'Stream' => (object) [
      'controller' => 'controllers/stream',
      'iconClass' => 'fas fa-rss'
    ],
    'Team' => (object) [
      'acl' => 'acl/team',
      'defaultSidePanel' => (object) [
        'edit' => false,
        'editSmall' => false
      ],
      'defaultSidePanelFieldLists' => (object) [
        'detail' => [
          0 => 'createdAt'
        ]
      ],
      'relationshipPanels' => (object) [
        'users' => (object) [
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-unlink-only',
          'layout' => 'listForTeam',
          'selectPrimaryFilterName' => 'active',
          'filterList' => [
            0 => 'all',
            1 => 'active'
          ]
        ]
      ],
      'recordViews' => (object) [
        'detail' => 'views/team/record/detail',
        'edit' => 'views/team/record/edit',
        'list' => 'views/team/record/list'
      ],
      'modalViews' => (object) [
        'detail' => 'views/team/modals/detail'
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'iconClass' => 'fas fa-users'
    ],
    'Template' => (object) [
      'controller' => 'controllers/record',
      'recordViews' => (object) [
        'detail' => 'views/template/record/detail',
        'edit' => 'views/template/record/edit'
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'entityType' => (object) [
            'readOnly' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'id'
                ]
              ]
            ]
          ],
          'footer' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'printFooter'
                ]
              ]
            ]
          ],
          'footerPosition' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'printFooter'
                ]
              ]
            ]
          ],
          'header' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'printHeader'
                ]
              ]
            ]
          ],
          'headerPosition' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'printHeader'
                ]
              ]
            ]
          ],
          'body' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'entityType'
                ]
              ]
            ]
          ],
          'pageWidth' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'pageFormat',
                  'value' => 'Custom'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'pageFormat',
                  'value' => 'Custom'
                ]
              ]
            ]
          ],
          'pageHeight' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'pageFormat',
                  'value' => 'Custom'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'pageFormat',
                  'value' => 'Custom'
                ]
              ]
            ]
          ]
        ]
      ],
      'iconClass' => 'fas fa-file-pdf'
    ],
    'User' => (object) [
      'controller' => 'controllers/user',
      'model' => 'models/user',
      'acl' => 'acl/user',
      'views' => (object) [
        'detail' => 'views/user/detail',
        'list' => 'views/user/list'
      ],
      'recordViews' => (object) [
        'detail' => 'views/user/record/detail',
        'detailSmall' => 'views/user/record/detail-quick',
        'edit' => 'views/user/record/edit',
        'editSmall' => 'views/user/record/edit-quick',
        'list' => 'views/user/record/list'
      ],
      'modalViews' => (object) [
        'selectFollowers' => 'views/user/modals/select-followers',
        'detail' => 'views/user/modals/detail',
        'massUpdate' => 'views/user/modals/mass-update'
      ],
      'defaultSidePanel' => (object) [
        'detail' => (object) [
          'name' => 'default',
          'label' => false,
          'view' => 'views/user/record/panels/default-side',
          'isForm' => true
        ],
        'detailSmall' => (object) [
          'name' => 'default',
          'label' => false,
          'view' => 'views/user/record/panels/default-side',
          'isForm' => true
        ],
        'edit' => (object) [
          'name' => 'default',
          'label' => false,
          'view' => 'views/user/record/panels/default-side',
          'isForm' => true
        ],
        'editSmall' => (object) [
          'name' => 'default',
          'label' => false,
          'view' => 'views/user/record/panels/default-side',
          'isForm' => true
        ]
      ],
      'defaultSidePanelFieldLists' => (object) [
        'detail' => [
          0 => 'avatar',
          1 => 'createdAt',
          2 => 'lastAccess',
          3 => 'auth2FA'
        ],
        'detailSmall' => [
          0 => 'avatar',
          1 => 'lastAccess'
        ],
        'edit' => [
          0 => 'avatar'
        ],
        'editSmall' => [
          0 => 'avatar'
        ]
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/user/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ],
        'detailSmall' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/user/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ]
      ],
      'relationshipPanels' => (object) [
        'targetLists' => (object) [
          'create' => false,
          'rowActionsView' => 'crm:views/record/row-actions/relationship-target',
          'layout' => 'listForTarget',
          'view' => 'crm:views/record/panels/target-lists'
        ]
      ],
      'layoutDefaultSidePanelDisabled' => true,
      'filterList' => [
        0 => 'active'
      ],
      'boolFilterList' => [
        0 => 'onlyMyTeam'
      ],
      'selectDefaultFilters' => (object) [
        'filter' => 'active'
      ],
      'selectRecords' => (object) [
        'orderBy' => 'userNameOwnFirst'
      ],
      'iconClass' => 'fas fa-user-circle',
      'dynamicLogic' => (object) [
        'options' => (object) [
          'authMethod' => [
            0 => (object) [
              'optionList' => [
                0 => 'ApiKey',
                1 => 'Hmac'
              ],
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'type',
                  'value' => 'api'
                ]
              ]
            ]
          ]
        ]
      ]
    ],
    'Webhook' => (object) [
      'controller' => 'controllers/record',
      'recordViews' => (object) [
        'list' => 'views/webhook/record/list'
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'event' => (object) [
            'readOnly' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'id'
                ]
              ]
            ]
          ],
          'secretKey' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'id'
                ]
              ]
            ]
          ]
        ]
      ]
    ],
    'WorkingTimeCalendar' => (object) [
      'controller' => 'controllers/record',
      'searchPanelDisabled' => true,
      'massUpdateDisabled' => true,
      'mergeDisabled' => true,
      'massRemoveDisabled' => true,
      'iconClass' => 'fas fa-calendar-week',
      'menu' => (object) [
        'list' => (object) [
          'buttons' => [
            0 => (object) [
              'name' => 'ranges',
              'label' => 'Ranges',
              'link' => '#WorkingTimeRange'
            ]
          ]
        ]
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'weekday0TimeRanges' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'weekday0'
                ]
              ]
            ]
          ],
          'weekday1TimeRanges' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'weekday1'
                ]
              ]
            ]
          ],
          'weekday2TimeRanges' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'weekday2'
                ]
              ]
            ]
          ],
          'weekday3TimeRanges' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'weekday3'
                ]
              ]
            ]
          ],
          'weekday4TimeRanges' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'weekday4'
                ]
              ]
            ]
          ],
          'weekday5TimeRanges' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'weekday5'
                ]
              ]
            ]
          ],
          'weekday6TimeRanges' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'weekday6'
                ]
              ]
            ]
          ],
          'teams' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'teamsIds'
                ]
              ]
            ]
          ]
        ]
      ]
    ],
    'WorkingTimeRange' => (object) [
      'controller' => 'controllers/record',
      'viewSetupHandlers' => (object) [
        'record/edit' => 'handlers/working-time-range'
      ],
      'mergeDisabled' => true,
      'massUpdateDisabled' => true,
      'menu' => (object) [
        'list' => (object) [
          'buttons' => [
            0 => (object) [
              'name' => 'calendars',
              'label' => 'Calendars',
              'link' => '#WorkingTimeCalendar'
            ]
          ]
        ]
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'timeRanges' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'type',
                  'value' => 'Working'
                ]
              ]
            ]
          ]
        ]
      ],
      'filterList' => [
        0 => 'actual'
      ]
    ],
    'Account' => (object) [
      'controller' => 'controllers/record',
      'aclPortal' => 'crm:acl-portal/account',
      'views' => (object) [
        'detail' => 'crm:views/account/detail'
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ],
        'detailSmall' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ]
      ],
      'relationshipPanels' => (object) [
        'contacts' => (object) [
          'filterList' => [
            0 => 'all',
            1 => 'accountActive'
          ],
          'layout' => 'listForAccount',
          'orderBy' => 'name',
          'createAttributeMap' => (object) [
            'billingAddressCity' => 'addressCity',
            'billingAddressStreet' => 'addressStreet',
            'billingAddressPostalCode' => 'addressPostalCode',
            'billingAddressState' => 'addressState',
            'billingAddressCountry' => 'addressCountry',
            'id' => 'accountId',
            'name' => 'accountName'
          ]
        ],
        'opportunities' => (object) [
          'layout' => 'listForAccount'
        ],
        'campaignLogRecords' => (object) [
          'rowActionsView' => 'views/record/row-actions/empty',
          'select' => false,
          'create' => false
        ],
        'targetLists' => (object) [
          'rowActionsView' => 'crm:views/record/row-actions/relationship-target',
          'layout' => 'listForTarget',
          'view' => 'crm:views/record/panels/target-lists'
        ]
      ],
      'filterList' => [
        0 => (object) [
          'name' => 'recentlyCreated'
        ]
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'additionalLayouts' => (object) [
        'detailConvert' => (object) [
          'type' => 'detail'
        ]
      ],
      'color' => '#edc755',
      'iconClass' => 'fas fa-building'
    ],
    'Activities' => (object) [
      'controller' => 'crm:controllers/activities'
    ],
    'Calendar' => (object) [
      'colors' => (object) [
        'Meeting' => '#558BBD',
        'Call' => '#CF605D',
        'Task' => '#70c173'
      ],
      'scopeList' => [
        0 => 'Meeting',
        1 => 'Call',
        2 => 'Task'
      ],
      'allDayScopeList' => [
        0 => 'Task'
      ],
      'modeList' => [
        0 => 'month',
        1 => 'agendaWeek',
        2 => 'timeline',
        3 => 'agendaDay'
      ],
      'sharedViewModeList' => [
        0 => 'basicWeek',
        1 => 'month',
        2 => 'basicDay'
      ],
      'additionalColorList' => [
        0 => '#AB78AD',
        1 => '#CC9B45'
      ],
      'iconClass' => 'far fa-calendar-alt'
    ],
    'Call' => (object) [
      'controller' => 'controllers/record',
      'acl' => 'crm:acl/call',
      'views' => (object) [
        'detail' => 'crm:views/call/detail'
      ],
      'recordViews' => (object) [
        'list' => 'crm:views/call/record/list',
        'detail' => 'crm:views/call/record/detail',
        'editSmall' => 'crm:views/call/record/edit-small'
      ],
      'modalViews' => (object) [
        'detail' => 'crm:views/meeting/modals/detail'
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
            'isForm' => true,
            'notRefreshable' => true
          ]
        ],
        'detailSmall' => [
          0 => (object) [
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
            'isForm' => true,
            'notRefreshable' => true
          ]
        ],
        'edit' => [
          0 => (object) [
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
            'isForm' => true,
            'notRefreshable' => true
          ]
        ],
        'editSmall' => [
          0 => (object) [
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
            'isForm' => true,
            'notRefreshable' => true
          ]
        ]
      ],
      'bottomPanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'scheduler',
            'label' => 'Scheduler',
            'view' => 'crm:views/meeting/record/panels/scheduler',
            'disabled' => true,
            'order' => 3
          ]
        ],
        'edit' => [
          0 => (object) [
            'name' => 'scheduler',
            'label' => 'Scheduler',
            'view' => 'crm:views/meeting/record/panels/scheduler',
            'disabled' => true,
            'order' => 1
          ]
        ],
        'editSmall' => [
          0 => (object) [
            'name' => 'scheduler',
            'label' => 'Scheduler',
            'view' => 'crm:views/meeting/record/panels/scheduler',
            'disabled' => true,
            'order' => 1
          ]
        ]
      ],
      'filterList' => [
        0 => (object) [
          'name' => 'planned'
        ],
        1 => (object) [
          'name' => 'held',
          'style' => 'success'
        ],
        2 => (object) [
          'name' => 'todays'
        ]
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'activityDefs' => (object) [
        'link' => 'calls',
        'activitiesCreate' => true,
        'historyCreate' => true
      ],
      'forcePatchAttributeDependencyMap' => (object) [
        'dateEnd' => [
          0 => 'dateStart'
        ],
        'dateEndDate' => [
          0 => 'dateStartDate'
        ]
      ],
      'relationshipPanels' => (object) [
        'contacts' => (object) [
          'selectHandler' => 'handlers/select-related/same-account-many'
        ]
      ],
      'additionalLayouts' => (object) [
        'bottomPanelsEditSmall' => (object) [
          'type' => 'bottomPanelsEditSmall'
        ]
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'reminders' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'and',
                  'value' => [
                    0 => (object) [
                      'type' => 'notEquals',
                      'attribute' => 'status',
                      'value' => 'Held'
                    ],
                    1 => (object) [
                      'type' => 'notEquals',
                      'attribute' => 'status',
                      'value' => 'Not Held'
                    ]
                  ]
                ]
              ]
            ]
          ]
        ]
      ],
      'iconClass' => 'fas fa-phone'
    ],
    'Campaign' => (object) [
      'controller' => 'controllers/record',
      'menu' => (object) [
        'list' => (object) [
          'buttons' => [
            0 => (object) [
              'label' => 'Target Lists',
              'link' => '#TargetList',
              'acl' => 'read',
              'style' => 'default',
              'aclScope' => 'TargetList'
            ]
          ],
          'dropdown' => [
            0 => (object) [
              'label' => 'Mass Emails',
              'link' => '#MassEmail',
              'acl' => 'read',
              'aclScope' => 'MassEmail'
            ],
            1 => (object) [
              'label' => 'Email Templates',
              'link' => '#EmailTemplate',
              'acl' => 'read',
              'aclScope' => 'EmailTemplate'
            ],
            2 => (object) [
              'label' => 'Tracking URLs',
              'labelTranslation' => 'Campaign.links.trackingUrls',
              'link' => '#CampaignTrackingUrl',
              'acl' => 'read',
              'aclScope' => 'CampaignTrackingUrl'
            ]
          ]
        ]
      ],
      'recordViews' => (object) [
        'detail' => 'crm:views/campaign/record/detail'
      ],
      'views' => (object) [
        'detail' => 'crm:views/campaign/detail'
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'statistics',
            'label' => 'Statistics',
            'view' => 'crm:views/campaign/record/panels/campaign-stats',
            'hidden' => false,
            'isForm' => true
          ]
        ]
      ],
      'relationshipPanels' => (object) [
        'campaignLogRecords' => (object) [
          'view' => 'crm:views/campaign/record/panels/campaign-log-records',
          'layout' => 'listForCampaign',
          'rowActionsView' => 'views/record/row-actions/remove-only',
          'select' => false,
          'create' => false
        ],
        'massEmails' => (object) [
          'createAttributeMap' => (object) [
            'targetListsIds' => 'targetListsIds',
            'targetListsNames' => 'targetListsNames',
            'excludingTargetListsIds' => 'excludingTargetListsIds',
            'excludingTargetListsNames' => 'excludingTargetListsNames'
          ],
          'createHandler' => 'crm:handlers/campaign/mass-emails-create'
        ]
      ],
      'filterList' => [
        0 => 'active'
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'targetLists' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'or',
                  'value' => [
                    0 => (object) [
                      'type' => 'equals',
                      'attribute' => 'type',
                      'value' => 'Email'
                    ],
                    1 => (object) [
                      'type' => 'equals',
                      'attribute' => 'type',
                      'value' => 'Newsletter'
                    ],
                    2 => (object) [
                      'type' => 'equals',
                      'attribute' => 'type',
                      'value' => 'Mail'
                    ]
                  ]
                ]
              ]
            ]
          ],
          'excludingTargetLists' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'or',
                  'value' => [
                    0 => (object) [
                      'type' => 'equals',
                      'attribute' => 'type',
                      'value' => 'Email'
                    ],
                    1 => (object) [
                      'type' => 'equals',
                      'attribute' => 'type',
                      'value' => 'Newsletter'
                    ],
                    2 => (object) [
                      'type' => 'equals',
                      'attribute' => 'type',
                      'value' => 'Mail'
                    ]
                  ]
                ]
              ]
            ]
          ],
          'contactsTemplate' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'type',
                  'value' => 'Mail'
                ]
              ]
            ]
          ],
          'leadsTemplate' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'type',
                  'value' => 'Mail'
                ]
              ]
            ]
          ],
          'accountsTemplate' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'type',
                  'value' => 'Mail'
                ]
              ]
            ]
          ],
          'usersTemplate' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'type',
                  'value' => 'Mail'
                ]
              ]
            ]
          ],
          'mailMergeOnlyWithAddress' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'type',
                  'value' => 'Mail'
                ]
              ]
            ]
          ]
        ],
        'panels' => (object) [
          'mailMerge' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'type',
                  'value' => 'Mail'
                ]
              ]
            ]
          ]
        ]
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'iconClass' => 'fas fa-chart-line'
    ],
    'CampaignLogRecord' => (object) [
      'acl' => 'crm:acl/campaign-tracking-url'
    ],
    'CampaignTrackingUrl' => (object) [
      'controller' => 'controllers/record',
      'acl' => 'crm:acl/campaign-tracking-url',
      'recordViews' => (object) [
        'edit' => 'crm:views/campaign-tracking-url/record/edit',
        'editQuick' => 'crm:views/campaign-tracking-url/record/edit-small'
      ],
      'defaultSidePanel' => (object) [
        'edit' => false,
        'editSmall' => false
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'url' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'action',
                  'value' => 'Redirect'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'action',
                  'value' => 'Redirect'
                ]
              ]
            ]
          ],
          'message' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'action',
                  'value' => 'Show Message'
                ]
              ]
            ],
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'action',
                  'value' => 'Show Message'
                ]
              ]
            ]
          ]
        ]
      ]
    ],
    'Case' => (object) [
      'controller' => 'controllers/record',
      'recordViews' => (object) [
        'detail' => 'crm:views/case/record/detail'
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/case/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ],
        'detailSmall' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/case/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ]
      ],
      'filterList' => [
        0 => (object) [
          'name' => 'open'
        ],
        1 => (object) [
          'name' => 'closed',
          'style' => 'success'
        ]
      ],
      'relationshipPanels' => (object) [
        'articles' => (object) [
          'create' => false,
          'recordListView' => 'crm:views/knowledge-base-article/record/list-for-case',
          'rowActionsView' => 'crm:views/knowledge-base-article/record/row-actions/for-case'
        ],
        'contacts' => (object) [
          'createAttributeMap' => (object) [
            'accountId' => 'accountId',
            'accountName' => 'accountName'
          ],
          'selectHandler' => 'handlers/select-related/same-account-many'
        ],
        'contact' => (object) [
          'createAttributeMap' => (object) [
            'accountId' => 'accountId',
            'accountName' => 'accountName'
          ],
          'selectHandler' => 'handlers/select-related/same-account-many'
        ]
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'selectDefaultFilters' => (object) [
        'filter' => 'open'
      ],
      'allowInternalNotes' => true,
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'number' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'id'
                ]
              ]
            ]
          ]
        ]
      ],
      'additionalLayouts' => (object) [
        'detailPortal' => (object) [
          'type' => 'detail'
        ],
        'detailSmallPortal' => (object) [
          'type' => 'detail'
        ],
        'listPortal' => (object) [
          'type' => 'list'
        ]
      ],
      'iconClass' => 'fas fa-briefcase'
    ],
    'Contact' => (object) [
      'controller' => 'controllers/record',
      'aclPortal' => 'crm:acl-portal/contact',
      'views' => (object) [
        'detail' => 'crm:views/contact/detail'
      ],
      'recordViews' => (object) [
        'detail' => 'crm:views/contact/record/detail',
        'detailQuick' => 'crm:views/contact/record/detail-small'
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ],
        'detailSmall' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ]
      ],
      'relationshipPanels' => (object) [
        'campaignLogRecords' => (object) [
          'rowActionsView' => 'views/record/row-actions/empty',
          'select' => false,
          'create' => false
        ],
        'opportunities' => (object) [
          'layout' => 'listForContact',
          'createAttributeMap' => (object) [
            'accountId' => 'accountId',
            'accountName' => 'accountName'
          ],
          'selectHandler' => 'handlers/select-related/same-account'
        ],
        'cases' => (object) [
          'createAttributeMap' => (object) [
            'accountId' => 'accountId',
            'accountName' => 'accountName',
            'id' => 'contactId',
            'name' => 'contactName'
          ],
          'selectHandler' => 'handlers/select-related/same-account'
        ],
        'targetLists' => (object) [
          'create' => false,
          'rowActionsView' => 'crm:views/record/row-actions/relationship-target',
          'layout' => 'listForTarget',
          'view' => 'crm:views/record/panels/target-lists'
        ]
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'additionalLayouts' => (object) [
        'detailConvert' => (object) [
          'type' => 'detail'
        ],
        'listForAccount' => (object) [
          'type' => 'listSmall'
        ]
      ],
      'filterList' => [
        0 => 'portalUsers'
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'accountId'
                ]
              ]
            ]
          ],
          'portalUser' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'portalUserId',
                  'data' => (object) [
                    'field' => 'portalUser'
                  ]
                ]
              ]
            ]
          ]
        ]
      ],
      'color' => '#a4c5e0',
      'iconClass' => 'fas fa-id-badge'
    ],
    'Document' => (object) [
      'aclPortal' => 'crm:acl-portal/document',
      'controller' => 'controllers/record',
      'views' => (object) [
        'list' => 'crm:views/document/list'
      ],
      'modalViews' => (object) [
        'select' => 'crm:views/document/modals/select-records'
      ],
      'viewSetupHandlers' => (object) [
        'list' => [
          0 => 'crm:view-setup-handlers/document/record-list-drag-n-drop'
        ]
      ],
      'filterList' => [
        0 => 'active',
        1 => 'draft'
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'selectDefaultFilters' => (object) [
        'filter' => 'active'
      ],
      'iconClass' => 'far fa-file-alt'
    ],
    'DocumentFolder' => (object) [
      'controller' => 'controllers/record-tree',
      'collection' => 'collections/tree',
      'menu' => (object) [
        'listTree' => (object) [
          'buttons' => [
            0 => (object) [
              'label' => 'List View',
              'link' => '#DocumentFolder/list',
              'acl' => 'read',
              'style' => 'default'
            ],
            1 => (object) [
              'label' => 'Documents',
              'link' => '#Document',
              'acl' => 'read',
              'style' => 'default',
              'aclScope' => 'Document'
            ]
          ]
        ],
        'list' => (object) [
          'buttons' => [
            0 => (object) [
              'label' => 'Tree View',
              'link' => '#DocumentFolder',
              'acl' => 'read',
              'style' => 'default'
            ],
            1 => (object) [
              'label' => 'Documents',
              'link' => '#Document',
              'acl' => 'read',
              'style' => 'default',
              'aclScope' => 'Document'
            ]
          ]
        ]
      ],
      'relationshipPanels' => (object) [
        'children' => (object) [
          'selectDisabled' => true,
          'unlinkDisabled' => true
        ]
      ]
    ],
    'EmailQueueItem' => (object) [
      'controller' => 'controllers/record',
      'views' => (object) [
        'list' => 'crm:views/email-queue-item/list'
      ],
      'recordViews' => (object) [
        'list' => 'crm:views/email-queue-item/record/list'
      ]
    ],
    'KnowledgeBaseArticle' => (object) [
      'controller' => 'controllers/record',
      'views' => (object) [
        'list' => 'crm:views/knowledge-base-article/list'
      ],
      'recordViews' => (object) [
        'editQuick' => 'crm:views/knowledge-base-article/record/edit-quick',
        'detailQuick' => 'crm:views/knowledge-base-article/record/detail-quick',
        'detail' => 'crm:views/knowledge-base-article/record/detail',
        'edit' => 'crm:views/knowledge-base-article/record/edit',
        'list' => 'crm:views/knowledge-base-article/record/list'
      ],
      'modalViews' => (object) [
        'select' => 'crm:views/knowledge-base-article/modals/select-records'
      ],
      'filterList' => [
        0 => (object) [
          'name' => 'published',
          'accessDataList' => [
            0 => (object) [
              'inPortalDisabled' => true
            ]
          ]
        ]
      ],
      'boolFilterList' => [
        0 => (object) [
          'name' => 'onlyMy',
          'accessDataList' => [
            0 => (object) [
              'inPortalDisabled' => true
            ]
          ]
        ]
      ],
      'relationshipPanels' => (object) [
        'cases' => (object) [
          'create' => false,
          'rowActionsView' => 'views/record/row-actions/relationship-view-and-unlink'
        ]
      ],
      'additionalLayouts' => (object) [
        'detailPortal' => (object) [
          'type' => 'detail'
        ],
        'detailSmallPortal' => (object) [
          'type' => 'detail'
        ],
        'listPortal' => (object) [
          'type' => 'list'
        ]
      ],
      'iconClass' => 'fas fa-book'
    ],
    'KnowledgeBaseCategory' => (object) [
      'controller' => 'controllers/record-tree',
      'collection' => 'collections/tree',
      'menu' => (object) [
        'listTree' => (object) [
          'buttons' => [
            0 => (object) [
              'label' => 'List View',
              'link' => '#KnowledgeBaseCategory/list',
              'acl' => 'read',
              'style' => 'default'
            ],
            1 => (object) [
              'label' => 'Articles',
              'link' => '#KnowledgeBaseArticle',
              'acl' => 'read',
              'style' => 'default',
              'aclScope' => 'KnowledgeBaseArticle'
            ]
          ]
        ],
        'list' => (object) [
          'buttons' => [
            0 => (object) [
              'label' => 'Tree View',
              'link' => '#KnowledgeBaseCategory',
              'acl' => 'read',
              'style' => 'default'
            ],
            1 => (object) [
              'label' => 'Articles',
              'link' => '#KnowledgeBaseArticle',
              'acl' => 'read',
              'style' => 'default',
              'aclScope' => 'KnowledgeBaseArticle'
            ]
          ]
        ]
      ],
      'relationshipPanels' => (object) [
        'children' => (object) [
          'selectDisabled' => true,
          'unlinkDisabled' => true
        ]
      ]
    ],
    'Lead' => (object) [
      'controller' => 'crm:controllers/lead',
      'views' => (object) [
        'detail' => 'crm:views/lead/detail'
      ],
      'recordViews' => (object) [
        'detail' => 'crm:views/lead/record/detail'
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'convertedTo',
            'label' => 'Converted To',
            'view' => 'crm:views/lead/record/panels/converted-to',
            'notRefreshable' => true,
            'hidden' => true,
            'style' => 'success',
            'isForm' => true
          ],
          1 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          3 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ],
        'edit' => [
          0 => (object) [
            'name' => 'convertedTo',
            'label' => 'Converted To',
            'view' => 'crm:views/lead/record/panels/converted-to',
            'notRefreshable' => true,
            'hidden' => true,
            'style' => 'success',
            'isForm' => true
          ]
        ],
        'detailSmall' => [
          0 => (object) [
            'name' => 'convertedTo',
            'label' => 'Converted To',
            'view' => 'crm:views/lead/record/panels/converted-to',
            'notRefreshable' => true,
            'hidden' => true,
            'style' => 'success',
            'isForm' => true
          ],
          1 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          3 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ],
        'editSmall' => [
          0 => (object) [
            'name' => 'convertedTo',
            'label' => 'Converted To',
            'view' => 'crm:views/lead/record/panels/converted-to',
            'notRefreshable' => true,
            'hidden' => true,
            'style' => 'success',
            'isForm' => true
          ]
        ]
      ],
      'relationshipPanels' => (object) [
        'campaignLogRecords' => (object) [
          'rowActionsView' => 'views/record/row-actions/empty',
          'select' => false,
          'create' => false
        ],
        'targetLists' => (object) [
          'create' => false,
          'rowActionsView' => 'crm:views/record/row-actions/relationship-target',
          'layout' => 'listForTarget',
          'view' => 'crm:views/record/panels/target-lists'
        ]
      ],
      'filterList' => [
        0 => (object) [
          'name' => 'actual'
        ],
        1 => (object) [
          'name' => 'converted',
          'style' => 'success'
        ]
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'name' => (object) [
            'required' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isEmpty',
                  'attribute' => 'accountName'
                ],
                1 => (object) [
                  'type' => 'isEmpty',
                  'attribute' => 'emailAddress'
                ],
                2 => (object) [
                  'type' => 'isEmpty',
                  'attribute' => 'phoneNumber'
                ]
              ]
            ]
          ],
          'convertedAt' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'and',
                  'value' => [
                    0 => (object) [
                      'type' => 'equals',
                      'attribute' => 'status',
                      'value' => 'Converted'
                    ],
                    1 => (object) [
                      'type' => 'isNotEmpty',
                      'attribute' => 'convertedAt'
                    ]
                  ]
                ]
              ]
            ]
          ]
        ],
        'panels' => (object) [
          'convertedTo' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'status',
                  'value' => 'Converted'
                ]
              ]
            ]
          ]
        ]
      ],
      'color' => '#d6a2c9',
      'iconClass' => 'fas fa-address-card'
    ],
    'MassEmail' => (object) [
      'controller' => 'controllers/record',
      'acl' => 'crm:acl/mass-email',
      'recordViews' => (object) [
        'detail' => 'crm:views/mass-email/record/detail',
        'edit' => 'crm:views/mass-email/record/edit',
        'editQuick' => 'crm:views/mass-email/record/edit-small'
      ],
      'views' => (object) [
        'detail' => 'crm:views/mass-email/detail'
      ],
      'defaultSidePanel' => (object) [
        'edit' => false,
        'editSmall' => false
      ],
      'menu' => (object) [
        'list' => (object) [
          'dropdown' => [
            0 => (object) [
              'labelTranslation' => 'Global.scopeNamesPlural.EmailQueueItem',
              'link' => '#EmailQueueItem',
              'accessDataList' => [
                0 => (object) [
                  'isAdminOnly' => true
                ]
              ]
            ]
          ]
        ]
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'status' => (object) [
            'readOnly' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'and',
                  'value' => [
                    0 => (object) [
                      'type' => 'or',
                      'value' => [
                        0 => (object) [
                          'type' => 'equals',
                          'attribute' => 'status',
                          'value' => 'Complete'
                        ],
                        1 => (object) [
                          'type' => 'equals',
                          'attribute' => 'status',
                          'value' => 'In Process'
                        ],
                        2 => (object) [
                          'type' => 'equals',
                          'attribute' => 'status',
                          'value' => 'Failed'
                        ]
                      ]
                    ],
                    1 => (object) [
                      'type' => 'isNotEmpty',
                      'attribute' => 'id'
                    ]
                  ]
                ]
              ]
            ]
          ]
        ],
        'options' => (object) [
          'status' => [
            0 => (object) [
              'optionList' => [
                0 => 'Draft',
                1 => 'Pending'
              ],
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'in',
                  'attribute' => 'status',
                  'value' => [
                    0 => 'Draft',
                    1 => 'Pending'
                  ]
                ]
              ]
            ]
          ]
        ]
      ],
      'filterList' => [
        0 => (object) [
          'name' => 'actual'
        ],
        1 => (object) [
          'name' => 'complete',
          'style' => 'success'
        ]
      ]
    ],
    'Meeting' => (object) [
      'controller' => 'controllers/record',
      'acl' => 'crm:acl/meeting',
      'views' => (object) [
        'detail' => 'crm:views/meeting/detail'
      ],
      'recordViews' => (object) [
        'list' => 'crm:views/meeting/record/list',
        'detail' => 'crm:views/meeting/record/detail',
        'editSmall' => 'crm:views/meeting/record/edit-small'
      ],
      'modalViews' => (object) [
        'detail' => 'crm:views/meeting/modals/detail'
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'options' => (object) [
              'fieldList' => [
                0 => 'users',
                1 => 'contacts',
                2 => 'leads'
              ]
            ],
            'sticked' => true,
            'isForm' => true,
            'notRefreshable' => true
          ]
        ],
        'detailSmall' => [
          0 => (object) [
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
            'isForm' => true,
            'notRefreshable' => true
          ]
        ],
        'edit' => [
          0 => (object) [
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
            'isForm' => true,
            'notRefreshable' => true
          ]
        ],
        'editSmall' => [
          0 => (object) [
            'name' => 'attendees',
            'label' => 'Attendees',
            'view' => 'crm:views/meeting/record/panels/attendees',
            'sticked' => true,
            'isForm' => true,
            'notRefreshable' => true
          ]
        ]
      ],
      'bottomPanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'scheduler',
            'label' => 'Scheduler',
            'view' => 'crm:views/meeting/record/panels/scheduler',
            'order' => 3
          ]
        ],
        'edit' => [
          0 => (object) [
            'name' => 'scheduler',
            'label' => 'Scheduler',
            'view' => 'crm:views/meeting/record/panels/scheduler',
            'order' => 1
          ]
        ],
        'editSmall' => [
          0 => (object) [
            'name' => 'scheduler',
            'label' => 'Scheduler',
            'view' => 'crm:views/meeting/record/panels/scheduler',
            'order' => 1
          ]
        ]
      ],
      'filterList' => [
        0 => (object) [
          'name' => 'planned'
        ],
        1 => (object) [
          'name' => 'held',
          'style' => 'success'
        ],
        2 => (object) [
          'name' => 'todays'
        ]
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'activityDefs' => (object) [
        'link' => 'meetings',
        'activitiesCreate' => true,
        'historyCreate' => true
      ],
      'forcePatchAttributeDependencyMap' => (object) [
        'dateEnd' => [
          0 => 'dateStart'
        ],
        'dateEndDate' => [
          0 => 'dateStartDate'
        ]
      ],
      'relationshipPanels' => (object) [
        'contacts' => (object) [
          'selectHandler' => 'handlers/select-related/same-account-many'
        ]
      ],
      'additionalLayouts' => (object) [
        'bottomPanelsEditSmall' => (object) [
          'type' => 'bottomPanelsEditSmall'
        ]
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'reminders' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'and',
                  'value' => [
                    0 => (object) [
                      'type' => 'notEquals',
                      'attribute' => 'status',
                      'value' => 'Held'
                    ],
                    1 => (object) [
                      'type' => 'notEquals',
                      'attribute' => 'status',
                      'value' => 'Not Held'
                    ]
                  ]
                ]
              ]
            ]
          ],
          'duration' => (object) [
            'readOnly' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isTrue',
                  'attribute' => 'isAllDay'
                ]
              ]
            ]
          ]
        ]
      ],
      'iconClass' => 'fas fa-calendar-check'
    ],
    'Opportunity' => (object) [
      'controller' => 'controllers/record',
      'views' => (object) [
        'detail' => 'crm:views/opportunity/detail'
      ],
      'recordViews' => (object) [
        'edit' => 'crm:views/opportunity/record/edit',
        'editSmall' => 'crm:views/opportunity/record/edit-small',
        'list' => 'crm:views/opportunity/record/list',
        'kanban' => 'crm:views/opportunity/record/kanban'
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/opportunity/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ],
        'detailSmall' => [
          0 => (object) [
            'name' => 'activities',
            'label' => 'Activities',
            'view' => 'crm:views/record/panels/activities',
            'aclScope' => 'Activities'
          ],
          1 => (object) [
            'name' => 'history',
            'label' => 'History',
            'view' => 'crm:views/record/panels/history',
            'aclScope' => 'Activities'
          ],
          2 => (object) [
            'name' => 'tasks',
            'label' => 'Tasks',
            'view' => 'crm:views/record/panels/tasks',
            'aclScope' => 'Task'
          ]
        ]
      ],
      'filterList' => [
        0 => (object) [
          'name' => 'open'
        ],
        1 => (object) [
          'name' => 'won',
          'style' => 'success'
        ]
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'additionalLayouts' => (object) [
        'detailConvert' => (object) [
          'type' => 'detail'
        ],
        'listForAccount' => (object) [
          'type' => 'listSmall'
        ],
        'listForContact' => (object) [
          'type' => 'listSmall'
        ]
      ],
      'kanbanViewMode' => true,
      'relationshipPanels' => (object) [
        'contacts' => (object) [
          'createAttributeMap' => (object) [
            'accountId' => 'accountId',
            'accountName' => 'accountName'
          ],
          'createHandler' => 'crm:handlers/opportunity/contacts-create',
          'selectHandler' => 'handlers/select-related/same-account-many'
        ],
        'contact' => (object) [
          'createAttributeMap' => (object) [
            'accountId' => 'accountId',
            'accountName' => 'accountName'
          ],
          'selectHandler' => 'handlers/select-related/same-account-many'
        ],
        'documents' => (object) [
          'selectHandler' => 'handlers/select-related/same-account-many'
        ]
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'lastStage' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'stage',
                  'value' => 'Closed Lost'
                ]
              ]
            ]
          ]
        ]
      ],
      'color' => '#9fc77e',
      'iconClass' => 'fas fa-dollar-sign'
    ],
    'TargetList' => (object) [
      'controller' => 'controllers/record',
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'sidePanels' => (object) [
        'detail' => [
          0 => (object) [
            'name' => 'optedOut',
            'label' => 'Opted Out',
            'view' => 'crm:views/target-list/record/panels/opted-out'
          ]
        ]
      ],
      'recordViews' => (object) [
        'detail' => 'crm:views/target-list/record/detail'
      ],
      'relationshipPanels' => (object) [
        'contacts' => (object) [
          'actionList' => [
            0 => (object) [
              'label' => 'Unlink All',
              'action' => 'unlinkAllRelated',
              'acl' => 'edit',
              'data' => (object) [
                'link' => 'contacts'
              ]
            ]
          ],
          'rowActionsView' => 'crm:views/target-list/record/row-actions/default',
          'view' => 'crm:views/target-list/record/panels/relationship',
          'massSelect' => true
        ],
        'leads' => (object) [
          'actionList' => [
            0 => (object) [
              'label' => 'Unlink All',
              'action' => 'unlinkAllRelated',
              'acl' => 'edit',
              'data' => (object) [
                'link' => 'leads'
              ]
            ]
          ],
          'rowActionsView' => 'crm:views/target-list/record/row-actions/default',
          'view' => 'crm:views/target-list/record/panels/relationship',
          'massSelect' => true
        ],
        'accounts' => (object) [
          'actionList' => [
            0 => (object) [
              'label' => 'Unlink All',
              'action' => 'unlinkAllRelated',
              'acl' => 'edit',
              'data' => (object) [
                'link' => 'accounts'
              ]
            ]
          ],
          'rowActionsView' => 'crm:views/target-list/record/row-actions/default',
          'view' => 'crm:views/target-list/record/panels/relationship',
          'massSelect' => true
        ],
        'users' => (object) [
          'create' => false,
          'actionList' => [
            0 => (object) [
              'label' => 'Unlink All',
              'action' => 'unlinkAllRelated',
              'acl' => 'edit',
              'data' => (object) [
                'link' => 'users'
              ]
            ]
          ],
          'rowActionsView' => 'crm:views/target-list/record/row-actions/default',
          'view' => 'crm:views/target-list/record/panels/relationship',
          'massSelect' => true
        ]
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'entryCount' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'id'
                ]
              ]
            ]
          ],
          'optedOutCount' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'isNotEmpty',
                  'attribute' => 'id'
                ]
              ]
            ]
          ]
        ]
      ],
      'iconClass' => 'fas fa-crosshairs'
    ],
    'Task' => (object) [
      'controller' => 'controllers/record',
      'recordViews' => (object) [
        'list' => 'crm:views/task/record/list',
        'detail' => 'crm:views/task/record/detail'
      ],
      'views' => (object) [
        'list' => 'crm:views/task/list',
        'detail' => 'crm:views/task/detail'
      ],
      'modalViews' => (object) [
        'detail' => 'crm:views/task/modals/detail'
      ],
      'menu' => (object) [
        'detail' => (object) [
          'buttons' => [
            0 => (object) [
              'label' => 'Complete',
              'name' => 'setCompletedMain',
              'action' => 'setCompletedMain',
              'iconHtml' => '<span class="fas fa-check fa-sm"></span>',
              'acl' => 'edit'
            ]
          ]
        ]
      ],
      'dynamicLogic' => (object) [
        'fields' => (object) [
          'dateCompleted' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'equals',
                  'attribute' => 'status',
                  'value' => 'Completed'
                ]
              ]
            ]
          ],
          'reminders' => (object) [
            'visible' => (object) [
              'conditionGroup' => [
                0 => (object) [
                  'type' => 'and',
                  'value' => [
                    0 => (object) [
                      'type' => 'or',
                      'value' => [
                        0 => (object) [
                          'type' => 'isNotEmpty',
                          'attribute' => 'dateEnd'
                        ],
                        1 => (object) [
                          'type' => 'isNotEmpty',
                          'attribute' => 'dateEndDate'
                        ]
                      ]
                    ],
                    1 => (object) [
                      'type' => 'notEquals',
                      'attribute' => 'status',
                      'value' => 'Completed'
                    ],
                    2 => (object) [
                      'type' => 'notEquals',
                      'attribute' => 'status',
                      'value' => 'Canceled'
                    ]
                  ]
                ]
              ]
            ]
          ]
        ]
      ],
      'filterList' => [
        0 => 'actual',
        1 => (object) [
          'name' => 'completed',
          'style' => 'success'
        ],
        2 => (object) [
          'name' => 'todays'
        ],
        3 => (object) [
          'name' => 'overdue',
          'style' => 'danger'
        ],
        4 => (object) [
          'name' => 'deferred'
        ]
      ],
      'boolFilterList' => [
        0 => 'onlyMy'
      ],
      'iconClass' => 'fas fa-tasks',
      'kanbanViewMode' => true
    ]
  ],
  'dashlets' => (object) [
    'Emails' => (object) [
      'view' => 'views/dashlets/emails',
      'aclScope' => 'Email',
      'entityType' => 'Email',
      'options' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'displayRecords' => (object) [
            'type' => 'enumInt',
            'options' => [
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 7,
              4 => 10,
              5 => 15,
              6 => 20,
              7 => 30
            ]
          ],
          'folder' => (object) [
            'type' => 'enum',
            'view' => 'views/dashlets/fields/emails/folder'
          ]
        ],
        'defaults' => (object) [
          'orderBy' => 'dateSent',
          'order' => 'desc',
          'displayRecords' => 5,
          'folder' => NULL,
          'expandedLayout' => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'subject',
                  'link' => true
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'dateSent',
                  'view' => 'views/fields/datetime-short'
                ],
                1 => (object) [
                  'name' => 'personStringData',
                  'view' => 'views/email/fields/person-string-data-for-expanded'
                ]
              ]
            ]
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'displayRecords'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ],
              2 => [
                0 => (object) [
                  'name' => 'folder'
                ],
                1 => false
              ]
            ]
          ]
        ]
      ],
      'accessDataList' => [
        0 => (object) [
          'inPortalDisabled' => true
        ]
      ]
    ],
    'Iframe' => (object) [
      'options' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar'
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'url' => (object) [
            'type' => 'url',
            'required' => true
          ]
        ],
        'defaults' => (object) [
          'autorefreshInterval' => 0
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'url'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ]
            ]
          ]
        ]
      ]
    ],
    'Memo' => (object) [
      'view' => 'views/dashlets/memo',
      'options' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar'
          ],
          'text' => (object) [
            'type' => 'text'
          ]
        ],
        'defaults' => (object) [],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'text'
                ]
              ]
            ]
          ]
        ]
      ]
    ],
    'Records' => (object) [
      'options' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'displayRecords' => (object) [
            'type' => 'enumInt',
            'options' => [
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 7,
              4 => 10,
              5 => 15,
              6 => 20,
              7 => 30,
              8 => 50
            ]
          ],
          'entityType' => (object) [
            'type' => 'enum',
            'view' => 'views/dashlets/fields/records/entity-type',
            'translation' => 'Global.scopeNames'
          ],
          'primaryFilter' => (object) [
            'type' => 'enum',
            'view' => 'views/dashlets/fields/records/primary-filter'
          ],
          'boolFilterList' => (object) [
            'type' => 'multiEnum',
            'view' => 'views/dashlets/fields/records/bool-filter-list'
          ],
          'sortBy' => (object) [
            'type' => 'enum',
            'view' => 'views/dashlets/fields/records/sort-by'
          ],
          'sortDirection' => (object) [
            'type' => 'enum',
            'view' => 'views/dashlets/fields/records/sort-direction',
            'options' => [
              0 => 'asc',
              1 => 'desc'
            ],
            'translation' => 'EntityManager.options.sortDirection'
          ],
          'expandedLayout' => (object) [
            'type' => 'base',
            'view' => 'views/dashlets/fields/records/expanded-layout'
          ]
        ],
        'defaults' => (object) [
          'displayRecords' => 10,
          'autorefreshInterval' => 0.5,
          'expandedLayout' => (object) [
            'rows' => []
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'entityType'
                ],
                1 => false
              ],
              2 => [
                0 => (object) [
                  'name' => 'primaryFilter'
                ],
                1 => (object) [
                  'name' => 'sortBy'
                ]
              ],
              3 => [
                0 => (object) [
                  'name' => 'boolFilterList'
                ],
                1 => (object) [
                  'name' => 'sortDirection'
                ]
              ],
              4 => [
                0 => (object) [
                  'name' => 'displayRecords'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ],
              5 => [
                0 => (object) [
                  'name' => 'expandedLayout'
                ],
                1 => false
              ]
            ]
          ]
        ]
      ]
    ],
    'Stream' => (object) [
      'options' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'displayRecords' => (object) [
            'type' => 'enumInt',
            'options' => [
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 7,
              4 => 10,
              5 => 15,
              6 => 20
            ]
          ],
          'skipOwn' => (object) [
            'type' => 'bool',
            'tooltip' => true
          ]
        ],
        'defaults' => (object) [
          'displayRecords' => 10,
          'autorefreshInterval' => 0.5,
          'skipOwn' => false
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'displayRecords'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ],
              2 => [
                0 => (object) [
                  'name' => 'skipOwn'
                ],
                1 => false
              ]
            ]
          ]
        ]
      ]
    ],
    'Activities' => (object) [
      'view' => 'crm:views/dashlets/activities',
      'options' => (object) [
        'view' => 'crm:views/dashlets/options/activities',
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'enabledScopeList' => (object) [
            'type' => 'multiEnum',
            'translation' => 'Global.scopeNamesPlural',
            'required' => true
          ],
          'displayRecords' => (object) [
            'type' => 'enumInt',
            'options' => [
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 7,
              4 => 10,
              5 => 15,
              6 => 20,
              7 => 30,
              8 => 50
            ]
          ],
          'futureDays' => (object) [
            'type' => 'int',
            'min' => 0,
            'required' => true
          ]
        ],
        'defaults' => (object) [
          'displayRecords' => 10,
          'autorefreshInterval' => 0.5,
          'futureDays' => 3,
          'enabledScopeList' => [
            0 => 'Meeting',
            1 => 'Call',
            2 => 'Task'
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'displayRecords'
                ],
                1 => (object) [
                  'name' => 'enabledScopeList'
                ]
              ],
              2 => [
                0 => (object) [
                  'name' => 'futureDays'
                ],
                1 => false
              ]
            ]
          ]
        ]
      ]
    ],
    'Calendar' => (object) [
      'view' => 'crm:views/dashlets/calendar',
      'aclScope' => 'Calendar',
      'options' => (object) [
        'view' => 'crm:views/dashlets/options/calendar',
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'enabledScopeList' => (object) [
            'type' => 'multiEnum',
            'translation' => 'Global.scopeNamesPlural',
            'required' => true
          ],
          'mode' => (object) [
            'type' => 'enum',
            'options' => [
              0 => 'basicWeek',
              1 => 'agendaWeek',
              2 => 'timeline',
              3 => 'month',
              4 => 'basicDay',
              5 => 'agendaDay'
            ]
          ],
          'users' => (object) [
            'type' => 'linkMultiple',
            'entity' => 'User',
            'view' => 'crm:views/calendar/fields/users',
            'sortable' => true
          ],
          'teams' => (object) [
            'type' => 'linkMultiple',
            'entity' => 'Team',
            'view' => 'crm:views/calendar/fields/teams'
          ]
        ],
        'defaults' => (object) [
          'autorefreshInterval' => 0.5,
          'mode' => 'basicWeek',
          'enabledScopeList' => [
            0 => 'Meeting',
            1 => 'Call',
            2 => 'Task'
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'mode'
                ],
                1 => (object) [
                  'name' => 'enabledScopeList'
                ]
              ],
              2 => [
                0 => (object) [
                  'name' => 'users'
                ],
                1 => false
              ],
              3 => [
                0 => (object) [
                  'name' => 'teams'
                ],
                1 => false
              ]
            ]
          ]
        ]
      ],
      'accessDataList' => [
        0 => (object) [
          'inPortalDisabled' => true
        ]
      ]
    ],
    'Calls' => (object) [
      'view' => 'crm:views/dashlets/calls',
      'aclScope' => 'Call',
      'entityType' => 'Call',
      'options' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'displayRecords' => (object) [
            'type' => 'enumInt',
            'options' => [
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 7,
              4 => 10,
              5 => 15,
              6 => 20,
              7 => 30
            ]
          ],
          'expandedLayout' => (object) [
            'type' => 'base',
            'view' => 'views/dashlets/fields/records/expanded-layout'
          ]
        ],
        'defaults' => (object) [
          'orderBy' => 'dateStart',
          'order' => 'asc',
          'displayRecords' => 5,
          'populateAssignedUser' => true,
          'expandedLayout' => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'name',
                  'link' => true
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'dateStart'
                ]
              ]
            ]
          ],
          'searchData' => (object) [
            'bool' => (object) [
              'onlyMy' => true
            ],
            'primary' => 'planned',
            'advanced' => (object) [
              1 => (object) [
                'type' => 'or',
                'value' => (object) [
                  1 => (object) [
                    'type' => 'today',
                    'field' => 'dateStart',
                    'dateTime' => true
                  ],
                  2 => (object) [
                    'type' => 'future',
                    'field' => 'dateEnd',
                    'dateTime' => true
                  ],
                  3 => (object) [
                    'type' => 'lastXDays',
                    'field' => 'dateStart',
                    'value' => 5,
                    'dateTime' => true
                  ]
                ]
              ]
            ]
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'displayRecords'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ],
              2 => [
                0 => (object) [
                  'name' => 'expandedLayout'
                ],
                1 => false
              ]
            ]
          ]
        ]
      ],
      'accessDataList' => [
        0 => (object) [
          'inPortalDisabled' => true
        ]
      ]
    ],
    'Cases' => (object) [
      'view' => 'views/dashlets/abstract/record-list',
      'aclScope' => 'Case',
      'entityType' => 'Case',
      'options' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'displayRecords' => (object) [
            'type' => 'enumInt',
            'options' => [
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 7,
              4 => 10,
              5 => 15
            ]
          ],
          'expandedLayout' => (object) [
            'type' => 'base',
            'view' => 'views/dashlets/fields/records/expanded-layout'
          ]
        ],
        'defaults' => (object) [
          'orderBy' => 'number',
          'order' => 'desc',
          'displayRecords' => 5,
          'populateAssignedUser' => true,
          'expandedLayout' => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'number'
                ],
                1 => (object) [
                  'name' => 'name',
                  'link' => true
                ],
                2 => (object) [
                  'name' => 'type'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'status'
                ],
                1 => (object) [
                  'name' => 'priority'
                ]
              ]
            ]
          ],
          'searchData' => (object) [
            'bool' => (object) [
              'onlyMy' => true
            ],
            'primary' => 'open'
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'displayRecords'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ],
              2 => [
                0 => (object) [
                  'name' => 'expandedLayout'
                ],
                1 => false
              ]
            ]
          ]
        ]
      ]
    ],
    'Leads' => (object) [
      'view' => 'views/dashlets/abstract/record-list',
      'aclScope' => 'Lead',
      'entityType' => 'Lead',
      'options' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'displayRecords' => (object) [
            'type' => 'enumInt',
            'options' => [
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 7,
              4 => 10,
              5 => 15,
              6 => 20,
              7 => 30
            ]
          ],
          'expandedLayout' => (object) [
            'type' => 'base',
            'view' => 'views/dashlets/fields/records/expanded-layout'
          ]
        ],
        'defaults' => (object) [
          'orderBy' => 'createdAt',
          'order' => 'desc',
          'displayRecords' => 5,
          'populateAssignedUser' => true,
          'expandedLayout' => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'name',
                  'link' => true
                ],
                1 => (object) [
                  'name' => 'addressCity'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'status'
                ],
                1 => (object) [
                  'name' => 'source'
                ]
              ]
            ]
          ],
          'searchData' => (object) [
            'bool' => (object) [
              'onlyMy' => true
            ],
            'primary' => 'actual'
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'displayRecords'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ],
              2 => [
                0 => (object) [
                  'name' => 'expandedLayout'
                ],
                1 => false
              ]
            ]
          ]
        ]
      ]
    ],
    'Meetings' => (object) [
      'view' => 'crm:views/dashlets/meetings',
      'aclScope' => 'Meeting',
      'entityType' => 'Meeting',
      'options' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'displayRecords' => (object) [
            'type' => 'enumInt',
            'options' => [
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 7,
              4 => 10,
              5 => 15,
              6 => 20,
              7 => 30
            ]
          ],
          'expandedLayout' => (object) [
            'type' => 'base',
            'view' => 'views/dashlets/fields/records/expanded-layout'
          ]
        ],
        'defaults' => (object) [
          'orderBy' => 'dateStart',
          'order' => 'asc',
          'displayRecords' => 5,
          'populateAssignedUser' => true,
          'expandedLayout' => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'name',
                  'link' => true
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'dateStart'
                ]
              ]
            ]
          ],
          'searchData' => (object) [
            'bool' => (object) [
              'onlyMy' => true
            ],
            'primary' => 'planned',
            'advanced' => (object) [
              1 => (object) [
                'type' => 'or',
                'value' => (object) [
                  1 => (object) [
                    'type' => 'today',
                    'field' => 'dateStart',
                    'dateTime' => true
                  ],
                  2 => (object) [
                    'type' => 'future',
                    'field' => 'dateEnd',
                    'dateTime' => true
                  ]
                ]
              ]
            ]
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'displayRecords'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ],
              2 => [
                0 => (object) [
                  'name' => 'expandedLayout'
                ],
                1 => false
              ]
            ]
          ]
        ]
      ],
      'accessDataList' => [
        0 => (object) [
          'inPortalDisabled' => true
        ]
      ]
    ],
    'Opportunities' => (object) [
      'view' => 'views/dashlets/abstract/record-list',
      'aclScope' => 'Opportunity',
      'entityType' => 'Opportunity',
      'options' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'displayRecords' => (object) [
            'type' => 'enumInt',
            'options' => [
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 7,
              4 => 10,
              5 => 15,
              6 => 20,
              7 => 30
            ]
          ],
          'expandedLayout' => (object) [
            'type' => 'base',
            'view' => 'views/dashlets/fields/records/expanded-layout'
          ]
        ],
        'defaults' => (object) [
          'orderBy' => 'closeDate',
          'order' => 'asc',
          'displayRecords' => 5,
          'populateAssignedUser' => true,
          'expandedLayout' => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'name',
                  'link' => true
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'stage'
                ],
                1 => (object) [
                  'name' => 'amount'
                ]
              ]
            ]
          ],
          'searchData' => (object) [
            'bool' => (object) [
              'onlyMy' => true
            ],
            'primary' => 'open'
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'displayRecords'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ],
              2 => [
                0 => (object) [
                  'name' => 'expandedLayout'
                ],
                1 => false
              ]
            ]
          ]
        ]
      ]
    ],
    'OpportunitiesByLeadSource' => (object) [
      'view' => 'crm:views/dashlets/opportunities-by-lead-source',
      'aclScope' => 'Opportunity',
      'options' => (object) [
        'view' => 'crm:views/dashlets/options/chart',
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'dateFrom' => (object) [
            'type' => 'date',
            'required' => true
          ],
          'dateTo' => (object) [
            'type' => 'date',
            'required' => true
          ],
          'dateFilter' => (object) [
            'type' => 'enum',
            'options' => [
              0 => 'currentYear',
              1 => 'currentQuarter',
              2 => 'currentMonth',
              3 => 'currentFiscalYear',
              4 => 'currentFiscalQuarter',
              5 => 'ever',
              6 => 'between'
            ],
            'default' => 'currentYear',
            'translation' => 'Global.options.dateSearchRanges'
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'dateFilter'
                ],
                1 => false
              ],
              2 => [
                0 => (object) [
                  'name' => 'dateFrom'
                ],
                1 => (object) [
                  'name' => 'dateTo'
                ]
              ]
            ]
          ]
        ],
        'defaults' => (object) [
          'dateFilter' => 'currentYear'
        ]
      ]
    ],
    'OpportunitiesByStage' => (object) [
      'view' => 'crm:views/dashlets/opportunities-by-stage',
      'aclScope' => 'Opportunity',
      'options' => (object) [
        'view' => 'crm:views/dashlets/options/chart',
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'dateFrom' => (object) [
            'type' => 'date',
            'required' => true
          ],
          'dateTo' => (object) [
            'type' => 'date',
            'required' => true
          ],
          'dateFilter' => (object) [
            'type' => 'enum',
            'options' => [
              0 => 'currentYear',
              1 => 'currentQuarter',
              2 => 'currentMonth',
              3 => 'currentFiscalYear',
              4 => 'currentFiscalQuarter',
              5 => 'ever',
              6 => 'between'
            ],
            'default' => 'currentYear',
            'translation' => 'Global.options.dateSearchRanges'
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'dateFilter'
                ],
                1 => false
              ],
              2 => [
                0 => (object) [
                  'name' => 'dateFrom'
                ],
                1 => (object) [
                  'name' => 'dateTo'
                ]
              ]
            ]
          ]
        ],
        'defaults' => (object) [
          'dateFilter' => 'currentYear'
        ]
      ]
    ],
    'SalesByMonth' => (object) [
      'view' => 'crm:views/dashlets/sales-by-month',
      'aclScope' => 'Opportunity',
      'options' => (object) [
        'view' => 'crm:views/dashlets/options/chart',
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'dateFrom' => (object) [
            'type' => 'date',
            'required' => true
          ],
          'dateTo' => (object) [
            'type' => 'date',
            'required' => true
          ],
          'dateFilter' => (object) [
            'type' => 'enum',
            'options' => [
              0 => 'currentYear',
              1 => 'currentQuarter',
              2 => 'currentFiscalYear',
              3 => 'currentFiscalQuarter',
              4 => 'between'
            ],
            'default' => 'currentYear',
            'translation' => 'Global.options.dateSearchRanges'
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'dateFilter'
                ],
                1 => false
              ],
              2 => [
                0 => (object) [
                  'name' => 'dateFrom'
                ],
                1 => (object) [
                  'name' => 'dateTo'
                ]
              ]
            ]
          ]
        ],
        'defaults' => (object) [
          'dateFilter' => 'currentYear'
        ]
      ]
    ],
    'SalesPipeline' => (object) [
      'view' => 'crm:views/dashlets/sales-pipeline',
      'aclScope' => 'Opportunity',
      'options' => (object) [
        'view' => 'crm:views/dashlets/options/sales-pipeline',
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'dateFrom' => (object) [
            'type' => 'date',
            'required' => true
          ],
          'dateTo' => (object) [
            'type' => 'date',
            'required' => true
          ],
          'dateFilter' => (object) [
            'type' => 'enum',
            'options' => [
              0 => 'currentYear',
              1 => 'currentQuarter',
              2 => 'currentMonth',
              3 => 'currentFiscalYear',
              4 => 'currentFiscalQuarter',
              5 => 'ever',
              6 => 'between'
            ],
            'default' => 'currentYear',
            'translation' => 'Global.options.dateSearchRanges'
          ],
          'useLastStage' => (object) [
            'type' => 'bool'
          ],
          'team' => (object) [
            'type' => 'link',
            'entity' => 'Team',
            'view' => 'crm:views/dashlets/options/sales-pipeline/fields/team'
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title',
                  'span' => 2
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'dateFilter'
                ],
                1 => (object) [
                  'name' => 'useLastStage'
                ]
              ],
              2 => [
                0 => (object) [
                  'name' => 'dateFrom'
                ],
                1 => (object) [
                  'name' => 'dateTo'
                ]
              ],
              3 => [
                0 => (object) [
                  'name' => 'team'
                ],
                1 => false
              ]
            ]
          ]
        ],
        'defaults' => (object) [
          'dateFilter' => 'currentYear',
          'teamId' => NULL,
          'teamName' => NULL
        ]
      ]
    ],
    'Tasks' => (object) [
      'view' => 'crm:views/dashlets/tasks',
      'aclScope' => 'Task',
      'entityType' => 'Task',
      'options' => (object) [
        'fields' => (object) [
          'title' => (object) [
            'type' => 'varchar',
            'required' => true
          ],
          'autorefreshInterval' => (object) [
            'type' => 'enumFloat',
            'options' => [
              0 => 0,
              1 => 0.5,
              2 => 1,
              3 => 2,
              4 => 5,
              5 => 10
            ]
          ],
          'displayRecords' => (object) [
            'type' => 'enumInt',
            'options' => [
              0 => 3,
              1 => 4,
              2 => 5,
              3 => 7,
              4 => 10,
              5 => 15,
              6 => 20,
              7 => 30
            ]
          ],
          'expandedLayout' => (object) [
            'type' => 'base',
            'view' => 'views/dashlets/fields/records/expanded-layout'
          ]
        ],
        'defaults' => (object) [
          'orderBy' => 'dateEnd',
          'order' => 'asc',
          'displayRecords' => 5,
          'expandedLayout' => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'name',
                  'link' => true
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'status'
                ],
                1 => (object) [
                  'name' => 'dateEnd'
                ]
              ]
            ]
          ],
          'searchData' => (object) [
            'bool' => (object) [
              'onlyMy' => true
            ],
            'primary' => 'actualStartingNotInFuture'
          ]
        ],
        'layout' => [
          0 => (object) [
            'rows' => [
              0 => [
                0 => (object) [
                  'name' => 'title'
                ]
              ],
              1 => [
                0 => (object) [
                  'name' => 'displayRecords'
                ],
                1 => (object) [
                  'name' => 'autorefreshInterval'
                ]
              ],
              2 => [
                0 => (object) [
                  'name' => 'expandedLayout',
                  'fullWidth' => true
                ]
              ]
            ]
          ]
        ]
      ],
      'accessDataList' => [
        0 => (object) [
          'inPortalDisabled' => true
        ]
      ]
    ]
  ],
  'entityAcl' => (object) [
    'Attachment' => (object) [
      'fields' => (object) [
        'storage' => (object) [
          'readOnly' => true
        ],
        'source' => (object) [
          'readOnly' => true
        ],
        'sourceId' => (object) [
          'readOnly' => true
        ]
      ]
    ],
    'AuthLogRecord' => (object) [
      'fields' => (object) [
        'username' => (object) [
          'readOnly' => true
        ],
        'portal' => (object) [
          'readOnly' => true
        ],
        'user' => (object) [
          'readOnly' => true
        ],
        'ipAddress' => (object) [
          'readOnly' => true
        ],
        'authToken' => (object) [
          'readOnly' => true
        ],
        'isDenied' => (object) [
          'readOnly' => true
        ],
        'denialReason' => (object) [
          'readOnly' => true
        ],
        'microtime' => (object) [
          'readOnly' => true
        ],
        'requestUrl' => (object) [
          'readOnly' => true
        ],
        'requestMethod' => (object) [
          'readOnly' => true
        ]
      ]
    ],
    'AuthToken' => (object) [
      'fields' => (object) [
        'hash' => (object) [
          'forbidden' => true,
          'readOnly' => true
        ],
        'token' => (object) [
          'forbidden' => true,
          'readOnly' => true
        ],
        'secret' => (object) [
          'forbidden' => true,
          'readOnly' => true
        ],
        'portal' => (object) [
          'readOnly' => true
        ],
        'user' => (object) [
          'readOnly' => true
        ],
        'ipAddress' => (object) [
          'readOnly' => true
        ],
        'lastAccess' => (object) [
          'readOnly' => true
        ],
        'createdAt' => (object) [
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'readOnly' => true
        ]
      ]
    ],
    'Email' => (object) [
      'fields' => (object) [
        'users' => (object) [
          'readOnly' => true
        ],
        'messageId' => (object) [
          'readOnly' => true
        ],
        'tasks' => (object) [
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'users' => (object) [
          'onlyAdmin' => true
        ],
        'tasks' => (object) [
          'readOnly' => true
        ]
      ]
    ],
    'EmailAccount' => (object) [
      'fields' => (object) [
        'password' => (object) [
          'internal' => true
        ],
        'smtpPassword' => (object) [
          'internal' => true
        ],
        'imapHandler' => (object) [
          'forbidden' => true
        ],
        'smtpHandler' => (object) [
          'forbidden' => true
        ],
        'fetchData' => (object) [
          'readOnly' => true
        ]
      ]
    ],
    'InboundEmail' => (object) [
      'fields' => (object) [
        'password' => (object) [
          'internal' => true
        ],
        'smtpPassword' => (object) [
          'internal' => true
        ],
        'imapHandler' => (object) [
          'internal' => true
        ],
        'smtpHandler' => (object) [
          'internal' => true
        ],
        'fetchData' => (object) [
          'readOnly' => true
        ]
      ]
    ],
    'Preferences' => (object) [
      'fields' => (object) [
        'data' => (object) [
          'forbidden' => true
        ]
      ]
    ],
    'User' => (object) [
      'fields' => (object) [
        'userName' => (object) [
          'nonAdminReadOnly' => true
        ],
        'apiKey' => (object) [
          'onlyAdmin' => true,
          'readOnly' => true,
          'nonAdminReadOnly' => true
        ],
        'password' => (object) [
          'internal' => true,
          'nonAdminReadOnly' => true
        ],
        'passwordConfirm' => (object) [
          'internal' => true,
          'nonAdminReadOnly' => true
        ],
        'authLogRecordId' => (object) [
          'forbidden' => true
        ],
        'authMethod' => (object) [
          'onlyAdmin' => true
        ],
        'secretKey' => (object) [
          'readOnly' => true,
          'onlyAdmin' => true
        ],
        'isActive' => (object) [
          'nonAdminReadOnly' => true
        ],
        'emailAddress' => (object) [
          'nonAdminReadOnly' => true
        ],
        'teams' => (object) [
          'nonAdminReadOnly' => true
        ],
        'roles' => (object) [
          'nonAdminReadOnly' => true
        ],
        'portals' => (object) [
          'nonAdminReadOnly' => true
        ],
        'portalRoles' => (object) [
          'nonAdminReadOnly' => true
        ],
        'contact' => (object) [
          'nonAdminReadOnly' => true
        ],
        'workingTimeCalendar' => (object) [
          'nonAdminReadOnly' => true
        ],
        'layoutSet' => (object) [
          'onlyAdmin' => true
        ],
        'accounts' => (object) [
          'nonAdminReadOnly' => true
        ],
        'type' => (object) [
          'nonAdminReadOnly' => true
        ],
        'auth2FA' => (object) [
          'onlyAdmin' => true
        ],
        'userData' => (object) [
          'forbidden' => true
        ],
        'deleteId' => (object) [
          'forbidden' => true
        ]
      ],
      'links' => (object) [
        'teams' => (object) [
          'nonAdminReadOnly' => true
        ],
        'roles' => (object) [
          'onlyAdmin' => true
        ],
        'workingTimeRanges' => (object) [
          'nonAdminReadOnly' => true
        ],
        'portalRoles' => (object) [
          'onlyAdmin' => true
        ],
        'accounts' => (object) [
          'onlyAdmin' => true
        ],
        'defaultTeam' => (object) [
          'onlyAdmin' => true
        ],
        'dashboardTemplate' => (object) [
          'onlyAdmin' => true
        ],
        'preferences' => (object) [
          'onlyAdmin' => true
        ],
        'userData' => (object) [
          'forbidden' => true
        ]
      ]
    ],
    'Case' => (object) [
      'fields' => (object) [
        'inboundEmail' => (object) [
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'inboundEmail' => (object) [
          'readOnly' => true
        ]
      ]
    ],
    'Task' => (object) [
      'fields' => (object) [
        'email' => (object) [
          'readOnly' => true
        ]
      ]
    ]
  ],
  'entityDefs' => (object) [
    'ActionHistoryRecord' => (object) [
      'fields' => (object) [
        'number' => (object) [
          'type' => 'autoincrement',
          'index' => true
        ],
        'targetType' => (object) [
          'type' => 'varchar',
          'view' => 'views/action-history-record/fields/target-type',
          'translation' => 'Global.scopeNames'
        ],
        'target' => (object) [
          'type' => 'linkParent',
          'view' => 'views/action-history-record/fields/target'
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'action' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'read',
            1 => 'update',
            2 => 'create',
            3 => 'delete'
          ]
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'hasSeconds' => true
        ],
        'user' => (object) [
          'type' => 'link',
          'view' => 'views/fields/user'
        ],
        'userType' => (object) [
          'type' => 'foreign',
          'link' => 'user',
          'field' => 'type',
          'view' => 'views/fields/foreign-enum',
          'notStorable' => true
        ],
        'ipAddress' => (object) [
          'type' => 'varchar',
          'maxLength' => 39
        ],
        'authToken' => (object) [
          'type' => 'link'
        ],
        'authLogRecord' => (object) [
          'type' => 'link'
        ]
      ],
      'links' => (object) [
        'user' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'target' => (object) [
          'type' => 'belongsToParent'
        ],
        'authToken' => (object) [
          'type' => 'belongsTo',
          'entity' => 'AuthToken',
          'foreignName' => 'id',
          'foreign' => 'actionHistoryRecords'
        ],
        'authLogRecord' => (object) [
          'type' => 'belongsTo',
          'entity' => 'AuthLogRecord',
          'foreignName' => 'id',
          'foreign' => 'actionHistoryRecords'
        ]
      ],
      'collection' => (object) [
        'sortBy' => 'number',
        'asc' => false,
        'textFilterFields' => [
          0 => 'ipAddress',
          1 => 'userName'
        ],
        'orderBy' => 'number',
        'order' => 'desc'
      ]
    ],
    'ArrayValue' => (object) [
      'fields' => (object) [
        'value' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 100
        ],
        'entity' => (object) [
          'type' => 'linkParent'
        ],
        'attribute' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ]
      ],
      'indexes' => (object) [
        'entityTypeValue' => (object) [
          'columns' => [
            0 => 'entityType',
            1 => 'value'
          ]
        ],
        'entityValue' => (object) [
          'columns' => [
            0 => 'entityType',
            1 => 'entityId',
            2 => 'value'
          ]
        ]
      ]
    ],
    'Attachment' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'view' => 'views/attachment/fields/name',
          'maxLength' => 255
        ],
        'type' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'size' => (object) [
          'type' => 'int',
          'dbType' => 'bigint',
          'min' => 0
        ],
        'parent' => (object) [
          'type' => 'linkParent',
          'view' => 'views/attachment/fields/parent'
        ],
        'related' => (object) [
          'type' => 'linkParent',
          'noLoad' => true,
          'view' => 'views/attachment/fields/parent',
          'validatorClassName' => 'Espo\\Classes\\FieldValidators\\Attachment\\Related'
        ],
        'source' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'utility' => true
        ],
        'field' => (object) [
          'type' => 'varchar',
          'utility' => true
        ],
        'isBeingUploaded' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'contents' => (object) [
          'type' => 'text',
          'notStorable' => true
        ],
        'role' => (object) [
          'type' => 'enum',
          'maxLength' => 36,
          'options' => [
            0 => 'Attachment',
            1 => 'Inline Attachment',
            2 => 'Import File',
            3 => 'Export File',
            4 => 'Mail Merge',
            5 => 'Mass Pdf'
          ]
        ],
        'storage' => (object) [
          'type' => 'varchar',
          'maxLength' => 24,
          'default' => NULL
        ],
        'storageFilePath' => (object) [
          'type' => 'varchar',
          'maxLength' => 260,
          'default' => NULL
        ],
        'global' => (object) [
          'type' => 'bool',
          'default' => false
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'parent' => (object) [
          'type' => 'belongsToParent',
          'foreign' => 'attachments'
        ],
        'related' => (object) [
          'type' => 'belongsToParent'
        ]
      ],
      'collection' => (object) [
        'sortBy' => 'createdAt',
        'asc' => false,
        'orderBy' => 'createdAt',
        'order' => 'desc'
      ],
      'indexes' => (object) [
        'parent' => (object) [
          'columns' => [
            0 => 'parentType',
            1 => 'parentId'
          ]
        ]
      ],
      'sourceList' => [
        0 => 'Document'
      ]
    ],
    'AuthLogRecord' => (object) [
      'fields' => (object) [
        'username' => (object) [
          'type' => 'varchar',
          'readOnly' => true,
          'maxLength' => 100
        ],
        'portal' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'user' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'authToken' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'ipAddress' => (object) [
          'type' => 'varchar',
          'maxLength' => 45,
          'readOnly' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'hasSeconds' => true
        ],
        'isDenied' => (object) [
          'type' => 'bool',
          'readOnly' => true
        ],
        'denialReason' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'CREDENTIALS',
            2 => 'INACTIVE_USER',
            3 => 'IS_PORTAL_USER',
            4 => 'IS_NOT_PORTAL_USER',
            5 => 'USER_IS_NOT_IN_PORTAL',
            6 => 'IS_SYSTEM_USER'
          ],
          'readOnly' => true
        ],
        'requestTime' => (object) [
          'type' => 'float',
          'readOnly' => true
        ],
        'requestUrl' => (object) [
          'type' => 'varchar',
          'readOnly' => true
        ],
        'requestMethod' => (object) [
          'type' => 'varchar',
          'readOnly' => true,
          'maxLength' => 15
        ],
        'authTokenIsActive' => (object) [
          'type' => 'foreign',
          'link' => 'authToken',
          'field' => 'isActive',
          'readOnly' => true,
          'view' => 'views/fields/foreign-bool'
        ],
        'authenticationMethod' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Espo',
            1 => 'LDAP',
            2 => 'ApiKey',
            3 => 'Hmac'
          ]
        ]
      ],
      'links' => (object) [
        'user' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User',
          'noJoin' => true
        ],
        'portal' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Portal'
        ],
        'authToken' => (object) [
          'type' => 'belongsTo',
          'entity' => 'AuthToken',
          'foreignName' => 'id'
        ],
        'actionHistoryRecords' => (object) [
          'type' => 'hasMany',
          'entity' => 'ActionHistoryRecord',
          'foreign' => 'authLogRecord'
        ]
      ],
      'collection' => (object) [
        'sortBy' => 'requestTime',
        'asc' => false,
        'textFilterFields' => [
          0 => 'ipAddress',
          1 => 'username'
        ],
        'orderBy' => 'requestTime',
        'order' => 'desc'
      ],
      'indexes' => (object) [
        'ipAddress' => (object) [
          'columns' => [
            0 => 'ipAddress'
          ]
        ],
        'ipAddressRequestTime' => (object) [
          'columns' => [
            0 => 'ipAddress',
            1 => 'requestTime'
          ]
        ],
        'requestTime' => (object) [
          'columns' => [
            0 => 'requestTime'
          ]
        ]
      ]
    ],
    'AuthToken' => (object) [
      'fields' => (object) [
        'token' => (object) [
          'type' => 'varchar',
          'maxLength' => 36,
          'index' => true,
          'readOnly' => true
        ],
        'hash' => (object) [
          'type' => 'varchar',
          'maxLength' => 150,
          'index' => true,
          'readOnly' => true
        ],
        'secret' => (object) [
          'type' => 'varchar',
          'maxLength' => 36,
          'readOnly' => true
        ],
        'user' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user'
        ],
        'portal' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'ipAddress' => (object) [
          'type' => 'varchar',
          'maxLength' => 45,
          'readOnly' => true
        ],
        'isActive' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'lastAccess' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'hasSeconds' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'hasSeconds' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'user' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'portal' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Portal'
        ],
        'actionHistoryRecords' => (object) [
          'type' => 'hasMany',
          'entity' => 'ActionHistoryRecord',
          'foreign' => 'authToken'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'lastAccess',
        'order' => 'desc',
        'textFilterFields' => [
          0 => 'ipAddress',
          1 => 'userName'
        ],
        'sortBy' => 'lastAccess',
        'asc' => false
      ],
      'indexes' => (object) [
        'token' => (object) [
          'columns' => [
            0 => 'token',
            1 => 'deleted'
          ]
        ]
      ]
    ],
    'AuthenticationProvider' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true
        ],
        'method' => (object) [
          'type' => 'enum',
          'view' => 'views/authentication-provider/fields/method',
          'translation' => 'Settings.options.authenticationMethod',
          'required' => true,
          'validatorClassNameMap' => (object) [
            'valid' => 'Espo\\Classes\\FieldValidators\\AuthenticationProvider\\MethodValid'
          ]
        ],
        'oidcAuthorizationRedirectUri' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'readOnly' => true
        ],
        'oidcClientId' => (object) [
          'type' => 'varchar'
        ],
        'oidcClientSecret' => (object) [
          'type' => 'password'
        ],
        'oidcAuthorizationEndpoint' => (object) [
          'type' => 'url',
          'strip' => false
        ],
        'oidcTokenEndpoint' => (object) [
          'type' => 'url',
          'strip' => false
        ],
        'oidcJwksEndpoint' => (object) [
          'type' => 'url',
          'strip' => false
        ],
        'oidcJwtSignatureAlgorithmList' => (object) [
          'type' => 'multiEnum',
          'optionsPath' => 'entityDefs.Settings.fields.oidcJwtSignatureAlgorithmList.options',
          'default' => [
            0 => 'RS256'
          ]
        ],
        'oidcScopes' => (object) [
          'type' => 'multiEnum',
          'allowCustomOptions' => true,
          'optionsPath' => 'entityDefs.Settings.fields.oidcScopes.options',
          'default' => [
            0 => 'profile',
            1 => 'email',
            2 => 'phone'
          ]
        ],
        'oidcCreateUser' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'oidcUsernameClaim' => (object) [
          'type' => 'varchar',
          'optionsPath' => 'entityDefs.Settings.fields.oidcUsernameClaim.options',
          'tooltip' => true,
          'default' => 'sub'
        ],
        'oidcSync' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'oidcLogoutUrl' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ]
      ]
    ],
    'Autofollow' => (object) [
      'fields' => (object) [
        'id' => (object) [
          'type' => 'id',
          'dbType' => 'integer',
          'autoincrement' => true
        ],
        'entityType' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'index' => true
        ],
        'user' => (object) [
          'type' => 'link'
        ]
      ]
    ],
    'Currency' => (object) [
      'fields' => (object) [
        'id' => (object) [
          'type' => 'id',
          'maxLength' => 3,
          'dbType' => 'string'
        ],
        'rate' => (object) [
          'type' => 'float'
        ]
      ],
      'noDeletedAttribute' => true
    ],
    'DashboardTemplate' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'required' => true
        ],
        'layout' => (object) [
          'type' => 'jsonArray',
          'view' => 'views/settings/fields/dashboard-layout',
          'inlineEditDisabled' => true,
          'required' => true
        ],
        'dashletsOptions' => (object) [
          'type' => 'jsonObject',
          'disabled' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'Email' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'subject' => (object) [
          'type' => 'varchar',
          'required' => true,
          'notStorable' => true,
          'view' => 'views/email/fields/subject',
          'utility' => true
        ],
        'fromName' => (object) [
          'type' => 'varchar',
          'readOnly' => true,
          'notStorable' => true,
          'textFilterDisabled' => true,
          'layoutFiltersDisabled' => true,
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'fromAddress' => (object) [
          'type' => 'varchar',
          'readOnly' => true,
          'notStorable' => true,
          'textFilterDisabled' => true,
          'layoutFiltersDisabled' => true,
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'fromString' => (object) [
          'type' => 'varchar',
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'replyToString' => (object) [
          'type' => 'varchar',
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'replyToName' => (object) [
          'type' => 'varchar',
          'readOnly' => true,
          'notStorable' => true,
          'textFilterDisabled' => true,
          'layoutFiltersDisabled' => true,
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'replyToAddress' => (object) [
          'type' => 'varchar',
          'readOnly' => true,
          'notStorable' => true,
          'textFilterDisabled' => true,
          'layoutFiltersDisabled' => true,
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'addressNameMap' => (object) [
          'type' => 'jsonObject',
          'utility' => true,
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'from' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'required' => true,
          'view' => 'views/email/fields/from-address-varchar',
          'textFilterDisabled' => true,
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'to' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'required' => true,
          'view' => 'views/email/fields/email-address-varchar',
          'validatorClassName' => 'Espo\\Classes\\FieldValidators\\Email\\EmailAddresses',
          'validatorClassNameList' => [
            0 => 'Espo\\Classes\\FieldValidators\\Email\\Addresses\\Valid',
            1 => 'Espo\\Classes\\FieldValidators\\Email\\Addresses\\MaxCount'
          ],
          'textFilterDisabled' => true,
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'cc' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'view' => 'views/email/fields/email-address-varchar',
          'validatorClassNameList' => [
            0 => 'Espo\\Classes\\FieldValidators\\Email\\Addresses\\Valid',
            1 => 'Espo\\Classes\\FieldValidators\\Email\\Addresses\\MaxCount'
          ],
          'customizationDisabled' => true,
          'textFilterDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'bcc' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'view' => 'views/email/fields/email-address-varchar',
          'validatorClassNameList' => [
            0 => 'Espo\\Classes\\FieldValidators\\Email\\Addresses\\Valid',
            1 => 'Espo\\Classes\\FieldValidators\\Email\\Addresses\\MaxCount'
          ],
          'customizationDisabled' => true,
          'textFilterDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'replyTo' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'view' => 'views/email/fields/email-address-varchar',
          'textFilterDisabled' => true,
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'personStringData' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'utility' => true,
          'view' => 'views/email/fields/person-string-data',
          'customizationDisabled' => true
        ],
        'isRead' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'default' => true,
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'isNotRead' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutListDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'isReplied' => (object) [
          'type' => 'bool',
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'isNotReplied' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutListDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'isImportant' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'default' => false,
          'customizationDisabled' => true
        ],
        'inTrash' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'default' => false,
          'customizationDisabled' => true
        ],
        'folderId' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'default' => NULL,
          'textFilterDisabled' => true,
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'isUsers' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'default' => false,
          'customizationDisabled' => true
        ],
        'folder' => (object) [
          'type' => 'link',
          'notStorable' => true,
          'readOnly' => true,
          'entity' => 'EmailFolder',
          'customizationDisabled' => true
        ],
        'nameHash' => (object) [
          'type' => 'text',
          'notStorable' => true,
          'readOnly' => true,
          'utility' => true,
          'customizationDisabled' => true
        ],
        'typeHash' => (object) [
          'type' => 'text',
          'notStorable' => true,
          'readOnly' => true,
          'utility' => true,
          'customizationDisabled' => true
        ],
        'idHash' => (object) [
          'type' => 'text',
          'notStorable' => true,
          'readOnly' => true,
          'utility' => true,
          'customizationDisabled' => true
        ],
        'messageId' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'readOnly' => true,
          'index' => true,
          'textFilterDisabled' => true,
          'customizationDisabled' => true
        ],
        'messageIdInternal' => (object) [
          'type' => 'varchar',
          'maxLength' => 300,
          'readOnly' => true,
          'textFilterDisabled' => true,
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'emailAddress' => (object) [
          'type' => 'base',
          'notStorable' => true,
          'view' => 'views/email/fields/email-address',
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'fromEmailAddress' => (object) [
          'type' => 'link',
          'view' => 'views/email/fields/from-email-address',
          'textFilterDisabled' => true,
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'toEmailAddresses' => (object) [
          'type' => 'linkMultiple',
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'ccEmailAddresses' => (object) [
          'type' => 'linkMultiple',
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'bccEmailAddresses' => (object) [
          'type' => 'linkMultiple',
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'replyToEmailAddresses' => (object) [
          'type' => 'linkMultiple',
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'bodyPlain' => (object) [
          'type' => 'text',
          'seeMoreDisabled' => true,
          'clientReadOnly' => true,
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'body' => (object) [
          'type' => 'wysiwyg',
          'view' => 'views/email/fields/body',
          'attachmentField' => 'attachments',
          'useIframe' => true,
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'isHtml' => (object) [
          'type' => 'bool',
          'default' => true,
          'fieldManagerParamList' => [
            0 => 'default',
            1 => 'tooltipText'
          ],
          'inlineEditDisabled' => true
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Draft',
            1 => 'Sending',
            2 => 'Sent',
            3 => 'Archived',
            4 => 'Failed'
          ],
          'default' => 'Archived',
          'clientReadOnly' => true,
          'style' => (object) [
            'Draft' => 'warning',
            'Failed' => 'danger',
            'Sending' => 'warning'
          ],
          'customizationDisabled' => true
        ],
        'attachments' => (object) [
          'type' => 'attachmentMultiple',
          'sourceList' => [
            0 => 'Document'
          ],
          'layoutDefaultSidePanelDisabled' => true
        ],
        'hasAttachment' => (object) [
          'type' => 'bool',
          'readOnly' => true,
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'parent' => (object) [
          'type' => 'linkParent',
          'fieldManagerParamList' => [
            0 => 'required',
            1 => 'entityList',
            2 => 'audited',
            3 => 'tooltipText'
          ],
          'entityList' => [
            0 => 'Account',
            1 => 'Lead',
            2 => 'Contact',
            3 => 'Opportunity',
            4 => 'Case'
          ]
        ],
        'dateSent' => (object) [
          'type' => 'datetime',
          'customizationDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true
        ],
        'deliveryDate' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'customizationDisabled' => true
        ],
        'sentBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'noLoad' => true,
          'customizationDisabled' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'customizationDisabled' => true
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'required' => false,
          'view' => 'views/fields/assigned-user'
        ],
        'replied' => (object) [
          'type' => 'link',
          'noJoin' => true,
          'view' => 'views/email/fields/replied',
          'customizationDisabled' => true
        ],
        'replies' => (object) [
          'type' => 'linkMultiple',
          'readOnly' => true,
          'orderBy' => 'dateSent',
          'view' => 'views/email/fields/replies',
          'customizationDisabled' => true,
          'columns' => (object) [
            'status' => 'status'
          ]
        ],
        'isSystem' => (object) [
          'type' => 'bool',
          'default' => false,
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'isJustSent' => (object) [
          'type' => 'bool',
          'default' => false,
          'utility' => true,
          'notStorable' => true,
          'customizationDisabled' => true
        ],
        'isBeingImported' => (object) [
          'type' => 'bool',
          'utility' => true,
          'notStorable' => true,
          'customizationDisabled' => true
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'users' => (object) [
          'type' => 'linkMultiple',
          'noLoad' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'readOnly' => true,
          'columns' => (object) [
            'inTrash' => 'inTrash',
            'folderId' => 'folderId'
          ],
          'customizationDisabled' => true
        ],
        'assignedUsers' => (object) [
          'type' => 'linkMultiple',
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'inboundEmails' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'noLoad' => true,
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'default'
          ]
        ],
        'emailAccounts' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'noLoad' => true,
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'default'
          ]
        ],
        'icsContents' => (object) [
          'type' => 'text',
          'readOnly' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'icsEventData' => (object) [
          'type' => 'jsonObject',
          'readOnly' => true,
          'directAccessDisabled' => true,
          'notStorable' => true,
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'icsEventUid' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'index' => true,
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'icsEventDateStart' => (object) [
          'type' => 'datetimeOptional',
          'readOnly' => true,
          'notStorable' => true,
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'createEvent' => (object) [
          'type' => 'base',
          'utility' => true,
          'notStorable' => true,
          'view' => 'views/email/fields/create-event',
          'customizationDisabled' => true,
          'layoutAvailabilityList' => []
        ],
        'createdEvent' => (object) [
          'type' => 'linkParent',
          'readOnly' => true,
          'view' => 'views/email/fields/created-event',
          'fieldManagerParamList' => [
            0 => 'tooltipText'
          ],
          'layoutAvailabilityList' => []
        ],
        'groupFolder' => (object) [
          'type' => 'link'
        ],
        'account' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'tasks' => (object) [
          'type' => 'linkMultiple',
          'readOnly' => true,
          'columns' => (object) [
            'status' => 'status'
          ],
          'view' => 'views/fields/link-multiple-with-status',
          'customizationDefaultDisabled' => true
        ],
        'icsEventDateStartDate' => (object) [
          'readOnly' => true,
          'notStorable' => true,
          'customizationDisabled' => true,
          'type' => 'date',
          'disabled' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam'
        ],
        'assignedUsers' => (object) [
          'type' => 'hasMany',
          'entity' => 'User',
          'relationName' => 'entityUser'
        ],
        'users' => (object) [
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'emails',
          'additionalColumns' => (object) [
            'isRead' => (object) [
              'type' => 'bool',
              'default' => false
            ],
            'isImportant' => (object) [
              'type' => 'bool',
              'default' => false
            ],
            'inTrash' => (object) [
              'type' => 'bool',
              'default' => false
            ],
            'folderId' => (object) [
              'type' => 'foreignId',
              'default' => NULL
            ]
          ]
        ],
        'sentBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'attachments' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Attachment',
          'foreign' => 'parent',
          'relationName' => 'attachments'
        ],
        'parent' => (object) [
          'type' => 'belongsToParent',
          'entityList' => [],
          'foreign' => 'emails'
        ],
        'replied' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Email',
          'foreign' => 'replies'
        ],
        'replies' => (object) [
          'type' => 'hasMany',
          'entity' => 'Email',
          'foreign' => 'replied'
        ],
        'fromEmailAddress' => (object) [
          'type' => 'belongsTo',
          'entity' => 'EmailAddress'
        ],
        'toEmailAddresses' => (object) [
          'type' => 'hasMany',
          'entity' => 'EmailAddress',
          'relationName' => 'emailEmailAddress',
          'conditions' => (object) [
            'addressType' => 'to'
          ],
          'additionalColumns' => (object) [
            'addressType' => (object) [
              'type' => 'varchar',
              'len' => '4'
            ]
          ]
        ],
        'ccEmailAddresses' => (object) [
          'type' => 'hasMany',
          'entity' => 'EmailAddress',
          'relationName' => 'emailEmailAddress',
          'conditions' => (object) [
            'addressType' => 'cc'
          ],
          'additionalColumns' => (object) [
            'addressType' => (object) [
              'type' => 'varchar',
              'len' => '4'
            ]
          ],
          'layoutDefaultSidePanelDisabled' => true
        ],
        'bccEmailAddresses' => (object) [
          'type' => 'hasMany',
          'entity' => 'EmailAddress',
          'relationName' => 'emailEmailAddress',
          'conditions' => (object) [
            'addressType' => 'bcc'
          ],
          'additionalColumns' => (object) [
            'addressType' => (object) [
              'type' => 'varchar',
              'len' => '4'
            ]
          ],
          'layoutDefaultSidePanelDisabled' => true
        ],
        'replyToEmailAddresses' => (object) [
          'type' => 'hasMany',
          'entity' => 'EmailAddress',
          'relationName' => 'emailEmailAddress',
          'conditions' => (object) [
            'addressType' => 'rto'
          ],
          'additionalColumns' => (object) [
            'addressType' => (object) [
              'type' => 'varchar',
              'len' => '4'
            ]
          ]
        ],
        'inboundEmails' => (object) [
          'type' => 'hasMany',
          'entity' => 'InboundEmail',
          'foreign' => 'emails'
        ],
        'emailAccounts' => (object) [
          'type' => 'hasMany',
          'entity' => 'EmailAccount',
          'foreign' => 'emails'
        ],
        'createdEvent' => (object) [
          'type' => 'belongsToParent',
          'entityList' => [
            0 => 'Meeting'
          ]
        ],
        'groupFolder' => (object) [
          'type' => 'belongsTo',
          'entity' => 'GroupEmailFolder',
          'foreign' => 'emails'
        ],
        'account' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Account'
        ],
        'tasks' => (object) [
          'type' => 'hasMany',
          'entity' => 'Task',
          'foreign' => 'email'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'dateSent',
        'order' => 'desc',
        'textFilterFields' => [
          0 => 'name',
          1 => 'bodyPlain',
          2 => 'body'
        ],
        'countDisabled' => true,
        'fullTextSearch' => true,
        'fullTextSearchOrderType' => 'original',
        'sortBy' => 'dateSent',
        'asc' => false
      ],
      'indexes' => (object) [
        'createdById' => (object) [
          'columns' => [
            0 => 'createdById'
          ]
        ],
        'dateSent' => (object) [
          'columns' => [
            0 => 'dateSent',
            1 => 'deleted'
          ]
        ],
        'dateSentStatus' => (object) [
          'columns' => [
            0 => 'dateSent',
            1 => 'status',
            2 => 'deleted'
          ]
        ]
      ]
    ],
    'EmailAccount' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'emailAddress' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 100,
          'tooltip' => true,
          'view' => 'views/email-account/fields/email-address'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Active',
            1 => 'Inactive'
          ],
          'default' => 'Active'
        ],
        'host' => (object) [
          'type' => 'varchar'
        ],
        'port' => (object) [
          'type' => 'int',
          'min' => 0,
          'max' => 65535,
          'default' => 993
        ],
        'security' => (object) [
          'type' => 'enum',
          'default' => 'SSL',
          'options' => [
            0 => '',
            1 => 'SSL',
            2 => 'TLS'
          ]
        ],
        'username' => (object) [
          'type' => 'varchar'
        ],
        'password' => (object) [
          'type' => 'password'
        ],
        'monitoredFolders' => (object) [
          'type' => 'array',
          'default' => [
            0 => 'INBOX'
          ],
          'view' => 'views/email-account/fields/folders',
          'displayAsList' => true,
          'noEmptyString' => true,
          'duplicateIgnore' => true
        ],
        'sentFolder' => (object) [
          'type' => 'varchar',
          'view' => 'views/email-account/fields/folder',
          'duplicateIgnore' => true
        ],
        'storeSentEmails' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'keepFetchedEmailsUnread' => (object) [
          'type' => 'bool'
        ],
        'fetchSince' => (object) [
          'type' => 'date'
        ],
        'fetchData' => (object) [
          'type' => 'jsonObject',
          'readOnly' => true,
          'duplicateIgnore' => true
        ],
        'emailFolder' => (object) [
          'type' => 'link',
          'view' => 'views/email-account/fields/email-folder',
          'duplicateIgnore' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'required' => true,
          'view' => 'views/fields/assigned-user'
        ],
        'useImap' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'useSmtp' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'smtpHost' => (object) [
          'type' => 'varchar'
        ],
        'smtpPort' => (object) [
          'type' => 'int',
          'min' => 0,
          'max' => 65535,
          'default' => 587
        ],
        'smtpAuth' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'smtpSecurity' => (object) [
          'type' => 'enum',
          'default' => 'TLS',
          'options' => [
            0 => '',
            1 => 'SSL',
            2 => 'TLS'
          ]
        ],
        'smtpUsername' => (object) [
          'type' => 'varchar'
        ],
        'smtpPassword' => (object) [
          'type' => 'password'
        ],
        'smtpAuthMechanism' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'login',
            1 => 'crammd5',
            2 => 'plain'
          ],
          'default' => 'login'
        ],
        'imapHandler' => (object) [
          'type' => 'varchar',
          'readOnly' => true
        ],
        'smtpHandler' => (object) [
          'type' => 'varchar',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'filters' => (object) [
          'type' => 'hasChildren',
          'foreign' => 'parent',
          'entity' => 'EmailFilter'
        ],
        'emails' => (object) [
          'type' => 'hasMany',
          'entity' => 'Email',
          'foreign' => 'emailAccounts'
        ],
        'emailFolder' => (object) [
          'type' => 'belongsTo',
          'entity' => 'EmailFolder'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'EmailAddress' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 255
        ],
        'lower' => (object) [
          'type' => 'varchar',
          'required' => true,
          'index' => true
        ],
        'invalid' => (object) [
          'type' => 'bool'
        ],
        'optOut' => (object) [
          'type' => 'bool'
        ],
        'primary' => (object) [
          'type' => 'bool',
          'notStorable' => true
        ]
      ],
      'links' => (object) [],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'EmailFilter' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 100,
          'tooltip' => true,
          'pattern' => '$noBadCharacters'
        ],
        'from' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'tooltip' => true
        ],
        'to' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'tooltip' => true
        ],
        'subject' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'tooltip' => true
        ],
        'bodyContains' => (object) [
          'type' => 'array',
          'tooltip' => true
        ],
        'bodyContainsAll' => (object) [
          'type' => 'array',
          'tooltip' => true
        ],
        'isGlobal' => (object) [
          'type' => 'bool',
          'tooltip' => true,
          'default' => false
        ],
        'parent' => (object) [
          'type' => 'linkParent',
          'view' => 'views/email-filter/fields/parent'
        ],
        'action' => (object) [
          'type' => 'enum',
          'default' => 'Skip',
          'options' => [
            0 => 'Skip',
            1 => 'Move to Folder',
            2 => 'Move to Group Folder',
            3 => 'None'
          ],
          'view' => 'views/email-filter/fields/action'
        ],
        'emailFolder' => (object) [
          'type' => 'link',
          'view' => 'views/email-filter/fields/email-folder'
        ],
        'groupEmailFolder' => (object) [
          'type' => 'link'
        ],
        'markAsRead' => (object) [
          'type' => 'bool'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'parent' => (object) [
          'type' => 'belongsToParent',
          'entityList' => [
            0 => 'User',
            1 => 'EmailAccount',
            2 => 'InboundEmail'
          ]
        ],
        'emailFolder' => (object) [
          'type' => 'belongsTo',
          'entity' => 'EmailFolder'
        ],
        'groupEmailFolder' => (object) [
          'type' => 'belongsTo',
          'entity' => 'GroupEmailFolder'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ]
    ],
    'EmailFolder' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 64,
          'pattern' => '$noBadCharacters'
        ],
        'order' => (object) [
          'type' => 'int'
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'skipNotifications' => (object) [
          'type' => 'bool'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'order',
        'order' => 'asc',
        'sortBy' => 'order',
        'asc' => true
      ]
    ],
    'EmailTemplate' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true
        ],
        'subject' => (object) [
          'type' => 'varchar'
        ],
        'body' => (object) [
          'type' => 'wysiwyg',
          'view' => 'views/email-template/fields/body',
          'useIframe' => true
        ],
        'isHtml' => (object) [
          'type' => 'bool',
          'default' => true,
          'inlineEditDisabled' => true
        ],
        'oneOff' => (object) [
          'type' => 'bool',
          'default' => false,
          'tooltip' => true
        ],
        'attachments' => (object) [
          'type' => 'attachmentMultiple'
        ],
        'category' => (object) [
          'type' => 'link',
          'view' => 'views/fields/link-category-tree'
        ],
        'assignedUser' => (object) [
          'type' => 'link'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user'
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user'
        ]
      ],
      'links' => (object) [
        'attachments' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Attachment',
          'foreign' => 'parent'
        ],
        'category' => (object) [
          'type' => 'belongsTo',
          'foreign' => 'emailTemplates',
          'entity' => 'EmailTemplateCategory'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'textFilterFields' => [
          0 => 'name',
          1 => 'subject'
        ],
        'sortBy' => 'createdAt',
        'asc' => false
      ],
      'optimisticConcurrencyControl' => true
    ],
    'EmailTemplateCategory' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true
        ],
        'order' => (object) [
          'type' => 'int',
          'minValue' => 1,
          'required' => true,
          'textFilterDisabled' => true
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'teams' => (object) [
          'type' => 'linkMultiple'
        ],
        'parent' => (object) [
          'type' => 'link'
        ],
        'childList' => (object) [
          'type' => 'jsonArray',
          'notStorable' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'parent' => (object) [
          'type' => 'belongsTo',
          'foreign' => 'children',
          'entity' => 'EmailTemplateCategory'
        ],
        'children' => (object) [
          'type' => 'hasMany',
          'foreign' => 'parent',
          'entity' => 'EmailTemplateCategory'
        ],
        'emailTemplates' => (object) [
          'type' => 'hasMany',
          'foreign' => 'category',
          'entity' => 'EmailTemplate'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'parent',
        'order' => 'asc',
        'sortBy' => 'parent',
        'asc' => true
      ],
      'additionalTables' => (object) [
        'EmailTemplateCategoryPath' => (object) [
          'attributes' => (object) [
            'id' => (object) [
              'type' => 'id',
              'dbType' => 'integer',
              'len' => 11,
              'autoincrement' => true
            ],
            'ascendorId' => (object) [
              'type' => 'foreignId',
              'index' => true
            ],
            'descendorId' => (object) [
              'type' => 'foreignId',
              'index' => true
            ]
          ]
        ]
      ]
    ],
    'Export' => (object) [
      'fields' => (object) [
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Pending',
            1 => 'Running',
            2 => 'Success',
            3 => 'Failed'
          ],
          'default' => 'Pending'
        ],
        'params' => (object) [
          'type' => 'text'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'required' => true
        ],
        'notifyOnFinish' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'attachment' => (object) [
          'type' => 'link',
          'entity' => 'Attachment'
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ]
    ],
    'Extension' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true
        ],
        'version' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 50
        ],
        'fileList' => (object) [
          'type' => 'jsonArray'
        ],
        'licenseStatus' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Valid',
            2 => 'Invalid',
            3 => 'Expired',
            4 => 'Soft-Expired'
          ],
          'index' => true,
          'maxLength' => 36
        ],
        'licenseStatusMessage' => (object) [
          'type' => 'varchar'
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'isInstalled' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'checkVersionUrl' => (object) [
          'type' => 'url'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ]
    ],
    'ExternalAccount' => (object) [
      'fields' => (object) [
        'id' => (object) [
          'type' => 'id',
          'dbType' => 'string',
          'maxLength' => 64
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'enabled' => (object) [
          'type' => 'bool'
        ],
        'isLocked' => (object) [
          'type' => 'bool'
        ]
      ]
    ],
    'GroupEmailFolder' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 64,
          'pattern' => '$noBadCharacters'
        ],
        'order' => (object) [
          'type' => 'int'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'foreign' => 'groupEmailFolders'
        ],
        'emails' => (object) [
          'type' => 'hasMany',
          'entity' => 'Email',
          'foreign' => 'groupFolder'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'order',
        'order' => 'asc',
        'sortBy' => 'order',
        'asc' => true
      ]
    ],
    'Import' => (object) [
      'fields' => (object) [
        'entityType' => (object) [
          'type' => 'enum',
          'translation' => 'Global.scopeNames',
          'required' => true,
          'readOnly' => true
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Standby',
            1 => 'Pending',
            2 => 'In Process',
            3 => 'Complete',
            4 => 'Failed'
          ],
          'readOnly' => true,
          'style' => (object) [
            'Complete' => 'success',
            'Failed' => 'danger'
          ]
        ],
        'file' => (object) [
          'type' => 'file',
          'required' => true,
          'readOnly' => true
        ],
        'importedCount' => (object) [
          'type' => 'int',
          'readOnly' => true,
          'notStorable' => true
        ],
        'duplicateCount' => (object) [
          'type' => 'int',
          'readOnly' => true,
          'notStorable' => true
        ],
        'updatedCount' => (object) [
          'type' => 'int',
          'readOnly' => true,
          'notStorable' => true
        ],
        'lastIndex' => (object) [
          'type' => 'int',
          'readOnly' => true
        ],
        'params' => (object) [
          'type' => 'jsonObject',
          'readOnly' => true
        ],
        'attributeList' => (object) [
          'type' => 'jsonArray',
          'readOnly' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'errors' => (object) [
          'type' => 'hasMany',
          'entity' => 'ImportError',
          'foreign' => 'import',
          'readOnly' => true
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ]
    ],
    'ImportEntity' => (object) [
      'fields' => (object) [
        'id' => (object) [
          'type' => 'id',
          'dbType' => 'bigint',
          'autoincrement' => true
        ],
        'entity' => (object) [
          'type' => 'linkParent'
        ],
        'import' => (object) [
          'type' => 'link'
        ],
        'isImported' => (object) [
          'type' => 'bool'
        ],
        'isUpdated' => (object) [
          'type' => 'bool'
        ],
        'isDuplicate' => (object) [
          'type' => 'bool'
        ]
      ],
      'indexes' => (object) [
        'entityImport' => (object) [
          'columns' => [
            0 => 'importId',
            1 => 'entityType'
          ]
        ]
      ]
    ],
    'ImportError' => (object) [
      'fields' => (object) [
        'import' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'entityType' => (object) [
          'type' => 'foreign',
          'link' => 'import',
          'field' => 'entityType'
        ],
        'rowIndex' => (object) [
          'type' => 'int',
          'readOnly' => true,
          'tooltip' => true
        ],
        'exportRowIndex' => (object) [
          'type' => 'int',
          'readOnly' => true
        ],
        'lineNumber' => (object) [
          'type' => 'int',
          'readOnly' => true,
          'tooltip' => true,
          'notStorable' => true,
          'view' => 'views/import-error/fields/line-number'
        ],
        'exportLineNumber' => (object) [
          'type' => 'int',
          'readOnly' => true,
          'tooltip' => true,
          'notStorable' => true,
          'view' => 'views/import-error/fields/line-number'
        ],
        'type' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Validation',
            2 => 'No-Access',
            3 => 'Not-Found',
            4 => 'Integrity-Constraint-Violation'
          ],
          'readOnly' => true
        ],
        'validationFailures' => (object) [
          'type' => 'jsonArray',
          'readOnly' => true,
          'view' => 'views/import-error/fields/validation-failures'
        ],
        'row' => (object) [
          'type' => 'array',
          'readOnly' => true,
          'displayAsList' => true,
          'doNotStoreArrayValues' => true
        ]
      ],
      'links' => (object) [
        'import' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Import',
          'foreign' => 'errors',
          'foreignName' => 'id'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'rowIndex',
        'sortBy' => 'rowIndex'
      ],
      'indexes' => (object) [
        'rowIndex' => (object) [
          'columns' => [
            0 => 'rowIndex'
          ]
        ],
        'importRowIndex' => (object) [
          'columns' => [
            0 => 'importId',
            1 => 'rowIndex'
          ]
        ]
      ]
    ],
    'InboundEmail' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'emailAddress' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 100,
          'view' => 'views/inbound-email/fields/email-address'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Active',
            1 => 'Inactive'
          ],
          'default' => 'Active'
        ],
        'host' => (object) [
          'type' => 'varchar'
        ],
        'port' => (object) [
          'type' => 'int',
          'min' => 0,
          'max' => 65535,
          'default' => 993
        ],
        'security' => (object) [
          'type' => 'enum',
          'default' => 'SSL',
          'options' => [
            0 => '',
            1 => 'SSL',
            2 => 'TLS'
          ]
        ],
        'username' => (object) [
          'type' => 'varchar'
        ],
        'password' => (object) [
          'type' => 'password'
        ],
        'monitoredFolders' => (object) [
          'type' => 'array',
          'default' => [
            0 => 'INBOX'
          ],
          'view' => 'views/inbound-email/fields/folders',
          'displayAsList' => true,
          'noEmptyString' => true,
          'duplicateIgnore' => true
        ],
        'fetchSince' => (object) [
          'type' => 'date'
        ],
        'fetchData' => (object) [
          'type' => 'jsonObject',
          'readOnly' => true,
          'duplicateIgnore' => true
        ],
        'assignToUser' => (object) [
          'type' => 'link',
          'tooltip' => true
        ],
        'team' => (object) [
          'type' => 'link',
          'tooltip' => true
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'tooltip' => true
        ],
        'addAllTeamUsers' => (object) [
          'type' => 'bool',
          'tooltip' => true,
          'default' => true
        ],
        'sentFolder' => (object) [
          'type' => 'varchar',
          'view' => 'views/inbound-email/fields/folder',
          'duplicateIgnore' => true
        ],
        'storeSentEmails' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'keepFetchedEmailsUnread' => (object) [
          'type' => 'bool'
        ],
        'useImap' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'useSmtp' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'smtpIsShared' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'smtpIsForMassEmail' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'smtpHost' => (object) [
          'type' => 'varchar'
        ],
        'smtpPort' => (object) [
          'type' => 'int',
          'min' => 0,
          'max' => 65535,
          'default' => 587
        ],
        'smtpAuth' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'smtpSecurity' => (object) [
          'type' => 'enum',
          'default' => 'TLS',
          'options' => [
            0 => '',
            1 => 'SSL',
            2 => 'TLS'
          ]
        ],
        'smtpUsername' => (object) [
          'type' => 'varchar'
        ],
        'smtpPassword' => (object) [
          'type' => 'password'
        ],
        'smtpAuthMechanism' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'login',
            1 => 'crammd5',
            2 => 'plain'
          ],
          'default' => 'login'
        ],
        'createCase' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'caseDistribution' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Direct-Assignment',
            2 => 'Round-Robin',
            3 => 'Least-Busy'
          ],
          'default' => 'Direct-Assignment',
          'tooltip' => true
        ],
        'targetUserPosition' => (object) [
          'type' => 'enum',
          'view' => 'views/inbound-email/fields/target-user-position',
          'tooltip' => true
        ],
        'reply' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'replyEmailTemplate' => (object) [
          'type' => 'link'
        ],
        'replyFromAddress' => (object) [
          'type' => 'varchar'
        ],
        'replyToAddress' => (object) [
          'type' => 'varchar',
          'view' => 'views/fields/email-address',
          'tooltip' => true
        ],
        'replyFromName' => (object) [
          'type' => 'varchar'
        ],
        'fromName' => (object) [
          'type' => 'varchar'
        ],
        'groupEmailFolder' => (object) [
          'type' => 'link',
          'tooltip' => true
        ],
        'imapHandler' => (object) [
          'type' => 'varchar',
          'readOnly' => true
        ],
        'smtpHandler' => (object) [
          'type' => 'varchar',
          'readOnly' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'foreign' => 'inboundEmails'
        ],
        'assignToUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'team' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Team'
        ],
        'replyEmailTemplate' => (object) [
          'type' => 'belongsTo',
          'entity' => 'EmailTemplate'
        ],
        'filters' => (object) [
          'type' => 'hasChildren',
          'foreign' => 'parent',
          'entity' => 'EmailFilter'
        ],
        'emails' => (object) [
          'type' => 'hasMany',
          'entity' => 'Email',
          'foreign' => 'inboundEmails'
        ],
        'groupEmailFolder' => (object) [
          'type' => 'belongsTo',
          'entity' => 'GroupEmailFolder'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'Integration' => (object) [
      'fields' => (object) [
        'id' => (object) [
          'type' => 'id',
          'dbType' => 'string',
          'maxLength' => 24
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'enabled' => (object) [
          'type' => 'bool'
        ]
      ]
    ],
    'Job' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'view' => 'views/admin/job/fields/name'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Pending',
            1 => 'Ready',
            2 => 'Running',
            3 => 'Success',
            4 => 'Failed'
          ],
          'default' => 'Pending',
          'style' => (object) [
            'Success' => 'success',
            'Failed' => 'danger',
            'Running' => 'warning',
            'Ready' => 'warning'
          ],
          'maxLength' => 16
        ],
        'executeTime' => (object) [
          'type' => 'datetime',
          'required' => true,
          'hasSeconds' => true
        ],
        'number' => (object) [
          'type' => 'int',
          'index' => true,
          'readOnly' => true,
          'view' => 'views/fields/autoincrement',
          'dbType' => 'bigint',
          'unique' => true,
          'autoincrement' => true
        ],
        'className' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 255
        ],
        'serviceName' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 100
        ],
        'methodName' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'job' => (object) [
          'type' => 'varchar',
          'view' => 'views/scheduled-job/fields/job'
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'scheduledJob' => (object) [
          'type' => 'link'
        ],
        'scheduledJobJob' => (object) [
          'type' => 'foreign',
          'link' => 'scheduledJob',
          'field' => 'job'
        ],
        'queue' => (object) [
          'type' => 'varchar',
          'maxLength' => 36,
          'default' => NULL
        ],
        'group' => (object) [
          'type' => 'varchar',
          'maxLength' => 128,
          'default' => NULL
        ],
        'targetGroup' => (object) [
          'type' => 'varchar',
          'maxLength' => 128,
          'default' => NULL
        ],
        'startedAt' => (object) [
          'type' => 'datetime',
          'hasSeconds' => true
        ],
        'executedAt' => (object) [
          'type' => 'datetime',
          'hasSeconds' => true
        ],
        'pid' => (object) [
          'type' => 'int'
        ],
        'attempts' => (object) [
          'type' => 'int'
        ],
        'targetId' => (object) [
          'type' => 'varchar',
          'maxLength' => 48
        ],
        'targetType' => (object) [
          'type' => 'varchar',
          'maxLength' => 64
        ],
        'failedAttempts' => (object) [
          'type' => 'int'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'hasSeconds' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'hasSeconds' => true
        ]
      ],
      'links' => (object) [
        'scheduledJob' => (object) [
          'type' => 'belongsTo',
          'entity' => 'ScheduledJob'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'number',
        'order' => 'desc',
        'textFilterFields' => [
          0 => 'id',
          1 => 'name',
          2 => 'methodName',
          3 => 'serviceName'
        ],
        'sortBy' => 'number',
        'asc' => false
      ],
      'indexes' => (object) [
        'executeTime' => (object) [
          'columns' => [
            0 => 'status',
            1 => 'executeTime'
          ]
        ],
        'status' => (object) [
          'columns' => [
            0 => 'status',
            1 => 'deleted'
          ]
        ],
        'statusScheduledJobId' => (object) [
          'columns' => [
            0 => 'status',
            1 => 'scheduledJobId'
          ]
        ]
      ]
    ],
    'KanbanOrder' => (object) [
      'fields' => (object) [
        'order' => (object) [
          'type' => 'int',
          'dbType' => 'smallint'
        ],
        'entity' => (object) [
          'type' => 'linkParent'
        ],
        'group' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'user' => (object) [
          'type' => 'link'
        ]
      ],
      'links' => (object) [
        'entity' => (object) [
          'type' => 'belongsToParent'
        ]
      ],
      'indexes' => (object) [
        'entityUserId' => (object) [
          'columns' => [
            0 => 'entityType',
            1 => 'entityId',
            2 => 'userId'
          ]
        ],
        'entityType' => (object) [
          'columns' => [
            0 => 'entityType'
          ]
        ],
        'entityTypeUserId' => (object) [
          'columns' => [
            0 => 'entityType',
            1 => 'userId'
          ]
        ]
      ]
    ],
    'LayoutRecord' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar'
        ],
        'layoutSet' => (object) [
          'type' => 'link'
        ],
        'data' => (object) [
          'type' => 'text'
        ]
      ],
      'links' => (object) [
        'layoutSet' => (object) [
          'type' => 'belongsTo',
          'entity' => 'LayoutSet',
          'foreign' => 'layoutRecords'
        ]
      ],
      'indexes' => (object) [
        'nameLayoutSetId' => (object) [
          'columns' => [
            0 => 'name',
            1 => 'layoutSetId'
          ]
        ]
      ]
    ],
    'LayoutSet' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 100
        ],
        'layoutList' => (object) [
          'type' => 'multiEnum',
          'displayAsList' => true,
          'view' => 'views/layout-set/fields/layout-list'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'layoutRecords' => (object) [
          'type' => 'hasMany',
          'entity' => 'LayoutRecord',
          'foreign' => 'layoutSet'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'foreign' => 'layoutSet'
        ],
        'portals' => (object) [
          'type' => 'hasMany',
          'entity' => 'Portal',
          'foreign' => 'layoutSet'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'LeadCapture' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'campaign' => (object) [
          'type' => 'link'
        ],
        'isActive' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'subscribeToTargetList' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'subscribeContactToTargetList' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'targetList' => (object) [
          'type' => 'link'
        ],
        'fieldList' => (object) [
          'type' => 'multiEnum',
          'default' => [
            0 => 'firstName',
            1 => 'lastName',
            2 => 'emailAddress'
          ],
          'view' => 'views/lead-capture/fields/field-list',
          'required' => true,
          'ignoreFieldList' => [
            0 => 'targetList',
            1 => 'targetLists',
            2 => 'acceptanceStatusMeetings',
            3 => 'acceptanceStatusCalls',
            4 => 'campaign',
            5 => 'source',
            6 => 'teams',
            7 => 'createdOpportunity',
            8 => 'createdAccount',
            9 => 'createdContact'
          ]
        ],
        'duplicateCheck' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'optInConfirmation' => (object) [
          'type' => 'bool'
        ],
        'optInConfirmationEmailTemplate' => (object) [
          'type' => 'link'
        ],
        'optInConfirmationLifetime' => (object) [
          'type' => 'int',
          'default' => 48,
          'min' => 1
        ],
        'optInConfirmationSuccessMessage' => (object) [
          'type' => 'text',
          'tooltip' => true
        ],
        'createLeadBeforeOptInConfirmation' => (object) [
          'type' => 'bool'
        ],
        'skipOptInConfirmationIfSubscribed' => (object) [
          'type' => 'bool'
        ],
        'leadSource' => (object) [
          'type' => 'enum',
          'customizationOptionsDisabled' => true,
          'optionsPath' => 'entityDefs.Lead.fields.source.options',
          'translation' => 'Lead.options.source',
          'default' => 'Web Site'
        ],
        'apiKey' => (object) [
          'type' => 'varchar',
          'maxLength' => 36,
          'readOnly' => true,
          'view' => 'views/lead-capture/fields/api-key'
        ],
        'targetTeam' => (object) [
          'type' => 'link'
        ],
        'exampleRequestUrl' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'readOnly' => true
        ],
        'exampleRequestMethod' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'readOnly' => true
        ],
        'exampleRequestPayload' => (object) [
          'type' => 'text',
          'notStorable' => true,
          'readOnly' => true,
          'seeMoreDisabled' => true
        ],
        'exampleRequestHeaders' => (object) [
          'type' => 'array',
          'notStorable' => true,
          'readOnly' => true
        ],
        'inboundEmail' => (object) [
          'type' => 'link'
        ],
        'smtpAccount' => (object) [
          'type' => 'base',
          'notStorable' => true,
          'view' => 'views/lead-capture/fields/smtp-account'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'targetList' => (object) [
          'type' => 'belongsTo',
          'entity' => 'TargetList'
        ],
        'campaign' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Campaign'
        ],
        'targetTeam' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Team'
        ],
        'inboundEmail' => (object) [
          'type' => 'belongsTo',
          'entity' => 'InboundEmail'
        ],
        'optInConfirmationEmailTemplate' => (object) [
          'type' => 'belongsTo',
          'entity' => 'EmailTemplate'
        ],
        'logRecords' => (object) [
          'type' => 'hasMany',
          'entity' => 'LeadCaptureLogRecord',
          'foreign' => 'leadCapture'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'LeadCaptureLogRecord' => (object) [
      'fields' => (object) [
        'number' => (object) [
          'type' => 'autoincrement',
          'index' => true,
          'readOnly' => true
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'isCreated' => (object) [
          'type' => 'bool'
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'leadCapture' => (object) [
          'type' => 'link'
        ],
        'target' => (object) [
          'type' => 'linkParent'
        ]
      ],
      'links' => (object) [
        'leadCapture' => (object) [
          'type' => 'belongsTo',
          'entity' => 'LeadCapture',
          'foreign' => 'logRecords'
        ],
        'target' => (object) [
          'type' => 'belongsToParent',
          'entityList' => [
            0 => 'Contact',
            1 => 'Lead'
          ]
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'number',
        'order' => 'desc',
        'sortBy' => 'number',
        'asc' => false
      ]
    ],
    'MassAction' => (object) [
      'fields' => (object) [
        'entityType' => (object) [
          'type' => 'varchar',
          'required' => true
        ],
        'action' => (object) [
          'type' => 'varchar',
          'required' => true
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Pending',
            1 => 'Running',
            2 => 'Success',
            3 => 'Failed'
          ],
          'default' => 'Pending'
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'params' => (object) [
          'type' => 'text'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'required' => true
        ],
        'processedCount' => (object) [
          'type' => 'int'
        ],
        'notifyOnFinish' => (object) [
          'type' => 'bool',
          'default' => false
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ]
    ],
    'NextNumber' => (object) [
      'fields' => (object) [
        'entityType' => (object) [
          'type' => 'varchar',
          'index' => true,
          'maxLength' => 100
        ],
        'fieldName' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'value' => (object) [
          'type' => 'int',
          'default' => 1
        ]
      ],
      'indexes' => (object) [
        'entityTypeFieldName' => (object) [
          'columns' => [
            0 => 'entityType',
            1 => 'fieldName'
          ]
        ]
      ]
    ],
    'Note' => (object) [
      'fields' => (object) [
        'post' => (object) [
          'type' => 'text',
          'rows' => 100000,
          'view' => 'views/note/fields/post',
          'customizationDefaultDisabled' => true,
          'customizationRequiredDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true,
          'customizationTooltipTextDisabled' => true,
          'customizationSeeMoreDisabledDisabled' => true,
          'customizationRowsDisabled' => true,
          'customizationDisplayRawTextDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'dynamicLogicDisabled' => true
        ],
        'data' => (object) [
          'type' => 'jsonObject',
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'type' => (object) [
          'type' => 'enum',
          'readOnly' => true,
          'view' => 'views/fields/enum',
          'options' => [
            0 => 'Post',
            1 => 'Create',
            2 => 'CreateRelated',
            3 => 'Update',
            4 => 'Status',
            5 => 'Assign',
            6 => 'Relate',
            7 => 'Unrelate',
            8 => 'EmailReceived',
            9 => 'EmailSent'
          ],
          'customizationDisabled' => true,
          'default' => 'Post'
        ],
        'targetType' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'self',
            1 => 'all',
            2 => 'teams',
            3 => 'users',
            4 => 'portals'
          ],
          'customizationDisabled' => true
        ],
        'parent' => (object) [
          'type' => 'linkParent',
          'customizationDisabled' => true
        ],
        'related' => (object) [
          'type' => 'linkParent',
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'attachments' => (object) [
          'type' => 'attachmentMultiple',
          'view' => 'views/stream/fields/attachment-multiple',
          'customizationRequiredDisabled' => true,
          'customizationPreviewSizeDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true,
          'customizationTooltipTextDisabled' => true,
          'dynamicLogicDisabled' => true
        ],
        'number' => (object) [
          'type' => 'autoincrement',
          'index' => true,
          'dbType' => 'bigint',
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'noLoad' => true,
          'customizationDisabled' => true
        ],
        'portals' => (object) [
          'type' => 'linkMultiple',
          'noLoad' => true,
          'customizationDisabled' => true
        ],
        'users' => (object) [
          'type' => 'linkMultiple',
          'noLoad' => true,
          'customizationDisabled' => true
        ],
        'isGlobal' => (object) [
          'type' => 'bool',
          'customizationDisabled' => true
        ],
        'createdByGender' => (object) [
          'type' => 'foreign',
          'link' => 'createdBy',
          'field' => 'gender',
          'customizationDisabled' => true
        ],
        'notifiedUserIdList' => (object) [
          'type' => 'jsonArray',
          'notStorable' => true,
          'utility' => true,
          'customizationDisabled' => true
        ],
        'isInternal' => (object) [
          'type' => 'bool',
          'customizationDisabled' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'customizationDisabled' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'customizationDisabled' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'attachments' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Attachment',
          'relationName' => 'attachments',
          'foreign' => 'parent'
        ],
        'parent' => (object) [
          'type' => 'belongsToParent',
          'foreign' => 'notes'
        ],
        'superParent' => (object) [
          'type' => 'belongsToParent'
        ],
        'related' => (object) [
          'type' => 'belongsToParent'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'foreign' => 'notes'
        ],
        'portals' => (object) [
          'type' => 'hasMany',
          'entity' => 'Portal',
          'foreign' => 'notes'
        ],
        'users' => (object) [
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'notes'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'number',
        'order' => 'desc',
        'textFilterFields' => [
          0 => 'post'
        ],
        'sortBy' => 'number',
        'asc' => false
      ],
      'statusStyles' => (object) [
        'Lead' => (object) [
          'Assigned' => 'primary',
          'In Process' => 'primary'
        ],
        'Case' => (object) [
          'Assigned' => 'primary'
        ],
        'Opportunity' => (object) [
          'Proposal' => 'primary',
          'Negotiation' => 'primary'
        ],
        'Task' => (object) [
          'Started' => 'primary',
          'Canceled' => 'danger'
        ]
      ],
      'indexes' => (object) [
        'createdAt' => (object) [
          'type' => 'index',
          'columns' => [
            0 => 'createdAt'
          ]
        ],
        'parent' => (object) [
          'type' => 'index',
          'columns' => [
            0 => 'parentId',
            1 => 'parentType'
          ]
        ],
        'parentAndSuperParent' => (object) [
          'type' => 'index',
          'columns' => [
            0 => 'parentId',
            1 => 'parentType',
            2 => 'superParentId',
            3 => 'superParentType'
          ]
        ],
        'createdByNumber' => (object) [
          'columns' => [
            0 => 'createdById',
            1 => 'number'
          ]
        ]
      ]
    ],
    'Notification' => (object) [
      'fields' => (object) [
        'number' => (object) [
          'type' => 'autoincrement',
          'dbType' => 'bigint',
          'index' => true
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'noteData' => (object) [
          'type' => 'jsonObject',
          'notStorable' => true
        ],
        'type' => (object) [
          'type' => 'varchar'
        ],
        'read' => (object) [
          'type' => 'bool'
        ],
        'emailIsProcessed' => (object) [
          'type' => 'bool'
        ],
        'user' => (object) [
          'type' => 'link'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'message' => (object) [
          'type' => 'text'
        ],
        'related' => (object) [
          'type' => 'linkParent',
          'readOnly' => true
        ],
        'relatedParent' => (object) [
          'type' => 'linkParent',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'user' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'related' => (object) [
          'type' => 'belongsToParent'
        ],
        'relatedParent' => (object) [
          'type' => 'belongsToParent'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'number',
        'order' => 'desc',
        'sortBy' => 'number',
        'asc' => false
      ],
      'indexes' => (object) [
        'createdAt' => (object) [
          'type' => 'index',
          'columns' => [
            0 => 'createdAt'
          ]
        ],
        'user' => (object) [
          'type' => 'index',
          'columns' => [
            0 => 'userId',
            1 => 'createdAt'
          ]
        ]
      ]
    ],
    'PasswordChangeRequest' => (object) [
      'fields' => (object) [
        'requestId' => (object) [
          'type' => 'varchar',
          'maxLength' => 64,
          'index' => true
        ],
        'user' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'index' => true
        ],
        'url' => (object) [
          'type' => 'url'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'user' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ]
    ],
    'PhoneNumber' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 36,
          'index' => true
        ],
        'type' => (object) [
          'type' => 'enum'
        ],
        'numeric' => (object) [
          'type' => 'varchar',
          'maxLength' => 36,
          'index' => true
        ],
        'invalid' => (object) [
          'type' => 'bool'
        ],
        'optOut' => (object) [
          'type' => 'bool'
        ],
        'primary' => (object) [
          'type' => 'bool',
          'notStorable' => true
        ]
      ],
      'links' => (object) [],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'Portal' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'pattern' => '$noBadCharacters'
        ],
        'logo' => (object) [
          'type' => 'image'
        ],
        'url' => (object) [
          'type' => 'url',
          'notStorable' => true,
          'readOnly' => true
        ],
        'customId' => (object) [
          'type' => 'varchar',
          'maxLength' => 36,
          'view' => 'views/portal/fields/custom-id',
          'index' => true
        ],
        'isActive' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'isDefault' => (object) [
          'type' => 'bool',
          'default' => false,
          'notStorable' => true
        ],
        'portalRoles' => (object) [
          'type' => 'linkMultiple'
        ],
        'tabList' => (object) [
          'type' => 'array',
          'view' => 'views/portal/fields/tab-list',
          'validationList' => [
            0 => 'array',
            1 => 'required'
          ],
          'suppressValidationList' => [
            0 => 'arrayOfString'
          ],
          'doNotStoreArrayValues' => true
        ],
        'quickCreateList' => (object) [
          'type' => 'array',
          'translation' => 'Global.scopeNames',
          'view' => 'views/portal/fields/quick-create-list'
        ],
        'companyLogo' => (object) [
          'type' => 'image'
        ],
        'theme' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/theme',
          'translation' => 'Global.themes'
        ],
        'themeParams' => (object) [
          'type' => 'jsonObject'
        ],
        'language' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/language'
        ],
        'timeZone' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/time-zone'
        ],
        'dateFormat' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/date-format'
        ],
        'timeFormat' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/time-format'
        ],
        'weekStart' => (object) [
          'type' => 'enumInt',
          'options' => [
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6
          ],
          'default' => -1,
          'view' => 'views/preferences/fields/week-start'
        ],
        'defaultCurrency' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/default-currency'
        ],
        'dashboardLayout' => (object) [
          'type' => 'jsonArray',
          'view' => 'views/settings/fields/dashboard-layout'
        ],
        'dashletsOptions' => (object) [
          'type' => 'jsonObject',
          'utility' => true
        ],
        'customUrl' => (object) [
          'type' => 'url'
        ],
        'layoutSet' => (object) [
          'type' => 'link',
          'tooltip' => true
        ],
        'authenticationProvider' => (object) [
          'type' => 'link'
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user'
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'users' => (object) [
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'portals'
        ],
        'portalRoles' => (object) [
          'type' => 'hasMany',
          'entity' => 'PortalRole',
          'foreign' => 'portals'
        ],
        'notes' => (object) [
          'type' => 'hasMany',
          'entity' => 'Note',
          'foreign' => 'portals'
        ],
        'layoutSet' => (object) [
          'type' => 'belongsTo',
          'entity' => 'LayoutSet',
          'foreign' => 'portals'
        ],
        'authenticationProvider' => (object) [
          'type' => 'belongsTo',
          'entity' => 'AuthenticationProvider'
        ],
        'articles' => (object) [
          'type' => 'hasMany',
          'entity' => 'KnowledgeBaseArticle',
          'foreign' => 'portals'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'PortalRole' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'maxLength' => 150,
          'required' => true,
          'type' => 'varchar',
          'pattern' => '$noBadCharacters'
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'fieldData' => (object) [
          'type' => 'jsonObject'
        ],
        'exportPermission' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'not-set',
            1 => 'yes',
            2 => 'no'
          ],
          'default' => 'not-set',
          'tooltip' => 'Role.exportPermission',
          'translation' => 'Role.options.levelList'
        ],
        'massUpdatePermission' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'not-set',
            1 => 'yes',
            2 => 'no'
          ],
          'default' => 'not-set',
          'tooltip' => 'Role.massUpdatePermission',
          'translation' => 'Role.options.levelList'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'users' => (object) [
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'portalRoles'
        ],
        'portals' => (object) [
          'type' => 'hasMany',
          'entity' => 'Portal',
          'foreign' => 'portalRoles'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'Preferences' => (object) [
      'fields' => (object) [
        'timeZone' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/time-zone'
        ],
        'dateFormat' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/date-format'
        ],
        'timeFormat' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/time-format'
        ],
        'weekStart' => (object) [
          'type' => 'enumInt',
          'options' => [
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6
          ],
          'default' => -1,
          'view' => 'views/preferences/fields/week-start'
        ],
        'defaultCurrency' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/default-currency'
        ],
        'thousandSeparator' => (object) [
          'type' => 'varchar',
          'default' => ',',
          'maxLength' => 1,
          'view' => 'views/settings/fields/thousand-separator',
          'options' => [
            0 => '.',
            1 => ',',
            2 => '\''
          ]
        ],
        'decimalMark' => (object) [
          'type' => 'varchar',
          'default' => '.',
          'required' => true,
          'maxLength' => 1,
          'options' => [
            0 => '.',
            1 => ','
          ]
        ],
        'dashboardLayout' => (object) [
          'type' => 'jsonArray',
          'view' => 'views/settings/fields/dashboard-layout'
        ],
        'dashletsOptions' => (object) [
          'type' => 'jsonObject'
        ],
        'dashboardLocked' => (object) [
          'type' => 'bool'
        ],
        'importParams' => (object) [
          'type' => 'jsonObject'
        ],
        'sharedCalendarUserList' => (object) [
          'type' => 'jsonArray'
        ],
        'calendarViewDataList' => (object) [
          'type' => 'jsonArray'
        ],
        'presetFilters' => (object) [
          'type' => 'jsonObject'
        ],
        'language' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/language'
        ],
        'exportDelimiter' => (object) [
          'type' => 'varchar',
          'default' => ',',
          'required' => true,
          'maxLength' => 1,
          'options' => [
            0 => ',',
            1 => ';',
            2 => '\\t',
            3 => '|'
          ]
        ],
        'receiveAssignmentEmailNotifications' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'receiveMentionEmailNotifications' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'receiveStreamEmailNotifications' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'assignmentNotificationsIgnoreEntityTypeList' => (object) [
          'type' => 'checklist',
          'translation' => 'Global.scopeNamesPlural',
          'view' => 'views/preferences/fields/assignment-notifications-ignore-entity-type-list',
          'default' => []
        ],
        'assignmentEmailNotificationsIgnoreEntityTypeList' => (object) [
          'type' => 'checklist',
          'translation' => 'Global.scopeNamesPlural',
          'view' => 'views/preferences/fields/assignment-email-notifications-ignore-entity-type-list'
        ],
        'autoFollowEntityTypeList' => (object) [
          'type' => 'multiEnum',
          'view' => 'views/preferences/fields/auto-follow-entity-type-list',
          'translation' => 'Global.scopeNamesPlural',
          'notStorable' => true,
          'tooltip' => true
        ],
        'signature' => (object) [
          'type' => 'wysiwyg',
          'view' => 'views/preferences/fields/signature'
        ],
        'defaultReminders' => (object) [
          'type' => 'jsonArray',
          'view' => 'crm:views/meeting/fields/reminders',
          'default' => []
        ],
        'theme' => (object) [
          'type' => 'enum',
          'view' => 'views/preferences/fields/theme',
          'translation' => 'Global.themes'
        ],
        'themeParams' => (object) [
          'type' => 'jsonObject'
        ],
        'useCustomTabList' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'tabList' => (object) [
          'type' => 'array',
          'view' => 'views/preferences/fields/tab-list',
          'validationList' => [
            0 => 'array',
            1 => 'required'
          ],
          'mandatoryValidationList' => [
            0 => 'array'
          ]
        ],
        'emailReplyToAllByDefault' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'emailReplyForceHtml' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'isPortalUser' => (object) [
          'type' => 'bool',
          'notStorable' => true
        ],
        'doNotFillAssignedUserIfNotRequired' => (object) [
          'type' => 'bool',
          'tooltip' => true,
          'default' => true
        ],
        'followEntityOnStreamPost' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'followCreatedEntities' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'followCreatedEntityTypeList' => (object) [
          'type' => 'multiEnum',
          'view' => 'views/preferences/fields/auto-follow-entity-type-list',
          'translation' => 'Global.scopeNamesPlural',
          'default' => [],
          'tooltip' => true
        ],
        'emailUseExternalClient' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'scopeColorsDisabled' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'tabColorsDisabled' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'textSearchStoringDisabled' => (object) [
          'type' => 'bool',
          'default' => false
        ]
      ],
      'noDeletedAttribute' => true,
      'modifierClassName' => 'Espo\\Core\\Utils\\Database\\Schema\\EntityDefsModifiers\\JsonData'
    ],
    'Role' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'maxLength' => 150,
          'required' => true,
          'type' => 'varchar',
          'pattern' => '$noBadCharacters'
        ],
        'assignmentPermission' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'not-set',
            1 => 'all',
            2 => 'team',
            3 => 'no'
          ],
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList'
        ],
        'userPermission' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'not-set',
            1 => 'all',
            2 => 'team',
            3 => 'no'
          ],
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList'
        ],
        'messagePermission' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'not-set',
            1 => 'all',
            2 => 'team',
            3 => 'no'
          ],
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList'
        ],
        'portalPermission' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'not-set',
            1 => 'yes',
            2 => 'no'
          ],
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList'
        ],
        'groupEmailAccountPermission' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'not-set',
            1 => 'all',
            2 => 'team',
            3 => 'no'
          ],
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList'
        ],
        'exportPermission' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'not-set',
            1 => 'yes',
            2 => 'no'
          ],
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList'
        ],
        'massUpdatePermission' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'not-set',
            1 => 'yes',
            2 => 'no'
          ],
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList'
        ],
        'dataPrivacyPermission' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'not-set',
            1 => 'yes',
            2 => 'no'
          ],
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList'
        ],
        'followerManagementPermission' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'not-set',
            1 => 'all',
            2 => 'team',
            3 => 'no'
          ],
          'default' => 'not-set',
          'tooltip' => true,
          'translation' => 'Role.options.levelList'
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'fieldData' => (object) [
          'type' => 'jsonObject'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'users' => (object) [
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'roles'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'foreign' => 'roles'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'ScheduledJob' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true
        ],
        'job' => (object) [
          'type' => 'varchar',
          'required' => true,
          'view' => 'views/scheduled-job/fields/job'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Active',
            1 => 'Inactive'
          ],
          'default' => 'Active'
        ],
        'scheduling' => (object) [
          'type' => 'varchar',
          'required' => true,
          'view' => 'views/scheduled-job/fields/scheduling',
          'tooltip' => true
        ],
        'lastRun' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'isInternal' => (object) [
          'type' => 'bool',
          'readOnly' => true,
          'disabled' => true,
          'default' => false
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'log' => (object) [
          'type' => 'hasMany',
          'entity' => 'ScheduledJobLogRecord',
          'foreign' => 'scheduledJob'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ],
      'jobSchedulingMap' => (object) [
        'CheckInboundEmails' => '*/2 * * * *',
        'CheckEmailAccounts' => '*/1 * * * *',
        'SendEmailReminders' => '*/2 * * * *',
        'Cleanup' => '1 1 * * 0',
        'AuthTokenControl' => '*/6 * * * *',
        'SendEmailNotifications' => '*/2 * * * *',
        'ProcessWebhookQueue' => '*/5 * * * *',
        'ProcessMassEmail' => '15 * * * *',
        'ControlKnowledgeBaseArticleStatus' => '10 1 * * *'
      ],
      'jobs' => (object) [
        'SubmitPopupReminders' => (object) [
          'name' => 'Submit Popup Reminders',
          'isSystem' => true,
          'scheduling' => '* * * * *'
        ]
      ]
    ],
    'ScheduledJobLogRecord' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'readOnly' => true
        ],
        'status' => (object) [
          'type' => 'enum',
          'readOnly' => true,
          'options' => [
            0 => 'Success',
            1 => 'Failed'
          ],
          'style' => (object) [
            'Success' => 'success',
            'Failed' => 'danger'
          ]
        ],
        'executionTime' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'hasSeconds' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'scheduledJob' => (object) [
          'type' => 'link'
        ],
        'target' => (object) [
          'type' => 'linkParent'
        ]
      ],
      'links' => (object) [
        'scheduledJob' => (object) [
          'type' => 'belongsTo',
          'entity' => 'ScheduledJob'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'executionTime',
        'order' => 'desc',
        'sortBy' => 'executionTime',
        'asc' => false
      ],
      'indexes' => (object) [
        'scheduledJobIdExecutionTime' => (object) [
          'type' => 'index',
          'columns' => [
            0 => 'scheduledJobId',
            1 => 'executionTime'
          ]
        ]
      ]
    ],
    'Settings' => (object) [
      'skipRebuild' => true,
      'fields' => (object) [
        'useCache' => (object) [
          'type' => 'bool',
          'default' => true,
          'tooltip' => true
        ],
        'recordsPerPage' => (object) [
          'type' => 'int',
          'min' => 1,
          'max' => 200,
          'default' => 20,
          'required' => true,
          'tooltip' => true
        ],
        'recordsPerPageSmall' => (object) [
          'type' => 'int',
          'min' => 1,
          'max' => 100,
          'default' => 5,
          'required' => true,
          'tooltip' => true
        ],
        'recordsPerPageSelect' => (object) [
          'type' => 'int',
          'min' => 1,
          'max' => 100,
          'default' => 10,
          'required' => true,
          'tooltip' => true
        ],
        'recordsPerPageKanban' => (object) [
          'type' => 'int',
          'min' => 1,
          'max' => 100,
          'required' => true,
          'tooltip' => true
        ],
        'timeZone' => (object) [
          'type' => 'enum',
          'default' => 'UTC',
          'options' => [
            0 => 'UTC',
            1 => 'Africa/Abidjan',
            2 => 'Africa/Accra',
            3 => 'Africa/Addis_Ababa',
            4 => 'Africa/Algiers',
            5 => 'Africa/Asmara',
            6 => 'Africa/Bamako',
            7 => 'Africa/Bangui',
            8 => 'Africa/Banjul',
            9 => 'Africa/Bissau',
            10 => 'Africa/Blantyre',
            11 => 'Africa/Brazzaville',
            12 => 'Africa/Bujumbura',
            13 => 'Africa/Cairo',
            14 => 'Africa/Casablanca',
            15 => 'Africa/Ceuta',
            16 => 'Africa/Conakry',
            17 => 'Africa/Dakar',
            18 => 'Africa/Dar_es_Salaam',
            19 => 'Africa/Djibouti',
            20 => 'Africa/Douala',
            21 => 'Africa/El_Aaiun',
            22 => 'Africa/Freetown',
            23 => 'Africa/Gaborone',
            24 => 'Africa/Harare',
            25 => 'Africa/Johannesburg',
            26 => 'Africa/Juba',
            27 => 'Africa/Kampala',
            28 => 'Africa/Khartoum',
            29 => 'Africa/Kigali',
            30 => 'Africa/Kinshasa',
            31 => 'Africa/Lagos',
            32 => 'Africa/Libreville',
            33 => 'Africa/Lome',
            34 => 'Africa/Luanda',
            35 => 'Africa/Lubumbashi',
            36 => 'Africa/Lusaka',
            37 => 'Africa/Malabo',
            38 => 'Africa/Maputo',
            39 => 'Africa/Maseru',
            40 => 'Africa/Mbabane',
            41 => 'Africa/Mogadishu',
            42 => 'Africa/Monrovia',
            43 => 'Africa/Nairobi',
            44 => 'Africa/Ndjamena',
            45 => 'Africa/Niamey',
            46 => 'Africa/Nouakchott',
            47 => 'Africa/Ouagadougou',
            48 => 'Africa/Porto-Novo',
            49 => 'Africa/Sao_Tome',
            50 => 'Africa/Tripoli',
            51 => 'Africa/Tunis',
            52 => 'Africa/Windhoek',
            53 => 'America/Adak',
            54 => 'America/Anchorage',
            55 => 'America/Anguilla',
            56 => 'America/Antigua',
            57 => 'America/Araguaina',
            58 => 'America/Argentina/Buenos_Aires',
            59 => 'America/Argentina/Catamarca',
            60 => 'America/Argentina/Cordoba',
            61 => 'America/Argentina/Jujuy',
            62 => 'America/Argentina/La_Rioja',
            63 => 'America/Argentina/Mendoza',
            64 => 'America/Argentina/Rio_Gallegos',
            65 => 'America/Argentina/Salta',
            66 => 'America/Argentina/San_Juan',
            67 => 'America/Argentina/San_Luis',
            68 => 'America/Argentina/Tucuman',
            69 => 'America/Argentina/Ushuaia',
            70 => 'America/Aruba',
            71 => 'America/Asuncion',
            72 => 'America/Atikokan',
            73 => 'America/Bahia',
            74 => 'America/Bahia_Banderas',
            75 => 'America/Barbados',
            76 => 'America/Belem',
            77 => 'America/Belize',
            78 => 'America/Blanc-Sablon',
            79 => 'America/Boa_Vista',
            80 => 'America/Bogota',
            81 => 'America/Boise',
            82 => 'America/Cambridge_Bay',
            83 => 'America/Campo_Grande',
            84 => 'America/Cancun',
            85 => 'America/Caracas',
            86 => 'America/Cayenne',
            87 => 'America/Cayman',
            88 => 'America/Chicago',
            89 => 'America/Chihuahua',
            90 => 'America/Costa_Rica',
            91 => 'America/Creston',
            92 => 'America/Cuiaba',
            93 => 'America/Curacao',
            94 => 'America/Danmarkshavn',
            95 => 'America/Dawson',
            96 => 'America/Dawson_Creek',
            97 => 'America/Denver',
            98 => 'America/Detroit',
            99 => 'America/Dominica',
            100 => 'America/Edmonton',
            101 => 'America/Eirunepe',
            102 => 'America/El_Salvador',
            103 => 'America/Fortaleza',
            104 => 'America/Glace_Bay',
            105 => 'America/Godthab',
            106 => 'America/Goose_Bay',
            107 => 'America/Grand_Turk',
            108 => 'America/Grenada',
            109 => 'America/Guadeloupe',
            110 => 'America/Guatemala',
            111 => 'America/Guayaquil',
            112 => 'America/Guyana',
            113 => 'America/Halifax',
            114 => 'America/Havana',
            115 => 'America/Hermosillo',
            116 => 'America/Indiana/Indianapolis',
            117 => 'America/Indiana/Knox',
            118 => 'America/Indiana/Marengo',
            119 => 'America/Indiana/Petersburg',
            120 => 'America/Indiana/Tell_City',
            121 => 'America/Indiana/Vevay',
            122 => 'America/Indiana/Vincennes',
            123 => 'America/Indiana/Winamac',
            124 => 'America/Inuvik',
            125 => 'America/Iqaluit',
            126 => 'America/Jamaica',
            127 => 'America/Juneau',
            128 => 'America/Kentucky/Louisville',
            129 => 'America/Kentucky/Monticello',
            130 => 'America/Kralendijk',
            131 => 'America/La_Paz',
            132 => 'America/Lima',
            133 => 'America/Los_Angeles',
            134 => 'America/Lower_Princes',
            135 => 'America/Maceio',
            136 => 'America/Managua',
            137 => 'America/Manaus',
            138 => 'America/Marigot',
            139 => 'America/Martinique',
            140 => 'America/Matamoros',
            141 => 'America/Mazatlan',
            142 => 'America/Menominee',
            143 => 'America/Merida',
            144 => 'America/Metlakatla',
            145 => 'America/Mexico_City',
            146 => 'America/Miquelon',
            147 => 'America/Moncton',
            148 => 'America/Monterrey',
            149 => 'America/Montevideo',
            150 => 'America/Montserrat',
            151 => 'America/Nassau',
            152 => 'America/New_York',
            153 => 'America/Nipigon',
            154 => 'America/Nome',
            155 => 'America/Noronha',
            156 => 'America/North_Dakota/Beulah',
            157 => 'America/North_Dakota/Center',
            158 => 'America/North_Dakota/New_Salem',
            159 => 'America/Ojinaga',
            160 => 'America/Panama',
            161 => 'America/Pangnirtung',
            162 => 'America/Paramaribo',
            163 => 'America/Phoenix',
            164 => 'America/Port-au-Prince',
            165 => 'America/Port_of_Spain',
            166 => 'America/Porto_Velho',
            167 => 'America/Puerto_Rico',
            168 => 'America/Rainy_River',
            169 => 'America/Rankin_Inlet',
            170 => 'America/Recife',
            171 => 'America/Regina',
            172 => 'America/Resolute',
            173 => 'America/Rio_Branco',
            174 => 'America/Santa_Isabel',
            175 => 'America/Santarem',
            176 => 'America/Santiago',
            177 => 'America/Santo_Domingo',
            178 => 'America/Sao_Paulo',
            179 => 'America/Scoresbysund',
            180 => 'America/Sitka',
            181 => 'America/St_Barthelemy',
            182 => 'America/St_Johns',
            183 => 'America/St_Kitts',
            184 => 'America/St_Lucia',
            185 => 'America/St_Thomas',
            186 => 'America/St_Vincent',
            187 => 'America/Swift_Current',
            188 => 'America/Tegucigalpa',
            189 => 'America/Thule',
            190 => 'America/Thunder_Bay',
            191 => 'America/Tijuana',
            192 => 'America/Toronto',
            193 => 'America/Tortola',
            194 => 'America/Vancouver',
            195 => 'America/Whitehorse',
            196 => 'America/Winnipeg',
            197 => 'America/Yakutat',
            198 => 'America/Yellowknife',
            199 => 'Antarctica/Casey',
            200 => 'Antarctica/Davis',
            201 => 'Antarctica/DumontDUrville',
            202 => 'Antarctica/Macquarie',
            203 => 'Antarctica/Mawson',
            204 => 'Antarctica/McMurdo',
            205 => 'Antarctica/Palmer',
            206 => 'Antarctica/Rothera',
            207 => 'Antarctica/Syowa',
            208 => 'Antarctica/Vostok',
            209 => 'Arctic/Longyearbyen',
            210 => 'Asia/Aden',
            211 => 'Asia/Almaty',
            212 => 'Asia/Amman',
            213 => 'Asia/Anadyr',
            214 => 'Asia/Aqtau',
            215 => 'Asia/Aqtobe',
            216 => 'Asia/Ashgabat',
            217 => 'Asia/Baghdad',
            218 => 'Asia/Bahrain',
            219 => 'Asia/Baku',
            220 => 'Asia/Bangkok',
            221 => 'Asia/Beirut',
            222 => 'Asia/Bishkek',
            223 => 'Asia/Brunei',
            224 => 'Asia/Choibalsan',
            225 => 'Asia/Chongqing',
            226 => 'Asia/Colombo',
            227 => 'Asia/Damascus',
            228 => 'Asia/Dhaka',
            229 => 'Asia/Dili',
            230 => 'Asia/Dubai',
            231 => 'Asia/Dushanbe',
            232 => 'Asia/Gaza',
            233 => 'Asia/Harbin',
            234 => 'Asia/Hebron',
            235 => 'Asia/Ho_Chi_Minh',
            236 => 'Asia/Hong_Kong',
            237 => 'Asia/Hovd',
            238 => 'Asia/Irkutsk',
            239 => 'Asia/Jakarta',
            240 => 'Asia/Jayapura',
            241 => 'Asia/Jerusalem',
            242 => 'Asia/Kabul',
            243 => 'Asia/Kamchatka',
            244 => 'Asia/Karachi',
            245 => 'Asia/Kashgar',
            246 => 'Asia/Kathmandu',
            247 => 'Asia/Khandyga',
            248 => 'Asia/Kolkata',
            249 => 'Asia/Krasnoyarsk',
            250 => 'Asia/Kuala_Lumpur',
            251 => 'Asia/Kuching',
            252 => 'Asia/Kuwait',
            253 => 'Asia/Macau',
            254 => 'Asia/Magadan',
            255 => 'Asia/Makassar',
            256 => 'Asia/Manila',
            257 => 'Asia/Muscat',
            258 => 'Asia/Nicosia',
            259 => 'Asia/Novokuznetsk',
            260 => 'Asia/Novosibirsk',
            261 => 'Asia/Omsk',
            262 => 'Asia/Oral',
            263 => 'Asia/Phnom_Penh',
            264 => 'Asia/Pontianak',
            265 => 'Asia/Pyongyang',
            266 => 'Asia/Qatar',
            267 => 'Asia/Qyzylorda',
            268 => 'Asia/Rangoon',
            269 => 'Asia/Riyadh',
            270 => 'Asia/Sakhalin',
            271 => 'Asia/Samarkand',
            272 => 'Asia/Seoul',
            273 => 'Asia/Shanghai',
            274 => 'Asia/Singapore',
            275 => 'Asia/Taipei',
            276 => 'Asia/Tashkent',
            277 => 'Asia/Tbilisi',
            278 => 'Asia/Tehran',
            279 => 'Asia/Thimphu',
            280 => 'Asia/Tokyo',
            281 => 'Asia/Ulaanbaatar',
            282 => 'Asia/Urumqi',
            283 => 'Asia/Ust-Nera',
            284 => 'Asia/Vientiane',
            285 => 'Asia/Vladivostok',
            286 => 'Asia/Yakutsk',
            287 => 'Asia/Yekaterinburg',
            288 => 'Asia/Yerevan',
            289 => 'Atlantic/Azores',
            290 => 'Atlantic/Bermuda',
            291 => 'Atlantic/Canary',
            292 => 'Atlantic/Cape_Verde',
            293 => 'Atlantic/Faroe',
            294 => 'Atlantic/Madeira',
            295 => 'Atlantic/Reykjavik',
            296 => 'Atlantic/South_Georgia',
            297 => 'Atlantic/St_Helena',
            298 => 'Atlantic/Stanley',
            299 => 'Australia/Adelaide',
            300 => 'Australia/Brisbane',
            301 => 'Australia/Broken_Hill',
            302 => 'Australia/Currie',
            303 => 'Australia/Darwin',
            304 => 'Australia/Eucla',
            305 => 'Australia/Hobart',
            306 => 'Australia/Lindeman',
            307 => 'Australia/Lord_Howe',
            308 => 'Australia/Melbourne',
            309 => 'Australia/Perth',
            310 => 'Australia/Sydney',
            311 => 'Europe/Amsterdam',
            312 => 'Europe/Andorra',
            313 => 'Europe/Athens',
            314 => 'Europe/Belgrade',
            315 => 'Europe/Berlin',
            316 => 'Europe/Bratislava',
            317 => 'Europe/Brussels',
            318 => 'Europe/Bucharest',
            319 => 'Europe/Budapest',
            320 => 'Europe/Busingen',
            321 => 'Europe/Chisinau',
            322 => 'Europe/Copenhagen',
            323 => 'Europe/Dublin',
            324 => 'Europe/Gibraltar',
            325 => 'Europe/Guernsey',
            326 => 'Europe/Helsinki',
            327 => 'Europe/Isle_of_Man',
            328 => 'Europe/Istanbul',
            329 => 'Europe/Jersey',
            330 => 'Europe/Kaliningrad',
            331 => 'Europe/Kiev',
            332 => 'Europe/Lisbon',
            333 => 'Europe/Ljubljana',
            334 => 'Europe/London',
            335 => 'Europe/Luxembourg',
            336 => 'Europe/Madrid',
            337 => 'Europe/Malta',
            338 => 'Europe/Mariehamn',
            339 => 'Europe/Minsk',
            340 => 'Europe/Monaco',
            341 => 'Europe/Moscow',
            342 => 'Europe/Oslo',
            343 => 'Europe/Paris',
            344 => 'Europe/Podgorica',
            345 => 'Europe/Prague',
            346 => 'Europe/Riga',
            347 => 'Europe/Rome',
            348 => 'Europe/Samara',
            349 => 'Europe/San_Marino',
            350 => 'Europe/Sarajevo',
            351 => 'Europe/Simferopol',
            352 => 'Europe/Skopje',
            353 => 'Europe/Sofia',
            354 => 'Europe/Stockholm',
            355 => 'Europe/Tallinn',
            356 => 'Europe/Tirane',
            357 => 'Europe/Uzhgorod',
            358 => 'Europe/Vaduz',
            359 => 'Europe/Vatican',
            360 => 'Europe/Vienna',
            361 => 'Europe/Vilnius',
            362 => 'Europe/Volgograd',
            363 => 'Europe/Warsaw',
            364 => 'Europe/Zagreb',
            365 => 'Europe/Zaporozhye',
            366 => 'Europe/Zurich',
            367 => 'Indian/Antananarivo',
            368 => 'Indian/Chagos',
            369 => 'Indian/Christmas',
            370 => 'Indian/Cocos',
            371 => 'Indian/Comoro',
            372 => 'Indian/Kerguelen',
            373 => 'Indian/Mahe',
            374 => 'Indian/Maldives',
            375 => 'Indian/Mauritius',
            376 => 'Indian/Mayotte',
            377 => 'Indian/Reunion',
            378 => 'Pacific/Apia',
            379 => 'Pacific/Auckland',
            380 => 'Pacific/Chatham',
            381 => 'Pacific/Chuuk',
            382 => 'Pacific/Easter',
            383 => 'Pacific/Efate',
            384 => 'Pacific/Enderbury',
            385 => 'Pacific/Fakaofo',
            386 => 'Pacific/Fiji',
            387 => 'Pacific/Funafuti',
            388 => 'Pacific/Galapagos',
            389 => 'Pacific/Gambier',
            390 => 'Pacific/Guadalcanal',
            391 => 'Pacific/Guam',
            392 => 'Pacific/Honolulu',
            393 => 'Pacific/Johnston',
            394 => 'Pacific/Kiritimati',
            395 => 'Pacific/Kosrae',
            396 => 'Pacific/Kwajalein',
            397 => 'Pacific/Majuro',
            398 => 'Pacific/Marquesas',
            399 => 'Pacific/Midway',
            400 => 'Pacific/Nauru',
            401 => 'Pacific/Niue',
            402 => 'Pacific/Norfolk',
            403 => 'Pacific/Noumea',
            404 => 'Pacific/Pago_Pago',
            405 => 'Pacific/Palau',
            406 => 'Pacific/Pitcairn',
            407 => 'Pacific/Pohnpei',
            408 => 'Pacific/Port_Moresby',
            409 => 'Pacific/Rarotonga',
            410 => 'Pacific/Saipan',
            411 => 'Pacific/Tahiti',
            412 => 'Pacific/Tarawa',
            413 => 'Pacific/Tongatapu',
            414 => 'Pacific/Wake',
            415 => 'Pacific/Wallis'
          ]
        ],
        'dateFormat' => (object) [
          'type' => 'enum',
          'default' => 'DD.MM.YYYY',
          'view' => 'views/settings/fields/date-format'
        ],
        'timeFormat' => (object) [
          'type' => 'enum',
          'default' => 'HH:mm',
          'view' => 'views/settings/fields/time-format'
        ],
        'weekStart' => (object) [
          'type' => 'enumInt',
          'options' => [
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6
          ],
          'default' => 0,
          'translation' => 'Global.lists.dayNames'
        ],
        'fiscalYearShift' => (object) [
          'type' => 'enumInt',
          'default' => 0,
          'view' => 'views/settings/fields/fiscal-year-shift'
        ],
        'thousandSeparator' => (object) [
          'type' => 'varchar',
          'default' => ',',
          'maxLength' => 1,
          'view' => 'views/settings/fields/thousand-separator',
          'options' => [
            0 => '.',
            1 => ',',
            2 => '\''
          ]
        ],
        'decimalMark' => (object) [
          'type' => 'varchar',
          'default' => '.',
          'required' => true,
          'maxLength' => 1,
          'options' => [
            0 => '.',
            1 => ','
          ]
        ],
        'currencyList' => (object) [
          'type' => 'multiEnum',
          'default' => [
            0 => 'USD',
            1 => 'EUR'
          ],
          'required' => true,
          'view' => 'views/settings/fields/currency-list',
          'tooltip' => true
        ],
        'defaultCurrency' => (object) [
          'type' => 'enum',
          'default' => 'USD',
          'required' => true,
          'view' => 'views/settings/fields/default-currency'
        ],
        'baseCurrency' => (object) [
          'type' => 'enum',
          'default' => 'USD',
          'required' => true,
          'view' => 'views/settings/fields/default-currency'
        ],
        'currencyRates' => (object) [
          'type' => 'base',
          'view' => 'views/settings/fields/currency-rates'
        ],
        'outboundEmailIsShared' => (object) [
          'type' => 'bool',
          'default' => false,
          'tooltip' => true
        ],
        'outboundEmailFromName' => (object) [
          'type' => 'varchar',
          'default' => 'EspoCRM'
        ],
        'outboundEmailFromAddress' => (object) [
          'type' => 'varchar',
          'default' => 'crm@example.com',
          'tooltip' => true,
          'view' => 'views/settings/fields/outbound-email-from-address'
        ],
        'emailAddressLookupEntityTypeList' => (object) [
          'type' => 'multiEnum',
          'tooltip' => true,
          'view' => 'views/settings/fields/email-address-lookup-entity-type-list'
        ],
        'smtpServer' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'smtpPort' => (object) [
          'type' => 'int',
          'min' => 0,
          'max' => 65535,
          'default' => 587
        ],
        'smtpAuth' => (object) [
          'type' => 'bool'
        ],
        'smtpSecurity' => (object) [
          'type' => 'enum',
          'default' => 'TLS',
          'options' => [
            0 => '',
            1 => 'SSL',
            2 => 'TLS'
          ]
        ],
        'smtpUsername' => (object) [
          'type' => 'varchar'
        ],
        'smtpPassword' => (object) [
          'type' => 'password'
        ],
        'tabList' => (object) [
          'type' => 'array',
          'view' => 'views/settings/fields/tab-list',
          'validationList' => [
            0 => 'array',
            1 => 'required'
          ],
          'mandatoryValidationList' => [
            0 => 'array'
          ]
        ],
        'quickCreateList' => (object) [
          'type' => 'array',
          'translation' => 'Global.scopeNames',
          'view' => 'views/settings/fields/quick-create-list'
        ],
        'language' => (object) [
          'type' => 'enum',
          'default' => 'en_US',
          'view' => 'views/settings/fields/language',
          'isSorted' => true
        ],
        'globalSearchEntityList' => (object) [
          'type' => 'multiEnum',
          'translation' => 'Global.scopeNames',
          'view' => 'views/settings/fields/global-search-entity-list',
          'tooltip' => true
        ],
        'exportDelimiter' => (object) [
          'type' => 'varchar',
          'default' => ',',
          'required' => true,
          'maxLength' => 1
        ],
        'companyLogo' => (object) [
          'type' => 'image'
        ],
        'authenticationMethod' => (object) [
          'type' => 'enum',
          'default' => 'Espo',
          'view' => 'views/settings/fields/authentication-method'
        ],
        'auth2FA' => (object) [
          'type' => 'bool'
        ],
        'auth2FAMethodList' => (object) [
          'type' => 'multiEnum',
          'view' => 'views/settings/fields/auth-two-fa-method-list'
        ],
        'auth2FAForced' => (object) [
          'type' => 'bool'
        ],
        'auth2FAInPortal' => (object) [
          'type' => 'bool'
        ],
        'passwordRecoveryDisabled' => (object) [
          'type' => 'bool'
        ],
        'passwordRecoveryForAdminDisabled' => (object) [
          'type' => 'bool'
        ],
        'passwordRecoveryForInternalUsersDisabled' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'passwordRecoveryNoExposure' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'passwordGenerateLength' => (object) [
          'type' => 'int',
          'min' => 6,
          'max' => 150,
          'required' => true
        ],
        'passwordStrengthLength' => (object) [
          'type' => 'int',
          'max' => 150,
          'min' => 1
        ],
        'passwordStrengthLetterCount' => (object) [
          'type' => 'int',
          'max' => 150,
          'min' => 0
        ],
        'passwordStrengthNumberCount' => (object) [
          'type' => 'int',
          'max' => 150,
          'min' => 0
        ],
        'passwordStrengthBothCases' => (object) [
          'type' => 'bool'
        ],
        'ldapHost' => (object) [
          'type' => 'varchar'
        ],
        'ldapPort' => (object) [
          'type' => 'varchar',
          'default' => 389
        ],
        'ldapSecurity' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'SSL',
            2 => 'TLS'
          ]
        ],
        'ldapAuth' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'ldapUsername' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapPassword' => (object) [
          'type' => 'password',
          'tooltip' => true
        ],
        'ldapBindRequiresDn' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'ldapUserLoginFilter' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapBaseDn' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapAccountCanonicalForm' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Dn',
            1 => 'Username',
            2 => 'Backslash',
            3 => 'Principal'
          ],
          'tooltip' => true
        ],
        'ldapAccountDomainName' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapAccountDomainNameShort' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapAccountFilterFormat' => (object) [
          'type' => 'varchar'
        ],
        'ldapTryUsernameSplit' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'ldapOptReferrals' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'ldapPortalUserLdapAuth' => (object) [
          'type' => 'bool',
          'default' => false,
          'tooltip' => true
        ],
        'ldapCreateEspoUser' => (object) [
          'type' => 'bool',
          'default' => true,
          'tooltip' => true
        ],
        'ldapUserNameAttribute' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapUserObjectClass' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapUserFirstNameAttribute' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapUserLastNameAttribute' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapUserTitleAttribute' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapUserEmailAddressAttribute' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapUserPhoneNumberAttribute' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'ldapUserDefaultTeam' => (object) [
          'type' => 'link',
          'tooltip' => true,
          'entity' => 'Team'
        ],
        'ldapUserTeams' => (object) [
          'type' => 'linkMultiple',
          'tooltip' => true,
          'entity' => 'Team'
        ],
        'ldapPortalUserPortals' => (object) [
          'type' => 'linkMultiple',
          'tooltip' => true,
          'entity' => 'Portal'
        ],
        'ldapPortalUserRoles' => (object) [
          'type' => 'linkMultiple',
          'tooltip' => true,
          'entity' => 'PortalRole'
        ],
        'exportDisabled' => (object) [
          'type' => 'bool',
          'default' => false,
          'tooltip' => true
        ],
        'emailNotificationsDelay' => (object) [
          'type' => 'int',
          'min' => 0,
          'max' => 18000,
          'tooltip' => true
        ],
        'assignmentEmailNotifications' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'assignmentEmailNotificationsEntityList' => (object) [
          'type' => 'multiEnum',
          'translation' => 'Global.scopeNamesPlural',
          'view' => 'views/settings/fields/assignment-email-notifications-entity-list'
        ],
        'assignmentNotificationsEntityList' => (object) [
          'type' => 'multiEnum',
          'translation' => 'Global.scopeNamesPlural',
          'view' => 'views/settings/fields/assignment-notifications-entity-list'
        ],
        'postEmailNotifications' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'updateEmailNotifications' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'mentionEmailNotifications' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'streamEmailNotifications' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'portalStreamEmailNotifications' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'streamEmailNotificationsEntityList' => (object) [
          'type' => 'multiEnum',
          'translation' => 'Global.scopeNamesPlural',
          'view' => 'views/settings/fields/stream-email-notifications-entity-list',
          'tooltip' => true
        ],
        'streamEmailNotificationsTypeList' => (object) [
          'type' => 'multiEnum',
          'options' => [
            0 => 'Post',
            1 => 'Status',
            2 => 'EmailReceived'
          ]
        ],
        'newNotificationCountInTitle' => (object) [
          'type' => 'bool'
        ],
        'b2cMode' => (object) [
          'type' => 'bool',
          'default' => false,
          'tooltip' => true
        ],
        'avatarsDisabled' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'followCreatedEntities' => (object) [
          'type' => 'bool',
          'default' => false,
          'tooltip' => true
        ],
        'adminPanelIframeUrl' => (object) [
          'type' => 'varchar'
        ],
        'displayListViewRecordCount' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'userThemesDisabled' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'theme' => (object) [
          'type' => 'enum',
          'view' => 'views/settings/fields/theme',
          'translation' => 'Global.themes'
        ],
        'themeParams' => (object) [
          'type' => 'jsonObject'
        ],
        'attachmentUploadMaxSize' => (object) [
          'type' => 'float',
          'min' => 0
        ],
        'attachmentUploadChunkSize' => (object) [
          'type' => 'float',
          'min' => 0
        ],
        'emailMessageMaxSize' => (object) [
          'type' => 'float',
          'min' => 0,
          'tooltip' => true
        ],
        'inboundEmailMaxPortionSize' => (object) [
          'type' => 'int',
          'min' => 1,
          'max' => 500
        ],
        'personalEmailMaxPortionSize' => (object) [
          'type' => 'int',
          'min' => 1,
          'max' => 500
        ],
        'maxEmailAccountCount' => (object) [
          'type' => 'int'
        ],
        'massEmailMaxPerHourCount' => (object) [
          'type' => 'int',
          'min' => 1
        ],
        'massEmailVerp' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'authTokenLifetime' => (object) [
          'type' => 'float',
          'min' => 0,
          'default' => 0,
          'tooltip' => true
        ],
        'authTokenMaxIdleTime' => (object) [
          'type' => 'float',
          'min' => 0,
          'default' => 0,
          'tooltip' => true
        ],
        'authTokenPreventConcurrent' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'dashboardLayout' => (object) [
          'type' => 'jsonArray',
          'view' => 'views/settings/fields/dashboard-layout'
        ],
        'dashletsOptions' => (object) [
          'type' => 'jsonObject',
          'disabled' => true
        ],
        'siteUrl' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'applicationName' => (object) [
          'type' => 'varchar'
        ],
        'readableDateFormatDisabled' => (object) [
          'type' => 'bool'
        ],
        'addressFormat' => (object) [
          'type' => 'enumInt',
          'options' => [
            0 => 1,
            1 => 2,
            2 => 3,
            3 => 4
          ]
        ],
        'addressPreview' => (object) [
          'type' => 'address',
          'notStorable' => true,
          'readOnly' => true,
          'view' => 'views/settings/fields/address-preview'
        ],
        'personNameFormat' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'firstLast',
            1 => 'lastFirst',
            2 => 'firstMiddleLast',
            3 => 'lastFirstMiddle'
          ]
        ],
        'currencyFormat' => (object) [
          'type' => 'enumInt',
          'options' => [
            0 => 1,
            1 => 2,
            2 => 3
          ]
        ],
        'currencyDecimalPlaces' => (object) [
          'type' => 'int',
          'tooltip' => true,
          'min' => 0,
          'max' => 20
        ],
        'notificationSoundsDisabled' => (object) [
          'type' => 'bool'
        ],
        'calendarEntityList' => (object) [
          'type' => 'multiEnum',
          'view' => 'views/settings/fields/calendar-entity-list',
          'tooltip' => true
        ],
        'activitiesEntityList' => (object) [
          'type' => 'multiEnum',
          'view' => 'views/settings/fields/activities-entity-list',
          'tooltip' => true
        ],
        'historyEntityList' => (object) [
          'type' => 'multiEnum',
          'view' => 'views/settings/fields/history-entity-list',
          'tooltip' => true
        ],
        'busyRangesEntityList' => (object) [
          'type' => 'multiEnum',
          'tooltip' => true,
          'view' => 'views/settings/fields/busy-ranges-entity-list'
        ],
        'googleMapsApiKey' => (object) [
          'type' => 'varchar'
        ],
        'massEmailDisableMandatoryOptOutLink' => (object) [
          'type' => 'bool'
        ],
        'massEmailOpenTracking' => (object) [
          'type' => 'bool'
        ],
        'aclAllowDeleteCreated' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'lastViewedCount' => (object) [
          'type' => 'int',
          'min' => 1,
          'max' => 200,
          'default' => 20,
          'required' => true
        ],
        'adminNotifications' => (object) [
          'type' => 'bool'
        ],
        'adminNotificationsNewVersion' => (object) [
          'type' => 'bool'
        ],
        'adminNotificationsNewExtensionVersion' => (object) [
          'type' => 'bool'
        ],
        'textFilterUseContainsForVarchar' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'scopeColorsDisabled' => (object) [
          'type' => 'bool'
        ],
        'tabColorsDisabled' => (object) [
          'type' => 'bool'
        ],
        'tabIconsDisabled' => (object) [
          'type' => 'bool'
        ],
        'emailAddressIsOptedOutByDefault' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'outboundEmailBccAddress' => (object) [
          'type' => 'varchar',
          'view' => 'views/fields/email-address'
        ],
        'cleanupDeletedRecords' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'addressCountryList' => (object) [
          'type' => 'multiEnum',
          'tooltip' => true
        ],
        'addressCityList' => (object) [
          'type' => 'multiEnum',
          'tooltip' => true
        ],
        'addressStateList' => (object) [
          'type' => 'multiEnum',
          'tooltip' => true
        ],
        'jobRunInParallel' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'jobMaxPortion' => (object) [
          'type' => 'int',
          'tooltip' => true
        ],
        'jobPoolConcurrencyNumber' => (object) [
          'type' => 'int',
          'tooltip' => true,
          'min' => 1
        ],
        'daemonInterval' => (object) [
          'type' => 'int',
          'tooltip' => true
        ],
        'daemonMaxProcessNumber' => (object) [
          'type' => 'int',
          'tooltip' => true,
          'min' => 1
        ],
        'daemonProcessTimeout' => (object) [
          'type' => 'int',
          'tooltip' => true
        ],
        'cronDisabled' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'maintenanceMode' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'useWebSocket' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'awsS3Storage' => (object) [
          'type' => 'jsonObject'
        ],
        'outboundSmsFromNumber' => (object) [
          'type' => 'varchar'
        ],
        'smsProvider' => (object) [
          'type' => 'enum',
          'view' => 'views/settings/fields/sms-provider'
        ],
        'workingTimeCalendar' => (object) [
          'type' => 'link',
          'tooltip' => true,
          'entity' => 'WorkingTimeCalendar'
        ],
        'oidcClientId' => (object) [
          'type' => 'varchar'
        ],
        'oidcClientSecret' => (object) [
          'type' => 'password'
        ],
        'oidcAuthorizationEndpoint' => (object) [
          'type' => 'url',
          'strip' => false
        ],
        'oidcTokenEndpoint' => (object) [
          'type' => 'url',
          'strip' => false
        ],
        'oidcJwksEndpoint' => (object) [
          'type' => 'url',
          'strip' => false
        ],
        'oidcJwtSignatureAlgorithmList' => (object) [
          'type' => 'multiEnum',
          'options' => [
            0 => 'RS256',
            1 => 'RS384',
            2 => 'RS512',
            3 => 'HS256',
            4 => 'HS384',
            5 => 'HS512'
          ]
        ],
        'oidcScopes' => (object) [
          'type' => 'multiEnum',
          'allowCustomOptions' => true,
          'options' => [
            0 => 'profile',
            1 => 'email',
            2 => 'phone',
            3 => 'address'
          ]
        ],
        'oidcGroupClaim' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'oidcCreateUser' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'oidcUsernameClaim' => (object) [
          'type' => 'varchar',
          'options' => [
            0 => 'sub',
            1 => 'preferred_username',
            2 => 'email'
          ],
          'tooltip' => true
        ],
        'oidcTeams' => (object) [
          'type' => 'linkMultiple',
          'entity' => 'Team',
          'additionalAttributeList' => [
            0 => 'columns'
          ],
          'view' => 'views/settings/fields/oidc-teams',
          'tooltip' => true
        ],
        'oidcSync' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'oidcSyncTeams' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'oidcFallback' => (object) [
          'type' => 'bool',
          'tooltip' => true
        ],
        'oidcAllowRegularUserFallback' => (object) [
          'type' => 'bool'
        ],
        'oidcAllowAdminUser' => (object) [
          'type' => 'bool'
        ],
        'oidcLogoutUrl' => (object) [
          'type' => 'varchar',
          'tooltip' => true
        ],
        'pdfEngine' => (object) [
          'type' => 'enum',
          'view' => 'views/settings/fields/pdf-engine'
        ],
        'addressPreviewStreet' => (object) [
          'notStorable' => true,
          'readOnly' => true,
          'type' => 'text',
          'maxLength' => 255,
          'dbType' => 'varchar'
        ],
        'addressPreviewCity' => (object) [
          'notStorable' => true,
          'readOnly' => true,
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-city',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressPreviewState' => (object) [
          'notStorable' => true,
          'readOnly' => true,
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-state',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressPreviewCountry' => (object) [
          'notStorable' => true,
          'readOnly' => true,
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-country',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressPreviewPostalCode' => (object) [
          'notStorable' => true,
          'readOnly' => true,
          'type' => 'varchar',
          'maxLength' => 40,
          'pattern' => '$noBadCharacters'
        ],
        'addressPreviewMap' => (object) [
          'notStorable' => true,
          'readOnly' => true,
          'type' => 'map',
          'layoutListDisabled' => true,
          'provider' => 'Google',
          'height' => 300,
          'exportDisabled' => true,
          'importDisabled' => true
        ]
      ]
    ],
    'Sms' => (object) [
      'fields' => (object) [
        'from' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'required' => true,
          'textFilterDisabled' => true
        ],
        'fromName' => (object) [
          'type' => 'varchar'
        ],
        'to' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'required' => true,
          'textFilterDisabled' => true
        ],
        'fromPhoneNumber' => (object) [
          'type' => 'link',
          'textFilterDisabled' => true
        ],
        'toPhoneNumbers' => (object) [
          'type' => 'linkMultiple'
        ],
        'body' => (object) [
          'type' => 'text'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Draft',
            1 => 'Sending',
            2 => 'Sent',
            3 => 'Archived',
            4 => 'Failed'
          ],
          'default' => 'Archived',
          'clientReadOnly' => true,
          'style' => (object) [
            'Draft' => 'warning',
            'Failed' => 'danger',
            'Sending' => 'warning'
          ]
        ],
        'parent' => (object) [
          'type' => 'linkParent'
        ],
        'dateSent' => (object) [
          'type' => 'datetime'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user'
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user'
        ],
        'replied' => (object) [
          'type' => 'link',
          'noJoin' => true,
          'readOnly' => true,
          'view' => 'views/email/fields/replied'
        ],
        'replies' => (object) [
          'type' => 'linkMultiple',
          'readOnly' => true,
          'orderBy' => 'dateSent',
          'view' => 'views/email/fields/replies'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam'
        ],
        'parent' => (object) [
          'type' => 'belongsToParent',
          'entityList' => [
            0 => 'Account',
            1 => 'Contact',
            2 => 'Lead',
            3 => 'Opportunity'
          ],
          'foreign' => 'emails'
        ],
        'replied' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Sms',
          'foreign' => 'replies',
          'foreignName' => 'id'
        ],
        'replies' => (object) [
          'type' => 'hasMany',
          'entity' => 'Sms',
          'foreign' => 'replied'
        ],
        'fromPhoneNumber' => (object) [
          'type' => 'belongsTo',
          'entity' => 'PhoneNumber'
        ],
        'toPhoneNumbers' => (object) [
          'type' => 'hasMany',
          'entity' => 'PhoneNumber',
          'relationName' => 'smsPhoneNumber',
          'conditions' => (object) [
            'addressType' => 'to'
          ],
          'additionalColumns' => (object) [
            'addressType' => (object) [
              'type' => 'varchar',
              'len' => '4'
            ]
          ]
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'dateSent',
        'order' => 'desc',
        'textFilterFields' => [
          0 => 'name',
          1 => 'body'
        ],
        'sortBy' => 'dateSent',
        'asc' => false
      ],
      'indexes' => (object) [
        'dateSent' => (object) [
          'columns' => [
            0 => 'dateSent',
            1 => 'deleted'
          ]
        ],
        'dateSentStatus' => (object) [
          'columns' => [
            0 => 'dateSent',
            1 => 'status',
            2 => 'deleted'
          ]
        ]
      ]
    ],
    'Subscription' => (object) [
      'fields' => (object) [
        'id' => (object) [
          'type' => 'id',
          'dbType' => 'bigint',
          'autoincrement' => true
        ],
        'entity' => (object) [
          'type' => 'linkParent'
        ],
        'user' => (object) [
          'type' => 'link'
        ]
      ],
      'indexes' => (object) [
        'userEntity' => (object) [
          'columns' => [
            0 => 'userId',
            1 => 'entityId',
            2 => 'entityType'
          ]
        ]
      ]
    ],
    'SystemData' => (object) [
      'fields' => (object) [
        'id' => (object) [
          'type' => 'id',
          'dbType' => 'string',
          'maxLength' => 1
        ],
        'lastPasswordRecoveryDate' => (object) [
          'type' => 'datetime'
        ]
      ]
    ],
    'Team' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'pattern' => '$noBadCharacters'
        ],
        'roles' => (object) [
          'type' => 'linkMultiple',
          'tooltip' => true
        ],
        'positionList' => (object) [
          'type' => 'array',
          'displayAsList' => true,
          'tooltip' => true
        ],
        'userRole' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'utility' => true
        ],
        'layoutSet' => (object) [
          'type' => 'link',
          'tooltip' => true
        ],
        'workingTimeCalendar' => (object) [
          'type' => 'link',
          'tooltip' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'users' => (object) [
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'teams',
          'columnAttributeMap' => (object) [
            'role' => 'userRole'
          ]
        ],
        'roles' => (object) [
          'type' => 'hasMany',
          'entity' => 'Role',
          'foreign' => 'teams'
        ],
        'notes' => (object) [
          'type' => 'hasMany',
          'entity' => 'Note',
          'foreign' => 'teams'
        ],
        'inboundEmails' => (object) [
          'type' => 'hasMany',
          'entity' => 'InboundEmail',
          'foreign' => 'teams'
        ],
        'layoutSet' => (object) [
          'type' => 'belongsTo',
          'entity' => 'LayoutSet',
          'foreign' => 'teams'
        ],
        'workingTimeCalendar' => (object) [
          'type' => 'belongsTo',
          'entity' => 'WorkingTimeCalendar',
          'foreign' => 'teams'
        ],
        'groupEmailFolders' => (object) [
          'type' => 'hasMany',
          'entity' => 'GroupEmailFolder',
          'foreign' => 'teams'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'Template' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'body' => (object) [
          'type' => 'wysiwyg',
          'view' => 'views/template/fields/body'
        ],
        'header' => (object) [
          'type' => 'wysiwyg',
          'view' => 'views/template/fields/body'
        ],
        'footer' => (object) [
          'type' => 'wysiwyg',
          'view' => 'views/template/fields/body',
          'tooltip' => true
        ],
        'entityType' => (object) [
          'type' => 'enum',
          'required' => true,
          'translation' => 'Global.scopeNames',
          'view' => 'views/template/fields/entity-type'
        ],
        'leftMargin' => (object) [
          'type' => 'float',
          'default' => 10
        ],
        'rightMargin' => (object) [
          'type' => 'float',
          'default' => 10
        ],
        'topMargin' => (object) [
          'type' => 'float',
          'default' => 10
        ],
        'bottomMargin' => (object) [
          'type' => 'float',
          'default' => 20
        ],
        'printFooter' => (object) [
          'type' => 'bool'
        ],
        'printHeader' => (object) [
          'type' => 'bool'
        ],
        'footerPosition' => (object) [
          'type' => 'float',
          'default' => 10
        ],
        'headerPosition' => (object) [
          'type' => 'float',
          'default' => 0
        ],
        'teams' => (object) [
          'type' => 'linkMultiple'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'variables' => (object) [
          'type' => 'base',
          'notStorable' => true,
          'tooltip' => true
        ],
        'pageOrientation' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Portrait',
            1 => 'Landscape'
          ],
          'default' => 'Portrait'
        ],
        'pageFormat' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'A3',
            1 => 'A4',
            2 => 'A5',
            3 => 'A6',
            4 => 'A7',
            5 => 'Custom'
          ],
          'default' => 'A4'
        ],
        'pageWidth' => (object) [
          'type' => 'float',
          'min' => 1
        ],
        'pageHeight' => (object) [
          'type' => 'float',
          'min' => 1
        ],
        'fontFace' => (object) [
          'type' => 'enum',
          'view' => 'views/template/fields/font-face'
        ],
        'title' => (object) [
          'type' => 'varchar'
        ]
      ],
      'links' => (object) [
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam'
        ],
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ],
      'optimisticConcurrencyControl' => true
    ],
    'TwoFactorCode' => (object) [
      'fields' => (object) [
        'code' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'method' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'attemptsLeft' => (object) [
          'type' => 'int'
        ],
        'isActive' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'user' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ],
      'indexes' => (object) [
        'createdAt' => (object) [
          'columns' => [
            0 => 'createdAt'
          ]
        ],
        'userIdMethod' => (object) [
          'columns' => [
            0 => 'userId',
            1 => 'method'
          ]
        ],
        'userIdMethodIsActive' => (object) [
          'columns' => [
            0 => 'userId',
            1 => 'method',
            2 => 'isActive'
          ]
        ],
        'userIdMethodCreatedAt' => (object) [
          'columns' => [
            0 => 'userId',
            1 => 'method',
            2 => 'createdAt'
          ]
        ]
      ]
    ],
    'UniqueId' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'index' => true
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'terminateAt' => (object) [
          'type' => 'datetime'
        ],
        'target' => (object) [
          'type' => 'linkParent'
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'target' => (object) [
          'type' => 'belongsToParent'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ]
    ],
    'User' => (object) [
      'fields' => (object) [
        'userName' => (object) [
          'type' => 'varchar',
          'maxLength' => 50,
          'required' => true,
          'view' => 'views/user/fields/user-name',
          'tooltip' => true,
          'fieldManagerParamList' => [
            0 => 'maxLength',
            1 => 'tooltipText',
            2 => 'inlineEditDisabled'
          ],
          'index' => true,
          'validatorClassNameList' => [
            0 => 'Espo\\Classes\\FieldValidators\\User\\UserName\\Valid'
          ]
        ],
        'name' => (object) [
          'type' => 'personName',
          'view' => 'views/user/fields/name',
          'dependeeAttributeList' => [
            0 => 'userName'
          ]
        ],
        'type' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'regular',
            1 => 'admin',
            2 => 'portal',
            3 => 'system',
            4 => 'super-admin',
            5 => 'api'
          ],
          'default' => 'regular',
          'maxLength' => 24,
          'index' => true,
          'inlineEditDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'fieldManagerParamList' => [
            0 => 'tooltipText'
          ]
        ],
        'password' => (object) [
          'type' => 'password',
          'maxLength' => 150,
          'internal' => true,
          'utility' => true,
          'directAccessDisabled' => true,
          'fieldManagerParamList' => [
            0 => 'tooltipText'
          ]
        ],
        'passwordConfirm' => (object) [
          'type' => 'password',
          'maxLength' => 150,
          'internal' => true,
          'utility' => true,
          'notStorable' => true,
          'directAccessDisabled' => true,
          'fieldManagerParamList' => []
        ],
        'authMethod' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'ApiKey',
            2 => 'Hmac'
          ],
          'maxLength' => 24,
          'layoutMassUpdateDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutFiltersDisabled' => true,
          'layoutListDisabled' => true,
          'fieldManagerParamList' => [
            0 => 'tooltipText'
          ]
        ],
        'apiKey' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'readOnly' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutFiltersDisabled' => true,
          'layoutListDisabled' => true,
          'fieldManagerParamList' => [
            0 => 'tooltipText'
          ]
        ],
        'secretKey' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'readOnly' => true,
          'notStorable' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutFiltersDisabled' => true,
          'layoutListDisabled' => true,
          'fieldManagerParamList' => [
            0 => 'tooltipText'
          ]
        ],
        'salutationName' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Mr.',
            2 => 'Ms.',
            3 => 'Mrs.',
            4 => 'Dr.'
          ]
        ],
        'firstName' => (object) [
          'type' => 'varchar',
          'pattern' => '$noBadCharacters',
          'maxLength' => 100,
          'suppressValidationList' => [
            0 => 'required'
          ]
        ],
        'lastName' => (object) [
          'type' => 'varchar',
          'pattern' => '$noBadCharacters',
          'maxLength' => 100,
          'required' => true,
          'suppressValidationList' => [
            0 => 'required'
          ]
        ],
        'isActive' => (object) [
          'type' => 'bool',
          'layoutDetailDisabled' => true,
          'tooltip' => true,
          'default' => true,
          'customizationAuditedDisabled' => true
        ],
        'title' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'pattern' => '$noBadCharacters',
          'customizationAuditedDisabled' => true
        ],
        'position' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'notStorable' => true,
          'where' => (object) [
            'LIKE' => (object) [
              'whereClause' => (object) [
                'id=s' => (object) [
                  'from' => 'TeamUser',
                  'select' => [
                    0 => 'userId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'role*' => '{value}'
                  ]
                ]
              ]
            ],
            'NOT LIKE' => (object) [
              'whereClause' => (object) [
                'id!=s' => (object) [
                  'from' => 'TeamUser',
                  'select' => [
                    0 => 'userId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'role*' => '{value}'
                  ]
                ]
              ]
            ],
            '=' => (object) [
              'whereClause' => (object) [
                'id=s' => (object) [
                  'from' => 'TeamUser',
                  'select' => [
                    0 => 'userId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'role' => '{value}'
                  ]
                ]
              ]
            ],
            '<>' => (object) [
              'whereClause' => (object) [
                'id=!s' => (object) [
                  'from' => 'TeamUser',
                  'select' => [
                    0 => 'userId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'role' => '{value}'
                  ]
                ]
              ]
            ],
            'IS NULL' => (object) [
              'whereClause' => (object) [
                'NOT' => (object) [
                  'EXISTS' => (object) [
                    'from' => 'User',
                    'fromAlias' => 'sq',
                    'select' => [
                      0 => 'id'
                    ],
                    'leftJoins' => [
                      0 => [
                        0 => 'teams',
                        1 => 'm',
                        2 => (object) [],
                        3 => (object) [
                          'onlyMiddle' => true
                        ]
                      ]
                    ],
                    'whereClause' => (object) [
                      'm.role!=' => NULL,
                      'sq.id:' => 'user.id'
                    ]
                  ]
                ]
              ]
            ],
            'IS NOT NULL' => (object) [
              'whereClause' => (object) [
                'EXISTS' => (object) [
                  'from' => 'User',
                  'fromAlias' => 'sq',
                  'select' => [
                    0 => 'id'
                  ],
                  'leftJoins' => [
                    0 => [
                      0 => 'teams',
                      1 => 'm',
                      2 => (object) [],
                      3 => (object) [
                        'onlyMiddle' => true
                      ]
                    ]
                  ],
                  'whereClause' => (object) [
                    'm.role!=' => NULL,
                    'sq.id:' => 'user.id'
                  ]
                ]
              ]
            ]
          ],
          'directUpdateDisabled' => true,
          'readOnly' => true,
          'importDisabled' => true,
          'exportDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'textFilterDisabled' => true,
          'fieldManagerParamList' => [
            0 => 'tooltipText'
          ]
        ],
        'emailAddress' => (object) [
          'type' => 'email',
          'required' => false,
          'layoutMassUpdateDisabled' => true
        ],
        'phoneNumber' => (object) [
          'type' => 'phone',
          'typeList' => [
            0 => 'Mobile',
            1 => 'Office',
            2 => 'Home',
            3 => 'Fax',
            4 => 'Other'
          ],
          'defaultType' => 'Mobile'
        ],
        'token' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'utility' => true,
          'customizationDisabled' => true
        ],
        'authTokenId' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'utility' => true,
          'customizationDisabled' => true
        ],
        'authLogRecordId' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'utility' => true,
          'customizationDisabled' => true
        ],
        'ipAddress' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'utility' => true,
          'customizationDisabled' => true
        ],
        'defaultTeam' => (object) [
          'type' => 'link',
          'layoutDetailDisabled' => true,
          'tooltip' => true,
          'customizationAuditedDisabled' => true
        ],
        'acceptanceStatus' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'exportDisabled' => true,
          'utility' => true,
          'fieldManagerParamList' => []
        ],
        'acceptanceStatusMeetings' => (object) [
          'type' => 'enum',
          'notStorable' => true,
          'directUpdateDisabled' => true,
          'layoutAvailabilityList' => [
            0 => 'filters'
          ],
          'importDisabled' => true,
          'exportDisabled' => true,
          'view' => 'crm:views/lead/fields/acceptance-status',
          'link' => 'meetings',
          'column' => 'status',
          'fieldManagerParamList' => []
        ],
        'acceptanceStatusCalls' => (object) [
          'type' => 'enum',
          'notStorable' => true,
          'directUpdateDisabled' => true,
          'layoutAvailabilityList' => [
            0 => 'filters'
          ],
          'importDisabled' => true,
          'exportDisabled' => true,
          'view' => 'crm:views/lead/fields/acceptance-status',
          'link' => 'calls',
          'column' => 'status',
          'fieldManagerParamList' => []
        ],
        'teamRole' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'utility' => true,
          'fieldManagerParamList' => []
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'tooltip' => true,
          'columns' => (object) [
            'role' => 'userRole'
          ],
          'additionalAttributeList' => [
            0 => 'columns'
          ],
          'layoutDetailDisabled' => true,
          'view' => 'views/user/fields/teams',
          'default' => 'javascript: return {teamsIds: []}'
        ],
        'roles' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'tooltip' => true
        ],
        'portals' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'tooltip' => true
        ],
        'portalRoles' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'tooltip' => true
        ],
        'contact' => (object) [
          'type' => 'link',
          'layoutDetailDisabled' => true,
          'view' => 'views/user/fields/contact',
          'fieldManagerParamList' => [
            0 => 'inlineEditDisabled',
            1 => 'tooltipText'
          ]
        ],
        'accounts' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'fieldManagerParamList' => [
            0 => 'inlineEditDisabled',
            1 => 'tooltipText'
          ]
        ],
        'account' => (object) [
          'type' => 'link',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'foreignAccessDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'readOnly' => true
        ],
        'portal' => (object) [
          'type' => 'link',
          'notStorable' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'avatar' => (object) [
          'type' => 'image',
          'view' => 'views/user/fields/avatar',
          'layoutDetailDisabled' => true,
          'previewSize' => 'small',
          'customizationAuditedDisabled' => true
        ],
        'sendAccessInfo' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'utility' => true
        ],
        'gender' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Male',
            2 => 'Female',
            3 => 'Neutral'
          ]
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'dashboardTemplate' => (object) [
          'type' => 'link',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'customizationAuditedDisabled' => true
        ],
        'workingTimeCalendar' => (object) [
          'type' => 'link',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'customizationAuditedDisabled' => true
        ],
        'layoutSet' => (object) [
          'type' => 'link',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'customizationAuditedDisabled' => true,
          'tooltip' => true
        ],
        'auth2FA' => (object) [
          'type' => 'foreign',
          'link' => 'userData',
          'field' => 'auth2FA',
          'readOnly' => true,
          'view' => 'views/fields/foreign-bool'
        ],
        'userData' => (object) [
          'type' => 'linkOne',
          'utility' => true,
          'customizationDisabled' => true
        ],
        'lastAccess' => (object) [
          'type' => 'datetime',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'layoutFiltersDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutDetailDisabled' => true,
          'directAccessDisabled' => true,
          'exportDisabled' => true
        ],
        'deleteId' => (object) [
          'type' => 'varchar',
          'maxLength' => 17,
          'readOnly' => true,
          'notNull' => true,
          'default' => '0',
          'utility' => true,
          'customizationDisabled' => true
        ],
        'targetListIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'readOnly' => true,
          'utility' => true,
          'fieldManagerParamList' => []
        ],
        'middleName' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'pattern' => '$noBadCharacters'
        ],
        'emailAddressIsOptedOut' => (object) [
          'layoutMassUpdateDisabled' => true,
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'emailAddressIsInvalid' => (object) [
          'layoutMassUpdateDisabled' => true,
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'phoneNumberIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'phoneNumberIsInvalid' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ]
      ],
      'links' => (object) [
        'defaultTeam' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Team'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'foreign' => 'users',
          'additionalColumns' => (object) [
            'role' => (object) [
              'type' => 'varchar',
              'len' => 100
            ]
          ],
          'layoutRelationshipsDisabled' => true,
          'columnAttributeMap' => (object) [
            'role' => 'teamRole'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'roles' => (object) [
          'type' => 'hasMany',
          'entity' => 'Role',
          'foreign' => 'users',
          'layoutRelationshipsDisabled' => true
        ],
        'portals' => (object) [
          'type' => 'hasMany',
          'entity' => 'Portal',
          'foreign' => 'users',
          'layoutRelationshipsDisabled' => true
        ],
        'portalRoles' => (object) [
          'type' => 'hasMany',
          'entity' => 'PortalRole',
          'foreign' => 'users',
          'layoutRelationshipsDisabled' => true
        ],
        'dashboardTemplate' => (object) [
          'type' => 'belongsTo',
          'entity' => 'DashboardTemplate'
        ],
        'workingTimeCalendar' => (object) [
          'type' => 'belongsTo',
          'entity' => 'WorkingTimeCalendar',
          'noJoin' => true
        ],
        'workingTimeRanges' => (object) [
          'type' => 'hasMany',
          'foreign' => 'users',
          'entity' => 'WorkingTimeRange'
        ],
        'layoutSet' => (object) [
          'type' => 'belongsTo',
          'entity' => 'LayoutSet',
          'noJoin' => true
        ],
        'preferences' => (object) [
          'type' => 'hasOne',
          'entity' => 'Preferences',
          'noJoin' => true
        ],
        'userData' => (object) [
          'type' => 'hasOne',
          'entity' => 'UserData',
          'foreign' => 'user',
          'foreignName' => 'id'
        ],
        'meetings' => (object) [
          'type' => 'hasMany',
          'entity' => 'Meeting',
          'foreign' => 'users',
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'calls' => (object) [
          'type' => 'hasMany',
          'entity' => 'Call',
          'foreign' => 'users',
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'emails' => (object) [
          'type' => 'hasMany',
          'entity' => 'Email',
          'foreign' => 'users'
        ],
        'notes' => (object) [
          'type' => 'hasMany',
          'entity' => 'Note',
          'foreign' => 'users',
          'layoutRelationshipsDisabled' => true
        ],
        'contact' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Contact',
          'foreign' => 'portalUser'
        ],
        'accounts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Account',
          'foreign' => 'portalUsers',
          'relationName' => 'AccountPortalUser'
        ],
        'tasks' => (object) [
          'type' => 'hasMany',
          'entity' => 'Task',
          'foreign' => 'assignedUser'
        ],
        'targetLists' => (object) [
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'users',
          'columnAttributeMap' => (object) [
            'optedOut' => 'targetListIsOptedOut'
          ]
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'userName',
        'order' => 'asc',
        'textFilterFields' => [
          0 => 'name',
          1 => 'userName',
          2 => 'emailAddress'
        ],
        'sortBy' => 'userName',
        'asc' => true
      ],
      'indexes' => (object) [
        'userNameDeleteId' => (object) [
          'type' => 'unique',
          'columns' => [
            0 => 'userName',
            1 => 'deleteId'
          ]
        ]
      ]
    ],
    'UserData' => (object) [
      'fields' => (object) [
        'imapHandlers' => (object) [
          'type' => 'jsonObject'
        ],
        'smtpHandlers' => (object) [
          'type' => 'jsonObject'
        ],
        'auth2FA' => (object) [
          'type' => 'bool'
        ],
        'auth2FAMethod' => (object) [
          'type' => 'enum'
        ],
        'auth2FATotpSecret' => (object) [
          'type' => 'varchar',
          'maxLength' => 32
        ],
        'auth2FAEmailAddress' => (object) [
          'type' => 'varchar'
        ]
      ],
      'links' => (object) [
        'user' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ]
    ],
    'Webhook' => (object) [
      'fields' => (object) [
        'event' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'required' => true,
          'view' => 'views/webhook/fields/event'
        ],
        'url' => (object) [
          'type' => 'varchar',
          'maxLength' => 512,
          'required' => true
        ],
        'isActive' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'user' => (object) [
          'type' => 'link',
          'view' => 'views/webhook/fields/user'
        ],
        'entityType' => (object) [
          'type' => 'varchar',
          'readOnly' => true,
          'view' => 'views/fields/entity-type'
        ],
        'type' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'create',
            1 => 'update',
            2 => 'fieldUpdate',
            3 => 'delete'
          ],
          'readOnly' => true
        ],
        'field' => (object) [
          'type' => 'varchar',
          'readOnly' => true
        ],
        'secretKey' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'readOnly' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutFiltersDisabled' => true,
          'layoutListDisabled' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'user' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'textFilterFields' => [
          0 => 'event'
        ],
        'sortBy' => 'createdAt',
        'asc' => false
      ],
      'indexes' => (object) [
        'event' => (object) [
          'columns' => [
            0 => 'event'
          ]
        ],
        'entityTypeType' => (object) [
          'columns' => [
            0 => 'entityType',
            1 => 'type'
          ]
        ],
        'entityTypeField' => (object) [
          'columns' => [
            0 => 'entityType',
            1 => 'field'
          ]
        ]
      ]
    ],
    'WebhookEventQueueItem' => (object) [
      'fields' => (object) [
        'number' => (object) [
          'type' => 'autoincrement',
          'dbType' => 'bigint'
        ],
        'event' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'required' => true
        ],
        'target' => (object) [
          'type' => 'linkParent'
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'isProcessed' => (object) [
          'type' => 'bool'
        ]
      ],
      'links' => (object) [],
      'collection' => (object) [
        'orderBy' => 'number',
        'order' => 'desc',
        'sortBy' => 'number',
        'asc' => false
      ]
    ],
    'WebhookQueueItem' => (object) [
      'fields' => (object) [
        'number' => (object) [
          'type' => 'autoincrement',
          'dbType' => 'bigint'
        ],
        'event' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'required' => true
        ],
        'webhook' => (object) [
          'type' => 'link'
        ],
        'target' => (object) [
          'type' => 'linkParent'
        ],
        'data' => (object) [
          'type' => 'jsonObject'
        ],
        'createdAt' => (object) [
          'type' => 'datetime'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Pending',
            1 => 'Success',
            2 => 'Failed'
          ],
          'default' => 'Pending',
          'maxLength' => 15
        ],
        'processedAt' => (object) [
          'type' => 'datetime'
        ],
        'attempts' => (object) [
          'type' => 'int',
          'default' => 0
        ],
        'processAt' => (object) [
          'type' => 'datetime'
        ]
      ],
      'links' => (object) [
        'webhook' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Webhook',
          'foreignName' => 'id'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'number',
        'order' => 'desc',
        'sortBy' => 'number',
        'asc' => false
      ]
    ],
    'WorkingTimeCalendar' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'timeZone' => (object) [
          'type' => 'enum',
          'default' => '',
          'view' => 'views/preferences/fields/time-zone'
        ],
        'timeRanges' => (object) [
          'type' => 'jsonArray',
          'default' => [
            0 => [
              0 => '9:00',
              1 => '17:00'
            ]
          ],
          'view' => 'views/working-time-calendar/fields/time-ranges',
          'required' => true
        ],
        'weekday0' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'weekday1' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'weekday2' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'weekday3' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'weekday4' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'weekday5' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'weekday6' => (object) [
          'type' => 'bool',
          'default' => false
        ],
        'weekday0TimeRanges' => (object) [
          'type' => 'jsonArray',
          'default' => NULL,
          'view' => 'views/working-time-calendar/fields/time-ranges'
        ],
        'weekday1TimeRanges' => (object) [
          'type' => 'jsonArray',
          'default' => NULL,
          'view' => 'views/working-time-calendar/fields/time-ranges'
        ],
        'weekday2TimeRanges' => (object) [
          'type' => 'jsonArray',
          'default' => NULL,
          'view' => 'views/working-time-calendar/fields/time-ranges'
        ],
        'weekday3TimeRanges' => (object) [
          'type' => 'jsonArray',
          'default' => NULL,
          'view' => 'views/working-time-calendar/fields/time-ranges'
        ],
        'weekday4TimeRanges' => (object) [
          'type' => 'jsonArray',
          'default' => NULL,
          'view' => 'views/working-time-calendar/fields/time-ranges'
        ],
        'weekday5TimeRanges' => (object) [
          'type' => 'jsonArray',
          'default' => NULL,
          'view' => 'views/working-time-calendar/fields/time-ranges'
        ],
        'weekday6TimeRanges' => (object) [
          'type' => 'jsonArray',
          'default' => NULL,
          'view' => 'views/working-time-calendar/fields/time-ranges'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'readOnly' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'ranges' => (object) [
          'type' => 'hasMany',
          'foreign' => 'calendars',
          'entity' => 'WorkingTimeRange'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'foreign' => 'workingTimeCalendar',
          'entity' => 'Team',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'textFilterFields' => [
          0 => 'name'
        ],
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'WorkingTimeRange' => (object) [
      'fields' => (object) [
        'timeRanges' => (object) [
          'type' => 'jsonArray',
          'default' => NULL,
          'view' => 'views/working-time-calendar/fields/time-ranges'
        ],
        'dateStart' => (object) [
          'type' => 'date',
          'required' => true
        ],
        'dateEnd' => (object) [
          'type' => 'date',
          'required' => true,
          'view' => 'views/working-time-range/fields/date-end'
        ],
        'type' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Non-working',
            1 => 'Working'
          ],
          'default' => 'Non-working',
          'index' => true,
          'maxLength' => 11
        ],
        'name' => (object) [
          'type' => 'varchar'
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'calendars' => (object) [
          'type' => 'linkMultiple'
        ],
        'users' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/working-time-range/fields/users'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'calendars' => (object) [
          'type' => 'hasMany',
          'foreign' => 'ranges',
          'entity' => 'WorkingTimeCalendar'
        ],
        'users' => (object) [
          'type' => 'hasMany',
          'foreign' => 'workingTimeRanges',
          'entity' => 'User'
        ],
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'dateStart',
        'order' => 'asc',
        'sortBy' => 'dateStart',
        'asc' => true
      ],
      'indexes' => (object) [
        'typeRange' => (object) [
          'columns' => [
            0 => 'type',
            1 => 'dateStart',
            2 => 'dateEnd'
          ]
        ],
        'type' => (object) [
          'columns' => [
            0 => 'type'
          ]
        ]
      ]
    ],
    'Account' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'maxLength' => 249,
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'website' => (object) [
          'type' => 'url',
          'strip' => true
        ],
        'emailAddress' => (object) [
          'type' => 'email',
          'isPersonalData' => true
        ],
        'phoneNumber' => (object) [
          'type' => 'phone',
          'typeList' => [
            0 => 'Office',
            1 => 'Mobile',
            2 => 'Fax',
            3 => 'Other'
          ],
          'defaultType' => 'Office'
        ],
        'type' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Customer',
            2 => 'Investor',
            3 => 'Partner',
            4 => 'Reseller'
          ],
          'customizationOptionsReferenceDisabled' => true
        ],
        'industry' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Advertising',
            2 => 'Aerospace',
            3 => 'Agriculture',
            4 => 'Apparel & Accessories',
            5 => 'Architecture',
            6 => 'Automotive',
            7 => 'Banking',
            8 => 'Biotechnology',
            9 => 'Building Materials & Equipment',
            10 => 'Chemical',
            11 => 'Construction',
            12 => 'Consulting',
            13 => 'Computer',
            14 => 'Culture',
            15 => 'Creative',
            16 => 'Defense',
            17 => 'Education',
            18 => 'Electronics',
            19 => 'Electric Power',
            20 => 'Energy',
            21 => 'Entertainment & Leisure',
            22 => 'Finance',
            23 => 'Food & Beverage',
            24 => 'Grocery',
            25 => 'Healthcare',
            26 => 'Hospitality',
            27 => 'Insurance',
            28 => 'Legal',
            29 => 'Manufacturing',
            30 => 'Mass Media',
            31 => 'Marketing',
            32 => 'Mining',
            33 => 'Music',
            34 => 'Publishing',
            35 => 'Petroleum',
            36 => 'Real Estate',
            37 => 'Retail',
            38 => 'Service',
            39 => 'Sports',
            40 => 'Software',
            41 => 'Support',
            42 => 'Shipping',
            43 => 'Travel',
            44 => 'Technology',
            45 => 'Telecommunications',
            46 => 'Television',
            47 => 'Transportation',
            48 => 'Testing, Inspection & Certification',
            49 => 'Venture Capital',
            50 => 'Wholesale',
            51 => 'Water'
          ],
          'isSorted' => true,
          'customizationOptionsReferenceDisabled' => true
        ],
        'sicCode' => (object) [
          'type' => 'varchar',
          'maxLength' => 40,
          'pattern' => '$noBadCharacters',
          'noSpellCheck' => true
        ],
        'contactRole' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'utility' => true,
          'maxLength' => 100,
          'pattern' => '$noBadCharacters',
          'layoutMassUpdateDisabled' => true,
          'layoutListDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutSearchDisabled' => true,
          'fieldManagerParamList' => [
            0 => 'pattern'
          ]
        ],
        'contactIsInactive' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'default' => false,
          'utility' => true
        ],
        'billingAddress' => (object) [
          'type' => 'address'
        ],
        'billingAddressStreet' => (object) [
          'type' => 'text',
          'maxLength' => 255,
          'dbType' => 'varchar'
        ],
        'billingAddressCity' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-city',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'billingAddressState' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-state',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'billingAddressCountry' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-country',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'billingAddressPostalCode' => (object) [
          'type' => 'varchar',
          'maxLength' => 40,
          'pattern' => '$noBadCharacters'
        ],
        'shippingAddress' => (object) [
          'type' => 'address',
          'view' => 'crm:views/account/fields/shipping-address'
        ],
        'shippingAddressStreet' => (object) [
          'type' => 'text',
          'maxLength' => 255,
          'dbType' => 'varchar'
        ],
        'shippingAddressCity' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-city',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'shippingAddressState' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-state',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'shippingAddressCountry' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-country',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'shippingAddressPostalCode' => (object) [
          'type' => 'varchar',
          'maxLength' => 40,
          'pattern' => '$noBadCharacters'
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'campaign' => (object) [
          'type' => 'link'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'targetLists' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'importDisabled' => true,
          'exportDisabled' => true,
          'noLoad' => true
        ],
        'targetList' => (object) [
          'type' => 'link',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutFiltersDisabled' => true,
          'entity' => 'TargetList',
          'directAccessDisabled' => true
        ],
        'originalLead' => (object) [
          'type' => 'linkOne',
          'readOnly' => true,
          'view' => 'views/fields/link-one'
        ],
        'targetListIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'emailAddressIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'emailAddressIsInvalid' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'phoneNumberIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'phoneNumberIsInvalid' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'billingAddressMap' => (object) [
          'type' => 'map',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'provider' => 'Google',
          'height' => 300,
          'exportDisabled' => true,
          'importDisabled' => true
        ],
        'shippingAddressMap' => (object) [
          'type' => 'map',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'provider' => 'Google',
          'height' => 300,
          'exportDisabled' => true,
          'importDisabled' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'contacts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'accounts',
          'columnAttributeMap' => (object) [
            'role' => 'contactRole',
            'isInactive' => 'contactIsInactive'
          ]
        ],
        'contactsPrimary' => (object) [
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'account',
          'layoutRelationshipsDisabled' => true
        ],
        'opportunities' => (object) [
          'type' => 'hasMany',
          'entity' => 'Opportunity',
          'foreign' => 'account'
        ],
        'cases' => (object) [
          'type' => 'hasMany',
          'entity' => 'Case',
          'foreign' => 'account'
        ],
        'documents' => (object) [
          'type' => 'hasMany',
          'entity' => 'Document',
          'foreign' => 'accounts',
          'audited' => true
        ],
        'meetingsPrimary' => (object) [
          'type' => 'hasMany',
          'entity' => 'Meeting',
          'foreign' => 'account',
          'layoutRelationshipsDisabled' => true
        ],
        'emailsPrimary' => (object) [
          'type' => 'hasMany',
          'entity' => 'Email',
          'foreign' => 'account',
          'layoutRelationshipsDisabled' => true
        ],
        'callsPrimary' => (object) [
          'type' => 'hasMany',
          'entity' => 'Call',
          'foreign' => 'account',
          'layoutRelationshipsDisabled' => true
        ],
        'tasksPrimary' => (object) [
          'type' => 'hasMany',
          'entity' => 'Task',
          'foreign' => 'account',
          'layoutRelationshipsDisabled' => true
        ],
        'meetings' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Meeting',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
          'audited' => true
        ],
        'calls' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Call',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
          'audited' => true
        ],
        'tasks' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Task',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true
        ],
        'emails' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Email',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true
        ],
        'campaign' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'accounts'
        ],
        'campaignLogRecords' => (object) [
          'type' => 'hasChildren',
          'entity' => 'CampaignLogRecord',
          'foreign' => 'parent'
        ],
        'targetLists' => (object) [
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'accounts',
          'columnAttributeMap' => (object) [
            'optedOut' => 'targetListIsOptedOut'
          ]
        ],
        'portalUsers' => (object) [
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'accounts'
        ],
        'originalLead' => (object) [
          'type' => 'hasOne',
          'entity' => 'Lead',
          'foreign' => 'createdAccount'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'textFilterFields' => [
          0 => 'name',
          1 => 'emailAddress'
        ],
        'sortBy' => 'createdAt',
        'asc' => false
      ],
      'indexes' => (object) [
        'createdAt' => (object) [
          'columns' => [
            0 => 'createdAt',
            1 => 'deleted'
          ]
        ],
        'createdAtId' => (object) [
          'unique' => true,
          'columns' => [
            0 => 'createdAt',
            1 => 'id'
          ]
        ],
        'name' => (object) [
          'columns' => [
            0 => 'name',
            1 => 'deleted'
          ]
        ],
        'assignedUser' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'deleted'
          ]
        ]
      ]
    ],
    'Call' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Planned',
            1 => 'Held',
            2 => 'Not Held'
          ],
          'default' => 'Planned',
          'style' => (object) [
            'Held' => 'success'
          ],
          'audited' => true,
          'customizationOptionsReferenceDisabled' => true
        ],
        'dateStart' => (object) [
          'type' => 'datetime',
          'required' => true,
          'default' => 'javascript: return this.dateTime.getNow(15);',
          'audited' => true
        ],
        'dateEnd' => (object) [
          'type' => 'datetime',
          'required' => true,
          'view' => 'crm:views/call/fields/date-end',
          'after' => 'dateStart'
        ],
        'duration' => (object) [
          'type' => 'duration',
          'start' => 'dateStart',
          'end' => 'dateEnd',
          'options' => [
            0 => 300,
            1 => 600,
            2 => 900,
            3 => 1800,
            4 => 2700,
            5 => 3600,
            6 => 7200
          ],
          'default' => 300,
          'notStorable' => true,
          'select' => (object) [
            'select' => 'TIMESTAMPDIFF_SECOND:(dateStart, dateEnd)'
          ],
          'order' => (object) [
            'order' => [
              0 => [
                0 => 'TIMESTAMPDIFF_SECOND:(dateStart, dateEnd)',
                1 => '{direction}'
              ]
            ]
          ]
        ],
        'reminders' => (object) [
          'type' => 'jsonArray',
          'notStorable' => true,
          'view' => 'crm:views/meeting/fields/reminders',
          'layoutListDisabled' => true,
          'validatorClassNameList' => [
            0 => 'Espo\\Modules\\Crm\\Classes\\FieldValidators\\Event\\Reminders\\Valid',
            1 => 'Espo\\Modules\\Crm\\Classes\\FieldValidators\\Event\\Reminders\\MaxCount'
          ]
        ],
        'direction' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Outbound',
            1 => 'Inbound'
          ],
          'default' => 'Outbound'
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'parent' => (object) [
          'type' => 'linkParent',
          'entityList' => [
            0 => 'Account',
            1 => 'Lead',
            2 => 'Contact',
            3 => 'Opportunity',
            4 => 'Case'
          ]
        ],
        'account' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'acceptanceStatus' => (object) [
          'type' => 'enum',
          'notStorable' => true,
          'options' => [
            0 => 'None',
            1 => 'Accepted',
            2 => 'Tentative',
            3 => 'Declined'
          ],
          'style' => (object) [
            'Accepted' => 'success',
            'Declined' => 'danger',
            'Tentative' => 'warning'
          ],
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'importDisabled' => true,
          'exportDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationRequiredDisabled' => true,
          'customizationIsSortedDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationAuditedDisabled' => true,
          'customizationOptionsReferenceDisabled' => true,
          'where' => (object) [
            '=' => (object) [
              'whereClause' => (object) [
                'OR' => [
                  0 => (object) [
                    'id=s' => (object) [
                      'from' => 'CallContact',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  1 => (object) [
                    'id=s' => (object) [
                      'from' => 'CallLead',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  2 => (object) [
                    'id=s' => (object) [
                      'from' => 'CallUser',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ]
                ]
              ]
            ],
            '<>' => (object) [
              'whereClause' => (object) [
                'AND' => [
                  0 => (object) [
                    'id!=s' => (object) [
                      'from' => 'CallContact',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  1 => (object) [
                    'id!=s' => (object) [
                      'from' => 'CallLead',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  2 => (object) [
                    'id!=s' => (object) [
                      'from' => 'CallUser',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ]
                ]
              ]
            ],
            'IN' => (object) [
              'whereClause' => (object) [
                'OR' => [
                  0 => (object) [
                    'id=s' => (object) [
                      'from' => 'CallContact',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  1 => (object) [
                    'id=s' => (object) [
                      'from' => 'CallLead',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  2 => (object) [
                    'id=s' => (object) [
                      'from' => 'CallUser',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ]
                ]
              ]
            ],
            'NOT IN' => (object) [
              'whereClause' => (object) [
                'AND' => [
                  0 => (object) [
                    'id!=s' => (object) [
                      'from' => 'CallContact',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  1 => (object) [
                    'id!=s' => (object) [
                      'from' => 'CallLead',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  2 => (object) [
                    'id!=s' => (object) [
                      'from' => 'CallUser',
                      'select' => [
                        0 => 'callId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ]
                ]
              ]
            ]
          ],
          'view' => 'crm:views/meeting/fields/acceptance-status'
        ],
        'users' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'view' => 'crm:views/meeting/fields/users',
          'columns' => (object) [
            'status' => 'acceptanceStatus'
          ],
          'additionalAttributeList' => [
            0 => 'columns'
          ],
          'orderBy' => 'name'
        ],
        'contacts' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'view' => 'crm:views/call/fields/contacts',
          'columns' => (object) [
            'status' => 'acceptanceStatus'
          ],
          'additionalAttributeList' => [
            0 => 'columns'
          ],
          'orderBy' => 'name'
        ],
        'leads' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'view' => 'crm:views/call/fields/leads',
          'columns' => (object) [
            'status' => 'acceptanceStatus'
          ],
          'additionalAttributeList' => [
            0 => 'columns'
          ],
          'orderBy' => 'name'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'phoneNumbersMap' => (object) [
          'type' => 'jsonObject',
          'notStorable' => true,
          'utility' => true,
          'customizationDisabled' => true
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'required' => true,
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ]
      ],
      'links' => (object) [
        'account' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Account'
        ],
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'users' => (object) [
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'calls',
          'additionalColumns' => (object) [
            'status' => (object) [
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None'
            ]
          ],
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'contacts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'calls',
          'additionalColumns' => (object) [
            'status' => (object) [
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None'
            ]
          ],
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'leads' => (object) [
          'type' => 'hasMany',
          'entity' => 'Lead',
          'foreign' => 'calls',
          'additionalColumns' => (object) [
            'status' => (object) [
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None'
            ]
          ],
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'parent' => (object) [
          'type' => 'belongsToParent',
          'foreign' => 'calls'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'dateStart',
        'order' => 'desc',
        'sortBy' => 'dateStart',
        'asc' => false
      ],
      'indexes' => (object) [
        'dateStartStatus' => (object) [
          'columns' => [
            0 => 'dateStart',
            1 => 'status'
          ]
        ],
        'dateStart' => (object) [
          'columns' => [
            0 => 'dateStart',
            1 => 'deleted'
          ]
        ],
        'status' => (object) [
          'columns' => [
            0 => 'status',
            1 => 'deleted'
          ]
        ],
        'assignedUser' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'deleted'
          ]
        ],
        'assignedUserStatus' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'status'
          ]
        ]
      ]
    ],
    'Campaign' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Planning',
            1 => 'Active',
            2 => 'Inactive',
            3 => 'Complete'
          ],
          'default' => 'Planning',
          'customizationOptionsReferenceDisabled' => true
        ],
        'type' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Email',
            1 => 'Newsletter',
            2 => 'Web',
            3 => 'Television',
            4 => 'Radio',
            5 => 'Mail'
          ],
          'default' => 'Email',
          'customizationOptionsReferenceDisabled' => true
        ],
        'startDate' => (object) [
          'type' => 'date',
          'validatorClassNameList' => [
            0 => 'Espo\\Modules\\Crm\\Classes\\FieldValidators\\Campaign\\StartDate\\BeforeEndDate'
          ]
        ],
        'endDate' => (object) [
          'type' => 'date',
          'validatorClassNameList' => [
            0 => 'Espo\\Modules\\Crm\\Classes\\FieldValidators\\Campaign\\EndDate\\AfterStartDate'
          ]
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'targetLists' => (object) [
          'type' => 'linkMultiple',
          'tooltip' => true
        ],
        'excludingTargetLists' => (object) [
          'type' => 'linkMultiple',
          'tooltip' => true
        ],
        'sentCount' => (object) [
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'openedCount' => (object) [
          'view' => 'crm:views/campaign/fields/int-with-percentage',
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'clickedCount' => (object) [
          'view' => 'crm:views/campaign/fields/int-with-percentage',
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'optedInCount' => (object) [
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'optedOutCount' => (object) [
          'view' => 'crm:views/campaign/fields/int-with-percentage',
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'bouncedCount' => (object) [
          'view' => 'crm:views/campaign/fields/int-with-percentage',
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'hardBouncedCount' => (object) [
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'softBouncedCount' => (object) [
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'leadCreatedCount' => (object) [
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'openedPercentage' => (object) [
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'clickedPercentage' => (object) [
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'optedOutPercentage' => (object) [
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'bouncedPercentage' => (object) [
          'type' => 'int',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'revenue' => (object) [
          'type' => 'currency',
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'budget' => (object) [
          'type' => 'currency'
        ],
        'contactsTemplate' => (object) [
          'type' => 'link',
          'view' => 'crm:views/campaign/fields/template',
          'targetEntityType' => 'Contact'
        ],
        'leadsTemplate' => (object) [
          'type' => 'link',
          'view' => 'crm:views/campaign/fields/template',
          'targetEntityType' => 'Lead'
        ],
        'accountsTemplate' => (object) [
          'type' => 'link',
          'view' => 'crm:views/campaign/fields/template',
          'targetEntityType' => 'Account'
        ],
        'usersTemplate' => (object) [
          'type' => 'link',
          'view' => 'crm:views/campaign/fields/template',
          'targetEntityType' => 'User'
        ],
        'mailMergeOnlyWithAddress' => (object) [
          'type' => 'bool',
          'default' => true
        ],
        'revenueCurrency' => (object) [
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'type' => 'enum',
          'view' => 'views/fields/currency-list',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'customizationRequiredDisabled' => true,
          'customizationOptionsDisabled' => true,
          'customizationIsSortedDisabled' => true,
          'customizationDisplayAsLabelDisabled' => true,
          'customizationAuditedDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true,
          'customizationDefaultView' => 'views/admin/field-manager/fields/currency-default',
          'customizationTooltipTextDisabled' => true,
          'maxLength' => 3
        ],
        'revenueConverted' => (object) [
          'notStorable' => true,
          'directAccessDisabled' => true,
          'readOnly' => true,
          'type' => 'currencyConverted',
          'importDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'budgetCurrency' => (object) [
          'type' => 'enum',
          'view' => 'views/fields/currency-list',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'customizationRequiredDisabled' => true,
          'customizationOptionsDisabled' => true,
          'customizationIsSortedDisabled' => true,
          'customizationDisplayAsLabelDisabled' => true,
          'customizationAuditedDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true,
          'customizationDefaultView' => 'views/admin/field-manager/fields/currency-default',
          'customizationTooltipTextDisabled' => true,
          'maxLength' => 3
        ],
        'budgetConverted' => (object) [
          'type' => 'currencyConverted',
          'readOnly' => true,
          'importDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'targetLists' => (object) [
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'campaigns'
        ],
        'excludingTargetLists' => (object) [
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'campaignsExcluding',
          'relationName' => 'campaignTargetListExcluding'
        ],
        'accounts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Account',
          'foreign' => 'campaign'
        ],
        'contacts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'campaign'
        ],
        'leads' => (object) [
          'type' => 'hasMany',
          'entity' => 'Lead',
          'foreign' => 'campaign'
        ],
        'opportunities' => (object) [
          'type' => 'hasMany',
          'entity' => 'Opportunity',
          'foreign' => 'campaign'
        ],
        'campaignLogRecords' => (object) [
          'type' => 'hasMany',
          'entity' => 'CampaignLogRecord',
          'foreign' => 'campaign'
        ],
        'trackingUrls' => (object) [
          'type' => 'hasMany',
          'entity' => 'CampaignTrackingUrl',
          'foreign' => 'campaign'
        ],
        'massEmails' => (object) [
          'type' => 'hasMany',
          'entity' => 'MassEmail',
          'foreign' => 'campaign',
          'layoutRelationshipsDisabled' => true
        ],
        'contactsTemplate' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Template',
          'noJoin' => true
        ],
        'leadsTemplate' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Template',
          'noJoin' => true
        ],
        'accountsTemplate' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Template',
          'noJoin' => true
        ],
        'usersTemplate' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Template',
          'noJoin' => true
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ],
      'indexes' => (object) [
        'createdAt' => (object) [
          'columns' => [
            0 => 'createdAt',
            1 => 'deleted'
          ]
        ]
      ]
    ],
    'CampaignLogRecord' => (object) [
      'fields' => (object) [
        'action' => (object) [
          'type' => 'enum',
          'required' => true,
          'maxLength' => 50,
          'options' => [
            0 => 'Sent',
            1 => 'Opened',
            2 => 'Opted Out',
            3 => 'Bounced',
            4 => 'Clicked',
            5 => 'Opted In',
            6 => 'Lead Created'
          ]
        ],
        'actionDate' => (object) [
          'type' => 'datetime',
          'required' => true
        ],
        'data' => (object) [
          'type' => 'jsonObject',
          'view' => 'crm:views/campaign-log-record/fields/data'
        ],
        'stringData' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'stringAdditionalData' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'application' => (object) [
          'type' => 'varchar',
          'required' => true,
          'maxLength' => 36,
          'default' => 'Espo'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'fieldManagerParamList' => []
        ],
        'campaign' => (object) [
          'type' => 'link'
        ],
        'parent' => (object) [
          'type' => 'linkParent'
        ],
        'object' => (object) [
          'type' => 'linkParent'
        ],
        'queueItem' => (object) [
          'type' => 'link'
        ],
        'isTest' => (object) [
          'type' => 'bool',
          'default' => false
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'campaign' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'campaignLogRecords'
        ],
        'queueItem' => (object) [
          'type' => 'belongsTo',
          'entity' => 'EmailQueueItem',
          'noJoin' => true
        ],
        'parent' => (object) [
          'type' => 'belongsToParent',
          'entityList' => [
            0 => 'Account',
            1 => 'Contact',
            2 => 'Lead',
            3 => 'Opportunity',
            4 => 'User'
          ]
        ],
        'object' => (object) [
          'type' => 'belongsToParent',
          'entityList' => [
            0 => 'Email',
            1 => 'CampaignTrackingUrl'
          ]
        ]
      ],
      'collection' => (object) [
        'textFilterFields' => [
          0 => 'queueItem.id',
          1 => 'queueItem.emailAddress'
        ],
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ],
      'indexes' => (object) [
        'actionDate' => (object) [
          'columns' => [
            0 => 'actionDate',
            1 => 'deleted'
          ]
        ],
        'action' => (object) [
          'columns' => [
            0 => 'action',
            1 => 'deleted'
          ]
        ]
      ]
    ],
    'CampaignTrackingUrl' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true
        ],
        'url' => (object) [
          'type' => 'url',
          'tooltip' => true
        ],
        'urlToUse' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'readOnly' => true
        ],
        'campaign' => (object) [
          'type' => 'link'
        ],
        'action' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Redirect',
            1 => 'Show Message'
          ],
          'default' => 'Redirect'
        ],
        'message' => (object) [
          'type' => 'text',
          'tooltip' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'fieldManagerParamList' => []
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'fieldManagerParamList' => []
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'campaign' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'trackingUrls'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'name',
        'order' => 'asc',
        'sortBy' => 'name',
        'asc' => true
      ]
    ],
    'Case' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'number' => (object) [
          'type' => 'autoincrement',
          'index' => true
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'New',
            1 => 'Assigned',
            2 => 'Pending',
            3 => 'Closed',
            4 => 'Rejected',
            5 => 'Duplicate'
          ],
          'default' => 'New',
          'style' => (object) [
            'Closed' => 'success',
            'Duplicate' => 'danger',
            'Rejected' => 'danger'
          ],
          'audited' => true,
          'fieldManagerAdditionalParamList' => [
            0 => (object) [
              'name' => 'notActualOptions',
              'view' => 'views/admin/field-manager/fields/not-actual-options'
            ]
          ],
          'notActualOptions' => [
            0 => 'Closed',
            1 => 'Rejected',
            2 => 'Duplicate'
          ],
          'customizationOptionsReferenceDisabled' => true
        ],
        'priority' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Low',
            1 => 'Normal',
            2 => 'High',
            3 => 'Urgent'
          ],
          'default' => 'Normal',
          'displayAsLabel' => true,
          'style' => (object) [
            'High' => 'warning',
            'Urgent' => 'danger'
          ],
          'audited' => true,
          'customizationOptionsReferenceDisabled' => true
        ],
        'type' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Question',
            2 => 'Incident',
            3 => 'Problem'
          ],
          'audited' => true,
          'customizationOptionsReferenceDisabled' => true
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'account' => (object) [
          'type' => 'link'
        ],
        'lead' => (object) [
          'type' => 'link'
        ],
        'contact' => (object) [
          'type' => 'link',
          'view' => 'crm:views/case/fields/contact'
        ],
        'contacts' => (object) [
          'type' => 'linkMultiple',
          'view' => 'crm:views/case/fields/contacts',
          'orderBy' => 'name',
          'detailLayoutIncompatibleFieldList' => [
            0 => 'contact'
          ]
        ],
        'inboundEmail' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'attachments' => (object) [
          'type' => 'attachmentMultiple'
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'inboundEmail' => (object) [
          'type' => 'belongsTo',
          'entity' => 'InboundEmail'
        ],
        'account' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Account',
          'foreign' => 'cases'
        ],
        'lead' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Lead',
          'foreign' => 'cases'
        ],
        'contact' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Contact',
          'foreign' => 'casesPrimary'
        ],
        'contacts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'cases',
          'layoutRelationshipsDisabled' => true
        ],
        'meetings' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Meeting',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
          'audited' => true
        ],
        'calls' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Call',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
          'audited' => true
        ],
        'tasks' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Task',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
          'audited' => true
        ],
        'emails' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Email',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true
        ],
        'articles' => (object) [
          'type' => 'hasMany',
          'entity' => 'KnowledgeBaseArticle',
          'foreign' => 'cases',
          'audited' => true
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'number',
        'order' => 'desc',
        'textFilterFields' => [
          0 => 'name',
          1 => 'number'
        ],
        'sortBy' => 'number',
        'asc' => false
      ],
      'indexes' => (object) [
        'status' => (object) [
          'columns' => [
            0 => 'status',
            1 => 'deleted'
          ]
        ],
        'assignedUser' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'deleted'
          ]
        ],
        'assignedUserStatus' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'status'
          ]
        ]
      ]
    ],
    'Contact' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'personName',
          'isPersonalData' => true
        ],
        'salutationName' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Mr.',
            2 => 'Ms.',
            3 => 'Mrs.',
            4 => 'Dr.'
          ]
        ],
        'firstName' => (object) [
          'type' => 'varchar',
          'pattern' => '$noBadCharacters',
          'maxLength' => 100
        ],
        'lastName' => (object) [
          'type' => 'varchar',
          'pattern' => '$noBadCharacters',
          'maxLength' => 100,
          'required' => true
        ],
        'accountAnyId' => (object) [
          'notStorable' => true,
          'customizationDisabled' => true,
          'utility' => true,
          'type' => 'varchar',
          'where' => (object) [
            '=' => (object) [
              'whereClause' => (object) [
                'id=s' => (object) [
                  'from' => 'AccountContact',
                  'select' => [
                    0 => 'contactId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'accountId' => '{value}'
                  ]
                ]
              ]
            ],
            '<>' => (object) [
              'whereClause' => (object) [
                'id!=s' => (object) [
                  'from' => 'AccountContact',
                  'select' => [
                    0 => 'contactId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'accountId' => '{value}'
                  ]
                ]
              ]
            ],
            'IN' => (object) [
              'whereClause' => (object) [
                'id=s' => (object) [
                  'from' => 'AccountContact',
                  'select' => [
                    0 => 'contactId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'accountId' => '{value}'
                  ]
                ]
              ]
            ],
            'NOT IN' => (object) [
              'whereClause' => (object) [
                'id!=s' => (object) [
                  'from' => 'AccountContact',
                  'select' => [
                    0 => 'contactId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'accountId' => '{value}'
                  ]
                ]
              ]
            ],
            'IS NULL' => (object) [
              'whereClause' => (object) [
                'accountId' => NULL
              ]
            ],
            'IS NOT NULL' => (object) [
              'whereClause' => (object) [
                'accountId!=' => NULL
              ]
            ]
          ]
        ],
        'title' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'view' => 'crm:views/contact/fields/title',
          'directUpdateDisabled' => true,
          'notStorable' => true,
          'select' => (object) [
            'select' => 'accountContactPrimary.role',
            'leftJoins' => [
              0 => [
                0 => 'AccountContact',
                1 => 'accountContactPrimary',
                2 => (object) [
                  'contact.id:' => 'accountContactPrimary.contactId',
                  'contact.accountId:' => 'accountContactPrimary.accountId',
                  'accountContactPrimary.deleted' => false
                ]
              ]
            ]
          ],
          'order' => (object) [
            'order' => [
              0 => [
                0 => 'accountContactPrimary.role',
                1 => '{direction}'
              ]
            ],
            'leftJoins' => [
              0 => [
                0 => 'AccountContact',
                1 => 'accountContactPrimary',
                2 => (object) [
                  'contact.id:' => 'accountContactPrimary.contactId',
                  'contact.accountId:' => 'accountContactPrimary.accountId',
                  'accountContactPrimary.deleted' => false
                ]
              ]
            ]
          ],
          'where' => (object) [
            'LIKE' => (object) [
              'whereClause' => (object) [
                'id=s' => (object) [
                  'from' => 'AccountContact',
                  'select' => [
                    0 => 'contactId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'role*' => '{value}'
                  ]
                ]
              ]
            ],
            'NOT LIKE' => (object) [
              'whereClause' => (object) [
                'id!=s' => (object) [
                  'from' => 'AccountContact',
                  'select' => [
                    0 => 'contactId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'role*' => '{value}'
                  ]
                ]
              ]
            ],
            '=' => (object) [
              'whereClause' => (object) [
                'id=s' => (object) [
                  'from' => 'AccountContact',
                  'select' => [
                    0 => 'contactId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'role' => '{value}'
                  ]
                ]
              ]
            ],
            '<>' => (object) [
              'whereClause' => (object) [
                'id!=s' => (object) [
                  'from' => 'AccountContact',
                  'select' => [
                    0 => 'contactId'
                  ],
                  'whereClause' => (object) [
                    'deleted' => false,
                    'role' => '{value}'
                  ]
                ]
              ]
            ],
            'IS NULL' => (object) [
              'whereClause' => (object) [
                'NOT' => (object) [
                  'EXISTS' => (object) [
                    'from' => 'Contact',
                    'fromAlias' => 'sq',
                    'select' => [
                      0 => 'id'
                    ],
                    'leftJoins' => [
                      0 => [
                        0 => 'accounts',
                        1 => 'm',
                        2 => (object) [],
                        3 => (object) [
                          'onlyMiddle' => true
                        ]
                      ]
                    ],
                    'whereClause' => (object) [
                      'AND' => [
                        0 => (object) [
                          'm.role!=' => NULL
                        ],
                        1 => (object) [
                          'm.role!=' => ''
                        ],
                        2 => (object) [
                          'sq.id:' => 'contact.id'
                        ]
                      ]
                    ]
                  ]
                ]
              ]
            ],
            'IS NOT NULL' => (object) [
              'whereClause' => (object) [
                'EXISTS' => (object) [
                  'from' => 'Contact',
                  'fromAlias' => 'sq',
                  'select' => [
                    0 => 'id'
                  ],
                  'leftJoins' => [
                    0 => [
                      0 => 'accounts',
                      1 => 'm',
                      2 => (object) [],
                      3 => (object) [
                        'onlyMiddle' => true
                      ]
                    ]
                  ],
                  'whereClause' => (object) [
                    'AND' => [
                      0 => (object) [
                        'm.role!=' => NULL
                      ],
                      1 => (object) [
                        'm.role!=' => ''
                      ],
                      2 => (object) [
                        'sq.id:' => 'contact.id'
                      ]
                    ]
                  ]
                ]
              ]
            ]
          ],
          'customizationOptionsDisabled' => true,
          'textFilterDisabled' => true
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'emailAddress' => (object) [
          'type' => 'email',
          'isPersonalData' => true
        ],
        'phoneNumber' => (object) [
          'type' => 'phone',
          'typeList' => [
            0 => 'Mobile',
            1 => 'Office',
            2 => 'Home',
            3 => 'Fax',
            4 => 'Other'
          ],
          'defaultType' => 'Mobile',
          'isPersonalData' => true
        ],
        'doNotCall' => (object) [
          'type' => 'bool'
        ],
        'address' => (object) [
          'type' => 'address',
          'isPersonalData' => true
        ],
        'addressStreet' => (object) [
          'type' => 'text',
          'maxLength' => 255,
          'dbType' => 'varchar'
        ],
        'addressCity' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-city',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressState' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-state',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressCountry' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-country',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressPostalCode' => (object) [
          'type' => 'varchar',
          'maxLength' => 40,
          'pattern' => '$noBadCharacters'
        ],
        'account' => (object) [
          'type' => 'link',
          'view' => 'crm:views/contact/fields/account'
        ],
        'accounts' => (object) [
          'type' => 'linkMultiple',
          'view' => 'crm:views/contact/fields/accounts',
          'columns' => (object) [
            'role' => 'contactRole',
            'isInactive' => 'contactIsInactive'
          ],
          'additionalAttributeList' => [
            0 => 'columns'
          ],
          'orderBy' => 'name',
          'detailLayoutIncompatibleFieldList' => [
            0 => 'account'
          ]
        ],
        'accountRole' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'directUpdateDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutFiltersDisabled' => true,
          'layoutAvailabilityList' => [
            0 => 'listForAccount'
          ],
          'exportDisabled' => true,
          'importDisabled' => true,
          'view' => 'crm:views/contact/fields/account-role',
          'customizationOptionsDisabled' => true,
          'textFilterDisabled' => true
        ],
        'accountIsInactive' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'mergeDisabled' => true,
          'select' => (object) [
            'select' => 'accountContactPrimary.isInactive',
            'leftJoins' => [
              0 => [
                0 => 'AccountContact',
                1 => 'accountContactPrimary',
                2 => (object) [
                  'contact.id:' => 'accountContactPrimary.contactId',
                  'contact.accountId:' => 'accountContactPrimary.accountId',
                  'accountContactPrimary.deleted' => false
                ]
              ]
            ]
          ],
          'order' => (object) [
            'order' => [
              0 => [
                0 => 'accountContactPrimary.isInactive',
                1 => '{direction}'
              ]
            ],
            'leftJoins' => [
              0 => [
                0 => 'AccountContact',
                1 => 'accountContactPrimary',
                2 => (object) [
                  'contact.id:' => 'accountContactPrimary.contactId',
                  'contact.accountId:' => 'accountContactPrimary.accountId',
                  'accountContactPrimary.deleted' => false
                ]
              ]
            ]
          ],
          'where' => (object) [
            '= TRUE' => (object) [
              'leftJoins' => [
                0 => [
                  0 => 'AccountContact',
                  1 => 'accountContactFilterIsInactive',
                  2 => (object) [
                    'accountContactFilterIsInactive.contactId:' => 'id',
                    'accountContactFilterIsInactive.accountId:' => 'accountId',
                    'accountContactFilterIsInactive.deleted' => false
                  ]
                ]
              ],
              'whereClause' => (object) [
                'accountContactFilterIsInactive.isInactive' => true
              ]
            ],
            '= FALSE' => (object) [
              'leftJoins' => [
                0 => [
                  0 => 'AccountContact',
                  1 => 'accountContactFilterIsInactive',
                  2 => (object) [
                    'accountContactFilterIsInactive.contactId:' => 'id',
                    'accountContactFilterIsInactive.accountId:' => 'accountId',
                    'accountContactFilterIsInactive.deleted' => false
                  ]
                ]
              ],
              'whereClause' => (object) [
                'OR' => [
                  0 => (object) [
                    'accountContactFilterIsInactive.isInactive!=' => true
                  ],
                  1 => (object) [
                    'accountContactFilterIsInactive.isInactive=' => NULL
                  ]
                ]
              ]
            ]
          ],
          'layoutListDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true
        ],
        'accountType' => (object) [
          'type' => 'foreign',
          'link' => 'account',
          'field' => 'type',
          'readOnly' => true,
          'view' => 'views/fields/foreign-enum'
        ],
        'opportunityRole' => (object) [
          'type' => 'enum',
          'notStorable' => true,
          'options' => [
            0 => '',
            1 => 'Decision Maker',
            2 => 'Evaluator',
            3 => 'Influencer'
          ],
          'layoutMassUpdateDisabled' => true,
          'layoutListDisabled' => true,
          'layoutDetailDisabled' => true,
          'customizationRequiredDisabled' => true,
          'customizationIsSortedDisabled' => true,
          'customizationAuditedDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'converterClassName' => 'Espo\\Classes\\FieldConverters\\RelationshipRole',
          'converterData' => (object) [
            'column' => 'role',
            'link' => 'opportunities',
            'relationName' => 'contactOpportunity',
            'nearKey' => 'contactId'
          ],
          'view' => 'crm:views/contact/fields/opportunity-role'
        ],
        'acceptanceStatus' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'exportDisabled' => true,
          'utility' => true,
          'fieldManagerParamList' => []
        ],
        'acceptanceStatusMeetings' => (object) [
          'type' => 'enum',
          'notStorable' => true,
          'directUpdateDisabled' => true,
          'layoutAvailabilityList' => [
            0 => 'filters'
          ],
          'importDisabled' => true,
          'exportDisabled' => true,
          'view' => 'crm:views/lead/fields/acceptance-status',
          'link' => 'meetings',
          'column' => 'status',
          'fieldManagerParamList' => []
        ],
        'acceptanceStatusCalls' => (object) [
          'type' => 'enum',
          'notStorable' => true,
          'directUpdateDisabled' => true,
          'layoutAvailabilityList' => [
            0 => 'filters'
          ],
          'importDisabled' => true,
          'exportDisabled' => true,
          'view' => 'crm:views/lead/fields/acceptance-status',
          'link' => 'calls',
          'column' => 'status',
          'fieldManagerParamList' => []
        ],
        'campaign' => (object) [
          'type' => 'link'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'targetLists' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'importDisabled' => true,
          'noLoad' => true
        ],
        'targetList' => (object) [
          'type' => 'link',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutFiltersDisabled' => true,
          'exportDisabled' => true,
          'entity' => 'TargetList',
          'directAccessDisabled' => true
        ],
        'portalUser' => (object) [
          'type' => 'linkOne',
          'readOnly' => true,
          'notStorable' => true,
          'view' => 'views/fields/link-one'
        ],
        'hasPortalUser' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'readOnly' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'foreignAccessDisabled' => true,
          'select' => (object) [
            'select' => 'IS_NOT_NULL:(portalUser.id)',
            'leftJoins' => [
              0 => [
                0 => 'portalUser',
                1 => 'portalUser'
              ]
            ]
          ],
          'where' => (object) [
            '= TRUE' => (object) [
              'whereClause' => (object) [
                'portalUser.id!=' => NULL
              ],
              'leftJoins' => [
                0 => [
                  0 => 'portalUser',
                  1 => 'portalUser'
                ]
              ]
            ],
            '= FALSE' => (object) [
              'whereClause' => (object) [
                'portalUser.id=' => NULL
              ],
              'leftJoins' => [
                0 => [
                  0 => 'portalUser',
                  1 => 'portalUser'
                ]
              ]
            ]
          ],
          'order' => (object) [
            'order' => [
              0 => [
                0 => 'portalUser.id',
                1 => '{direction}'
              ]
            ],
            'leftJoins' => [
              0 => [
                0 => 'portalUser',
                1 => 'portalUser'
              ]
            ],
            'additionalSelect' => [
              0 => 'portalUser.id'
            ]
          ]
        ],
        'originalLead' => (object) [
          'type' => 'linkOne',
          'readOnly' => true,
          'view' => 'views/fields/link-one'
        ],
        'targetListIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'middleName' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'pattern' => '$noBadCharacters'
        ],
        'emailAddressIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'emailAddressIsInvalid' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'phoneNumberIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'phoneNumberIsInvalid' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'addressMap' => (object) [
          'type' => 'map',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'provider' => 'Google',
          'height' => 300,
          'exportDisabled' => true,
          'importDisabled' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'account' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Account'
        ],
        'accounts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Account',
          'foreign' => 'contacts',
          'additionalColumns' => (object) [
            'role' => (object) [
              'type' => 'varchar',
              'len' => 100
            ],
            'isInactive' => (object) [
              'type' => 'bool',
              'default' => false
            ]
          ],
          'additionalAttributeList' => [
            0 => 'columns'
          ],
          'layoutRelationshipsDisabled' => true,
          'columnAttributeMap' => (object) [
            'role' => 'accountRole',
            'isInactive' => 'accountIsInactive'
          ]
        ],
        'opportunities' => (object) [
          'type' => 'hasMany',
          'entity' => 'Opportunity',
          'foreign' => 'contacts',
          'columnAttributeMap' => (object) [
            'role' => 'opportunityRole'
          ]
        ],
        'opportunitiesPrimary' => (object) [
          'type' => 'hasMany',
          'entity' => 'Opportunity',
          'foreign' => 'contact',
          'layoutRelationshipsDisabled' => true
        ],
        'casesPrimary' => (object) [
          'type' => 'hasMany',
          'entity' => 'Case',
          'foreign' => 'contact',
          'layoutRelationshipsDisabled' => true
        ],
        'cases' => (object) [
          'type' => 'hasMany',
          'entity' => 'Case',
          'foreign' => 'contacts'
        ],
        'meetings' => (object) [
          'type' => 'hasMany',
          'entity' => 'Meeting',
          'foreign' => 'contacts',
          'layoutRelationshipsDisabled' => true,
          'audited' => true,
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'calls' => (object) [
          'type' => 'hasMany',
          'entity' => 'Call',
          'foreign' => 'contacts',
          'layoutRelationshipsDisabled' => true,
          'audited' => true,
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'tasks' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Task',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
          'audited' => true
        ],
        'emails' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Email',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true
        ],
        'campaign' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'contacts'
        ],
        'campaignLogRecords' => (object) [
          'type' => 'hasChildren',
          'entity' => 'CampaignLogRecord',
          'foreign' => 'parent'
        ],
        'targetLists' => (object) [
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'contacts',
          'columnAttributeMap' => (object) [
            'optedOut' => 'targetListIsOptedOut'
          ]
        ],
        'portalUser' => (object) [
          'type' => 'hasOne',
          'entity' => 'User',
          'foreign' => 'contact'
        ],
        'originalLead' => (object) [
          'type' => 'hasOne',
          'entity' => 'Lead',
          'foreign' => 'createdContact'
        ],
        'documents' => (object) [
          'type' => 'hasMany',
          'entity' => 'Document',
          'foreign' => 'contacts',
          'audited' => true
        ],
        'tasksPrimary' => (object) [
          'type' => 'hasMany',
          'entity' => 'Task',
          'foreign' => 'contact',
          'layoutRelationshipsDisabled' => true
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'textFilterFields' => [
          0 => 'name',
          1 => 'emailAddress'
        ],
        'sortBy' => 'createdAt',
        'asc' => false
      ],
      'indexes' => (object) [
        'createdAt' => (object) [
          'columns' => [
            0 => 'createdAt',
            1 => 'deleted'
          ]
        ],
        'createdAtId' => (object) [
          'unique' => true,
          'columns' => [
            0 => 'createdAt',
            1 => 'id'
          ]
        ],
        'firstName' => (object) [
          'columns' => [
            0 => 'firstName',
            1 => 'deleted'
          ]
        ],
        'name' => (object) [
          'columns' => [
            0 => 'firstName',
            1 => 'lastName'
          ]
        ],
        'assignedUser' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'deleted'
          ]
        ]
      ]
    ],
    'Document' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'view' => 'crm:views/document/fields/name',
          'pattern' => '$noBadCharacters'
        ],
        'file' => (object) [
          'type' => 'file',
          'required' => true,
          'view' => 'crm:views/document/fields/file',
          'accept' => [
            0 => '.pdf',
            1 => '.odt',
            2 => '.ods',
            3 => '.odp',
            4 => '.docx',
            5 => '.xlsx',
            6 => '.pptx',
            7 => '.doc',
            8 => '.xls',
            9 => '.ppt',
            10 => '.rtf',
            11 => '.csv',
            12 => '.md',
            13 => '.txt'
          ]
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Active',
            1 => 'Draft',
            2 => 'Expired',
            3 => 'Canceled'
          ],
          'style' => (object) [
            'Canceled' => 'danger',
            'Expired' => 'danger'
          ],
          'customizationOptionsReferenceDisabled' => true
        ],
        'type' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Contract',
            2 => 'NDA',
            3 => 'EULA',
            4 => 'License Agreement'
          ],
          'customizationOptionsReferenceDisabled' => true
        ],
        'publishDate' => (object) [
          'type' => 'date',
          'required' => true,
          'default' => 'javascript: return this.dateTime.getToday();'
        ],
        'expirationDate' => (object) [
          'type' => 'date',
          'after' => 'publishDate'
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'accounts' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'importDisabled' => true,
          'noLoad' => true
        ],
        'folder' => (object) [
          'type' => 'link',
          'view' => 'views/fields/link-category-tree'
        ]
      ],
      'links' => (object) [
        'accounts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Account',
          'foreign' => 'documents'
        ],
        'opportunities' => (object) [
          'type' => 'hasMany',
          'entity' => 'Opportunity',
          'foreign' => 'documents'
        ],
        'leads' => (object) [
          'type' => 'hasMany',
          'entity' => 'Lead',
          'foreign' => 'documents'
        ],
        'contacts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'documents'
        ],
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'folder' => (object) [
          'type' => 'belongsTo',
          'foreign' => 'documents',
          'entity' => 'DocumentFolder'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ]
    ],
    'DocumentFolder' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'fieldManagerParamList' => []
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'parent' => (object) [
          'type' => 'link'
        ],
        'childList' => (object) [
          'type' => 'jsonArray',
          'notStorable' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'parent' => (object) [
          'type' => 'belongsTo',
          'foreign' => 'children',
          'entity' => 'DocumentFolder'
        ],
        'children' => (object) [
          'type' => 'hasMany',
          'foreign' => 'parent',
          'entity' => 'DocumentFolder'
        ],
        'documents' => (object) [
          'type' => 'hasMany',
          'foreign' => 'folder',
          'entity' => 'Document'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'parent',
        'order' => 'asc',
        'sortBy' => 'parent',
        'asc' => true
      ],
      'additionalTables' => (object) [
        'DocumentFolderPath' => (object) [
          'attributes' => (object) [
            'id' => (object) [
              'type' => 'id',
              'dbType' => 'integer',
              'len' => 11,
              'autoincrement' => true
            ],
            'ascendorId' => (object) [
              'type' => 'foreignId',
              'index' => true
            ],
            'descendorId' => (object) [
              'type' => 'foreignId',
              'index' => true
            ]
          ]
        ]
      ]
    ],
    'EmailQueueItem' => (object) [
      'fields' => (object) [
        'massEmail' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Pending',
            1 => 'Sent',
            2 => 'Failed',
            3 => 'Sending'
          ],
          'readOnly' => true
        ],
        'attemptCount' => (object) [
          'type' => 'int',
          'readOnly' => true,
          'default' => 0
        ],
        'target' => (object) [
          'type' => 'linkParent',
          'readOnly' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'sentAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'emailAddress' => (object) [
          'type' => 'varchar',
          'readOnly' => true
        ],
        'isTest' => (object) [
          'type' => 'bool'
        ]
      ],
      'links' => (object) [
        'massEmail' => (object) [
          'type' => 'belongsTo',
          'entity' => 'MassEmail',
          'foreign' => 'queueItems'
        ],
        'target' => (object) [
          'type' => 'belongsToParent'
        ]
      ],
      'collection' => (object) [
        'textFilterFields' => [
          0 => 'id',
          1 => 'emailAddress'
        ],
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ]
    ],
    'KnowledgeBaseArticle' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Draft',
            1 => 'In Review',
            2 => 'Published',
            3 => 'Archived'
          ],
          'view' => 'crm:views/knowledge-base-article/fields/status',
          'default' => 'Draft',
          'customizationOptionsReferenceDisabled' => true
        ],
        'language' => (object) [
          'type' => 'enum',
          'view' => 'crm:views/knowledge-base-article/fields/language',
          'customizationOptionsDisabled' => true,
          'customizationOptionsReferenceDisabled' => true
        ],
        'type' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Article'
          ],
          'default' => 'Article'
        ],
        'portals' => (object) [
          'type' => 'linkMultiple',
          'tooltip' => true
        ],
        'publishDate' => (object) [
          'type' => 'date'
        ],
        'expirationDate' => (object) [
          'type' => 'date',
          'after' => 'publishDate'
        ],
        'order' => (object) [
          'type' => 'int',
          'disableFormatting' => true,
          'textFilterDisabled' => true
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'fieldManagerParamList' => []
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'categories' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/link-multiple-category-tree'
        ],
        'attachments' => (object) [
          'type' => 'attachmentMultiple'
        ],
        'body' => (object) [
          'type' => 'wysiwyg'
        ]
      ],
      'links' => (object) [
        'cases' => (object) [
          'type' => 'hasMany',
          'entity' => 'Case',
          'foreign' => 'articles'
        ],
        'portals' => (object) [
          'type' => 'hasMany',
          'entity' => 'Portal',
          'foreign' => 'articles'
        ],
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'categories' => (object) [
          'type' => 'hasMany',
          'foreign' => 'articles',
          'entity' => 'KnowledgeBaseCategory'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'order',
        'order' => 'asc',
        'sortBy' => 'order',
        'asc' => true
      ],
      'optimisticConcurrencyControl' => true
    ],
    'KnowledgeBaseCategory' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'fieldManagerParamList' => []
        ],
        'order' => (object) [
          'type' => 'int',
          'required' => true,
          'disableFormatting' => true,
          'textFilterDisabled' => true
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'parent' => (object) [
          'type' => 'link'
        ],
        'childList' => (object) [
          'type' => 'jsonArray',
          'notStorable' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'parent' => (object) [
          'type' => 'belongsTo',
          'foreign' => 'children',
          'entity' => 'KnowledgeBaseCategory'
        ],
        'children' => (object) [
          'type' => 'hasMany',
          'foreign' => 'parent',
          'entity' => 'KnowledgeBaseCategory'
        ],
        'articles' => (object) [
          'type' => 'hasMany',
          'foreign' => 'categories',
          'entity' => 'KnowledgeBaseArticle'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'parent',
        'orderByColumn' => 'parentId',
        'order' => 'asc',
        'sortBy' => 'parent',
        'asc' => true
      ],
      'additionalTables' => (object) [
        'KnowledgeBaseCategoryPath' => (object) [
          'attributes' => (object) [
            'id' => (object) [
              'type' => 'id',
              'dbType' => 'integer',
              'len' => 11,
              'autoincrement' => true
            ],
            'ascendorId' => (object) [
              'type' => 'foreignId',
              'index' => true
            ],
            'descendorId' => (object) [
              'type' => 'foreignId',
              'index' => true
            ]
          ]
        ]
      ]
    ],
    'Lead' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'personName',
          'isPersonalData' => true,
          'dependeeAttributeList' => [
            0 => 'emailAddress',
            1 => 'phoneNumber',
            2 => 'accountName'
          ]
        ],
        'salutationName' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Mr.',
            2 => 'Ms.',
            3 => 'Mrs.',
            4 => 'Dr.'
          ]
        ],
        'firstName' => (object) [
          'type' => 'varchar',
          'pattern' => '$noBadCharacters',
          'maxLength' => 100
        ],
        'lastName' => (object) [
          'type' => 'varchar',
          'pattern' => '$noBadCharacters',
          'maxLength' => 100
        ],
        'title' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'pattern' => '$noBadCharacters'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'New',
            1 => 'Assigned',
            2 => 'In Process',
            3 => 'Converted',
            4 => 'Recycled',
            5 => 'Dead'
          ],
          'default' => 'New',
          'style' => (object) [
            'Converted' => 'success',
            'Recycled' => 'danger',
            'Dead' => 'danger'
          ],
          'audited' => true,
          'fieldManagerAdditionalParamList' => [
            0 => (object) [
              'name' => 'notActualOptions',
              'view' => 'views/admin/field-manager/fields/not-actual-options'
            ]
          ],
          'notActualOptions' => [
            0 => 'Converted',
            1 => 'Recycled',
            2 => 'Dead'
          ],
          'customizationOptionsReferenceDisabled' => true
        ],
        'source' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Call',
            2 => 'Email',
            3 => 'Existing Customer',
            4 => 'Partner',
            5 => 'Public Relations',
            6 => 'Web Site',
            7 => 'Campaign',
            8 => 'Other'
          ],
          'customizationOptionsReferenceDisabled' => true
        ],
        'industry' => (object) [
          'type' => 'enum',
          'view' => 'crm:views/lead/fields/industry',
          'customizationOptionsDisabled' => true,
          'optionsReference' => 'Account.industry',
          'isSorted' => true
        ],
        'opportunityAmount' => (object) [
          'type' => 'currency',
          'min' => 0,
          'decimal' => false,
          'audited' => true
        ],
        'opportunityAmountConverted' => (object) [
          'type' => 'currencyConverted',
          'readOnly' => true,
          'importDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'website' => (object) [
          'type' => 'url',
          'strip' => true
        ],
        'address' => (object) [
          'type' => 'address',
          'isPersonalData' => true
        ],
        'addressStreet' => (object) [
          'type' => 'text',
          'maxLength' => 255,
          'dbType' => 'varchar'
        ],
        'addressCity' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-city',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressState' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-state',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressCountry' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-country',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressPostalCode' => (object) [
          'type' => 'varchar',
          'maxLength' => 40,
          'pattern' => '$noBadCharacters'
        ],
        'emailAddress' => (object) [
          'type' => 'email',
          'isPersonalData' => true
        ],
        'phoneNumber' => (object) [
          'type' => 'phone',
          'typeList' => [
            0 => 'Mobile',
            1 => 'Office',
            2 => 'Home',
            3 => 'Fax',
            4 => 'Other'
          ],
          'defaultType' => 'Mobile',
          'isPersonalData' => true
        ],
        'doNotCall' => (object) [
          'type' => 'bool'
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'convertedAt' => (object) [
          'type' => 'datetime',
          'layoutMassUpdateDisabled' => true,
          'readOnly' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'accountName' => (object) [
          'type' => 'varchar',
          'pattern' => '$noBadCharacters'
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'view' => 'views/fields/assigned-user'
        ],
        'acceptanceStatus' => (object) [
          'type' => 'varchar',
          'notStorable' => true,
          'exportDisabled' => true,
          'utility' => true,
          'fieldManagerParamList' => []
        ],
        'acceptanceStatusMeetings' => (object) [
          'type' => 'enum',
          'notStorable' => true,
          'directUpdateDisabled' => true,
          'layoutAvailabilityList' => [
            0 => 'filters'
          ],
          'importDisabled' => true,
          'exportDisabled' => true,
          'view' => 'crm:views/lead/fields/acceptance-status',
          'link' => 'meetings',
          'column' => 'status',
          'fieldManagerParamList' => []
        ],
        'acceptanceStatusCalls' => (object) [
          'type' => 'enum',
          'notStorable' => true,
          'directUpdateDisabled' => true,
          'layoutAvailabilityList' => [
            0 => 'filters'
          ],
          'importDisabled' => true,
          'exportDisabled' => true,
          'view' => 'crm:views/lead/fields/acceptance-status',
          'link' => 'calls',
          'column' => 'status',
          'fieldManagerParamList' => []
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'campaign' => (object) [
          'type' => 'link'
        ],
        'createdAccount' => (object) [
          'type' => 'link',
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true
        ],
        'createdContact' => (object) [
          'type' => 'link',
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'view' => 'crm:views/lead/fields/created-contact'
        ],
        'createdOpportunity' => (object) [
          'type' => 'link',
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'view' => 'crm:views/lead/fields/created-opportunity'
        ],
        'targetLists' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'importDisabled' => true,
          'noLoad' => true
        ],
        'targetList' => (object) [
          'type' => 'link',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutFiltersDisabled' => true,
          'entity' => 'TargetList',
          'directAccessDisabled' => true
        ],
        'targetListIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'readOnly' => true,
          'utility' => true
        ],
        'middleName' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'pattern' => '$noBadCharacters'
        ],
        'opportunityAmountCurrency' => (object) [
          'type' => 'enum',
          'view' => 'views/fields/currency-list',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'customizationRequiredDisabled' => true,
          'customizationOptionsDisabled' => true,
          'customizationIsSortedDisabled' => true,
          'customizationDisplayAsLabelDisabled' => true,
          'customizationAuditedDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true,
          'customizationDefaultView' => 'views/admin/field-manager/fields/currency-default',
          'customizationTooltipTextDisabled' => true,
          'maxLength' => 3
        ],
        'addressMap' => (object) [
          'type' => 'map',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'provider' => 'Google',
          'height' => 300,
          'exportDisabled' => true,
          'importDisabled' => true
        ],
        'emailAddressIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'emailAddressIsInvalid' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'phoneNumberIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'phoneNumberIsInvalid' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'meetings' => (object) [
          'type' => 'hasMany',
          'entity' => 'Meeting',
          'foreign' => 'leads',
          'layoutRelationshipsDisabled' => true,
          'audited' => true,
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'calls' => (object) [
          'type' => 'hasMany',
          'entity' => 'Call',
          'foreign' => 'leads',
          'layoutRelationshipsDisabled' => true,
          'audited' => true,
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'tasks' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Task',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
          'audited' => true
        ],
        'cases' => (object) [
          'type' => 'hasMany',
          'entity' => 'Case',
          'foreign' => 'lead',
          'audited' => true
        ],
        'emails' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Email',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true
        ],
        'createdAccount' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Account',
          'foreign' => 'originalLead'
        ],
        'createdContact' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Contact',
          'foreign' => 'originalLead'
        ],
        'createdOpportunity' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Opportunity',
          'foreign' => 'originalLead'
        ],
        'campaign' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'leads'
        ],
        'campaignLogRecords' => (object) [
          'type' => 'hasChildren',
          'entity' => 'CampaignLogRecord',
          'foreign' => 'parent'
        ],
        'targetLists' => (object) [
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'leads',
          'columnAttributeMap' => (object) [
            'optedOut' => 'targetListIsOptedOut'
          ]
        ],
        'documents' => (object) [
          'type' => 'hasMany',
          'entity' => 'Document',
          'foreign' => 'leads',
          'audited' => true
        ]
      ],
      'convertEntityList' => [
        0 => 'Account',
        1 => 'Contact',
        2 => 'Opportunity'
      ],
      'convertFields' => (object) [
        'Contact' => (object) [],
        'Account' => (object) [
          'name' => 'accountName',
          'billingAddressStreet' => 'addressStreet',
          'billingAddressCity' => 'addressCity',
          'billingAddressState' => 'addressState',
          'billingAddressPostalCode' => 'addressPostalCode',
          'billingAddressCountry' => 'addressCountry'
        ],
        'Opportunity' => (object) [
          'amount' => 'opportunityAmount',
          'leadSource' => 'source'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'textFilterFields' => [
          0 => 'name',
          1 => 'accountName',
          2 => 'emailAddress'
        ],
        'sortBy' => 'createdAt',
        'asc' => false
      ],
      'indexes' => (object) [
        'firstName' => (object) [
          'columns' => [
            0 => 'firstName',
            1 => 'deleted'
          ]
        ],
        'name' => (object) [
          'columns' => [
            0 => 'firstName',
            1 => 'lastName'
          ]
        ],
        'status' => (object) [
          'columns' => [
            0 => 'status',
            1 => 'deleted'
          ]
        ],
        'createdAt' => (object) [
          'columns' => [
            0 => 'createdAt',
            1 => 'deleted'
          ]
        ],
        'createdAtStatus' => (object) [
          'columns' => [
            0 => 'createdAt',
            1 => 'status'
          ]
        ],
        'createdAtId' => (object) [
          'unique' => true,
          'columns' => [
            0 => 'createdAt',
            1 => 'id'
          ]
        ],
        'assignedUser' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'deleted'
          ]
        ],
        'assignedUserStatus' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'status'
          ]
        ]
      ]
    ],
    'MassEmail' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Draft',
            1 => 'Pending',
            2 => 'Complete',
            3 => 'In Process',
            4 => 'Failed'
          ],
          'default' => 'Pending'
        ],
        'storeSentEmails' => (object) [
          'type' => 'bool',
          'default' => false,
          'tooltip' => true
        ],
        'optOutEntirely' => (object) [
          'type' => 'bool',
          'default' => false,
          'tooltip' => true
        ],
        'fromAddress' => (object) [
          'type' => 'varchar',
          'view' => 'crm:views/mass-email/fields/from-address'
        ],
        'fromName' => (object) [
          'type' => 'varchar'
        ],
        'replyToAddress' => (object) [
          'type' => 'varchar'
        ],
        'replyToName' => (object) [
          'type' => 'varchar'
        ],
        'startAt' => (object) [
          'type' => 'datetime',
          'required' => true
        ],
        'emailTemplate' => (object) [
          'type' => 'link',
          'required' => true,
          'view' => 'crm:views/mass-email/fields/email-template'
        ],
        'campaign' => (object) [
          'type' => 'link'
        ],
        'targetLists' => (object) [
          'type' => 'linkMultiple',
          'required' => true,
          'tooltip' => true
        ],
        'excludingTargetLists' => (object) [
          'type' => 'linkMultiple',
          'tooltip' => true
        ],
        'inboundEmail' => (object) [
          'type' => 'link'
        ],
        'smtpAccount' => (object) [
          'type' => 'base',
          'notStorable' => true,
          'view' => 'crm:views/mass-email/fields/smtp-account'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'emailTemplate' => (object) [
          'type' => 'belongsTo',
          'entity' => 'EmailTemplate'
        ],
        'campaign' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'massEmails'
        ],
        'targetLists' => (object) [
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'massEmails'
        ],
        'excludingTargetLists' => (object) [
          'type' => 'hasMany',
          'entity' => 'TargetList',
          'foreign' => 'massEmailsExcluding',
          'relationName' => 'massEmailTargetListExcluding'
        ],
        'inboundEmail' => (object) [
          'type' => 'belongsTo',
          'entity' => 'InboundEmail'
        ],
        'queueItems' => (object) [
          'type' => 'hasMany',
          'entity' => 'EmailQueueItem',
          'foreign' => 'massEmail'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ]
    ],
    'Meeting' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Planned',
            1 => 'Held',
            2 => 'Not Held'
          ],
          'default' => 'Planned',
          'style' => (object) [
            'Held' => 'success'
          ],
          'audited' => true,
          'customizationOptionsReferenceDisabled' => true
        ],
        'dateStart' => (object) [
          'type' => 'datetimeOptional',
          'view' => 'crm:views/meeting/fields/date-start',
          'required' => true,
          'default' => 'javascript: return this.dateTime.getNow(15);',
          'audited' => true
        ],
        'dateEnd' => (object) [
          'type' => 'datetimeOptional',
          'view' => 'crm:views/meeting/fields/date-end',
          'required' => true,
          'after' => 'dateStart',
          'suppressValidationList' => [
            0 => 'required'
          ]
        ],
        'isAllDay' => (object) [
          'type' => 'bool',
          'layoutListDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true
        ],
        'duration' => (object) [
          'type' => 'duration',
          'start' => 'dateStart',
          'end' => 'dateEnd',
          'options' => [
            0 => 900,
            1 => 1800,
            2 => 3600,
            3 => 7200,
            4 => 10800,
            5 => 86400
          ],
          'default' => 3600,
          'notStorable' => true,
          'select' => (object) [
            'select' => 'TIMESTAMPDIFF_SECOND:(dateStart, dateEnd)'
          ],
          'order' => (object) [
            'order' => [
              0 => [
                0 => 'TIMESTAMPDIFF_SECOND:(dateStart, dateEnd)',
                1 => '{direction}'
              ]
            ]
          ]
        ],
        'reminders' => (object) [
          'type' => 'jsonArray',
          'notStorable' => true,
          'view' => 'crm:views/meeting/fields/reminders',
          'layoutListDisabled' => true,
          'validatorClassNameList' => [
            0 => 'Espo\\Modules\\Crm\\Classes\\FieldValidators\\Event\\Reminders\\Valid',
            1 => 'Espo\\Modules\\Crm\\Classes\\FieldValidators\\Event\\Reminders\\MaxCount'
          ]
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'parent' => (object) [
          'type' => 'linkParent',
          'entityList' => [
            0 => 'Account',
            1 => 'Lead',
            2 => 'Contact',
            3 => 'Opportunity',
            4 => 'Case'
          ]
        ],
        'account' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'acceptanceStatus' => (object) [
          'type' => 'enum',
          'notStorable' => true,
          'options' => [
            0 => 'None',
            1 => 'Accepted',
            2 => 'Tentative',
            3 => 'Declined'
          ],
          'style' => (object) [
            'Accepted' => 'success',
            'Declined' => 'danger',
            'Tentative' => 'warning'
          ],
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'importDisabled' => true,
          'exportDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationRequiredDisabled' => true,
          'customizationIsSortedDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationAuditedDisabled' => true,
          'customizationOptionsReferenceDisabled' => true,
          'where' => (object) [
            '=' => (object) [
              'whereClause' => (object) [
                'OR' => [
                  0 => (object) [
                    'id=s' => (object) [
                      'from' => 'ContactMeeting',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  1 => (object) [
                    'id=s' => (object) [
                      'from' => 'LeadMeeting',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  2 => (object) [
                    'id=s' => (object) [
                      'from' => 'MeetingUser',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ]
                ]
              ]
            ],
            '<>' => (object) [
              'whereClause' => (object) [
                'AND' => [
                  0 => (object) [
                    'id!=s' => (object) [
                      'from' => 'ContactMeeting',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  1 => (object) [
                    'id!=s' => (object) [
                      'from' => 'LeadMeeting',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  2 => (object) [
                    'id!=s' => (object) [
                      'from' => 'MeetingUser',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ]
                ]
              ]
            ],
            'IN' => (object) [
              'whereClause' => (object) [
                'OR' => [
                  0 => (object) [
                    'id=s' => (object) [
                      'from' => 'ContactMeeting',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  1 => (object) [
                    'id=s' => (object) [
                      'from' => 'LeadMeeting',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  2 => (object) [
                    'id=s' => (object) [
                      'from' => 'MeetingUser',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ]
                ]
              ]
            ],
            'NOT IN' => (object) [
              'whereClause' => (object) [
                'AND' => [
                  0 => (object) [
                    'id!=s' => (object) [
                      'from' => 'ContactMeeting',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  1 => (object) [
                    'id!=s' => (object) [
                      'from' => 'LeadMeeting',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ],
                  2 => (object) [
                    'id!=s' => (object) [
                      'from' => 'MeetingUser',
                      'select' => [
                        0 => 'meetingId'
                      ],
                      'whereClause' => (object) [
                        'deleted' => false,
                        'status' => '{value}'
                      ]
                    ]
                  ]
                ]
              ]
            ]
          ],
          'view' => 'crm:views/meeting/fields/acceptance-status'
        ],
        'users' => (object) [
          'type' => 'linkMultiple',
          'view' => 'crm:views/meeting/fields/users',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'columns' => (object) [
            'status' => 'acceptanceStatus'
          ],
          'additionalAttributeList' => [
            0 => 'columns'
          ],
          'orderBy' => 'name'
        ],
        'contacts' => (object) [
          'type' => 'linkMultiple',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'view' => 'crm:views/meeting/fields/contacts',
          'columns' => (object) [
            'status' => 'acceptanceStatus'
          ],
          'additionalAttributeList' => [
            0 => 'columns'
          ],
          'orderBy' => 'name'
        ],
        'leads' => (object) [
          'type' => 'linkMultiple',
          'view' => 'crm:views/meeting/fields/attendees',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'columns' => (object) [
            'status' => 'acceptanceStatus'
          ],
          'additionalAttributeList' => [
            0 => 'columns'
          ],
          'orderBy' => 'name'
        ],
        'sourceEmail' => (object) [
          'type' => 'link',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutFiltersDisabled' => true,
          'exportDisabled' => true,
          'importDisabled' => true,
          'entity' => 'TargetList',
          'directAccessDisabled' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'required' => true,
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'dateStartDate' => (object) [
          'type' => 'date',
          'disabled' => true
        ],
        'dateEndDate' => (object) [
          'type' => 'date',
          'disabled' => true
        ]
      ],
      'links' => (object) [
        'account' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Account'
        ],
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'users' => (object) [
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'meetings',
          'additionalColumns' => (object) [
            'status' => (object) [
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None'
            ]
          ],
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'contacts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'meetings',
          'additionalColumns' => (object) [
            'status' => (object) [
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None'
            ]
          ],
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'leads' => (object) [
          'type' => 'hasMany',
          'entity' => 'Lead',
          'foreign' => 'meetings',
          'additionalColumns' => (object) [
            'status' => (object) [
              'type' => 'varchar',
              'len' => '36',
              'default' => 'None'
            ]
          ],
          'columnAttributeMap' => (object) [
            'status' => 'acceptanceStatus'
          ]
        ],
        'parent' => (object) [
          'type' => 'belongsToParent',
          'foreign' => 'meetings'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'dateStart',
        'order' => 'desc',
        'sortBy' => 'dateStart',
        'asc' => false
      ],
      'indexes' => (object) [
        'dateStartStatus' => (object) [
          'columns' => [
            0 => 'dateStart',
            1 => 'status'
          ]
        ],
        'dateStart' => (object) [
          'columns' => [
            0 => 'dateStart',
            1 => 'deleted'
          ]
        ],
        'status' => (object) [
          'columns' => [
            0 => 'status',
            1 => 'deleted'
          ]
        ],
        'assignedUser' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'deleted'
          ]
        ],
        'assignedUserStatus' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'status'
          ]
        ]
      ]
    ],
    'Opportunity' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'amount' => (object) [
          'type' => 'currency',
          'required' => true,
          'min' => 0,
          'decimal' => false,
          'audited' => true
        ],
        'amountConverted' => (object) [
          'type' => 'currencyConverted',
          'readOnly' => true,
          'importDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'amountWeightedConverted' => (object) [
          'type' => 'float',
          'readOnly' => true,
          'notStorable' => true,
          'select' => (object) [
            'select' => 'DIV:(MUL:(amount, probability, amountCurrencyRate.rate), 100)',
            'leftJoins' => [
              0 => [
                0 => 'Currency',
                1 => 'amountCurrencyRate',
                2 => (object) [
                  'amountCurrencyRate.id:' => 'amountCurrency'
                ]
              ]
            ]
          ],
          'where' => (object) [
            '=' => (object) [
              'whereClause' => (object) [
                'DIV:(MUL:(amount, probability, amountCurrencyRate.rate), 100)=' => '{value}'
              ],
              'leftJoins' => [
                0 => [
                  0 => 'Currency',
                  1 => 'amountCurrencyRate',
                  2 => (object) [
                    'amountCurrencyRate.id:' => 'amountCurrency'
                  ]
                ]
              ]
            ],
            '<' => (object) [
              'whereClause' => (object) [
                'DIV:(MUL:(amount, probability, amountCurrencyRate.rate), 100)<' => '{value}'
              ],
              'leftJoins' => [
                0 => [
                  0 => 'Currency',
                  1 => 'amountCurrencyRate',
                  2 => (object) [
                    'amountCurrencyRate.id:' => 'amountCurrency'
                  ]
                ]
              ]
            ],
            '>' => (object) [
              'whereClause' => (object) [
                'DIV:(MUL:(amount, probability, amountCurrencyRate.rate), 100)>' => '{value}'
              ],
              'leftJoins' => [
                0 => [
                  0 => 'Currency',
                  1 => 'amountCurrencyRate',
                  2 => (object) [
                    'amountCurrencyRate.id:' => 'amountCurrency'
                  ]
                ]
              ]
            ],
            '<=' => (object) [
              'whereClause' => (object) [
                'DIV:(MUL:(amount, probability, amountCurrencyRate.rate), 100)<=' => '{value}'
              ],
              'leftJoins' => [
                0 => [
                  0 => 'Currency',
                  1 => 'amountCurrencyRate',
                  2 => (object) [
                    'amountCurrencyRate.id:' => 'amountCurrency'
                  ]
                ]
              ]
            ],
            '>=' => (object) [
              'whereClause' => (object) [
                'DIV:(MUL:(amount, probability, amountCurrencyRate.rate), 100)>=' => '{value}'
              ],
              'leftJoins' => [
                0 => [
                  0 => 'Currency',
                  1 => 'amountCurrencyRate',
                  2 => (object) [
                    'amountCurrencyRate.id:' => 'amountCurrency'
                  ]
                ]
              ]
            ],
            '<>' => (object) [
              'whereClause' => (object) [
                'DIV:(MUL:(amount, probability, amountCurrencyRate.rate), 100)!=' => '{value}'
              ],
              'leftJoins' => [
                0 => [
                  0 => 'Currency',
                  1 => 'amountCurrencyRate',
                  2 => (object) [
                    'amountCurrencyRate.id:' => 'amountCurrency'
                  ]
                ]
              ]
            ],
            'IS NULL' => (object) [
              'whereClause' => (object) [
                'IS_NULL:(amount)' => true
              ],
              'leftJoins' => [
                0 => [
                  0 => 'Currency',
                  1 => 'amountCurrencyRate',
                  2 => (object) [
                    'amountCurrencyRate.id:' => 'amountCurrency'
                  ]
                ]
              ]
            ],
            'IS NOT NULL' => (object) [
              'whereClause' => (object) [
                'IS_NOT_NULL:(amount)' => true
              ],
              'leftJoins' => [
                0 => [
                  0 => 'Currency',
                  1 => 'amountCurrencyRate',
                  2 => (object) [
                    'amountCurrencyRate.id:' => 'amountCurrency'
                  ]
                ]
              ]
            ]
          ],
          'order' => (object) [
            'order' => [
              0 => [
                0 => 'DIV:(MUL:(amount, probability, amountCurrencyRate.rate), 100)',
                1 => '{direction}'
              ]
            ],
            'leftJoins' => [
              0 => [
                0 => 'Currency',
                1 => 'amountCurrencyRate',
                2 => (object) [
                  'amountCurrencyRate.id:' => 'amountCurrency'
                ]
              ]
            ]
          ],
          'view' => 'views/fields/currency-converted'
        ],
        'account' => (object) [
          'type' => 'link'
        ],
        'contacts' => (object) [
          'type' => 'linkMultiple',
          'view' => 'crm:views/opportunity/fields/contacts',
          'columns' => (object) [
            'role' => 'opportunityRole'
          ],
          'additionalAttributeList' => [
            0 => 'columns'
          ],
          'primaryLink' => 'contact',
          'orderBy' => 'name',
          'detailLayoutIncompatibleFieldList' => [
            0 => 'contact'
          ]
        ],
        'contact' => (object) [
          'type' => 'link'
        ],
        'stage' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Prospecting',
            1 => 'Qualification',
            2 => 'Proposal',
            3 => 'Negotiation',
            4 => 'Closed Won',
            5 => 'Closed Lost'
          ],
          'view' => 'crm:views/opportunity/fields/stage',
          'default' => 'Prospecting',
          'audited' => true,
          'probabilityMap' => (object) [
            'Prospecting' => 10,
            'Qualification' => 20,
            'Proposal' => 50,
            'Negotiation' => 80,
            'Closed Won' => 100,
            'Closed Lost' => 0
          ],
          'style' => (object) [
            'Closed Won' => 'success',
            'Closed Lost' => 'danger'
          ],
          'fieldManagerAdditionalParamList' => [
            0 => (object) [
              'name' => 'probabilityMap',
              'view' => 'crm:views/opportunity/admin/field-manager/fields/probability-map'
            ]
          ],
          'customizationOptionsReferenceDisabled' => true
        ],
        'lastStage' => (object) [
          'type' => 'enum',
          'view' => 'crm:views/opportunity/fields/last-stage',
          'customizationOptionsDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationOptionsReferenceDisabled' => true
        ],
        'probability' => (object) [
          'type' => 'int',
          'required' => true,
          'min' => 0,
          'max' => 100
        ],
        'leadSource' => (object) [
          'type' => 'enum',
          'view' => 'crm:views/opportunity/fields/lead-source',
          'customizationOptionsDisabled' => true,
          'optionsReference' => 'Lead.source'
        ],
        'closeDate' => (object) [
          'type' => 'date',
          'required' => true,
          'audited' => true
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'campaign' => (object) [
          'type' => 'link'
        ],
        'originalLead' => (object) [
          'type' => 'linkOne',
          'readOnly' => true,
          'view' => 'views/fields/link-one'
        ],
        'contactRole' => (object) [
          'type' => 'enum',
          'notStorable' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutAvailabilityList' => [
            0 => 'listForContact'
          ],
          'customizationDefaultDisabled' => true,
          'customizationRequiredDisabled' => true,
          'customizationIsSortedDisabled' => true,
          'customizationAuditedDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationOptionsDisabled' => true,
          'converterClassName' => 'Espo\\Classes\\FieldConverters\\RelationshipRole',
          'converterData' => (object) [
            'column' => 'role',
            'link' => 'contacts',
            'relationName' => 'contactOpportunity',
            'nearKey' => 'opportunityId'
          ],
          'view' => 'crm:views/opportunity/fields/contact-role',
          'optionsReference' => 'Contact.opportunityRole'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'required' => false,
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'amountCurrency' => (object) [
          'type' => 'enum',
          'view' => 'views/fields/currency-list',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'customizationRequiredDisabled' => true,
          'customizationOptionsDisabled' => true,
          'customizationIsSortedDisabled' => true,
          'customizationDisplayAsLabelDisabled' => true,
          'customizationAuditedDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true,
          'customizationDefaultView' => 'views/admin/field-manager/fields/currency-default',
          'customizationTooltipTextDisabled' => true,
          'maxLength' => 3
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'account' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Account',
          'foreign' => 'opportunities'
        ],
        'contacts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'opportunities',
          'additionalColumns' => (object) [
            'role' => (object) [
              'type' => 'varchar',
              'len' => 50
            ]
          ],
          'columnAttributeMap' => (object) [
            'role' => 'contactRole'
          ]
        ],
        'contact' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Contact',
          'foreign' => 'opportunitiesPrimary'
        ],
        'meetings' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Meeting',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
          'audited' => true
        ],
        'calls' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Call',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
          'audited' => true
        ],
        'tasks' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Task',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true,
          'audited' => true
        ],
        'emails' => (object) [
          'type' => 'hasChildren',
          'entity' => 'Email',
          'foreign' => 'parent',
          'layoutRelationshipsDisabled' => true
        ],
        'documents' => (object) [
          'type' => 'hasMany',
          'entity' => 'Document',
          'foreign' => 'opportunities',
          'audited' => true
        ],
        'campaign' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Campaign',
          'foreign' => 'opportunities'
        ],
        'originalLead' => (object) [
          'type' => 'hasOne',
          'entity' => 'Lead',
          'foreign' => 'createdOpportunity'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ],
      'indexes' => (object) [
        'stage' => (object) [
          'columns' => [
            0 => 'stage',
            1 => 'deleted'
          ]
        ],
        'lastStage' => (object) [
          'columns' => [
            0 => 'lastStage'
          ]
        ],
        'assignedUser' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'deleted'
          ]
        ],
        'createdAt' => (object) [
          'columns' => [
            0 => 'createdAt',
            1 => 'deleted'
          ]
        ],
        'createdAtStage' => (object) [
          'columns' => [
            0 => 'createdAt',
            1 => 'stage'
          ]
        ],
        'createdAtId' => (object) [
          'unique' => true,
          'columns' => [
            0 => 'createdAt',
            1 => 'id'
          ]
        ],
        'assignedUserStage' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'stage'
          ]
        ]
      ]
    ],
    'Reminder' => (object) [
      'fields' => (object) [
        'remindAt' => (object) [
          'type' => 'datetime',
          'index' => true
        ],
        'startAt' => (object) [
          'type' => 'datetime',
          'index' => true
        ],
        'type' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Popup',
            1 => 'Email'
          ],
          'maxLength' => 36,
          'index' => true,
          'default' => 'Popup'
        ],
        'seconds' => (object) [
          'type' => 'enumInt',
          'options' => [
            0 => 0,
            1 => 60,
            2 => 120,
            3 => 300,
            4 => 600,
            5 => 900,
            6 => 1800,
            7 => 3600,
            8 => 7200,
            9 => 18000,
            10 => 86400,
            11 => 604800
          ],
          'default' => 0
        ],
        'entityType' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'entityId' => (object) [
          'type' => 'varchar',
          'maxLength' => 50
        ],
        'userId' => (object) [
          'type' => 'varchar',
          'maxLength' => 50
        ],
        'isSubmitted' => (object) [
          'type' => 'bool'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'remindAt',
        'order' => 'desc',
        'sortBy' => 'remindAt',
        'asc' => false
      ]
    ],
    'Target' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'personName'
        ],
        'salutationName' => (object) [
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'Mr.',
            2 => 'Mrs.',
            3 => 'Ms.',
            4 => 'Dr.',
            5 => 'Drs.'
          ]
        ],
        'firstName' => (object) [
          'type' => 'varchar',
          'pattern' => '$noBadCharacters',
          'maxLength' => 100,
          'default' => ''
        ],
        'lastName' => (object) [
          'type' => 'varchar',
          'pattern' => '$noBadCharacters',
          'maxLength' => 100,
          'required' => true,
          'default' => ''
        ],
        'title' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'accountName' => (object) [
          'type' => 'varchar',
          'maxLength' => 100
        ],
        'website' => (object) [
          'type' => 'url'
        ],
        'address' => (object) [
          'type' => 'address'
        ],
        'addressStreet' => (object) [
          'type' => 'text',
          'maxLength' => 255,
          'dbType' => 'varchar'
        ],
        'addressCity' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-city',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressState' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-state',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressCountry' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-country',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'addressPostalCode' => (object) [
          'type' => 'varchar',
          'maxLength' => 40,
          'pattern' => '$noBadCharacters'
        ],
        'emailAddress' => (object) [
          'type' => 'email'
        ],
        'phoneNumber' => (object) [
          'type' => 'phone',
          'typeList' => [
            0 => 'Mobile',
            1 => 'Office',
            2 => 'Home',
            3 => 'Fax',
            4 => 'Other'
          ],
          'defaultType' => 'Mobile'
        ],
        'doNotCall' => (object) [
          'type' => 'bool'
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user'
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user'
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'middleName' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'pattern' => '$noBadCharacters'
        ],
        'addressMap' => (object) [
          'type' => 'map',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'provider' => 'Google',
          'height' => 300,
          'exportDisabled' => true,
          'importDisabled' => true
        ],
        'emailAddressIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'emailAddressIsInvalid' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'phoneNumberIsOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'phoneNumberIsInvalid' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ],
      'indexes' => (object) [
        'firstName' => (object) [
          'columns' => [
            0 => 'firstName',
            1 => 'deleted'
          ]
        ],
        'name' => (object) [
          'columns' => [
            0 => 'firstName',
            1 => 'lastName'
          ]
        ],
        'assignedUser' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'deleted'
          ]
        ]
      ]
    ],
    'TargetList' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'entryCount' => (object) [
          'type' => 'int',
          'readOnly' => true,
          'notStorable' => true,
          'layoutFiltersDisabled' => true,
          'layoutMassUpdateDisabled' => true
        ],
        'optedOutCount' => (object) [
          'type' => 'int',
          'readOnly' => true,
          'notStorable' => true,
          'layoutListDisabled' => true,
          'layoutFiltersDisabled' => true,
          'layoutMassUpdateDisabled' => true
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'includingActionList' => (object) [
          'type' => 'multiEnum',
          'view' => 'crm:views/target-list/fields/including-action-list',
          'layoutDetailDisabled' => true,
          'layoutFiltersDisabled' => true,
          'layoutLinkDisabled' => true,
          'notStorable' => true,
          'utility' => true
        ],
        'excludingActionList' => (object) [
          'type' => 'multiEnum',
          'view' => 'crm:views/target-list/fields/including-action-list',
          'layoutDetailDisabled' => true,
          'layoutFiltersDisabled' => true,
          'layoutLinkDisabled' => true,
          'notStorable' => true,
          'utility' => true
        ],
        'targetStatus' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Listed',
            1 => 'Opted Out'
          ],
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutFiltersDisabled' => true,
          'exportDisabled' => true,
          'importDisabled' => true,
          'view' => 'crm:views/target-list/fields/target-status'
        ],
        'isOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'layoutDetailDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutFiltersDisabled' => true,
          'exportDisabled' => true,
          'importDisabled' => true
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'campaigns' => (object) [
          'type' => 'hasMany',
          'entity' => 'Campaign',
          'foreign' => 'targetLists',
          'layoutRelationshipsDisabled' => true
        ],
        'massEmails' => (object) [
          'type' => 'hasMany',
          'entity' => 'MassEmail',
          'foreign' => 'targetLists',
          'layoutRelationshipsDisabled' => true
        ],
        'campaignsExcluding' => (object) [
          'type' => 'hasMany',
          'entity' => 'Campaign',
          'foreign' => 'excludingTargetLists',
          'layoutRelationshipsDisabled' => true
        ],
        'massEmailsExcluding' => (object) [
          'type' => 'hasMany',
          'entity' => 'MassEmail',
          'foreign' => 'excludingTargetLists',
          'layoutRelationshipsDisabled' => true
        ],
        'accounts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Account',
          'foreign' => 'targetLists',
          'additionalColumns' => (object) [
            'optedOut' => (object) [
              'type' => 'bool'
            ]
          ],
          'columnAttributeMap' => (object) [
            'optedOut' => 'isOptedOut'
          ]
        ],
        'contacts' => (object) [
          'type' => 'hasMany',
          'entity' => 'Contact',
          'foreign' => 'targetLists',
          'additionalColumns' => (object) [
            'optedOut' => (object) [
              'type' => 'bool'
            ]
          ],
          'columnAttributeMap' => (object) [
            'optedOut' => 'isOptedOut'
          ]
        ],
        'leads' => (object) [
          'type' => 'hasMany',
          'entity' => 'Lead',
          'foreign' => 'targetLists',
          'additionalColumns' => (object) [
            'optedOut' => (object) [
              'type' => 'bool'
            ]
          ],
          'columnAttributeMap' => (object) [
            'optedOut' => 'isOptedOut'
          ]
        ],
        'users' => (object) [
          'type' => 'hasMany',
          'entity' => 'User',
          'foreign' => 'targetLists',
          'additionalColumns' => (object) [
            'optedOut' => (object) [
              'type' => 'bool'
            ]
          ],
          'columnAttributeMap' => (object) [
            'optedOut' => 'isOptedOut'
          ]
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ],
      'indexes' => (object) [
        'createdAt' => (object) [
          'columns' => [
            0 => 'createdAt',
            1 => 'deleted'
          ]
        ]
      ]
    ],
    'Task' => (object) [
      'fields' => (object) [
        'name' => (object) [
          'type' => 'varchar',
          'required' => true,
          'pattern' => '$noBadCharacters'
        ],
        'status' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Not Started',
            1 => 'Started',
            2 => 'Completed',
            3 => 'Canceled',
            4 => 'Deferred'
          ],
          'style' => (object) [
            'Completed' => 'success'
          ],
          'default' => 'Not Started',
          'audited' => true,
          'fieldManagerAdditionalParamList' => [
            0 => (object) [
              'name' => 'notActualOptions',
              'view' => 'views/admin/field-manager/fields/not-actual-options'
            ]
          ],
          'notActualOptions' => [
            0 => 'Completed',
            1 => 'Canceled',
            2 => 'Deferred'
          ],
          'customizationOptionsReferenceDisabled' => true
        ],
        'priority' => (object) [
          'type' => 'enum',
          'options' => [
            0 => 'Low',
            1 => 'Normal',
            2 => 'High',
            3 => 'Urgent'
          ],
          'default' => 'Normal',
          'displayAsLabel' => true,
          'style' => (object) [
            'High' => 'warning',
            'Urgent' => 'danger'
          ],
          'audited' => true,
          'customizationOptionsReferenceDisabled' => true
        ],
        'dateStart' => (object) [
          'type' => 'datetimeOptional',
          'before' => 'dateEnd'
        ],
        'dateEnd' => (object) [
          'type' => 'datetimeOptional',
          'after' => 'dateStart',
          'view' => 'crm:views/task/fields/date-end',
          'audited' => true
        ],
        'dateStartDate' => (object) [
          'type' => 'date',
          'disabled' => true,
          'utility' => true
        ],
        'dateEndDate' => (object) [
          'type' => 'date',
          'disabled' => true,
          'utility' => true
        ],
        'dateCompleted' => (object) [
          'type' => 'datetime',
          'readOnly' => true
        ],
        'isOverdue' => (object) [
          'type' => 'bool',
          'readOnly' => true,
          'notStorable' => true,
          'view' => 'crm:views/task/fields/is-overdue',
          'utility' => true
        ],
        'reminders' => (object) [
          'type' => 'jsonArray',
          'notStorable' => true,
          'view' => 'crm:views/meeting/fields/reminders',
          'dateField' => 'dateEnd',
          'validatorClassNameList' => [
            0 => 'Espo\\Modules\\Crm\\Classes\\FieldValidators\\Event\\Reminders\\Valid',
            1 => 'Espo\\Modules\\Crm\\Classes\\FieldValidators\\Event\\Reminders\\MaxCount'
          ]
        ],
        'description' => (object) [
          'type' => 'text'
        ],
        'parent' => (object) [
          'type' => 'linkParent',
          'entityList' => [
            0 => 'Account',
            1 => 'Contact',
            2 => 'Lead',
            3 => 'Opportunity',
            4 => 'Case'
          ]
        ],
        'account' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'contact' => (object) [
          'type' => 'link',
          'readOnly' => true
        ],
        'createdAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'modifiedAt' => (object) [
          'type' => 'datetime',
          'readOnly' => true,
          'fieldManagerParamList' => [
            0 => 'useNumericFormat'
          ]
        ],
        'createdBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'modifiedBy' => (object) [
          'type' => 'link',
          'readOnly' => true,
          'view' => 'views/fields/user',
          'fieldManagerParamList' => []
        ],
        'assignedUser' => (object) [
          'type' => 'link',
          'required' => true,
          'view' => 'views/fields/assigned-user'
        ],
        'teams' => (object) [
          'type' => 'linkMultiple',
          'view' => 'views/fields/teams'
        ],
        'attachments' => (object) [
          'type' => 'attachmentMultiple',
          'sourceList' => [
            0 => 'Document'
          ]
        ]
      ],
      'links' => (object) [
        'createdBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'modifiedBy' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User'
        ],
        'assignedUser' => (object) [
          'type' => 'belongsTo',
          'entity' => 'User',
          'foreign' => 'tasks'
        ],
        'teams' => (object) [
          'type' => 'hasMany',
          'entity' => 'Team',
          'relationName' => 'entityTeam',
          'layoutRelationshipsDisabled' => true
        ],
        'parent' => (object) [
          'type' => 'belongsToParent',
          'foreign' => 'tasks'
        ],
        'account' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Account'
        ],
        'contact' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Contact'
        ],
        'email' => (object) [
          'type' => 'belongsTo',
          'entity' => 'Email',
          'foreign' => 'tasks'
        ]
      ],
      'collection' => (object) [
        'orderBy' => 'createdAt',
        'order' => 'desc',
        'sortBy' => 'createdAt',
        'asc' => false
      ],
      'indexes' => (object) [
        'dateStartStatus' => (object) [
          'columns' => [
            0 => 'dateStart',
            1 => 'status'
          ]
        ],
        'dateEndStatus' => (object) [
          'columns' => [
            0 => 'dateEnd',
            1 => 'status'
          ]
        ],
        'dateStart' => (object) [
          'columns' => [
            0 => 'dateStart',
            1 => 'deleted'
          ]
        ],
        'status' => (object) [
          'columns' => [
            0 => 'status',
            1 => 'deleted'
          ]
        ],
        'assignedUser' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'deleted'
          ]
        ],
        'assignedUserStatus' => (object) [
          'columns' => [
            0 => 'assignedUserId',
            1 => 'status'
          ]
        ]
      ]
    ]
  ],
  'fields' => (object) [
    'address' => (object) [
      'actualFields' => [
        0 => 'street',
        1 => 'city',
        2 => 'state',
        3 => 'country',
        4 => 'postalCode'
      ],
      'fields' => (object) [
        'street' => (object) [
          'type' => 'text',
          'maxLength' => 255,
          'dbType' => 'varchar'
        ],
        'city' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-city',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'state' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-state',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'country' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'view' => 'views/fields/address-country',
          'customizationOptionsDisabled' => true,
          'pattern' => '$noBadCharacters'
        ],
        'postalCode' => (object) [
          'type' => 'varchar',
          'maxLength' => 40,
          'pattern' => '$noBadCharacters'
        ],
        'map' => (object) [
          'type' => 'map',
          'notStorable' => true,
          'readOnly' => true,
          'layoutListDisabled' => true,
          'provider' => 'Google',
          'height' => 300,
          'exportDisabled' => true,
          'importDisabled' => true
        ]
      ],
      'params' => [
        0 => (object) [
          'name' => 'viewMap',
          'type' => 'bool'
        ]
      ],
      'notMergeable' => true,
      'notCreatable' => false,
      'filter' => true,
      'skipOrmDefs' => true,
      'personalData' => true,
      'valueFactoryClassName' => 'Espo\\Core\\Field\\Address\\AddressFactory',
      'attributeExtractorClassName' => 'Espo\\Core\\Field\\Address\\AddressAttributeExtractor'
    ],
    'array' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'options',
          'type' => 'array',
          'view' => 'views/admin/field-manager/fields/options',
          'tooltip' => 'optionsArray'
        ],
        2 => (object) [
          'name' => 'optionsReference',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/options-reference',
          'tooltip' => true
        ],
        3 => (object) [
          'name' => 'translation',
          'type' => 'varchar',
          'hidden' => true
        ],
        4 => (object) [
          'name' => 'allowCustomOptions',
          'type' => 'bool',
          'hidden' => true
        ],
        5 => (object) [
          'name' => 'noEmptyString',
          'type' => 'bool',
          'default' => true
        ],
        6 => (object) [
          'name' => 'displayAsList',
          'type' => 'bool',
          'tooltip' => true
        ],
        7 => (object) [
          'name' => 'maxCount',
          'type' => 'int',
          'min' => 1,
          'tooltip' => true
        ],
        8 => (object) [
          'name' => 'pattern',
          'type' => 'varchar',
          'tooltip' => true,
          'view' => 'views/admin/field-manager/fields/pattern'
        ],
        9 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        10 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ],
        11 => (object) [
          'name' => 'optionsPath',
          'type' => 'varchar',
          'hidden' => true
        ]
      ],
      'validationList' => [
        0 => 'array',
        1 => 'arrayOfString',
        2 => 'valid',
        3 => 'required',
        4 => 'maxCount',
        5 => 'maxItemLength',
        6 => 'pattern',
        7 => 'noEmptyString'
      ],
      'mandatoryValidationList' => [
        0 => 'array',
        1 => 'arrayOfString',
        2 => 'valid',
        3 => 'maxItemLength'
      ],
      'filter' => true,
      'notCreatable' => false,
      'notSortable' => true,
      'fieldDefs' => (object) [
        'type' => 'jsonArray',
        'storeArrayValues' => true
      ],
      'translatedOptions' => true,
      'dynamicLogicOptions' => true,
      'personalData' => true,
      'massUpdateActionList' => [
        0 => 'update',
        1 => 'add',
        2 => 'remove'
      ]
    ],
    'arrayInt' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'options',
          'type' => 'arrayInt'
        ],
        2 => (object) [
          'name' => 'translation',
          'type' => 'varchar',
          'hidden' => true
        ],
        3 => (object) [
          'name' => 'noEmptyString',
          'type' => 'bool',
          'default' => false
        ],
        4 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        5 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'validationList' => [
        0 => 'array'
      ],
      'mandatoryValidationList' => [
        0 => 'array'
      ],
      'filter' => true,
      'notCreatable' => true,
      'fieldDefs' => (object) [
        'type' => 'jsonArray'
      ]
    ],
    'attachmentMultiple' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'sourceList',
          'type' => 'multiEnum',
          'view' => 'views/admin/field-manager/fields/source-list'
        ],
        2 => (object) [
          'name' => 'maxFileSize',
          'type' => 'float',
          'tooltip' => true,
          'min' => 0
        ],
        3 => (object) [
          'name' => 'previewSize',
          'type' => 'enum',
          'default' => 'medium',
          'options' => [
            0 => '',
            1 => 'x-small',
            2 => 'small',
            3 => 'medium',
            4 => 'large'
          ]
        ],
        4 => (object) [
          'name' => 'accept',
          'type' => 'multiEnum',
          'noEmptyString' => true,
          'allowCustomOptions' => true,
          'options' => [
            0 => 'image/*',
            1 => 'audio/*',
            2 => 'video/*',
            3 => '.zip',
            4 => '.pdf',
            5 => '.odt',
            6 => '.ods',
            7 => '.odp',
            8 => '.docx',
            9 => '.xlsx',
            10 => '.pptx',
            11 => '.doc',
            12 => '.xls',
            13 => '.ppt',
            14 => '.rtf',
            15 => '.csv',
            16 => '.md',
            17 => '.txt'
          ],
          'tooltip' => 'fileAccept'
        ]
      ],
      'actualFields' => [
        0 => 'ids'
      ],
      'notActualFields' => [
        0 => 'names',
        1 => 'types'
      ],
      'linkDefs' => (object) [
        'type' => 'hasChildren',
        'entity' => 'Attachment',
        'foreign' => 'parent',
        'layoutRelationshipsDisabled' => true,
        'relationName' => 'attachments',
        'utility' => true
      ],
      'notSortable' => true,
      'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\FieldConverters\\AttachmentMultiple',
      'filter' => true,
      'personalData' => true,
      'validationList' => [
        0 => 'required',
        1 => 'pattern'
      ],
      'mandatoryValidationList' => [
        0 => 'pattern'
      ],
      'validatorClassName' => 'Espo\\Classes\\FieldValidators\\LinkMultipleType',
      'duplicatorClassName' => 'Espo\\Classes\\FieldDuplicators\\AttachmentMultiple',
      'massUpdateActionList' => [
        0 => 'update',
        1 => 'add'
      ]
    ],
    'autoincrement' => (object) [
      'params' => [],
      'notCreatable' => false,
      'filter' => true,
      'fieldDefs' => (object) [
        'type' => 'int',
        'autoincrement' => true,
        'unique' => true
      ],
      'hookClassName' => 'Espo\\Tools\\FieldManager\\Hooks\\AutoincrementType',
      'textFilter' => true,
      'readOnly' => true
    ],
    'barcode' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'codeType',
          'type' => 'enum',
          'options' => [
            0 => 'CODE128',
            1 => 'CODE128A',
            2 => 'CODE128B',
            3 => 'CODE128C',
            4 => 'EAN13',
            5 => 'EAN8',
            6 => 'EAN5',
            7 => 'EAN2',
            8 => 'UPC',
            9 => 'UPCE',
            10 => 'ITF14',
            11 => 'pharmacode',
            12 => 'QRcode'
          ],
          'translation' => 'FieldManager.options.barcodeType'
        ],
        2 => (object) [
          'name' => 'lastChar',
          'type' => 'varchar',
          'maxLength' => 1,
          'tooltip' => 'barcodeLastChar'
        ],
        3 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'validationList' => [
        0 => 'required',
        1 => 'maxLength'
      ],
      'mandatoryValidationList' => [
        0 => 'maxLength'
      ],
      'filter' => true,
      'textFilter' => true,
      'textFilterForeign' => true,
      'fieldDefs' => (object) [
        'type' => 'varchar',
        'len' => 255
      ],
      'validatorClassName' => 'Espo\\Classes\\FieldValidators\\VarcharType'
    ],
    'base' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool'
        ]
      ],
      'filter' => false,
      'notCreatable' => true,
      'fieldDefs' => (object) [
        'notStorable' => true
      ]
    ],
    'bool' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'default',
          'type' => 'bool'
        ],
        1 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        2 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'filter' => true,
      'fieldDefs' => (object) [
        'notNull' => true
      ]
    ],
    'checklist' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'options',
          'type' => 'array',
          'view' => 'views/admin/field-manager/fields/options',
          'noEmptyString' => true,
          'required' => true,
          'tooltip' => true
        ],
        2 => (object) [
          'name' => 'optionsReference',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/options-reference',
          'tooltip' => true
        ],
        3 => (object) [
          'name' => 'isSorted',
          'type' => 'bool'
        ],
        4 => (object) [
          'name' => 'translation',
          'type' => 'varchar',
          'hidden' => true
        ],
        5 => (object) [
          'name' => 'maxCount',
          'type' => 'int',
          'min' => 1,
          'tooltip' => true
        ],
        6 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        7 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ],
        8 => (object) [
          'name' => 'optionsPath',
          'type' => 'varchar',
          'hidden' => true
        ]
      ],
      'validationList' => [
        0 => 'array',
        1 => 'arrayOfString',
        2 => 'valid',
        3 => 'required',
        4 => 'maxCount'
      ],
      'mandatoryValidationList' => [
        0 => 'array',
        1 => 'arrayOfString',
        2 => 'valid'
      ],
      'filter' => true,
      'notCreatable' => false,
      'notSortable' => true,
      'fieldDefs' => (object) [
        'type' => 'jsonArray',
        'storeArrayValues' => true
      ],
      'translatedOptions' => true,
      'dynamicLogicOptions' => true,
      'personalData' => true
    ],
    'colorpicker' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'colorpicker'
        ],
        2 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        3 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'filter' => false,
      'fieldDefs' => (object) [
        'type' => 'varchar',
        'maxLength' => 7
      ],
      'notCreatable' => true
    ],
    'currency' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'float'
        ],
        2 => (object) [
          'name' => 'min',
          'type' => 'float'
        ],
        3 => (object) [
          'name' => 'max',
          'type' => 'float'
        ],
        4 => (object) [
          'name' => 'onlyDefaultCurrency',
          'type' => 'bool',
          'default' => false
        ],
        5 => (object) [
          'name' => 'conversionDisabled',
          'type' => 'bool',
          'default' => false,
          'tooltip' => true
        ],
        6 => (object) [
          'name' => 'decimal',
          'type' => 'bool',
          'readOnlyNotNew' => true,
          'tooltip' => 'currencyDecimal'
        ],
        7 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        8 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ],
        9 => (object) [
          'name' => 'precision',
          'type' => 'int',
          'hidden' => true
        ],
        10 => (object) [
          'name' => 'scale',
          'type' => 'int',
          'hidden' => true
        ]
      ],
      'actualFields' => [
        0 => 'currency',
        1 => ''
      ],
      'fields' => (object) [
        'currency' => (object) [
          'type' => 'enum',
          'view' => 'views/fields/currency-list',
          'layoutDetailDisabled' => true,
          'layoutListDisabled' => true,
          'layoutMassUpdateDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'customizationRequiredDisabled' => true,
          'customizationOptionsDisabled' => true,
          'customizationIsSortedDisabled' => true,
          'customizationDisplayAsLabelDisabled' => true,
          'customizationAuditedDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true,
          'customizationDefaultView' => 'views/admin/field-manager/fields/currency-default',
          'customizationTooltipTextDisabled' => true,
          'maxLength' => 3
        ],
        'converted' => (object) [
          'type' => 'currencyConverted',
          'readOnly' => true,
          'importDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ]
      ],
      'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\FieldConverters\\Currency',
      'validationList' => [
        0 => 'required',
        1 => 'min',
        2 => 'max'
      ],
      'mandatoryValidationList' => [
        0 => 'valid',
        1 => 'validCurrency',
        2 => 'inPermittedRange'
      ],
      'filter' => true,
      'personalData' => true,
      'valueFactoryClassName' => 'Espo\\Core\\Field\\Currency\\CurrencyFactory',
      'attributeExtractorClassName' => 'Espo\\Core\\Field\\Currency\\CurrencyAttributeExtractor'
    ],
    'currencyConverted' => (object) [
      'params' => [],
      'filter' => true,
      'notCreatable' => true,
      'skipOrmDefs' => true
    ],
    'date' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'enum',
          'view' => 'views/admin/field-manager/fields/date/default',
          'options' => [
            0 => '',
            1 => 'javascript: return this.dateTime.getToday();',
            2 => 'javascript: return this.dateTime.getDateShiftedFromToday(1, \'days\');',
            3 => 'javascript: return this.dateTime.getDateShiftedFromToday(2, \'days\');',
            4 => 'javascript: return this.dateTime.getDateShiftedFromToday(3, \'days\');',
            5 => 'javascript: return this.dateTime.getDateShiftedFromToday(4, \'days\');',
            6 => 'javascript: return this.dateTime.getDateShiftedFromToday(5, \'days\');',
            7 => 'javascript: return this.dateTime.getDateShiftedFromToday(6, \'days\');',
            8 => 'javascript: return this.dateTime.getDateShiftedFromToday(7, \'days\');',
            9 => 'javascript: return this.dateTime.getDateShiftedFromToday(8, \'days\');',
            10 => 'javascript: return this.dateTime.getDateShiftedFromToday(9, \'days\');',
            11 => 'javascript: return this.dateTime.getDateShiftedFromToday(10, \'days\');',
            12 => 'javascript: return this.dateTime.getDateShiftedFromToday(1, \'weeks\');',
            13 => 'javascript: return this.dateTime.getDateShiftedFromToday(2, \'weeks\');',
            14 => 'javascript: return this.dateTime.getDateShiftedFromToday(3, \'weeks\');',
            15 => 'javascript: return this.dateTime.getDateShiftedFromToday(1, \'months\');',
            16 => 'javascript: return this.dateTime.getDateShiftedFromToday(2, \'months\');',
            17 => 'javascript: return this.dateTime.getDateShiftedFromToday(3, \'months\');',
            18 => 'javascript: return this.dateTime.getDateShiftedFromToday(4, \'months\');',
            19 => 'javascript: return this.dateTime.getDateShiftedFromToday(5, \'months\');',
            20 => 'javascript: return this.dateTime.getDateShiftedFromToday(6, \'months\');',
            21 => 'javascript: return this.dateTime.getDateShiftedFromToday(7, \'months\');',
            22 => 'javascript: return this.dateTime.getDateShiftedFromToday(8, \'months\');',
            23 => 'javascript: return this.dateTime.getDateShiftedFromToday(9, \'months\');',
            24 => 'javascript: return this.dateTime.getDateShiftedFromToday(10, \'months\');',
            25 => 'javascript: return this.dateTime.getDateShiftedFromToday(11, \'months\');',
            26 => 'javascript: return this.dateTime.getDateShiftedFromToday(1, \'year\');'
          ],
          'translation' => 'FieldManager.options.dateDefault'
        ],
        2 => (object) [
          'name' => 'after',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/date/after-before'
        ],
        3 => (object) [
          'name' => 'before',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/date/after-before'
        ],
        4 => (object) [
          'type' => 'bool',
          'name' => 'useNumericFormat'
        ],
        5 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        6 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'validationList' => [
        0 => 'required'
      ],
      'mandatoryValidationList' => [
        0 => 'valid'
      ],
      'filter' => true,
      'fieldDefs' => (object) [
        'notNull' => false
      ],
      'personalData' => true,
      'valueFactoryClassName' => 'Espo\\Core\\Field\\Date\\DateFactory',
      'attributeExtractorClassName' => 'Espo\\Core\\Field\\Date\\DateAttributeExtractor'
    ],
    'datetime' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'enum',
          'view' => 'views/admin/field-manager/fields/date/default',
          'options' => [
            0 => '',
            1 => 'javascript: return this.dateTime.getNow(1);',
            2 => 'javascript: return this.dateTime.getNow(5);',
            3 => 'javascript: return this.dateTime.getNow(15);',
            4 => 'javascript: return this.dateTime.getNow(30);',
            5 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(1, \'hours\', 15);',
            6 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(2, \'hours\', 15);',
            7 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(3, \'hours\', 15);',
            8 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(4, \'hours\', 15);',
            9 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(5, \'hours\', 15);',
            10 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(6, \'hours\', 15);',
            11 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(7, \'hours\', 15);',
            12 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(8, \'hours\', 15);',
            13 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(9, \'hours\', 15);',
            14 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(10, \'hours\', 15);',
            15 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(11, \'hours\', 15);',
            16 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(12, \'hours\', 15);',
            17 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(1, \'days\', 15);',
            18 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(2, \'days\', 15);',
            19 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(3, \'days\', 15);',
            20 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(4, \'days\', 15);',
            21 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(5, \'days\', 15);',
            22 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(6, \'days\', 15);',
            23 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(1, \'week\', 15);'
          ],
          'translation' => 'FieldManager.options.dateTimeDefault'
        ],
        2 => (object) [
          'name' => 'after',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/date/after-before'
        ],
        3 => (object) [
          'name' => 'before',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/date/after-before'
        ],
        4 => (object) [
          'type' => 'bool',
          'name' => 'useNumericFormat'
        ],
        5 => (object) [
          'type' => 'bool',
          'name' => 'hasSeconds',
          'hidden' => true
        ],
        6 => (object) [
          'type' => 'enumInt',
          'name' => 'minuteStep',
          'options' => [
            0 => 30,
            1 => 15,
            2 => 60,
            3 => 10,
            4 => 5,
            5 => 1
          ]
        ],
        7 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        8 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'validationList' => [
        0 => 'required'
      ],
      'mandatoryValidationList' => [
        0 => 'valid'
      ],
      'filter' => true,
      'fieldDefs' => (object) [
        'notNull' => false
      ],
      'personalData' => true,
      'valueFactoryClassName' => 'Espo\\Core\\Field\\DateTime\\DateTimeFactory',
      'attributeExtractorClassName' => 'Espo\\Core\\Field\\DateTime\\DateTimeAttributeExtractor'
    ],
    'datetimeOptional' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'enum',
          'view' => 'views/admin/field-manager/fields/date/default',
          'options' => [
            0 => '',
            1 => 'javascript: return this.dateTime.getNow(1);',
            2 => 'javascript: return this.dateTime.getNow(5);',
            3 => 'javascript: return this.dateTime.getNow(15);',
            4 => 'javascript: return this.dateTime.getNow(30);',
            5 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(1, \'hours\', 15);',
            6 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(2, \'hours\', 15);',
            7 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(3, \'hours\', 15);',
            8 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(4, \'hours\', 15);',
            9 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(5, \'hours\', 15);',
            10 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(6, \'hours\', 15);',
            11 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(7, \'hours\', 15);',
            12 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(8, \'hours\', 15);',
            13 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(9, \'hours\', 15);',
            14 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(10, \'hours\', 15);',
            15 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(11, \'hours\', 15);',
            16 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(12, \'hours\', 15);',
            17 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(1, \'days\', 15);',
            18 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(2, \'days\', 15);',
            19 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(3, \'days\', 15);',
            20 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(4, \'days\', 15);',
            21 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(5, \'days\', 15);',
            22 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(6, \'days\', 15);',
            23 => 'javascript: return this.dateTime.getDateTimeShiftedFromNow(1, \'week\', 15);'
          ],
          'translation' => 'FieldManager.options.dateTimeDefault'
        ],
        2 => (object) [
          'name' => 'after',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/date/after-before'
        ],
        3 => (object) [
          'name' => 'before',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/date/after-before'
        ],
        4 => (object) [
          'type' => 'bool',
          'name' => 'useNumericFormat'
        ],
        5 => (object) [
          'type' => 'enumInt',
          'name' => 'minuteStep',
          'options' => [
            0 => 30,
            1 => 15,
            2 => 60,
            3 => 10,
            4 => 5,
            5 => 1
          ]
        ],
        6 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        7 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'actualFields' => [
        0 => '',
        1 => 'date'
      ],
      'fields' => (object) [
        'date' => (object) [
          'type' => 'date',
          'disabled' => true
        ]
      ],
      'validationList' => [
        0 => 'required'
      ],
      'mandatoryValidationList' => [
        0 => 'valid'
      ],
      'filter' => true,
      'notCreatable' => true,
      'fieldDefs' => (object) [
        'type' => 'datetime',
        'notNull' => false
      ],
      'view' => 'views/fields/datetime-optional',
      'personalData' => true,
      'valueFactoryClassName' => 'Espo\\Core\\Field\\DateTimeOptional\\DateTimeOptionalFactory',
      'attributeExtractorClassName' => 'Espo\\Core\\Field\\DateTimeOptional\\DateTimeOptionalAttributeExtractor'
    ],
    'duration' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'default',
          'type' => 'int'
        ],
        1 => (object) [
          'name' => 'options',
          'type' => 'arrayInt'
        ]
      ],
      'notCreatable' => true,
      'notMergeable' => true,
      'fieldDefs' => (object) [
        'type' => 'int'
      ]
    ],
    'email' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ]
      ],
      'actualFields' => [
        0 => 'isOptedOut',
        1 => 'isInvalid',
        2 => '',
        3 => 'data'
      ],
      'notActualFields' => [],
      'fields' => (object) [
        'isOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'isInvalid' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ]
      ],
      'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\FieldConverters\\Email',
      'validationList' => [
        0 => 'required',
        1 => 'emailAddress',
        2 => 'maxLength'
      ],
      'mandatoryValidationList' => [
        0 => 'emailAddress',
        1 => 'maxLength'
      ],
      'notCreatable' => true,
      'filter' => true,
      'fieldDefs' => (object) [
        'notStorable' => true
      ],
      'textFilter' => true,
      'personalData' => true,
      'valueFactoryClassName' => 'Espo\\Core\\Field\\EmailAddress\\EmailAddressGroupFactory',
      'attributeExtractorClassName' => 'Espo\\Core\\Field\\EmailAddress\\EmailAddressGroupAttributeExtractor'
    ],
    'enum' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'options',
          'type' => 'array',
          'view' => 'views/admin/field-manager/fields/options-with-style',
          'tooltip' => true
        ],
        2 => (object) [
          'name' => 'default',
          'type' => 'enum',
          'view' => 'views/admin/field-manager/fields/options/default'
        ],
        3 => (object) [
          'name' => 'optionsReference',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/options-reference',
          'tooltip' => true
        ],
        4 => (object) [
          'name' => 'isSorted',
          'type' => 'bool'
        ],
        5 => (object) [
          'name' => 'translation',
          'type' => 'varchar',
          'hidden' => true
        ],
        6 => (object) [
          'name' => 'optionsPath',
          'type' => 'varchar',
          'hidden' => true
        ],
        7 => (object) [
          'name' => 'style',
          'type' => 'jsonObject',
          'hidden' => true
        ],
        8 => (object) [
          'name' => 'displayAsLabel',
          'type' => 'bool'
        ],
        9 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        10 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'validationList' => [
        0 => 'required',
        1 => 'valid',
        2 => 'maxLength'
      ],
      'mandatoryValidationList' => [
        0 => 'valid',
        1 => 'maxLength'
      ],
      'filter' => true,
      'fieldDefs' => (object) [
        'type' => 'varchar'
      ],
      'translatedOptions' => true,
      'dynamicLogicOptions' => true,
      'personalData' => true
    ],
    'enumFloat' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'options',
          'type' => 'array'
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'float'
        ],
        2 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        3 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'filter' => true,
      'notCreatable' => true,
      'fieldDefs' => (object) [
        'type' => 'float'
      ]
    ],
    'enumInt' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'options',
          'type' => 'array'
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'int'
        ],
        2 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        3 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ],
        4 => (object) [
          'name' => 'translation',
          'type' => 'varchar',
          'hidden' => true
        ]
      ],
      'filter' => true,
      'notCreatable' => true,
      'fieldDefs' => (object) [
        'type' => 'int'
      ]
    ],
    'file' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'sourceList',
          'type' => 'multiEnum',
          'view' => 'views/admin/field-manager/fields/source-list'
        ],
        2 => (object) [
          'name' => 'maxFileSize',
          'type' => 'float',
          'tooltip' => true,
          'min' => 0
        ],
        3 => (object) [
          'name' => 'accept',
          'type' => 'multiEnum',
          'noEmptyString' => true,
          'allowCustomOptions' => true,
          'options' => [
            0 => 'image/*',
            1 => 'audio/*',
            2 => 'video/*',
            3 => '.zip',
            4 => '.pdf',
            5 => '.odt',
            6 => '.ods',
            7 => '.odp',
            8 => '.docx',
            9 => '.xlsx',
            10 => '.pptx',
            11 => '.doc',
            12 => '.xls',
            13 => '.ppt',
            14 => '.rtf',
            15 => '.csv',
            16 => '.md',
            17 => '.txt'
          ],
          'tooltip' => 'fileAccept'
        ],
        4 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ]
      ],
      'actualFields' => [
        0 => 'id'
      ],
      'notActualFields' => [
        0 => 'name'
      ],
      'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\FieldConverters\\File',
      'validationList' => [
        0 => 'required',
        1 => 'pattern'
      ],
      'mandatoryValidationList' => [
        0 => 'pattern'
      ],
      'filter' => true,
      'linkDefs' => (object) [
        'type' => 'belongsTo',
        'entity' => 'Attachment',
        'skipOrmDefs' => true,
        'utility' => true
      ],
      'personalData' => true,
      'duplicatorClassName' => 'Espo\\Classes\\FieldDuplicators\\File'
    ],
    'float' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'float'
        ],
        2 => (object) [
          'name' => 'min',
          'type' => 'float'
        ],
        3 => (object) [
          'name' => 'max',
          'type' => 'float'
        ],
        4 => (object) [
          'name' => 'decimalPlaces',
          'type' => 'int'
        ],
        5 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        6 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'validationList' => [
        0 => 'required',
        1 => 'min',
        2 => 'max'
      ],
      'mandatoryValidationList' => [
        0 => 'valid'
      ],
      'filter' => true,
      'fieldDefs' => (object) [
        'notNull' => false
      ]
    ],
    'foreign' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'link',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/foreign/link',
          'required' => true
        ],
        1 => (object) [
          'name' => 'field',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/foreign/field',
          'required' => true
        ],
        2 => (object) [
          'name' => 'view',
          'type' => 'varchar',
          'hidden' => true
        ]
      ],
      'fieldTypeList' => [
        0 => 'varchar',
        1 => 'enum',
        2 => 'enumInt',
        3 => 'enumFloat',
        4 => 'int',
        5 => 'float',
        6 => 'url',
        7 => 'date',
        8 => 'datetime',
        9 => 'text',
        10 => 'number',
        11 => 'bool',
        12 => 'email',
        13 => 'phone',
        14 => 'array',
        15 => 'multiEnum',
        16 => 'checklist',
        17 => 'urlMultiple',
        18 => 'currencyConverted'
      ],
      'fieldTypeViewMap' => (object) [
        'varchar' => 'views/fields/foreign-varchar',
        'enum' => 'views/fields/foreign-enum',
        'enumInt' => 'views/fields/foreign-int',
        'enumFloat' => 'views/fields/foreign-float',
        'int' => 'views/fields/foreign-int',
        'float' => 'views/fields/foreign-float',
        'url' => 'views/fields/foreign-url',
        'date' => 'views/fields/foreign-date',
        'datetime' => 'views/fields/foreign-datetime',
        'text' => 'views/fields/foreign-text',
        'number' => 'views/fields/foreign-varchar',
        'bool' => 'views/fields/foreign-bool',
        'email' => 'views/fields/foreign-email',
        'phone' => 'views/fields/foreign-phone',
        'array' => 'views/fields/foreign-array',
        'checklist' => 'views/fields/foreign-checklist',
        'multiEnum' => 'views/fields/foreign-multi-enum',
        'urlMultiple' => 'views/fields/foreign-url-multiple',
        'currencyConverted' => 'views/fields/foreign-currency-converted'
      ],
      'filter' => true,
      'notCreatable' => false,
      'fieldDefs' => (object) [
        'readOnly' => true
      ]
    ],
    'image' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'previewSize',
          'type' => 'enum',
          'default' => 'small',
          'options' => [
            0 => 'x-small',
            1 => 'small',
            2 => 'medium',
            3 => 'large'
          ]
        ],
        2 => (object) [
          'name' => 'listPreviewSize',
          'type' => 'enum',
          'options' => [
            0 => '',
            1 => 'small',
            2 => 'medium'
          ],
          'translation' => 'Admin.options.previewSize'
        ],
        3 => (object) [
          'name' => 'maxFileSize',
          'type' => 'float',
          'tooltip' => true,
          'min' => 0
        ],
        4 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ]
      ],
      'actualFields' => [
        0 => 'id'
      ],
      'notActualFields' => [
        0 => 'name'
      ],
      'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\FieldConverters\\File',
      'validationList' => [
        0 => 'required',
        1 => 'pattern'
      ],
      'mandatoryValidationList' => [
        0 => 'pattern'
      ],
      'filter' => true,
      'linkDefs' => (object) [
        'type' => 'belongsTo',
        'entity' => 'Attachment',
        'skipOrmDefs' => true,
        'utility' => true
      ],
      'personalData' => true,
      'duplicatorClassName' => 'Espo\\Classes\\FieldDuplicators\\File'
    ],
    'int' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'int'
        ],
        2 => (object) [
          'name' => 'min',
          'type' => 'int'
        ],
        3 => (object) [
          'name' => 'max',
          'type' => 'int'
        ],
        4 => (object) [
          'name' => 'disableFormatting',
          'type' => 'bool'
        ],
        5 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        6 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'validationList' => [
        0 => 'required',
        1 => 'min',
        2 => 'max'
      ],
      'mandatoryValidationList' => [
        0 => 'valid'
      ],
      'filter' => true,
      'textFilter' => true,
      'textFilterForeign' => true,
      'personalData' => true
    ],
    'jsonArray' => (object) [
      'notCreatable' => true,
      'notMergeable' => true,
      'notSortable' => true,
      'filter' => false,
      'validationList' => [
        0 => 'array'
      ],
      'mandatoryValidationList' => [
        0 => 'array'
      ]
    ],
    'jsonObject' => (object) [
      'notCreatable' => true,
      'notMergeable' => true,
      'filter' => false
    ],
    'link' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        2 => (object) [
          'name' => 'readOnly',
          'type' => 'bool',
          'tooltip' => 'linkReadOnly'
        ],
        3 => (object) [
          'name' => 'default',
          'type' => 'link',
          'view' => 'views/admin/field-manager/fields/link/default'
        ]
      ],
      'actualFields' => [
        0 => 'id'
      ],
      'notActualFields' => [
        0 => 'name'
      ],
      'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\FieldConverters\\Link',
      'validationList' => [
        0 => 'required',
        1 => 'pattern'
      ],
      'mandatoryValidationList' => [
        0 => 'pattern'
      ],
      'filter' => true,
      'notCreatable' => true,
      'valueFactoryClassName' => 'Espo\\Core\\Field\\Link\\LinkFactory',
      'attributeExtractorClassName' => 'Espo\\Core\\Field\\Link\\LinkAttributeExtractor'
    ],
    'linkMultiple' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'sortable',
          'type' => 'bool',
          'default' => false,
          'hidden' => true
        ],
        2 => (object) [
          'name' => 'readOnly',
          'type' => 'bool',
          'tooltip' => 'linkReadOnly'
        ],
        3 => (object) [
          'name' => 'default',
          'type' => 'linkMultiple',
          'view' => 'views/admin/field-manager/fields/link-multiple/default'
        ]
      ],
      'actualFields' => [
        0 => 'ids'
      ],
      'notActualFields' => [
        0 => 'names'
      ],
      'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\FieldConverters\\LinkMultiple',
      'validationList' => [
        0 => 'required',
        1 => 'pattern',
        2 => 'columnsValid'
      ],
      'mandatoryValidationList' => [
        0 => 'pattern',
        1 => 'columnsValid'
      ],
      'notCreatable' => true,
      'notSortable' => true,
      'filter' => true,
      'valueFactoryClassName' => 'Espo\\Core\\Field\\LinkMultiple\\LinkMultipleFactory',
      'attributeExtractorClassName' => 'Espo\\Core\\Field\\LinkMultiple\\LinkMultipleAttributeExtractor',
      'duplicatorClassName' => 'Espo\\Classes\\FieldDuplicators\\LinkMultiple',
      'massUpdateActionList' => [
        0 => 'update',
        1 => 'add',
        2 => 'remove'
      ]
    ],
    'linkOne' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        2 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'actualFields' => [
        0 => 'id'
      ],
      'notActualFields' => [
        0 => 'name'
      ],
      'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\FieldConverters\\LinkOne',
      'validationList' => [
        0 => 'required',
        1 => 'pattern'
      ],
      'mandatoryValidationList' => [
        0 => 'pattern'
      ],
      'validatorClassName' => 'Espo\\Classes\\FieldValidators\\LinkType',
      'filter' => true,
      'notCreatable' => true
    ],
    'linkParent' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'entityList',
          'type' => 'multiEnum',
          'view' => 'views/admin/field-manager/fields/entity-list'
        ],
        2 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        3 => (object) [
          'name' => 'readOnly',
          'type' => 'bool',
          'tooltip' => 'linkReadOnly'
        ]
      ],
      'actualFields' => [
        0 => 'id',
        1 => 'type'
      ],
      'notActualFields' => [
        0 => 'name'
      ],
      'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\FieldConverters\\LinkParent',
      'validationList' => [
        0 => 'required',
        1 => 'pattern',
        2 => 'valid'
      ],
      'mandatoryValidationList' => [
        0 => 'pattern',
        1 => 'valid'
      ],
      'filter' => true,
      'notCreatable' => true,
      'valueFactoryClassName' => 'Espo\\Core\\Field\\LinkParent\\LinkParentFactory',
      'attributeExtractorClassName' => 'Espo\\Core\\Field\\LinkParent\\LinkParentAttributeExtractor'
    ],
    'map' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'provider',
          'type' => 'enum',
          'options' => [
            0 => 'Google'
          ],
          'default' => 'Google'
        ],
        1 => (object) [
          'name' => 'height',
          'type' => 'int',
          'default' => 300
        ]
      ],
      'filter' => false,
      'notCreatable' => true,
      'notSortable' => true,
      'fieldDefs' => (object) [
        'notStorable' => true
      ]
    ],
    'multiEnum' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'options',
          'type' => 'array',
          'view' => 'views/admin/field-manager/fields/options-with-style',
          'tooltip' => true
        ],
        2 => (object) [
          'name' => 'optionsReference',
          'type' => 'varchar',
          'view' => 'views/admin/field-manager/fields/options-reference',
          'tooltip' => true
        ],
        3 => (object) [
          'name' => 'isSorted',
          'type' => 'bool'
        ],
        4 => (object) [
          'name' => 'translation',
          'type' => 'varchar',
          'hidden' => true
        ],
        5 => (object) [
          'name' => 'allowCustomOptions',
          'type' => 'bool'
        ],
        6 => (object) [
          'name' => 'maxCount',
          'type' => 'int',
          'min' => 1,
          'tooltip' => true
        ],
        7 => (object) [
          'name' => 'style',
          'type' => 'jsonObject',
          'hidden' => true
        ],
        8 => (object) [
          'name' => 'displayAsLabel',
          'type' => 'bool'
        ],
        9 => (object) [
          'name' => 'displayAsList',
          'type' => 'bool',
          'tooltip' => true
        ],
        10 => (object) [
          'name' => 'pattern',
          'type' => 'varchar',
          'tooltip' => true,
          'view' => 'views/admin/field-manager/fields/pattern'
        ],
        11 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        12 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ],
        13 => (object) [
          'name' => 'optionsPath',
          'type' => 'varchar',
          'hidden' => true
        ]
      ],
      'validationList' => [
        0 => 'array',
        1 => 'arrayOfString',
        2 => 'valid',
        3 => 'required',
        4 => 'maxCount',
        5 => 'maxItemLength',
        6 => 'pattern',
        7 => 'noEmptyString'
      ],
      'mandatoryValidationList' => [
        0 => 'array',
        1 => 'arrayOfString',
        2 => 'valid',
        3 => 'maxItemLength',
        4 => 'noEmptyString'
      ],
      'filter' => true,
      'notCreatable' => false,
      'notSortable' => true,
      'fieldDefs' => (object) [
        'type' => 'jsonArray',
        'storeArrayValues' => true
      ],
      'translatedOptions' => true,
      'dynamicLogicOptions' => true,
      'personalData' => true,
      'massUpdateActionList' => [
        0 => 'update',
        1 => 'add',
        2 => 'remove'
      ]
    ],
    'number' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'prefix',
          'type' => 'varchar',
          'maxLength' => 16
        ],
        1 => (object) [
          'name' => 'nextNumber',
          'type' => 'int',
          'min' => 0,
          'max' => 2147483647,
          'required' => true,
          'default' => 1
        ],
        2 => (object) [
          'name' => 'padLength',
          'type' => 'int',
          'default' => 5,
          'required' => true,
          'min' => 1,
          'max' => 20
        ],
        3 => (object) [
          'name' => 'copyToClipboard',
          'type' => 'bool',
          'default' => false
        ]
      ],
      'filter' => true,
      'fieldDefs' => (object) [
        'type' => 'varchar',
        'len' => 36,
        'notNull' => false,
        'unique' => false
      ],
      'hookClassName' => 'Espo\\Tools\\FieldManager\\Hooks\\NumberType',
      'textFilter' => true,
      'readOnly' => true
    ],
    'password' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'maxLength',
          'type' => 'int',
          'max' => 255
        ]
      ],
      'validationList' => [
        0 => 'valid',
        1 => 'maxLength'
      ],
      'mandatoryValidationList' => [
        0 => 'valid',
        1 => 'maxLength'
      ],
      'notSortable' => true,
      'notCreatable' => true,
      'filter' => false,
      'validatorClassName' => 'Espo\\Classes\\FieldValidators\\PasswordType'
    ],
    'personName' => (object) [
      'actualFields' => [
        0 => 'salutation',
        1 => 'first',
        2 => 'last',
        3 => 'middle'
      ],
      'notActualFields' => [
        0 => ''
      ],
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ]
      ],
      'fields' => (object) [
        'salutation' => (object) [
          'type' => 'enum'
        ],
        'first' => (object) [
          'type' => 'varchar',
          'pattern' => '$noBadCharacters'
        ],
        'last' => (object) [
          'type' => 'varchar',
          'pattern' => '$noBadCharacters'
        ],
        'middle' => (object) [
          'type' => 'varchar',
          'maxLength' => 100,
          'pattern' => '$noBadCharacters'
        ]
      ],
      'naming' => 'prefix',
      'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\FieldConverters\\PersonName',
      'notMergeable' => true,
      'notCreatable' => true,
      'filter' => true,
      'skipOrmDefs' => false,
      'personalData' => true,
      'textFilter' => true,
      'fullTextSearch' => true,
      'validationList' => [
        0 => 'required'
      ],
      'fullTextSearchColumnList' => [
        0 => 'first',
        1 => 'last'
      ]
    ],
    'phone' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'typeList',
          'type' => 'array',
          'default' => [
            0 => 'Mobile',
            1 => 'Office',
            2 => 'Home',
            3 => 'Fax',
            4 => 'Other'
          ],
          'view' => 'views/admin/field-manager/fields/options'
        ],
        2 => (object) [
          'name' => 'defaultType',
          'type' => 'enum',
          'default' => 'Mobile',
          'view' => 'views/admin/field-manager/fields/phone/default'
        ],
        3 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ]
      ],
      'actualFields' => [
        0 => 'isOptedOut',
        1 => 'isInvalid',
        2 => '',
        3 => 'data'
      ],
      'notActualFields' => [],
      'fields' => (object) [
        'isOptedOut' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ],
        'isInvalid' => (object) [
          'type' => 'bool',
          'notStorable' => true,
          'layoutDetailDisabled' => true,
          'layoutDefaultSidePanelDisabled' => true,
          'mergeDisabled' => true,
          'customizationDefaultDisabled' => true,
          'customizationReadOnlyDisabled' => true,
          'customizationInlineEditDisabledDisabled' => true
        ]
      ],
      'converterClassName' => 'Espo\\Core\\Utils\\Database\\Orm\\FieldConverters\\Phone',
      'validationList' => [
        0 => 'required',
        1 => 'valid',
        2 => 'maxLength'
      ],
      'mandatoryValidationList' => [
        0 => 'valid',
        1 => 'maxLength'
      ],
      'notCreatable' => true,
      'filter' => true,
      'fieldDefs' => (object) [
        'notStorable' => true
      ],
      'translatedOptions' => true,
      'textFilter' => true,
      'personalData' => true,
      'valueFactoryClassName' => 'Espo\\Core\\Field\\PhoneNumber\\PhoneNumberGroupFactory',
      'attributeExtractorClassName' => 'Espo\\Core\\Field\\PhoneNumber\\PhoneNumberGroupAttributeExtractor'
    ],
    'rangeCurrency' => (object) [
      'actualFields' => [
        0 => 'from',
        1 => 'to'
      ],
      'fields' => (object) [
        'from' => (object) [
          'type' => 'currency',
          'layoutAvailabilityList' => [
            0 => 'filters',
            1 => 'massUpdate'
          ]
        ],
        'to' => (object) [
          'type' => 'currency',
          'layoutAvailabilityList' => [
            0 => 'filters',
            1 => 'massUpdate'
          ]
        ]
      ],
      'naming' => 'prefix',
      'notMergeable' => true,
      'notCreatable' => true,
      'filter' => false,
      'skipOrmDefs' => true
    ],
    'rangeFloat' => (object) [
      'actualFields' => [
        0 => 'from',
        1 => 'to'
      ],
      'fields' => (object) [
        'from' => (object) [
          'type' => 'float',
          'layoutAvailabilityList' => [
            0 => 'filters',
            1 => 'massUpdate'
          ]
        ],
        'to' => (object) [
          'type' => 'float',
          'layoutAvailabilityList' => [
            0 => 'filters',
            1 => 'massUpdate'
          ]
        ]
      ],
      'naming' => 'prefix',
      'notMergeable' => true,
      'notCreatable' => true,
      'filter' => false,
      'skipOrmDefs' => true
    ],
    'rangeInt' => (object) [
      'actualFields' => [
        0 => 'from',
        1 => 'to'
      ],
      'fields' => (object) [
        'from' => (object) [
          'type' => 'int',
          'layoutAvailabilityList' => [
            0 => 'filters',
            1 => 'massUpdate'
          ]
        ],
        'to' => (object) [
          'type' => 'int',
          'layoutAvailabilityList' => [
            0 => 'filters',
            1 => 'massUpdate'
          ]
        ]
      ],
      'naming' => 'prefix',
      'notMergeable' => true,
      'notCreatable' => true,
      'filter' => false,
      'skipOrmDefs' => true
    ],
    'text' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'text'
        ],
        2 => (object) [
          'name' => 'maxLength',
          'type' => 'int'
        ],
        3 => (object) [
          'name' => 'seeMoreDisabled',
          'type' => 'bool',
          'tooltip' => true
        ],
        4 => (object) [
          'name' => 'rows',
          'type' => 'int',
          'min' => 1
        ],
        5 => (object) [
          'name' => 'rowsMin',
          'type' => 'int',
          'default' => 2,
          'min' => 1,
          'hidden' => true
        ],
        6 => (object) [
          'name' => 'cutHeight',
          'type' => 'int',
          'default' => 200,
          'min' => 1,
          'tooltip' => true
        ],
        7 => (object) [
          'name' => 'displayRawText',
          'type' => 'bool'
        ],
        8 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ],
        9 => (object) [
          'name' => 'audited',
          'type' => 'bool',
          'tooltip' => true
        ]
      ],
      'validationList' => [
        0 => 'required',
        1 => 'maxLength'
      ],
      'filter' => true,
      'personalData' => true,
      'textFilter' => true,
      'textFilterForeign' => true,
      'fullTextSearch' => true
    ],
    'url' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'varchar'
        ],
        2 => (object) [
          'name' => 'maxLength',
          'type' => 'int'
        ],
        3 => (object) [
          'name' => 'strip',
          'type' => 'bool',
          'tooltip' => 'urlStrip'
        ],
        4 => (object) [
          'name' => 'copyToClipboard',
          'type' => 'bool',
          'default' => false
        ],
        5 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        6 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'validationList' => [
        0 => 'required',
        1 => 'maxLength',
        2 => 'valid'
      ],
      'mandatoryValidationList' => [
        0 => 'maxLength',
        1 => 'valid'
      ],
      'filter' => true,
      'fieldDefs' => (object) [
        'type' => 'varchar'
      ],
      'personalData' => true
    ],
    'urlMultiple' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'maxCount',
          'type' => 'int',
          'min' => 1,
          'tooltip' => true
        ],
        2 => (object) [
          'name' => 'strip',
          'type' => 'bool',
          'default' => false,
          'tooltip' => 'urlStrip'
        ],
        3 => (object) [
          'name' => 'audited',
          'type' => 'bool'
        ],
        4 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ]
      ],
      'validationList' => [
        0 => 'required',
        1 => 'maxCount'
      ],
      'mandatoryValidationList' => [
        0 => 'array',
        1 => 'arrayOfString',
        2 => 'valid',
        3 => 'maxItemLength',
        4 => 'pattern',
        5 => 'noEmptyString'
      ],
      'filter' => true,
      'notCreatable' => false,
      'notSortable' => true,
      'fieldDefs' => (object) [
        'type' => 'jsonArray',
        'storeArrayValues' => true
      ],
      'personalData' => true,
      'massUpdateActionList' => [
        0 => 'update',
        1 => 'add',
        2 => 'remove'
      ]
    ],
    'varchar' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'varchar'
        ],
        2 => (object) [
          'name' => 'maxLength',
          'type' => 'int',
          'default' => 150,
          'min' => 1,
          'max' => 65535
        ],
        3 => (object) [
          'name' => 'options',
          'type' => 'multiEnum',
          'tooltip' => 'optionsVarchar'
        ],
        4 => (object) [
          'name' => 'pattern',
          'type' => 'varchar',
          'default' => NULL,
          'tooltip' => true,
          'view' => 'views/admin/field-manager/fields/pattern'
        ],
        5 => (object) [
          'name' => 'copyToClipboard',
          'type' => 'bool',
          'default' => false
        ],
        6 => (object) [
          'name' => 'audited',
          'type' => 'bool',
          'tooltip' => true
        ],
        7 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ],
        8 => (object) [
          'name' => 'noSpellCheck',
          'type' => 'bool',
          'default' => false,
          'hidden' => true
        ],
        9 => (object) [
          'name' => 'optionsPath',
          'type' => 'varchar',
          'hidden' => true
        ]
      ],
      'validationList' => [
        0 => 'required',
        1 => 'maxLength',
        2 => 'pattern'
      ],
      'mandatoryValidationList' => [
        0 => 'maxLength'
      ],
      'filter' => true,
      'personalData' => true,
      'textFilter' => true,
      'textFilterForeign' => true,
      'dynamicLogicOptions' => true,
      'fullTextSearch' => true
    ],
    'wysiwyg' => (object) [
      'params' => [
        0 => (object) [
          'name' => 'required',
          'type' => 'bool',
          'default' => false
        ],
        1 => (object) [
          'name' => 'default',
          'type' => 'text'
        ],
        2 => (object) [
          'name' => 'height',
          'type' => 'int'
        ],
        3 => (object) [
          'name' => 'minHeight',
          'type' => 'int'
        ],
        4 => (object) [
          'name' => 'readOnly',
          'type' => 'bool'
        ],
        5 => (object) [
          'name' => 'attachmentField',
          'type' => 'varchar',
          'hidden' => true
        ],
        6 => (object) [
          'name' => 'useIframe',
          'type' => 'bool'
        ],
        7 => (object) [
          'name' => 'maxLength',
          'type' => 'int'
        ],
        8 => (object) [
          'name' => 'audited',
          'type' => 'bool',
          'tooltip' => true
        ]
      ],
      'filter' => true,
      'fieldDefs' => (object) [
        'type' => 'text'
      ],
      'validationList' => [
        0 => 'required',
        1 => 'maxLength'
      ],
      'personalData' => true,
      'textFilter' => true,
      'fullTextSearch' => true,
      'duplicatorClassName' => 'Espo\\Classes\\FieldDuplicators\\Wysiwyg',
      'validatorClassName' => 'Espo\\Classes\\FieldValidators\\TextType'
    ]
  ],
  'integrations' => (object) [
    'GoogleMaps' => (object) [
      'fields' => (object) [
        'apiKey' => (object) [
          'type' => 'varchar',
          'maxLength' => 255,
          'required' => true
        ]
      ],
      'allowUserAccounts' => false,
      'view' => 'views/admin/integrations/google-maps',
      'authMethod' => 'GoogleMaps'
    ]
  ],
  'notificationDefs' => (object) [
    'Email' => (object) [
      'assignmentNotificatorClassName' => 'Espo\\Classes\\AssignmentNotificators\\Email'
    ],
    'Call' => (object) [
      'assignmentNotificatorClassName' => 'Espo\\Modules\\Crm\\Classes\\AssignmentNotificators\\Meeting',
      'forceAssignmentNotificator' => true
    ],
    'Case' => (object) [
      'emailNotificationHandlerClassNameMap' => (object) [
        'notePost' => 'Espo\\Modules\\Crm\\Classes\\EmailNotificationHandlers\\CaseObj'
      ]
    ],
    'Meeting' => (object) [
      'assignmentNotificatorClassName' => 'Espo\\Modules\\Crm\\Classes\\AssignmentNotificators\\Meeting',
      'forceAssignmentNotificator' => true
    ]
  ],
  'recordDefs' => (object) [
    'ActionHistoryRecord' => (object) [
      'readLoaderClassNameList' => [
        0 => 'Espo\\Core\\FieldProcessing\\LinkParent\\TargetLoader'
      ],
      'listLoaderClassNameList' => [
        0 => 'Espo\\Core\\FieldProcessing\\LinkParent\\TargetLoader'
      ],
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'Attachment' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'AuthLogRecord' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'AuthToken' => (object) [
      'massActions' => (object) [
        'update' => (object) [
          'allowed' => true
        ],
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'DashboardTemplate' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'Email' => (object) [
      'readLoaderClassNameList' => [
        0 => 'Espo\\Classes\\FieldProcessing\\Email\\AddressDataLoader',
        1 => 'Espo\\Classes\\FieldProcessing\\Email\\UserColumnsLoader',
        2 => 'Espo\\Classes\\FieldProcessing\\Email\\IcsDataLoader'
      ],
      'listLoaderClassNameList' => [
        0 => 'Espo\\Classes\\FieldProcessing\\Email\\StringDataLoader'
      ],
      'selectApplierClassNameList' => [
        0 => 'Espo\\Classes\\Select\\Email\\AdditionalAppliers\\Main'
      ],
      'massActions' => (object) [
        'moveToFolder' => (object) [
          'implementationClassName' => 'Espo\\Classes\\MassAction\\Email\\MoveToFolder'
        ]
      ]
    ],
    'EmailAccount' => (object) [
      'massActions' => (object) [
        'update' => (object) [
          'allowed' => true
        ],
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'EmailAddress' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'EmailFilter' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ],
        'update' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'EmailTemplate' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ],
        'update' => (object) [
          'allowed' => true
        ]
      ],
      'actions' => (object) [
        'merge' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'EmailTemplateCategory' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ],
        'update' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'Import' => (object) [
      'readLoaderClassNameList' => [
        0 => 'Espo\\Classes\\FieldProcessing\\Import\\CountsLoader'
      ],
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'InboundEmail' => (object) [
      'massActions' => (object) [
        'update' => (object) [
          'allowed' => true
        ],
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'Job' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'LayoutSet' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'LeadCapture' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ],
        'update' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'LeadCaptureLogRecord' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'Note' => (object) [
      'readLoaderClassNameList' => [
        0 => 'Espo\\Classes\\FieldProcessing\\Note\\AttachmentsLoader'
      ]
    ],
    'Notification' => (object) [
      'exportDisabled' => true
    ],
    'PhoneNumber' => (object) [
      'massActions' => (object) [
        'update' => (object) [
          'allowed' => true
        ],
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'Portal' => (object) [
      'readLoaderClassNameList' => [
        0 => 'Espo\\Classes\\FieldProcessing\\Portal\\UrlLoader'
      ],
      'listLoaderClassNameList' => [
        0 => 'Espo\\Classes\\FieldProcessing\\Portal\\UrlLoader'
      ],
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'PortalRole' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'Preferences' => (object) [
      'actionsDisabled' => true
    ],
    'Role' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'ScheduledJob' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ],
        'update' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'Team' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ],
      'beforeLinkHookClassNameList' => [
        0 => 'Espo\\Classes\\RecordHooks\\Team\\BeforeLinkUserCheck'
      ]
    ],
    'Template' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ],
        'update' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'User' => (object) [
      'massActions' => (object) [
        'update' => (object) [
          'implementationClassName' => 'Espo\\Classes\\MassAction\\User\\MassUpdate'
        ],
        'delete' => (object) [
          'implementationClassName' => 'Espo\\Classes\\MassAction\\User\\MassDelete'
        ]
      ],
      'readLoaderClassNameList' => [
        0 => 'Espo\\Classes\\FieldProcessing\\User\\LastAccessLoader'
      ]
    ],
    'Webhook' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ],
        'update' => (object) [
          'allowed' => true
        ]
      ]
    ],
    'Account' => (object) [
      'duplicateWhereBuilderClassName' => 'Espo\\Classes\\DuplicateWhereBuilders\\General',
      'readLoaderClassNameList' => [],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'Call' => (object) [
      'listLoaderClassNameList' => [
        0 => 'Espo\\Modules\\Crm\\Classes\\FieldProcessing\\Meeting\\AcceptanceStatusLoader'
      ],
      'readLoaderClassNameList' => [
        0 => 'Espo\\Core\\FieldProcessing\\Reminder\\Loader',
        1 => 'Espo\\Modules\\Crm\\Classes\\FieldProcessing\\Call\\PhoneNumberMapLoader'
      ],
      'saverClassNameList' => [
        0 => 'Espo\\Core\\FieldProcessing\\Reminder\\Saver'
      ],
      'beforeUpdateHookClassNameList' => [
        0 => 'Espo\\Classes\\RecordHooks\\Event\\BeforeUpdatePreserveDuration'
      ],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'Campaign' => (object) [
      'readLoaderClassNameList' => [
        0 => 'Espo\\Modules\\Crm\\Classes\\FieldProcessing\\Campaign\\StatsLoader'
      ],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'CampaignLogRecord' => (object) [
      'massActions' => (object) [
        'update' => (object) [
          'allowed' => true
        ],
        'delete' => (object) [
          'allowed' => true
        ]
      ],
      'readLoaderClassNameList' => [],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'CampaignTrackingUrl' => (object) [
      'massActions' => (object) [
        'update' => (object) [
          'allowed' => true
        ],
        'delete' => (object) [
          'allowed' => true
        ]
      ],
      'readLoaderClassNameList' => [],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'Case' => (object) [
      'relationships' => (object) [
        'articles' => (object) [
          'linkRequiredAccess' => 'edit',
          'linkRequiredForeignAccess' => 'read'
        ],
        'emails' => (object) [
          'linkRequiredForeignAccess' => 'read'
        ]
      ],
      'readLoaderClassNameList' => [],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'Contact' => (object) [
      'duplicateWhereBuilderClassName' => 'Espo\\Classes\\DuplicateWhereBuilders\\General',
      'readLoaderClassNameList' => [],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'DocumentFolder' => (object) [
      'massActions' => (object) [
        'update' => (object) [
          'allowed' => true
        ],
        'delete' => (object) [
          'allowed' => true
        ]
      ],
      'readLoaderClassNameList' => [],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'EmailQueueItem' => (object) [
      'massActions' => (object) [
        'delete' => (object) [
          'allowed' => true
        ]
      ],
      'readLoaderClassNameList' => [],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'KnowledgeBaseCategory' => (object) [
      'massActions' => (object) [
        'update' => (object) [
          'allowed' => true
        ],
        'delete' => (object) [
          'allowed' => true
        ]
      ],
      'readLoaderClassNameList' => [],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'Lead' => (object) [
      'duplicateWhereBuilderClassName' => 'Espo\\Classes\\DuplicateWhereBuilders\\General',
      'readLoaderClassNameList' => [],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'MassEmail' => (object) [
      'massActions' => (object) [
        'update' => (object) [
          'allowed' => true
        ],
        'delete' => (object) [
          'allowed' => true
        ]
      ],
      'readLoaderClassNameList' => [],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'Meeting' => (object) [
      'listLoaderClassNameList' => [
        0 => 'Espo\\Modules\\Crm\\Classes\\FieldProcessing\\Meeting\\AcceptanceStatusLoader'
      ],
      'readLoaderClassNameList' => [
        0 => 'Espo\\Core\\FieldProcessing\\Reminder\\Loader'
      ],
      'saverClassNameList' => [
        0 => 'Espo\\Core\\FieldProcessing\\Reminder\\Saver',
        1 => 'Espo\\Modules\\Crm\\Classes\\FieldProcessing\\Meeting\\SourceEmailSaver'
      ],
      'beforeUpdateHookClassNameList' => [
        0 => 'Espo\\Classes\\RecordHooks\\Event\\BeforeUpdatePreserveDuration'
      ],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'Opportunity' => (object) [
      'massActions' => (object) [
        'update' => (object) [
          'implementationClassName' => 'Espo\\Modules\\Crm\\Classes\\MassAction\\Opportunity\\MassUpdate'
        ]
      ],
      'readLoaderClassNameList' => [],
      'listLoaderClassNameList' => [],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'TargetList' => (object) [
      'readLoaderClassNameList' => [
        0 => 'Espo\\Modules\\Crm\\Classes\\FieldProcessing\\TargetList\\EntryCountLoader',
        1 => 'Espo\\Modules\\Crm\\Classes\\FieldProcessing\\TargetList\\OptedOutCountLoader'
      ],
      'listLoaderClassNameList' => [
        0 => 'Espo\\Modules\\Crm\\Classes\\FieldProcessing\\TargetList\\EntryCountLoader',
        1 => 'Espo\\Modules\\Crm\\Classes\\FieldProcessing\\TargetList\\OptedOutCountLoader'
      ],
      'saverClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ],
    'Task' => (object) [
      'readLoaderClassNameList' => [
        0 => 'Espo\\Core\\FieldProcessing\\Reminder\\Loader'
      ],
      'saverClassNameList' => [
        0 => 'Espo\\Core\\FieldProcessing\\Reminder\\Saver'
      ],
      'listLoaderClassNameList' => [],
      'selectApplierClassNameList' => [],
      'beforeReadHookClassNameList' => [],
      'beforeCreateHookClassNameList' => [],
      'beforeUpdateHookClassNameList' => [],
      'beforeDeleteHookClassNameList' => [],
      'beforeLinkHookClassNameList' => [],
      'beforeUnlinkHookClassNameList' => []
    ]
  ],
  'scopes' => (object) [
    'ActionHistoryRecord' => (object) [
      'entity' => true
    ],
    'ArrayValue' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'Attachment' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'AuthLogRecord' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'AuthToken' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'AuthenticationProvider' => (object) [
      'entity' => true,
      'exportFormatList' => [
        0 => 'csv'
      ]
    ],
    'Autofollow' => (object) [
      'entity' => true
    ],
    'Currency' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => true,
      'aclActionList' => [
        0 => 'read',
        1 => 'edit'
      ],
      'aclLevelList' => [
        0 => 'yes',
        1 => 'no'
      ],
      'aclHighestLevel' => 'yes',
      'customizable' => false
    ],
    'Dashboard' => (object) [
      'entity' => false,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'DashboardTemplate' => (object) [
      'entity' => true
    ],
    'Email' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclPortal' => true,
      'aclPortalLevelList' => [
        0 => 'all',
        1 => 'account',
        2 => 'contact',
        3 => 'own',
        4 => 'no'
      ],
      'aclPortalActionList' => [
        0 => 'read'
      ],
      'notifications' => true,
      'object' => true,
      'customizable' => true,
      'activity' => true,
      'activityStatusList' => [
        0 => 'Draft'
      ],
      'historyStatusList' => [
        0 => 'Archived',
        1 => 'Sent'
      ]
    ],
    'EmailAccount' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false
    ],
    'EmailAccountScope' => (object) [
      'entity' => false,
      'layouts' => false,
      'tab' => false,
      'acl' => 'boolean'
    ],
    'EmailAddress' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'EmailFilter' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'notifications' => false,
      'object' => false,
      'customizable' => false
    ],
    'EmailFolder' => (object) [
      'entity' => true
    ],
    'EmailTemplate' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => true,
      'customizable' => false
    ],
    'EmailTemplateCategory' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => 'recordAllTeamNo',
      'customizable' => true,
      'importable' => false,
      'type' => 'CategoryTree',
      'notifications' => false
    ],
    'Export' => (object) [
      'languageIsGlobal' => true
    ],
    'Extension' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'ExternalAccount' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => 'boolean',
      'aclPortal' => false,
      'customizable' => false
    ],
    'Formula' => (object) [
      'languageIsGlobal' => true
    ],
    'GroupEmailFolder' => (object) [
      'entity' => true
    ],
    'Import' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => 'boolean',
      'customizable' => false
    ],
    'ImportError' => (object) [
      'entity' => true
    ],
    'InboundEmail' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false
    ],
    'Integration' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
      'languageAclDisabled' => true
    ],
    'Job' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'LastViewed' => (object) [
      'entity' => false,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'LayoutRecord' => (object) [
      'entity' => true
    ],
    'LayoutSet' => (object) [
      'entity' => true
    ],
    'LeadCapture' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'LeadCaptureLogRecord' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'MassAction' => (object) [
      'languageIsGlobal' => true
    ],
    'Note' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => true,
      'entityManager' => (object) [
        'edit' => false,
        'fields' => true,
        'relationships' => false,
        'formula' => false,
        'layouts' => false,
        'addField' => false
      ]
    ],
    'Notification' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'PasswordChangeRequest' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'PhoneNumber' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'Portal' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'PortalRole' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
      'importable' => true,
      'exportFormatList' => [
        0 => 'csv'
      ]
    ],
    'PortalUser' => (object) [
      'tab' => true,
      'tabAclPermission' => 'portalPermission'
    ],
    'Preferences' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'Role' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false,
      'importable' => true,
      'exportFormatList' => [
        0 => 'csv'
      ]
    ],
    'ScheduledJob' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'ScheduledJobLogRecord' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'Stream' => (object) [
      'entity' => false,
      'layouts' => false,
      'tab' => true,
      'acl' => false,
      'customizable' => false
    ],
    'Subscription' => (object) [
      'entity' => true
    ],
    'Team' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => true,
      'aclActionList' => [
        0 => 'read'
      ],
      'aclLevelList' => [
        0 => 'all',
        1 => 'team',
        2 => 'no'
      ],
      'customizable' => false
    ],
    'Template' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => true,
      'acl' => true,
      'aclLevelList' => [
        0 => 'all',
        1 => 'team',
        2 => 'no'
      ],
      'aclPortal' => true,
      'aclPortalLevelList' => [
        0 => 'all',
        1 => 'no'
      ],
      'aclPortalActionList' => [
        0 => 'read'
      ],
      'customizable' => false,
      'importable' => true,
      'disabled' => false
    ],
    'UniqueId' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'customizable' => false
    ],
    'User' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclActionList' => [
        0 => 'read',
        1 => 'edit'
      ],
      'aclActionLevelListMap' => (object) [
        'edit' => [
          0 => 'own',
          1 => 'no'
        ]
      ],
      'customizable' => true,
      'object' => true
    ],
    'UserData' => (object) [
      'entity' => true
    ],
    'Webhook' => (object) [
      'entity' => true,
      'acl' => 'boolean'
    ],
    'WebhookEventQueueItem' => (object) [
      'entity' => true
    ],
    'WebhookQueueItem' => (object) [
      'entity' => true
    ],
    'WorkingTimeCalendar' => (object) [
      'entity' => true,
      'acl' => 'boolean',
      'tab' => true,
      'layouts' => false,
      'customizable' => false
    ],
    'WorkingTimeRange' => (object) [
      'entity' => true,
      'acl' => false,
      'tab' => false,
      'layouts' => false,
      'customizable' => false
    ],
    'Account' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclPortal' => 'recordAllAccountNo',
      'module' => 'Crm',
      'customizable' => true,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
      'hasPersonalData' => true,
      'duplicateCheckFieldList' => [
        0 => 'name',
        1 => 'emailAddress'
      ]
    ],
    'Activities' => (object) [
      'entity' => false,
      'layouts' => false,
      'tab' => false,
      'acl' => 'boolean',
      'aclPortal' => 'boolean',
      'module' => 'Crm',
      'customizable' => false
    ],
    'Calendar' => (object) [
      'entity' => false,
      'tab' => true,
      'acl' => 'boolean',
      'module' => 'Crm'
    ],
    'Call' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclPortal' => 'recordAllAccountContactOwnNo',
      'module' => 'Crm',
      'customizable' => true,
      'importable' => true,
      'notifications' => true,
      'calendar' => true,
      'activity' => true,
      'object' => true,
      'activityStatusList' => [
        0 => 'Planned'
      ],
      'historyStatusList' => [
        0 => 'Held',
        1 => 'Not Held'
      ],
      'completedStatusList' => [
        0 => 'Held'
      ],
      'canceledStatusList' => [
        0 => 'Not Held'
      ],
      'statusField' => 'status',
      'statusFieldLocked' => true
    ],
    'Campaign' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'module' => 'Crm',
      'customizable' => true,
      'stream' => false,
      'importable' => false,
      'object' => true,
      'statusField' => 'status'
    ],
    'CampaignLogRecord' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'module' => 'Crm',
      'customizable' => false,
      'stream' => false,
      'importable' => false
    ],
    'CampaignTrackingUrl' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'module' => 'Crm',
      'customizable' => false,
      'stream' => false,
      'importable' => false
    ],
    'Case' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclPortal' => 'recordAllAccountContactOwnNo',
      'module' => 'Crm',
      'customizable' => true,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
      'statusField' => 'status'
    ],
    'Contact' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclPortal' => 'recordAllAccountContactNo',
      'module' => 'Crm',
      'customizable' => true,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
      'hasPersonalData' => true,
      'duplicateCheckFieldList' => [
        0 => 'name',
        1 => 'emailAddress'
      ]
    ],
    'Document' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclPortal' => true,
      'aclPortalLevelList' => [
        0 => 'all',
        1 => 'account',
        2 => 'contact',
        3 => 'own',
        4 => 'no'
      ],
      'module' => 'Crm',
      'customizable' => true,
      'importable' => false,
      'notifications' => true,
      'object' => true
    ],
    'DocumentFolder' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => 'recordAllTeamNo',
      'aclPortal' => 'recordAllNo',
      'aclPortalActionList' => [
        0 => 'read'
      ],
      'module' => 'Crm',
      'customizable' => true,
      'importable' => false,
      'type' => 'CategoryTree',
      'stream' => false,
      'notifications' => false
    ],
    'EmailQueueItem' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'notifications' => false,
      'object' => false,
      'customizable' => false,
      'module' => 'Crm'
    ],
    'KnowledgeBaseArticle' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => 'recordAllTeamNo',
      'aclPortal' => 'recordAllNo',
      'aclPortalActionList' => [
        0 => 'read'
      ],
      'module' => 'Crm',
      'customizable' => true,
      'importable' => true,
      'notifications' => false,
      'object' => true
    ],
    'KnowledgeBaseCategory' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => 'recordAllTeamNo',
      'aclPortal' => 'recordAllNo',
      'aclPortalActionList' => [
        0 => 'read'
      ],
      'module' => 'Crm',
      'customizable' => true,
      'importable' => false,
      'type' => 'CategoryTree',
      'stream' => false,
      'notifications' => false
    ],
    'Lead' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclPortal' => 'recordAllOwnNo',
      'module' => 'Crm',
      'customizable' => true,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
      'statusField' => 'status',
      'hasPersonalData' => true,
      'duplicateCheckFieldList' => [
        0 => 'name',
        1 => 'emailAddress'
      ]
    ],
    'MassEmail' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'notifications' => false,
      'object' => false,
      'customizable' => false,
      'module' => 'Crm'
    ],
    'Meeting' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclPortal' => 'recordAllAccountContactOwnNo',
      'module' => 'Crm',
      'customizable' => true,
      'importable' => true,
      'notifications' => true,
      'stream' => true,
      'calendar' => true,
      'activity' => true,
      'object' => true,
      'activityStatusList' => [
        0 => 'Planned'
      ],
      'historyStatusList' => [
        0 => 'Held',
        1 => 'Not Held'
      ],
      'completedStatusList' => [
        0 => 'Held'
      ],
      'canceledStatusList' => [
        0 => 'Not Held'
      ],
      'statusField' => 'status',
      'statusFieldLocked' => true
    ],
    'Opportunity' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclPortal' => 'recordAllAccountContactOwnNo',
      'module' => 'Crm',
      'customizable' => true,
      'stream' => true,
      'importable' => true,
      'notifications' => true,
      'object' => true,
      'statusField' => 'stage',
      'kanbanStatusIgnoreList' => [
        0 => 'Closed Lost'
      ],
      'currencyConversionAccessRequiredFieldList' => [
        0 => 'amount'
      ]
    ],
    'Reminder' => (object) [
      'entity' => true,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'module' => 'Crm',
      'customizable' => false,
      'importable' => false
    ],
    'Target' => (object) [
      'entity' => false,
      'layouts' => false,
      'tab' => false,
      'acl' => false,
      'module' => 'Crm',
      'customizable' => false,
      'importable' => false,
      'notifications' => false,
      'object' => true,
      'disabled' => true
    ],
    'TargetList' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'module' => 'Crm',
      'customizable' => true,
      'stream' => false,
      'importable' => false,
      'notifications' => true,
      'object' => true,
      'targetLinkList' => [
        0 => 'accounts',
        1 => 'contacts',
        2 => 'leads',
        3 => 'users'
      ]
    ],
    'Task' => (object) [
      'entity' => true,
      'layouts' => true,
      'tab' => true,
      'acl' => true,
      'aclPortal' => true,
      'aclPortalLevelList' => [
        0 => 'all',
        1 => 'account',
        2 => 'contact',
        3 => 'own',
        4 => 'no'
      ],
      'activityStatusList' => [
        0 => 'Not Started',
        1 => 'Started'
      ],
      'historyStatusList' => [
        0 => 'Completed'
      ],
      'completedStatusList' => [
        0 => 'Completed'
      ],
      'canceledStatusList' => [
        0 => 'Canceled'
      ],
      'module' => 'Crm',
      'customizable' => true,
      'importable' => true,
      'notifications' => true,
      'calendar' => true,
      'object' => true,
      'statusField' => 'status',
      'stream' => true,
      'kanbanStatusIgnoreList' => [
        0 => 'Canceled',
        1 => 'Deferred'
      ],
      'statusFieldLocked' => true
    ]
  ],
  'selectDefs' => (object) [
    'ActionHistoryRecord' => (object) [
      'accessControlFilterClassNameMap' => (object) [
        'onlyOwn' => 'Espo\\Classes\\Select\\ActionHistoryRecord\\AccessControlFilters\\OnlyOwn'
      ],
      'boolFilterClassNameMap' => (object) [
        'onlyMy' => 'Espo\\Classes\\Select\\ActionHistoryRecord\\BoolFilters\\OnlyMy'
      ]
    ],
    'Attachment' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'orphan' => 'Espo\\Classes\\Select\\Attachment\\PrimaryFilters\\Orphan'
      ]
    ],
    'AuthLogRecord' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'denied' => 'Espo\\Classes\\Select\\AuthLogRecord\\PrimaryFilters\\Denied',
        'accepted' => 'Espo\\Classes\\Select\\AuthLogRecord\\PrimaryFilters\\Accepted'
      ]
    ],
    'AuthToken' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'active' => 'Espo\\Classes\\Select\\AuthToken\\PrimaryFilters\\Active',
        'inactive' => 'Espo\\Classes\\Select\\AuthToken\\PrimaryFilters\\Inactive'
      ]
    ],
    'Email' => (object) [
      'whereItemConverterClassNameMap' => (object) [
        'folderId_inFolder' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\InFolder',
        'emailAddress_equals' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\EmailAddressEquals',
        'from_equals' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\FromEquals',
        'to_equals' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\ToEquals',
        'isNotReplied_isTrue' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\IsNotRepliedIsTrue',
        'isNotReplied_isFalse' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\IsNotRepliedIsFalse',
        'isNotRead_isTrue' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\IsNotReadIsTrue',
        'isNotRead_isFalse' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\IsNotReadIsFalse',
        'isRead_isTrue' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\IsNotReadIsFalse',
        'isRead_isFalse' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\IsNotReadIsTrue',
        'isImportant_isTrue' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\IsImportantIsTrue',
        'isImportant_isFalse' => 'Espo\\Classes\\Select\\Email\\Where\\ItemConverters\\IsImportantIsFalse'
      ],
      'accessControlFilterClassNameMap' => (object) [
        'onlyOwn' => 'Espo\\Classes\\Select\\Email\\AccessControlFilters\\OnlyOwn',
        'portalOnlyOwn' => 'Espo\\Classes\\Select\\Email\\AccessControlFilters\\OnlyOwn',
        'onlyTeam' => 'Espo\\Classes\\Select\\Email\\AccessControlFilters\\OnlyTeam',
        'portalOnlyContact' => 'Espo\\Classes\\Select\\Email\\AccessControlFilters\\PortalOnlyContact',
        'portalOnlyAccount' => 'Espo\\Classes\\Select\\Email\\AccessControlFilters\\PortalOnlyAccount'
      ],
      'boolFilterClassNameMap' => (object) [
        'onlyMy' => 'Espo\\Classes\\Select\\Email\\BoolFilters\\OnlyMy'
      ],
      'textFilterClassName' => 'Espo\\Classes\\Select\\Email\\TextFilter',
      'textFilterUseContainsAttributeList' => [
        0 => 'name'
      ],
      'selectAttributesDependencyMap' => (object) [
        'subject' => [
          0 => 'name'
        ],
        'personStringData' => [
          0 => 'fromString',
          1 => 'fromEmailAddressId'
        ],
        'replyToName' => [
          0 => 'replyToString'
        ]
      ]
    ],
    'EmailAccount' => (object) [
      'accessControlFilterClassNameMap' => (object) [
        'mandatory' => 'Espo\\Classes\\Select\\EmailAccount\\AccessControlFilters\\Mandatory'
      ]
    ],
    'EmailAddress' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'orphan' => 'Espo\\Classes\\Select\\EmailAddress\\PrimaryFilters\\Orphan'
      ]
    ],
    'EmailFilter' => (object) [
      'accessControlFilterClassNameMap' => (object) [
        'onlyOwn' => 'Espo\\Classes\\Select\\EmailFilter\\AccessControlFilters\\OnlyOwn'
      ],
      'boolFilterClassNameMap' => (object) [
        'onlyMy' => 'Espo\\Classes\\Select\\EmailFilter\\BoolFilters\\OnlyMy'
      ]
    ],
    'EmailFolder' => (object) [
      'accessControlFilterClassNameMap' => (object) [
        'mandatory' => 'Espo\\Classes\\Select\\EmailFolder\\AccessControlFilters\\Mandatory'
      ]
    ],
    'EmailTemplate' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'actual' => 'Espo\\Classes\\Select\\EmailTemplate\\PrimaryFilters\\Actual'
      ]
    ],
    'Import' => (object) [
      'accessControlFilterClassNameMap' => (object) [
        'mandatory' => 'Espo\\Classes\\Select\\Import\\AccessControlFilters\\Mandatory'
      ],
      'accessControlFilterResolverClassName' => 'Espo\\Core\\Select\\AccessControl\\FilterResolvers\\Bypass'
    ],
    'ImportError' => (object) [
      'accessControlFilterClassNameMap' => (object) [
        'onlyMy' => 'Espo\\Core\\Select\\AccessControl\\Filters\\ForeignOnlyOwn'
      ],
      'accessControlFilterResolverClassName' => 'Espo\\Core\\Select\\AccessControl\\FilterResolvers\\BooleanOwn',
      'selectAttributesDependencyMap' => (object) [
        'lineNumber' => [
          0 => 'rowIndex'
        ],
        'exportLineNumber' => [
          0 => 'exportRowIndex'
        ]
      ],
      'orderItemConverterClassNameMap' => (object) [
        'lineNumber' => 'Espo\\Classes\\Select\\ImportError\\OrderItemConverters\\LineNumber',
        'exportLineNumber' => 'Espo\\Classes\\Select\\ImportError\\OrderItemConverters\\ExportLineNumber'
      ]
    ],
    'Note' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'posts' => 'Espo\\Classes\\Select\\Note\\PrimaryFilters\\Posts',
        'updates' => 'Espo\\Classes\\Select\\Note\\PrimaryFilters\\Updates'
      ],
      'boolFilterClassNameMap' => (object) [
        'skipOwn' => 'Espo\\Classes\\Select\\Note\\BoolFilters\\SkipOwn'
      ]
    ],
    'PhoneNumber' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'orphan' => 'Espo\\Classes\\Select\\PhoneNumber\\PrimaryFilters\\Orphan'
      ]
    ],
    'ScheduledJob' => (object) [
      'accessControlFilterClassNameMap' => (object) [
        'mandatory' => 'Espo\\Classes\\Select\\ScheduledJob\\AccessControlFilters\\Mandatory'
      ]
    ],
    'Team' => (object) [
      'boolFilterClassNameMap' => (object) [
        'onlyMy' => 'Espo\\Classes\\Select\\Team\\BoolFilters\\OnlyMy'
      ],
      'accessControlFilterClassNameMap' => (object) [
        'onlyTeam' => 'Espo\\Classes\\Select\\Team\\AccessControlFilters\\OnlyTeam'
      ]
    ],
    'Template' => (object) [
      'accessControlFilterClassNameMap' => (object) [
        'mandatory' => 'Espo\\Classes\\Select\\Template\\AccessControlFilters\\Mandatory'
      ]
    ],
    'User' => (object) [
      'whereItemConverterClassNameMap' => (object) [
        'id_isOfType' => 'Espo\\Classes\\Select\\User\\Where\\ItemConverters\\IsOfType'
      ],
      'accessControlFilterClassNameMap' => (object) [
        'mandatory' => 'Espo\\Classes\\Select\\User\\AccessControlFilters\\Mandatory',
        'onlyTeam' => 'Espo\\Classes\\Select\\User\\AccessControlFilters\\OnlyTeam',
        'onlyOwn' => 'Espo\\Classes\\Select\\User\\AccessControlFilters\\OnlyOwn',
        'portalOnlyOwn' => 'Espo\\Classes\\Select\\User\\AccessControlFilters\\PortalOnlyOwn'
      ],
      'primaryFilterClassNameMap' => (object) [
        'active' => 'Espo\\Classes\\Select\\User\\PrimaryFilters\\Active',
        'activePortal' => 'Espo\\Classes\\Select\\User\\PrimaryFilters\\ActivePortal',
        'activeApi' => 'Espo\\Classes\\Select\\User\\PrimaryFilters\\ActiveApi',
        'portal' => 'Espo\\Classes\\Select\\User\\PrimaryFilters\\Portal',
        'api' => 'Espo\\Classes\\Select\\User\\PrimaryFilters\\Api',
        'internal' => 'Espo\\Classes\\Select\\User\\PrimaryFilters\\Internal'
      ],
      'boolFilterClassNameMap' => (object) [
        'onlyMyTeam' => 'Espo\\Classes\\Select\\User\\BoolFilters\\OnlyMyTeam'
      ],
      'orderItemConverterClassNameMap' => (object) [
        'userNameOwnFirst' => 'Espo\\Classes\\Select\\User\\OrderItemConverters\\UserNameOwnFirst'
      ]
    ],
    'Webhook' => (object) [
      'accessControlFilterClassNameMap' => (object) [
        'mandatory' => 'Espo\\Classes\\Select\\Webhook\\AccessControlFilters\\Mandatory'
      ],
      'accessControlFilterResolverClassName' => 'Espo\\Core\\Select\\AccessControl\\FilterResolvers\\Bypass'
    ],
    'WorkingTimeCalendar' => (object) [
      'accessControlFilterResolverClassName' => 'Espo\\Core\\Select\\AccessControl\\FilterResolvers\\Boolean'
    ],
    'WorkingTimeRange' => (object) [
      'accessControlFilterResolverClassName' => 'Espo\\Core\\Select\\AccessControl\\FilterResolvers\\Boolean',
      'primaryFilterClassNameMap' => (object) [
        'actual' => 'Espo\\Classes\\Select\\WorkingTimeRange\\PrimaryFilters\\Actual'
      ]
    ],
    'Account' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'customers' => 'Espo\\Modules\\Crm\\Classes\\Select\\Account\\PrimaryFilters\\Customers',
        'resellers' => 'Espo\\Modules\\Crm\\Classes\\Select\\Account\\PrimaryFilters\\Resellers',
        'partners' => 'Espo\\Modules\\Crm\\Classes\\Select\\Account\\PrimaryFilters\\Partners',
        'recentlyCreated' => 'Espo\\Modules\\Crm\\Classes\\Select\\Account\\PrimaryFilters\\RecentlyCreated'
      ],
      'accessControlFilterClassNameMap' => (object) [
        'portalOnlyAccount' => 'Espo\\Modules\\Crm\\Classes\\Select\\Account\\AccessControlFilters\\PortalOnlyAccount'
      ]
    ],
    'Call' => (object) [
      'selectAttributesDependencyMap' => (object) [
        'duration' => [
          0 => 'dateStart',
          1 => 'dateEnd'
        ],
        'dateStart' => [
          0 => 'dateEnd'
        ]
      ],
      'primaryFilterClassNameMap' => (object) [
        'planned' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\PrimaryFilters\\Planned',
        'held' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\PrimaryFilters\\Held',
        'todays' => 'Espo\\Modules\\Crm\\Classes\\Select\\Call\\PrimaryFilters\\Todays'
      ],
      'boolFilterClassNameMap' => (object) [
        'onlyMy' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\BoolFilters\\OnlyMy'
      ],
      'accessControlFilterClassNameMap' => (object) [
        'onlyOwn' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\AccessControlFilters\\OnlyOwn',
        'onlyTeam' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\AccessControlFilters\\OnlyTeam'
      ]
    ],
    'Campaign' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'active' => 'Espo\\Modules\\Crm\\Classes\\Select\\Campaign\\PrimaryFilters\\Active'
      ]
    ],
    'CampaignLogRecord' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'opened' => 'Espo\\Modules\\Crm\\Classes\\Select\\CampaignLogRecord\\PrimaryFilters\\Opened',
        'sent' => 'Espo\\Modules\\Crm\\Classes\\Select\\CampaignLogRecord\\PrimaryFilters\\Sent',
        'clicked' => 'Espo\\Modules\\Crm\\Classes\\Select\\CampaignLogRecord\\PrimaryFilters\\Clicked',
        'optedOut' => 'Espo\\Modules\\Crm\\Classes\\Select\\CampaignLogRecord\\PrimaryFilters\\OptedOut',
        'optedIn' => 'Espo\\Modules\\Crm\\Classes\\Select\\CampaignLogRecord\\PrimaryFilters\\OptedIn',
        'bounced' => 'Espo\\Modules\\Crm\\Classes\\Select\\CampaignLogRecord\\PrimaryFilters\\Bounced',
        'leadCreated' => 'Espo\\Modules\\Crm\\Classes\\Select\\CampaignLogRecord\\PrimaryFilters\\LeadCreated'
      ],
      'accessControlFilterClassNameMap' => (object) [
        'onlyOwn' => 'Espo\\Modules\\Crm\\Classes\\Select\\CampaignLogRecord\\AccessControlFilters\\OnlyOwn',
        'onlyTeam' => 'Espo\\Modules\\Crm\\Classes\\Select\\CampaignLogRecord\\AccessControlFilters\\OnlyTeam'
      ]
    ],
    'CampaignTrackingUrl' => (object) [
      'accessControlFilterClassNameMap' => (object) [
        'onlyOwn' => 'Espo\\Modules\\Crm\\Classes\\Select\\CampaignTrackingUrl\\AccessControlFilters\\OnlyOwn',
        'onlyTeam' => 'Espo\\Modules\\Crm\\Classes\\Select\\CampaignTrackingUrl\\AccessControlFilters\\OnlyTeam'
      ]
    ],
    'Case' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'open' => 'Espo\\Modules\\Crm\\Classes\\Select\\CaseObj\\PrimaryFilters\\Open',
        'closed' => 'Espo\\Modules\\Crm\\Classes\\Select\\CaseObj\\PrimaryFilters\\Closed'
      ],
      'boolFilterClassNameMap' => (object) [
        'open' => 'Espo\\Modules\\Crm\\Classes\\Select\\CaseObj\\BoolFilters\\Open'
      ]
    ],
    'Contact' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'portalUsers' => 'Espo\\Modules\\Crm\\Classes\\Select\\Contact\\PrimaryFilters\\PortalUsers',
        'notPortalUsers' => 'Espo\\Modules\\Crm\\Classes\\Select\\Contact\\PrimaryFilters\\NotPortalUsers',
        'accountActive' => 'Espo\\Modules\\Crm\\Classes\\Select\\Contact\\PrimaryFilters\\AccountActive'
      ],
      'accessControlFilterClassNameMap' => (object) [
        'portalOnlyContact' => 'Espo\\Modules\\Crm\\Classes\\Select\\Contact\\AccessControlFilters\\PortalOnlyContact'
      ]
    ],
    'Document' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'active' => 'Espo\\Modules\\Crm\\Classes\\Select\\Document\\PrimaryFilters\\Active',
        'draft' => 'Espo\\Modules\\Crm\\Classes\\Select\\Document\\PrimaryFilters\\Draft'
      ]
    ],
    'EmailQueueItem' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'pending' => 'Espo\\Modules\\Crm\\Classes\\Select\\EmailQueueItem\\PrimaryFilters\\Pending',
        'failed' => 'Espo\\Modules\\Crm\\Classes\\Select\\EmailQueueItem\\PrimaryFilters\\Failed',
        'sent' => 'Espo\\Modules\\Crm\\Classes\\Select\\EmailQueueItem\\PrimaryFilters\\Sent'
      ]
    ],
    'KnowledgeBaseArticle' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'published' => 'Espo\\Modules\\Crm\\Classes\\Select\\KnowledgeBaseArticle\\PrimaryFilters\\Published'
      ],
      'accessControlFilterClassNameMap' => (object) [
        'mandatory' => 'Espo\\Modules\\Crm\\Classes\\Select\\KnowledgeBaseArticle\\AccessControlFilters\\Mandatory'
      ]
    ],
    'Lead' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'actual' => 'Espo\\Modules\\Crm\\Classes\\Select\\Lead\\PrimaryFilters\\Actual',
        'active' => 'Espo\\Modules\\Crm\\Classes\\Select\\Lead\\PrimaryFilters\\Actual',
        'converted' => 'Espo\\Modules\\Crm\\Classes\\Select\\Lead\\PrimaryFilters\\Converted'
      ]
    ],
    'MassEmail' => (object) [
      'accessControlFilterClassNameMap' => (object) [
        'onlyOwn' => 'Espo\\Modules\\Crm\\Classes\\Select\\MassEmail\\AccessControlFilters\\OnlyOwn',
        'onlyTeam' => 'Espo\\Modules\\Crm\\Classes\\Select\\MassEmail\\AccessControlFilters\\OnlyTeam'
      ],
      'primaryFilterClassNameMap' => (object) [
        'actual' => 'Espo\\Modules\\Crm\\Classes\\Select\\MassEmail\\PrimaryFilters\\Actual',
        'complete' => 'Espo\\Modules\\Crm\\Classes\\Select\\MassEmail\\PrimaryFilters\\Complete'
      ]
    ],
    'Meeting' => (object) [
      'whereDateTimeItemTransformerClassName' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\Where\\DateTimeItemTransformer',
      'selectAttributesDependencyMap' => (object) [
        'duration' => [
          0 => 'dateStart',
          1 => 'dateEnd'
        ],
        'dateStart' => [
          0 => 'dateEnd'
        ],
        'dateStartDate' => [
          0 => 'dateEnd',
          1 => 'dateEndDate'
        ]
      ],
      'primaryFilterClassNameMap' => (object) [
        'planned' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\PrimaryFilters\\Planned',
        'held' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\PrimaryFilters\\Held',
        'todays' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\PrimaryFilters\\Todays'
      ],
      'boolFilterClassNameMap' => (object) [
        'onlyMy' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\BoolFilters\\OnlyMy'
      ],
      'accessControlFilterClassNameMap' => (object) [
        'onlyOwn' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\AccessControlFilters\\OnlyOwn',
        'onlyTeam' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\AccessControlFilters\\OnlyTeam'
      ]
    ],
    'Opportunity' => (object) [
      'primaryFilterClassNameMap' => (object) [
        'open' => 'Espo\\Modules\\Crm\\Classes\\Select\\Opportunity\\PrimaryFilters\\Open',
        'won' => 'Espo\\Modules\\Crm\\Classes\\Select\\Opportunity\\PrimaryFilters\\Won',
        'lost' => 'Espo\\Modules\\Crm\\Classes\\Select\\Opportunity\\PrimaryFilters\\Lost'
      ]
    ],
    'TargetList' => (object) [
      'selectAttributesDependencyMap' => (object) [
        'targetStatus' => [
          0 => 'isOptedOut'
        ]
      ]
    ],
    'Task' => (object) [
      'whereDateTimeItemTransformerClassName' => 'Espo\\Modules\\Crm\\Classes\\Select\\Meeting\\Where\\DateTimeItemTransformer',
      'selectAttributesDependencyMap' => (object) [
        'dateEnd' => [
          0 => 'status'
        ]
      ],
      'primaryFilterClassNameMap' => (object) [
        'actual' => 'Espo\\Modules\\Crm\\Classes\\Select\\Task\\PrimaryFilters\\Actual',
        'completed' => 'Espo\\Modules\\Crm\\Classes\\Select\\Task\\PrimaryFilters\\Completed',
        'deferred' => 'Espo\\Modules\\Crm\\Classes\\Select\\Task\\PrimaryFilters\\Deferred',
        'todays' => 'Espo\\Modules\\Crm\\Classes\\Select\\Task\\PrimaryFilters\\Todays',
        'actualStartingNotInFuture' => 'Espo\\Modules\\Crm\\Classes\\Select\\Task\\PrimaryFilters\\ActualStartingNotInFuture',
        'overdue' => 'Espo\\Modules\\Crm\\Classes\\Select\\Task\\PrimaryFilters\\Overdue'
      ],
      'boolFilterClassNameMap' => (object) [
        'actual' => 'Espo\\Modules\\Crm\\Classes\\Select\\Task\\BoolFilters\\Actual',
        'completed' => 'Espo\\Modules\\Crm\\Classes\\Select\\Task\\BoolFilters\\Completed'
      ]
    ]
  ],
  'themes' => (object) [
    'Dark' => (object) [
      'stylesheet' => 'client/css/espo/dark.css',
      'stylesheetIframe' => 'client/css/espo/dark-iframe.css',
      'stylesheetIframeFallback' => 'client/css/espo/hazyblue-iframe.css',
      'textColor' => '#dedede',
      'chartGridColor' => '#646060',
      'chartTickColor' => '#575454',
      'chartSuccessColor' => '#5d8a55',
      'chartColorList' => [
        0 => '#7492cc',
        1 => '#c29c4a',
        2 => '#a1404a',
        3 => '#6a5f96',
        4 => '#b07e53',
        5 => '#3a5691',
        6 => '#7c593d',
        7 => '#a17a97',
        8 => '#858585'
      ],
      'chartColorAlternativeList' => [
        0 => '#7492cc',
        1 => '#c29c4a',
        2 => '#a1404a',
        3 => '#6a5f96',
        4 => '#b07e53'
      ],
      'calendarColors' => (object) [
        '' => '#a58dc7a0',
        'bg' => '#3e485ab3',
        'Meeting' => '#697da5',
        'Call' => '#a1404a',
        'Task' => '#5d8a55'
      ],
      'isDark' => true
    ],
    'Espo' => (object) [
      'stylesheet' => 'client/css/espo/espo.css',
      'stylesheetIframe' => 'client/css/espo/espo-iframe.css',
      'logo' => 'client/img/logo.svg',
      'params' => (object) [
        'navbar' => (object) [
          'type' => 'enum',
          'default' => 'side',
          'options' => [
            0 => 'side',
            1 => 'top'
          ]
        ]
      ],
      'mappedParams' => (object) [
        'navbarHeight' => (object) [
          'param' => 'navbar',
          'valueMap' => (object) [
            'side' => 30,
            'top' => 43
          ]
        ]
      ],
      'dashboardCellHeight' => 155,
      'dashboardCellMargin' => 16,
      'navbarHeight' => 43,
      'modalFooterAtTheTop' => true,
      'modalFullHeight' => true,
      'fontSize' => 14,
      'textColor' => '#333',
      'hoverColor' => '#FF3F19',
      'chartGridColor' => '#ddd',
      'chartSuccessColor' => '#6fc374',
      'chartTickColor' => '#e8eced',
      'chartColorList' => [
        0 => '#6FA8D6',
        1 => '#4E6CAD',
        2 => '#EDC555',
        3 => '#ED8F42',
        4 => '#DE6666',
        5 => '#7CC4A4',
        6 => '#8A7CC2',
        7 => '#D4729B',
        8 => '#bfbfbf'
      ],
      'chartColorAlternativeList' => [
        0 => '#6FA8D6',
        1 => '#EDC555',
        2 => '#ED8F42',
        3 => '#7CC4A4',
        4 => '#D4729B'
      ],
      'calendarColors' => (object) [
        '' => '#a58dc7a0',
        'bg' => '#d5ddf6a0'
      ],
      'isDark' => false
    ],
    'EspoRtl' => (object) [
      'stylesheet' => 'client/css/espo/espo-rtl.css',
      'stylesheetIframe' => 'client/css/espo/espo-rtl-iframe.css',
      'params' => (object) [
        'navbar' => (object) [
          'type' => 'enum',
          'default' => 'top',
          'options' => [
            0 => 'top',
            1 => 'side'
          ]
        ]
      ]
    ],
    'Glass' => (object) [
      'stylesheet' => 'client/css/espo/glass.css',
      'stylesheetIframe' => 'client/css/espo/glass-iframe.css',
      'stylesheetIframeFallback' => 'client/css/espo/hazyblue-iframe.css',
      'textColor' => '#dedede',
      'chartGridColor' => '#646060',
      'chartTickColor' => '#575454',
      'chartSuccessColor' => '#5d8a55',
      'chartColorList' => [
        0 => '#7492cc',
        1 => '#c29c4a',
        2 => '#a1404a',
        3 => '#6a5f96',
        4 => '#b07e53',
        5 => '#3a5691',
        6 => '#7c593d',
        7 => '#a17a97',
        8 => '#858585'
      ],
      'chartColorAlternativeList' => [
        0 => '#7492cc',
        1 => '#c29c4a',
        2 => '#a1404a',
        3 => '#6a5f96',
        4 => '#b07e53'
      ],
      'calendarColors' => (object) [
        '' => '#a58dc7a0',
        'bg' => '#45528166',
        'Meeting' => '#6680b3d1',
        'Call' => '#a1404ad1',
        'Task' => '#5d8a55d1'
      ],
      'isDark' => true
    ],
    'Hazyblue' => (object) [
      'stylesheet' => 'client/css/espo/hazyblue.css',
      'stylesheetIframe' => 'client/css/espo/hazyblue-iframe.css',
      'textColor' => '#333',
      'chartGridColor' => '#ddd',
      'chartTickColor' => '#e8eced',
      'chartSuccessColor' => '#85b75f',
      'chartColorList' => [
        0 => '#6FA8D6',
        1 => '#EDC555',
        2 => '#DE6666',
        3 => '#8A7CC2',
        4 => '#c1834d',
        5 => '#4E6CAD',
        6 => '#ED8F42',
        7 => '#d69cc7',
        8 => '#bfbfbf'
      ],
      'chartColorAlternativeList' => [
        0 => '#6FA8D6',
        1 => '#EDC555',
        2 => '#DE6666',
        3 => '#8A7CC2',
        4 => '#c1834d'
      ]
    ],
    'Light' => (object) [
      'logo' => 'client/img/logo-light.svg',
      'stylesheet' => 'client/css/espo/light.css',
      'stylesheetIframe' => 'client/css/espo/light-iframe.css',
      'textColor' => '#0f0f0f',
      'chartGridColor' => '#ddd',
      'chartTickColor' => '#e8eced',
      'chartSuccessColor' => '#80ce8e',
      'chartColorList' => [
        0 => '#6FA8D6',
        1 => '#4E6CAD',
        2 => '#EDC555',
        3 => '#ED8F42',
        4 => '#DE6666',
        5 => '#7CC4A4',
        6 => '#8A7CC2',
        7 => '#D4729B',
        8 => '#bfbfbf'
      ],
      'chartColorAlternativeList' => [
        0 => '#6FA8D6',
        1 => '#EDC555',
        2 => '#ED8F42',
        3 => '#7CC4A4',
        4 => '#D4729B'
      ]
    ],
    'Sakura' => (object) [
      'stylesheet' => 'client/css/espo/sakura.css',
      'stylesheetIframe' => 'client/css/espo/sakura-iframe.css',
      'textColor' => '#424242',
      'chartGridColor' => '#ddd',
      'chartTickColor' => '#e8eced',
      'chartSuccessColor' => '#83CD77',
      'chartColorList' => [
        0 => '#6FA8D6',
        1 => '#4E6CAD',
        2 => '#EDC555',
        3 => '#ED8F42',
        4 => '#DE6666',
        5 => '#7CC4A4',
        6 => '#8A7CC2',
        7 => '#D4729B',
        8 => '#bfbfbf'
      ],
      'chartColorAlternativeList' => [
        0 => '#6FA8D6',
        1 => '#EDC555',
        2 => '#ED8F42',
        3 => '#7CC4A4',
        4 => '#D4729B'
      ]
    ],
    'Violet' => (object) [
      'stylesheet' => 'client/css/espo/violet.css',
      'stylesheetIframe' => 'client/css/espo/violet-iframe.css',
      'textColor' => '#424242',
      'chartGridColor' => '#ddd',
      'chartTickColor' => '#e8eced',
      'chartSuccessColor' => '#7BC169',
      'chartColorList' => [
        0 => '#6FA8D6',
        1 => '#4E6CAD',
        2 => '#EDC555',
        3 => '#ED8F42',
        4 => '#DE6666',
        5 => '#7CC4A4',
        6 => '#8A7CC2',
        7 => '#D4729B',
        8 => '#bfbfbf'
      ],
      'chartColorAlternativeList' => [
        0 => '#6FA8D6',
        1 => '#EDC555',
        2 => '#ED8F42',
        3 => '#7CC4A4',
        4 => '#D4729B'
      ]
    ]
  ],
  'pdfDefs' => (object) [
    'Account' => (object) [
      'dataLoaderClassNameList' => [
        0 => 'Espo\\Modules\\Crm\\Classes\\Pdf\\Account\\ExampleDataLoader'
      ]
    ]
  ],
  'streamDefs' => (object) [
    'Call' => (object) [
      'followingUsersField' => 'users',
      'subscribersCleanup' => (object) [
        'enabled' => true,
        'dateField' => 'dateStart',
        'statusList' => [
          0 => 'Held',
          1 => 'Not Held'
        ]
      ]
    ],
    'Meeting' => (object) [
      'followingUsersField' => 'users',
      'subscribersCleanup' => (object) [
        'enabled' => true,
        'dateField' => 'dateStart',
        'statusList' => [
          0 => 'Held',
          1 => 'Not Held'
        ]
      ]
    ],
    'Task' => (object) [
      'subscribersCleanup' => (object) [
        'enabled' => true,
        'statusList' => [
          0 => 'Completed',
          1 => 'Canceled'
        ]
      ]
    ]
  ]
];
