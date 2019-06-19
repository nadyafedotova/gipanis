@for($i=0;$i<count($items);$i++)
    <li class="nav-item">
        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}"
           href="{{ $items[$i]->link_to_data }}">
            {{ $items[$i]->name }}

                {{--@if ($pending_approval > 0)--}}
                    {{--<span class="badge badge-danger">{{ $pending_approval }}</span>--}}
                {{--@endif--}}
        </a>
    </li>
@endfor