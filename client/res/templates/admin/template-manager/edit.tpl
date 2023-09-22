<div class="page-header">
    <h4>{{{title}}}</h4>
</div>

<div class="button-container">
    <div class="btn-group">
        <button class="btn btn-primary btn-xs-wide" data-action="save">{{translate 'Save'}}</button>
        <button class="btn btn-default btn-xs-wide" data-action="cancel">{{translate 'Cancel'}}</button>
        <button class="btn btn-default btn-xs-wide" data-action="resetToDefault"
            >{{translate 'Reset to Default' scope='Admin'}}</button>
    </div>
</div>

{{#if hasSubject}}
<div class="subject-field">{{{subjectField}}}</div>
{{/if}}
<div class="body-field">{{{bodyField}}}</div>
