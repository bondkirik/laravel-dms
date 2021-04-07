<li class="{{ Request::is('admin/home*') ? 'active' : '' }}">
    <a href="{!! route('admin.dashboard') !!}">
        <i class="fa fa-home"></i>
        <span>{{ __('messages.home') }}</span>
    </a>
</li>

<li class="{{ Request::is('admin/organizations*') ? 'active' : '' }}">
    <a href="{!! route('organizations.index') !!}">
        <i class="fa fa-building"></i>
        <span>{{ __('messages.companies') }}</span>
    </a>
</li>

<li class="{{ Request::is('admin/tasks*') ? 'active' : '' }}">
    <a href="{!! route('tasks.index') !!}">
        <i class="fa fa-tasks"></i>
        <span>{{ __('messages.tasks') }}</span>
    </a>
</li>

@can('read users')
    <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
        <a href="{!! route('users.index') !!}">
            <i class="fa fa-users"></i>
            <span>{{ __('messages.users') }}</span>
        </a>
    </li>
@endcan

@can('read tags')
    <li class="{{ Request::is('admin/tags*') ? 'active' : '' }}">
        <a href="{!! route('tags.index') !!}">
            <i class="fa fa-tags"></i>
            <span>{{ucfirst(config('settings.tags_label_plural'))}}</span>
        </a>
    </li>
@endcan

@can('viewAny',\App\Models\Document::class)
    <li class="{{ Request::is('admin/documents*') ? 'active' : '' }}">
        <a href="{!! route('documents.index') !!}">
            <i class="fa fa-file"></i>
            <span>{{ucfirst(config('settings.document_label_plural'))}}</span>
        </a>
    </li>
@endcan

@if(auth()->user()->is_super_admin)
    <li class="treeview {{ Request::is('admin/advanced*') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-info-circle"></i>
            <span>{{ __('messages.advanced_settings') }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>

        <ul class="treeview-menu">
            <li class="{{ Request::is('admin/advanced/settings*') ? 'active' : '' }}">
                <a href="{!! route('settings.index') !!}">
                    <i class="fa fa-gear"></i>
                    <span>{{ __('messages.settings') }}</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/advanced/custom-fields*') ? 'active' : '' }}">
                <a href="{!! route('customFields.index') !!}">
                    <i class="fa fa-file-text-o"></i>
                    <span>{{ __('messages.custom_fields') }}</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/advanced/file-types*') ? 'active' : '' }}">
                <a href="{!! route('fileTypes.index') !!}">
                    <i class="fa fa-file-o"></i>
                    <span>{{ucfirst(config('settings.file_label_singular'))}} {{ __('messages.types') }}</span>
                </a>
            </li>
        </ul>
    </li>
@endif
