<div class="page-header">
    <h3><a href='#Lead'>{{translate scope category='scopeNamesPlural'}}</a>
    <span class="breadcrumb-separator"><span class="chevron-right"></span></span>
    <a href='#Lead/view/{{this.model.id}}'>{{get this.model 'name'}}</a>
    <span class="breadcrumb-separator"><span class="chevron-right"></span></span>
    {{translate 'convert' scope='Lead'}}</h3>
</div>

{{#each scopeList}}
<div class="record">
    <label style="user-select: none; cursor: pointer;" class="text-large">
        <input
            type="checkbox"
            class="check-scope form-checkbox"
            data-scope="{{./this}}"
        >
        <span>{{translate this category='scopeNames'}}</span>
    </label>
    <div class="edit-container-{{toDom this}} hide">
    {{{var this ../this}}}
    </div>
</div>
{{/each}}

<div class="button-container margin-top">
    <div class="btn-group">
        <button class="btn btn-primary" data-action="convert">{{translate 'Convert' scope='Lead'}}</button>
        <button class="btn btn-default" data-action="cancel">{{translate 'Cancel'}}</button>
    </div>
</div>
