<!--START sidebar-->
<nav class="sidebar-wrap">
    <div class="sidebar">
        <div class="sidebar-top">
            @if(auth()->check() == true)
                @if(auth()->user()->root == 1)
                    <div class="sidebar-settings">
                        <a href="#modal-settings" class="getModal">Settings</a>
                    </div>
                @endif
            @endif
        </div>
        @if(!is_null($menu))
            <div class="menu-items-list">
                @php($page = request()->segment(3))
                @foreach($menu as $m)

                    @if($m->modulesId->alias != 'sitemap' && $m->modulesId->alias != 'modules-constructor')

                        <?php
                        $has_child = !empty(IfHasChildModules($m->modules_id, $lang_id, $lang)) ? 'has-child' : '';
                        $name = IfHasName($m->modules_id, $lang_id, 'modules') ?: trans('variables.another_name');
                        $alias = $m->modulesId->alias;
                        $href = "/$lang/back/$alias";
                        $category = request()->segment(3);
                        $active = $category && strpos($href, request()->path()) ? 'active' : '';
                        $children = $m->children()->count();
                        $open = $category === $alias ? 'block' : 'none';
                        ?>

                        <div class="menu-item {{$has_child}}">

                            <a href="{{$has_child ? '#' : $href }}"
                               class="{{!$has_child ? $active : ''}}"
                               title="{{$name}}">{{$name}}
                                @if($has_child) <span class="menu-more-items"></span> @endif
                            </a>

                            @if($has_child)
                                <div class="hidden-menu-items" style="display: {{$open}};">
                                    <div class="menu-item">
                                        <a href="{{$href}}"
                                           class="{{$active}}"
                                           title="{{$name}}">
                                            {{$name}}
                                        </a>
                                    </div>
                                    {!! IfHasChildModules($m->modules_id, $lang_id, $lang) !!}
                                </div>
                            @endif

                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</nav>
<!--END sidebar-->